@extends('layouts.app')

@section('content')
    <main>
        <div>
            <h2 class="section-ttl">提案一覧</h2>
            <div>
                @foreach($proposals as $proposal)
                <div class="work-card-2 w-50 d-flex">
                    <div>
                        <div class="prpposer-img-box">
                            <img class="prpposer-img" src="{{asset('/img/work-matching-img.jpeg')}}" alt="">
                        </div>
                        <div>
                            <p class="client-name">{{$proposal->proposer->name}}</p>
                        </div>
                    </div>
                    <div class="work-content ms-4">
                        <div class="work-ttl-box-2">
                            <h4 class="work-ttl">{{$proposal->title}}</h4>
                        </div>
                        <div class="d-flex ms-3 align-items-center">
                            <div class="pro">
                                <p>提案額</p>
                            </div>
                            <div class="reward">
                                <p class="ma-0">{{number_format($proposal->proposal_price)}}円</p>
                            </div>
                        </div>
                        <div class="proposal-box ms-3">
                            <p class="fwb ma-0">提案日：<span class="reception-date">{{$proposal->updated_at->format('Y/m/d')}}</span></p>
                        </div>
                        @if($proposal->status == 0)
                            <form action="#" method="post">
                                @csrf
                                <button class="btn btn-outline-info decision-btn">取引確定</button>
                            </form>
                        @elseif($proposal->status == 1)
                            <a href="#" class="btn btn-outline-primary decision-btn">詳細</a>
                        @elseif($proposal->status == 2)
                            <button class="btn btn-outline-secondary decision-btn">募集終了
                        @endif
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>  
    </main>
@endsection