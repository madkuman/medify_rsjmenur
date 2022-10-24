<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Resume Pasien Pulang Ranap</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="resume_id" id="id">
						<div class="col-md-5 col-12">
							<h5>Kondisi Umum Pasien (diisi oleh perawat/bidan)</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Suhu</label>
								<div class="col-12">
									<input type="text" class="form-control" name="suhu" id="suhu">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nadi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi" id="nadi">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">RR</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rr" id="rr">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">TD</label>
								<div class="col-12">
									<input type="text" class="form-control" name="td" id="td">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Diet / Nutrisi</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="oral" id="oral">
									<span class="css-control-indicator"></span>Oral
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ngt" id="ngt">
									<span class="css-control-indicator"></span>NGT
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Diet Khusus</label>
								<div class="col-12">
									<input type="text" class="form-control" name="diet_khusus" id="diet_khusus">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Batasan Cairan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="batasan_cairan" id="batasan_cairan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">BAB</label>
								<div class="col-12">
									<select class="form-control" name="bab" id="bab">
										<option value="Normal">Normal</option>
										<option value="Ileostomy/Colostomy">Ileostomy/Colostomy</option>
										<option value="Inkontenesia Urine">Inkontenesia Urine</option>
										<option value="Inkontenesia Alvi">Inkontenesia Alvi</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">BAK</label>
								<div class="col-12">
									<select class="form-control" name="bak" id="bak">
										<option value="Normal">Normal</option>
										<option value="Kateter">Kateter</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Tanggal Pemasangan Kateter Terakhir (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kateter" id="kateter">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Luka / Luka Operasi</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input luka" name="luka[]" value="Bersih">
									<span class="css-control-indicator"></span>Bersih
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input luka" name="luka[]" value="Kering">
									<span class="css-control-indicator"></span>Kering
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input luka" name="luka[]" value="Basah">
									<span class="css-control-indicator"></span>Basah
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input luka" name="luka[]" value="Perinium">
									<span class="css-control-indicator"></span>Perinium
								</label>
							</div>
							<!-- <div class="form-group row mb-5">
								<label class="col-12">Luka / Luka Operasi</label>
								<div class="col-12">
									<select class="form-control" name="luka">
										<option value="Bersih">Bersih</option>
										<option value="Kering">Kering</option>
										<option value="Terdapat Cairan Luka">Terdapat Cairan Luka</option>
									</select>
								</div>
							</div> -->
							<div class="form-group row mb-5">
								<label class="col-12">Cairan Luka (bila ada)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="cairan_luka" id="cairan_luka">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Transfer dan Mobilisasi</label>
								<div class="col-12">
									<select class="form-control" name="transfer" id="transfer">
										<option value="Mandiri">Mandiri</option>
										<option value="Dibantu Sebagian">Dibantu Sebagian</option>
										<option value="Dibantu Penuh">Dibantu Penuh</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Alat Bantu</label>
								<div class="col-12">
									<select class="form-control" name="alat_bantu" id="alat_bantu">
										<option value="Tongkat">Tongkat</option>
										<option value="Kursi Roda">Kursi Roda</option>
										<option value="Trolley / Kereta Dorong">Trolley / Kereta Dorong</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Kondisi Khusus Pasien Kebidanan (diisi oleh bidan)</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Kontraksi Uterus</label>
								<div class="col-12">
									<select class="form-control" name="uterus" id="uterus">
										<option value="">(Kosongkan)</option>
										<option value="Baik">Baik</option>
										<option value="Tidak Baik">Tidak Baik</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Tinggi Fundus Uteri</label>
								<div class="col-12">
									<input type="text" class="form-control" name="fundus_uteri" id="fundus_uteri">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Vulva</label>
								<div class="col-12">
									<select class="form-control" name="vulva" id="vulva">
										<option value="">(Kosongkan)</option>
										<option value="Bersih">Bersih</option>
										<option value="Kotor">Kotor</option>
										<option value="Bengkak">Bengkak</option>
										<option value="Luka Perineum">Luka Perineum</option>
										<option value="Kering">Kering</option>
										<option value="Basah">Basah</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Lochea</label>
								<div class="col-12">
									<select class="form-control" name="lochea" id="lochea">
										<option value="">(Kosongkan)</option>
										<option value="Banyak">Banyak</option>
										<option value="Sedikit">Sedikit</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Warna</label>
								<div class="col-12">
									<input type="text" class="form-control" name="warna" id="warna">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Bau</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bau" id="bau">
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Edukasi</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Edukasi / Penyuluhan Kesehatan yang sudah diberikan</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="penyakit" id="penyakit">
									<span class="css-control-indicator"></span> Penyakit dan pengobatannya
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mengatasi_nyeri" id="mengatasi_nyeri">
									<span class="css-control-indicator"></span> Mengatasi Nyeri
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="persiapan_lingkungan" id="persiapan_lingkungan">
									<span class="css-control-indicator"></span> Persiapan lingkungan dan fasilitas untuk perawatan di rumah
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="perawatan_rumah" id="perawatan_rumah">
									<span class="css-control-indicator"></span> Perawatan di rumah
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="perawatan_luka" id="perawatan_luka">
									<span class="css-control-indicator"></span> Perawatan luka
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="perawatan_ibu" id="perawatan_ibu">
									<span class="css-control-indicator"></span> Perawatan ibu dan bayi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="nasehat" id="nasehat">
									<span class="css-control-indicator"></span> Nasehat Keluarga Berencana
								</label>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Diagnosa dan Anjuran</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Diagnosa Keperawatan selama dirawat</label>
								<div class="col-12">
									<textarea class="form-control" name="diagnosa_keperawatan" id="diagnosa_keperawatan"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Anjuran Keperawatan khusus setelah pulang</label>
								<div class="col-12">
									<textarea class="form-control" name="anjuran_keperawatan" id="anjuran_keperawatan"></textarea>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Manajemen Nyeri</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Obat yang diminum / anti nyeri</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat_diminum" id="obat_diminum">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Efek samping yang mungkin timbul</label>
								<div class="col-12">
									<input type="text" class="form-control" name="efek_samping" id="efek_samping">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Bila nyeri bertambah berat segera ke RS</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nyeri_bertambah" id="nyeri_bertambah">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Barang dan hasil pemeriksaan yang diserahkan pasien / keluarga</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Hasil laborat (jumlah lembar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hasil_laborat" id="hasil_laborat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Foto Rontgen (jumlah lembar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rontgen" id="rontgen">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">CT Scan (jumlah lembar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ct_scan" id="ct_scan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">MRI / MRA (jumlah lembar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="mri" id="mri">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hasil USG (jumlah lembar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="usg" id="usg">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Surat Keterangan Sakit (jumlah lembar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="sk_sakit" id="sk_sakit">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="asuransi" id="asuransi">
									<span class="css-control-indicator"></span> Surat Asuransi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="resume" id="resume">
									<span class="css-control-indicator"></span> Resume Pasien Pulang
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="buku_bayi" id="buku_bayi">
									<span class="css-control-indicator"></span> Buku Bayi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="kartu_goldar" id="kartu_goldar">
									<span class="css-control-indicator"></span> Kartu Golongan Darah Bayi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="sk_lahir" id="sk_lahir">
									<span class="css-control-indicator"></span> Surat Keterangan Lahir
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Barang dan hasil pemeriksaan Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="barang_lain2" id="barang_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Obat yang dibawa</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat_dibawa" id="obat_dibawa">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Bayi diserahkan oleh</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bayi_diserahkan" id="bayi_diserahkan">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Rencana Kontrol Selanjutnya</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Tanggal</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_kontrol" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="" id="tgl_kontrol">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Jam</label>
								<div class="col-12">
									<input type="text" name="jam_kontrol" class="form-control time" placeholder="hh:mm" id="jam_kontrol">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Klinik yang dituju</label>
								<div class="col-12">
									<input type="text" class="form-control" name="klinik" id="klinik">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Bagian</label>
								<div class="col-12">
									<input type="text" class="form-control" name="bagian" id="bagian">
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