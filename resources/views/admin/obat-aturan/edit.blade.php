@extends('layouts.main-dashboard')

@section('title')
Admin - Edit Aturan Obat
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
            <h3 class="block-title">Edit Aturan Obat </h3>
        </div>
        <div class="block-content container">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" value="{{$aturan->nama}}" class="form-control" style="width: 100%;" placeholder="" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Jumlah Pemakaian per Hari</label>
                            <input type="number" id="usage_per_day" value="{{$aturan->usage_per_day}}" name="usage_per_day" class="form-control" style="width: 100%;" placeholder="" required="">
                            <small>Misal : 1, 0.5, 0.75, 2, 3</small>
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