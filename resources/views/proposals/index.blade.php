@extends('layouts.app')

@section('content')
    <main>
        <ul class="home-list">
            <li>
                <a href="{{route('proposals.applicationindex')}}" class="home-link">提案中のお仕事一覧</a>    
            </li>
            <li>
                <a href="{{route('proposals.receptionindex')}}" class="home-link">受付中のお仕事一覧</a>
            </li>
        </ul>
    </main>
@endsection