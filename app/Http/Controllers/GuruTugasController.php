<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Materi;
use App\Models\Guru;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruTugasController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang diajar guru
        $kelasQuery = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->distinct();

        // Filter berdasarkan kelas jika dipilih
        if ($request->filled('kelas_id')) {
            $kelasQuery->where('kelas_id', $request->kelas_id);
        }

        $jadwals = $kelasQuery->get();
        $kelas = $jadwals->pluck('kelas')->unique('id')->sortBy('nama');

        // Ambil submissions untuk siswa di kelas yang diajar guru
        $submissions = Submission::whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })
            ->with(['materi', 'siswa.kelas'])
            ->when($request->filled('kelas_id'), function($query) use ($request) {
                $query->whereHas('siswa', function($siswaQuery) use ($request) {
                    $siswaQuery->where('kelas_id', $request->kelas_id);
                });
            })
            ->when($request->filled('status'), function($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('submitted_at', 'desc')
            ->paginate(15);

        // Statistik berdasarkan kelas yang diajar
        $stats = [
            'total' => Submission::whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })->count(),
            'pending' => Submission::whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })->where('status', 'pending')->count(),
            'reviewed' => Submission::whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })->where('status', 'reviewed')->count(),
            'approved' => Submission::whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })->where('status', 'approved')->count(),
            'rejected' => Submission::whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })->where('status', 'rejected')->count(),
        ];

        return view('guru.tugas.index', compact('submissions', 'kelas', 'stats'));
    }

    public function show(Submission $submission)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Pastikan submission ini dari siswa di kelas yang diajar guru
        $hasAccess = Jadwal::where('guru_id', $guru->id)
            ->whereHas('kelas', function($query) use ($submission) {
                $query->where('id', $submission->siswa->kelas_id);
            })
            ->exists();

        if (!$hasAccess) {
            return redirect()->route('guru.tugas.index')->with('error', 'Anda tidak memiliki akses ke submission ini.');
        }

        // Load relationships
        $submission->load(['materi', 'siswa.kelas']);

        return view('guru.tugas.show', compact('submission'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan.'
            ], 404);
        }

        // Pastikan submission ini dari siswa di kelas yang diajar guru
        $hasAccess = Jadwal::where('guru_id', $guru->id)
            ->whereHas('kelas', function($query) use ($submission) {
                $query->where('id', $submission->siswa->kelas_id);
            })
            ->exists();

        if (!$hasAccess) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke submission ini.'
            ], 403);
        }

        // Update submission
        $submission->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status submission berhasil diperbarui!'
        ]);
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'submission_ids' => 'required|array',
            'submission_ids.*' => 'exists:submissions,id',
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan.'
            ], 404);
        }

        // Update multiple submissions - pastikan hanya untuk siswa di kelas yang diajar guru
        Submission::whereIn('id', $request->submission_ids)
            ->whereHas('siswa', function($query) use ($guru) {
                $query->whereHas('kelas', function($kelasQuery) use ($guru) {
                    $kelasQuery->whereHas('jadwals', function($jadwalQuery) use ($guru) {
                        $jadwalQuery->where('guru_id', $guru->id);
                    });
                });
            })
            ->update([
                'status' => $request->status,
                'feedback' => $request->feedback,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Status ' . count($request->submission_ids) . ' submission berhasil diperbarui!'
        ]);
    }
}