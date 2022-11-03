@extends('layouts.app')

@section('content')
<div class="col-md-8 bg-white">
    <h2 class="my-4">اضافه موضوع جديد</h2>
    @include('alerts.success')
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <select name="category_id" class="form-control">
                @include('lists.categories')
            </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="حدد عنوان الموضوع" value="">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="body" placeholder="محتوى الموضوع " value=""></textarea>
        </div>

        <div class="form-group">
            <label for="details">اخــر صورة تتعلق بالـموضوع</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">ارسال</button>
    </form>
</div>


@endsection
