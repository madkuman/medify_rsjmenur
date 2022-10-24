<div class="modal"  id="surat-keterangan"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/surat-keterangan" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Surat Keterangan</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					<!-- NAMA -->
					@include('kepegawaian.laporan.component-form.pegawai-select2')

					<!-- KESATUAN -->
					<div class="form-group">
						<div class="form-group">
							<label>Kesatuan</label>
							<select class="form-control js-select2 kesatuan" style="width: 100%" name="kesatuan" data-placeholder="Cari Satker">
								<option></option>
							</select>
						</div>
					</div>

					<!-- KEPERLUAN -->
					<div class="form-group">
						<label>Keperluan</label>
						<div class="form-inline">
							<input type="text" name="keperluan" class="form-control" style="width: 100%">
						</div>
					</div>
					@include('kepegawaian.laporan.component-form.nomor-sprin-text')
					@include('kepegawaian.laporan.component-form.bulan-tahun-combodate')
					@include('kepegawaian.laporan.component-form.status-pegawai-checkboxes')
					@include('kepegawaian.laporan.component-form.tanda-tangan-select2')
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