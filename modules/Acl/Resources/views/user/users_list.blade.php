@extends('acl::layouts.master')

@section('content')

    <div class="row col-md-12">
        <div class="container">
            <div class="box col-md-9">
                <div class="box-header">
                    <h3 class="box-title">Showing All Users</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>User Name</th>
                            <th>User Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{!! $user->name or '---' !!}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <small class="label label-default">{!! $role->name or '' !!}</small>
                                    @endforeach
                                </td>

                                <td>
                                    <a class="btn-xs btn-success" href="{{ route('acl.user.editUser', $user->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i>Edit This User</a> <br>

                                    <a class="btn-xs btn-danger user-destroy" href="{{ URL::route("acl.user.deleteUser", $user->id) }}">
                                        <i class="glyphicon glyphicon-trash"></i>Delete This User</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

            @include('acl::layouts.sidebar')
        </div>
    </div>

@stop

@section('scripts')

    <script>
        $('.user-destroy').on("click",function(ev){
            ev.preventDefault();
            var tr = $(this).parents('tr');
            var URL = $(this).attr('href');
        console.log(URL);

            swal({
                        title: "Are you sure?",
                        text: "By clicking to confirm, You will delete the late consideration.",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Delete it!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function(isConfirm){
                        if(isConfirm) {
                            $.ajax({
                                type: "DELETE",
                                url: URL,
                                success: function(){
                                    swal("DELETED!", "Deleted successfully.", "success");
                                    tr.remove();
                                }
                            })
                        } else {
                            swal("Cancelled", "Action Cancelled.", "error");
                        }
                    });
        });

    </script>
@endsection