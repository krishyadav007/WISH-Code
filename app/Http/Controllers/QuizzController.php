<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizz;

class QuizzController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function quizz()
    {
        $questions = Quizz::inRandomOrder()->limit(3)->get();
        for ($ii = 0; $ii < count($questions); $ii++) {
            $questions[$ii]["options"] = explode(",",$questions[$ii]["options"]);
        }
        // foreach ($questions as $question){
        //     echo $question;
        // }
        return json_encode($questions);
        // return view('team.dashy', compact(['team']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function questions()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $validated = $request->validate([
        'name' => 'required|string',
        'pic' => 'required|string',
        'title' => 'required|string',
        'about' => 'required|string',
        'social' => 'required|string',
    ]);

    $team = new Team;
    $team->name = $validated['name'];
    $team->pic = $validated['pic'];
    $team->title = $validated['title'];
    $team->about = $validated['about'];
    $team->social = $validated['social'];
    $team->save();
    
    return redirect()->route('team.u.g', $team['id'])->with('status', 'Form submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $team = Team::where('id', $id)->get()[0];
        return view('team.edit', compact(['team']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'pic' => 'required|string',
            'title' => 'required|string',
            'about' => 'required|string',
            'social' => 'required',
        ]);
    
        $team = Team::where('id', $id)->get()[0];
        $team->name = $validated['name'];
        $team->pic = $validated['pic'];
        $team->title = $validated['title'];
        $team->about = $validated['about'];
        $team->social = $request['social'];
        $team->save();
        
        return redirect()->route('team.u.g', $id)->with('status', 'Form edited successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team = Team::where('id', $id);
        $team->delete();
        return redirect()->back();
    }
}
