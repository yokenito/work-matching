@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <!-- 検索条件セクション -->

        <!-- おすすめ飲食店一覧セクション -->
        <h2 class="section-ttl">仕事一覧</h2>
        <div>
            @foreach($works as $work)
            <div class="work-card">
                @if($user != null)
                    @if($user->isNice($work->id))
                        <button onclick="nice({{$work->id}}, this)" class="nicebtn active">
                            <span class="nice">★</span>お気に入り
                        </button>
                    @else
                        <button onclick="nice({{$work->id}}, this)" class="nicebtn">
                            <span class="nice">★</span>お気に入り
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="nicebtn unnicebtn-unlogin"><span class="nice">★</span>お気に入り</a>
                @endif
                <div>
                    <div>
                        <p>募集中</p>
                        <p>あと日</p>
                    </div>
                    <div>
                        <div>
                            <h5 class="genre-name">{{$work->title}}</h5>
                        </div>
                        <div>
                            <div>
                                <p>プロジェクト</p>
                            </div>
                            <div>
                                <p>{{number_format($work->reward_min)}} ~ {{number_format($work->reward_max)}}</p>
                            </div>
                        </div>
                        <div>
                            <p>提案数<span>{{$work->proposal_num}}</span>件</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p>{{$work->client->name}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </main>
@endsection