<div class="modal"  id="profile-pegawai"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="POST" action="{{url()->current()}}/profile-pegawai" target="_blank" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Resume Pegawai</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					<div class="form-group">
						<div class="form-group">
							<label>Pilih Pegawai</label>
							<select class="js-select2 form-control" id="pegawai" name="pegawai" style="width: 100%;" required>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary checkBtn submit-button">
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
		</form>
	</div>
</div>