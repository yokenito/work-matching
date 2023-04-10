<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proposals.index');
    }

    public function applicationindex()
    {
        $user = Auth::user();
        $proposals = Proposal::where('proposer_id','=', $user->id)->get();
        Log::debug($proposals);
        return view('proposals.applicationindex', compact('proposals','user'));
    }

    public function receptionindex()
    {
        $user =Auth::user();
        $works = Work::where('client_id', '=', $user->id)->get();
        return view('proposals.receptionindex', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Work $work)
    {
        return view('proposals.create',compact('work'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Work $work)
    {
        $request->validate([
            'title' => 'required',
            'proposal_price' => 'required',
        ]);

        $proposal = new Proposal();
        $proposal->title = $request->input('title');
        $proposal->proposal_price = $request->input('proposal_price');
        $proposal->content = $request->input('content');
        $proposal->proposer_id = Auth::id();
        $proposal->work_id = $work->id;
        $proposal->save();

        $work->proposal_num++;
        $work->save();

        return redirect()->route('works.show', ['work' => $work->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        //
    }
    public function receptionshow(Work $work)
    {
        $proposals = Proposal::where('work_id','=', $work->id)->get();
        return view('proposals.receptionshow',compact('proposals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
    }

    public function transactionconfirm(Proposal $proposal)
    {
        $proposal->status = 1;
        $proposal->save();

        $work_id = $proposal->work_id;
        $proposals = Proposal::where('work_id','=', $work_id)->get();
        foreach($proposals as $proposal){
            if($proposal->status == 1){
                continue;
            }
            $proposal->status = 2;
            $proposal->save();
        }

        return redirect()->route('proposals.receptionshow',['work' => $work_id]);
    }
}
