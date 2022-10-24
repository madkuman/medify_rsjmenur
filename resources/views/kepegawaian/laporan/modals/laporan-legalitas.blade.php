<div class="modal"  id="laporan-legalitas-expired"  role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form class="modal-content form-submit" method="get" action="{{url()->current()}}/laporan-legalitas" target="_blank" enctype="multipart/form-data">
			<div class="block mb-0">
				<div class="block-header">
					<h3 class="block-title">Laporan Legalitas Expired</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content">
					<div class="form-group">
						<label>Jenis Legalitas</label>
						<select class="form-control js-select2" style="width: 100%" name="nama">
							<option value="all">Semua</option>
							<option value="sip">SIP</option>
							<option value="str">STR</option>
							<option value="skk">SKK</option>
							<option value="evkin">Evkin</option>
							<option value="kredensial">Kredensial</option>
						</select>
                    </div>
                    @include('kepegawaian.laporan.component-form.date-range')
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