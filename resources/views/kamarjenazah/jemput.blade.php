@extends('kamarjenazah.layouts.main')

@section('title')
Kamar Jenazah - Medify
@endsection

@section('toprightmenu')
+ Permintaan Penjemputan Jenazah
@endsection

@section('subtitle')
Permintaan Penjemputan Jenazah
@endsection

@section('url')
{{url('kamarjenazah/permintaan_jemput')}}
@endsection

@section('css')
<style type="text/css">
.js-select2 {
    width: 100%;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="block rounded">
        <div class="block-content">
            <h4 class="mb-0">Permintaan Penjemputan Jenazah</h4>
            <hr>
            @if(($flag) == 0)
            <div class="block-header">
                <h3 class="block-title">Cari Pasien</h3>
            </div>
            <div class="block-content">
                <div class="row mb-20">
                    <div class="col-sm-6">
                        <form style="margin-top: 10px" id="pasienSearchForm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari Pasien Berdasarkan Nama, Alamat, No KTP, atau NRP" id="pasienSearch">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="noResult" style="display: none">
                <div class="text-center py-50">
                    Pasien tidak ditemukan. Silahkan coba dengan kata kunci lainnya <br>
                    Atau anda bisa membuat pasien baru<br><br>
                    <button class="btn btn-outline-primary">+ Pasien Baru</button>
                </div>
            </div>

            <div class="table-full-width spinner-container" id="pasienResult">
                <div class="spinner-back">
                    <table class="table table-striped table-hover table-pointer ">
                        <thead>
                            <tr class="header" ng-click="getCurrentPage()">
                                <th style="width:8%">No RM </th>
                                <th style="width:20%">Nama</th>
                                <th style="width:27%">Alamat</th>
                                <th style="width:10%">Kartu Identitas</th>
                            </tr>
                        </thead>
                        <tbody class="spinner-back-placeholder">
                            @for ($i = 0; $i < 5; $i++)
                            <tr class="clickable-row">
                                <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                                <td class="py-10 px-10"><div class=" bg-primary-lighter">&nbsp;</div></td>
                            </tr>
                            @endfor
                        </tbody>
                        <tbody id="renderPasien"></tbody>
                    </table>
                </div>

                <div class="spinner">
                    <td colspan="6"><i class="fa fa-4x fa-asterisk fa-spin text-info"></i></td>
                </div>

                <div class="flex-center" style="">
                    <ul id="pagination" class="pagination"></ul>
                </div>
            </div>
            @endif
            @if($flag)
            <form id="jemputSubmit">
                <h5 class="uppercase">Data Diri Jenazah
                    <hr>
                </h5>


                <div class="row mb-20">
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Nama</label>
                            </div>
                            <div class="col">
                                {{$identitas->name}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Kartu Identitas</label>
                            </div>
                            <div class="col">
                                {{$identitas->jenis_identitas->nama ?? '-'}} - {{$identitas->no_identitas}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>No Rekam Medis</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" value="{{$identitas->id}}" id="idJenazah" name="id" disabled />
                            </div>
                        </div>
                    </div>
                    @if(!empty($kasus_id))
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Nomor Kasus</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" value="{{$kasus_id}}" id="kasus_id" name="kasus_id" readonly="" />
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="col">
                                @if($identitas->gender == 1) Laki laki
                                @else Perempuan
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Pekerjaan</label>
                            </div>
                            <div class="col">
                                {{$identitas->job}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Usia</label>
                            </div>
                            <div class="col">
                                {{$identitas->age}} tahun
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Agama</label>
                            </div>
                            <div class="col">
                                {{$identitas->agama->nama  ?? '-'}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Kelahiran</label>
                            </div>
                            <div class="col">
                                {{$identitas->place_of_birth}}, {{date('d F Y', strtotime($identitas->date_of_birth))}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Pendidikan</label>
                            </div>
                            <div class="col">
                                {{$identitas->pendidikan->nama  ?? '-'}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>Status Pernikahan</label>
                            </div>
                            <div class="col">
                                @if($identitas->marriage == 1 ) Single
                                @elseif($identitas->marriage == 2 ) Menikah
                                @elseif($identitas->marriage == 3 ) Duda/Janda
                                @else -
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-3">
                                <label>No HP</label>
                            </div>
                            <div class="col">
                                {{$identitas->phone}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Alamat</label>
                            </div>
                            <div class="col">
                                {{$identitas->address}},
                                @if(!empty($identitas->alamat_kecamatan))
                                {{$identitas->alamat_kecamatan->nama  ?? '-'}}, {{$identitas->alamat_kota->nama  ?? '-'}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                        <h5 class="text-uppercase">Informasi Kematian</h5>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Tempat Meninggal</label>
                            </div>
                            <div class="col">
                                <select name="tempatMeninggal" class="form-control js-select2" data-size="5" id="selectTempat" onchange="changeTempat()">
                                    <option value="1">Rumah Sakit</option>
                                    <option value="2">Puskesmas</option>
                                    <option value="3">Rumah Tempat Tinggal</option>
                                    <option value="4" selected>Lainnya</option>
                                </select>
                            </div>
                            <div class="col textTempat">
                                <input class="form-control" type="text" id="detailTempat" placeholder="Tempat Meninggal"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Perkiraan Waktu Meninggal</label>
                            </div>
                            <div class="col">
                                <input type="text" class="js-datepicker form-control" id="TanggalMeninggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yy">
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                            <div class="col">
                                <input type="text" class="js-masked-time form-control" id="JamMeninggal" placeholder="00:00">
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Waktu Penjemputan Jenazah</label>
                            </div>
                            <div class="col">
                                <input type="text" class="js-datepicker form-control" id="TanggalJemput" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yy">
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                            <div class="col">
                                <input type="text" class="js-masked-time form-control" id="JamJemput" placeholder="00:00">
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-10">
                            <div class="col-md-3">
                                <label>Dasar Diagnosis</label>
                            </div>
                            <div class="col-md-4">
                                <label class="css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input checkDiagnosis" id="checkDiagnosis1" value="1">
                                    <span class="css-control-indicator"></span> Rekam Medis
                                </label>
                                <br>
                                <label class="css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input checkDiagnosis" id="checkDiagnosis2" value="2">
                                    <span class="css-control-indicator"></span> Pemeriksaan Luar Jenazah
                                </label>
                                <br>
                                <label class="css-control-primary css-checkbox ">
                                    <input type="checkbox" class="css-control-input checkDiagnosis" id="checkDiagnosis3" value="3">
                                    <span class="css-control-indicator"></span> Autopsi Forensik
                                </label>
                            </div>
                            <div class="col-md-5">
                                <label class="css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input checkDiagnosis" id="checkDiagnosis4" value="4">
                                    <span class="css-control-indicator"></span> Autopsi Medis
                                </label>
                                <br>
                                <label class="css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input checkDiagnosis" id="checkDiagnosis5" value="5">
                                    <span class="css-control-indicator"></span> Autopsi Verbal
                                </label>
                                <br>
                                <label class="css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input checkDiagnosis" id="checkDiagnosis6" value="6">
                                    <span class="css-control-indicator"></span> Lainnya
                                    <div class="mt-10">
                                        <input class="form-control" type="text" id="otherDiagnosis" placeholder="Detail diagnosis lainnya"/>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Penyebab Kematian</label>
                            </div>
                            <div class="col">
                                <select name="sebabKematian" class="form-control js-select2" data-size="5" id="selectKematian">
                                    <option value="1" selected>Penyakit Khusus</option>
                                    <option value="2">Penyakit Menular</option>
                                    <option value="3">Penyakit tidak menular</option>
                                    <option value="4">Gangguan Maternal (Kehamilan / persalinan / nifas</option>
                                    <option value="5">Gangguan Perinatal (0-6 hari)</option>
                                    <option value="6">Gejala, Tanda, dan Kondisi lainnya</option>
                                    <option value="7">Cedera Kecelakaan Lalu Lintas</option>
                                    <option value="8">Cedera Kecelakaan Kerja</option>
                                    <option value="9">Cedera Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Detail Penyebab Kematian</label>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" id="detailKematian" placeholder="Detail Penyebab Kematian"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Nomor Induk Kependudukan</label>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" id="nik" placeholder="Nomor Induk Kependudukan"/>
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Nomor Kartu Keluarga</label>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" id="NoKK" placeholder="Nomor Kartu Keluarga"/>
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Status Kependudukan</label>
                            </div>
                            <div class="col">
                                <select name="statusKependudukan" class="form-control js-select2" data-size="5" id="statusKependudukan">
                                    <option value="Penduduk" selected>Penduduk</option>
                                    <option value="Bukan penduduk">Bukan penduduk</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Hubungan Dengan Kepala Keluarga</label>
                            </div>
                            <div class="col">
                                <select name="hubunganKeluarga" class="form-control js-select2" data-size="5" id="hubunganKeluarga">
                                    <option value="Kepala Rumah Tangga" selected>Kepala Rumah Tangga</option>
                                    <option value="Suami / Isteri">Suami / Isteri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Menantu">Menantu</option>
                                    <option value="Cucu">Cucu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Status Jenazah</label>
                            </div>
                            <div class="col">
                                <select name="statusJenazah" class="form-control js-select2" data-size="5" id="statusJenazah" onchange="changeStatus()">
                                    <option value="Belum dimakamkan">Belum dimakamkan</option>
                                    <option value="Telah dimakamkan" selected>Telah dimakamkan</option>
                                </select>
                            </div>
                            <div class="col textStatus">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="js-masked-date-dash form-control" id="TanggalDikubur" placeholder="dd-mm-yyyy">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="js-masked-time form-control" id="JamDikubur" placeholder="00:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                        <h5 class="text-uppercase">Informasi Penanggung Jawab</h5>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Nama</label>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" id="nama_penanggung" placeholder="Nama Penanggungjawab"/>
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="col">
                                <select name="statusKependudukan" class="form-control js-select2" data-size="5" id="kelamin_penanggung">
                                    <option value="Pria" selected>Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Usia</label>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" id="usia_penanggung" placeholder="Usia Penanggungjawab"/>
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mb-20">
                            <div class="col-3">
                                <label>Hubungan</label>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" id="hubungan_penanggung" placeholder="Hubungan Penanggungjawab"/>
                                <div class="invalid-feedback">Isian tidak boleh kosong!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="height: 75px">
                    <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Submit</button>
                    <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                    <button class="btn btn-danger btn-hero pull-right" style="margin-right:8px;" type="submit" formaction="{{url('kamarjenazah/permintaan_jemput')}}"><i class="fa fa-close"></i> Ubah Pasien</button>
                    <button class="btn btn-alt-danger btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                        <i class="fa fa-asterisk fa-spin"></i> Loading
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>

    @endsection


    @section('angular')

    <script type="text/javascript">

        $('#buttonSubmit').click(function() {

            $('#buttonSubmit').hide();
            $('#buttonLoading').show();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            i = 0;
            arr = [];
            $('.checkDiagnosis:checked').each(function () {
                arr[i++]= $(this).val();
            });

            id = $("#idJenazah").val();
            kasus_id = $("#kasus_id").val();
            tanggalmeninggal = $("#TanggalMeninggal").val();
            jammeninggal = $("#JamMeninggal").val();
            tanggaljemput = $("#TanggalJemput").val();
            jamjemput = $("#JamJemput").val();
            meninggal = $("#TanggalMeninggal").val() + ' ' + $("#JamMeninggal").val();
            jemput = $("#TanggalJemput").val() + ' ' + $("#JamJemput").val();

            otherDiagnosis = $("#otherDiagnosis").val();
            tempat = $("#selectTempat").val();
            detailTempat = $("#detailTempat").val();
            kematian = $("#selectKematian").val();
            detailKematian = $("#detailKematian").val();
            nik = $("#nik").val();
            nokk = $("#NoKK").val();
            statusKependudukan = $("#statusKependudukan").val();
            dikubur = $("#TanggalDikubur").val() + ' ' + $("#JamDikubur").val();
            statusJenazah = $("#statusJenazah").val();
            hubunganKeluarga = $("#hubunganKeluarga").val();

            namapenanggung = $("#nama_penanggung").val();
            usiapenanggung = $("#usia_penanggung").val();
            kelaminpenanggung = $("#kelamin_penanggung").val();
            hubunganpenanggung = $("#hubungan_penanggung").val();


            if (jamjemput == '' || jammeninggal == '' || nik == '' || tanggalmeninggal == '' || 
                tanggaljemput == '' || arr[0] == null || nokk == '' || namapenanggung == '' || usiapenanggung == '' ||
                hubunganpenanggung == '') {

                if(jamjemput == '') $("#JamJemput").addClass("is-invalid");
                else 
                {
                    $("#JamJemput").removeClass("is-invalid");
                    $("#JamJemput").addClass("is-valid");
                }
                if(jammeninggal == '') $("#JamMeninggal").addClass("is-invalid");
                else 
                {
                    $("#JamMeninggal").removeClass("is-invalid");
                    $("#JamMeninggal").addClass("is-valid");
                }
                if(nik == '') $("#nik").addClass("is-invalid");
                else 
                {
                    $("#nik").removeClass("is-invalid");
                    $("#nik").addClass("is-valid");
                }
                if(tanggalmeninggal == '') $("#TanggalMeninggal").addClass("is-invalid");
                else 
                {
                    $("#TanggalMeninggal").removeClass("is-invalid");
                    $("#TanggalMeninggal").addClass("is-valid");
                }
                if(tanggaljemput == '') $("#TanggalJemput").addClass("is-invalid");
                else 
                {
                    $("#TanggalJemput").removeClass("is-invalid");
                    $("#TanggalJemput").addClass("is-valid");
                }
                if(arr[0] == '') $("#checkDiagnosis").addClass("is-invalid");
                else 
                {
                    $("#checkDiagnosis").removeClass("is-invalid");
                    $("#checkDiagnosis").addClass("is-valid");
                }
                if(nokk == '') $("#nokk").addClass("is-invalid");
                else 
                {
                    $("#nokk").removeClass("is-invalid");
                    $("#nokk").addClass("is-valid");
                }
                if(namapenanggung == '') $("#nama_penanggung").addClass("is-invalid");
                else 
                {
                    $("#nama_penanggung").removeClass("is-invalid");
                    $("#nama_penanggung").addClass("is-valid");
                }
                if(usiapenanggung == '') $("#usia_penanggung").addClass("is-invalid");
                else 
                {
                    $("#usia_penanggung").removeClass("is-invalid");
                    $("#usia_penanggung").addClass("is-valid");
                }
                if(hubunganpenanggung == '') $("#hubungan_penanggung").addClass("is-invalid");
                else 
                {
                    $("#hubungan_penanggung").removeClass("is-invalid");
                    $("#hubungan_penanggung").addClass("is-valid");
                }

                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
                return false;
            }

            if (jamjemput != '' && jammeninggal != '' && nik != '' && tanggalmeninggal != '' && 
                tanggaljemput != '' && arr[0] != null && nokk != '' && namapenanggung != '' && usiapenanggung != '' &&
                hubunganpenanggung != '') {
                    $("#JamJemput").addClass("is-valid");
                    $("#JamMeninggal").addClass("is-valid");
                    $("#nik").addClass("is-valid");
                    $("#TanggalMeninggal").addClass("is-valid");
                    $("#TanggalJemput").addClass("is-valid");
                    $("#checkDiagnosis").addClass("is-valid");
                    $("#nokk").addClass("is-valid");
                    $("#nama_penanggung").addClass("is-valid");
                    $("#usia_penanggung").addClass("is-valid");
                    $("#hubungan_penanggung").addClass("is-valid");
            }

        var formData = new FormData();
        formData.append('jenazah_id', id);
        formData.append('meninggal', meninggal);
        formData.append('kasus_id', kasus_id);
        formData.append('jemput', jemput);
        formData.append('tempat', tempat);
        formData.append('detailTempat', detailTempat);
        formData.append('kematian', kematian);
        formData.append('detailKematian', detailKematian);
        formData.append('detailDiagnosis', otherDiagnosis);
        formData.append('nik', nik);
        formData.append('nokk', nokk);
        formData.append('dikubur', dikubur);
        formData.append('statusKependudukan', statusKependudukan);
        formData.append('statusJenazah', statusJenazah);
        formData.append('hubunganKeluarga', hubunganKeluarga);
        formData.append('namapenanggung', namapenanggung);
        formData.append('usiapenanggung', usiapenanggung);
        formData.append('kelaminpenanggung', kelaminpenanggung);
        formData.append('hubunganpenanggung', hubunganpenanggung);

        while(i--){
            formData.append('diagnosis'+'['+i+']', arr[i]);
        }

        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }
        
        $.ajax({
            type: "POST",
            url: API_URL + "/kamarjenazah/permintaan-baru",
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {

                callSwalString(response);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });
    
        function callSwalString(string)
        {
            var response = jQuery.parseJSON(string);
            callSwal(response.type,response.title,response.text,response.url);
        }

    });

</script>
<script type="text/javascript">

    function changeTempat()
    {
        var val = document.getElementById("selectTempat").value;
        if(val == 4) $('.textTempat').show();
        else $('.textTempat').hide();
    }

    function changeStatus()
    {
        var val = document.getElementById("statusJenazah").value;
        if(val == "Telah dimakamkan") $('.textStatus').show();
        else $('.textStatus').hide();
    }

</script>

<script type="text/javascript">
    var total_pages = 1;
    var visible_pages = 5;
    var keyword = '';
    var items_show = 10;
    var firstLoadPagination = false;

    loadData();

    function loadPagination(currentPage = 1)
    {
        console.log(total_pages);

        $('#pagination').twbsPagination('destroy');
        $('#pagination').twbsPagination({
            totalPages: total_pages,
            startPage: currentPage,
            visiblePages: visible_pages,
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                loadData(page,keyword);
            }
        });
        firstLoadPagination = true;
    }

    function reloadPagination(currentPage)
    {
        var defaultOpts = {
            totalPages: 20
        };
        console.log('reload');
        console.log(total_pages);
        $('#pagination').twbsPagination($.extend({}, defaultOpts, {
            startPage: currentPage,
            totalPages: total_pages
        }));
    }


    function loadData(currentPage=1,keyword='')
    {
        $('.spinner').fadeIn();
        $('#noResult').hide();
        $('#pasienResult').show();
        $('#renderPasien').hide();
        $('.spinner-back-placeholder').show();
        $.ajax({
            url: API_URL + '/pasien/get?page='+ currentPage + '&keyword=' + keyword,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.total>0)
                {
                    $('#noResult').hide();
                    $('#pasienResult').show();
                    total_pages = Math.ceil(data.total/items_show);
                    var template = $('#template-pasienlist').html();
                    loadMustache(template);
                    var rendered = Mustache.render(template, data);
                    $('.spinner').fadeOut();
                    $('#renderPasien').show();
                    $('#renderPasien').html(rendered);
                    $('.spinner-back-placeholder').hide();
                    loadPagination(currentPage);
                }
                else
                {
                    $('.spinner').fadeOut();
                    $('#noResult').fadeIn();
                    $('#pasienResult').hide();
                    $('.spinner-back-placeholder').hide();
                }
            },
            error: function() {
                alert('error');
            },
        });
    }

    function loadMustache(template) {
        Mustache.parse(template, customTags);
        Mustache.tags = customTags;
    }
    $(document).ready(function() {
        console.log("tes");
        $('#otherDiagnosis').hide();
        $('#pasienSearchForm').submit(function( event ) {
            event.preventDefault();

            keyword = $('#pasienSearch').val();
            console.log(keyword + "tes");
            loadData(1,keyword);
        });

        $('#checkDiagnosis6').click(function(){
            $('#otherDiagnosis').toggle("swing");
        });
    });

</script>

<script id="template-pasienlist" type="x-tmpl-mustache">
    @{{#data}}
    <tr class="clickable-row" data-href="{{url('kamarjenazah/permintaan_jemput/')}}/@{{id}}">
        <td>@{{id}}</td>
        <td>
            @{{name}}<br>
            @{{jenis_kelamin}}, @{{age}} Tahun
        </td>
        <td>@{{address}}<br>
            @{{kecamatan}},@{{kota}}
        </td>
        <td>
            @{{kartu}}<br>
            @{{no_identitas}}
        </td>
    </tr>
    @{{/data}}
</script>
@endsection
