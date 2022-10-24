<style type="text/css">
label{
    font-size: 13px;
}
h6 {
    font-size: 13px;
    margin-bottom: 0;
}
.form-group{
    margin-bottom: 5px; 
}
.pad-0{
    padding-right: 0;
    padding-left: 0;
}
.rpad-0{
    padding-right: 0;
}
.pad-15{
    padding-right: 15px;
    padding-left: 15px;
}
.col-small{
    width: 100% !important; 
    max-height: 25px !important;
    font-size: 12px !important; 
    padding: 2px !important;
}
</style>
<div class="modal fade" id="modal-create-evaluasi" tabindex="-1" role="dialog" aria-labelledby="modal-create-evaluasi" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width: 100%; margin: 0%; padding: 0%;">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0 p-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Evaluasi Klinis Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <!-- DISINI -->
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/evaluasi-klinis/create" method="post">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 20%; vertical-align: top; border-right: 1px solid black" class="px-5">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            {{ csrf_field() }}
                                            <input type="hidden" class="form-control form-control-sm" id="" name="kasus_id" placeholder="" value="{{$kasus->nomor_kasus}}">

                                            INFO UMUM
                                            <div class="pt-10">
                                                <div class="form-group row no-gutters">
                                                    <label class="col-12" for="">Tujuan Pemeriksaan</label>
                                                    <div class="col-12 rpad-0">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="tujuan_pemeriksaan" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row row no-gutters">
                                                    <label class="col-12" for="">Riwayat Sakit</label>
                                                    <div class="col-12 rpad-0">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="riwayat_sakit" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row row no-gutters">
                                                    <h6 class="col-6" for="">Bentuk Badan</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="bentuk-badan">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Tinggi Badan</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="tinggi-badan" placeholder="Dalam satuan cm.">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Berat Badan</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="berat-badan" placeholder="Dalam satuan kg.">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Lingkar Perut</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="lingkar_perut" placeholder="Dalam satuan cm.">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Tekanan Darah Tensi</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="tekanan_darah_tensi" placeholder="Sys/Dia." >
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Nadi (Per menit)</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="nadi">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Golongan Darah</h6>
                                                    <div class="col-6 pad-0">
                                                        <select name="gol_darah" class="form-control col-small" data-size="5" required="true">
                                                            <option value="" selected disabled>Pilih</option>
                                                            <option value="-">-</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                            <option value="O">O</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px;">EVALUASI KLINIS</div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Kepala</h6>
                                                    <div class="col-7">

                                                        <select name="kepala" class="form-control col-small pilih" style="width: 100%;" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_kepala"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Leher</h6>
                                                    <div class="col-7">

                                                        <select name="leher" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_leher"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Kelenjar Gondok</h6>
                                                    <div class="col-7">

                                                        <select name="gondok" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_gondok"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 20%; vertical-align: top; border-right: 1px solid black" class="px-5">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="pt-10">
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Hidung</h6>
                                                    <div class="col-7">

                                                        <select name="hidung" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_hidung"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Sinus / Foto Water</h6>
                                                    <div class="col-7">

                                                        <select name="sinus" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_sinus"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Gigi & Mulut</h6>
                                                    <div class="col-7">

                                                        <select name="mulut" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_mulut"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Lidah</h6>
                                                    <div class="col-7">

                                                        <select name="lidah" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_lidah"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Tenggorokan</h6>
                                                    <div class="col-7">

                                                        <select name="tenggorokan" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_tenggorokan"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Tonsil</h6>
                                                    <div class="col-7">

                                                        <select name="tonsil" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_tonsil"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Telinga</h6>
                                                    <div class="col-7">

                                                        <select name="telinga" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_telinga"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- telinga start -->
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Audiometri (AD)</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="audio_ad" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Audiometri (AS)</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="audio_as" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Suara Bisikan (AD)</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="suara_ad" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Suara Bisikan (AS)</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="suara_as" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Liang</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="liang" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Tajam Pendengaran</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="tajam_pendengaran" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Gendang Kanan</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="gendang_kanan" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Gendang Kiri</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="gendang_kiri" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <!-- telinga end -->
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Membran Tympani</h6>
                                                    <div class="col-7">

                                                        <select name="membran_tympani" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_membran_tympani"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <h6 class="col-5" for="">Mata</h6>
                                                    <div class="col-7">

                                                        <select name="mata" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal">Normal</option>
                                                            <option value="0" class="tidak-normal">Tidak Normal</option>
                                                        </select>
                                                        <div class="ket" style="margin-top: 2px;">

                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_mata"></textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">OD</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="od" rows="1" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">OS</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="os" rows="1" placeholder="" required>  
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 20%; vertical-align: top; border-right: 1px solid black" class="px-5">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Mata OD</h6>
                                                <div class="col-7">

                                                    <select name="od" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_od"></textarea> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Mata OS</h6>
                                                <div class="col-7">

                                                    <select name="os" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_os"></textarea> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Visus OD</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="visus_od" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Visus OS</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="visus_os" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Visus ODS</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="visus_ods" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Bentuk Pupil</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="bentuk_pupil" rows="1" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Koreksi OD</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="koreksi_od" rows="1" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Koreksi OS</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="koreksi_os" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Add</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="add" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Bedakan Warna</h6>
                                                <div class="col-7">
                                                    <select name="membedakan_warna" class="form-control col-small pilih" required>
                                                        <option value="Normal" checked>Normal</option>
                                                        <option value="Buta Warna Parsial">Buta Warna Parsial</option>
                                                        <option value="Total">Total</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Pemeriksaan Perimetris</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="pemeriksaan_perimetris" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Tekanan Intraokulair</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="tekanan_intraokulair" rows="1" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Ophtalmoscopy</h6>
                                                <div class="col-7">

                                                    <select name="ophtalmoscopy" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_ophtalmoscopy"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Pupil</h6>
                                                <div class="col-7">

                                                    <select name="pupil" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_pupil"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Gerakan Mata</h6>
                                                <div class="col-7">

                                                    <select name="gerakan_mata" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_gerakan_mata"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Dada dan Paru Paru</h6>
                                                <div class="col-7">

                                                    <select name="dada_paru" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_dada_paru"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Perut</h6>
                                                <div class="col-7">

                                                    <select name="perut" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_perut"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 20%; vertical-align: top; border-right: 1px solid black" class="px-5">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Hernia / Varicocele</h6>
                                                <div class="col-7">

                                                    <select name="hernia" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_hernia"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Jantung</h6>
                                                <div class="col-7">

                                                    <select name="jantung" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_jantung"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Limpa</h6>
                                                <div class="col-7">

                                                    <select name="limpa" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_limpa"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Hati</h6>
                                                <div class="col-7">

                                                    <select name="hati" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_hati"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Thorax</h6>
                                                <div class="col-7">

                                                    <select name="thorax" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_thorax"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Abdomen & Viscera</h6>
                                                <div class="col-7">

                                                    <select name="abdomen_viscera" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_abdomen_viscera"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Anus Rectum Fistula</h6>
                                                <div class="col-7">

                                                    <select name="arf" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_arf"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Sistem Endokrin</h6>
                                                <div class="col-7">

                                                    <select name="endokrin" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_endokrin"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Sistem Genito Urinaria</h6>
                                                <div class="col-7">

                                                    <select name="genito_urin" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_genito_urinaria"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Extrimitas Bawah</h6>
                                                <div class="col-7">

                                                    <select name="extrimitas_bwh" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_extrimitas_bwh"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Extrimitas Atas</h6>
                                                <div class="col-7">

                                                    <select name="extrimitas_atas" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_extrimitas_atas"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Kaki</h6>
                                                <div class="col-7">

                                                    <select name="kaki" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_kaki"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Telapak Kaki</h6>
                                                <div class="col-7">

                                                    <select name="telapak_kaki" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_telapak_kaki"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Kulit</h6>
                                                <div class="col-7">

                                                    <select name="kulit" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_kulit"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Col Vertebralis dan Pelvis</h6>
                                                <div class="col-7">

                                                    <select name="col_vp" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal">Normal</option>
                                                        <option value="0" class="tidak-normal">Tidak Normal</option>
                                                    </select>
                                                    <div class="ket" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_col_vp"></textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Neurologi</h6>
                                                <div class="col-7 pad-15">
                                                    <input type="text" class="form-control" id="neurologi" name="neurologi" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Spirometry</h6>
                                                <div class="col-7 pad-15">
                                                    <input type="text" class="form-control" id="spirometry" name="spirometry" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td style="width: 20%; vertical-align: top;" class="px-5">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            PENUNJANG & PAP SMEAR
                                            <div class="pt-10">
                                                <div class="form-group row">
                                                    <label class="col-12" for="">ECG</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="ecg" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="">Mamae</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="mamae" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="">Abdomen</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="abdomen" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="">Treadmill</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="treadmill" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-12" for="">Foto X-Ray</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="x_ray" rows="1" placeholder="" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label>PAP SMEAR</label>
                                                        <div class="row">
                                                            <div class="col-12" style="padding-right:0px;">
                                                                <textarea type="text" class="form-control" name="pap_smear" autocomplete="off" rows="1" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12 text-center">
                                                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                                            <i class="fa fa-send mr-5"></i> Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
