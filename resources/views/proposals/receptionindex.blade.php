@extends('layouts.app')

@section('content')
    <main>
        <div>
            <h2 class="section-ttl">受付中のお仕事一覧</h2>
            <div>
                @foreach($works as $work)
                <div class="work-card">
                    <a href="{{route('proposals.receptionshow', $work)}}" class="work-card-link"></a>
                    <div class="d-flex">
                        <div class="work-status">
                        @if((strtotime($work->end_date)-strtotime(date("Y-m-d"))) > 0)
                        <p>
                            募集中<br>
                            あと
                            <?php echo ((strtotime($work->end_date)-strtotime(date("Y-m-d")))/86400) ?>    
                            日
                        </p>
                        @else
                        <p class="end-proposal">募集<br>終了</p>
                        @endif
                        </div>
                        <div class="work-content">
                            <div class="work-ttl-box">
                                <h5 class="work-ttl">{{$work->title}}</h5>
                            </div>
                            <div class="d-flex ms-3 align-items-center">
                                <div class="pro">
                                    <p>プロジェクト</p>
                                </div>
                                <div class="reward">
                                    <p class="ma-0">{{number_format($work->reward_min)}} ~ {{number_format($work->reward_max)}}</p>
                                </div>
                            </div>
                            <div class="proposal-box ms-3">
                                <p class="fwb ma-0">提案数<span class="proposal-num">{{$work->proposal_num}}</span>件</p>
                            </div>
                        </div>
                    </div>
                    <div class="client-box">
                        <p>依頼者：{{$work->client->name}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>  
    </main>
@endsection