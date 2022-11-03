@extends('layouts.app')


@section('content')

<div class="container text-muted">

    <div class="row  bg-white p-3 mb-4">
        <div class="col-md-3 text-center">
            <img class="profile mb-2" src="{{ $content->avatar ?? 'storage/images/defult.jpg'  }}" alt="" />
        </div>

        <div class="col-md-9 text-md-right text-center">
            <h2>{{ $content->user->name }}</h2>
            <p class="word-break">{{ $content->bio }}</p>
            <a href=""> {{$content->website }}</a>
        </div>
    </div>


    <div class="row p-3">
        <div class="col-md-12">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ !Route::is('comments') ? 'active' : '' }} " href="{{ route('profile',$content->user->id) }}">المشاركات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('comments') ? 'active' : '' }} " href="{{ route('comments' , $content->user->id) }}">التعليقات</a>
                </li>
            </ul>
            <div class="row mb-2">

                @if (Route::is('comments'))
                @forelse ($content->user->comments as $comments)
                <div class="row bg-white mb-2 p-3">
                    <div class="col-lg-12 border-bottom p-2 text-wrap">
                        <a href="{{route('post.show',$comments->post->id)}}">
                            <p class="card-text">{{str_limit($comments->body , 70) }}</p>
                        </a>
                    </div>
                    <div class="mt-2">
                        <h6><small>{{str_limit($comments->post->title , 50) }}</small></h6>
                    </div>
                </div>
                @empty
                @include('alerts.empty' , ['msg'=>'لا توجد تعليقات'])
                @endforelse

                @else
                @forelse ($content->user->posts as $post)
                <div class="col-lg-3 col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('post.show' , $post->id) }}">{{ $post->title }}</a></h5>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="" class="dropdown-toggle link" data-toggle="dropdown">
                            <span>المــزيد</span>
                        </a>
                        <div class="dropdown-menu">
                            @can('edit-post' , $post)
                            <a href="{{ route('post.edit' , $post->id) }}" class="dropdown-item">تعديل</a>
                            @endcan

                            @can('delete-post' , $post)

                            <form method="post" action="{{ route('post.destroy' , $post->id) }}">
                                    @csrf
                                    @method('delete')
                                <button type="submit" class="dropdown-item">حذف</button>

                          </form>
                        @endcan
                        </div>
                    </div>
                </div>
                @empty
                @include('alerts.empty' , ['msg'=>'لا توجد مشاركات'])
                @endforelse
                @endif
            </div>
        </div>
    </div>







</div>



@endsection
