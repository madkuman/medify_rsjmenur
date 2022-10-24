<div class="modal"  id="laporan-pensiun"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/laporan-pensiun" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Laporan akan Pensiun</h3>
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
						<div class="form-group">
							<label>Pensiun dalam</label>
							<select class="form-control" style="width: 100%" name="pensiun_dalam">
								<option value="1bulan">1 Bulan</option>
								<option value="2bulan">2 Bulan</option>
								<option value="3bulan">3 Bulan</option>
								<option value="1tahun">1 Tahun</option>
								<option value="2tahun">2 Tahun</option>
								<option value="3tahun">3 Tahun</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary checkBtn  submit-button">
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
		</form>
	</div>
</div>