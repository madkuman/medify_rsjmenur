<div class="modal fade" id="modal-rawat-jalan" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Asesmen Awal Rawat Jalan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" class="id-asesmen">
                    <input type="hidden" name="jenis" value="Rawat Jalan">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-5 mt-10">Informasi Awal</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Alergi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="alergi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Risiko</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="risiko">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tanggal Datang</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tanggal_datang">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Jam Datang</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="jam_datang">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kategori Pasien</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kategori_pasien">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tanggal Rujukan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tanggal_rujukan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Nomor Rujukan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="nomor_rujukan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Dokter pengirim</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="dokter_pengirim">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h4 class="mb-5 mt-10">Asesmen Keperawatan</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tanggal Pengkajian</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tanggal_pengkajian">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Jam Pengkajian</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="jam_pengkajian">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12 full-only"></div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Keluhan Utama</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="keluhan_utama"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Status Fisik</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">GCS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="gcs">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tekanan Darah</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tekanan_darah">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Frekuensi Nadi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="frekuensi_nadi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Berat Badan (kg)</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="berat_badan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Suhu</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="suhu">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Pernapasan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="pernapasan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tinggi Badan (cm)</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tinggi_badan">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Status Psikologis</h5>
                            </div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Penampilan</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="rapi">
                                        <span class="css-control-indicator"></span> Rapi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="tidak_rapi">
                                        <span class="css-control-indicator"></span> Tidak rapi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="tidak_sesuai">
                                        <span class="css-control-indicator"></span> Tidak Sesuai
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-2">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="penampilan_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Pembicaraan</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="keras">
                                        <span class="css-control-indicator"></span> Keras
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="diam">
                                        <span class="css-control-indicator"></span> Diam
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="cepat">
                                        <span class="css-control-indicator"></span> Cepat
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="lambat">
                                        <span class="css-control-indicator"></span> Lambat
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="non_realistis">
                                        <span class="css-control-indicator"></span> Non Realistis
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-2">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="pembicaraan_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Aktivitas Motorik</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="lesu">
                                        <span class="css-control-indicator"></span> Lesu
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="gelisah">
                                        <span class="css-control-indicator"></span> Gelisah
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="mondar_mandir">
                                        <span class="css-control-indicator"></span> Mondar Mandir
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-2">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="aktivitas_motorik_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Alam Perasaan</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="cemas">
                                        <span class="css-control-indicator"></span> Cemas
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="sedih">
                                        <span class="css-control-indicator"></span> Sedih
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="takut">
                                        <span class="css-control-indicator"></span> Takut
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="gembira_berlebihan">
                                        <span class="css-control-indicator"></span> Gembira Berlebihan
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-2">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="alam_perasaan_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12 full-only"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Proses Pikir</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="proses_pikir">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Persepsi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="persepsi">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Status Sosial</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Yang menemani pasien di RS</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="yang_menemani_pasien_di_rs">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Spiritual</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Saat ini apakah pasien membutuhkan pelayanan rohani?</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kebutuhan_pelayanan_rohani_pasien">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Status Ekonomi</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Penanggung jawab biaya perawatan pasien</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="penanggung_jawab_biaya_perawatan_pasien">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Riwayat Kesehatan</h5>
                            </div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Pupil</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="normal">
                                        <span class="css-control-indicator"></span> Normal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="miosis">
                                        <span class="css-control-indicator"></span> Miosis
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="midriasis">
                                        <span class="css-control-indicator"></span> Midriasis
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="isokor">
                                        <span class="css-control-indicator"></span> Isokor
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="anisokor">
                                        <span class="css-control-indicator"></span> Anisokor
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="pupil_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Neuro Sensori Motorik</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="neuro_sensori_motorik_tidak_ada_keluhan">
                                        <span class="css-control-indicator"></span> Tidak Ada Keluhan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="neuro_sensori_motorik_spasme_otot">
                                        <span class="css-control-indicator"></span> Spasme Otot
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="neuro_sensori_motorik_perubahan_sensorik">
                                        <span class="css-control-indicator"></span> Perubahan Sensorik
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="neuro_sensori_motorik_perubahan_motorik">
                                        <span class="css-control-indicator"></span> Perubahan Motorik
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="neuro_sensori_motorik_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Kepala Leher</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kepala_leher_tidak_ada_gangguan">
                                        <span class="css-control-indicator"></span> Tidak ada gangguan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kepala_leher_anemis">
                                        <span class="css-control-indicator"></span> Anemis
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kepala_leher_pernapasan_cuping_hidung">
                                        <span class="css-control-indicator"></span> Pernapasan Cuping Hidung
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kepala_leher_benjolan">
                                        <span class="css-control-indicator"></span> Benjolan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kepala_leher_dispenea">
                                        <span class="css-control-indicator"></span> Dispenea
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kepala_leher_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Thorax</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="thorax_tidak_ada_gangguan">
                                        <span class="css-control-indicator"></span> Tidak ada gangguan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="thorax_asimetris">
                                        <span class="css-control-indicator"></span> Asimetris
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="thorax_wheezing">
                                        <span class="css-control-indicator"></span> Wheezing
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="thorax_ronchi">
                                        <span class="css-control-indicator"></span> Ronchi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="thorax_pernapasan_cuping_hidung">
                                        <span class="css-control-indicator"></span> Pernapasan Cuping Hidung
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="thorax_atelektasis">
                                        <span class="css-control-indicator"></span> Atelektasis
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="thorax_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Muskuloskeletal</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="muskuloskeletal_tidak_ada_gangguan">
                                        <span class="css-control-indicator"></span> Tidak Ada Gangguan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="muskuloskeletal_kerusakan_jaringan_atau_luka">
                                        <span class="css-control-indicator"></span> Kerusakan Jaringan atau Luka
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="muskuloskeletal_fraktur">
                                        <span class="css-control-indicator"></span> Fraktur
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="muskuloskeletal_dislokasi">
                                        <span class="css-control-indicator"></span> Dislokasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="muskuloskeletal_luksasio">
                                        <span class="css-control-indicator"></span> Luksasio
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="muskuloskeletal_perubahan_bentuk_ekstremitas">
                                        <span class="css-control-indicator"></span> Perubahan bentuk ekstremitas
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="muskuloskeletal_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Kulit</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kulit_tidak_ada_gangguan">
                                        <span class="css-control-indicator"></span> Tidak ada gangguan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kulit_luka">
                                        <span class="css-control-indicator"></span> Luka
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kulit_lecet">
                                        <span class="css-control-indicator"></span> Lecet
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kulit_robek">
                                        <span class="css-control-indicator"></span> Robek
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kulit_combus">
                                        <span class="css-control-indicator"></span> Combus
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kulit_ganggren">
                                        <span class="css-control-indicator"></span> Ganggren
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kulit_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Turgor Kulit</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="turgor_normal">
                                        <span class="css-control-indicator"></span> Normal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="turgor_turun">
                                        <span class="css-control-indicator"></span> Turun
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="turgor_kulit_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Edema</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="edema_tidak_ada">
                                        <span class="css-control-indicator"></span> Tidak ada
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="edema_seluruh tubuh">
                                        <span class="css-control-indicator"></span> Seluruh tubuh
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="edema_anggota_gerak">
                                        <span class="css-control-indicator"></span> Anggota gerak
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="edema_kelopak_mata">
                                        <span class="css-control-indicator"></span> Kelopak Mata
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="edema_perut">
                                        <span class="css-control-indicator"></span> Perut
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="edema_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Mukosa Mulut</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="mukosa_lembab">
                                        <span class="css-control-indicator"></span> Lembab
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="mukosa_kering">
                                        <span class="css-control-indicator"></span> kering
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="mukosa_mulut_lain2">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Intoksifikasi</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Makanan/minuman</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="makanan_minuman">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Zat kimia</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="zat_kimia">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Gigitan hewan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="gigitan_hewan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Gas</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="gas">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Obat</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="obat">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Eleminasi</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Frekuensi BAB</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="frekuensi_bab">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Konsistensi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="konsistensi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Warna BAB</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="warna_bab">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12 full-only"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Frekuensi BAK</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="frekuensi_bak">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Warna BAK</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="warna_baK">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12 full-only"></div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Riwayat Penyakit Dahulu</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="riwayat_penyakit_dahulu"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Riwayat Penyakit Keluarga</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="riwayat_penyakit_keluarga"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Riwayat Konsumsi Alkohol</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="riwayat_konsumsi_alkohol"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Riwayat Alergi</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ada_alergi">
                                        <span class="css-control-indicator"></span> Ada Alergi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="tidak_ada_alergi">
                                        <span class="css-control-indicator"></span> Tidak Ada Alergi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="alergi_tidak_diketahui">
                                        <span class="css-control-indicator"></span> Tidak Diketahui
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="gelang_tanda_alergi_terpasang">
                                        <span class="css-control-indicator"></span> Gelang Tanda Alergi Terpasang
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Alergi terhadap</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="alergi_terhadap">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Reaksi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="reaksi">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Skrining Nyeri</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row mb-5 skrining-nyeri-wrapper">
                                    <label class="col-lg-12 col-form-label mt-10">Skala</label>
                                    <div class="col-lg-12 text-center">
                                        <img src="{{url('assets/img/kasus/pain-scale-face-1.jpg')}}" height="50px" class="img-pain-scale-face">
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="text" class="nyeri_scala_input" id="nyeri_scala" name="nyeri_scala" value="0" data-min="0" data-max="10">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lokasi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="nyeri_lokasi">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Durasi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="nyeri_durasi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Frekuensi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="nyeri_frekuensi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Karakteristik Nyeri</label>
                                    <div class="col-12">
                                        <select class="form-control" name="nyeri_karakteristik">
                                            <option value="">-</option>
                                            <option value="Terbakar">Terbakar</option>
                                            <option value="Menjalar">Menjalar</option>
                                            <option value="Menusuk">Menusuk</option>
                                            <option value="Tertekan">Tertekan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12"><hr></div>
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Asesmen Awal Resiko Jatuh</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="pasien_tampak_tidak_seimbang">
                                        <span class="css-control-indicator"></span> PAsien tampak tidak seimbang (sempoyongan atau limbung)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="pasien_memegang_pinggiran">
                                        <span class="css-control-indicator"></span> Pasien memegang pinggiran kursi atau meja atau benda lain
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Penilaian Resiko Jatuh</label>
                                    <div class="col-12">
                                        <select class="form-control" name="penilaian_resiko_jatuh">
                                            <option value="">-</option>
                                            <option value="Tidak Berisiko">Tidak Berisiko</option>
                                            <option value="Resiko Rendah">Resiko Rendah</option>
                                            <option value="Resiko Tinggi">Resiko Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Asesmen Fungsional</h5>
                            </div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Sensorik Penglihatan</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="penglihatan_normal">
                                        <span class="css-control-indicator"></span> Normal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="penglihatan_kabur">
                                        <span class="css-control-indicator"></span> Kabur
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="penglihatan_kacamata">
                                        <span class="css-control-indicator"></span> Kacamata
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="penglihatan_lensa_kontak">
                                        <span class="css-control-indicator"></span> Lensa Kontak
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="sensorik_penglihatan_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Sensorik Penciuman</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="penciuman_normal">
                                        <span class="css-control-indicator"></span> Normal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="penciuman_tidak_normal">
                                        <span class="css-control-indicator"></span> Tidak Normal
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="sensorik_penciuman_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Sensorik Pendengaran</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="pendengaran_normal">
                                        <span class="css-control-indicator"></span> Normal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="pendengaran_tuli_kanan_kiri">
                                        <span class="css-control-indicator"></span> Tuli Kanan/Kiri
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="pendengaran_alat_bantu_dengar_kanan_kiri">
                                        <span class="css-control-indicator"></span> Alat Bantu Dengar Kanan/Kiri
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="sensorik_pendengaran_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Kognitif</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kognitif_orientasi_penuh">
                                        <span class="css-control-indicator"></span> Orientasi Penuh
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kognitif_pelupa">
                                        <span class="css-control-indicator"></span> Pelupa
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kognitif_bingung">
                                        <span class="css-control-indicator"></span> Bingung
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="kognitif_tidak_dapat_dimengerti">
                                        <span class="css-control-indicator"></span> Tidak Dapat Dimengerti
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kognitif_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Motorik Aktivitas Sehari-hari</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="aktivitas_mandiri">
                                        <span class="css-control-indicator"></span> Mandiri
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="aktivitas_bantuan_minimal">
                                        <span class="css-control-indicator"></span> Bantuan Minimal
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="aktivitas_bantuan_sebagian">
                                        <span class="css-control-indicator"></span> Bantuan Sebagian
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="aktivitas_ketergantungan_total">
                                        <span class="css-control-indicator"></span> Ketergantungan Total
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="motorik_aktivitas_seharihari_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Motorik Berjalan</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="berjalan_tidak_ada_kesulitan">
                                        <span class="css-control-indicator"></span> Tidak Ada Kesulitan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="berjalan_sering_jatuh">
                                        <span class="css-control-indicator"></span> Sering Jatuh
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="berjalan_perlu_bantuan">
                                        <span class="css-control-indicator"></span> Perlu Bantuan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="berjalan_kelumpuhan">
                                        <span class="css-control-indicator"></span> Kelumpuhan
                                    </label>
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="motorik_berjalan_lain_lain">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-12"><br></div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Skrining Gizi Awal</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Penurunan Berat Badan 6 Bulan Terakhir</label>
                                    <div class="col-12">
                                        <select class="form-control" name="gizi_enam_bulan">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Tidak Yakin / Ragu-ragu">Tidak Yakin / Ragu-ragu</option>
                                            <option value="Ya, 1-5 kg">Ya, 1-5 kg</option>
                                            <option value="Ya, 6-10 kg">Ya, 6-10 kg</option>
                                            <option value="Ya, 11-15 kg">Ya, 11-15 kg</option>
                                            <option value="Ya, > 15 kg">Ya, > 15 kg</option>
                                            <option value="Ya, Tidak tahu berapa kg">Ya, Tidak tahu berapa kg</option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Asupan Makan Pasien</label>
                                    <div class="col-12">
                                        <select class="form-control" name="gizi_asupan">
                                            <option value="Normal">Normal</option>
                                            <option value="Berkurang, Penurunan Nafsu Makan">Berkurang, Penurunan Nafsu Makan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Pasien dengan kondisi khusus</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="pasien_kondisi_khusus">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Perencanaan Pulang Pasien</h5>
                            </div>
                            <div class="col-12">
                                <h6 class="mb-5 mt-10">Kebutuhan Discharge Planning Awal</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="discharge_planning_tidak_ada">
                                        <span class="css-control-indicator"></span> Tidak Ada
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="discharge_planning_usia_lanjut_60_tahun_lebih">
                                        <span class="css-control-indicator"></span> Usia Lanjut (60 Tahun/lebih)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="discharge_planning_hambatan_mobilisasi">
                                        <span class="css-control-indicator"></span> Hambatan Mobilisasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="discharge_planning_pelayanan_medis">
                                        <span class="css-control-indicator"></span> Membutuhkan pelayanan medis dan pelayana berkelanjutan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="discharge_planning_bergantung_aktivitas">
                                        <span class="css-control-indicator"></span> Bergantung pada orang lain dalam aktivitas harian
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Kriteria Discharge Planning Lain</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="kriteria_discharge_planning_lain">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Keperawatan</h5>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Masalah Keperawatan</label>
                                    <div class="col-12">
                                        <textarea class="form-control" name="masalah_keperawatan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Perencanaan Keperawatan</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_01">
                                        <span class="css-control-indicator"></span> NCP. 01 Harga Diri
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_02">
                                        <span class="css-control-indicator"></span> NCP. 02 Isolasi Sosial
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_03">
                                        <span class="css-control-indicator"></span> NCP. 03 Halusinasi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_04">
                                        <span class="css-control-indicator"></span> NCP. 04 Perilaku Kekerasan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_05">
                                        <span class="css-control-indicator"></span> NCP. 05 Waham
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_06">
                                        <span class="css-control-indicator"></span> NCP. 06 Rencana Bunuh Diri
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="✔" class="css-control-input" name="ncp_07">
                                        <span class="css-control-indicator"></span> NCP. 07 Defisit Perawatan Diri
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Rencana Keperawatan Lainnya</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="rencana_keperawatan_lainnya">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
                            <div class="col-12">
                                <h5 class="mb-5 mt-10">Implementasi Keperawatan</h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tanggal dan Jam</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tanggal_jam_implementasi_keperawatan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Tindakan</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="tindakan_implementasi_keperawatan">
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row mb-5">
                                    <label class="col-12">Evaluasi</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="evaluasi_implementasi_keperawatan">
                                    </div>
                                </div>  
                            </div>
                            <hr class="col-11">
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