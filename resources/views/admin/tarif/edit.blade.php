@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Tarif
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
        <h3 class="block-title">Edit Tarif {{$master->deskripsi}}</h3>
    </div>
    <div class="block-content container">
        <form method="POST" id="edit-form">
        {{csrf_field()}}
        <div class="row justify-content-start">
            <div class="col-4 align-self-start">
                <label>Kategori</label>
                <select class="form-control js-select2 tarif_kategori" id="tarif_kategori" name="tarif_kategori" style="width: 100%;" data-placeholder="Pilih Kategori">
                    @foreach($kategori as $k)
                        <option value="{{$k->id}}" @if($master->kategori_id == $k->id) selected @endif>{{$k->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-5 align-self-start">
                <label>Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" style="width: 100%;" placeholder="Deskripsi Tarif" value="{{$master->deskripsi}}">
            </div>
            <div class="col-3 align-self-start">
                <label>Tags</label>
                <select class="form-control js-select2" name="slug" style="width: 100%;" data-placeholder="Pilih Tags">
                    <option></option>
                    @foreach($slugs as $item)
                    <option value="{{$item->slug}}" @if($master->slug == $item->slug) selected @endif>{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-12">
                <hr>    
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-hover table-striped table-vcenter" id="hargaTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 9%;">Tipe</th>
                            <th class="text-center" style="width: 7%">Kelas</th>
                            <th class="text-center" style="width: 5%;">Harga</th>
                            <th class="text-center" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody id="harga-tbody">
                        @foreach($tarif as $i => $t)
                            <tr id="harga-tr-{{$t->id}}" class="harga-tr">
                            <input type="hidden" name="tarif_id[]" value="{{$t->id}}" class="tarif-id">
                                <th class="text-center index-num" scope="row">{{++$i}}</th>
                                <td class="text-center">
                                    <select class="form-control" name="tipe[]" data-placeholder="Pilih Tipe Tarif">
                                        @foreach($tipe as $item)
                                        <option value="{{$item->id}}" @if($t->tipe_id == $item->id) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select class="form-control" name="kelas[]" data-placeholder="Pilih Kelas Tarif">
                                        @foreach($kelas as $item)
                                        <option value="{{$item->id}}" @if($t->kelas_id == $item->id) selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                        <option value="0" @if($t->kelas_id == 0) selected @endif>Semua Kelas</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control input-harga" name="harga[]" value="{{$t->harga}}">
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-alt-danger btn-sm remove" type="button" data-delete="{{$t->id}}"><i class="fa fa-remove"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-block btn-alt-primary" type="button" id="tambahRecord">Tambah Record</button>
            </div>
            <div class="col-12">
            <table class="table table-borderless table-vcenter">
                <tbody>
                    <tr>
                        <td style="width: 80%" class="text-right font-w700"></td>
                        <td class="text-right font-w700"  style="width: 40%" id="satuan">
                            <button class="btn btn-success btn-hero btn-block" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                            <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>
</div>

<!-- END Page Content -->
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js')}}"></script>
    @include('admin.tarif.components.edit-js')
@endsection