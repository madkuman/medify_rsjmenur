<div class="modal" id="addKebidanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Skrining Gizi Kebidanan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-12">
							<div class="form-group row mb-20">
								<label class="col-12">Apakah asupan makan berkurang karena tidak nafsu makan?</label>
								<div class="col-12">
									<select class="form-control" name="asupan_kebidanan">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-20">
								<label class="col-12">Ada gangguan metabolisme? (DM, gangguan fungsi tiroid, infeksi kronis: HIV/AIDS, TB, Lupus</label>
								<div class="col-12">
									<select class="form-control" name="gangguan_metabolisme">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-20">
								<label class="col-12">Ada pertambahan berat badan yang kurang atau lebih dari anjuran selama kehamilan?</label>
								<div class="col-12">
									<select class="form-control" name="bb_kebidanan">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-20">
								<label class="col-12">Nilai HB < 10 g/dl atau HCT < 30%</label>
								<div class="col-12">
									<select class="form-control" name="hb_hct">
										<option value="0">Tidak</option>
										<option value="1">Ya</option>
									</select>
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