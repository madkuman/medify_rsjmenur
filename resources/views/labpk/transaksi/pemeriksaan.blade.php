@extends('layouts.main2')
@section('title')
Pemeriksaan Transaksi #{{$transaksi->id}}
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/basic.css')}}">
<style type="text/css">
.tambah{
    position: relative;
    padding: 10px;
    margin-top: 10px;
    width: 25%;
    height: 170px;
    border-radius: 2%;
    display: block;
    float: left;
    background-color: #dedede;
    },
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        position: relative;
        padding: 10px;
        margin-top: 10px;
        width: 25%;
        height: 170px;
        border-radius: 2%;
        display: inline-block;
        float: left;
        background-color: #dedede;

        cursor: pointer;
    }

    .ml-60 {
        margin-left: 60px;
    }

    .ml-90 {
        margin-left: 90px;
    }
    .table td, .table th{
        border : 2px solid gainsboro;
    }
</style>
@endsection
@section('content')
@include('labpk.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Transaksi #{{$transaksi->id}}</h3>
        </div>
        <div class="block-content pb-20">
            <div class="row" style="padding-left: 2%">
                @include('layouts.components2.lab.biodata-pasien-lab')
                @include('layouts.components2.lab.permintaan-pemeriksaan')

            </div>

            <div class="row">
                <div class="col-12">
                    <hr>
                    <p class="h6 my-0 mb-10">PERMINTAAN PEMERIKSAAN</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Layanan</th>
                                <th class="text-right text-center" style="width: 200px;">Periksa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detail as $index => $detail)
                            <tr>
                                <td class="text-center">{{$index+1}}</td>
                                <td>
                                    <p class="font-w600 mb-5">{{$detail->tarif->deskripsi}}</p>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periksa{{$detail->slug}}">Periksa</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 form-group">
                    <br><hr>
                    <p class="h6 my-0 mb-10">TAMBAH PEMERIKSAAN</p>
                    <form action="{{url('labpk/transaksi/tambah-pemeriksaan').'/'.$transaksi->slug}}" id="tambahPemeriksaanForm" method="POST">
                        {{csrf_field()}}
                        <table class="table">
                            <tr>
                                <td style="width: 915px">
                                    <select class="js-example-basic-multiple form-control js-select2" id="tambah-pemeriksaan" name="tambah_pemeriksaan[]" multiple="multiple" data-placeholder=" Pilih Layanan" style="width: 100%;">
                                        @foreach($tarif as $lab)
                                            @foreach($lab->tarif as $tarif)
                                                <option value="{{$tarif->id}}">{{$tarif->deskripsi}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center" style="width: 250px">
                                    <button id="submit-tambah-pemeriksaan" class="btn btn-primary" type="button">Tambah</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col-12">
                    @php $total_spesimen = count($transaksi->spesimen) ?? 0 @endphp
                    @if($total_spesimen > 0)
                    <p class="h6 my-0 mb-10">DAFTAR SPESIMEN</p>
                    <ul>
                        @foreach($transaksi->spesimen as $spesimen)
                        <li>
                            {{$spesimen->spesimen->kategori->nama}} - {{$spesimen->spesimen->nama}}
                            @if(!empty($spesimen->keterangan))
                            : {{$spesimen->keterangan}}
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="col-12 form-group">
                    <br><hr>
                    <p class="h6 my-0 mb-10">PEMERIKSAAN</p>
                    <form action="{{url($link.'/upload/gambar')}}" id="my-dropzone" method="POST" class="dropzone" enctype="multipart/form-data">
                        <input type="hidden" name="saltPict" value="{{$key}}">
                        <input type="hidden" name="fileNumber" value="0" id="fileNumber">
                        <input type="hidden" name="target" value="{{$transaksi->slug}}">
                        {{csrf_field()}}
                    </form>
                </div>
                <div class="col-12">
                    <form action="{{url('labpk/transaksi/periksa')}}" id="periksaForm" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="saltForm" value="{{$key}}">
                        <input type="hidden" name="transaction_slug" value="{{$transaksi->slug}}">

                        <div class="col-12 form-group">
                            <br><p class="h6 my-0 mb-10">VERIFIKASI PEMERIKSAAN</p>
                            @php $id = 1; @endphp
                            @foreach($transaksi->detail as $detail)
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input akan-ditagih" name="layanan[]" id="example-checkbox{{$id}}" value="{{$detail->id}}" checked="" type="checkbox" data-harga="{{$detail->harga}}">
                                <label class="custom-control-label" for="example-checkbox{{$id}}">{{$detail->tarif->deskripsi}}</label>
                            </div>
                            <input type="hidden" class="jumlah-periksa" value="1" name="jumlah_periksa[{{$detail->id}}]">
                            @php $id++; @endphp
                            @endforeach
                        </div>
                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">GOLONGAN DARAH (+Rhesus)</p>
                            <input type="form-control" class="form-control" rows="4" cols="50" placeholder="Tambahkan Detail Golongan Darah disini" name="gol_darah" value="{{$transaksi->gol_darah ?? ''}}">
                        </div>
                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">DIAGNOSIS</p>                                
                            <textarea class="form-control" rows="4" cols="50" placeholder="Tambahkan Diagnosis Di Sini" name="diagnosis">{{$transaksi->diagnosis ?? ''}}</textarea>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI MDR</p>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" name="infeksi_mdr" value="1" id="infeksi_mdr">
                                <label class="custom-control-label" for="infeksi_mdr"> Terjadi Infeksi Bakteri MDR</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI KARBAPENEMASE</p>
                            <select class="form-control js-select2" name="infeksi_karbapenemase">
                                @foreach($karbapenemase as $k)
                                <option value="{{$k}}" >{{$k}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI ESBL</p>
                            <select class="form-control js-select2" name="infeksi_esbl">
                                @foreach($esbl as $e)
                                <option value="{{$e}}" >{{$e}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="form-group col-12">
                            <p class="h6 my-0 mb-10">INFEKSI BAKTERI STAPHYLOCOCCUS AUREUS</p>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" name="infeksi_aureus" value="1" id="infeksi_aureus">
                                <label class="custom-control-label" for="infeksi_aureus"> Terjadi Infeksi Bakteri Staphylococcus Aureus</label>
                            </div>
                        </div>
                        <hr>
                        @if($has_transfusi)
                            @include('labpk.transaksi.content.transfusi-input')
                        @endif

                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">Analis</p>
                            <select class="form-control js-select2" name="result_created_by" data-placeholder="Pilih Analis" required>
                                @foreach($list_user as $user)
                                        <option value="{{$user->id}}" @if($user->id == Auth::user()->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <p class="h5 my-0 mb-10">Dokter Verifikator</p>
                            <select class="form-control js-select2" name="verified_by" data-placeholder="Pilih Dokter Verifikator" required>
                                @foreach($list_user as $user)
                                    @if($user->profesi == $is_dokter)
                                        <option value="{{$user->id}}" @if($user->id == Auth::user()->id) selected @endif>{{$user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="pull-right">
                                <button id="submit-all" class="btn btn-hero btn-alt-primary" type="button">Simpan Pemeriksaan</button>
                            </div>
                        </div>
                        @include('labpk.transaksi.content.pemeriksaan-modal-tambah')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@include('layouts.components2.lab.save-pemeriksaan-modal')
@include('labpk.components.sep-modal')
@include('labpk.components.footer')
@endsection

@section('js')
@include('layouts.components2.lab.dropzone-lab')
@include('labpk.transaksi.content.pemeriksaan-js')
@endsection('js')