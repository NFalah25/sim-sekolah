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
            $queryEvent = Event::where(function ($query) {
                $query->whereDate('start_date', '>=', now())
                    ->orWhereDate('end_date', '>=', now()->subMonth());
            })->orderBy('start_date', 'asc')->get();
            $dataEvents = [];
            foreach ($queryEvent as $event) {
                $startTime = Carbon::parse($event->start_date)->format('H:i');
                $endTime = Carbon::parse($event->end_date)->format('H:i');
                $dataEvents[] = [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'location' => $event->location,
                    'category' => $event->category,
                    'hasEvent' => true,
                    'time' => $startTime . ' - ' . $endTime,
                    'markerColor' => $event->color,
                    'startDate' => Carbon::parse($event->start_date)->format('Y-m-d'),
                    'endDate' => Carbon::parse($event->end_date)->format('Y-m-d'),
                ];
            }
            return $dataEvents;
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
        if ($request->has('search')) {
            $guru = Teacher::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('position', 'like', '%' . $request->search . '%')
                ->select('name', 'position', 'motivation', 'image')
                ->paginate(1);
            return view('Menu.guru', compact('guru'));
        } else {
            $guru = Teacher::select('name', 'position', 'motivation', 'image')->paginate(1);
            return view('Menu.guru', compact('guru'));
        }
    }

    public function berita(Request $request)
    {

        if ($request->has('search')) {
            $berita = News::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%')
                ->select('title', 'content', 'image', 'created_at')
                ->paginate(8);
        } else {
            $berita = News::select('title', 'content', 'image', 'created_at')->paginate(8);
        }

        return view('Menu.berita', compact('berita'));
    }

    public function ekstrakurikuler(Request $request)
    {
        if ($request->has('search')) {
            $ekstrakurikuler = Extracurricular::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->select('name', 'description', 'image')
                ->paginate(3);
            return view('Menu.ekstrakurikuler', compact('ekstrakurikuler'));
        } else {
            $ekstrakurikuler = Extracurricular::select('name', 'description', 'image')->paginate(3);
            return view('Menu.ekstrakurikuler', compact('ekstrakurikuler'));
        }
    }

    public function prestasi(Request $request)
    {
        if ($request->has('search')) {
            $prestasi = Achievement::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->select('title', 'description', 'image', 'date')
                ->paginate(8);
            return view('Menu.prestasi', compact('prestasi'));
        } else {
            $prestasi = Achievement::select('title', 'description', 'image', 'date')->paginate(8);
            return view('Menu.prestasi', compact('prestasi'));
        }
    }

    public function pengumuman()
    {
        return view('Menu.pengumuman');
    }

}
