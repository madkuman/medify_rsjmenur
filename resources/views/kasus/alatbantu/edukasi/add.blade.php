<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Edukasi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-6 col-12">
							<h5>Hambatan dalam belajar</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Pendengaran">
									<span class="css-control-indicator"></span> Pendengaran
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Penglihatan">
									<span class="css-control-indicator"></span> Penglihatan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Kognitif">
									<span class="css-control-indicator"></span> Kognitif
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Fisik">
									<span class="css-control-indicator"></span> Fisik
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Budaya">
									<span class="css-control-indicator"></span> Budaya
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Agama">
									<span class="css-control-indicator"></span> Agama
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Emosi">
									<span class="css-control-indicator"></span> Emosi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hambatan[]" value="Bahasa">
									<span class="css-control-indicator"></span> Bahasa
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Hambatan Lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="hambatan[]">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Penerjemah (bila dibutuhkan)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penerjemah[]">
								</div>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<h5>Kebutuhan Pembelajaran Pasien</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembelajaran[]" value="Diagnosa & Manajemen">
									<span class="css-control-indicator"></span> Diagnosa & Manajemen
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembelajaran[]" value="Obat-obatan">
									<span class="css-control-indicator"></span> Obat-obatan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembelajaran[]" value="Perawatan Luka">
									<span class="css-control-indicator"></span> Perawatan Luka
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembelajaran[]" value="Rehabilitasi">
									<span class="css-control-indicator"></span> Rehabilitasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembelajaran[]" value="Manajemen Nyeri">
									<span class="css-control-indicator"></span> Manajemen Nyeri
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembelajaran[]" value="Diet dan nutrisi">
									<span class="css-control-indicator"></span> Diet dan nutrisi
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Kebutuhan Belajar Lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="pembelajaran[]">
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
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>