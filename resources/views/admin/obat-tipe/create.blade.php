@extends('layouts.main-dashboard')

@section('title')
Admin - Buat Tipe Obat Baru
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
            <h3 class="block-title">Buat Tipe Obat Baru</h3>
        </div>
        <div class="block-content container">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" placeholder="Deskripsi Tipe Obat" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
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