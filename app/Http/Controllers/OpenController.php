<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Tracks;
use Illuminate\Http\Request;

class OpenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function team()
    {
        $team = Team::all();
        return view('team.team', compact(['team']));
    }

    public function tracks()
    {
        $tracks = Tracks::all();
        return view('track.tracks', compact(['tracks']));
    }

    public function view($slug)
    {
        $track = Tracks::where('slug', $slug)->get()[0];
        return view('track.track', compact(['track']));
    }
}
