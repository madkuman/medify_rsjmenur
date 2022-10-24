@extends('layouts.main2')

@section('title')
Pengaturan Password
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    <div class="content">
        <div class="row">
            @include('settings.components.sidebar')
            <div class="col-md-9 mb-20">
                <div class="container bg-white px-100 py-50" data-toggle="appear">
                    <div class="row justify-content">
                        <form method="POST" class="col-md-12 text-center">
                            {{csrf_field()}}
                            <h4 class="font-w400 mb-5">Password</h4>
                            <hr>
                            <div class="form-group row">
                                <div class="col-10">
                                    <div class="form-material floating">
                                        <input id="current-password" type="password" class="form-control" name="current_pass" required>
                                        <label for="current-password">Password Saat Ini</label>
                                    </div>
                                </div>
                                <div class="col-1 pt-30 pl-0">
                                    <button type="button" id="current-toggle" class="btn btn-circle btn-outline-primary mr-5 mb-5" onclick="togglePassword(this.id)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10">
                                    <div class="form-material floating">
                                        <input id="new-password" type="password" class="form-control" name="new_pass" required>
                                        <label for="new-password">Password Baru</label>
                                    </div>
                                </div>
                                <div class="col-1 pt-30 pl-0">
                                    <button type="button" id="new-toggle" class="btn btn-circle btn-outline-primary mr-5 mb-5" onclick="togglePassword(this.id)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-10">
                                    <div class="form-material floating">
                                        <input id="verify-password" type="password" class="form-control" name="verify_pass" required>
                                        <label for="verify-password">Verifikasi Password Baru</label>
                                    </div>
                                </div>
                                <div class="col-1 pt-30 pl-0">
                                    <button type="button" id="verify-toggle" class="btn btn-circle btn-outline-primary mr-5 mb-5" onclick="togglePassword(this.id)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" id="btn_submit" class="btn btn-block btn-primary col-10">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script src="assets/js/pages/be_pages_dashboard.js"></script>
<script type="text/javascript">
    function togglePassword(id)
    {
        if (id === "current-toggle") {
            var x = document.getElementById("current-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        else if (id === "new-toggle") {
            var x = document.getElementById("new-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        else if (id === "verify-toggle") {
            var x = document.getElementById("verify-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    }

</script>
@endsection
