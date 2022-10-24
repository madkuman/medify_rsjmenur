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
                        <form method="POST" class="col-md-12 " enctype="multipart/form-data" id="form-ttd">
                            {{csrf_field()}}
                            <h4 class="font-w400 mb-5 text-center">Perizinan & Hak Akes</h4>
                            <hr>
                            <div class="form-group">
                                <h5 class="mb-0">Override CPPT</h5>
                                <small>Izinkan dokter berikut untuk meng-override CPPT yang anda buat</small>
                            </div>
                            <div class="form-group">
                                <label class="">Dokter Yang Diizinkan untuk Override</label>
                                <div class="">
                                    <select class="js-select2 form-control" id="user_allow_override" name="user_allow_override[]" multiple>
                                        @foreach($dokter as $item)
                                        <option value="{{ $item->id }}" @if(in_array($item->id,$user_allow_override_id)) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
@endsection
