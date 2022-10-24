@extends('layouts.auth')

@section('title')
Reset Password
@endsection


@section('content')

<div id="page-container" class="main-content-boxed">
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-gd-lake">
            <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                <!-- Header -->
                <div class="py-30 px-5 text-center">
                    <h1 class="h3 font-w700 mt-50 mb-10">Tenang, satu langkah lagi <br>untuk mengembalikan akun anda</h1>
                    <h2 class="h4 font-w400 text-muted mb-0">Masukkan email dan password anda</h2>
                </div>
                <!-- END Header -->

                <!-- Reminder Form -->
                <div class="row justify-content-center px-5">
                    <div class="col-sm-8 col-md-6 col-xl-4">
                        <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.js) -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus >
                                        <label for="reminder-credential">Email</label>
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-10">
                                    <div class="form-material floating">
                                     <input id="password" type="password" class="form-control" name="password" required onchange="updateConfirmation()">
                                     <input id="password-confirm" type="hidden" class="form-control" name="password_confirmation" required placeholder="Masukkan Password Baru Ulang">

                                     <label for="reminder-credential">Password</label>
                                 </div>

                             </div>
                             <div class="col-2 pt-30">
                                <button type="button" class="btn btn-circle btn-outline-success mr-5 mb-5" onclick="togglePassword()">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                <i class="fa fa-asterisk mr-10"></i> Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Reminder Form -->
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
</div>



@endsection

<script type="text/javascript">
    function togglePassword()
    {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function updateConfirmation()
    {

        var x = document.getElementById("password");
        var y = document.getElementById("password-confirm");

        y.value = x.value;
    }

</script>