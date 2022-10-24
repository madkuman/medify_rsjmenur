@extends('keuangan.layouts.main')

@section('title')
PO Baru - Keuangan
@endsection

@section('content')
@include('keuangan.po.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat PO Baru</h3>
    </div>
    <div class="block-content">
        <iframe id="the_iframe" name="the_iframe" src="javascript:false" style="display: none;"></iframe>
        <form onsubmit="return ajaxSubmit();" autocomplete="on" target="the_iframe">
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1" id="nopo-label">Nomor PO</label>
                    <input type="text" class="form-control enter-new-field" id="nopo" name="nopo" autocomplete="on" placeholder="Masukkan Nomor">
                </div>
                <div class="col-4">
                    <label for="example-datepicker1" id="tanggalpo-label">Tanggal PO</label>
                    <input type="text" class="js-datepicker form-control" id="tanggalpo" name="tanggalpo" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal" value="{{date('d-m-Y', time())}}">
                </div>
                <div class="col-4" id="adendum-container" style="display: none;">
                    <label for="example-datepicker1">Adendum</label>
                    <input type="text" class="form-control enter-new-field" id="adendum" name="adendum">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Mengenai</label>
                    <input type="text" class="form-control enter-new-field" id="judul" name="judul" autocomplete="on" placeholder="Masukkan Judul">
                </div>
                <div class="col-4" id="input-perusahaan-container">
                    <label>Rekanan</label>
                    <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                    </select>
                </div>
                <div class="col-4" id="termin-container" style="display: none;">
                    <label for="example-datepicker1">Jumlah Termin</label>
                    <input type="text" class="form-control enter-new-field" id="termin" name="termin">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor SPK/KTR</label>
                    <input type="text" class="form-control enter-new-field" id="nospkktr" name="nospkktr" autocomplete="on" placeholder="Masukkan Nomor SPK/KTR">
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal SPK/KTR</label>
                    <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalspkktr" name="tanggalspkktr" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal SPK/KTR" autocomplete="off">
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
                <div class="col-12">
                    <img id="preview-gambar-faktur" class="mt-5" src="" alt="your image" style="display: none"/>
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-4" id="input-perusahaan-container">
                    <label>Pilih Tipe Pengadaan</label>
                    <select class="js-select2 form-control" id="tipePO" name="tipe_po" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                        <option value="Farmasi" selected>Bekkes</option>
                        <option value="Umum">Bekkum</option>
                        <option value="Konstruksi">Konstruksi</option>
                    </select>
                </div>
                <div class="import-container col-4" style="display: none;">
                    <label for="example-datepicker1">Import Detail PO</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="fileCSV" accept=".csv" onchange="importCSV();">
                        <label id="label-file" class="custom-file-label" for="example-file-input-custom" style="color: gainsboro">Pilih File</label>
                    </div>
                    <small>Pastikan ekstensi file adalah CSV (.csv). Download contoh file <a href="{{url('')}}/importpo.csv" download>disini</a></small>
                </div>
                <div class="col-12">
                    <table class="table table-hover table-striped table-borderless table-vcenter mt-15" id="transaksiTable">
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
                            <tr id="transaksiRow1" class="existRow">
                                <th class="text-center" scope="row">1</th>
                                <td class="text-left layanan-par">
                                    <a href="#" class="layanan-text" data-type="text" data-pk="1" data-placeholder="Masukkan Deskripsi" style="display: none;"></a>
                                    <div class="layanan-select2-container">
                                        <select class="js-select2 form-control layanan-select2" data-pk="1" style="width: 100%;" data-placeholder="Pilih Barang">
                                            <option></option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center keterangan-par">
                                    <a href="#" class="keterangan" data-type="textarea" data-pk="1" data-placeholder="Opsional"></a>
                                </td>
                                <td class="text-center jumlah-par">
                                    <a href="#" class="jumlah" data-type="text" data-pk="1" data-placeholder="Masukkan jumlah">0</a>
                                </td>
                                <td class="text-right harga-par">
                                    <a href="#" class="harga" data-type="text" data-pk="1" data-placeholder="Harga Satuan">0</a>
                                </td>
                                <td class="text-center diskon-par">
                                    <a href="#" class="diskon" data-type="text" data-pk="1" data-placeholder="Diskon %">0</a>
                                </td>
                                <td class="text-right  bg-warning-lighter subtotal">
                                    Rp 0
                                </td>
                                <td class="text-right remove-par">
                                    <button class="btn btn-alt-danger btn-sm remove" type="button"><i class="fa fa-remove"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-block btn-alt-primary" id="tambahRecord" type="button">Tambah Record</button>
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
                                    <button class="btn btn-success btn-hero btn-block" id="buttonSubmit" type="submit"><i class="fa fa-check"></i> Simpan</button>
                                    <button class="btn btn-alt-success btn-hero btn-block" style="display: none" id="buttonLoading" type="button">
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


<!-- END Page Content -->
@endsection

@section('js')
@include('keuangan.po.components.create-js')
<!-- <script src="{{asset('js/keuangan/utang/create4.js')}}"></script> -->
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
<script type="text/javascript">
$(document).ready(function(){
    /*--REALLY NOT RECOMMENDED DOING THIS, BUT, OH WELL, HERE GOES--*/
    $(".enter-new-field").keypress(function(event) {
        if(event.keyCode == 13) { 
            textboxes = $("input.enter-new-field");
            debugger;
            currentBoxNumber = textboxes.index(this);
            if (textboxes[currentBoxNumber + 1] != null) {
                nextBox = textboxes[currentBoxNumber + 1]
                nextBox.focus();
                nextBox.select();
                event.preventDefault();
                return false 
            }
            else{
                event.preventDefault();
                return false 
            }
        }
    });
})
</script>
@endsection