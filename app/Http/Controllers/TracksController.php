<?php

namespace App\Http\Controllers;

use App\Models\Tracks;
use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    public function dashy()
    {
        $tracks = Tracks::all();
        return view('track.dashy', compact(['tracks']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('track.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request data
        $validated = $request->validate([
            'cover' => 'required|string',
            'slug' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'about' => 'required|string',
            'pictures' => 'required|string',
            'chair' => 'required|string',
            'members' => 'required|string',
            'reports' => 'required|string',
            'events' => 'required|string',
        ]);
        
        // Create a new track
        $track = new Tracks;
        $track->cover = $validated['cover'];
        $track->slug = $validated['slug'];
        $track->title = $validated['title'];
        $track->subtitle = $validated['subtitle'];
        $track->about = $validated['about'];
        $track->pictures = $validated['pictures'];
        $track->chair = $validated['chair'];
        $track->members = $validated['members'];
        $track->reports = $validated['reports'];
        $track->events = $validated['events'];
        $track->save();
    
    return redirect()->route('track.u.g', $track['id'])->with('status', 'Form submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $track = Tracks::where('id', $id)->get()[0];
        return view('track.edit', compact(['track']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'cover' => 'required|string',
            'slug' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'about' => 'required|string',
            'pictures' => 'required|string',
            'chair' => 'required|string',
            'members' => 'required|string',
            'reports' => 'required|string',
            'events' => 'required|string',
        ]);

        $track = Tracks::where('id', $id)->get()[0];
        $track->cover = $validated['cover'];
        $track->slug = $validated['slug'];
        $track->title = $validated['title'];
        $track->subtitle = $validated['subtitle'];
        $track->about = $validated['about'];
        $track->pictures = $validated['pictures'];
        $track->chair = $validated['chair'];
        $track->members = $validated['members'];
        $track->reports = $validated['reports'];
        $track->events = $validated['events'];
        $track->save();

        return redirect()->route('track.u.g', $id)->with('status', 'Form edited successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $track = track::where('id', $id);
        $track->delete();
        return redirect()->back();
    }
}
