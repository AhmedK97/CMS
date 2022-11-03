@extends('admin.template')

@section('breadcrumb')
    تعديل صفحة
@endsection

@section('content')
    <div class="container-fluid">
      <div class="card mb-3">
      @include('alerts.success')
        <div class="card-header">
          <i class="fa fa-table"></i>
        </div>
        <div class="card-body">
          <div class="container">

            <form method="POST" action="{{route('page.update',$page->id)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="col-lg-5 form-group">
                    <label for="title">عنوان الصفحة </label>
                    <input type="text" class="form-control" name="slug"  value="{{ $page->slug }}">
                </div>

                <div class="col-lg-5 form-group">
                    <label for="title"> الوصف </label>
                    <input type="text" class="form-control" name="title"  value="{{ $page->title }}" >
                </div>

                <div class="col-lg-12 form-group">
                    <label for="body"> المحتوى </label>
                    <textarea name="content" class="summernote">{{ $page->content }}</textarea>
                </div>
                <div>
                <div class="col-lg-12 form-group">
                    <button type="submit" class="btn btn-primary mt-3">تعديل </button>
                </div>
            </form>

            <form class="form-group" action="{{ route('page.destroy', $page->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger"> حذف </button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
<!-- include summernote css/js-->
 <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
            $(document).ready(function() {
      $('.summernote').summernote();
    });
    </script>
@endsection
