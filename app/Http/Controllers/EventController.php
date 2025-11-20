<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $events = Event::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orderBy('start_date', 'desc')
                ->paginate(10)
                ->withQueryString();
            return view('Event.index', compact('events'));
        } else {
            $events = Event::orderBy('start_date', 'desc')->paginate(10);
            return view('Event.index', compact('events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();


        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', trim(explode(' - ', $validated['date_range'])[0]) . ' ' . $validated['start_time']);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', trim(explode(' - ', $validated['date_range'])[1]) . ' ' . $validated['end_time']);

        $insert = Event::create([
            'title' => $validated['name'],
            'description' => $validated['description'],
            'location' => $validated['lokasi'],
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'category' => $validated['category'],
            'color' => $validated['color'],
        ]);

        if (!$insert) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan acara');
        }


        return redirect()->route('acara.index')->with('success', 'Acara berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $acara)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $acara)
    {
        return view('Event.edit', compact('acara'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $acara)
    {
        $validate = $request->validated();
        $updateAcara = $acara->update([
            'title' => $validate['name'],
            'description' => $validate['description'],
            'location' => $validate['lokasi'],
            'start_date' => Carbon::createFromFormat('Y-m-d H:i', trim(explode(' - ', $validate['date_range'])[0]) . ' ' . $validate['start_time']),
            'end_date' => Carbon::createFromFormat('Y-m-d H:i', trim(explode(' - ', $validate['date_range'])[1]) . ' ' . $validate['end_time']),
            'category' => $validate['category'],
            'color' => $validate['color'],
        ]);

        if (!$updateAcara) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui acara');
        } else {
            return redirect()->route('acara.index')->with('success', 'Acara berhasil diperbarui');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $acara)
    {
        $delete = $acara->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus acara');
        } else {
            return redirect()->route('acara.index')->with('success', 'Acara berhasil dihapus');
        }
    }
}
