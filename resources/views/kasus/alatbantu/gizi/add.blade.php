<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Skrining Gizi Dewasa</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-12">
							<div class="form-group row mb-20">
								<label class="col-12">Mengalami penurunan berat badan yang tidak diharapkan 6 bulan terakhir</label>
								<div class="col-12">
									<select class="form-control" id="turun_bb" name="turun_bb">
										<option value="0">Tidak</option>
										<option value="2">Tidak Yakin</option>
										<option value="1">Ya 1-5 kg</option>
										<option value="2">Ya 6-10 kg</option>
										<option value="3">Ya 11-15 kg</option>
										<option value="4">Ya > 15 kg</option>
										<option value="2">Ya, tidak tahu penurunannya</option>
									</select>
								</div>
							</div><div class="form-group row mb-20">
								<label class="col-12">Asupan makanan berkurang karena nafsu makan menurun atau sulit mendapat asupan</label>
								<div class="col-12">
									<select class="form-control" id="asupan_turun" name="asupan_turun">
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