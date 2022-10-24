@extends('farmasi.layouts.main')


@section('title')
Farmasi Edit Transaksi
@endsection
@section('content')
	<div class="block">
        <div class="block-header bordered">
            <h3 class="block-title">Edit Transaksi #{{$transaksi->slug}}</h3>
        </div>
        <div class="block-content">
            <div class="block block-transparent">
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-20" style="border: 1px solid #eaecee; width: 250px;  padding: 10px;">
                            <div class="font-size-lg text-black mb-5">
                                <strong>{{$transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien}}</strong>
                            </div>
                            <address>
                                @if($transaksi->pasien_detail)
                                    @if($transaksi->pasien_detail->gender == 1) Laki-Laki
                                    @else Perempuan
                                    @endif
                                    , {{$transaksi->pasien_detail->age}} Tahun<br>
                                    #{{$transaksi->pasien_detail->id}}<br>
                                @endif
                            </address>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Metode Pembayaran</label>
                        <h5>@if($transaksi->pembayaran_detail)
                            {{$transaksi->pembayaran_detail->perusahaan->nama}} - Kelas {{$transaksi->pembayaran_detail->kelas->nama}}
                            @else -
                            @endif
                        </h5>
                        <label>No Sep</label>
                        <h5>{{$transaksi->sep_detail ? $transaksi->sep_detail->no_sep : "-"}}</h5>
                    </div>
                    <div class="col-md-3">
                        <label>Asal Pelayanan</label>
                        <h5>{{$transaksi->lokasi ? $transaksi->lokasi->nama : "-"}}</h5>
                        <label>Penulis Resep</label>
                        <h5>{{$transaksi->created_by_detail->name}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                    </div>
                    <div class="col-md-3">
                        <label>Sisa Plafon</label>
                        <h5>{{$transaksi->sep_detail ? "Rp. ".number_format($transaksi->sep_detail->sisa_plafon) : "-"}}</h5>
                    </div>
                </div>
            </div>
            <hr class="my-5 mb-20">
            <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi')}}/edit">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$transaksi->id}}">
                <input type="hidden" name="farmasi" value="{{$transaksi->farmasi_id}}">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tanggal Transaksi </label>
                                    <input type="text" class="js-datepicker form-control datepicker" name="tanggal_transaksi" placeholder="Pilih Tanggal" id="tanggal_transaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{implode('-', array_reverse(explode('-', explode(' ',$transaksi->created_at)[0])))}}" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nomor Resep</label>
                                    <input type="text" class="form-control" id="no-resep" name="nomor_resep" placeholder="Nomor Resep" value="{{$transaksi->final_detail->nomor_resep}}">
                                </div>
                                <div class="form-group">
                                    @include('farmasi.transaksi.modals.components.dokter',['id_radio' => 'edit'])
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nomor Antrian</label>
                                    <input type="text" class="form-control" id="no-antrian" name="no_antrian" placeholder="Nomor Antrian" value="{{$transaksi->no_antrian}}">
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Keterangan <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Isikan Keterangan" value="{{$transaksi->deskripsi}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="histori-resep-container">
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <div class="row" id="resepForm">
                    <div class="col-md-6">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Isi resep obat</h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="jenisObat" id="obatGenerik" value="generik" checked>
                                        <label class="custom-control-label" for="obatGenerik">Obat Generik</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" name="jenisObat" id="racikan" value="racikan">
                                        <label class="custom-control-label" for="racikan">Racikan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label for="penyedia">Tipe Obat </label>
                                <select class="js-select2 form-control" id="satuan-select2" name="satuan[]" style="width: 100%;" data-placeholder="Pilih Satuan">
                                    @foreach($tipe as $tip)
                                        <option value="{{$tip->nama}}">{{$tip->nama}}</option>
                                    @endforeach
                                </select>
                                <p class="text-warning"></p>
                            </div>

                            <div id="obatForGenerik">
                                <div class="form-group row">
                                    <h1 id="obat-generik" hidden></h1>
                                    <input type="hidden" class="form-control" id="harga-generik">
                                    <label for="penyedia">Obat </label>
                                    <select class="js-select2 form-control barang" id="namaObat" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
                                        <option></option>
                                    </select>
                                    <p class="text-warning"></p>
                                </div>
                            </div>

                            <div id="obatForRacikan" class="d-none">
                                <div class="form-group row">
                                    <label>Racikan</label>
                                    <textarea class="form-control" id="textRacikan"></textarea>
                                    <p class="text-warning"></p>
                                </div>
                                <div class="row">
                                    <div class="form-group" id="racikan-row">
                                        <label>Nama Obat</label>
                                        <div class="row racikan-obat-wrapper">
                                            <h1 id="racikan-text-1" hidden></h1>
                                            <input type="hidden" class="form-control harga-racikan" id="harga-racikan-1">
                                            <div class="col-md-7">
                                                <select class="js-select2 form-control barang-racikan" id="racikan-select2-1" style="width: 100%;" data-placeholder="Pilih Barang">
                                                    <option></option>
                                                </select>
                                                <p class="text-warning"></p>          
                                            </div>
                                            <div class="col-md-3 px-1">
                                                <input type="number" class="form-control jumlah-obat" id="jumlah" placeholder="Jumlah">
                                                <p class="text-warning"></p>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="button-control btn btn-sm btn-danger btn-square btnRemoveRacikan">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center pb-10" id="tambahRacikan">
                                    <button type="button" class="btn btn-lg btn-circle btn-outline-primary" id="btnAddRacikan">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @if($transaksi->transaksi_asal_id)
                            <div class="form-group row">
                                <label>Jumlah Sisa Resep Asal</label>
                                <input type="text" class="form-control" id="jumlahSisa" placeholder="Jumlah Sisa Resep Asal" readonly="">
                                <p class="text-warning"></p>
                            </div>
                            <input type="hidden" id="detailAsal" class="resep-input" value=''>
                            @endif
                            <input type="hidden" id="detailId" class="resep-input" value=''>
                            @if($transaksi->pembayaran_detail && $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' )
                            <div class="form-group row">
                                <div class="col-md-3 px-1">
                                    <label>Jumlah </label>
                                    <input type="number" class="form-control" id="jumlah-obat" placeholder="Jumlah" onchange="changeDukungan()">
                                    <p class="text-warning"></p>
                                </div>
                                <div class="col-md-3 px-1">
                                    <label>7 hari</label>
                                    <input type="number" class="form-control" id="hari-7" placeholder="Jumlah" onchange="changeDukungan()">
                                </div>
                                <div class="col-md-3 px-1">
                                    <label>23 Hari</label>
                                    <input type="number" class="form-control" id="hari-23" placeholder="Jumlah">
                                </div>
                                <div class="col-md-3 px-1">
                                    <label>Duk RS</label>
                                    <input type="number" class="form-control" id="dukungan-rs" placeholder="Jumlah" onchange="changeDukungan()">
                                </div>
                            </div>
                            @else
                            <div class="form-group row">
                                <label>Jumlah Obat</label>
                                <input type="number" class="form-control" id="jumlahObat" placeholder="Jumlah Obat">
                                <p class="text-warning"></p>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label>Aturan Penggunaan</label>
                                <select class="form-control" id="aturan-select2" name="aturan[]" style="width: 100%;" data-placeholder="Pilih Aturan">
                                    <option></option>
                                </select>
                                <p class="text-warning"></p>
                            </div>
                            <div class="form-group row d-none">
                                <label>Satuan Penggunaan</label>
                                <select class="js-select2 form-control" id="satuan-penggunaan-select2" name="satuan_penggunaan[]" style="width: 100%;" data-placeholder="Pilih Satuan Penggunaan">
                                    <option value=""></option>
                                </select>
                                <p class="text-warning"></p>
                            </div>
                            <div id="editResepBtn" class="d-none">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center pb-10">
                                            <button type="button" class="btn btn-sm btn-square" id="btn-cancel">
                                                <i class="fa fa-times" aria-hidden="true"></i>&nbsp; Batal
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-center pb-10">
                                            <button type="button" class="btn btn-sm btn-success btn-square" id="btn-save">
                                                <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center pb-10" id="tambahResepBtn">
                                <button type="button" class="btn btn-sm btn-primary btn-square" id="btn-add">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Tambahkan Obat
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row" id="resep-wrapper">
                            @foreach($transaksi->final_detail->resep_detail as $detail)
@php
    $jumlah_sisa = ($detail->detail_asal->jumlah ?? 0) + $detail->jumlah;
@endphp
                                <div class="col-md-12 resep-jadi">
                                    <a class="block block-link-shadow" href="javascript:void(0)">
                                        <div class="block-content block-content-full clearfix">
                                            <div class="float-right">
                                                <button type="button" class="btn-block-option btnRemoveResep">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="float-left mt-10">
                                                @if($detail->tipe)
                                                <div class="font-w600 mb-5">Racikan</div>
                                                <div class="font-size-sm text-muted">{{$detail->nama_obat}}</div>
                                                <div class="font-size-sm text-muted">{{$detail->satuan}}</div>
                                                @php $nama_obat_racikan = array(); $obat_racikan = array(); $jumlah_racikan = array(); @endphp
                                                @foreach ($detail->racikan as $kan)
                                                    @php
                                                        array_push($nama_obat_racikan, $kan->nama_obat);
                                                        array_push($obat_racikan, $kan->obat_id);
                                                        array_push($jumlah_racikan, $kan->jumlah);
                                                    @endphp
                                                    <div class="font-size-sm text-muted">
                                                        {{$kan->nama_obat}} - {{$kan->jumlah}}
                                                    </div>
                                                @endforeach
                                                @php
                                                    $input = array(
                                                        'detail_asal_id' => $detail->detail_asal->id ?? null,
                                                        'detail_id' => $detail->id,
                                                        'jenis' => 'racikan',
                                                        'satuan' => $detail->satuan,
                                                        'racikan' => $detail->nama_obat,
                                                        'obat' => $obat_racikan,
                                                        'jumlah' => $detail->jumlah,
                                                        'jumlah_sisa' => $jumlah_sisa,
                                                        'jumlah_racikan' => $jumlah_racikan,
                                                        'keterangan' => $detail->keterangan,
                                                        'aturan' => $detail->aturan,
                                                        'hari7' => $detail->hari7,
                                                        'hari23' => $detail->hari23,
                                                        'dukRS' => $detail->dukunganrs,
                                                        'namaObat' => $nama_obat_racikan,
                                                        'satuan_penggunaan' => $detail->satuan_penggunaan
                                                    )
                                                @endphp
                                                @else
                                                <div class="font-w600 mb-5">Obat </div>
                                                <div class="font-size-sm text-muted">{{$detail->satuan}}</div>
                                                <div class="font-size-sm text-muted">{{$detail->nama_obat}}</div>
                                                @php
                                                    $input = array(
                                                        'detail_asal_id' => $detail->detail_asal->id ?? null,
                                                        'detail_id' => $detail->id,
                                                        'jenis' => 'generik',
                                                        'satuan' => $detail->satuan,
                                                        'obat' => $detail->obat_id,
                                                        'jumlah' => $detail->jumlah,
                                                        'aturan' => $detail->aturan,
                                                        'jumlah_sisa' => $jumlah_sisa,
                                                        'keterangan' => $detail->keterangan,
                                                        'hari7' => $detail->hari7,
                                                        'hari23' => $detail->hari23,
                                                        'dukRS' => $detail->dukunganrs,
                                                        'namaObat' => $detail->nama_obat,
                                                        'satuan_penggunaan' => $detail->satuan_penggunaan
                                                    )
                                                @endphp
                                                @endif
                                                <div class="font-size-sm text-muted">
                                                    Jumlah : {{$detail->jumlah}}
                                                    @if($transaksi->pembayaran_detail && $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs' ) (7 Hari : {{$detail->hari7}}, 23 Hari : {{$detail->hari23}}, Duk RS : {{$detail->dukunganrs}}) @endif
                                                     - Aturan : {{$detail->aturan}} {{$detail->satuan_penggunaan}}
                                                </div>
                                                <div class="font-w600 mt-5">Harga : Rp {{number_format($detail->subtotal)}}</div>
                                                <input type="hidden" name="input[]" class="resep-input" value='{{json_encode($input)}}'>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="py-30 text-center">
                            <h2 class="h3 font-w400 text-muted mb-50" id="checkResep">Tidak Ada Resep Obat !</h2>
                        </div>
                    </div>
                </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <div class="float-right">
                                <a href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/'.$transaksi->slug)}}" class="btn btn-secondary btn-square">Batal</a>
                                <span>&nbsp;</span>
                                <button type="submit" class="btn btn-primary btn-square" id="btnSimpan">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
	<style type="text/css">
        .bordered {
            border-bottom: 1px solid #eaecee;
        }
        .modal-content {
            border-radius: 0;
        }
        .modal-lg {
            max-width: 80% !important;
        }
        .select2-result-repository__title {
            color: black;
            font-weight: 700;
            word-wrap: break-word;
            line-height: 1.1;
            margin-bottom: 4px;
        }
        .select2-result-repository__description {
            font-size: 13px;
            color: #777;
            margin-top: 4px;
        }
        /*.no-border {
            border-top: 0 !important;
            border-right: 0 !important;
            border-left: 0 !important;
            border-bottom: 0;
            border-radius: 0 !important;
        }
        .editable-click {
            border-bottom: dashed 1px #0088cc;
        }*/
    </style>
@endsection

@section('js')
@include('farmasi.transaksi.modals.components.dokter-js')
@include('farmasi.js-features.histori-resep.js')
@include('farmasi.transaksi.edit-resep.js')

@endsection