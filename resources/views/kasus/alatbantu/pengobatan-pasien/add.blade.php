<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="{{url()->current()}}/create" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Catatan Pengobatan Pasien</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						{{csrf_field()}}
						<div class="col-12">	
							<div class="form-group row mb-5">
								<label class="col-12">Nama Obat</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Aturan Pemakaian</label>
								<div class="col-12">
									<input type="text" class="form-control" name="aturan">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Rute</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rute">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Keterangan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="keterangan">
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