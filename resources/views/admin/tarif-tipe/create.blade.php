@extends('layouts.main-dashboard')

@section('title')
Admin - Buat Tarif Tipe
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<!-- Page Content -->

<div class="content" style="margin-top:50px;">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Buat Tarif Tipe Baru</h3>
        </div>
        <div class="block-content container">
            <form method="POST">
                {{csrf_field()}}
                <div class="row justify-content-start">
                    <div class="col-8 align-self-start">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" placeholder="Deskripsi Tarif Tipe" required="">
                        </div>
                        <button class="btn btn-primary" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('js')
@endsection