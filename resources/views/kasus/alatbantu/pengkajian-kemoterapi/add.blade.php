<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian Perawatan Pasien Kemoterapi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<h5>Pra Kemoterapi</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Keadaan Umum</label>
								<div class="col-12">
									<input type="text" class="form-control" name="umum_pra" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Tekanan Darah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tekanan_pra" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Temperatur</label>
								<div class="col-12">
									<input type="text" class="form-control" name="temperatur_pra" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nadi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi_pra" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Berat Badan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="berat_pra" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Data</label>
								<div class="col-12">
									<input type="text" class="form-control" name="data_pra" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Pasca Kemoterapi</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Keadaan Umum</label>
								<div class="col-12">
									<input type="text" class="form-control" name="umum_pasca">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Tekanan Darah</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tekanan_pasca">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Temperatur</label>
								<div class="col-12">
									<input type="text" class="form-control" name="temperatur_pasca">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nadi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nadi_pasca">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Berat Badan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="berat_pasca">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Data</label>
								<div class="col-12">
									<input type="text" class="form-control" name="data_pasca">
								</div>
							</div>
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="col-md-5 col-12">
							<h5>Selama Kemoterapi</h5>
							<div class="form-group row mb-5">
								<label class="col-12">Waktu Mulai</label>
								<div class="col-12">
									<input type="text" class="form-control time" placeholder="hh:mm" name="mulai" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Waktu Selesai</label>
								<div class="col-12">
									<input type="text" class="form-control time" placeholder="hh:mm" name="selesai" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Lama Kemoterapi</label>
								<div class="col-12">
									<input type="text" class="form-control time" placeholder="hh:mm" name="lama" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Obat Kemoterapi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Alergi</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alergi" autocomplete="off">
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
				</div>
			</div>
			
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->
</div>