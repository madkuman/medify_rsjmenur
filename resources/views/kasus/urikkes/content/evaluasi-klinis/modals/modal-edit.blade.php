@php $i = count($evaluasi); @endphp
@foreach ($evaluasi as $key => $eval)
<div class="modal fade modal-gede" id="modal-edit-eval{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modal-gede" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width: 100%; margin: 0%; padding: 0%;">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header pb-0">
                    <h3 class="block-title">Edit Evaluasi {{$i}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content pt-10">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/urikkes/evaluasi-klinis/edit" method="post">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 20%; vertical-align: top; border-right: 1px solid black" class="px-5">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            {{ csrf_field() }}
                                            <input type="hidden" class="form-control form-control-sm" id="" name="kasus_id" placeholder="" value="{{$kasus->nomor_kasus}}">
                                            <input type="hidden" class="form-control form-control-sm" id="" name="eval_id" placeholder="" value="{{$eval->id}}">
                                            INFO UMUM
                                            <div class="pt-10">
                                                <div class="form-group row no-gutters">
                                                    <label class="col-12" for="">Tujuan Pemeriksaan</label>
                                                    <div class="col-12 rpad-0">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="tujuan_pemeriksaan" rows="1" placeholder="" required>{{$eval->tujuan_pemeriksaan}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <label class="col-12" for="">Riwayat Sakit</label>
                                                    <div class="col-12 rpad-0">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="riwayat_sakit" rows="1" placeholder="" required>{{$eval->riwayat_sakit}}</textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Bentuk Badan</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="bentuk-badan" value="{{ $identitas->bentuk_badan }}">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Tinggi Badan</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="tinggi-badan" placeholder="Dalam satuan cm." value="{{ $identitas->tinggi_badan }}">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Berat Badan</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="berat-badan" placeholder="Dalam satuan kg." value="{{ $identitas->berat_badan }}">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Lingkar Perut</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="lingkar_perut" placeholder="Dalam satuan cm." value="{{ $identitas->lingkar_perut }}">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Tekanan Darah Tensi</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="tekanan_darah_tensi" placeholder="Sys/Dia." value="{{ $identitas->tekanan_darah_tensi }}">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Nadi (Per menit)</h6>
                                                    <input required type="text" class="form-control form-control-sm col-6 col-small" id="be-contact-name" name="nadi" value="{{ $identitas->nadi }}">
                                                </div>

                                                <div class="form-group row no-gutters">
                                                    <h6 class="col-6" for="">Golongan Darah</h6>
                                                    <div class="col-6 pad-0">
                                                        <select name="gol_darah" class="form-control col-small" data-size="5" required="true">
                                                            <option value="-">-</option>
                                                            <option value="A" @if($eval->gol_darah == 'A') selected @endif>A</option>
                                                            <option value="B" @if($eval->gol_darah == 'B') selected @endif>B</option>
                                                            <option value="AB" @if($eval->gol_darah == 'AB') selected @endif>AB</option>
                                                            <option value="O" @if($eval->gol_darah == 'O') selected @endif>O</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px">EVALUASI KLINIS</div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Kepala</h6>
                                                    <div class="col-7">

                                                        <select name="kepala" class="form-control col-small pilih" style="width: 100%;" required="true">
                                                            <option value="1" class="normal" @if($eval->kepala == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->kepala == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_kepala">{{$eval->ket_kepala}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Leher</h6>
                                                    <div class="col-7">

                                                        <select name="leher" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->leher == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->leher == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_leher">{{$eval->ket_leher}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Kelenjar Gondok</h6>
                                                    <div class="col-7">

                                                        <select name="gondok" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->gondok == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->gondok == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_gondok">{{$eval->ket_gondok}}</textarea> 
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
                                                            <option value="1" class="normal" @if($eval->hidung == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->hidung == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_hidung">{{$eval->ket_hidung}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Sinus / Foto Water</h6>
                                                    <div class="col-7">

                                                        <select name="sinus" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->sinus == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->sinus == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_sinus">{{$eval->ket_sinus}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Gigi & Mulut</h6>
                                                    <div class="col-7">

                                                        <select name="mulut" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->mulut == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->mulut == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_mulut">{{$eval->ket_mulut}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Lidah</h6>
                                                    <div class="col-7">

                                                        <select name="lidah" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->lidah == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->lidah == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_lidah">{{$eval->ket_lidah}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Tenggorokan</h6>
                                                    <div class="col-7">

                                                        <select name="tenggorokan" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->tenggorokan == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->tenggorokan == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_tenggorokan">{{$eval->ket_tenggorokan}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Tonsil</h6>
                                                    <div class="col-7">

                                                        <select name="tonsil" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->tonsil == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->tonsil == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_tonsil">{{$eval->ket_tonsil}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Telinga</h6>
                                                    <div class="col-7">

                                                        <select name="telinga" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->telinga == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->telinga == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_telinga">{{$eval->ket_telinga}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Audiometri (AD)</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->audio_ad ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="audio_ad" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Audiometri (AS)</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->audio_as ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="audio_as" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Suara Bisikan (AD)</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->suara_ad ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="suara_ad" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Suara Bisikan (AS)</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->suara_as ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="suara_as" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Liang</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->liang ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="liang" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Tajam Pendengaran</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->tajam_pendengaran ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="tajam_pendengaran" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Gendang Kanan</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->gendang_kanan ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="gendang_kanan" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Gendang Kiri</h6>
                                                    <div class="col-7">
                                                        <input value="{{$eval->telinga_cek->gendang_kiri ?? '-'}}" type="text" class="form-control form-control-sm col-small" id="" name="gendang_kiri" rows="1" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">Membran Tympani</h6>
                                                    <div class="col-7">

                                                        <select name="membran_tympani" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->membran_tympani == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->membran_tympani == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_membran_tympani">{{$eval->ket_membran_tympani}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <h6 class="col-5" for="">Mata</h6>
                                                    <div class="col-7">

                                                        <select name="mata" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                            <option value="1" class="normal" @if($eval->mata == 1) selected @endif>Normal</option>
                                                            <option value="0" class="tidak-normal" @if($eval->mata == 0) selected @endif>Tidak Normal</option>
                                                        </select>
                                                        <div class="ket-edit" style="margin-top: 2px;">
                                                            <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_mata">{{$eval->ket_mata}}</textarea> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">OD</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="od" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->od}}" @endif>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-5" for="">OS</h6>
                                                    <div class="col-7">
                                                        <input type="text" class="form-control form-control-sm col-small" id="" name="os" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->os}}" @endif required>  
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

                                                    <select name="mata" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->mata_cek->od == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->mata_cek->od == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_mata">{{$eval->mata_cek->ket_od}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Mata OS</h6>
                                                <div class="col-7">

                                                    <select name="mata" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->mata_cek->os == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->mata_cek->os == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_mata">{{$eval->mata_cek->ket_os}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Visus OD</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="visus_od" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->visus_od}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Visus OS</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="visus_os" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->visus_os}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Visus ODS</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="visus_ods" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->visus_ods}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Bentuk Pupil</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="bentuk_pupil" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->bentuk_pupil}}" @endif required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Koreksi OD</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="koreksi_od" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->koreksi_od}}" @endif required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Koreksi OS</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="koreksi_os" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->koreksi_os}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Add</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="add" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->add}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Bedakan Warna</h6>
                                                <div class="col-7">
                                                    <select name="membedakan_warna" class="form-control col-small pilih" required>
                                                        <option value="Normal" @if(!is_null($eval->mata_cek)) @if($eval->mata_cek->membedakan_warna == "Normal") selected @endif @endif>Normal</option>
                                                        <option value="Buta Warna Parsial" @if(!is_null($eval->mata_cek)) @if($eval->mata_cek->membedakan_warna == "Buta Warna Parsial") selected @endif @endif>Buta Warna Parsial</option>
                                                        <option value="Total" @if(!is_null($eval->mata_cek)) @if($eval->mata_cek->membedakan_warna == "Total") selected @endif @endif>Total</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Pemeriksaan Perimetris</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="pemeriksaan_perimetris" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->pemeriksaan_perimetris}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Tekanan Intraokulair</h6>
                                                <div class="col-7">
                                                    <input type="text" class="form-control form-control-sm col-small" id="" name="tekanan_intraokulair" rows="1" placeholder="" @if(!is_null($eval->mata_cek)) value="{{$eval->mata_cek->tekanan_intraokulair}}" @endif required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Ophtalmoscopy</h6>
                                                <div class="col-7">

                                                    <select name="ophtalmoscopy" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->ophtalmoscopy == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->ophtalmoscopy == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_ophtalmoscopy">{{$eval->ket_ophtalmoscopy}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Pupil</h6>
                                                <div class="col-7">

                                                    <select name="pupil" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->pupil == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->pupil == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_pupil">{{$eval->ket_pupil}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Gerakan Mata</h6>
                                                <div class="col-7">

                                                    <select name="gerakan_mata" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->gerakan_mata == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->gerakan_mata == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_gerakan_mata">{{$eval->ket_ger_mat}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Dada dan Paru Paru</h6>
                                                <div class="col-7">

                                                    <select name="dada_paru" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->dada_paru == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->dada_paru == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_dada_paru">{{$eval->ket_dada_paru}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Perut</h6>
                                                <div class="col-7">

                                                    <select name="perut" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->perut == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->perut == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_perut">{{$eval->ket_perut}}</textarea> 
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
                                                        <option value="1" class="normal" @if($eval->hernia == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->hernia == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_hernia">{{$eval->ket_hernia}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Jantung</h6>
                                                <div class="col-7">

                                                    <select name="jantung" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->jantung == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->jantung == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_jantung">{{$eval->ket_jantung}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Limpa</h6>
                                                <div class="col-7">

                                                    <select name="limpa" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->limpa == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->limpa == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_limpa">{{$eval->ket_limpa}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Hati</h6>
                                                <div class="col-7">

                                                    <select name="hati" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->hati == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->hati == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_hati">{{$eval->ket_hati}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Thorax</h6>
                                                <div class="col-7">

                                                    <select name="thorax" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->thorax == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->thorax == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_thorax">{{$eval->ket_thorax}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Abdomen & Viscera</h6>
                                                <div class="col-7">

                                                    <select name="abdomen_viscera" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->abdomen_viscera == 1) @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->abdomen_viscera == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_abdomen_viscera">{{$eval->ket_abdomen_viscera}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Anus Rectum Fistula</h6>
                                                <div class="col-7">

                                                    <select name="arf" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->arf == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->arf == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_arf">{{$eval->ket_arf}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Sistem Endokrin</h6>
                                                <div class="col-7">

                                                    <select name="endokrin" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->endokrin == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->endokrin == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_endokrin">{{$eval->ket_endokrin}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Sistem Genito Urinaria</h6>
                                                <div class="col-7">

                                                    <select name="genito_urin" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->genito_urin == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->genito_urin == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_genito_urinaria">{{$eval->ket_genito_urinaria}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Extrimitas Bawah</h6>
                                                <div class="col-7">

                                                    <select name="extrimitas_bwh" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->extrimitas_bwh == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->extrimitas_bwh == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_extrimitas_bwh">{{$eval->ket_extrim_bwh}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Extrimitas Atas</h6>
                                                <div class="col-7">

                                                    <select name="extrimitas_atas" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->extrimitas_atas == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->extrimitas_atas == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_extrimitas_atas">{{$eval->ket_extrim_atas}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Kaki</h6>
                                                <div class="col-7">

                                                    <select name="kaki" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->kaki == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->kaki == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_kaki">{{$eval->ket_kaki}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Telapak Kaki</h6>
                                                <div class="col-7">

                                                    <select name="telapak_kaki" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->telapak_kaki == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->telapak_kaki == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">

                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_telapak_kaki">{{$eval->ket_telapak_kaki}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Kulit</h6>
                                                <div class="col-7">

                                                    <select name="kulit" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->kulit == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->kulit == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_kulit">{{$eval->ket_kulit}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Col Vertebralis dan Pelvis</h6>
                                                <div class="col-7">

                                                    <select name="col_vp" class="form-control col-small pilih" style="width: 100%;" data-size="5" required="true">
                                                        <option value="1" class="normal" @if($eval->col_vp == 1) selected @endif>Normal</option>
                                                        <option value="0" class="tidak-normal" @if($eval->col_vp == 0) selected @endif>Tidak Normal</option>
                                                    </select>
                                                    <div class="ket-edit" style="margin-top: 2px;">
                                                        <textarea style="font-size: 11px" placeholder="Keterangan" rows="1" class="form-control form-control-sm" name="ket_col_vp">{{$eval->ket_col_vp}}</textarea> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Neurologi</h6>
                                                <div class="col-7 pad-15">
                                                    <input type="text" class="form-control" id="neurologi" name="neurologi" value="{{$eval->neurologi}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h6 class="col-5" for="">Spirometry</h6>
                                                <div class="col-7 pad-15">
                                                    <input type="text" class="form-control" id="spirometry" name="spirometry" value="{{$eval->spirometry}}" required>
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
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="ecg" rows="1" placeholder="" required>{{$eval->ecg}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="">Mamae</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="mamae" rows="1" placeholder="" required>{{$eval->mamae}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="">Abdomen</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="abdomen" rows="1" placeholder="" required>{{$eval->abdomen}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12" for="">Treadmill</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="treadmill" rows="1" placeholder="" required>{{$eval->treadmill}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-12" for="">Foto X-Ray</label>
                                                    <div class="col-12">
                                                        <textarea type="text" class="form-control form-control-sm" id="" name="x_ray" rows="1" placeholder="" required>{{$eval->x_ray}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label>PAP SMEAR</label>
                                                        <div class="row">
                                                            <div class="col-12" style="padding-right:0px;">
                                                                <textarea type="text" class="form-control" name="pap_smear" autocomplete="off" rows="1" required>{{$eval->pap_smear}}</textarea>
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

@php $i-- ;@endphp
@endforeach
