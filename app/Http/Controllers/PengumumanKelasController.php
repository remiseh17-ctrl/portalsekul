<?php

namespace App\Http\Controllers;

use App\Models\PengumumanKelas;
use App\Models\Pengumuman;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanKelasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil pengumuman kelas yang dibuat guru
        $pengumumanKelas = PengumumanKelas::where('guru_id', $guru->id)
            ->with(['kelas'])
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Ambil kelas yang diajar guru untuk modal
        $kelas = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();

        // Jika tidak ada kelas, beri pesan peringatan
        $kelasCount = $kelas->count();

        return view('guru.pengumuman-kelas.index', compact('pengumumanKelas', 'kelas', 'kelasCount'));
    }

    public function create()
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang diajar guru
        $kelasList = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();
            
        return view('guru.pengumuman-kelas.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();

        $data = $request->only([
            'kelas_id',
            'judul',
            'isi'
        ]);
        $data['guru_id'] = $guru->id;
        $data['tanggal'] = now()->format('Y-m-d');

        PengumumanKelas::create($data);

        return redirect()->route('pengumuman-kelas.index')
            ->with('success', 'Pengumuman kelas berhasil ditambahkan!');
    }

    public function show(PengumumanKelas $pengumumanKelas)
    {
        return view('guru.pengumuman-kelas.show', compact('pengumumanKelas'));
    }

    public function edit(PengumumanKelas $pengumumanKelas)
    {
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        // Ambil kelas yang diajar guru
        $kelasList = Kelas::whereHas('jadwals', function($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();
            
        return view('guru.pengumuman-kelas.edit', compact('pengumumanKelas', 'kelasList'));
    }

    public function update(Request $request, PengumumanKelas $pengumumanKelas)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $data = $request->only([
            'kelas_id',
            'judul',
            'isi'
        ]);

        $pengumumanKelas->update($data);

        return redirect()->route('pengumuman-kelas.index')
            ->with('success', 'Pengumuman kelas berhasil diperbarui!');
    }

    public function destroy(PengumumanKelas $pengumumanKelas)
    {
        $pengumumanKelas->delete();

        return redirect()->route('pengumuman-kelas.index')
            ->with('success', 'Pengumuman kelas berhasil dihapus!');
    }

    // Method untuk siswa melihat pengumuman kelas
    public function pengumumanSiswa()
    {
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();
        
        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil pengumuman untuk kelas siswa
        $pengumumanKelas = PengumumanKelas::where('kelas_id', $siswa->kelas_id)
            ->with(['guru'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10, ['*'], 'kelas_page');

        // Ambil pengumuman admin (umum)
        $pengumumanAdmin = Pengumuman::orderBy('tanggal', 'desc')
            ->paginate(10, ['*'], 'admin_page');
            
        return view('siswa.pengumuman.index', compact('pengumumanKelas', 'pengumumanAdmin'));
    }
}
