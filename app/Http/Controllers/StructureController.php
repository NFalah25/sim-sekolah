<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Structure::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $struktur = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return view('Structure.index', compact('struktur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Structure.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStructureRequest $request)
    {
        $validate = $request->validated();

        $imagePath = $validate['image']->store('images/structure', 'public');

        Structure::create([
            'name' => $validate['title'],
            'description' => $validate['description'],
            'images' => $imagePath ?? null,
            'icon' => $validate['icon'] ?? null,
        ]);
        return redirect()->route('struktur.index')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $struktur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Structure $struktur)
    {
        return view('Structure.edit', compact('struktur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStructureRequest $request, Structure $struktur)
    {
        $validate = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $validate['image']->store('images/structure', 'public');
            $struktur->images = $imagePath;
        }

        $struktur->name = $validate['title'];
        $struktur->description = $validate['description'];
        $struktur->icon = $validate['icon'];
        $struktur->save();

        return redirect()->route('struktur.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Structure $struktur)
    {
        if(Storage::disk('public')->exists($struktur->images)){
            Storage::disk('public')->delete($struktur->images);
        }
        $struktur->delete();
        return redirect()->route('struktur.index')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
