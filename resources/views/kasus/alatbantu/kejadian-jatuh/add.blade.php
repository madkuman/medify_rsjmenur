<div class="modal fade" id="addModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="POST" action="{{url()->current()}}/create">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Formulir Kejadian Jatuh</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<input type="hidden" name="id" value="" class="id-asesmen">
					<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
					<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
						{{csrf_field()}}
						<div id="jatuh_ya">
							<div class="row">
								<div class="col-12">
									<h6 class="pt-15 mb-0">Kondisi</h6>
								</div>
								<div class="col-md-6">
									<label class="css-control css-control-primary css-radio">
										<input type="radio" class="css-control-input" name="akibat_jatuh" value="Cacat">
										<span class="css-control-indicator"></span> Cacat
									</label>
									<label class="css-control css-control-primary css-radio">
										<input type="radio" class="css-control-input" name="akibat_jatuh" value="Tidak Cacat" checked>
										<span class="css-control-indicator"></span> Tidak Cacat
									</label>
									<label class="css-control css-control-primary css-radio">
										<input type="radio" class="css-control-input" name="akibat_jatuh" value="Mati">
										<span class="css-control-indicator"></span> Mati
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row mb-5">
										<label class="col-12">Keterangan</label>
										<div class="col-12">
											<input type="text" class="form-control" name="keterangan">
										</div>
									</div>
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
		</div>
	</div>
</div>