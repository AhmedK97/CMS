@extends('layouts.app')



@section('content')

<div class="col-md-8">
    <div class="content bg-white p-1">
        <h2 class="my-4">
            {{ $post->title }}
        </h2>
        <img src="{{ $post->image_path }}" alt="" class="card-img-top mb-4">
        {{ $post->body }}
    </div>
</div>
@include('partials.sidebar')

@include('comments.all')

{{-- Comment Form --}}

    <div class="col-lg-11 col-md-6 col-xs-11">
        <h3>اضافه تعليق   :</h3>
        <form action="{{ route('comment.store') }}" id='comments' method="post">
            @csrf
            <div class="form-group">
                <textarea name="body"  rows="5" class="form-control"></textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary">ارسال</button>
        </form>
    </div>


@endsection
