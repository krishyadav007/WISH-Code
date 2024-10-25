<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        $AiController = new AiController;
        $message = $request->message;
        $intent = $AiController->intent($message);
        $msg = new Message();
        $msg->message = $request->message;
        $msg->intent = $intent;
        $msg->sentiment = "0";
        $msg->user = Auth::user()->email;
        $msg->save();
        return '{"reply":"'.$intent.'"}';
    }
}
