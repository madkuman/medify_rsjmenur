<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian Keperawatan Jiwa</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<h5>Masuk RS</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Alasan Masuk</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="marah">
									<span class="css-control-indicator"></span> Marah-marah
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="merusak">
									<span class="css-control-indicator"></span> Merusak barang
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="bicara_keras">
									<span class="css-control-indicator"></span> Bicara keras
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="memukul">
									<span class="css-control-indicator"></span> Memukul orang
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="menyendiri">
									<span class="css-control-indicator"></span> Menyendiri
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="defisit">
									<span class="css-control-indicator"></span> Defisit bicara
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="bicara_ngelantur">
									<span class="css-control-indicator"></span> Bicara ngelantur
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="tidak_rapi">
									<span class="css-control-indicator"></span> Tidak rapi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mondar_mandir">
									<span class="css-control-indicator"></span> Mondar-mandir
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_alasan_masuk">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Kesehatan / Pengobatan / Perawatan</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Pengobatan sebelumnya</label>
								<div class="col-12">
									<select class="form-control" name="pengobatan">
										<option value="Belum Pernah berobat sebelumnya">Belum Pernah berobat sebelumnya</option>
										<option value="Pengobatan sebelumnya berhasil">Pengobatan sebelumnya berhasil</option>
										<option value="Pengobatan sebelumnya kurang berhasil">Pengobatan sebelumnya kurang berhasil</option>
										<option value="Pengobatan sebelumnya tidak berhasil">Pengobatan sebelumnya tidak berhasil</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Aniaya Fisik</label>
								<div class="col-12">
									<input type="text" class="form-control" name="aniaya_fisik">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Aniaya Seksual</label>
								<div class="col-12">
									<input type="text" class="form-control" name="aniaya_seksual">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Penolakan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penolakan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Kekerasan dalam Keluarga</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kekerasan_keluarga">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Riwayat Tindakan Kriminal</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tindakan_kriminal">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Kesehatan Keluarga</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Anggota keluarga lain yang mengalami gangguan kejiwaan</label>
								<div class="col-12">
									<select class="form-control" name="anggota_keluarga">
										<option value="Tidak">Tidak</option>
										<option value="Ya">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_anggota_keluarga">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Riwayat Psikososial</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Pengalaman masa lalu yang tidak menyenangkan</label>
								<div class="col-12">
									<textarea class="form-control" name="pengalaman"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Konsep diri : gambaran diri, identitas diri, peran diri, ideal diri</label>
								<div class="col-12">
									<textarea class="form-control" name="konsep_diri"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hubungan sosial dan ekonomi : Orang yang berarti</label>
								<div class="col-12">
									<input type="text" class="form-control" name="orang_berarti">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Peran serta dalam kegiatan kelompok / masyarakat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="peran">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hambatan dalam berhubungan dengan orang lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hambatan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pekerjaan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pekerjaan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Penghasilan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penghasilan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pendidikan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pendidikan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nilai dan keyanikan / merasa sakitnya dari Tuhan</label>
								<div class="col-12">
									<select class="form-control" name="nilai_keyakinan">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Kegiatan ibadah / melakukan sembahyang</label>
								<div class="col-12">
									<select class="form-control" name="kegiatan_ibadah">
										<option value="Ya">Ya</option>
										<option value="Tidak">Tidak</option>
										<option value="Cara ibadah tidak sesuai">Cara ibadah tidak sesuai</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Budaya / nilai kepercayaan yang perlu diperhatikan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="budaya_diperhatikan">
								</div>
							</div>
							
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Pemeriksaan Status Mental</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Penampilan / Pakaian</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pakaian_tidak_rapi">
									<span class="css-control-indicator"></span> Tidak rapi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pakaian_tidak_sesuai">
									<span class="css-control-indicator"></span> Penggunaan pakaian tidak sesuai
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pakaian_tidak_normal">
									<span class="css-control-indicator"></span> Cara berpakaian tidak seperti orang normal
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_pakaian">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Pembicaraan</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="cepat">
										<span class="css-control-indicator"></span> Cepat
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="keras">
										<span class="css-control-indicator"></span> Keras
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="gagap">
										<span class="css-control-indicator"></span> Gagap
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="inkoheren">
										<span class="css-control-indicator"></span> Inkoheren
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="apatis">
										<span class="css-control-indicator"></span> Apatis
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="lambat">
										<span class="css-control-indicator"></span> Lambat
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="membisu">
										<span class="css-control-indicator"></span> Membisu
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tidak_memulai">
										<span class="css-control-indicator"></span> Tdk bisa memulai pembicaraan
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_pembicaraan">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Aktivitas Motorik</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="lesu">
										<span class="css-control-indicator"></span> Lesu
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tegang">
										<span class="css-control-indicator"></span> Tegang
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="gelisah">
										<span class="css-control-indicator"></span> Gelisah
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="agitasi">
										<span class="css-control-indicator"></span> Agitasi
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tik">
										<span class="css-control-indicator"></span> Tik
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="grimasen">
										<span class="css-control-indicator"></span> Grimasen
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tremor">
										<span class="css-control-indicator"></span> Tremor
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_motorik">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Alam Perasaan</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="sedih">
										<span class="css-control-indicator"></span> Sedih
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="ketakutan">
										<span class="css-control-indicator"></span> Ketakutan
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="putus_asa">
										<span class="css-control-indicator"></span> Putus asa
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="khawatir">
										<span class="css-control-indicator"></span> Khawatir
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="gembira_berlebihan">
										<span class="css-control-indicator"></span> Gembira berlebihan
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_perasaan">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Afek</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="datar">
										<span class="css-control-indicator"></span> Datar
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tumpul">
										<span class="css-control-indicator"></span> Tumpul
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="labil">
										<span class="css-control-indicator"></span> Labil
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tidak_sesuai">
										<span class="css-control-indicator"></span> Tidak sesuai
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_afek">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Interaksi Selama Wawancara</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="bermusuhan">
										<span class="css-control-indicator"></span> Bermusuhan
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tidak_kooperatif">
										<span class="css-control-indicator"></span> Tidak Kooperatif
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tersinggung">
										<span class="css-control-indicator"></span> Mudah Tersinggung
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="kontak_mata">
										<span class="css-control-indicator"></span> Kontak Mata (-)
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="defensif">
										<span class="css-control-indicator"></span> Defensif
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="curiga">
										<span class="css-control-indicator"></span> Curiga
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_interaksi">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Persepsi</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="pendengaran">
										<span class="css-control-indicator"></span> Pendengaran
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="penglihatan">
										<span class="css-control-indicator"></span> Penglihatan
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="perabaan">
										<span class="css-control-indicator"></span> Perabaan
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="pengecapan">
										<span class="css-control-indicator"></span> Pengecapan
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="penghidu">
										<span class="css-control-indicator"></span> Penghidu
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_persepsi">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Proses Pikir</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="sirkum">
										<span class="css-control-indicator"></span> Sirkumtansial
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tangen">
										<span class="css-control-indicator"></span> Tangensial
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="hilang_asosiasi">
										<span class="css-control-indicator"></span> Kehilangan Asosiasi
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="flight">
										<span class="css-control-indicator"></span> Flight of Ideas
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="blocking">
										<span class="css-control-indicator"></span> Blocking
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="pengulang">
										<span class="css-control-indicator"></span> Pengulangan bicara
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_proses_pikir">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Isi Pikir</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="obsesi">
										<span class="css-control-indicator"></span> Obsesi
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="pobia">
										<span class="css-control-indicator"></span> Pobia
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="hipokondria">
										<span class="css-control-indicator"></span> Hipokondria
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="depersonalisasi">
										<span class="css-control-indicator"></span> Depersonalisasi
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="ide">
										<span class="css-control-indicator"></span> Ide yang terkait
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="magis">
										<span class="css-control-indicator"></span> Pikiran Magis
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_isi_pikir">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Waham</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="agama">
										<span class="css-control-indicator"></span> Agama
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="somatic">
										<span class="css-control-indicator"></span> Somatic
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="kebesaran">
										<span class="css-control-indicator"></span> Kebesaran
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="waham_curiga">
										<span class="css-control-indicator"></span> Curiga
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="nihilistik">
										<span class="css-control-indicator"></span> Nihilistik
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="sisip">
										<span class="css-control-indicator"></span> Sisip Pikir
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="siar">
										<span class="css-control-indicator"></span> Siar Pikir
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="control">
										<span class="css-control-indicator"></span> Control Piker
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_waham">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Tingkat Kesadaran</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="bingung">
										<span class="css-control-indicator"></span> Bingung
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="sedasi">
										<span class="css-control-indicator"></span> Sedasi
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="stupor">
										<span class="css-control-indicator"></span> Stupor
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_kesadaran">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Disorientasi</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="waktu">
										<span class="css-control-indicator"></span> Waktu
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tempat">
										<span class="css-control-indicator"></span> Tempat
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="orang">
										<span class="css-control-indicator"></span> Orang
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_disorientasi">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Memori</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="panjang">
										<span class="css-control-indicator"></span> Gangguan daya ingat jangka panjang
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="pendek">
										<span class="css-control-indicator"></span> Gangguan daya ingat jangka pendek
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="saat_ini">
										<span class="css-control-indicator"></span> Gangguan daya ingat saat ini
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="konfabulasi">
										<span class="css-control-indicator"></span> Konfabulasi
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_memori">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Tingkat Konsentrasi dan Berhitung</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="beralih">
										<span class="css-control-indicator"></span> Mudah beralih
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tidak_berkonsentrasi">
										<span class="css-control-indicator"></span> Tidak mampu berkonsentrasi
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="tidak_berhitung">
										<span class="css-control-indicator"></span> Tidak mampu berhitung
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_konsentrasi">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Kemampuan Penilaian</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="ringan">
										<span class="css-control-indicator"></span> Gangguan ringan
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="bermakna">
										<span class="css-control-indicator"></span> Gangguan bermakna
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_penilaian">
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Daya tilik diri</label>
							</div>
							<div class="row">
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="mengingkari">
										<span class="css-control-indicator"></span> Mengingkari penyakit yang diderita
									</label>
								</div>
								<div class="form-group mb-5 col-md-6">
									<label class="css-control css-control-primary css-checkbox">
										<input type="checkbox" class="css-control-input" name="menyalahkan">
										<span class="css-control-indicator"></span> Menyalahkan hal-hal diluar dirinya
									</label>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan/Penjelasan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan_daya_tilik">
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