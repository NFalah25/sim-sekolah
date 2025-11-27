<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Hero;
use App\Models\News;
use App\Models\Structure;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    public function index()
    {
        $news = Cache::remember('news', 600, function () {
            $news = News::where('status', 1)->latest()->take(6)->get();
            return $news;
        });
        $facilities = Cache::remember('facilities', 600, function () {
            return Facility::latest()->take(6)->get();
        });
        $achievements = Cache::remember('achievements', 600, function () {
            $achievements = Achievement::orderBy('date', 'desc')->take(6)->get();
            return $achievements;
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

        $announcements = Announcement::select('title', 'description', 'date_published')->where('is_pinned', true)->orderBy('date_published', 'desc')->get();
        $pastEvent = Event::select('title', 'date', 'start_time', 'end_time')
            ->where('date', '<', Carbon::today()) // Tanggal sebelum hari ini
            ->orderBy('date', 'desc')             // Urutkan dari yang terbaru (paling dekat dengan hari ini)
            ->take(1)
            ->get(); // Hasilnya adalah Laravel Collection dengan maksimal 1 item

        $pastEvents = Event::select('title', 'date', 'start_time', 'end_time')
            ->where('date', '<', Carbon::today()) // Tanggal sebelum hari ini
            ->orderBy('date', 'desc')
            ->take(1)
            ->get();

        // --- 2. Hitung Kekurangan Slot ---
        // Jika pastEvents punya 1 data, kita butuh 3 data masa depan (4 - 1 = 3)
        // Jika pastEvents punya 0 data, kita butuh 4 data masa depan (4 - 0 = 4)
        $neededFutureCount = 4 - $pastEvents->count();

        // --- 3. Query untuk Data Masa Depan (Jumlah Dinamis) ---
        $futureEvents = Event::select('title', 'date', 'start_time', 'end_time')
            ->where('date', '>=', Carbon::today()) // Tanggal hari ini atau setelahnya
            ->orderBy('date', 'asc')
            ->take($neededFutureCount) // Ambil sesuai kebutuhan yang sudah dihitung
            ->get();

        // --- 4. Gabungkan dan Urutkan ---
        // Gunakan concat() agar tidak ada penimpaan (overwriting) indeks
        $events = $pastEvents->concat($futureEvents)->sortBy('date');

        $heroes = Hero::orderBy('created_at', 'asc')->get();

        return view('Homepage.index', compact('news', 'facilities', 'achievements', 'events', 'teachers', 'announcements', 'heroes'));
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

        $berita = $query->where('status', 1)->paginate(8)->appends($request->query());

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

    public function pengumuman(Request $request)
    {
        $search = $request->query('q');
        $type = $request->query('type');
        $category = $request->query('category');

        // Query Pengumuman
        $queryPengumuman = Announcement::query();

        if ($search) {
            $queryPengumuman->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($category) {
            $catArray = explode(',', $category);
            $queryPengumuman->whereIn('category', $catArray);
        }

        $queryPengumuman->orderBy('is_pinned', 'desc')
            ->orderBy('date_published', 'desc');

        $announcements = ($type !== 'agenda') ? $queryPengumuman->paginate(3, ['*'], 'page_announcement')->withQueryString() : collect([]);

        // Query Agenda
        $queryAgenda = Event::query();

        if ($search) {
            $queryAgenda->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $queryAgenda->orderBy('date', 'asc');

        $events = ($type !== 'pengumuman') ? $queryAgenda->paginate(3, ['*'], 'page_agenda')->withQueryString() : collect([]);


        return view('Menu.pengumuman', compact('announcements', 'events'));
    }

    public function struktur()
    {
        $struktur = Structure::select('id', 'name', 'description', 'images', 'icon')->get();

        $jsonStruktur = $struktur->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->name,
                'description' => $item->description,
                'images' => $item->images ? asset('storage/' . $item->images) : null,
                'icon' => $item->icon,
            ];
        });

        return view('Menu.struktur', compact('jsonStruktur'));
    }
}
