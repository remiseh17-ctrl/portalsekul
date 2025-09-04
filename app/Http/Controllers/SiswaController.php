<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // Require kelas_id parameter to prevent loading all students
        if (!$request->filled('kelas_id')) {
            return redirect()->route('kelas.index')->with('error', 'Silakan pilih kelas terlebih dahulu untuk mengelola siswa.');
        }

        // Validate that kelas_id exists
        $kelas = Kelas::find($request->kelas_id);
        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Kelas tidak ditemukan.');
        }

        $query = Siswa::with(['kelas', 'user']); // Include user relationship
        if ($request->filled('q')) {
            $query->where('nama', 'like', '%'.$request->q.'%');
        }
        $query->where('kelas_id', $request->kelas_id); // Always filter by kelas_id
        $siswas = $query->orderBy('nama')->paginate(10);
        $kelasList = Kelas::all();
        return view('siswa.index', compact('siswas', 'kelasList', 'kelas'));
    }

    public function create()
    {
        $kelasList = Kelas::all();
        return view('siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        // Debug: Log the received NIS value
        \Log::info('Received NIS: "' . $request->nis . '" (length: ' . strlen($request->nis) . ')');
        
        $validated = $request->validate([
            'nis' => 'required|digits:8|unique:siswas,nis|unique:users,username',
            'nama' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ], [
            'nis.digits' => 'NIS harus tepat 8 digit angka (contoh: 12345678)',
            'nis.unique' => 'NIS sudah terdaftar, gunakan NIS yang berbeda',
        ]);
        
        // Use database transaction to ensure data consistency
        return \DB::transaction(function () use ($request, $validated) {
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('foto_siswa', 'public');
            }
            
            $password = date('Ymd', strtotime($validated['tanggal_lahir']));
            
            // Create user account first
            $user = \App\Models\User::create([
                'name' => $validated['nama'],
                'username' => $validated['nis'],
                'role' => 'siswa',
                'password' => bcrypt($password),
            ]);
            
            // Create siswa record with user_id
            $validated['user_id'] = $user->id;
            Siswa::create($validated);
            
            return redirect()->route('siswa.index', ['kelas_id' => $validated['kelas_id']])
                           ->with('success', 'Siswa & akun berhasil ditambahkan. Password awal: ' . $password);
        });
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelasList = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:siswas,nis,'.$siswa->id,
            'nama' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            if ($siswa->foto) Storage::disk('public')->delete($siswa->foto);
            $validated['foto'] = $request->file('foto')->store('foto_siswa', 'public');
        }
        $siswa->update($validated);
        return redirect()->route('siswa.index', ['kelas_id' => $siswa->kelas_id])
                        ->with('success', 'Siswa berhasil diupdate.');
    }

    public function destroy(Siswa $siswa)
    {
        // Store kelas_id before deletion for redirect
        $kelasId = $siswa->kelas_id;

        // Delete associated user account
        if ($siswa->user) {
            $siswa->user->delete();
        }

        // Delete siswa photo if exists
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        // Redirect back to siswa.index with kelas_id parameter
        return redirect()->route('siswa.index', ['kelas_id' => $kelasId])
                        ->with('success', 'Siswa & akun berhasil dihapus.');
    }

    /**
     * Import students from Excel file
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:5120', // 5MB max
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        try {
            $kelas = Kelas::findOrFail($request->kelas_id);

            // Create import instance
            $import = new SiswaImport($request->kelas_id);

            // Import the file
            Excel::import($import, $request->file('file'));

            // Get results
            $results = $import->getResults();

            // Prepare success message
            $message = "Import selesai! {$results['success_count']} siswa berhasil diimpor.";

            if ($results['error_count'] > 0) {
                $message .= " {$results['error_count']} data gagal diimpor.";
                // Store errors in session for display
                session()->flash('import_errors', $results['errors']);
            }

            return redirect()->route('siswa.index', ['kelas_id' => $request->kelas_id])
                           ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    /**
     * Download Excel template
     */
    public function downloadTemplate()
    {
        $filePath = public_path('templates/siswa_import_template.xlsx');

        // Create template if it doesn't exist
        if (!file_exists($filePath)) {
            $this->createTemplate();
        }

        return response()->download($filePath, 'template_import_siswa.xlsx');
    }

    /**
     * Create Excel template
     */
    private function createTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = ['nis', 'nama', 'tanggal_lahir', 'jurusan', 'alamat', 'no_hp'];
        foreach ($headers as $index => $header) {
            $sheet->setCellValueByColumnAndRow($index + 1, 1, $header);
            $sheet->getStyleByColumnAndRow($index + 1, 1)->getFont()->setBold(true);
        }

        // Add sample data
        $sampleData = [
            ['12345678', 'Ahmad Surya', '2005-05-15', 'IPA', 'Jl. Sudirman No. 123', '081234567890'],
            ['87654321', 'Siti Aminah', '2005-08-20', 'IPS', 'Jl. Diponegoro No. 456', '081987654321'],
        ];

        foreach ($sampleData as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 2, $value);
            }
        }

        // Auto size columns
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create directory if it doesn't exist
        $templateDir = public_path('templates');
        if (!file_exists($templateDir)) {
            mkdir($templateDir, 0755, true);
        }

        // Save file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save(public_path('templates/siswa_import_template.xlsx'));
    }
}
