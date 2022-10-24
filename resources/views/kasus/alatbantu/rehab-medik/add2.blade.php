<div class="modal fade" id="addModal2" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Klinik Rehab Medik - Asesmen Lanjutan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<input type="hidden" name="id_rehab" value="{{$item->id}}" class="id-asesmen">
					<input type="hidden" name="id_lanjutan">
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
						{{csrf_field()}}
						<div class="row">
							<div class="col-md-10">
								<div class="form-group row mb-5">
									<label class="col-12">Kesadaran</label>
									<div class="col-12">
										<textarea class="form-control" name="lanjutan_kesadaran"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group row mb-5">
									<label class="col-12">Anamnesia</label>
									<div class="col-12">
										<textarea class="form-control" name="lanjutan_anamnesia"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group row mb-5">
									<label class="col-12">Diagnosa</label>
									<div class="col-12">
										<textarea class="form-control" name="lanjutan_diagnosa"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group row mb-5">
									<label class="col-12">Tindakan Terapi</label>
									<div class="col-12">
										<textarea class="form-control" name="lanjutan_tindakan_terapi"></textarea>
									</div>
								</div>
							</div>
							<div class="col-12"><hr></div>
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