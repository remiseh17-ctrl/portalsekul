<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Throwable;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    private $kelasId;
    private $errors = [];
    private $successCount = 0;
    private $errorCount = 0;

    public function __construct($kelasId)
    {
        $this->kelasId = $kelasId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip empty rows
        if (empty($row['nis']) || empty($row['nama'])) {
            return null;
        }

        try {
            return DB::transaction(function () use ($row) {
                // Check if NIS already exists
                $existingUser = User::where('username', $row['nis'])->first();
                if ($existingUser) {
                    $this->errors[] = "NIS {$row['nis']} sudah terdaftar";
                    $this->errorCount++;
                    return null;
                }

                // Check if student already exists
                $existingSiswa = Siswa::where('nis', $row['nis'])->first();
                if ($existingSiswa) {
                    $this->errors[] = "Siswa dengan NIS {$row['nis']} sudah ada";
                    $this->errorCount++;
                    return null;
                }

                // Create user account
                $tanggalLahir = isset($row['tanggal_lahir']) ? date('Y-m-d', strtotime($row['tanggal_lahir'])) : date('Y-m-d');
                $password = date('Ymd', strtotime($tanggalLahir));

                $user = User::create([
                    'name' => $row['nama'],
                    'username' => $row['nis'],
                    'role' => 'siswa',
                    'password' => Hash::make($password),
                ]);

                // Create student record
                $siswa = new Siswa([
                    'user_id' => $user->id,
                    'nis' => $row['nis'],
                    'nama' => $row['nama'],
                    'kelas_id' => $this->kelasId,
                    'tanggal_lahir' => $tanggalLahir,
                    'jurusan' => $row['jurusan'] ?? null,
                    'alamat' => $row['alamat'] ?? null,
                    'no_hp' => $row['no_hp'] ?? null,
                ]);

                $this->successCount++;
                return $siswa;
            });
        } catch (Throwable $e) {
            $this->errors[] = "Error pada NIS {$row['nis']}: " . $e->getMessage();
            $this->errorCount++;
            return null;
        }
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'nis' => 'required|digits:8|unique:siswas,nis|unique:users,username',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages()
    {
        return [
            'nis.required' => 'NIS wajib diisi',
            'nis.digits' => 'NIS harus tepat 8 digit',
            'nis.unique' => 'NIS sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi (digunakan untuk password)',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'jurusan.max' => 'Jurusan maksimal 100 karakter',
            'no_hp.max' => 'No HP maksimal 20 karakter',
        ];
    }

    /**
     * Handle import errors
     */
    public function onError(Throwable $e)
    {
        $this->errors[] = 'Error: ' . $e->getMessage();
        $this->errorCount++;
    }

    /**
     * Handle import failures
     */
    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->errors[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            $this->errorCount++;
        }
    }

    /**
     * Get import results
     */
    public function getResults()
    {
        return [
            'success_count' => $this->successCount,
            'error_count' => $this->errorCount,
            'errors' => $this->errors,
        ];
    }
}
