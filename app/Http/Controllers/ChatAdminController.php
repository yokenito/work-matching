<?php

namespace App\Http\Controllers;

use App\Events\ChatCreated;
use App\Models\Chatsoket;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatAdminController extends Controller
{
    public function index(Proposal $proposal){
        $chats = Chatsoket::where('proposal_id','=',$proposal->id)->orderByDesc('id')->limit(10)->oldest()->get();
        $chats = $chats->reverse();
        Log::debug($proposal);
        $user_id = Auth::id();
        return view('chatadmin.index', compact('chats','user_id','proposal'));
    }

    public function list(){
        return Chatsoket::orderBy('id', 'asc')->get();
    }

    public function create(){
        $chat = Chatsoket::create([
            'proposal_id' => 4,
            'user_id' => Auth::id(),
            'message' => $_POST['send_message']
        ]);
        
        ChatCreated::dispatch($chat);

        return $chat;
    }
}
