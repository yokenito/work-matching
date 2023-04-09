@extends('layouts.app')

@section('content')
    <main>
        <div>
            <h2 class="section-ttl">提案中のお仕事一覧</h2>
            <div>
                @foreach($proposals as $proposal)
                <div class="work-card">
                    <a href="#" class="work-card-link"></a>
                    @if($user->isNice($proposal->work->id))
                        <button onclick="nice({{$proposal->work->id}}, this)" class="nicebtn active">
                            <span class="nice">★</span>お気に入り
                        </button>
                    @else
                        <button onclick="nice({{$proposal->work->id}}, this)" class="nicebtn">
                            <span class="nice">★</span>お気に入り
                        </button>
                    @endif
                    <div class="d-flex">
                        <div class="work-status">
                            <p>
                                募集中<br>
                                あと
                                <?php echo ((strtotime($proposal->work->end_date)-strtotime(date("Y-m-d")))/86400) ?>    
                                日
                            </p>
                        </div>
                        <div class="work-content">
                            <div class="work-ttl-box">
                                <h5 class="work-ttl">{{$proposal->work->title}}</h5>
                            </div>
                            <div class="d-flex ms-3 align-items-center">
                                <div class="pro">
                                    <p>プロジェクト</p>
                                </div>
                                <div class="reward">
                                    <p class="ma-0">{{number_format($proposal->work->reward_min)}} ~ {{number_format($proposal->work->reward_max)}}</p>
                                </div>
                            </div>
                            <div class="proposal-box ms-3">
                                <p class="fwb ma-0">提案数<span class="proposal-num">{{$proposal->work->proposal_num}}</span>件</p>
                            </div>
                        </div>
                    </div>
                    <div class="client-box">
                        <p>依頼者：{{$proposal->work->client->name}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>  
    </main>
@endsection