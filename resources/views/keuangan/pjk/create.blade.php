@extends('keuangan.layouts.main')

@section('title')
PJK Baru - Keuangan
@endsection

@section('content')
@include('keuangan.pjk.components.header')

<!-- Page Content -->
<div class="block rounded">
    <div class="block-header">
        <h3 class="block-title">Buat PJK Baru</h3>
    </div>
    <div class="block-content">
        <iframe id="the_iframe" name="the_iframe" src="javascript:false" style="display: none;"></iframe>
        <form onsubmit="return ajaxSubmit();" autocomplete="on" target="the_iframe">
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal PJK</label>
                    <input type="text" class="js-datepicker form-control" id="tanggaltransaksi" name="tanggaltransaksi" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal PJK" value="{{date('d-m-Y', time())}}">
                </div>
                <div class="col-4">
                    <label>Pilih No. Faktur</label>
                    <select class="js-select2 form-control" id="selectFaktur" name="idfaktur" style="width: 100%;" data-placeholder="Pilih Faktur">
                    </select>
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Pilih Akun</label>
                    <select class="js-select2 form-control" id="akunpjk" name="akunpjk" style="width: 100%;" data-placeholder="Pilih Akun">
                        @foreach($akun_pjk as $item)
                        <option value="{{$item->id}}" @if($item->id == 1) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for="example-datepicker1">Mengenai</label>
                    <input type="text" class="form-control enter-new-field" id="judul" name="judul" autocomplete="on" placeholder="Masukkan Judul Utang">
                </div>
                <div class="col-4" id="input-perusahaan-container">
                    <label>Rekanan</label>
                    <select class="js-select2 form-control" id="perusahaan" name="perusahaan" style="width: 100%;" data-placeholder="Pilih Perusahaan">
                    </select>
                </div>
            </div>
            <br>
            <div class="row div-po">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor SPK/KTR</label>
                    <input type="text" class="form-control enter-new-field" id="nospkktr" name="nospkktr" autocomplete="on" placeholder="Masukkan Nomor SPK/KTR">
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal SPK/KTR</label>
                    <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalspkktr" name="tanggalspkktr" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal SPK/KTR" autocomplete="off">
                </div>
                <div class="col-4">
                   {{--<!-- <label for="example-datepicker1">Penerima Utang</label>-->--}}
                    <input type="hidden" class="form-control" id="penerima" name="penerima" placeholder="Masukkan Penerima Utang"  value="-">
                </div>
            </div>
            <br class="div-po">
            <div class="row not-div-po">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor Sprin</label>
                    <input type="text" class="form-control enter-new-field" id="nosprin" name="nosprin" autocomplete="on" placeholder="Masukkan Nomor Sprin">
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Sprin</label>
                    <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalsprin" name="tanggalsprin" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal Sprin" autocomplete="off">
                </div>
            </div>
            <br class="not-div-po">
            <div class="row div-po">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor PO</label>
                    <input type="text" class="form-control enter-new-field" id="nopo" name="nopo" autocomplete="on" placeholder="Masukkan Nomor PO">
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal PO</label>
                    <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalpo" name="tanggalpo" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal PO">
                </div>
            </div>
            <br class="div-po">
            <div class="row div-po">
                <div class="col-4">
                    <label for="example-datepicker1">Nomor Faktur</label>
                    <input type="text" class="form-control enter-new-field" id="nofaktur" name="nofaktur" autocomplete="on" placeholder="Masukkan Nomor Faktur">
                </div>
                <div class="col-4">
                    <label for="example-datepicker1">Tanggal Faktur</label>
                    <input type="text" class="js-datepicker form-control enter-new-field" id="tanggalfaktur" name="tanggalfaktur" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="Masukkan Tanggal Faktur" autocomplete="off">
                </div>
            </div>
            <div class="row">
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
                        <tbody id="transaksiTableBody">
                            <tr id="transaksiRow1" class="existRow">
                                <th class="text-center" scope="row">1</th>
                                <td class="text-left layanan-par">
                                    <a href="#" class="layanan" data-type="text" data-pk="1" data-placeholder="Masukkan Deskripsi"></a>
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
@include('keuangan.pjk.components.create-js')
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

$('#tanggalspkktr').on('change', function() {
    feedNoSPK()
});

function feedNoSPK(){
    var tgl_spk = $("#tanggalspkktr").val();
    var tgl_spk_split = tgl_spk.split("-");
    var dataMonths  = [['01', 'I'], ['02', 'II'], ['03', 'III'], ['04', 'IV'], ['05', 'V'], ['06', 'VI'], ['07', 'VII'], ['08', 'VIII'], ['09', 'IX'], ['10', 'X'], ['11', 'XI'], ['12', 'XII']];

    for (var i = 0; i < dataMonths.length; i++) {
        if (tgl_spk_split[1] == dataMonths[i][0]) {
            var month_roman = dataMonths[i][1];
            break;
        }
    }
    var no_spk = month_roman+'/'+tgl_spk_split[2];
    if ($("#nospkktr").val() == "") {
        $("#nospkktr").val(no_spk);
    }
}
</script>
@endsection