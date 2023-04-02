@extends('layouts.app')

@section('content')
    <h2 class="section-ttl">仕事の投稿</h2>
    <div>
        <a href="{{route('works.index')}}">&lt; 戻る</a>
    </div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('works.store')}}" method="post" class="w-75">
        @csrf
        <div>
            <label for="title" class="form-label">タイトル<span class="form-note">必須</span></label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="d-flex mt-4">
            <div>
                <label for="start_date" class="form-label">募集開始日<span class="form-note">必須</span></label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
            </div>
            <div class="ms-4">
                <label for="end_date" class="form-label">募集終了日<span class="form-note">必須</span></label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>
        </div>
        
        <div class="mt-4">
            <label for="reward" class="form-label">報酬<span class="form-note">必須</span></label>
            <div class="d-flex">
                <input type="number" name="reward_min" class="form-control w-25" value="{{old('reward_min')}}">
                <span class="mt-1">　〜　</span>
                <input type="number" name="reward_max" class="form-control w-25" value="{{old('reward_mav')}}">
            </div>
        </div>
        <div class="mt-4">
            <label for="content" class="form-label">依頼内容</label>
            <textarea name="content" class="form-control">{{old('content')}}</textarea>
        </div>

        <button type="submit" class="btn btn-outline-primary mt-4">投稿</button>
    </form>
@endsection