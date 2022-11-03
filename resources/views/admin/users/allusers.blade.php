@extends('admin.template')

@section('breadcrumb')
عرض جميع المستخدمين
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <table dir="rtl" id="table_id" class="table text-center table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">الرقم</th>
                    <th class="text-center">اسم المستخدم</th>
                    <th class="text-center">الايميل</th>
                    <th class="text-center">تعديل</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td> {{ $user->id }} </td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>


                    <td>
                        <form action="{{ route('users.edit', $user->id)  }}">
                            @csrf
                            <button class="fa fa-edit btn-info btn-sm"></button>
                        </form>

                        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
