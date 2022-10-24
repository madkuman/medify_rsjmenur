<div class="modal" id="tatalaksana-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form method="POST" action="{{url()->current()}}/pemberian">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title text-center">Riwayat Pemberian Obat</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content autoscroll-x">
						{{csrf_field()}}
						<input type="hidden" name="id_pemberian" id="id-pemberian">
						<style type="text/css">
							th,td {
								padding-left: 10px;
								padding-right: 10px;
							}
						</style>
						<table class="mb-10 table-striped table-bordered">
							<tr id="tr-tanggal">
								<th width="100">
									Tanggal
								</th>
								<td>
									<input type="text" class="js-datepicker form-control" autocomplete="off" name="tgl_baru" data-week-start="1" data-autoclose="true" data-date-format="dd-mm-yyyy" value="" placeholder="dd-mm-yyyy" id="tanggal-pemberian" required="">
								</td>
							</tr>
							<tr id="tr-jam">
								<th>
									Jam
								</th>
								<td>
									<input type="text" name="jam_baru" class="form-control time" placeholder="hh:mm" id="jam-pemberian" required="">
								</td>
							</tr>
							<tr id="tr-aksi">
								<th></th>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple" id="submit-pemberian">Simpan</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>