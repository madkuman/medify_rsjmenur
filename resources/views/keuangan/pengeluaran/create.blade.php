@extends('keuangan.layouts.main')

@section('title')
BK Baru - Keuangan
@endsection

@section('content')
@include('keuangan.pengeluaran.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat Pengeluaran Baru</h3>
    </div>
    <div class="block-content">
    <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="example-datepicker1" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', time())}}">
            </div>
            <div class="col-4">
                <label>Kategori</label>
                <select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    <option></option>
                    @foreach($kategori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-5" id="input-judul-container">
                <label>Judul Pengeluaran</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Pengeluaran">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-pasien-container">
            <label>Penerima Pengeluaran</label>
                <input type="text" class="form-control" id="penerima" name="penerima" placeholder="Masukkan Penerima Pengeluaran">
            </div>
            <div class="col-4" id="input-pihak3-container">
            <label>Pembayar Pengeluaran</label>
                <input type="text" class="form-control" id="pembayar" name="pembayar" placeholder="Masukkan Pembayar Pengeluaran">
            </div>
            <div class="col-5" id="input-judul-container">
                <label>Akun Rekening</label>
                <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" id="input-perusahaan-container">
                <label>Perusahaan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                </select>
            </div>
            <div class="col-12">
                <hr>                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover table-striped table-borderless table-vcenter" id="transaksiTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th style="width: 19%;">Deskripsi Transaksi</th>
                            <th style="width: 10%;">Keterangan</th>
                            <th class="text-center" style="width: 9%;">Jumlah</th>
                            <th class="text-right" style="width: 12%;">Harga</th>
                            <th class="text-center" style="width: 9%;">Diskon</th>
                            <th class="text-right" style="width: 18%;">SubTotal</th>
                            <th class="text-right" style="width: 3%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="transaksiRow1" class="existRow">
                            <th class="text-center" scope="row">1</th>
                            <td class=" text-view layanan-par">
                                <a href="#" class="layanan" data-type="text" data-pk="1" data-placeholder="Masukkan Deskripsi"></a>
                            </td>
                            <td class="text-center keterangan-par">
                                <a href="#" class="keterangan" data-type="textarea" data-pk="1" data-placeholder="Opsional"></a>
                                </td>
                            <td class="text-center jumlah-par">
                                <a href="#" class="jumlah" data-type="number" data-pk="1" data-placeholder="Masukkan jumlah">0</a>
                                </td>
                            <td class="text-right harga-par">
                                <a href="#" class="harga" data-type="text" data-pk="1" data-placeholder="Harga Satuan">0</a>
                                </td>
                            <td class="text-center diskon-par">
                                <a href="#" class="diskon" data-type="text" data-pk="1" data-placeholder="Diskon %">0</a></td>
                            <td class="text-right  bg-warning-lighter subtotal">
                                Rp 0
                            </td>
                            <td class="text-right remove-par">
                                <button class="btn btn-alt-danger btn-sm remove"><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                        <tr id="transaksiRow2" class="existRow">
                            <th class="text-center" scope="row">2</th>
                            <td class=" text-view layanan-par">
                                <a href="#" class="layanan" data-type="text" data-pk="2" data-placeholder="Masukkan Deskripsi"></a>
                            </td>
                            <td class="text-center keterangan-par">
                                <a href="#" class="keterangan" data-type="textarea" data-pk="2" data-placeholder="Opsional"></a>
                            </td>
                            <td class="text-center jumlah-par">
                                <a href="#" class="jumlah" data-type="number" data-pk="2" data-placeholder="Masukkan jumlah">0</a>
                            </td>
                            <td class="text-right harga-par">
                                <a href="#" class="harga" data-type="text" data-pk="2" data-placeholder="Harga Satuan">0</a>
                                </td>
                            <td class="text-center diskon-par">
                                <a href="#" class="diskon" data-type="text" data-pk="2" data-placeholder="Diskon %">0</a
                            ></td>
                            <td class="text-right  bg-warning-lighter subtotal">Rp 0</td>
                            <td class="text-right remove-par">
                                <button class="btn btn-alt-danger btn-sm remove">
                                <i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                        <tr id="transaksiRow3" class="existRow">
                            <th class="text-center" scope="row">3</th>
                            <td class=" text-view layanan-par">
                                <a href="#" class="layanan" data-type="text" data-pk="3" data-placeholder="Masukkan Deskripsi"></a>
                            </td>
                            <td class="text-center keterangan-par">
                                <a href="#" class="keterangan" data-type="textarea" data-pk="3" data-placeholder="Opsional"></a>
                            </td>
                            <td class="text-center jumlah-par">
                                <a href="#" class="jumlah" data-type="number" data-pk="3" data-placeholder="Masukkan jumlah">0</a>
                            </td>
                            <td class="text-right harga-par">
                                <a href="#" class="harga" data-type="text" data-pk="3" data-placeholder="Harga Satuan">0</a>
                            </td>
                            <td class="text-center diskon-par">
                                <a href="#" class="diskon" data-type="text" data-pk="3" data-placeholder="Diskon %">0</a></td>
                            <td class="text-right  bg-warning-lighter subtotal">Rp 0</td>
                            <td class="text-right remove-par">
                                <button class="btn btn-alt-danger btn-sm remove"><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-block btn-alt-primary" id="tambahRecord">Tambah Record</button>
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


<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/pengeluaran/create2.js')}}"></script>
@endsection