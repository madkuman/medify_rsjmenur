<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Perencanaan Pulang (Discharge Planning)</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<!-- <div class="block-content row">
						<div class="col-md-5 col-12">
							<div class="form-group row mb-5">
								<label class="col-12">Perlu Pelayanan Home Care</label>
								<div class="col-12">
									<textarea class="form-control" name="home_care"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Perlu Pemasangan Implant</label>
								<div class="col-12">
									<textarea class="form-control" name="implant"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Penggunaan Alat Bantu</label>
								<div class="col-12">
									<textarea class="form-control" name="alat_bantu"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Telah dilakukan pemesanan alat</label>
								<div class="col-12">
									<textarea class="form-control" name="pemesanan_alat"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-1 full-only"></div>
						<div class="col-md-5 col-12">
							<div class="form-group row mb-5">
								<label class="col-12">Dirujuk ke komunitas tertentu</label>
								<div class="col-12">
									<textarea class="form-control" name="komunitas_tertentu"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Dirujuk ke tim terapis</label>
								<div class="col-12">
									<textarea class="form-control" name="tim_terapis"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Dirujuk ke ahli gizi</label>
								<div class="col-12">
									<textarea class="form-control" name="ahli_gizi"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Lain - Lain</label>
								<div class="col-12">
									<textarea class="form-control" name="lain_lain"></textarea>
								</div>
							</div>
						</div>						
					</div> -->
					<div class="block-content row">
						<div class="col-12">
							<h6 class="mb-5 mt-10">Kriteria Discharge Planning</h6>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_umur">
									<span class="css-control-indicator"></span> Umur > 65 Tahun
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_mobilitas">
									<span class="css-control-indicator"></span> Keterbatasan Mobilitas
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_perawatan">
									<span class="css-control-indicator"></span> Perawatan atau pengobatan lanjutan
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_bantuan">
									<span class="css-control-indicator"></span> Bantuan beraktivitas sehari hari
								</label>
							</div>
						</div>
						<div class="col-12">
							<h6 class="mb-5 mt-10">Perencanaan Pulang</h6>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_perawatan_diri">
									<span class="css-control-indicator"></span> Perawatan diri (mandi, BAK, BAB)
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_obat">
									<span class="css-control-indicator"></span> Pemantauan pemberian obat
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_diet">
									<span class="css-control-indicator"></span> Pemantauan diet
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_luka">
									<span class="css-control-indicator"></span> Perawatan luka
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_latihan">
									<span class="css-control-indicator"></span> Latihan fisik lanjutan
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_tenaga_khusus">
									<span class="css-control-indicator"></span> Pendampingan tenaga khusus di rumah
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_medis">
									<span class="css-control-indicator"></span> Bantuan medis/perawatan rumah
								</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" value="dicentang" class="css-control-input" name="discharge_fisik">
									<span class="css-control-indicator"></span> Bantuan aktivitas fisik
								</label>
							</div>
						</div>
						<div class="col-12"><hr></div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</form>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>