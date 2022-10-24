@extends('farmasi.layouts.main')

@section('title')
Farmasi Transaksi
@endsection

@section('css')

<style type="text/css">
/* 
    .paginate_button {
      color: white;
      text-align: center;
      display: inline-block;
      background-color: #42A5F5;
      padding: 8px 10px;
      cursor: pointer;
      font-size: 13px;
      border: 1px solid white;
      width: 70px;
      z-index: 999;
    }
    .paginate_button:hover {
        background-color: #4298f5;
    }

    .paginate_button:active {
        background-color: #42A5F5;
    }

    .paginate_page {
      text-align: center;
      display: inline-block;
      margin-left: 7px;
      margin-right: 3px;
    }
    .paginate_of {
      text-align: center;
      display: inline-block;
      margin-right: 7px;
      margin-left: 3px;
    }
    .paginate_input{
      color: green;  
    } */
    .badge {
        width: 90px;
    }
    .modal-content {
        border-radius: 0;
    }
    .modal-full {
        min-width: 100%;
        margin: 0;
    }
    .modal-full .modal-content {
        min-height: 100vh;
    }
    #modal-large {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }
    .bordered {
        border-bottom: 1px solid #eaecee;
    }
    .modal-lg {
        max-width: 80% !important;
    }
    .no-border {
        border-top: 0 !important;
        border-right: 0 !important;
        border-left: 0 !important;
        border-bottom: 0;
        border-radius: 0 !important;
    }
    .clickable-row {
        cursor: pointer;
    }
    div.dataTables_wrapper div.dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        /* width: 200px; */
        margin-left: -100px;
        margin-top: -26px;
        text-align: center;
        padding: 1em 0;
    }
    .panel-default {
        border-color: #eaecee !important;
    }
    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .kemo td {
        padding: 3px;
    }
</style>
@endsection

@section('content')

<body>
    <div id="modal-analisa-resep">
        <div role="document">
            <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/analisa')}}">
                {{csrf_field()}}
                <input type="hidden" name="id" id="transaksi-id">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header">
                            <h3 class="block-title" id="block-title">Pengkajian Resep </h3>
                            {{-- <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close" style="color:yellow;">
                                <i class="si si-close"></i>
                            </button> --}}
                        </div>
                        <div class="block-content" style="font-size: 13px">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3"><label>Nama Pasien</label></div>
                                        <div class="col-1"><label>:</label></div>
                                        <div class="col-8"><label id="pasien-label"></label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"><label>Berat Badan</label></div>
                                        <div class="col-1"><label>:</label></div>
                                        <div class="col-8"><label id="bb-label"></label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"><label>Tinggi Badan</label></div>
                                        <div class="col-1"><label>:</label></div>
                                        <div class="col-8"><label id="tb-label"></label></div>
                                    </div>
                                    <br>
                                    <br>
                                    <h6>SYARAT ADMINISTRASI</h6>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>1. SEP</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tgl-resep">
                                                <input type="radio" class="css-control-input analisa_resep_sep_1" name="analisa_resep_sep" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tgl-resep">
                                                <input type="radio" class="css-control-input analisa_resep_sep_0" name="analisa_resep_sep" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>2. Fotokopi Kartu</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="nama-dokter">
                                                <input type="radio" class="css-control-input analisa_resep_fotokopi_kartu_1" name="analisa_resep_fotokopi_kartu" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="nama-dokter">
                                                <input type="radio" class="css-control-input analisa_resep_fotokopi_kartu_0" name="analisa_resep_fotokopi_kartu" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>3. Identitas Pasien (Nama, Domisili, Tgl Lahir)</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="nama-pasien">
                                                <input type="radio" class="css-control-input analisa_resep_identitas_pasien_1" name="analisa_resep_identitas_pasien" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="nama-pasien">
                                                <input type="radio" class="css-control-input analisa_resep_identitas_pasien_0" name="analisa_resep_identitas_pasien" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>4. Paraf Dokter</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="umur-bb">
                                                <input type="radio" class="css-control-input analisa_resep_paraf_dokter_1" name="analisa_resep_paraf_dokter" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ada
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="umur-bb">
                                                <input type="radio" class="css-control-input analisa_resep_paraf_dokter_0" name="analisa_resep_paraf_dokter" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Ada
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>ASPEK FARMASETIK</h6>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>5. Nama, Bentuk, Kekuatan</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                                <input type="radio" class="css-control-input analisa_resep_nama_obat_1" name="analisa_resep_nama_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Tepat
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                                <input type="radio" class="css-control-input analisa_resep_nama_obat_0" name="analisa_resep_nama_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Tepat
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>6. Jumlah Obat</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                                <input type="radio" class="css-control-input analisa_resep_jumlah_obat_1" name="analisa_resep_jumlah_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Tepat
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                                <input type="radio" class="css-control-input analisa_resep_jumlah_obat_0" name="analisa_resep_jumlah_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Tepat
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>7. Signa / Aturan Pakai</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                                <input type="radio" class="css-control-input analisa_resep_signa_obat_1" name="analisa_resep_signa_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Tepat
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-bentuk">
                                                <input type="radio" class="css-control-input analisa_resep_signa_obat_0" name="analisa_resep_signa_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak Tepat
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>ASPEK KLINIS</h6>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>8. Tepat Indikasi</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-dosis">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_indikasi_1" name="analisa_resep_tepat_indikasi" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-dosis">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_indikasi_0" name="analisa_resep_tepat_indikasi" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>9. Tepat Dosis</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-obat">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_dosis_1" name="analisa_resep_tepat_dosis" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tepat-obat">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_dosis_0" name="analisa_resep_tepat_dosis" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>10. Tepat Rute</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="eso-potensil">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_rute_1" name="analisa_resep_tepat_rute" value="1"  checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="eso-potensil">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_rute_0" name="analisa_resep_tepat_rute" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>11. Tepat Waktu</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="interaksi-potensial">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_waktu_1" name="analisa_resep_tepat_waktu" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm  css-control-primary css-radio" id="css-control-sm interaksi-potensial">
                                                <input type="radio" class="css-control-input analisa_resep_tepat_waktu_0" name="analisa_resep_tepat_waktu" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>12. Tidak Duplikasi Terapi</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="duplikasi-obat">
                                                <input type="radio" class="css-control-input analisa_resep_duplikasi_terapi_1" name="analisa_resep_duplikasi_terapi" value="1"  checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Iya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="duplikasi-obat">
                                                <input type="radio" class="css-control-input analisa_resep_duplikasi_terapi_0" name="analisa_resep_duplikasi_terapi" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>13. Tidak Ada Alergi Obat & ROTD</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tlp-dokter">
                                                <input type="radio" class="css-control-input analisa_resep_alergi_obat_1" name="analisa_resep_alergi_obat" value="1" checked="" > <span style="font-size: 13px" class="css-control-indicator"></span> Ya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="tlp-dokter">
                                                <input type="radio" class="css-control-input analisa_resep_alergi_obat_0" name="analisa_resep_alergi_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>14. Tidak Ada Interaksi Obat</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="analisa_resep_interaksi_obat">
                                                <input type="radio" class="css-control-input analisa_resep_interaksi_obat_1" name="analisa_resep_interaksi_obat" value="1" checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm control css-control-primary css-radio" id="analisa_resep_interaksi_obat">
                                                <input type="radio" class="css-control-input analisa_resep_interaksi_obat_0" name="analisa_resep_interaksi_obat" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <label>15. Tidak Ada Kontra Indikasi</label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm css-control-primary css-radio" id="analisa_resep_kontra_indikasi">
                                                <input type="radio" class="css-control-input analisa_resep_kontra_indikasi_1" name="analisa_resep_kontra_indikasi" value="1"  checked=""> <span style="font-size: 13px" class="css-control-indicator"></span> Ya
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="css-control css-control-sm control css-control-primary css-radio" id="analisa_resep_kontra_indikasi">
                                                <input type="radio" class="css-control-input analisa_resep_kontra_indikasi_0" name="analisa_resep_kontra_indikasi" value="0"> <span style="font-size: 13px" class="css-control-indicator"></span> Tidak
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Obat</th>
                                                <th>Jumlah</th>
                                                <th>Aturan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="analisa-tabel-body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-alt-primary" id="btn-simpan-analisa">
                            <i class="fa fa-check"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
