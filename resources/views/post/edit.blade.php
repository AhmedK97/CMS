@extends('layouts.app')

@section('content')
<div class="col-md-8 bg-white">
    <h2 class="my-4">اضافه موضوع جديد</h2>
    @include('alerts.success')

    <form action="{{ route('post.update' , $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <select name="category_id" class="form-control">
                @include('lists.categories')
            </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="حدد عنوان الموضوع" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="body" placeholder="محتوى الموضوع ">{{ $post->body }}</textarea>
        </div>

        <div class="form-group">
            <label for="details">اخــر صورة تتعلق بالـموضوع</label>
            <img src="{{ $post->image_path }}" class="form-control w-25 h-25" alt="">
            <hr>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
</div>


@endsection
