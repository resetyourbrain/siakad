<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $courses = Course::where('lecturer_id', $user->id)->get();
        $assignments = Assignment::orderBy('is_active', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('assignment', [
            'courses' => $courses,
            'assignments' => $assignments
        ]);
    }

    public function formUpload($id)
    {
        $user = Auth::user();
        $assignment = Assignment::findOrFail($id);
        return view('assignment-upload', [
            'assignment' => $assignment
        ]);
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
            'title' => 'required',
            'description' => 'required',
            'tanggal_deadline' => 'required',
            'course_id' => 'required|exists:courses,id',
        ]);

        Assignment::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'tanggal_dibuat' => now(),
            'tanggal_deadline' => Carbon::parse($validatedData['tanggal_deadline'])->setTimeFrom(Carbon::now()),
            'course_id' => $validatedData['course_id'],
        ]);

        return redirect('/assignment')->with('success', 'Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('assignments-collected', [
            'assignment' => $assignment,
            'submissions' => $assignment->submissions()->with('student')->OrderBy('submitted_at', 'desc')->get()
        ]);
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
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tanggal_deadline' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'is_active' => 'required|boolean',
        ]);
        // dd($request->all());
        $assignment = Assignment::findOrFail($id);
        $assignment->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'tanggal_deadline' => Carbon::parse($validatedData['tanggal_deadline'])->setTimeFrom(Carbon::now()),
            'course_id' => $validatedData['course_id'],
            'is_active' => (bool) $validatedData['is_active'],
        ]);

        return redirect('/assignment')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();
        return redirect('/assignment')->with('success', 'Tugas berhasil dihapus.');
    }
}
