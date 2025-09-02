<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Jadwal;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil materi yang dibuat guru
        $materis = Materi::where('guru_id', $guru->id)
            ->with(['kelas'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Ambil kelas yang ada di jadwal mengajar guru
        $availableKelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas')
            ->unique('id')
            ->sortBy('nama');

        return view('guru.materi.index', compact('materis', 'availableKelas'));
    }

    public function create()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang ada di jadwal mengajar guru
        $availableKelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas')
            ->unique('id')
            ->sortBy('nama');

        return view('guru.materi.create', compact('availableKelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_ids' => 'required|array|min:1',
            'kelas_ids.*' => 'exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
            'link_drive' => 'nullable|url',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang tersedia untuk guru ini
        $availableKelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas.id')
            ->unique()
            ->toArray();

        // Validasi bahwa semua kelas yang dipilih tersedia untuk guru ini
        $invalidKelas = array_diff($request->kelas_ids, $availableKelas);
        if (!empty($invalidKelas)) {
            return redirect()->back()
                ->with('error', 'Beberapa kelas yang dipilih tidak tersedia untuk Anda.')
                ->withInput();
        }

        // Upload file jika ada
        $filePath = null;
        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materi', $fileName, 'public');
        }

        // Ambil kelas pertama sebagai kelas utama
        $primaryKelasId = $request->kelas_ids[0];
        $sharedKelas = count($request->kelas_ids) > 1 ? array_slice($request->kelas_ids, 1) : null;

        // Simpan materi
        Materi::create([
            'guru_id' => $guru->id,
            'jadwal_id' => null, // Tidak lagi menggunakan jadwal
            'kelas_id' => $primaryKelasId,
            'shared_kelas' => $sharedKelas,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'link_drive' => $request->link_drive,
        ]);

        return redirect()->route('materi.index')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function show(Materi $materi)
    {
        return view('guru.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang ada di jadwal mengajar guru
        $availableKelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas')
            ->unique('id')
            ->sortBy('nama');

        // Load relationships untuk materi
        $materi->load(['kelas']);

        return view('guru.materi.edit', compact('materi', 'availableKelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'kelas_ids' => 'required|array|min:1',
            'kelas_ids.*' => 'exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
            'link_drive' => 'nullable|url',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang tersedia untuk guru ini
        $availableKelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas.id')
            ->unique()
            ->toArray();

        // Validasi bahwa semua kelas yang dipilih tersedia untuk guru ini
        $invalidKelas = array_diff($request->kelas_ids, $availableKelas);
        if (!empty($invalidKelas)) {
            return redirect()->back()
                ->with('error', 'Beberapa kelas yang dipilih tidak tersedia untuk Anda.')
                ->withInput();
        }

        // Upload file baru jika ada
        $filePath = $materi->file;
        if ($request->hasFile('file_materi')) {
            // Hapus file lama jika ada
            if ($materi->file && Storage::disk('public')->exists($materi->file)) {
                Storage::disk('public')->delete($materi->file);
            }

            $file = $request->file('file_materi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materi', $fileName, 'public');
        }

        // Ambil kelas pertama sebagai kelas utama
        $primaryKelasId = $request->kelas_ids[0];
        $sharedKelas = count($request->kelas_ids) > 1 ? array_slice($request->kelas_ids, 1) : null;

        // Update materi
        $materi->update([
            'jadwal_id' => null, // Tidak lagi menggunakan jadwal
            'kelas_id' => $primaryKelasId,
            'shared_kelas' => $sharedKelas,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
            'link_drive' => $request->link_drive,
        ]);

        return redirect()->route('materi.index')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        // Hapus file jika ada
        if ($materi->file && Storage::disk('public')->exists($materi->file)) {
            Storage::disk('public')->delete($materi->file);
        }

        $materi->delete();

        return redirect()->route('materi.index')
            ->with('success', 'Materi berhasil dihapus!');
    }

    // Method untuk siswa melihat materi
    public function materiSiswa()
    {
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil materi untuk kelas siswa (kelas utama atau shared)
        $materis = Materi::where(function($query) use ($siswa) {
                $query->where('kelas_id', $siswa->kelas_id)
                      ->orWhereJsonContains('shared_kelas', $siswa->kelas_id);
            })
            ->with(['guru'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('siswa.materi.index', compact('materis'));
    }
}
