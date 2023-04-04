<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::all();
        $user= Auth::user();
        return view('works.index',compact('works','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reward_min' => 'required',
            'reward_max' => 'required',
            'content' => 'required',
        ]);

        $work = new Work();
        $work->title = $request->input('title');
        $work->start_date = $request->input('start_date');
        $work->end_date = $request->input('end_date');
        $work->reward_min = $request->input('reward_min');
        $work->reward_max = $request->input('reward_max');
        $work->content = $request->input('content');
        $work->client_id = Auth::id();
        $work->save();

        return redirect()->route('works.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        $works = Work::find($work->id);
        $works=$works->nices()->wherePivot('work_id', $work->id)->get();
        $favorite_count = count($works);
        $user = Auth::user();
        return view('works.show', compact('work','favorite_count','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        //
    }

    // いいねメソッド
    public function nicestore($work_id){
        Auth::user()->nice($work_id);
        return ;
    }
    public function nicedelete($work_id){
        Auth::user()->deletenice($work_id);
        return ;
    }

}
