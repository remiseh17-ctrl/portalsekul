<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\GuruSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminTugasGuruController extends Controller
{
    /**
     * Display a listing of admin tasks for teachers
     */
    public function index()
    {
        $tugas = Tugas::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.tugas-guru.index', compact('tugas'));
    }

    /**
     * Show the form for creating a new admin task
     */
    public function create()
    {
        return view('admin.tugas-guru.create');
    }

    /**
     * Store a newly created admin task
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
            'link_drive' => 'nullable|url',
            'deadline' => 'nullable|date|after:today',
        ]);

        $data = $request->all();
        $data['untuk_semua_guru'] = true; // Default untuk semua guru
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tugas', $filename);
            $data['file'] = 'tugas/' . $filename;
        }

        Tugas::create($data);

        return redirect()->route('admin-tugas-guru.index')->with('success', 'Tugas berhasil dibuat');
    }

    /**
     * Display the specified admin task
     */
    public function show(Tugas $admin_tugas_guru)
    {
        $tugas = $admin_tugas_guru;
        return view('admin.tugas-guru.show', compact('tugas'));
    }

    /**
     * Show the form for editing the specified admin task
     */
    public function edit(Tugas $admin_tugas_guru)
    {
        $tugas = $admin_tugas_guru;
        return view('admin.tugas-guru.edit', compact('tugas'));
    }

    /**
     * Update the specified admin task
     */
    public function update(Request $request, Tugas $admin_tugas_guru)
    {
        $tugas = $admin_tugas_guru;

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
            'link_drive' => 'nullable|url',
            'deadline' => 'nullable|date|after:today',
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($tugas->file) {
                Storage::delete('public/' . $tugas->file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tugas', $filename);
            $data['file'] = 'tugas/' . $filename;
        }

        $tugas->update($data);

        return redirect()->route('admin-tugas-guru.index')->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Remove the specified admin task
     */
    public function destroy(Tugas $admin_tugas_guru)
    {
        $tugas = $admin_tugas_guru;

        // Delete file if exists
        if ($tugas->file) {
            Storage::delete('public/' . $tugas->file);
        }

        $tugas->delete();

        return redirect()->route('admin-tugas-guru.index')->with('success', 'Tugas berhasil dihapus');
    }

    /**
     * Download the task file
     */
    public function download(Tugas $admin_tugas_guru)
    {
        $tugas = $admin_tugas_guru;

        if (!$tugas->file) {
            return redirect()->back()->with('error', 'File tidak tersedia');
        }

        $path = storage_path('app/public/' . $tugas->file);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }
} 