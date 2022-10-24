<div class="modal" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Pengumpulan Data Surveilans Infeksi Daerah Operasi - Pasca Operasi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						{{csrf_field()}}
						<input type="hidden" name="type" value="Surveilans Infeksi Luka Post Ops">
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
						<div class="col-md-4 col-12">
							<h5>Post Ops</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="hari_ke">Post Ops hari ke -</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hari_ke" autocomplete="off">
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="rawat_luka">
									<span class="css-control-indicator"></span> Rawat Luka
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="dressing_transparan">
									<span class="css-control-indicator"></span> Dressing Transparan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="dressing_hypavix">
									<span class="css-control-indicator"></span> Dressing Hypavix
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="buang_cairan">
									<span class="css-control-indicator"></span> Buang Cairan (WSD, IDC, Urine)
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="aff_drain">Aff Drain</label>
								<div class="col-12">
									<select class="form-control" id="aff_drain" name="aff_drain">
										<option value="Tidak" selected>Tidak</option>
										<option value="Ya, Oleh Perawat">Ya, Oleh Perawat</option>
										<option value="Ya, Oleh Dokter">Ya, Oleh Dokter</option>
									</select>
								</div>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="angkat_jahitan">
									<span class="css-control-indicator"></span> Angkat Jahitan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="antibiotik_post">
									<span class="css-control-indicator"></span> Antibiotik
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="krs">
									<span class="css-control-indicator"></span> KRS
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="kontrol_poli">
									<span class="css-control-indicator"></span> Kontrol Poli
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="infeksi">
									<span class="css-control-indicator"></span> Infeksi
								</label>
							</div>
						</div>
						<div class="col-md-4 col-12 infeksi-content" style="display: none">
							<h5>Infeksi</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_lokasi_infeksi">Jenis Lokasi Infeksi</label>
								<div class="col-12">
									<select class="form-control jenis_lokasi_infeksi" id="jenis_lokasi_infeksi" name="jenis_lokasi_infeksi">
										<option value="">Pilih</option>
										<option value="Superfisial">Superfisial</option>
										<option value="Dalam">Dalam (Fascial/Otot)</option>
										<option value="Organ">Organ/Rongga</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lokasi_spesifik_infeksi">Lokasi spesifik untuk infeksi organ / rongga</label>
								<div class="col-12">
									<select class="form-control" id="lokasi_spesifik_infeksi" name="lokasi_spesifik_infeksi">
										<option value="" selected>Pilih</option>
										<option value="Saluran Gastrointestinal">Saluran Gastrointestinal</option>
										<option value="Saluran Genital Perempuan">Saluran Genital Perempuan</option>
										<option value="Intra-Abdominal">Intra-Abdominal</option>
										<option value="Endokardium">Endokardium</option>
										<option value="Sendi / Bursa">Sendi / Bursa</option>
										<option value="Peri / Miokardium">Peri / Miokardium</option>
										<option value="Vaginal Cufff">Vaginal Cufff</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lokasi_spesifik_infeksi_lain2">Lokasi spesifik untuk infeksi organ / rongga Lain-lain (tulis apabila tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lokasi_spesifik_infeksi_lain2" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-4 col-12 infeksi-content" style="display: none">
							<h5>Identifikasi IDO</h5>
							<div class="content-kriteria-superfisial" style="display: none">
								@include('kasus.alatbantu.surveilans.content-kriteria-superfisial')
							</div>
							<div class="content-kriteria-dalam" style="display: none">
								@include('kasus.alatbantu.surveilans.content-kriteria-dalam')
							</div>
							<div class="content-kriteria-organ" style="display: none">
								@include('kasus.alatbantu.surveilans.content-kriteria-organ')
							</div>

							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="dx_dokter">
									<span class="css-control-indicator"></span> Diagnosa Dokter
								</label>
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