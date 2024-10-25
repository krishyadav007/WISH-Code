<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Attempt;
use App\Models\TeacherFeedback;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function dashboard()
    {
        $mail = Auth::user()->email;
        $msg_count = count(Message::where('user', $mail)->get());
        $aptitude_count = count(Attempt::where('user', $mail)->where('type', "aptitude")->get());
        $likert_count = count(Attempt::where('user', $mail)->where('type', "likert")->get());
        $teacher_count = count(TeacherFeedback::where('student_email', $mail)->get());
        return view('dashboard',compact(["msg_count","aptitude_count","likert_count","teacher_count"]));
    }
}
