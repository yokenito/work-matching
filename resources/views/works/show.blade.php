@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <h2 class="show-ttl">{{$work->title}}</h2>
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
                    <p class="fwb fz18 ma-0">人</p>
                </td>
            </tr>
        </table>
    </main>
@endsection