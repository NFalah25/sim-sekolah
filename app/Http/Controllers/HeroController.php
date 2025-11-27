<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Http\Requests\StoreHeroRequest;
use App\Http\Requests\UpdateHeroRequest;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = Hero::paginate(10);
        return view('bg-hero.index', compact('heroes'));
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
    public function store(StoreHeroRequest $request)
    {
        $validated = $request->validated();
        $image = $validated['image']->store('hero-images', 'public');
        Hero::create(['image' => $image]);
        return redirect()->route('hero.index')->with('success', 'Gambar hero berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroRequest $request, Hero $hero)
    {
        $validated = $request->validated();
        if (isset($validated['image'])) {
            $image = $validated['image']->store('hero-images', 'public');
            $hero->update(['image' => $image]);
        }
        return redirect()->route('hero.index')->with('success', 'Gambar hero berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        $imageDelete = $hero->image;
        if (Storage::disk('public')->exists($imageDelete)) {
            Storage::disk('public')->delete($imageDelete);
        }
        $hero->delete();
        return redirect()->route('hero.index')->with('success', 'Gambar hero berhasil dihapus.');
    }
}
