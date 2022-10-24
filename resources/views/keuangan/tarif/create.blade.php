@extends('keuangan.layouts.main')

@section('title')
Tarif Baru - Keuangan
@endsection


@section('content')
@include('keuangan.tarif.components.header')

<!-- Page Content -->

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
                <select class="form-control js-select2 tarif_kategori" id="tarif_kategori" name="tarif_kategori" style="width: 100%;" data-placeholder="Pilih Kategori">
                    @foreach($kategori as $k)
                        <option value="{{$k->id}}">{{$k->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row justify-content-start">
            <div class="col-5 align-self-start">
                <label>Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" style="width: 100%;" placeholder="Deskripsi Tarif">
            </div>

<!--             <div class="col-4">
                <label>Satuan</label>
                <input type="text" id="satuan" name="satuan" class="form-control" style="width: 100%;" placeholder="Satuan Tarif"> 
            </div> -->
        </div>
        <br>
        <div class="row justify-content-start">
            <div class="col-5 align-self-start">
                <label>LIS ID (Hanya untuk tarif LabPK)</label>
                <input type="text" id="lis-id" name="lis_id" class="form-control" style="width: 100%;" placeholder="Masukkan Id LIS jika ada" value="">
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
                            <th class="text-center" style="width: 5%;">Jenis</th>
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
                                <select class="form-control select-jenis" name="jenis[]" data-placeholder="Pilih Jenis Harga">
                                    <option value="nominal" selected="">Nominal</option>
                                    <option value="persen">Persentase</option>
                                </select>
                            </td>
                            <td class="text-center editable">
                            </td>
                            <td class="text-right">
                                <input type="hidden" name="harga[]" class="harga-in" value="0">
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


<!-- END Page Content -->
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('plugins/editable/SimpleTableCellEditor.js')}}"></script>
    @include('keuangan.tarif.components.create-js')
@endsection