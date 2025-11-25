<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        switch ($status) {
            case 'published':
                $news = News::where('status', 1)->paginate(5);
                if ($search) {
                    $news = News::where('status', 1)
                        ->where('title', 'like', '%' . $search . '%')
                        ->paginate(5);
                }
                return view('News.index', compact('news'));
            case 'draft':
                $news = News::where('status', 2)->paginate(5);
                if ($search) {
                    $news = News::where('status', 2)
                        ->where('title', 'like', '%' . $search . '%')
                        ->paginate(5);
                }
                return view('News.index', compact('news'));
            default:
                if($search) {
                    $news = News::where('title', 'like', '%' . $search . '%')->paginate(5);
                    return view('News.index', compact('news'));
                }
                break;
        }

        $news = News::paginate(5);
        return view('News.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('News.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/news', 'public');
            $data['image'] = $imagePath;
        }


        News::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'status' => 1,
            'image' => $data['image'],
        ]);

        return redirect()->route('berita.index')->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $beritum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $beritum)
    {
        $berita = $beritum;
        return view('News.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $beritum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $beritum)
    {
        $deleteImage = $beritum->image;
        if ($deleteImage && Storage::disk('public')->exists($deleteImage)) {
            Storage::disk('public')->delete($deleteImage);
        }
        $beritum->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil di hapus');
    }

    public function storeDraft(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'description' => 'nullable|string|max:100',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/news', 'public');
            $validatedData['image'] = $imagePath;
        }

        News::create([
            'title' => $validatedData['judul'],
            'description' => $validatedData['description'] ?? '',
            'content' => $validatedData['content'] ?? '',
            'status' => 2,
            'image' => $validatedData['image'] ?? null,
        ]);

        return redirect()->route('berita.index')->with('warning', 'Berita disimpan sebagai draft.');

    }

    public function updateDraft(Request $request, News $beritum)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'description' => 'nullable|string|max:100',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/news', 'public');
            $validatedData['image'] = $imagePath;
        }

        $beritum->update([
            'title' => $validatedData['judul'],
            'description' => $validatedData['description'] ?? '',
            'content' => $validatedData['content'] ?? '',
            'status' => 2,
            'image' => $validatedData['image'] ?? $beritum->image,
        ]);

        return redirect()->route('berita.index')->with('warning', 'Berita draft berhasil diperbarui.');
    }
}
