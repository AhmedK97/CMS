@extends('admin.template')

@section('breadcrumb')
التعديل على المنشور
@endsection

@section('content')


<div class="container">

<div dir="rtl" class="col-md bg-white">

    @include('alerts.success')

    <form dir="rtl" action="{{ route('posts.update' , $post->id) }}" method="POST" enctype="multipart/form-data">
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
            <textarea rows="6" class="form-control" name="body" placeholder="محتوى الموضوع ">{{ $post->body }}</textarea>
        </div>

        <div class="form-group">

            <img src="{{ $post->image_path }}" class="form-control w-25 h-25" alt="">
            <hr>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
</div>


</div>

@endsection
