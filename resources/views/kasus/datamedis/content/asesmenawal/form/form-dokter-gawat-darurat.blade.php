<style type="text/css">
    #modal-dokter-gawat-darurat{
        padding-right: 0px !important;
    }
</style>
<div class="modal fade" id="modal-dokter-gawat-darurat" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-full" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Asesmen Awal Gawat Darurat</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" class="id-asesmen">
                    <input type="hidden" name="jenis" value="Gawat Darurat Dokter">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-5 mt-10">Asesmen Medis</h4>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Riwayat Penyakit</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Keluhan Utama</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="medis_keluhan_utama"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Riwayat Gangguan Sekarang</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="medis_riwayat_gangguan_sekarang"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Riwayat Penyakit Sebelumnya</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="medis_riwayat_penyakit_sebelumnya"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Faktor Keturunan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="medis_faktor_keturunan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Faktor Pencetus</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="medis_faktor_pencetus">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Faktor Organik</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="medis_faktor_organik">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Pemeriksaan Fisik</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kepala Leher</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="fisik_kepala_leher">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Dada</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="fisik_dada">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Jantung</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="fisik_jantung">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Paru</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="fisik_paru">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Perut</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="fisik_perut">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Anggota Gerak</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="fisik_anggota_gerak">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Status Neurologis</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="status_neurologis">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Status Lokalis</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="status_lokalis">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Status Psikiatrik</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kesan Umum</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="psikiatrik_kesan_umum"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Mood dan Affect</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_mood_dan_affect">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kontak</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_kontak">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Persepsi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_persepsi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Pikiran</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_pikiran">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Orientasi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_orientasi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Daya Ingat</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_daya_ingat">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Perhatian</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_perhatian">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Intelegensi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_intelegensi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Pengendalian Impuls</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_pengendalian_impuls">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tilikan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="psikiatrik_tilikan">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Pemeriksaan Penunjang/Tambahan</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Pemeriksaan Penunjang/Tambahan</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="pemeriksaan_penunjang_tambahan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Diagnosis</h5>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Aksis I</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="aksis_1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">ICD 10 Aksis 1</label>
                                    <div class="col-12">
                                        <select style="width: 100%" class="form-control icd10-search" multiple="multiple" name="icd_10_1[]"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Aksis II</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="aksis_2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">ICD 10 Aksis 2</label>
                                    <div class="col-12">
                                        <select style="width: 100%" class="form-control icd10-search" multiple="multiple" name="icd_10_2[]"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Aksis III</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="aksis_3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">ICD 10 Aksis 3</label>
                                    <div class="col-12">
                                        <select style="width: 100%" class="form-control icd10-search" multiple="multiple" name="icd_10_3[]"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Aksis IV</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="aksis_4">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Aksis V</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="aksis_5">
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Masalah Kesehatan Pasien</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Masalah Kesehatan Pasien</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="masalah_kesehatan_pasien"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Perencanaan (Target dan Waktu)</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Perencanaan (Target dan Waktu)</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="perencanaan_target_waktu"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Penatalaksanaan</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Penatalaksanaan</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="penatalaksanaan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Prognosis</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Prognosis</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="prognosis"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Lembar Tindakan</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Jam</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tindakan_jam">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tindakan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tindakan_tindakan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-5">
                                    <label class="col-12">ICD 9 - CM</label>
                                    <div class="col-12">
                                        <select style="width: 100%" class="form-control icd9-search" name="icd_9"></select> 
                                        {{-- <input type="text" class="form-control" name="icd_9"> --}}
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>