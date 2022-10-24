@extends('keuangan.layouts.main')

@section('title')
Edit UJI - Keuangan
@endsection

@section('content')
@include('keuangan.uji.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit UJI</h3>
    </div>
    <form method="POST" class="block-content">
        {{csrf_field()}}
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor PJK</label>
                <select class="js-select2 form-control" id="nospp" name="nospp" data-placeholder="Masukkan Nomor SPP" disabled="true">
                    <option value="{{$uji->spp->id}}" selected="true">{{$uji->spp->nomorpjk}}</option>
                </select>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal Uji</label>
                <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="tanggaltransaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Auto" value="{{date('d-m-Y', strtotime($uji->tanggal_transaksi))}}" disabled="true">
            </div>
            @if(empty($uji->spp->po_id))
            <div class="col-4 div-no-se">
                <label for="example-datepicker1">Nomor SE</label>
                <input type="text" class="form-control" id="nose" name="nose" value="{{$uji->spp->no_se}}" disabled="true">
            </div>
            @endif
            {{--<!--
            <div class="col-4">
                <label for="example-datepicker1">Akun Pembayaran</label>
                <select class="js-select2 form-control" id="akun" name="akun" data-placeholder="Masukkan Akun Pembayaran">
                    <option></option>
                    @foreach($akun as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>-->--}}
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor PJK</label>
                <input type="text" class="form-control" id="nopjk" name="nopjk" placeholder="Auto" value="{{$uji->spp->nomor_pjk}}" disabled="true">
            </div>
            <div class="col-4" id="input-perusahaan-container">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Auto" disabled="true">
                    <option value="{{$uji->spp->perusahaan_id}}" selected="true">{{$uji->spp->perusahaan->nama}}</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Mengenai</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Auto" value="{{$uji->spp->judul}}" disabled="true">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Jumlah</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Auto" value="{{number_format($uji->total)}}" disabled="true">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Pengadaan Barang</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pengadaanbarang" name="pengadaanbarang" placeholder="Masukkan Pengadaan Barang" value="{{number_format($uji->pengadaan_barang)}}" disabled="true">
                </div>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Jasa</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="jasa" name="jasa" placeholder="Auto" value="{{number_format($uji->jasa)}}" disabled="true">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Bebas PPN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="bebasppn" name="bebasppn" placeholder="Masukkan Bebas PPN" value="{{number_format($uji->bebas_ppn)}}" disabled="true">
                </div>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Kena PPN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="kenappn" name="kenappn" placeholder="Auto" value="{{number_format($uji->kena_ppn)}}" disabled="true">
                </div>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">PPH 23 Non PPN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pph23nonppn" name="pph23nonppn" placeholder="Masukkan Bebas PPN" value="{{number_format($uji->pph23nonppn)}}" disabled="true">
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPN</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="ppn" name="ppn" placeholder="Masukkan PPN" value="{{$ppn}}">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPH 21</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    @if(!empty($uji->pph_21_5))
                    <input type="text" class="form-control" id="pph21-5" name="pph21" placeholder="Masukkan PPH 21" value="{{$pph_21_5}}">
                    @elseif(!empty($uji->pph_21_15))
                    <input type="text" class="form-control" id="pph21-15" name="pph21" placeholder="Masukkan PPH 21" value="{{$pph_21_15}}">
                    @else
                    <input type="text" class="form-control" id="pph21-5" name="pph21" placeholder="Masukkan PPH 21" value="0">
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPH 22</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pph22" name="pph22" placeholder="Masukkan PPH 22" value="{{$pph_22}}">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPH 23</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pph23" name="pph23" placeholder="Masukkan PPH 23" value="{{$pph_23}}">
                </div>
            </div>
        </div>
        <br>
        {{--<div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPH 23 Pengadaan Barang (AC)</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pph23ac" name="pph23ac" placeholder="Masukkan PPH 23 (AC)" value="{{$pph_23_ac}}">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPH 23 Pengadaan Barang (Bahan Basah)</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pph23bb" name="pph23bb" placeholder="Masukkan PPH 23 (Bahan Basah)" value="{{$pph_23_bb}}">
                </div>
            </div>
        </div>
        <br>--}}
        <div class="row">
            <div class="col-2">
                <label for="example-datepicker1">PPH 4</label>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" id="pph4" name="pph4" placeholder="Masukkan PPH 4" value="{{$pph_4}}">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <button type="submit" class="btn btn-success btn-hero btn-block" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading" disabled="true">
                    <i class="fa fa-asterisk fa-spin"></i> Loading
                </button>
            </div>
        </div>
    </form>
</div>


<!-- END Page Content -->
@endsection

@section('js')
<script src="{{asset('js/keuangan/pengeluaran/uji/edit.js')}}"></script>
@endsection