@extends('admin.template')

@section('breadcrumb')
تعين الصلاحيات والادوار
@endsection



@section('content')


<div class="container-fluid">
    <div class="card mb-3">
        <form action="{{ route('permissions') }}" method="POST">
            @csrf
            @method('POST')
            <div class="card-header">
                <div class="col-lg-6 form-group">
                    <label for="role_id">حدد الدور</label>
                    <select name="role_id" id="role_id" class="form-control">
                        @include('lists.roles')
                    </select>
                </div>
            </div>
            <div class="card-body row">
                @foreach ($permissions as $permission)
                <div class="col-lg-4 ">
                    <label  for="permission">
                        <input type="checkbox" {{ $permission->roles()->find(true) ? 'checked' : '' }} name="permission[]" value="{{ $permission->id }}" id="">
                        {{ $permission->desc }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="card-footer small text-muted">
                <button class="btn btn-success" type="submit">تعديل</button>
            </div>
        </form>
    </div>
</div>
@endsection



@section('script')

<script>
  $('#role_id').on('change', function(event){
    var role_id = $(this).val();
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route("permission_byRole") }}',
          type: 'post',
          data: {
            'id': role_id
          },
          success: function(data)
          {
            $('input[type=checkbox]').each(function () {
                var ThisVal =parseInt(this.value) ;
                if(data.includes(ThisVal))
                  this.checked = true;
                else
                  this.checked = false;
            });
          }
      })
  });
</script>

@endsection
