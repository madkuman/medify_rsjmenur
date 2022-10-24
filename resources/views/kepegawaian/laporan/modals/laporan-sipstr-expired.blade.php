<div class="modal"  id="laporan-sipstr-expired"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/laporan-sipstr-expired" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Laporan SIP & STR Expired</h3>
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
						<label>SIP/STR</label>
						<select class="form-control" style="width: 100%" name="sipstr">
							<option value="sip">SIP</option>
							<option value="str">STR</option>
						</select>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label>Pensiun dalam</label>
							<select class="form-control" style="width: 100%" name="expired_in">
								<option value="-1">Telah Expired</option>
								<option value="0">Bulan Ini</option>
								<option value="1">1 Bulan</option>
								<option value="3">3 Bulan</option>
								<option value="6">6 Bulan</option>
								<option value="12">1 Tahun</option>
								<option value="24">2 Tahun</option>
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