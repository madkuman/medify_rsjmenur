@extends('layouts.main2')

@section('title')
Pengaturan Akun
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
                        <form method="POST" class="col-md-12 text-center" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h4 class="font-w400 mb-5">Akun</h4>
                            <hr>
                            <div class="avatar-upload my-10">
                                <div class="avatar-edit">
                                    <input type='file' id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
                                    <label for="avatar"></label>
                                </div>
                                <div class="avatar-preview">
                                    @if(!empty(Auth::user()->avatar_thumb))
                                    <div id="imagePreview" style="background-image: url({{asset(Auth::user()->avatar_thumb)}});">
                                    </div>
                                    @else
                                    <div id="imagePreview" style="background-image: url({{url('assets/img/placeholder.jpg')}});">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="edit-name" name="name" value="{{Auth::user()->name}}">
                                        <label for="edit-name">Nama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="email" class="form-control" id="edit-mail" name="email" value="{{Auth::user()->email}}" required>
                                        <label for="edit-mail">Email</label>
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
                                        <input type="text" class="form-control" id="edit-phone" name="phone" value="{{Auth::user()->phone}}">
                                        <label for="edit-phone">No. Telepon</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="btn_submit" class="btn btn-block btn-primary">Simpan</button>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar").change(function() {
        readURL(this);
    });
</script>
@endsection
