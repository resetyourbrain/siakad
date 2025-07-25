<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $courses = Course::where('lecturer_id', $user->id)->get();
        $materials = Material::orderBy('id', 'desc')
            ->get();

        return view('material', [
            'courses' => $courses,
            'materials' => $materials
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
            'course_id' => 'required|exists:courses,id',
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg,ppt,pptx|max:2048',
        ]);

        $lecturer = auth()->user()->lecturer;

        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('material_files', $filename, 'public');

        Material::create([
            'course_id' => $validatedData['course_id'],
            'lecturer_id' => $lecturer->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => $path,
            'published_at' => now(),
        ]);

        return redirect('/material')->with('success', 'Materi berhasil ditambahkan.');
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
        $material = Material::findOrFail($id);

        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect('/material')->with('success', 'Materi berhasil dihapus.');
    }
}
