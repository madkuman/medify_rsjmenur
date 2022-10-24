<div class="modal"  id="absensi"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/absensi" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Absensi</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					@include('kepegawaian.laporan.component-form.bulan-tahun-combodate')
					@include('kepegawaian.laporan.component-form.status-pegawai-checkboxes')
					@include('kepegawaian.laporan.component-form.tanda-tangan-select2')
					<div class="form-group">
						<label>Judul Surat</label>
						<div class="form-inline">
							<input type="text" name="judul" class="form-control" style="width:100%">
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