<div class="modal"  id="daftar-nominatif"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/daftar-nominatif" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Daftar Nominatif Personel</h3>
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
				@include('kepegawaian.laporan.component-form.tanggal-surat-combodate')
				@include('kepegawaian.laporan.component-form.nomor-sprin-text')
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