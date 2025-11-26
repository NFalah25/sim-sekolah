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
        $query = Event::orderBy('date', 'desc');

        if( $request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        $events = $query->paginate(10)->appends($request->query());
        return view('Event.index', compact('events'));
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


        $insert = Event::create([
            'title' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['lokasi'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        if (!$insert) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan agenda');
        }


        return redirect()->route('acara.index')->with('success', 'Agenda berhasil ditambahkan');
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
            'description' => $validate['description'] ?? null,
            'location' => $validate['lokasi'],
            'date' => $validate['date'],
            'start_time' => $validate['start_time'],
            'end_time' => $validate['end_time'],
        ]);

        if (!$updateAcara) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui agenda');
        } else {
            return redirect()->route('acara.index')->with('success', 'Agenda berhasil diperbarui');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $acara)
    {
        $delete = $acara->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus agenda');
        } else {
            return redirect()->route('acara.index')->with('success', 'Agenda berhasil dihapus');
        }
    }
}
