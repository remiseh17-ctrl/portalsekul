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
            ->with(['jadwal.kelas', 'kelas'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Ambil kelas yang ada di jadwal mengajar guru
        $kelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas')
            ->unique('id')
            ->sortBy('nama');

        return view('guru.materi.index', compact('materis', 'kelas'));
    }

    public function create()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil jadwal yang diajar guru
        $jadwals = Jadwal::where('guru_id', $guru->id)
            ->with(['kelas'])
            ->get();
            
        return view('guru.materi.create', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Validasi bahwa jadwal yang dipilih milik guru ini
        $jadwal = Jadwal::where('id', $request->jadwal_id)
            ->where('guru_id', $guru->id)
            ->with('kelas')
            ->first();

        if (!$jadwal) {
            return redirect()->back()
                ->with('error', 'Jadwal yang dipilih tidak valid atau bukan jadwal mengajar Anda.')
                ->withInput();
        }

        // Upload file jika ada
        $filePath = null;
        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materi', $fileName, 'public');
        }

        // Simpan materi
        Materi::create([
            'guru_id' => $guru->id,
            'jadwal_id' => $jadwal->id,
            'kelas_id' => $jadwal->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
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

        // Ambil jadwal yang diajar guru
        $jadwals = Jadwal::where('guru_id', $guru->id)
            ->with(['kelas'])
            ->get();

        // Ambil kelas yang ada di jadwal mengajar guru
        $kelas = Jadwal::where('guru_id', $guru->id)
            ->with('kelas')
            ->get()
            ->pluck('kelas')
            ->unique('id')
            ->sortBy('nama');

        return view('guru.materi.edit', compact('materi', 'jadwals', 'kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        // Validasi bahwa jadwal yang dipilih milik guru ini
        $jadwal = Jadwal::where('id', $request->jadwal_id)
            ->where('guru_id', $guru->id)
            ->with('kelas')
            ->first();

        if (!$jadwal) {
            return redirect()->back()
                ->with('error', 'Jadwal yang dipilih tidak valid atau bukan jadwal mengajar Anda.')
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

        // Update materi
        $materi->update([
            'jadwal_id' => $jadwal->id,
            'kelas_id' => $jadwal->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
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

        // Ambil materi untuk kelas siswa
        $materis = Materi::where('kelas_id', $siswa->kelas_id)
            ->with(['jadwal.guru', 'guru'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('siswa.materi.index', compact('materis'));
    }
}
