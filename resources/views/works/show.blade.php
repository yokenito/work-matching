@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <h2 class="show-ttl">{{$work->title}}</h2>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <table class="show-tb">
                        <tr class="work-table-tr">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="work-table">
                            <td>
                                <p class="pro-2 ma-0-aut">プロジェクト</p>
                                <p class="fc-red mt-2 mb-0">{{number_format($work->reward_min)}} ~ {{number_format($work->reward_max)}}</p>
                            </td>
                            <td>
                                <p class="fc-gray ma-0">募集締切まで</p>
                                <p class="fwb fz18 ma-0">
                                    あと<?php echo ((strtotime($work->end_date)-strtotime(date("Y-m-d")))/86400) ?>日
                                </p>
                            </td>
                            <td>
                                <p class="fc-gray ma-0">提案数</p>
                                <p class="fwb fz18 ma-0">{{$work->proposal_num}}件</p>
                            </td>
                            <td>
                                <p class="fc-gray ma-0"><span>★</span>お気に入り</p>
                                <p class="fwb fz18 ma-0">{{$favorite_count}}人</p>
                            </td>
                        </tr>
                    </table>
                    <table class="showcontent-table">
                        <tr>
                            <th>依頼内容</th>
                            <td>{{$work->content}}</td>
                        </tr>
                        <tr>
                            <th>追記</th>
                            <td>追記事項なし</td>
                        </tr>
                        <tr>
                            <th>添付ファイル</th>
                            <td>取引成立後閲覧可能です</td>
                        </tr>
                    </table>
                    <a href="" class="btn btn-primary proposal-btn">提案する</a>
                </div>
                <div class="col-3">
                    <p>クライアント</p>
                    <div>
                        <div>
                            <img src="{{asset('/img/work-matching-img.jpeg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    
    </main>
@endsection