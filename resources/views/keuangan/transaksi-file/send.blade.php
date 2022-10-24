@extends('keuangan.layouts.main')

@section('title')
Pengiriman File Pengadaan - Keuangan
@endsection

@section('css')

<style>
.dataTables_processing {
    background-color: white;
}
</style>
@endsection

@section('content')
@include('keuangan.transaksi-file.components.header')
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-content">
                <h5>PENGIRIMAN FILE</h5>
                <div class="row mb-20">
                    <div class="col-lg-6 col-12">
                        <form action="{{url()->current()}}" method= "POST">

                            {{csrf_field()}}
                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Lokasi Asal</label>
                                        <input type="hidden" name="lokasi" @if(!empty($lokasi_asal)) value="{{$lokasi_asal}}" @endif>
                                        <select class="js-select2 form-control" id="lokasi" style="width: 100%;" data-placeholder="Pilih Lokasi" required="" @if(!empty($lokasi_asal_req)) disabled @endif>
                                            @foreach($lokasi as $item)
                                            <option value="{{$item->nama}}" @if($lokasi_asal == $item->nama) selected @endif>{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Pilih File <i id="loading" class="fa fa-gear fa-spin text-info" style="display: none;"></i></label>
                                        <select class="js-select2 form-control" id="file" name="file_id" style="width: 100%;" data-placeholder="Cari File" required="">
                                    
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Lokasi Tujuan</label>
                                        <select class="js-select2 form-control" id="lokasi_tujuan" name="lokasi_tujuan" style="width: 100%;" data-placeholder="Pilih Lokasi" required="">
                                            @foreach($lokasi as $item)
                                            <option value="{{$item->nama}}" @if($item->nama == 'UKPBJ') selected @endif>{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label class="control-label">Keterangan</label>
                                        <select class="js-select2 form-control" id="keterangan" name="keterangan" style="width: 100%;" data-placeholder="Pilih Keterangan">
                                            <option></option>
                                            <option value="Berkas belum lengkap">Berkas belum lengkap</option>
                                            <option value="Salah tanggal">Salah tanggal</option>
                                            <option value="Kurang tanda tangan panitia">Kurang tanda tangan panitia</option>
                                            <option value="Tanda tangan PPK">Tanda tangan PPK</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <label class="col-12">Checklist</label>
                                <div class="col-6 row">
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="sprin" value="1">
                                        <label class="custom-control-label" for="sprin">Sprin (Pejabat Ada & Pan Riksa)</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="hps" value="2">
                                        <label class="custom-control-label" for="hps">HPS (OE)</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="spph" value="3">
                                        <label class="custom-control-label" for="spph">SPPH + Pakta Integritas</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="sph" value="4">
                                        <label class="custom-control-label" for="sph">SPH + Pakta Integritas</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="penetapan" value="5">
                                        <label class="custom-control-label" for="penetapan">Penetapan Penyedia</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="pernyataan" value="6">
                                        <label class="custom-control-label" for="pernyataan">Pernyataan Pengadaan</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="negosiasi" value="7">
                                        <label class="custom-control-label" for="negosiasi">Negosiasi</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="penunjukan" value="8">
                                        <label class="custom-control-label" for="penunjukan">Penunjukan Penyedia</label>
                                    </div>
                                </div>
                                <div class="col-6 row">
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="spk" value="9">
                                        <label class="custom-control-label" for="spk">SPK + SPMK</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="fakturbarang" value="10">
                                        <label class="custom-control-label" for="fakturbarang">Faktur Barang</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="ba" value="11">
                                        <label class="custom-control-label" for="ba">BA. Hasil Pengadaan</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="sptjm" value="12">
                                        <label class="custom-control-label" for="sptjm">SPTJM</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="pertagih" value="13">
                                        <label class="custom-control-label" for="pertagih">Pertagih</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="ku17" value="14">
                                        <label class="custom-control-label" for="ku17">KU 17 + Kuitansi</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="fakturpajak" value="15">
                                        <label class="custom-control-label" for="fakturpajak">Faktur Pajak + SSP</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
                                        <input class="custom-control-input" type="checkbox" name="checklist[]" id="spp" value="16">
                                        <label class="custom-control-label" for="spp">SPP</label>
                                    </div>
                                </div>
                            </div>

                            <input type="submit"  class="btn btn-primary pull-right" value="Submit">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('js')




<script type="text/javascript">
    $(document).ready(function() {
        seedFile();
    });
    
    $('#lokasi').on('change', function() {
        $('input[name="lokasi"]').val($(this).val());
        $("#file").val('').change();
        $("#file").select2('destroy');
        $("#file").empty();
        seedFile();
    });

    function seedFile() {
        $.ajax({
            type: "GET",
            url: API_URL + "/keuangan/transaksi-file/seed-file/" + $('#lokasi').val(),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loading').show()
            },
            success: function (data) {
                var option = [];
                option.push({
                    id: '',
                    text: '',
                });
                // alert(data[0].tipe.name);
                for (i in data) {
                    option.push({
                        id: data[i].id,
                        text: data[i].file.judul+' ('+data[i].file.perusahaan.nama+')',
                    });
                }
                $('#file').select2({
                    data: option
                });
                @if(!empty($file_id))
                var file_id = '{{$file_id}}';
                $('#file').val(file_id).change();
                @endif
                $('#loading').hide();
            },
            error: function () {
                callSwal('error','Gagal mengambil list file','Silahkan refresh halaman ini',0);
                $('#loading').hide();
            }
        });
    }
</script>
@endsection