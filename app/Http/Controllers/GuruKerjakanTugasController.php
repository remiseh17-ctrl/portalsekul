<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\GuruSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuruKerjakanTugasController extends Controller
{
    /**
     * Display a listing of tasks assigned to the teacher
     */
    public function index()
    {
        // Get all tasks since they are for all teachers
        $tugas = Tugas::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('guru.kerjakan-tugas.index', compact('tugas'));
    }

    /**
     * Display the specified task for the teacher to work on
     */
    public function show(Tugas $tugas)
    {
        $user = Auth::user();
        $guru = \App\Models\Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        // Check if teacher has already submitted
        $submission = GuruSubmission::where('tugas_id', $tugas->id)
            ->where('guru_id', $guru->id)
            ->first();
        
        return view('guru.kerjakan-tugas.show', compact('tugas', 'submission'));
    }

    /**
     * Show the form for submitting task work
     */
    public function submit(Tugas $tugas)
    {
        $user = Auth::user();
        $guru = \App\Models\Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        // Check if already submitted
        $submission = GuruSubmission::where('tugas_id', $tugas->id)
            ->where('guru_id', $guru->id)
            ->first();
        
        if ($submission) {
            return redirect()->route('guru.kerjakan-tugas.show', $tugas)
                ->with('info', 'Anda sudah mengumpulkan tugas ini');
        }

        return view('guru.kerjakan-tugas.submit', compact('tugas'));
    }

    /**
     * Store the submitted task work
     */
    public function store(Request $request, Tugas $tugas)
    {
        $user = Auth::user();
        $guru = \App\Models\Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $request->validate([
            'komentar' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240',
            'link_drive' => 'nullable|url',
        ]);

        // Check if already submitted
        $existingSubmission = GuruSubmission::where('tugas_id', $tugas->id)
            ->where('guru_id', $guru->id)
            ->first();
        
        if ($existingSubmission) {
            return redirect()->route('guru.kerjakan-tugas.show', $tugas)
                ->with('error', 'Anda sudah mengumpulkan tugas ini');
        }

        $data = [
            'tugas_id' => $tugas->id,
            'guru_id' => $guru->id,
            'komentar' => $request->komentar,
            'link_drive' => $request->link_drive,
            'status' => 'submitted',
            'submitted_at' => now(),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $guru->nama . '_' . $file->getClientOriginalName();
            $file->storeAs('public/submissions', $filename);
            $data['file'] = 'submissions/' . $filename;
        }

        GuruSubmission::create($data);

        return redirect()->route('guru.kerjakan-tugas.show', $tugas)
            ->with('success', 'Tugas berhasil dikumpulkan');
    }

    /**
     * Show the form for editing submission
     */
    public function edit(Tugas $tugas)
    {
        $user = Auth::user();
        $guru = \App\Models\Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $submission = GuruSubmission::where('tugas_id', $tugas->id)
            ->where('guru_id', $guru->id)
            ->first();
        
        if (!$submission) {
            return redirect()->route('guru.kerjakan-tugas.show', $tugas)
                ->with('error', 'Tugas belum dikumpulkan');
        }

        return view('guru.kerjakan-tugas.edit', compact('tugas', 'submission'));
    }

    /**
     * Update the submission
     */
    public function update(Request $request, Tugas $tugas)
    {
        $user = Auth::user();
        $guru = \App\Models\Guru::where('user_id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $submission = GuruSubmission::where('tugas_id', $tugas->id)
            ->where('guru_id', $guru->id)
            ->first();
        
        if (!$submission) {
            return redirect()->route('guru.kerjakan-tugas.show', $tugas)
                ->with('error', 'Tugas belum dikumpulkan');
        }

        $request->validate([
            'komentar' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240',
            'link_drive' => 'nullable|url',
        ]);

        $data = [
            'komentar' => $request->komentar,
            'link_drive' => $request->link_drive,
            'updated_at' => now(),
        ];

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($submission->file) {
                Storage::delete('public/' . $submission->file);
            }
            
            $file = $request->file('file');
            $filename = time() . '_' . $guru->nama . '_' . $file->getClientOriginalName();
            $file->storeAs('public/submissions', $filename);
            $data['file'] = 'submissions/' . $filename;
        }

        $submission->update($data);

        return redirect()->route('guru.kerjakan-tugas.show', $tugas)
            ->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Download the task file
     */
    public function download(Tugas $tugas)
    {
        if (!$tugas->file) {
            return redirect()->back()->with('error', 'File tidak tersedia');
        }

        $path = storage_path('app/public/' . $tugas->file);
        
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }

    /**
     * Download the submission file
     */
    public function downloadSubmission(GuruSubmission $submission)
    {
        if (!$submission->file) {
            return redirect()->back()->with('error', 'File tidak tersedia');
        }

        $path = storage_path('app/public/' . $submission->file);
        
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }
} 