<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proposal $proposal)
    {
        $chats = Chat::where('proposal_id','=',$proposal->id)->get();
        $user_id = Auth::id();
        return view('chats.index', compact('chats','user_id','proposal'));
    }
    public function index2(Proposal $proposal)
    {
        $chats = Chat::where('proposal_id','=',$proposal->id)->get();
        $user_id = Auth::id();
        $chat_count = $chats->count();
        $count = 0;
        return view('chats.index2', compact('chats','user_id','proposal','chat_count','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function sendmessage($proposal_id){
        if($_POST['send_message'] != null){
            $chat = new Chat();
            $chat->proposal_id = $proposal_id;
            $chat->user_id = Auth::id();
            $chat->message = $_POST['send_message'];
            $chat->save();
        }
        return;
    }
}
