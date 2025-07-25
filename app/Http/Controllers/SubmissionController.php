<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            'note' => 'nullable|string|max:255',
        ]);


        $student = auth()->user()->student;

        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('submission_files', $filename, 'public');

        Submission::create([
            'assignment_id' => $validatedData['assignment_id'],
            'student_id' => $student->id,
            'file_path' => $path,
            'note' => $validatedData['note'],
            'submitted_at' => now(),
        ]);

        return redirect('/assignment')->with('success', 'Tugas berhasil upload.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
