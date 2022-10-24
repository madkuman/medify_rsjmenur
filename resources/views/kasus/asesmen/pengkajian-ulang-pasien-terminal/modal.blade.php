
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/save">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Pengkajian Ulang Pasien Terminal</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="" id="id">
                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <div class="row">
                        	
							<div class="col-12">
								<h3 class="pt-15">Pengkajian Fisik</h3>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>K/U</label>
							    <input type="text" class="form-control" name="ku" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Observasi TTV</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>TD</label>
							    <input type="text" class="form-control" name="td" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>S/N</label>
							    <input type="text" class="form-control" name="sn" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>RR</label>
							    <input type="text" class="form-control" name="rr" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>GCS</label>
							    <input type="text" class="form-control" name="gcs" >
							</div>
							<div class="col-12">
								<h4 class="pt-15">Penilaian Nyeri</h4>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Skala nyeri</label>
							    <input type="text" class="form-control" name="skala_nyeri" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Karakteristik</label>
							    <input type="text" class="form-control" name="karakteristik" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Lokasi</label>
							    <input type="text" class="form-control" name="lokasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Durasi</label>
							    <input type="text" class="form-control" name="durasi" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Frekuensi</label>
							    <input type="text" class="form-control" name="frekuensi" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Alat Bantu Yang Dipakai</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_ventilator">
							            <span class="css-control-indicator"></span> Ventilator
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_oksigen">
							            <span class="css-control-indicator"></span> Oksigen
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_monitor">
							            <span class="css-control-indicator"></span> Monitor
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="alat_bantu_yang_dipakai_tanpa_alat_bantu">
							            <span class="css-control-indicator"></span> Tanpa Alat Bantu
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Alat Bantu Lainnya</label>
							    <input type="text" class="form-control" name="alat_bantu_lainnya" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Tanda – Tanda Klinis menjelang kematian</h3>
							</div>
							<div class="col-12">
								<h5 class="pt-15">Kehilangan Tonus Otot</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="tonus_otot_relaksasi_otot_muka">
							            <span class="css-control-indicator"></span> Relaksasi otot muka sehingga dagu menjadi turun
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="tonus_otot_kesulitan_dalam_berbicara">
							            <span class="css-control-indicator"></span> Kesulitan dalam berbicara, proses menelan dan hilangnya reflek  menelan
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="tonus_otot_penurunan_kegiatan_traktus">
							            <span class="css-control-indicator"></span> Penurunan kegiatan traktus gastrointestinal, ditandai : nausea, muntah, perut kembung,  obstipasi, dsb
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="tonus_otot_penurunan_control">
							            <span class="css-control-indicator"></span> Penurunan control spinkter urinary dan rectal
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="tonus_otot_gerakan_tubuh_terbatas">
							            <span class="css-control-indicator"></span> Gerakan tubuh yang terbatas
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tanda Kehilangan Tonus Otot Lainnya</label>
							    <input type="text" class="form-control" name="tanda_kehilangan_tonus_otot_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Kelambatan dalam sirkulasi</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kelambatan_dalam_sirkulasi_kemunduran_dalam_sensasi">
							            <span class="css-control-indicator"></span> Kemunduran dalam sensasi
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kelambatan_dalam_sirkulasi_cyanosis">
							            <span class="css-control-indicator"></span> Cyanosis pada daerah ekstermitas
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="kelambatan_dalam_sirkulasi_kulit_dingin">
							            <span class="css-control-indicator"></span> Kulit dingin, pertama kali pada daerah kaki, kemudian tangan, telinga dan hidung
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Tanda Kelambatan Dalam Sirkulasi Lainnya</label>
							    <input type="text" class="form-control" name="tanda_kelambatan_dalam_sirkulasi_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Perubahan Dalam TTV</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_ttv_nadi_lambat_dan_lemah">
							            <span class="css-control-indicator"></span> Nadi lambat dan lemah
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_ttv_tekanan_darah_turun">
							            <span class="css-control-indicator"></span> Tekanan darah turun
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_ttv_pernafasan_cepat">
							            <span class="css-control-indicator"></span> Pernafasan cepat, cepat dangkal dan tidak teratur
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Perubahan Dalam TTV Lainnya</label>
							    <input type="text" class="form-control" name="perubahan_perubahan_dalam_tanda_tanda_vital_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Gangguan Sensoria</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="gangguan_sensoria_penglihatan_kabur">
							            <span class="css-control-indicator"></span> Penglihatan kabur
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="gangguan_sensoria_gangguan_penciuman_dan_perabaan">
							            <span class="css-control-indicator"></span> Gangguan penciuman dan perabaan
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Gangguan Sensoria Lainnya</label>
							    <input type="text" class="form-control" name="gangguan_sensoria_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Perubahan Fisik Saat Menjelang Kematian</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_sirkulasi_melambat">
							            <span class="css-control-indicator"></span> Sirkulasi melambat / ekstremitas dingin
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_tonus_otot_menurun">
							            <span class="css-control-indicator"></span> Tonus otot menurun
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_perubahan_ttv">
							            <span class="css-control-indicator"></span> Perubahan TTV
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_berkemih_dan_defekasi">
							            <span class="css-control-indicator"></span> Berkemih dan defekasi dengan tidak sengaja
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_pasien_kurang_responsive">
							            <span class="css-control-indicator"></span> Pasien kurang responsive
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_kulit_memucat">
							            <span class="css-control-indicator"></span> Kulit memucat
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="perubahan_fisik_saat_menjelang_kematian_pendengaran_terakhir">
							            <span class="css-control-indicator"></span> Berkemih dan defekasi dengan tidak sengaja
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Perubahan Fisik Saat Menjelang Kematian Lainnya</label>
							    <input type="text" class="form-control" name="perubahan_fisik_saat_menjelang_kematian_lainnya" >
							</div>
							<div class="col-12">
								<h5 class="pt-15">Petunjuk Tentang Indikasi Kematian</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="petunjuk_indikasi_kematian_tidak_ada_respon_terhadap_rangsangan">
							            <span class="css-control-indicator"></span> Tidak ada respon terhadap rangsangan dari luar secara total
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="petunjuk_indikasi_kematian_tidak_adanya_gerak_dari_otot">
							            <span class="css-control-indicator"></span> Tidak adanya gerak dari otot, khususnya pernafasan.
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="petunjuk_indikasi_kematian_tidak_ada_reflek">
							            <span class="css-control-indicator"></span> Tidak ada reflek
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-checkbox">
							            <input type="checkbox" value="1" class="css-control-input" name="petunjuk_indikasi_kematian_gambaran_mendatar_pada_ekg">
							            <span class="css-control-indicator"></span> Gambaran mendatar pada EKG
							        </label>
							    </div>
							</div>
							<div class="col-12">
								&nbsp;
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Petunjuk Tentang Indikasi Kematian Lainnya</label>
							    <input type="text" class="form-control" name="petunjuk_tentang_indikasi_kematian_lainnya" >
							</div>
							<div class="col-12">
								<h3 class="pt-15">Melibatkan Keluarga</h3>
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kesukaan Pasien</label>
							    <input type="text" class="form-control" name="kesukaan_pasien" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Rencana Tempat Pemakaman</label>
							    <input type="text" class="form-control" name="rencana_tempat_pemakaman" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Transportasi Jenazah</label>
							    <input type="text" class="form-control" name="transportasi_jenazah" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Kebiasaan Pasien</label>
							    <input type="text" class="form-control" name="kebiasaan_pasien" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Perawatan Jenazah</label>
							    <input type="text" class="form-control" name="perawatan_jenazah" >
							</div>
							<div class="form-group col-md-3 col-sm-12">
							    <label>Informasi dan Edukasi</label>
							    <textarea class="form-control" name="informasi_dan_edukasi" > </textarea>
							</div>
                        	
                        	<div class="col-12">
								<h5 class="pt-15">Pendampingan Rohaniawan</h5>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="pendampingan_rohaniawan" value="Ya">
							            <span class="css-control-indicator"></span> Ya
							        </label>
							    </div>
							</div>
							<div class="col-md-3">
							    <div class="form-group mb-5">
							        <label class="css-control css-control-primary css-radio">
							            <input type="radio" class="css-control-input" name="pendampingan_rohaniawan" value="Tidak">
							            <span class="css-control-indicator"></span> Tidak
							        </label>
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
