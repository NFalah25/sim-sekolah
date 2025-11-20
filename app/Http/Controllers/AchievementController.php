<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $achievements = Achievement::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->paginate(5);
        } else {
            $achievements = Achievement::paginate(5);
        }
        return view('Achievement.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ], [], [
            'title' => 'Judul Prestasi',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
        ]);

        Achievement::create([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'date' => $validate['date'],
        ]);

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $prestasi)
    {
        return view('Achievement.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $prestasi)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        //
    }
}
