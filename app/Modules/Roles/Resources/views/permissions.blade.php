@extends('backend.layouts.master')

@section('title',transWord('Assign Permissions').' - '.$role->name)

@section('stylesheet')
<style>
    /* width */
    .card >::-webkit-scrollbar {
      width: 15px;
    }

    /* Track */
    .card >::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey;
      border-radius: 10px;
    }

    /* Handle */
    .card >::-webkit-scrollbar-thumb {
      background: #00a388;
      border-radius: 10px;
    }

    /* Handle on hover */
    .card >::-webkit-scrollbar-thumb:hover {
      background: gray;
    }
</style>
@endsection

@section('content')

    <div class="row">
        @foreach ($permissionsName as $permissionName)
        <div class="col-lg-6 mb-3">
            <div class="card card-bordered card-full">
                <div class="card-header">
                    <div class="card-title">
                            {{ ucfirst($permissionName).' ('.transWord("Permissions").')' }}
                    </div>
                </div>
                <div class="card-body" style="height: 135px; overflow-y: scroll;padding-left:30px;">
                    @foreach ($permissions as $permission)
                        @if (explode('_',$permission->name)[1] == $permissionName)
                            <div class="row">
                                @if (in_array($permission->id,$assignedPermissions))
                                    <label><input class="permissionCheck" value="{{ $permission->id }}" type="checkbox" checked><span>&nbsp;{{ transWord(ucwords(str_replace('_',' ',$permission->name))) }}</span></label>
                                @else
                                    <label><input class="permissionCheck" value="{{ $permission->id }}" type="checkbox"><span>&nbsp;{{ transWord(ucwords(str_replace('_',' ',$permission->name))) }}</span></label>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('javascript')


<script>
    $(function() {
        // (Optional) Active an item if it has the class "is-active"
        $(".accordion2 > .accordion-item.is-active").children(".accordion-panel").slideDown();

        $(".accordion2 > .accordion-item").click(function() {
            // Cancel the siblings
            $(this).siblings(".accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
            // Toggle the item
            $(this).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
        });
    });

    $(document).ready(function(){
        var checkedVals = null;
        var allPermissionsCheck = [];
        var checkedVals = $('.permissionCheck:checkbox:checked').map(function() {
                allPermissionsCheck.push(this.value);
            }).get();

        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                if (!allPermissionsCheck.includes($(this).val())) {
                    allPermissionsCheck.push($(this).val());
                }
            }
            else if($(this).prop("checked") == false){
                var index = allPermissionsCheck.indexOf($(this).val());
                if (index !== -1) allPermissionsCheck.splice(index, 1);
            }
            var roleId = '{{ $role->id }}';
            var assignPermissionUrl = '{{ route("assign_permissions_roles",["id"=>"#id"]) }}';
            assignPermissionUrl = assignPermissionUrl.replace('#id',roleId);

            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
            jQuery.ajax({
                url: assignPermissionUrl,
                method: 'get',
                data: {
                    permissions: allPermissionsCheck,
                    role_id:roleId
                },
                success: function(result){
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("Process Done Successfully");
                },

                fail: function (result) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.error("Process Failed");
                }
            });
        });

    });


</script>
@endsection
