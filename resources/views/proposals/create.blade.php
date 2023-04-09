@extends('layouts.app')

@section('content')
    <h2 class="show-ttl">{{$work->title}}</h2>
    <h4 class="section-ttl">提案内容</h4>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('proposals.store',$work)}}" method="post" class="w-75 mt-3">
        @csrf
        <div>
            <label for="title" class="form-label">題名<span class="form-note">必須</span></label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="mt-4">
            <label for="proposal_price" class="form-label">提案金額<span class="form-note">必須</span></label>
            <input type="number" name="proposal_price" class="form-control" value="{{ old('proposal_price') }}">
        </div>
        <div class="mt-4">
            <label for="content" class="form-label">内容</label>
            <textarea name="content" class="form-control">{{old('content')}}</textarea>
        </div>

        <button type="submit" class="btn btn-outline-primary mt-4">投稿</button>
    </form>
@endsection