@section('js')
<script type="text/javascript">
    
    $(document).ready(function() {
        var slug = "{!! $dadas !!}";
        console.log(slug);
        $.ajax({
            url: `{{url('api/farmasi/transaksi/get')}}/`+slug,
            beforeSend: function() {
                swal({
                    html: `<h4>Mengambil data...</h4><span class="fa fa-4x fa-cog fa-spin text-primary text-center loader"></span>`,
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function(res) {
                var title = document.getElementById('block-title');
                title.text = title.text + res.final_detail.nomor_resep;
                $("#transaksi-id").val(res.id);
                $("#pasien-label").text(res.pasien_detail ? res.pasien_detail.name : res.nama_pasien);
                if(res.kasus_detail != null){
                    $("#bb-label").text((res.kasus_detail.identitas.berat_badan ? res.kasus_detail.identitas.berat_badan : '') + ' Kg');
                    $("#tb-label").text((res.kasus_detail.identitas.tinggi_badan ? res.kasus_detail.identitas.tinggi_badan : '') + ' cm');
                } else {
                    $("#bb-label").text('- Kg');
                    $("#tb-label").text('- cm');
                }

                if(res.analisa_resep_at != null){
                    $.each(res, function( index, value ) {
                        if (index.indexOf("analisa_resep") >= 0)
                        {
                            $(`.`+index+`_`+value).prop("checked", true)
                        }
                    });
                }

                var resep_detail = res.final_detail.resep_detail;
                $("#analisa-tabel-body").empty();
                resep_detail.forEach(function(item, index) {
                    $("#analisa-tabel-body").append(`<tr>
                        <td>${index+1}</td>
                        <td>${item.nama_obat}</td>
                        <td>${item.jumlah} ${item.satuan} </td>
                        <td>${item.aturan}</td>
                        </tr>`);
                });
                swal.close();
            },
            dataType: "json"
        });
    });
</script>
@endsection


