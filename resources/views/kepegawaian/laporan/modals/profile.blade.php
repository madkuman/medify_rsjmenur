<div class="modal fade" id="profilereport" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close text-right mt-20 mr-20" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<form method="get" action="{{ route('profile-report') }}" target="_blank" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="mx-30">
					<h4 class="modal-title mb-10">Pilih Pegawai</h4>
					<div class="form-group">
						<select class="form-control select2-ajax select2-employees" style="width: 100%" name="employee" data-s2="employee">
							<option value="">— Pilih Nama Pegawai —</option>
						</select>
					</div>
				</div>
				@include('kepegawaian.laporan.sign_form')
				<div class="modal-footer">
					<button type="submit" class="btn btn-alt-primary submit-button"><i class="fas fa-print mr-5"></i>Cetak</button>
				</div>
			</form>
		</div>
	</div>
</div>