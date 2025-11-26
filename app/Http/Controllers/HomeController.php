<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Event;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\News;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    public function index()
    {
        $news = Cache::remember('news', 600, function () {
            return News::latest()->take(6)->get();
        });
        $facilities = Cache::remember('facilities', 600, function () {
            return Facility::latest()->take(6)->get();
        });
        $achievements = Cache::remember('achievements', 600, function () {
            return Achievement::latest()->take(6)->get();
        });
        $events = Cache::remember('events', 600, function () {
            return Event::where('date', '>=', Carbon::now())->orderBy('date', 'asc')->take(6)->get();
        });

        $teachers = Cache::remember('teachers', 1, function () {
            $color = ['red', 'blue', 'green', 'yellow', 'purple', 'pink', 'indigo', 'gray', 'teal', 'cyan'];

            // Gunakan with() jika nanti ada relasi, dan gunakan get() untuk eksekusi
            $queryTeachers = Teacher::all();
            $dataTeachers = [];

            foreach ($queryTeachers as $teacher) {
                // Inisialisasi data dasar
                $data = [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'motivation' => $teacher->motivation,
                    // Ambil warna secara acak untuk setiap guru
                    'color' => $color[array_rand($color)],
                    'position' => $teacher->position,
                ];

                if ($teacher->image == null) {
                    // Ambil nama awal untuk inisial jika tidak ada gambar
                    $nameParts = explode(' ', $teacher->name);
                    $initials = '';
                    // Ambil maksimal dua inisial pakai spasi sebagai pemisah, huruf terakhir tanpa spasi
                    for ($i = 0; $i < min(2, count($nameParts)); $i++) {
                        $initials .= strtoupper(substr($nameParts[$i], 0, 1));
                        if ($i == 0 && count($nameParts) > 1) {
                            $initials .= ' ';
                        }
                    }
                    // Tambahkan data 'initial' tanpa menimpa $teacher->image
                    $data['initial'] = $initials;
                } else {
                    // Tambahkan data 'image'
                    $data['image'] = asset('storage/' . $teacher->image);
                }

                $dataTeachers[] = $data;
            }

            return $dataTeachers;
        });


        return view('Homepage.index', compact('news', 'facilities', 'achievements', 'events', 'teachers'));
    }

    public function visiMisi()
    {
        return view('Menu.visimisi');
    }

    public function fasilitas()
    {
        $fasilitas = Facility::select('name', 'image', 'description')->paginate(3);


        return view('Menu.fasilitas', compact('fasilitas'));
    }

    public function guru(Request $request)
    {
        $query = Teacher::select('name', 'position', 'motivation', 'image');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('position', 'like', '%' . $search . '%');
            });
        }

        $guru = $query->paginate(6)->appends($request->query());
        return view('Menu.guru', compact('guru'));
    }

    public function berita(Request $request)
    {

        $query = News::select('title', 'content', 'image', 'created_at');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $berita = $query->paginate(8)->appends($request->query());

        return view('Menu.berita', compact('berita'));
    }

    public function ekstrakurikuler(Request $request)
    {

        $query = Extracurricular::select('name', 'description', 'image');
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $ekstrakurikuler = $query->paginate(6)->appends($request->query());
        return view('Menu.ekstrakurikuler', compact('ekstrakurikuler'));
    }

    public function prestasi(Request $request)
    {
        $query = Achievement::select('title', 'date', 'level', 'type', 'description', 'image');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('level', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%');
            });
        }

        $prestasi = $query->paginate(6)->appends($request->query());
        return view('Menu.prestasi', compact('prestasi'));
    }

    public function pengumuman()
    {
        return view('Menu.pengumuman');
    }
}
