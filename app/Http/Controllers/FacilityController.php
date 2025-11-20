<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Fasilitas Sekolah';
        $facilities = Facility::paginate(3);
        return view('Facility.index', compact('pageTitle', 'facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Fasilitas Sekolah';
        return view('Facility.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'facility' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $attributeNames = [
            'facility' => 'Nama Fasilitas',
            'description' => 'Deskripsi',
            'image' => 'Gambar',
        ];

        $validate = $request->validate($rules, [], $attributeNames);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = uniqid('facility_') . '.' . $image->getClientOriginalExtension();

            $fileImages = $image->storeAs('images/facilities', $imageName, 'public');

            Facility::create([
                'name' => $validate['facility'],
                'description' => $request->description,
                'image' => $fileImages, // simpan path relatif
            ]);
            return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
        }
        return back()->withErrors('Gagal mengunggah gambar. Silakan coba lagi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $fasilita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $fasilita)
    {
        return view('Facility.edit', compact('fasilita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $fasilita)
    {
        $validate = $request->validate([
            'facility' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ], [], [
            'facility' => 'Nama Fasilitas',
            'description' => 'Deskripsi',
            'image' => 'Gambar',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($fasilita->image) {
                Storage::disk('public')->delete($fasilita->image);
            }

            $image = $request->file('image');
            $imageName = uniqid('facility_') . '.' . $image->getClientOriginalExtension();
            $fileImages = $image->storeAs('images/facilities', $imageName, 'public');

            $fasilita->update([
                'name' => $validate['facility'],
                'description' => $validate['description'],
                'image' => $fileImages,
            ]);
        } else {
            $fasilita->update([
                'name' => $validate['facility'],
                'description' => $validate['description'],
            ]);
        }

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $fasilita)
    {

        if ($fasilita->image) {
            Storage::disk('public')->delete($fasilita->image);
        }

        // Hapus data fasilitas dari database
        $fasilita->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
