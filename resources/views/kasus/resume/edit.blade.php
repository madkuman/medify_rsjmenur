@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Ringkasan Pulang - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block">
                            <div class="block-content pb-15">
                                <h4 class="my-0">Ringkasan Pulang Edit</h4>
                                <hr class="my-20">
                                <div class="pb-10">


                                    <form class="js-validation-be-contact" id="formResume">
                                      {{ csrf_field() }}

                                      <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Diagnosa Masuk</label>
                                                <select name="diagnosa_masuk" id="diagnosa_masuk" class="form-control" required>
                                                    @foreach($kasus->diagnosis as $diag)
                                                    @if($diag->utama==1)
                                                    <option value="{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}" selected="">{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}</option>
                                                    @else
                                                    <option value="{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}">{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Diagnosa Utama</label>
                                                <select name="diagnosa_utama" id="diagnosa_utama" class="form-control" required>
                                                    @foreach($kasus->diagnosis as $diag)
                                                    @if($diag->icd10->code_icd.' - '.$diag->icd10->long_desc==$resume->diagnosa_utama)
                                                    <option value="{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}" selected="">{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}</option>
                                                    @else
                                                    <option value="{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}">{{$diag->icd10->code_icd.' - '.$diag->icd10->long_desc}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Diagnosa Tambahan</label>
                                                <textarea class="form-control form-control-lg" id="diagnosa_tambahan" name="diagnosa_tambahan" rows="4">{{$resume->diagnosa_tambahan}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Jenis Tindakan</label>
                                                <textarea class="form-control form-control-lg" id="jenis_tindakan" name="jenis_tindakan" rows="4">{{$resume->jenis_tindakan}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Alasan Dirawat</label>
                                                <textarea class="form-control form-control-lg" id="alasan_rawat" name="alasan_rawat" rows="4">{{$resume->alasan_rawat}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Ringkasan Penyakit</label>
                                                <textarea class="form-control form-control-lg" id="ringkasan" name="ringkasan" rows="4">{{$resume->ringkasan}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Pemeriksaan Fisik</label>
                                                <textarea class="form-control form-control-lg" id="pemeriksaan_fisik" name="pemeriksaan_fisik" rows="4">{{$resume->pemeriksaan_fisik}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Lab</label>
                                                <textarea class="form-control form-control-lg" id="lab" name="lab" rows="4">{{$resume->lab}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Terapi Pasien</label>
                                                <textarea class="form-control form-control-lg" id="terapi" name="terapi" rows="4">{{$resume->terapi}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Hasil Konsul</label>
                                                <textarea class="form-control form-control-lg" id="hasil_konsul" name="hasil_konsul" rows="4">{{$resume->hasil_konsul}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Perkembangan</label>
                                                <textarea class="form-control form-control-lg" id="perkembangan" name="perkembangan" rows="4">{{$resume->perkembangan}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Keadaan Waktu Pulang</label>
                                                <input type="text" class="form-control" id="keadaan_krs" name="keadaan_krs" value="{{$resume->keadaan_krs}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Kontrol Poli</label>
                                                <select class="js-select2 form-control" id="poli_id" name="poli_id" style="width: 100%;" data-placeholder="Pilih Tujuan Poli">
                                                    <option></option>
                                                    @foreach($poli as $item)
                                                    <option value="{{$item->id}}" @if($resume->poli_id == $item->id) selected @endif>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Waktu Kontrol Ulang</label>
                                                <textarea class="form-control form-control-lg" id="waktu_kontrol" name="waktu_kontrol" rows="4">{{$resume->waktu_kontrol}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Instruksi / Saran tindak lanjut</label>
                                                <textarea class="form-control form-control-lg" id="instruksi" name="instruksi" rows="4">{{$resume->instruksi}}</textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" id="resume_id" name="resume_id" value="{{$resume->id}}">
                                        <input type="hidden" id="kasus_id" name="kasus_id" value="{{$kasus->id}}">

                                        <div class="col-12" style="height: 75px">
                                            <button class="btn btn-success btn-hero pull-right" type="button" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                                            <button class="btn btn-alt-success btn-hero pull-right" style="display: none" type="button"  id="buttonLoading">
                                                <i class="fa fa-asterisk fa-spin"></i> Loading
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Updates -->
</div>
</main>


@endsection

@section('js')
<script type="text/javascript">
    $('#buttonSubmit').click(function() {

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        resume_id = $("#resume_id").val();
        kasus_id = $("#kasus_id").val();
        diagnosa_masuk = $("#diagnosa_masuk").val();
        diagnosa_utama = $("#diagnosa_utama").val();
        diagnosa_tambahan = $("#diagnosa_tambahan").val();
        jenis_tindakan = $("#jenis_tindakan").val();
        alasan_rawat = $("#alasan_rawat").val();
        ringkasan = $("#ringkasan").val();
        pemeriksaan_fisik = $("#pemeriksaan_fisik").val();
        lab = $("#lab").val();
        terapi = $("#terapi").val();
        hasil_konsul = $("#hasil_konsul").val();
        perkembangan = $("#perkembangan").val();
        keadaan_krs = $("#keadaan_krs").val();
        waktu_kontrol = $("#waktu_kontrol").val();
        instruksi = $("#instruksi").val();
        poli_id = $("#poli_id").val();

        var formData = new FormData();
        formData.append('resume_id', resume_id);
        formData.append('kasus_id', kasus_id);
        formData.append('diagnosa_masuk', diagnosa_masuk);
        formData.append('diagnosa_utama', diagnosa_utama);
        formData.append('diagnosa_tambahan', diagnosa_tambahan);
        formData.append('jenis_tindakan', jenis_tindakan);
        formData.append('alasan_rawat', alasan_rawat);
        formData.append('ringkasan', ringkasan);
        formData.append('pemeriksaan_fisik', pemeriksaan_fisik);
        formData.append('lab', lab);
        formData.append('terapi', terapi);
        formData.append('hasil_konsul', hasil_konsul);
        formData.append('perkembangan', perkembangan);
        formData.append('keadaan_krs', keadaan_krs);
        formData.append('waktu_kontrol', waktu_kontrol);
        formData.append('instruksi', instruksi);
        formData.append('poli_id', poli_id);

        $.ajax({
            type: "POST",
            url: API_URL + "/kasus/pengaturan/resume/edit",
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

@endsection