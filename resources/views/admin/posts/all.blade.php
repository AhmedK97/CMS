@extends('admin.template')
@section('breadcrumb')
جميع المنشورات
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <table dir="rtl" id="table_id" class="table text-center table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">الرقم</th>
                    <th class="text-center">العنوان</th>
                    <th class="text-center">الاسم slug</th>
                    <th class="text-center">المحتوى</th>
                    <th class="text-center">الــكاتب</th>
                    <th class="text-center">نشر</th>
                    <th class="text-center">التصنيف</th>
                    <th class="text-center">تعديل</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)

                <tr>
                    <td> {{ $post->id }} </td>
                    <td> {{ $post->title }} </td>
                    <td> {{ $post->slug }} </td>
                    <td> {{ str_limit($post->body ,100) }} </td>
                    <td> {{ $post->user?->name ?? 'مستخدم محذوف'}} </td>
                    <td>
                        <form method="post" action="{{ route('posts.update' , $post->id) }}">
                            @csrf
                            @method('patch')
                            <input onchange="this.form.submit()" type="checkbox" name="approved" value="{{ $post->approved }}" {{ $post->approved ? 'checked' :'' }} >
                        </form>
                    </td>
                    <td> {{ $post->category->title }} </td>
                    <td>
                        <form action="{{ route('posts.edit', $post->id)  }}">
                            <button class="fa fa-edit btn-info btn-sm"></button>
                        </form>

                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class=" fa fa-trash btn btn-danger"></button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<script>
    $(document).ready( function () {
    $('#table_id').DataTable({
        "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
    });
} );

</script>
@endsection
