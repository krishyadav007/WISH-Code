<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TeacherFeedback;

class TeacherFeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Display a listing of the resource
    public function index()
    {
        $feedbacks = TeacherFeedback::all();
        return view('tf.index', compact('feedbacks'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('tf.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'student_email' => 'required|email',
            'interest' => 'required|integer',
            'message' => 'nullable|string',
        ]);

        $feedback = new TeacherFeedback();
        $feedback->user_email = Auth::user()->email;
        $feedback->student_email = $request->student_email;
        $feedback->interest = $request->interest;
        $feedback->message = $request->message;
        $feedback->save();

        return redirect()->route('tf.index')->with('success', 'Feedback submitted successfully.');
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $feedback = TeacherFeedback::findOrFail($id);
        return view('tf.edit', compact('feedback'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_email' => 'required|email',
            'interest' => 'required|integer',
            'message' => 'nullable|string',
        ]);

        $feedback = TeacherFeedback::findOrFail($id);
        $feedback->student_email = $request->student_email;
        $feedback->interest = $request->interest;
        $feedback->message = $request->message;
        $feedback->save();

        return redirect()->route('tf.index')->with('success', 'Feedback updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $feedback = TeacherFeedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('tf.index')->with('success', 'Feedback deleted successfully.');
    }
}
