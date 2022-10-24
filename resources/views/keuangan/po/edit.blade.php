@extends('keuangan.layouts.main')

@section('title')
PO Edit - Keuangan
@endsection

@section('content')
@include('keuangan.po.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit PO</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="{{$po->id}}">
                <input type="text" class="d-none" id="countdetail" value="{{count($po->detail)}}">
                <input type="text" class="d-none" id="jenis_po" value="{{$po->jenis_po}}">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Nomor PO</label>
                <input type="text" class="form-control" id="nopo" name="nopo" autocomplete="on" value="{{$po->no_po}}" placeholder="Masukkan Nomor PO">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal PO</label>
                <input type="text" class="js-datepicker form-control" id="tanggalpo" name="tanggalpo" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal PO" value="{{date('d-m-Y', strtotime($po->tanggal_po))}}">
            </div>
            <div class="col-4" id="adendum-container" style="display: none;">
                <label for="example-datepicker1">Adendum</label>
                <input type="text" class="form-control enter-new-field" id="adendum" name="adendum" value="{{$po->adendum}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Mengenai</label>
                <input type="text" class="form-control enter-new-field" id="judul" name="judul" autocomplete="on" placeholder="Masukkan Judul PO" value="{{$po->judul}}">
            </div>
            <div class="col-4" id="input-perusahaan-container">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan" required>
                    <option></option>
                    @foreach($perusahaan as $item)
                    <option value="{{$item->id}}" @if($item->id == $po->perusahaan_id) selected @endif>{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4" id="termin-container" style="display: none;">
                <label for="example-datepicker1">Jumlah Termin</label>
                <input type="text" class="form-control enter-new-field" id="termin" name="termin" value="{{$po->termin}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor SPK/KTR</label>
                <input type="text" class="form-control enter-new-field" id="nospkktr" name="nospkktr" autocomplete="on" placeholder="Masukkan Nomor SPK/KTR" value="{{$po->no_spkktr}}">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal SPK/KTR</label>
                <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalspkktr" name="tanggalspkktr" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal SPK/KTR" autocomplete="off" @if(!empty($po->tanggal_spkktr)) value="{{date('d-m-Y', strtotime($po->tanggal_spkktr))}}" @endif>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Gambar Pendukung</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="faktur" name="gambarfaktur" accept="image/*" onchange="inputgambar(this);">
                    <label class="custom-file-label" for="example-file-input-custom" style="color: gainsboro">Pilih Gambar</label>
                </div>
            </div>
        </div>
        <div class="row">
            @if(!empty($po->file_pendukung))
            <div class="col-12">
                <img id="preview-gambar-faktur" class="mt-5" src="{{url($po->file_pendukung)}}" style="display: inline; max-width: 300px;" alt="your image"/>
            </div>
            @endif
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
                            <th style="width: 19%;">Deskripsi</th>
                            <th style="width: 10%;">Keterangan</th>
                            <th class="text-center" style="width: 9%;">Jumlah</th>
                            <th class="text-center" style="width: 12%;">Harga</th>
                            <th class="text-center" style="width: 9%;">Diskon</th>
                            <th class="text-right" style="width: 18%;">SubTotal</th>
                            <th class="text-right" style="width: 3%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($po->detail as $key => $item)
                        <tr id="transaksiRow{{$key+1}}" class="existRow">
                            <th class="text-center" scope="row">{{$key+1}}</th>
                            <td class="d-none">
                                <input type="text" class="d-none" id="detail_id{{$key+1}}" value="{{$item->id}}">
                                <a href="#" class="id-detail" data-type="text" data-pk="{{$key+1}}">{{$item->id}}</a>
                            </td>
                            <td class=" text-view layanan-par_">
                                <input type="text" class="d-none" id="layanan{{$key+1}}" value="{{$item->deskripsi}}">
                                @if(count($po->penerimaan) > 0 || $po->jenis_po != 'Farmasi')
                                <a href="#" class="layanan_" data-type="text" data-pk="{{$key+1}}" data-placeholder="Masukkan Deskripsi">{{$item->deskripsi}}</a>
                                @else
                                <input type="text" class="d-none" id="layanan_item_id{{$key+1}}" value="{{!empty($item->item_gudang_id) ? $item->item_gudang_id : $item->item_aset_id}}">
                                <select class="js-select2 form-control layanan_" data-pk="1" style="width: 100%;" data-placeholder="Pilih Barang">
                                    <option value="{{!empty($item->item_gudang_id) ? $item->item_gudang_id : $item->item_aset_id}}" selected>{{$item->deskripsi}}</option>
                                </select>
                                @endif
                            </td>
                            <td class="text-center keterangan-par_">
                                <input type="text" class="d-none" id="keterangan{{$key+1}}" value="{{$item->keterangan}}">
                                <a href="#" class="keterangan_" data-type="textarea" data-pk="{{$key+1}}" data-placeholder="Opsional">{{$item->keterangan}}</a>
                            </td>
                            <td class="text-center jumlah-par_">
                                <input type="text" class="d-none" id="jumlah{{$key+1}}" value="{{$item->jumlah}}">
                                <a href="#" class="jumlah_" data-type="text" data-pk="{{$key+1}}" data-placeholder="Masukkan jumlah">{{$item->jumlah}}</a>
                            </td>
                            <td class="text-right harga-par_">
                                <input type="text" class="d-none" id="harga{{$key+1}}" value="{{$item->harga}}">
                                <a href="#" class="harga_" data-type="text" data-pk="{{$key+1}}" data-placeholder="Harga Satuan">{{$item->harga}}</a>
                            </td>
                            <td class="text-center diskon-par_">
                                <input type="text" class="d-none" id="diskon{{$key+1}}" value="{{$item->diskon}}">
                                <a href="#" class="diskon_" data-type="text" data-pk="{{$key+1}}" data-placeholder="Diskon %">{{$item->diskon}}</a>
                            </td>
                            <td class="text-right  bg-warning-lighter subtotal_">
                                Rp {{number_format($item->subtotal)}}
                            </td>
                            <td class="text-right remove-par_">
                                @if(count($po->penerimaan) == 0)
                                <button class="btn btn-alt-danger btn-sm remove_"><i class="fa fa-remove"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($po->penerimaan) == 0)
                <button class="btn btn-block btn-alt-primary" id="tambahRecord">Tambah Record</button>
                @endif
                <hr>
            </div>
            <div class="col-12">
                <table class="table table-borderless table-vcenter">
                    <tbody>
                        <tr>
                            <td style="width: 80%" class="text-right">Jumlah</td>
                            <td class="text-right  "  style="width: 20%" id="allJumlah">Rp {{number_format($po->jumlah)}}</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right">Diskon</td>
                            <td class="text-right "  style="width: 20%" id="allDiskon">Rp {{number_format($po->diskon)}}</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right font-w700">Total</td>
                            <td class="text-right font-w700"  style="width: 20%" id="allTotal">Rp {{number_format($po->total)}}</td>
                        </tr>
                        <tr>
                            <td style="width: 60%" class="text-right font-w700"></td>
                            <td class="text-right font-w700"  style="width: 40%" id="allTotal">
                                <button class="btn btn-success btn-hero btn-block" id="buttonSubmit" type="button"><i class="fa fa-check"></i> Simpan</button>
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
@include('keuangan.po.components.edit-js')
@endsection