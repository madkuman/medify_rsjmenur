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
            <h3 class="block-title">Buat Tarif Baru</h3>
        </div>
        <div class="block-content container">
            <form method="POST">
                {{csrf_field()}}
                <div class="row justify-content-start">
                    <div class="col-4 align-self-start">
                        <label>Kategori</label>
                        <select class="form-control js-select2" id="tarif_kategori" name="tarif_kategori" style="width: 100%;" data-placeholder="Pilih Kategori" required="">
                            <option></option>
                            @foreach($kategori as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-5 align-self-start">
                        <label>Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control" style="width: 100%;" placeholder="Deskripsi Tarif" required="">
                    </div>
                    <div class="col-3 align-self-start">
                        <label>Tags</label>
                        <select class="form-control js-select2" name="slug" style="width: 100%;" data-placeholder="Pilih Tags" required="">
                            <option></option>
                            @foreach($slugs as $item)
                            <option value="{{$item->slug}}">{{$item->nama}}</option>
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
                                    <th class="text-center" style="width: 5%;">Tipe</th>
                                    <th class="text-center" style="width: 7%">Kelas</th>
                                    <th class="text-center" style="width: 5%;">Harga</th>
                                    <th class="text-center" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody id="harga-tbody">
                                <tr id="harga-tr-1" class="harga-tr">
                                    <th class="text-center index-num" scope="row">1</th>
                                    <td class="text-center">
                                        <select class="form-control" name="tipe[]" data-placeholder="Pilih Tipe Tarif">
                                            @foreach($tipe as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <select class="form-control" name="kelas[]" data-placeholder="Pilih Kelas Tarif">
                                            @foreach($kelas as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                            <option value="0">Semua Kelas</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" class="form-control input-harga" name="harga[]" value="0">
                                    </td>
                                    <td class="text-center">
                                        
                                    </td>
                                </tr>
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
</div>


@endsection

@section('js')
<script type="text/javascript" src="{{asset('assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js')}}"></script>
@include('admin.tarif.components.create-js')
@endsection