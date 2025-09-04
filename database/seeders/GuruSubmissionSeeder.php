<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuruSubmission;
use App\Models\Guru;
use App\Models\Tugas;
use Carbon\Carbon;

class GuruSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guru = Guru::first();
        $tugas = Tugas::first();
        
        if ($guru && $tugas) {
            GuruSubmission::create([
                'tugas_id' => $tugas->id,
                'guru_id' => $guru->id,
                'komentar' => 'Laporan pembelajaran bulan September telah selesai dibuat sesuai dengan materi yang diajarkan.',
                'file' => null,
                'link_drive' => 'https://drive.google.com/drive/folders/1XYZ789',
                'status' => 'submitted',
                'submitted_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ]);
            
            $this->command->info('Sample guru submission created successfully!');
        } else {
            $this->command->error('Guru or Tugas not found. Please run TugasSeeder first.');
        }
    }
}
