@extends('layouts.main-dashboard')

@section('title')
Admin - Buat Master Obat Baru
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
            <h3 class="block-title">Buat Master Obat Baru</h3>
        </div>
        <div class="block-content container">
            <form method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" placeholder="Deskripsi Master Obat" required="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Tipe</label>
                            <select class="js-select2 form-control" name="tipe">
                                @foreach($tipe as $item)
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" id="harga" name="harga" class="form-control input-angka" style="width: 100%;" placeholder="Harga" required="">
                        </div>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="text" id="stok" name="stok" class="form-control input-angka" style="width: 100%;" placeholder="Jumlah Stok Saat Ini" required="">
                        </div>
                        
                    </div>
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
<script type="text/javascript" src="{{asset('assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js')}}"></script>
<script type="text/javascript">
    $('.input-angka').mask("000.000.000.000.000", {reverse: true});
</script>
@endsection