@extends('layouts.main2')

@section('title')
Pengaturan STR
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
                            <h4 class="font-w400 mb-5">STR</h4>
                            <hr>
                            <div class="form-group row">
                                <div class="col-10">
                                    <div class="form-material floating">
                                        <input id="current-password" type="text" class="form-control" name="str" 
                                        value=
                                        @if(!empty(Auth::user()->str))
                                        "{{Auth::user()->str}}"
                                        @else
                                        ""
                                        @endif 
                                        required>
                                        <label for="current-password">STR Saat Ini</label>
                                    </div>
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
@endsection
