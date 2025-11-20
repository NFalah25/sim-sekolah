<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if($search){
            $teachers = Teacher::where('name', 'like', '%'.$search.'%')
                        ->orWhere('position', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%')
                        ->paginate(10);
            return view('Teacher.index', compact('teachers', 'search'));
        } else {
            $teachers = Teacher::paginate(10);
            return view('Teacher.index', compact('teachers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        $validated = $request->validated();

        if(isset($validated['image'])){
            $imagePath = $request->file('image')->store('images/teachers', 'public');
            $validated['image'] = $imagePath;
        }

        Teacher::create([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'motivation' => $validated['motivation'] ?? null,
            'NIP' => $validated['nip'] ?? null,
            'linkGdrive' => $validated['drive'] ?? null,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $guru)
    {
        $teacher = $guru;
        return view('Teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $guru)
    {
        $teacher = $guru;
        $validated = $request->validated();

        if(isset($validated['image'])){
            if($teacher->image){
                Storage::disk('public')->delete($teacher->image);
            }
            $imagePath = $request->file('image')->store('images/teachers', 'public');
            $validated['image'] = $imagePath;
        }

        $teacher->update([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? $teacher->image,
            'email' => $validated['email'],
            'motivation' => $validated['motivation'] ?? $teacher->motivation,
            'phone' => $validated['phone'] ?? $teacher->phone,
            'NIP' => $validated['nip'] ?? $teacher->NIP,
            'linkGdrive' => $validated['drive'] ?? $teacher->linkGdrive,
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $guru)
    {
        $teacher = $guru;
        if($teacher->image){
            Storage::disk('public')->delete($teacher->image);
        }
        $teacher->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
