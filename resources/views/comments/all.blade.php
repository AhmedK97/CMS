{{-- <div class="row bg-white mt-3">
    <div class="col-lg-1 p-3">
        <img class="avatar" src="{{ asset('/storage/avatars/avatar.png') }}" alt="">
    </div>
    {{ $comment->user->name }}
    <div class="col-lg-11 p-3">
    </div>
</div> --}}



<div class="container my-5 py-5 text-dark">
    <h3>اخر التعليقات :</h3>


    @forelse ($post->comments as $comment)


    <div class="row d-flex ">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex flex-start">
                        <img class="rounded-circle shadow-1-strong " src="{{ asset('/storage/avatars/avatar.png') }}" alt="avatar" width="60"
                             height="60" />
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary fw-bold mb-0">
                                    {{ $comment->user->name ?? 'مستخدم محذوف' }}
                                    <hr>
                                    <span class="text-dark ms-2">{{$comment->body}} </span>
                                </h6>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 text-info">{{$comment->created_at->diffForHumans()}}</p>

                                @if (isset($comment->user->id) && Auth::user()->id == $comment->user->id )
                                <p class="small mb-0" style="color: #aaa;">
                                    <a href="#!" class="link-grey">تعديل</a> •
                                    <a href="#!" class="link-grey">ازاله</a>
                                </p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-primary ">لا يوجد تعلقيات
    </div>
    @endforelse()


</div>
