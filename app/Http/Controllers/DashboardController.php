<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Event;
use App\Models\Facility;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $fasilitas = Facility::count();
        $berita = News::whereMonth('created_at', now()->month)->where('status', 1)->count();
        $agenda = Event::where('date', '>=', now())->count();
        $prestasi = Achievement::whereYear('date', now()->year)->count();

        return view('Auth.dashboard', compact('fasilitas', 'berita', 'agenda', 'prestasi'));
    }
}
