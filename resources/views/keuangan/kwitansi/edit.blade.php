@extends('keuangan.layouts.main')


@section('title')
Edit Kwitansi - Keuangan
@endsection


@section('content')
@include('keuangan.kwitansi.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat Kwitansi Baru</h3>
    </div>
    <div class="block-content">
        @foreach($kwitansi as $item)
        <form class="form-horizontal form-material" action="{{ route('kwitansi_edit', ['id' => $item->id]) }}" method = "get">
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" name="tanggal_transaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', strtotime($item->tanggal_transaksi))}}">
            </div>
            <div class="col-4">
                <label>Tipe Anggaran</label>
                <select class="js-select2 form-control" name="type" style="width: 100%;" data-placeholder="Pilih Tipe Anggaran">
                    <option></option>
                    <option value="1">Pemasukan</option>
                    <option value="2">Pengeluaran</option>
                </select>
            </div>
            <div class="col-4">
                <label>Kategori</label>
                <select class="js-select2 form-control" name="kode_anggaran" style="width: 100%;" data-placeholder="Pilih Kategori Transaksi">
                    <option></option>
                    @foreach($kategori as $item2)
                    <option value="{{$item2->id}}" @if($item2->id == $item->kode_anggaran) selected @endif>{{$item2->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">NOMINKU</label>
                <input type="text" class="form-control" name="nominku" placeholder="Masukkan NOMINKU" value="{{$item->nominku}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">NPWP</label>
                <input type="text" class="form-control" name="npwp" placeholder="Masukkan Nomor NPWP" value="{{$item->npwp}}">
            </div>
        </div>
        <br>
        <hr>
        <h3 class="block-title">Detail Kwitansi</h3>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">Terima Dari</label>
                <input type="text" class="form-control" name="terima_dari" placeholder="Terima Dari" value="{{$item->terima_dari}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Total Tagihan</label>
                <input type="number" class="form-control" name="subtotal" placeholder="Masukkan Jumlah Total Tagihan" value="{{$item->subtotal}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">PPN</label>
                <input type="number" class="form-control" name="ppn" placeholder="Masukkan Jumlah PPN" value="{{$item->ppn}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">PPH21</label>
                <input type="number" class="form-control" name="pph21" placeholder="Masukkan Jumlah PPH21" value="{{$item->pph21}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">PPH22</label>
                <input type="number" class="form-control" name="pph22" placeholder="Masukkan Jumlah PPH22" value="{{$item->PPH22}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">PPH23</label>
                <input type="number" class="form-control" name="pph23" placeholder="Masukkan Jumlah PPH23" value="{{$item->pph23}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-9">
                <label for="example-datepicker1">Keperluan</label>
                <input type="text" class="form-control" name="keperluan" placeholder="Masukkan Keperluan" value="{{$item->keperluan}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-9">
                <label for="example-datepicker1">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" value="{{$item->keterangan}}">
            </div>
        </div>
        <br>
        <hr>
        <h3 class="block-title">Data Pembayar</h3>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">Nama Pembayar</label>
                <input type="text" class="form-control" name="pembayar_nama" placeholder="Masukkan Nama Pembayar" value="{{$item->pembayar_nama}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Pangkat Pembayar</label>
                <input type="text" class="form-control" name="pembayar_pangkat" placeholder="Masukkan Pangkat Pembayar" value="{{$item->pembayar_pangkat}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Jabatan Pembayar</label>
                <input type="text" class="form-control" name="pembayar_jabatan" placeholder="Masukkan Jabatan Pembayar" value="{{$item->pembayar_jabatan}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" name="pembayar_tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', strtotime($item->pembayar_tanggal))}}">
            </div>
        </div>
        <br>
        <hr>
        <h3 class="block-title">Data Penerima</h3>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="example-datepicker1">Nama Penerima</label>
                <input type="text" class="form-control" name="penerima_nama" placeholder="Masukkan Nama Penerima" value="{{$item->penerima_nama}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Pangkat Penerima</label>
                <input type="text" class="form-control" name="penerima_pangkat" placeholder="Masukkan Pangkat Penerima" value="{{$item->penerima_pangkat}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Jabatan Penerima</label>
                <input type="text" class="form-control" name="penerima_jabatan" placeholder="Masukkan Jabatan Penerima" value="{{$item->penerima_jabatan}}">
            </div>
            <div class="col-3">
                <label for="example-datepicker1">Tanggal Transaksi</label>
                <input type="text" class="js-datepicker form-control" name="penerima_tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', strtotime($item->penerima_tanggal))}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <br><hr>
                <table class="table table-borderless table-vcenter">
                    <tbody>
                        <tr>
                            <td style="width: 60%" class="text-right font-w700"></td>
                            <td class="text-right font-w700"  style="width: 40%">
                                <button class="btn btn-success btn-hero btn-block"><i class="fa fa-check"></i> Simpan</button>
                                <button class="btn btn-alt-success btn-hero btn-block" style="display: none">
                                    <i class="fa fa-asterisk fa-spin"></i> Loading
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
        @endforeach
    </div>
</div>


<!-- END Page Content -->
@endsection

@section('js')
{{-- <script src="{{asset('js/keuangan/utang/create.js')}}"></script> --}}
@endsection