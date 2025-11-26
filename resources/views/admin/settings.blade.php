@extends('layouts.admin', [
    'page_header' => 'Settings',
    'dash' => '',
    'examinees' => 'active',
    'quiz' => '',
    'users' => '',
    'questions' => '',
    'sett' => 'active',
])
@section('content')
    @php
        $setting = $settings[0];
    @endphp

    <div class="row">
        <div class="col-md-6">
            <form method="POST"
                action="{{ action([App\Http\Controllers\SettingController::class, 'update'], $setting->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="box">
                    <div class="box-body settings-block">

                        <div class="form-group{{ $errors->has('welcome_txt') ? ' has-error' : '' }}">
                            <label for="welcome_txt">Project Name</label>
                            <p class="label-desc">Please Enter Your Project Name</p>
                            <input type="text" name="welcome_txt" value="{{ old('welcome_txt', $setting->welcome_txt) }}"
                                class="form-control">
                            <small class="text-danger">{{ $errors->first('welcome_txt') }}</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                                    <label for="logo">Logo Select</label>
                                    <p class="label-desc">Please Select Logo</p>
                                    <input type="file" name="logo">
                                    <small class="text-danger">{{ $errors->first('logo') }}</small>
                                </div>
                                <div class="logo-block">
                                    <img src="{{ asset('images/logo/' . $setting->logo) }}" class="img-responsive"
                                        style="width: 128px !important" alt="{{ $setting->welcome_txt }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('favicon') ? ' has-error' : '' }}">
                                    <label for="favicon">Favicon Select</label>
                                    <p class="label-desc">Please Select Favicon</p>
                                    <input type="file" name="favicon">
                                    <small class="text-danger">{{ $errors->first('favicon') }}</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rightclick">Right Click Disable:</label>
                                    <input type="checkbox" class="toggle-input" name="rightclick" id="rightclick"
                                        {{ $setting->right_setting == 1 ? 'checked' : '' }}>
                                    <label for="rightclick"></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inspect">Inspect Element Disable:</label>
                                    <input type="checkbox" class="toggle-input" name="inspect" id="inspect"
                                        {{ $setting->element_setting == 1 ? 'checked' : '' }}>
                                    <label for="inspect"></label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-wave btn-block">Save Setting</button>

                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <div class="row">

                        <form action="{{ route('mail.update') }}" method="POST">
                            <fieldset disabled="disabled">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <label for="MAIL_FROM_NAME">Sender Name: <small>(ex. John)</small></label>
                                    <input type="text" name="MAIL_FROM_NAME" value="{{ $env_files['MAIL_FROM_NAME'] }}"
                                        class="form-control">
                                    <br>
                                    <label for="MAIL_USERNAME">Mail Username: <small>(ex.
                                            username@gmail.com)</small></label>
                                    <input type="text" name="MAIL_USERNAME" value="{{ $env_files['MAIL_USERNAME'] }}"
                                        class="form-control">
                                    <br>
                                    <label for="MAIL_PASSWORD">Mail Password:</label>
                                    <input type="password" value="{{ $env_files['MAIL_PASSWORD'] }}" name="MAIL_PASSWORD"
                                        class="form-control" id="password-field">
                                    <div class="col-md-12">
                                        <span toggle="#password-field"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <br>
                                    <label for="MAIL_HOST">Mail Host: <small>(ex. smtp.gmail.com)</small></label>
                                    <input type="text" name="MAIL_HOST" value="{{ $env_files['MAIL_HOST'] }}"
                                        class="form-control">
                                    <br>
                                </div>


                                <div class="col-md-6">
                                    <label for="MAIL_PORT">Mail PORT: <small>(567,487)</small></label>
                                    <input type="text" name="MAIL_PORT" value="{{ $env_files['MAIL_PORT'] }}"
                                        class="form-control">
                                    <br>
                                    <label for="MAIL_DRIVER">Mail Driver: <small>(ex. sendmail,smtp,mail)</small></label>
                                    <input type="text" name="MAIL_DRIVER" value="{{ $env_files['MAIL_DRIVER'] }}"
                                        class="form-control">
                                    <br>
                                    <label for="MAIL_ENCRYPTION">Mail Encryption: <small>(TLS,SSL)</small></label>
                                    <input type="text" value="{{ $env_files['MAIL_ENCRYPTION'] }}"
                                        name="MAIL_ENCRYPTION" class="form-control">
                                    <br>

                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-md btn-success"><i class="fa fa-save"></i> Save
                                        Settings</button>

                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
