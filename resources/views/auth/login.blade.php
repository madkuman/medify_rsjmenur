@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <div id="page-container" class="main-content-boxed">
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-image" style="background-image: url('{{ asset('assets/img/bgmenur.png') }}')">
                <div class="row mx-0 bg-black-op">
                    <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                        <div class="p-30 invisible" data-toggle="appear">
                            <p class="font-italic text-white-op">
                                Powered By Medify Indonesia &copy; <span class="js-year-copy">2020</span> Version 1.2
                            </p>
                        </div>
                    </div>
                    <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible"
                        data-toggle="appear" data-class="animated fadeInRight">
                        <div class="content content-full">
                            <!-- Header -->
                            <div class="px-30 py-10">
                                <h1 class="h3 font-w700 mt-30 mb-10">Selamat datang di <br>{{ config('app.name') }}</h1>
                                <h2 class="h5 font-w400 text-muted mb-0">Silahkan login</h2>
                            </div>
                            <!-- END Header -->
                            <form class="js-validation-signin px-30" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input id="email" type="text" id="login-email" class="form-control"
                                                name="email" value="{{ old('email') }}" required autofocus>
                                            <label for="login-email">Email</label>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input id="login-password" type="password" class="form-control" name="password"
                                                required>
                                            <label for="login-password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <!-- Tambahkan CAPTCHA -->
                                            <div class="g-recaptcha" data-sitekey="{{ config('captcha.sitekey') }}"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span
                                                    class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-hero btn-alt-primary" id="login-button">
                                        <i class="si si-login mr-10"></i> Log In
                                    </button>
                                    <div class="mt-30">
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" id="register-button"
                                            href="{{ route('register') }}">
                                            <i class="fa fa-plus mr-5"></i> Buat Akun
                                        </a>
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block"
                                            href="{{ route('password.request') }}">
                                            <i class="fa fa-warning mr-5"></i> Lupa Password
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>
@endsection
