<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Achievement::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        // if ($request->has('search')) {
        //     $achievements = Achievement::where('title', 'like', '%' . $request->search . '%')
        //         ->orWhere('description', 'like', '%' . $request->search . '%')
        //         ->paginate(5);
        // } else {
        //     $achievements = Achievement::paginate(5);
        // }
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
            'type' => 'required|string',
            'level' => 'required|string',
            'image' => 'nullable|image|max:4096', // Maksimal 4MB
        ], [], [
            'title' => 'Judul Prestasi',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
            'type' => 'Tipe Prestasi',
            'level' => 'Tingkat Prestasi',
            'image' => 'Gambar',
        ]);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images/achievement', 'public');
            $validate['image'] = $imagePath;
        }

        Achievement::create([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'date' => $validate['date'],
            'type' => $validate['type'],
            'level' => $validate['level'],
            'image' => $validate['image'] ?? null,
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
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'type' => 'required|string',
            'level' => 'required|string',
            'image' => 'nullable|image|max:4096', // Maksimal 4MB
        ], [], [
            'title' => 'Judul Prestasi',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
            'type' => 'Tipe Prestasi',
            'level' => 'Tingkat Prestasi',
            'image' => 'Gambar',
        ]);

        if($request->hasFile('image')){
            // Hapus gambar lama jika ada
            if($prestasi->image && Storage::disk('public')->exists($prestasi->image)){
                Storage::disk('public')->delete($prestasi->image);
            }
            $imagePath = $request->file('image')->store('images/achievement', 'public');
            $validate['image'] = $imagePath;
        }

        $prestasi->update([
            'title' => $validate['title'],
            'description' => $validate['description'],
            'date' => $validate['date'],
            'type' => $validate['type'],
            'level' => $validate['level'],
            'image' => $validate['image'] ?? $prestasi->image,
        ]);

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        $deleteImage = $achievement->image;
        if ($deleteImage && Storage::disk('public')->exists($deleteImage)) {
            Storage::disk('public')->delete($deleteImage);
        }
        $achievement->delete();
        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil di hapus');
    }
}
