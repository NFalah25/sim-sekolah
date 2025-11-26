<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Extracurricular::orderBy('created_at', 'desc');

        if( $request->filled('search')){
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $ekstra = $query->paginate(5)->appends($request->query());
        return view('Extracurricular.index', compact('ekstra'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Extracurricular.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255|',
            'description' => 'required|string',
            'image' => 'required|image|max:4096|mimes:jpeg,png,jpg',
            'pembina' => 'nullable|string|max:255',
        ],[],[
            'name' => 'Nama Ekstrakurikuler',
            'description' => 'Deskripsi',
            'image' => 'Gambar',
            'pembina' => 'Pembina Ekstrakurikuler',
        ]);

        if ($request->hasFile('image')) {
            $imageStore = $request->file('image')->store('images/extracurricular', 'public');
            $validate['image'] = $imageStore;
        }
        Extracurricular::create([
            'name' => $validate['name'],
            'description' => $validate['description'],
            'image' => $validate['image'],
            'advisor' => $validate['pembina'],
        ]);
        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Extracurricular $extracurricular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extracurricular $ekstrakurikuler)
    {
        $ekstra = $ekstrakurikuler;
        return view('Extracurricular.edit', compact('ekstra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extracurricular $ekstrakurikuler)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:4096|mimes:jpeg,png,jpg',
            'advisor' => 'required|string|max:255',
        ],[],[
            'name' => 'Nama Ekstrakurikuler',
            'description' => 'Deskripsi',
            'image' => 'Gambar',
            'advisor' => 'Pembina Ekstrakurikuler',
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('images/extracurricular', 'public');
            $validate['image'] = $request->image;
        }

        $ekstrakurikuler->update([
            'name' => $validate['name'],
            'description' => $validate['description'],
            'image' => $validate['image'] ?? $ekstrakurikuler->image,
            'advisor' => $validate['advisor'],
        ]);
        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extracurricular $ekstrakurikuler)
    {
        if($ekstrakurikuler->image && Storage::disk('public')->exists($ekstrakurikuler->image)){
            Storage::disk('public')->delete($ekstrakurikuler->image);
        }
        $ekstrakurikuler->delete();
        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
