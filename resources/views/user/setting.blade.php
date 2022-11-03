@extends('layouts.app')


@section('content')
{{-- @include('alerts.success',['msg => تم تعديل البيانات بنجح']) --}}
@include('alerts.success')

<div class="container-xl px-4 mt-4">

    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" width="200px" src="{{ $user->profile->avatar ?? 'storage/avatars/avatar.png' }}" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4 ">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <form method="post" action="{{ route('settings') }} " enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="avatar" name="avatar_file" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                        <input class="form-control" id="inputUsername" name="name" type="text" placeholder="Enter your username"
                               value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">WebSite</label>
                        <input class="form-control" type="website" name="website" placeholder="WebSite"
                        value="{{ optional($user->profile)->website }}">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Enter your email address"
                               value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-warning">هذا الايميل مستخدم</div>
                        @enderror
                    </div>
                    <textarea name="bio" id="" class="form-control" name="bio"   rows="5">
                        {{ $user->profile->bio ?? ''}}</textarea>
                    <hr>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $(document).ready(function(){
        $('#avatar_img').click(function() {
            $("input[id='avatar_file']").click();
        });
         $("#avatar_file").change(function(){
            var reader = new FileReader();
            reader.onload = function()
            {
                $("#avatar_img").addClass("avatar_preview").attr("src", reader.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>
@endsection
