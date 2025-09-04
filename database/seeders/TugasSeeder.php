<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tugas;
use Carbon\Carbon;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tugas = [
            [
                'judul' => 'Laporan Pembelajaran Bulan September',
                'deskripsi' => 'Buat laporan pembelajaran untuk bulan September 2025. Laporan harus mencakup materi yang diajarkan, metode pembelajaran, dan evaluasi hasil belajar siswa.',
                'file' => null,
                'link_drive' => 'https://drive.google.com/drive/folders/1ABC123',
                'untuk_semua_guru' => true,
                'deadline' => Carbon::now()->addDays(7),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'RPP Semester Ganjil 2025/2026',
                'deskripsi' => 'Susun Rencana Pelaksanaan Pembelajaran (RPP) untuk semester ganjil tahun ajaran 2025/2026. RPP harus sesuai dengan kurikulum yang berlaku dan mencakup semua mata pelajaran yang diampu.',
                'file' => null,
                'link_drive' => 'https://drive.google.com/drive/folders/1DEF456',
                'untuk_semua_guru' => true,
                'deadline' => Carbon::now()->addDays(14),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Evaluasi Pembelajaran Daring',
                'deskripsi' => 'Buat evaluasi tentang efektivitas pembelajaran daring yang telah dilaksanakan. Evaluasi harus mencakup kendala, solusi, dan rekomendasi untuk pembelajaran daring yang lebih baik.',
                'file' => null,
                'link_drive' => null,
                'untuk_semua_guru' => true,
                'deadline' => Carbon::now()->addDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Inovasi Metode Pembelajaran',
                'deskripsi' => 'Kembangkan inovasi metode pembelajaran yang kreatif dan inovatif. Metode harus dapat meningkatkan minat belajar siswa dan efektivitas pembelajaran.',
                'file' => null,
                'link_drive' => 'https://drive.google.com/drive/folders/1GHI789',
                'untuk_semua_guru' => true,
                'deadline' => Carbon::now()->addDays(21),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Laporan Penilaian Tengah Semester',
                'deskripsi' => 'Siapkan laporan penilaian tengah semester untuk semua mata pelajaran. Laporan harus mencakup nilai siswa, analisis hasil, dan rekomendasi perbaikan.',
                'file' => null,
                'link_drive' => null,
                'untuk_semua_guru' => true,
                'deadline' => Carbon::now()->addDays(3),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($tugas as $tugasData) {
            Tugas::create($tugasData);
        }

        $this->command->info('Sample tasks created successfully!');
    }
}
