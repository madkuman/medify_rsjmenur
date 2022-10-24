<div class="modal fade" id="addModalBayi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog pl-20" style="min-width: 100%">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create-bayi" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Asesmen Persalinan untuk Bayi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="parent_id" >
						<input type="hidden" name="persalinan_bayi_id" >
						<div class="col-6">
							<h5>Anak</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_kelamin">Jenis Kelamin</label>
								<div class="col-12">
									<select class="form-control" name="jenis_kelamin">
										<option value="L">Laki laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lahir_hidup_mati">Lahir Hidup / Mati</label>
								<div class="col-12">
									<select class="form-control" name="lahir_hidup_mati">
										<option value="Hidup">Hidup</option>
										<option value="Mati">Mati</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan">Anak ke</label>
								<div class="col-12">
									<input type="number" name="anak_ke" class="form-control">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="berat_badan">Berat Badan</label>
								<div class="col-12">
									<input type="text" name="berat_badan" class="form-control">
									<small>Dalam satuan kg, misal : 5.5</small>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="panjang_badan">Panjang Badan</label>
								<div class="col-12">
									<input type="text" name="panjang_badan" class="form-control">
									<small>Dalam satuan centi, misal : 120</small>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lingkar_dada">Lingkar dada</label>
								<div class="col-12">
									<input type="text" name="lingkar_dada" class="form-control">
									<small>Dalam satuan centi, misal : 50</small>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lingkar_kepala_bt">Lingkar Kepala :</label>
								<div class="col-12">
									<input type="text" name="lingkar_kepala" class="form-control">
									<small>Dalam satuan centi, misal : 50</small>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lingkar_kepala_bt">Lingkar Lengan Atas :</label>
								<div class="col-12">
									<input type="text" name="lingkar_lengan_atas" class="form-control">
									<small>Dalam satuan centi, misal : 50</small>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kelainan_kongeninal">Kelainan Kongeninal</label>
								<div class="col-12">
									<input type="text" name="kelainan_kongeninal" class="form-control">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Bayi keadaan jelek dan meninggal</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="kemudian_meninggal">Waktu kematian bayi setelah lahir hidup (menit)</label>
								<div class="col-12">
									<input type="text" name="kemudian_meninggal" class="form-control">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="partumBayi">Post partum Bayi lahir mati: sebab kelahiran mati</label>
								<div class="col-12">
									<input type="text" name="partumBayi" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-5 col-12">
							<h5>Apgar Score</h5>							
							<h5 class="mb-0 mt-20">Denyut Jantung</h5>
							<div class="row">
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_denyut_1">1 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_denyut_1">
												<option value="0">0 - Absen</option>
												<option value="1">1 - < 100 BPM</option>
												<option value="2">2 - > 100 BPM</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_denyut_5">5 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_denyut_5">
												<option value="0">0 - Absen</option>
												<option value="1">1 - < 100 BPM</option>
												<option value="2">2 - > 100 BPM</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_denyut_10">10 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_denyut_10">
												<option value="0">0 - Absen</option>
												<option value="1">1 - < 100 BPM</option>
												<option value="2">2 - > 100 BPM</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<h5 class="mb-0 mt-20">Pernafasan</h5>
							<div class="row">
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_pernafasan_1">1 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_pernafasan_1">
												<option value="0">0 - Absen</option>
												<option value="1">1 - Tidak Normal / Pelan</option>
												<option value="2">2 - Baik / Menangis</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_pernafasan_5">5 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_pernafasan_5">
												<option value="0">0 - Absen</option>
												<option value="1">1 - Tidak Normal / Pelan</option>
												<option value="2">2 - Baik / Menangis</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_pernafasan_10">10 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_pernafasan_10">
												<option value="0">0 - Absen</option>
												<option value="1">1 - Tidak Normal / Pelan</option>
												<option value="2">2 - Baik / Menangis</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<h5 class="mb-0 mt-20">Tonus Otot</h5>
							<div class="row">
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_tonus_1">1 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_tonus_1">
												<option value="0">0 - Lemas</option>
												<option value="1">1 - Beberapa Fleksibilitas Ekstrimitas</option>
												<option value="2">2 - Gerakan Aktif</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_tonus_5">5 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_tonus_5">
												<option value="0">0 - Lemas</option>
												<option value="1">1 - Beberapa Fleksibilitas Ekstrimitas</option>
												<option value="2">2 - Gerakan Aktif</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_tonus_10">10 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_tonus_10">
												<option value="0">0 - Lemas</option>
												<option value="1">1 - Beberapa Fleksibilitas Ekstrimitas</option>
												<option value="2">2 - Gerakan Aktif</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<h5 class="mb-0 mt-20">Peka Rangsang</h5>
							<div class="row">
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_peka_1">1 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_peka_1">
												<option value="0">0 - Tidak Ada</option>
												<option value="1">1 - Meringis</option>
												<option value="2">2 - Bersin / Batuk</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_peka_5">5 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_peka_5">
												<option value="0">0 - Tidak Ada</option>
												<option value="1">1 - Meringis</option>
												<option value="2">2 - Bersin / Batuk</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_peka_10">10 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_peka_10">
												<option value="0">0 - Tidak Ada</option>
												<option value="1">1 - Meringis</option>
												<option value="2">2 - Bersin / Batuk</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<h5 class="mb-0 mt-20">Warna</h5>
							<div class="row">
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_warna_1">1 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_warna_1">
												<option value="0">0 - Biru / Pucat</option>
												<option value="1">1 - Ekstremitas Biru, Tubuh Kemerah Merahan</option>
												<option value="2">2 - Semua Kemerah Merahan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_warna_5">5 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_warna_5">
												<option value="0">0 - Biru / Pucat</option>
												<option value="1">1 - Ekstremitas Biru, Tubuh Kemerah Merahan</option>
												<option value="2">2 - Semua Kemerah Merahan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group row mb-5">
										<label class="col-12" for="score_warna_10">10 mnt</label>
										<div class="col-12">
											<select class="form-control" name="score_warna_10">
												<option value="0">0 - Biru / Pucat</option>
												<option value="1">1 - Ekstremitas Biru, Tubuh Kemerah Merahan</option>
												<option value="2">2 - Semua Kemerah Merahan</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Resusitasi</h5>
							<div class="form-group row gutters-tiny mb-5">
								<label class="col-12" for="muka_mulut_awal">0 2 Muka Mulut</label>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control form-control-sm" name="muka_mulut_awal">
								</div>
								<div class="col-md-1 col-2 text-center">s/d</div>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control form-control-sm" name="muka_mulut_akhir">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="muka_mulut_sesudah">0 2 Muka Mulut : Sesudah Lahir</label>
								<div class="col-12">
									<input type="text" name="muka_mulut_sesudah" class="form-control">
								</div>
							</div>
							<div class="form-group row gutters-tiny mb-5">
								<label class="col-12" for="pompa_udara_awal">Pompa udara berulang</label>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" name="pompa_udara_awal">
								</div>
								<div class="col-md-1 col-2 text-center">s/d</div>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" name="pompa_udara_akhir">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pompa_udara_sesudah">Pompa udara berulang : Sesudah Lahir</label>
								<div class="col-12">
									<input type="text" name="pompa_udara_sesudah" class="form-control">
								</div>
							</div>
							<div class="form-group row gutters-tiny mb-5">
								<label class="col-12" for="intubatik_awal">Intubatik Intraceal</label>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" name="intubatik_awal">
								</div>
								<div class="col-md-1 col-2 text-center">s/d</div>
								<div class="col-md-4 col-5">
									<input type="text" class="form-control" name="intubatik_akhir">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="intubatik_sesudah">Intubatik Intraceal : Sesudah Lahir</label>
								<div class="col-12">
									<input type="text" name="intubatik_sesudah" class="form-control">
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