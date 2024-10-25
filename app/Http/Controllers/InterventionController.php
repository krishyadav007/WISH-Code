<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        $interventions = Intervention::all(); // Fetch all interventions
        return view('interventions.index', compact('interventions'));
    }

    public function create()
    {
        return view('interventions.create');
    }

    // Store a newly created intervention
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'strength' => 'required|integer',
        ]);

        // Create a new Intervention instance
        $intervention = new Intervention();

        // Assign each attribute individually
        $intervention->type = $validatedData['type'];
        $intervention->content = $validatedData['content'];
        $intervention->strength = $validatedData['strength'];

        // Save the intervention to the database
        $intervention->save();
        return redirect()->route('i.index')->with('success', 'Intervention created successfully.');
    }

    // Show form for editing an existing intervention
    public function edit($id)
    {
        // Retrieve the Intervention record by its ID
        $intervention = Intervention::findOrFail($id);
        
        // Pass the retrieved record to the view
        return view('interventions.edit', compact('intervention'));
    }

    // Update the specified intervention
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'strength' => 'required|integer',
        ]);

        // Assign each attribute individually
        $intervention = Intervention::findOrFail($id);
        $intervention->type = $request->type;
        $intervention->content = $request->content;
        $intervention->strength = $request->strength;
        $intervention->save();

        // Save the updated intervention to the database
        $intervention->save();

        return redirect()->route('i.index')->with('success', 'Intervention updated successfully.');
    }

    // Remove the specified intervention
    public function destroy($id)
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->delete();
        return redirect()->route('i.index')->with('success', 'Intervention deleted successfully.');
    }

    // Remove the specified intervention
    public function getIntervention($type)
    {
        $intervention = Intervention::where('type', $type)->inRandomOrder()->limit(1)->get();
        return $intervention;
    }
}
