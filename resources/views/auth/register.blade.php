@extends('layouts.auth')

@section('title')
Registrasi User
@endsection

@section('content')

<div id="page-container" class="main-content-boxed">
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="bg-gd-emerald">
            <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                <!-- Header -->
                <div class="py-30 px-5 text-center">
                    <h1 class="h2 font-w700 mt-50 mb-10">Buat Akun Baru</h1>
                    <h2 class="h5 font-w400 text-muted mb-0">Lengkapi data berikut</h2>
                </div>
                <!-- END Header -->

                <!-- Sign Up Form -->
                <div class="row justify-content-center px-5">
                    <div class="col-sm-8 col-md-6 col-xl-4">
                        <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.js) -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signup" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="signup-username" name="name">
                                        <label for="signup-username">Nama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                       <input type="email" class="form-control" id="signup-email"  name="email" value="{{ old('email') }}" required>
                                       <label for="signup-email">Email</label>
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
                                    <input id="signup-password"  type="password" class="form-control" name="password" required>
                                    <label for="signup-password">Password</label>
                                </div>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-2 pt-30">
                                <button type="button" class="btn btn-circle btn-outline-success mr-5 mb-5" onclick="togglePassword()">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>

                        </div><!--
                        <div class="form-group row text-center">
                            <div class="col-12">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" id="signup-terms" name="signup-terms">
                                    <span class="css-control-indicator"></span>
                                    I agree to Terms &amp; Conditions
                                </label>
                            </div>
                        </div>-->
                        <div class="form-group row gutters-tiny">
                            <div class="col-12 mb-10">
                                <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success" id="register-button">
                                    <i class="si si-user-follow mr-10"></i>Daftar
                                </button>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ route('password.request') }}">
                                    <i class="fa fa-warning text-muted mr-10"></i> Lupa Password
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ route('login') }}">
                                    <i class="si si-login text-muted mr-10"></i> Login
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Sign Up Form -->
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
</div>

@endsection

@section('js')

<script type="text/javascript">
    function togglePassword()
    {
        var x = document.getElementById("signup-password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

@endsection