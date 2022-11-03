@extends('layouts.app')

@section('content')
<style>
    .page-item.active .page-link {
        z-index: 3;
        color: #fff !important;
        background-color: #00ACD6 !important;
        border-color: #00ACD6 !important;
        border-radius: 50%;
        padding: 6px 12px;
    }

    .page-link {
        z-index: 3;
        color: #00ACD6 !important;
        background-color: #fff;
        border-color: #007bff;
        border-radius: 50%;
        padding: 6px 12px !important;
    }

    .page-item:first-child .page-link {
        border-radius: 30% !important;
    }

    .page-item:last-child .page-link {
        border-radius: 30% !important;
    }

    .pagination li {
        padding: 3px;
    }

    .disabled .page-link {
        color: #212529 !important;
        opacity: 0.5 !important;
    }
</style>
<!-- Blog Entries Column -->
<div class="col-md-8">
    <h2 class="my-4">
        المنشورات
    </h2>

    @includewhen(!count($posts),'alerts.empty',['msg' => 'لا يوجد منشورات '])

    @foreach($posts as $post)
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{ $post->image_path }}" alt="">
        <div class="card-body">
            <h3 class="card-title">{{$post->title}}</h3>
            <p class="card-text">{{ str_limit($post->body , 200) }}</p>
            <a href="{{ route('post.show',[$post->id])}}" class="btn btn-primary">المزيد </a>
        </div>
        <div class="card-footer text-muted">
            نشر {{$post->created_at->diffForHumans() }}
            بواسطة<a href=" {{ $post->user?->id  ? route('profile', $post->user?->id) : ''}} "> {{$post->user?->name ?? 'مستخدم محذوف'}}</a>
        </div>
    </div>
    @endforeach

    <!-- Pagination -->
    <div dir="ltr">
        {{$posts->links("vendor.pagination.custom")}}
    </div>

</div>

@include('partials.sidebar')

@endsection
