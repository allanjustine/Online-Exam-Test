@extends('layouts.admin', [
    'page_header' => 'Examinees',
    'dash' => '',
    'examinees' => 'active',
    'quiz' => '',
    'users' => '',
    'questions' => '',
    'sett' => '',
])

@section('content')
    @include('message')

    <h3>Administrator Panel</h3>
    <div class="dash-menu">
        <a data-toggle="modal" data-target="#createAdmin" href="javascript:void(0)" class="btn btn-xs"
            style="background-color: #354A5D">
            <i class="fa fa-shield"></i> Create Admin Account
        </a>
    </div>
    <br><br><br><br>
    @if ($auth->role == 'S')
        {{-- Create Modal --}}
        <div id="createAdmin" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Administrator</h4>
                    </div>
                    <form method="POST" action="{{ action([App\Http\Controllers\UsersController::class, 'store']) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Administrator Name <span class="required">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    required placeholder="Enter Name">
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email address <span class="required">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="eg: info@example.com" required>
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password <span class="required">*</span></label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter Your Password" required>
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Retype Password" required>
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            </div>

                            <input type="hidden" name="role" value="S">
                        </div>

                        <div class="modal-footer">
                            <div class="btn-group pull-right">
                                <button type="reset" class="btn btn-default">Clear</button>
                                <button type="submit" class="btn btn-wave">Create</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div id="changepass" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <form id="cpass-form">
                            <input type="hidden" id="cpid" value="">
                            <div class="form-group">
                                <label for="cpassword">Current Password</label>
                                <div class="input-group">
                                    <input type="password" id="cpassword" name="current_password" class="form-control"
                                        value="" required>
                                    <div class="input-group-addon">
                                        <span class="fa fa-eye-slash togglepass" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <small id="cpassword_error" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <div class="input-group">
                                    <input id="new_password" type="password" class="form-control" name="new_password"
                                        value="" required>
                                    <div class="input-group-addon">
                                        <span class="fa fa-eye-slash togglepass" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <small id="new_pass_error" class="text-danger"></small>
                            </div>
                            <div class="form-group=">
                                <label for="confirm_password">Confirm New Password</label>
                                <div class="input-group">
                                    <input id="confirm_password" type="password" class="form-control"
                                        name="confirm_password" value="" required>
                                    <div class="input-group-addon">
                                        <span class="fa fa-eye-slash togglepass" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <small id="match-pass" class="text-danger"></small>
                            </div>
                            <br><br>
                            <div id="form-group">
                                <center><button class="btn btn-primary" style="width: 100%"
                                        id="submit">Update</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron admin-box">
                    <a type="button" id="edit" class="btn btn-info btn-xs" title="Edit" style="float:right;"><i
                            class="fa fa-edit"></i></a>
                    <br>
                    <div class="row box-flex">
                        <div class="col-md-4" style="position: relative">
                            @php
                                $color = App\Models\Color::where('user_id', $auth->id)->select('profile_color')->get();
                                if ($userInfo->isEmpty()) {
                                    $userInfo = App\Models\User::where('id', '=', 1)->get();
                                }

                                $userInfo = $userInfo[0];
                                $color = $color[0] ?? '';
                            @endphp
                            <center>
                                <div class="profile-circle-admin"
                                    style="background-color: {{ $color?->profile_color ?? 'blue' }}">
                                    <p id="admin-name-profile">{{ substr($userInfo->name, 0, 1) }}</p>
                                </div>
                            </center>
                        </div>
                        <div class="col-md-8">
                            <form id="adminForm">
                                <input type="hidden" id="id" value="{{ $userInfo->id }}">
                                <div class="form-group">
                                    <label for="dname">Name</label>
                                    <input type="text" class="form-control" id="dname"
                                        value="{{ $userInfo->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="demail">Email Address</label>
                                    <input type="email" class="form-control" id="demail"
                                        value="{{ $userInfo->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="drole">Role</label>
                                    <input type="text" class="form-control" id="drole"
                                        value="{{ $userInfo->role == 'S' ? 'SuperAdmin' : 'Administrator' }}" disabled>
                                </div>

                                <div id="btn-box" class="clearfix" style="display:none">
                                    <a id="cpassbtn" data-id={{ $userInfo->id }} data-toggle="modal"
                                        data-target="#changepass" data-backdrop="static" data-keyboard="false"
                                        style="float:right" href="">Change Password</a><br><br>
                                    <button class="btn btn-primary" id="submit" style="float:right">Update</button>
                                    <button class="btn btn-default" id="cancel"
                                        style="float:right;margin-right:10px">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="admin-box">
                    <h4 style="text-align: center">Administrator List</h4>
                    <table id="admin-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users)
                                @php($n = 1)
                                @foreach ($users as $key => $user)
                                    <tr data-id={{ $user->id }}>
                                        <td>
                                            {{ $n }}
                                            @php($n++)
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role == 'S' ? 'SuperAdmin' : 'Administrator' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    @endif
    <script>
        $(document).ready(function() {

            $("tr").on("click", function() {
                var data_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('details') }}",
                    cache: false,
                    dataType: 'json',
                    data: {
                        'id': data_id
                    },
                    success: function(response) {
                        $('#dname').val(response.data.name);
                        $('#demail').val(response.data.email);
                        $('#id').val(response.data.id);
                        $('#cpassbtn').data('id', response.data.id);
                        $('#admin-name-profile').text(response.fl);
                        $('#drole').val((response.data.role == 'S') ? 'SuperAdmin' :
                            'Administrator');
                        $('.profile-circle-admin').css('background-color', response.color
                            .profile_color);
                    }
                });
                return false;
            });

            $('#adminForm').on('submit', function(event) {
                event.preventDefault();
                let id = $('#id').val();
                let name = $('#dname').val();
                let email = $('#demail').val();

                $.ajax({
                    url: "{{ route('updateAdmin') }}",
                    type: "POST",
                    cache: false,
                    dataType: 'json',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': id,
                        'name': name,
                        'email': email,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Some details has been updated!',
                        }).then((result) => {
                            ajaxCall('{{ url('/admin/admin_list') }}', 'adminlist');
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                });
            });

            $('#cpass-form').on('submit', function(event) {
                event.preventDefault();
                let current_pass = $('#cpassword').val();
                let password = $('#new_password').val();
                let password_confirmation = $('#confirm_password').val();
                let user_id = $('#cpid').val();

                $.ajax({
                    url: "{{ route('change.password') }}",
                    type: "POST",
                    cache: false,
                    dataType: 'json',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'current_password': current_pass,
                        'password': password,
                        'password_confirmation': password_confirmation,
                        'user_id': user_id,
                    },
                    success: function(response) {
                        if (response.success == true)
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                text: 'Password has been changed!',
                            }).then(() => {
                                $('#changepass').modal('hide');
                                ajaxCall('{{ url('/admin/admin_list') }}', 'adminlist');
                            });
                        else
                            $('#cpassword_error').text('Current Password Incorrect!');
                    },
                    error: function(response, status) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong connecting to server!',
                        });
                    }
                });
            });

            $("#edit").on('click', function(event) {
                event.preventDefault();
                $('#dname').prop("disabled", false);
                $('#demail').prop("disabled", false);
                $('#btn-box').show();
            });
            $("#cancel").on('click', function(event) {
                event.preventDefault();
                $('#dname').prop("disabled", true);
                $('#demail').prop("disabled", true);
                $('#btn-box').hide();
            });
            $("#cpassbtn").on('click', function(event) {
                let id = $(this).data('id');
                $('#cpid').val(id);
            });

            $('#confirm_password').on('keyup', function() {
                if ($('#new_password').val() == $('#confirm_password').val()) {
                    $('#match-pass').html('Password Match').css('color', 'green');
                } else
                    $('#match-pass').html('Password does not match!').css('color', 'maroon');
            });

            $('#new_password').on('focusout', function() {
                var npass = $(this).val();
                if (npass.length < 6) {
                    $('#new_pass_error').text('Password must atleast 6 characters length!')
                } else
                    $('#new_pass_error').empty();
            });

            $('.togglepass').on('click', function() {
                $(this).toggleClass("fa-eye-slash fa-eye");
                var input = '#' + $(this).parent('div').prev('input').prop('id');
                $(input).attr('type') === 'password' ? $(input).attr('type', 'text') : $(input).attr('type',
                    'password');
            });

            $(".close").click(function() {
                $('#cpass-form').trigger("reset");
                $('#new_pass_error').empty();
                $('#match-pass').empty();
                $('cpassword_error').empty();
            });

        });
    </script>
@endsection
