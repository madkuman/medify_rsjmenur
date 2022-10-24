@extends('keuangan.layouts.main')

@section('title')
Penerimaan Edit - Keuangan
@endsection

@section('content')
@include('keuangan.utang.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Edit Penerimaan</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="d-none">
                <input type="text" class="d-none" id="idtransaksi" value="{{$utang->id}}">
                <input type="text" class="d-none" id="idpo" value="{{$utang->po_id}}">
                <input type="text" class="d-none" id="countdetail" value="{{count($utang->detail)}}">
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal Penerimaan</label>
                <input type="text" class="js-datepicker form-control" id="tanggalpenerimaan" name="tanggalpenerimaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal Penerimaan" value="{{date('d-m-Y', strtotime($utang->tanggal_penerimaan))}}">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Mengenai</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Penerimaan" value="{{$utang->judul}}">
            </div>
            <div class="col-4" id="input-perusahaan-container">
                <label>Rekanan</label>
                <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                    <option></option>
                    @foreach($perusahaan as $item)
                    <option value="{{$item->id}}" @if($item->id == $utang->perusahaan_id) selected @endif>{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        @if(!empty($utang->po_id))
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor PO</label>
                <input type="text" class="form-control enter-new-field" id="nopo" name="nopo" autocomplete="on" placeholder="Masukkan Nomor PO" value="{{$utang->no_po}}" disabled>
            </div>
            <div class="col-4">
                <label for="example-datepicker1">Tanggal PO</label>
                <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalpo" name="tanggalpo" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal PO" @if(!empty($utang->tanggal_po)) value="{{date('d-m-Y', strtotime($utang->tanggal_po))}}" @endif disabled>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="example-datepicker1">Nomor Faktur</label>
                <input type="text" class="form-control" id="nofaktur" name="nofaktur" placeholder="Masukkan Nomor Faktur" @if(!empty($utang->no_faktur)) value="{{$utang->no_faktur}}" @endif>
            </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Faktur</label>
                    <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalfaktur" name="tanggalfaktur" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal Faktur" @if(!empty($utang->tanggal_faktur)) value="{{date('d-m-Y', strtotime($utang->tanggal_faktur))}}" @endif>
                </div>
            <div class="col-4">
                <label for="example-datepicker1">Gambar Faktur</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="faktur" name="gambarfaktur" accept="image/*" onchange="inputgambar(this);">
                    <label class="custom-file-label" for="example-file-input-custom" style="color: gainsboro">Pilih Gambar</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <img id="preview-gambar-faktur" class="mt-5" @if($utang->photo_faktur != NULL) src="{{url($utang->photo_faktur)}}" style="display: inline; max-width: 300px;" @else src="" style="display: none" @endif alt="your image"/>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        @endif
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
                    @foreach($utang->detail as $key => $item)
                        <tr id="transaksiRow{{$key+1}}" class="existRow">
                            <th class="text-center" scope="row">{{$key+1}}</th>
                            <td class="d-none">
                                @if(!empty($item->po_detail_id))
                                <input type="text" class="d-none" id="po_detail_id{{$key+1}}" value="{{$item->po_detail_id}}">
                                <input type="text" class="d-none" id="oldValue{{$key+1}}" value="{{$item->po->jumlah-$item->po->jumlah_processed+$item->jumlah}}">
                                @endif
                                <input type="text" class="d-none" id="detail_id{{$key+1}}" value="{{$item->id}}">
                                <a href="#" class="id-detail" data-type="text" data-pk="{{$key+1}}">{{$item->id}}</a>
                            </td>
                            <td class=" text-view layanan-par_">
                                <input type="text" class="d-none" id="layanan{{$key+1}}" value="{{$item->deskripsi}}">  
                                <a href="#" class="layanan_" data-type="text" data-pk="{{$key+1}}" data-placeholder="Masukkan Deskripsi">{{$item->deskripsi}}</a>
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
                                <button class="btn btn-alt-danger btn-sm remove_"><i class="fa fa-remove"></i></button>
                            </td>
                        </tr>
                    @endforeach
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
                            <td class="text-right  "  style="width: 20%" id="allJumlah">Rp {{number_format($utang->jumlah)}}</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right">Diskon</td>
                            <td class="text-right "  style="width: 20%" id="allDiskon">Rp {{number_format($utang->diskon)}}</td>
                        </tr>
                        <tr>
                            <td style="width: 80%" class="text-right font-w700">Total</td>
                            <td class="text-right font-w700"  style="width: 20%" id="allTotal">Rp {{number_format($utang->total)}}</td>
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
@include('keuangan.utang.components.edit-js')
<script src="{{asset('assets/js/pages/be_pages_dashboard.js')}}"></script>
<!-- <script src="{{asset('js/keuangan/utang/edit4.js')}}"></script> -->
<script type="text/javascript">
    function inputgambar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-gambar-faktur')
                        .attr('src', e.target.result);
                    $('#preview-gambar-faktur').css("display","inline");
                    $('#preview-gambar-faktur').css("max-width","300px");
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection