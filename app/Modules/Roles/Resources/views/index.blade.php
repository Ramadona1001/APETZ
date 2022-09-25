@extends('backend.layouts.master')

@section('title',transWord('Roles'))

@section('stylesheet')

{{-- @include('backend.components.datatablecss') --}}

@endsection

@section('content')
<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">{{ transWord('Create New Role') }}</div>
        <div class="card-inner">
            <form action="{{ route('store_roles') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" required placeholder="{{ transWord('Role Name') }}" id="role_name" aria-label="{{ transWord('Role Name') }}" name="name" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button type="submit" id="saveBtn" class="btn btn-primary">{{ transWord('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ transWord('All Roles') }}
        </div>
        <div class="card-inner">
            <div class="row">
                @foreach ($roles as $role)
                    <div class="col-lg-2 mb-3">
                        <div class="card card-bordered card-full">
                            <div class="card-header">
                              {{ transWord('Role').' : '.transWord($role->name) }}
                            </div>
                              <div class="card-inner">
                                <div class="btn-group">
                                  <a data-toggle="tooltip" data-original-title="{{ transWord('Edit') }}" href="{{ route('edit_roles',Crypt::encrypt($role->id)) }}" class="btn btn-primary"><em class="icon ni ni-edit-fill"></em></a>
                                  <a data-toggle="tooltip" data-original-title="{{ transWord('Permissions') }}" href="{{ route('permissions_roles',Crypt::encrypt($role->id)) }}" class="btn btn-primary"><em class="icon ni ni-shield-check"></em></a>
                                  @if($role->name != 'Admin')
                                  <a data-toggle="tooltip" data-original-title="{{ transWord('Delete') }}" onclick="return confirm('{{ transWord('Are You Sure?') }}')" href="{{ route('delete_roles',Crypt::encrypt($role->id)) }}" class="btn btn-primary"><em class="icon ni ni-trash-fill"></em></a>
                                  @endif
                                </div>
                              </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')

{{-- @include('backend.components.datatablejs') --}}

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    } );


</script>

@endsection
