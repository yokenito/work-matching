<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proposal $proposal)
    {
        // $chats = Chat::where('proposal_id','=',$proposal->id)->orderByDesc('id')->limit(10)->oldest()->get();
        // ←取得した後にひっくり返せなかった（array_reverse等使えず）
        $chat_count = Chat::select('id')->where('proposal_id','=',$proposal->id)->get();
        $count = $chat_count->count();
        if($count > 10){
            $start_offset = $count -10;
            $chats = Chat::where('proposal_id','=',$proposal->id)->offset($start_offset)->limit(10)->get();
        }else{
            $chats = Chat::where('proposal_id','=',$proposal->id)->get();
        }
        $user_id = Auth::id();
        return view('chats.index', compact('chats','user_id','proposal'));
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
        return ;
    }
    
    public function addchats($proposal_id){
        $chats = Chat::where('proposal_id','=',$proposal_id)->orderByDesc('id')->offset($_POST['add_count']*10)->limit(10)->oldest()->get();
        $user_id = Auth::id();
        
        return ["chats"=>response()->json($chats), "user_id"=>$user_id];
    }
}
