<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian Awal Rawat Inap Medikal Bedah</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						{{csrf_field()}}
						<div class="col-md-5 col-12">
							<h5>Informasi Umum</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_kedatangan">Tanggal Datang ke RS</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_kedatangan" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_kedatangan">Jam</label>
								<div class="col-12">
									<input type="text" name="jam_kedatangan" class="form-control time" placeholder="hh:mm" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ruangan">Ruangan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ruangan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="agama">Agama</label>
								<div class="col-12">
									<input type="text" class="form-control" name="agama" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alamat">Alamat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alamat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_pengkajian">Tanggal Pengkajian</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_pengkajian" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_pengkajian">Jam</label>
								<div class="col-12">
									<input type="text" name="jam_pengkajian" class="form-control time" placeholder="hh:mm" autocomplete="off">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Alergi / Reaksi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_obat">Alergi Obat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_obat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="reaksi_obat">Reaksi Alergi Obat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_obat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_makanan">Alergi Makanan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_makanan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="reaksi_makanan">Reaksi Alergi Makanan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_makanan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alergi_lain">Alergi Lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi_lain" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alamat">Reaksi Terhadap Alergi Diatas</label>
								<div class="col-12">
									<input type="text" class="form-control" name="reaksi_alergi_lain" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gelang_tanda_alergi">Gelang Tanda Alergi</label>
								<div class="col-12">
									<select class="form-control" id="gelang_tanda_alergi" name="gelang_tanda_alergi">
										<option value="Terpasang">Terpasang</option>
										<option value="Tidak Terpasang" selected>Tidak Terpasang</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Keluhan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="keluhan">Keluhan Utama Masuk Rumah Sakit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan" autocomplete="off">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Kesehatan</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="diagnosis_perawatan">Diagnosis Perawatan Sebelumnya (Bila pernah)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="diagnosis_perawatan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_perawatan">Tempat Perawatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_perawatan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu_perawatan">Waktu Perawatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="waktu_perawatan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alat_implan_terpasang">Alat Implan Terpasang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alat_implan_terpasang" autocomplete="off">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Psikososial Spiritual</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="status_psikologis">Status Psikologis (Cemas, Takut, Kecenderungan bunuh diri, dll)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="status_psikologis" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="orientasi">Orientasi</label>
								<div class="col-12">
									<select class="form-control" id="orientasi" name="orientasi">
										<option value="Sadar dan Orientasi Baik" selected>Sadar dan Orientasi Baik</option>
										<option value="Tidak sadarkan diri / Orientasi tidak baik">Tidak sadarkan diri / Orientasi tidak baik</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="masalah_perilaku">Masalah Perilaku (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="masalah_perilaku" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="perilaku_kekerasan">Perilaku Kekerasan yang dialami Pasien sebelumnya (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="perilaku_kekerasan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hubungan_keluarga">Hubungan Pasien dengan Anggota Keluarga</label>
								<div class="col-12">
									<select class="form-control" id="hubungan_keluarga" name="hubungan_keluarga">
										<option value="Baik" selected>Baik</option>
										<option value="Tidak Baik">Tidak Baik</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_tinggal">Tempat Tinggal</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tempat_tinggal" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nama_kerabat">Nama kerabat terdekat yang dapat dihubungi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nama_kerabat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hubungan_kerabat">Hubungan dengan kerabat tersebut</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hubungan_kerabat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="telepon_kerabat">Nomor telepon kerabat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="telepon_kerabat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kegiatan_keagamaan">Kegiatan keagamaan yang biasa dilakukan (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kegiatan_keagamaan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kegiatan_spritual">Kegiatan spiritul yang diperlukan selama perawatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kegiatan_spritual" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Pemeriksaan Fisik</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="kesadaran">Kesadaran</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kesadaran" autocomplete="off">
								</div>
							</div>
							<div class="form-group row gutters-tiny mb-5">
								<label class="col-12" for="tekanan_darah">Tekanan darah (mmHg)</label>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" id="tekanan_darah_1" name="tekanan_darah_1" autocomplete="off">
								</div>
								<div class="col-md-1 col-2 text-center" style="font-size: 20px;">/</div>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" id="tekanan_darah_2" name="tekanan_darah_2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="nadi">Nadi (x/min)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="rr">RR (x/min)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rr" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="temperatur">Temperatur (°C)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="temperatur" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan">Berat Badan (kg)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="berat_badan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tinggi_badan">Tinggi Badan (cm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tinggi_badan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keluhan_gastrointestian">Keluhan Gastrointestinal (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan_gastrointestinal" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pembatasan_makanan">Pembatasan Makanan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pembatasan_makanan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gigi_palsu">Gigi Palsu</label>
								<div class="col-12">
									<select class="form-control" id="gigi_palsu" name="gigi_palsu">
										<option value="Tidak Ada" selected>Tidak Ada</option>
										<option value="Gigi Atas">Gigi Atas</option>
										<option value="Gigi Bawah">Gigi Bawah</option>
										<option value="Gigi Bawah">Gigi Atas & Bawah</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="neurosensori_pendengaran">Neurosensori Pendengaran</label>
								<div class="col-12">
									<input type="text" class="form-control" name="neurosensori_pendengaran" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="neurosensori_penglihatan">Neurosensori Penglihatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="neurosensori_penglihatan" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="eliminasi_defekasi">Eliminasi Defekasi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="eliminasi_defekasi" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="eliminasi_miksi">Eliminasi Miksi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="eliminasi_miksi" autocomplete="off">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" checked="" name="hamil">
									<span class="css-control-indicator"></span> Hamil
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="hpht">HPHT</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hpht" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keluhan_menstruasi">Keluhan Menstruasi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keluhan_menstruasi" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keadaan_kulit">Keadaan Kulit</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keadaan_kulit" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="skor_norton">Skor Norton</label>
								<div class="col-12">
									<input type="text" class="form-control" name="skor_norton" autocomplete="off">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" checked="" name="resiko_dekubitus">
									<span class="css-control-indicator"></span> Resiko Dekubitus
								</label>
							</div><div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" checked="" name="terdapat_luka">
									<span class="css-control-indicator"></span> Terdapat Luka
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lokasi_luka">Lokasi Luka / Lesi lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lokasi_luka" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pemeriksaan_penunjang">Pemeriksaan Penunjang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pemeriksaan_penunjang" autocomplete="off">
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
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>