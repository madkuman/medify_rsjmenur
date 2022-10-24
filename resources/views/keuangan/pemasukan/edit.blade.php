@extends('keuangan.layouts.main')

@section('title')
Pemasukan Edit - Keuangan
@endsection


@section('content')
@include('keuangan.pemasukan.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit Pemasukan</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="{{$pemasukan->id}}">
                <input type="text" class="d-none" id="countdetail" value="{{count($pemasukan->detail)}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal"  value="{{date('d-m-Y', strtotime($pemasukan->tanggal_transaksi))}}">
                <small class="text-danger hide" id="error_main_tanggal">Tidak Boleh Kosong</small>
            </div>
            <div class="col-5" id="input-judul-container">
                <label>Judul Pemasukan</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Pemasukan" value="{{$pemasukan->judul}}">
                <small class="text-danger hide" id="error_judul_kosong">Tidak Boleh Kosong</small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-pihak3-container">
                <label>Penanggung Jawab Pembayaran</label>
                <input type="text" class="form-control" id="pihak3" name="pihak3" placeholder="Masukkan Nama Penanggung Jawab Pembayaran" value="{{$pemasukan->pihak_ketiga}}" >
            </div>
            <div class="col-3" id="input-pasien-container">
                <label>Pasien</label>
                <select class="js-select2 form-control" id="pasien" name="pasien" style="width: 100%;">
                @if($pemasukan->pasien_id != null)
                <option value="{{$pemasukan->pasien->id}}" selected>{{$pemasukan->pasien->name}}</option>
                @endif
                </select>
            </div>
            <div class="col-3" id="input-pasien-pembayaran-container">
                <label>Jenis Pembayaran <i class="fa fa-spin fa-spinner text-primary" style="display: none" id="pasien_pembayaran_loading"></i></label>
                <select class="js-select2 form-control" id="pasien-pembayaran" name="pasien-pembayaran" style="width: 100%;" data-placeholder="Pilih Jenis Pembayaran"> 
                    <option hidden value="{{$pemasukan->pasien_pembayaran_id}}" selected></option>
                </select>
            </div>
            <div class="col-3">
                <label>Perusahaan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                    <option></option>
                    @foreach($perusahaan as $item)
                    <option value="{{$item->id}}" @if($item->id == $pemasukan->perusahaan_id) selected @endif>{{$item->nama}}</option>
                    @endforeach
                </select>
                <small class="text-danger hide" id="error_perusahaan_kosong">Tidak Boleh Kosong</small>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-judul-container">
                <label>Akun Rekening</label>
                <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                    @foreach($akun as $item)
                        @if($item->id == $pemasukan->akun_id)
                            <option value="{{$item->id}}" selected>{{$item->no_rekening}} - {{$item->nama}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->no_rekening}} - {{$item->nama}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-3" id="input-pasien-pembayaran-container">
                <label>Lokasi</label>
                <select class="js-select2 form-control" id="lokasi" name="lokasi" style="width: 100%;" data-placeholder="Pilih Lokasi">
                    @foreach($lokasi as $item)
                        @if($item->id == $pemasukan->lokasi_id)
                            <option value="{{$item->id}}" data-kategori="{{$item->kategori_keuangan_id}}" selected>{{$item->nama}}</option>
                        @else
                            <option value="{{$item->id}}" data-kategori="{{$item->kategori_keuangan_id}}">{{$item->nama}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <label>Kategori</label>
                <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    <option></option>
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}" @if($item->id == $pemasukan->kategori_id) selected @endif>{{$item->name}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label>Tagihan ID</label>
                <input type="text" id="tagihan_id" value="{{$pemasukan->tagihan_id}}" class="form-control" readonly>
            </div>
            <div class="col-3">
                <label>Piutang ID</label>
                <input type="text" id="piutang_id" value="{{$pemasukan->piutang_id}}" class="form-control" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary" id="btnOpen"><i class="fa fa-plus"></i> Tambah Transaksi</button>
                <hr>         
            </div>
            <div class="col-12">
                <table class="main-table table table-hover table-striped table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 19%;">Deskripsi Transaksi</th>
                            <th style="width: 10%;">Keterangan</th>
                            <th class="text-center" style="width: 9%;">Jumlah</th>
                            <th class="text-right" style="width: 12%;">Harga</th>
                            <th class="text-center" style="width: 9%;">Diskon</th>
                            <th class="text-right" style="width: 18%;">SubTotal</th>
                            <th class="text-right" style="width: 7%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pemasukan->detail as $rownum => $item)
                    <tr id="transaksi-{{$rownum+1}}" data-id="{{$rownum+1}}">
                        <input type="text" class="d-none" id="detail_id{{$rownum+1}}" value="{{$item->id}}">
                        <input type="text" class="d-none" id="created_by{{$rownum+1}}" value="{{$item->created_by}}">
                        <input type="text" class="d-none" id="kategori_id{{$rownum+1}}" value="{{$item->kategori_id}}">
                        <input type="text" class="d-none" id="lokasi_id{{$rownum+1}}" value="{{$item->lokasi_id}}">
                        <input type="text" class="d-none" id="tarif_id{{$rownum+1}}" value="{{$item->tarif_id}}">
                        <input type="text" class="d-none" id="kelas_id{{$rownum+1}}" value="{{$item->kelas_id}}">
                        <input type="text" class="d-none" id="tarif_tipe_id{{$rownum+1}}" value="{{$item->tarif_tipe_id}}">
                        <input type="text" class="d-none" id="deskripsi{{$rownum+1}}" value="{{$item->deskripsi}}">
                        <input type="text" class="d-none" id="keterangan{{$rownum+1}}" value="{{$item->keterangan}}">
                        <input type="text" class="d-none" id="jumlah{{$rownum+1}}" value="{{str_replace(',', '.', $item->jumlah)}}">
                        <input type="text" class="d-none" id="harga{{$rownum+1}}" value="{{$item->harga}}">
                        <input type="text" class="d-none" id="diskon{{$rownum+1}}" value="{{$item->diskon}}">
                        <input type="text" class="d-none" id="subtotal{{$rownum+1}}" value="{{$item->subtotal}}">
                        <input type="text" class="d-none" id="creator_name{{$rownum+1}}" value="{{$item->creator->name ?? '-'}}">
                        <td class="text-center" style="width: 5%;">{{$rownum+1}}</td>
                        <td id="deskripsi-{{$rownum+1}}" style="width: 19%;">{{$item->deskripsi}}</td>
                        <td id="keterangan-{{$rownum+1}}" style="width: 10%;">{{$item->keterangan}}</td>
                        <td id="jumlah-{{$rownum+1}}" class="text-center" style="width: 9%;">{{$item->jumlah}}</td>
                        <td id="harga-{{$rownum+1}}" class="text-right" style="width: 12%;">{{number_format($item->harga,0)}}</td>
                        <td id="diskon-{{$rownum+1}}" class="text-center" style="width: 9%;">{{$item->diskon}}</td>
                        <td id="subtotal-{{$rownum+1}}" class="text-right" style="width: 18%;">{{number_format($item->subtotal,0)}}</td>
                        <td class="text-right" style="width: 7%;">
                        <button class="btn btn-circle btn-outline-danger btn-sm btnDelete"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-circle btn-outline-info btn-sm btnEdit"><i class="fa fa-pencil"></i></button>
                        </td>
                    </tr>
                    @endforeach
                        <tr id="emptyTable" style="display:none">
                            <td colspan="8" class="text-center"><h4 class="mb-0 mt-10">Tidak Ada Transaksi</h4><br>Klik <strong>Tambah Transaksi</strong> untuk menambahkan data</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
            <div class="col-12">
                <table class="table table-borderless table-vcenter">
                    <tbody>
                        <tr>
                            <td style="width: 80%" class="text-right">Jumlah</td>
                            <td class="text-right  "  style="width: 20%" id="allJumlah">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right">Diskon</td>
                            <td class="text-right "  style="width: 20%" id="allDiskon">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right font-w700">Total</td>
                            <td class="text-right font-w700"  style="width: 20%" id="allTotal">Rp 0</td>
                        </tr>
                        <tr>
                            <td style="width: 60%" class="text-right font-w700"></td>
                            <td class="text-right font-w700"  style="width: 40%" id="allTotal">
                                <button class="btn btn-success btn-hero btn-block" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                                <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading">
                                    <i class="fa fa-asterisk fa-spin"></i> Loading
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div id="tambahTransaksi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            @include('keuangan.pemasukan.components.modal-content')
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection

@section('js')
@include('keuangan.pemasukan.components.edit-js')
<script>
    var user = {{ (Auth::user()->id) }}
    initTransaksi()
</script>
@endsection