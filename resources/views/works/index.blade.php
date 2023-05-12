@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <!-- 検索条件セクション -->

        <div class="ma-0">
            <div class="row">
                <div class="col-2">
                    <dl class="mt-5">
                        <dt class="category">カテゴリーから探す</dt>
                        <dd class="all-category">-全てのカテゴリー</dd>
                        <dd class="sub-category">+システム開発・運用</dd>
                        <dd class="sub-category">+Web制作・Webデザイン</dd>
                        <dd class="sub-category">+デザイン制作</dd>
                        <dd class="sub-category">+ライティング・ネーミング</dd>
                        <dd class="sub-category">+タスク・作業</dd>
                        <dd class="sub-category">+写真・動画・ナレーション</dd>
                        <dd class="sub-category">+翻訳・通訳サービス</dd>
                        <dd class="sub-category">+事務・コンサル・専門職・その他</dd>
                        <dd class="sub-category">+営業・マーケティング・企画・広報</dd>
                    </dl>
                </div>
                <!-- 業務一覧セクション -->
                <div class="col-10">
                    <h2 class="section-ttl">仕事一覧</h2>
                    <div>
                        @foreach($works as $work)
                        <div class="work-card">
                            <a href="{{route('works.show', $work)}}" class="work-card-link"></a>
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
            </div>
        </div>
        
    </main>
@endsection