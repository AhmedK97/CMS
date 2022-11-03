<!-- Sidebar Widgets Column -->
<div class="col-md-4">
    <!-- Courses Widget -->
    <div class="card">
        <h5 class="card-header">الأقسام</h5>
        <div class="card-body">
            <ul class="nav flex-column">
                @foreach ($categories as $category)

                <li class="nav-item">
                    <a class="nav-link" href="/{{ $category->id }}/{{ $category->slug }}">{{ $category->title }}</a>
                </li>

                @endforeach

            </ul>
        </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4 text-right">
        <h5 class="card-header">آخر التعليقات</h5>
        <ul class="list-group p-0">
            @forelse ($comments as $comment)

            <li class="list-group-item">

                <img class="avatar" src="{{ $comment->user->profile->avatar ?? '/storage/avatars/avatar.png' }}" alt="">
                <a href=" {{ route('post.show' , $comment->post_id) }} ">{{str_limit($comment->body ,20 ) }}</a>
            </li>

            @empty
            لا يوجد تعليقات
            @endforelse 

        </ul>
    </div>
</div>
