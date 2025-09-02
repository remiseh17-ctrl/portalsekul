<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'jadwal_id',
        'guru_id',
        'kelas_id',
        'shared_kelas',
        'judul',
        'deskripsi',
        'file',
        'link_drive'
    ];

    protected $casts = [
        'shared_kelas' => 'array',
    ];

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Method untuk mendapatkan semua kelas yang bisa akses materi ini
    public function getAllKelas()
    {
        $kelas = collect();

        // Tambah kelas utama jika ada
        if ($this->kelas) {
            $kelas->push($this->kelas);
        }

        // Tambah kelas shared jika ada
        if ($this->shared_kelas) {
            $sharedKelasIds = $this->shared_kelas;
            $sharedKelas = Kelas::whereIn('id', $sharedKelasIds)->get();
            $kelas = $kelas->merge($sharedKelas);
        }

        return $kelas->unique('id');
    }

    // Method untuk cek apakah siswa bisa akses materi ini
    public function canAccessBySiswa($siswa)
    {
        // Cek kelas utama
        if ($this->kelas_id == $siswa->kelas_id) {
            return true;
        }

        // Cek shared kelas
        if ($this->shared_kelas && in_array($siswa->kelas_id, $this->shared_kelas)) {
            return true;
        }

        return false;
    }
}
