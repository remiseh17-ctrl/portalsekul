<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaTugasController extends Controller
{
    public function submitTugas(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'link_tugas' => 'required|url',
            'catatan' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan.'
            ], 404);
        }

        $materi = Materi::find($request->materi_id);

        // Cek apakah siswa bisa akses materi ini
        if (!$materi->canAccessBySiswa($siswa)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke materi ini.'
            ], 403);
        }

        // Simpan atau update submission ke database
        Submission::updateOrCreate(
            [
                'materi_id' => $materi->id,
                'siswa_id' => $siswa->id,
            ],
            [
                'link_tugas' => $request->link_tugas,
                'catatan' => $request->catatan,
                'submitted_at' => now(),
                'status' => 'pending',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil diupload!'
        ]);
    }
}
