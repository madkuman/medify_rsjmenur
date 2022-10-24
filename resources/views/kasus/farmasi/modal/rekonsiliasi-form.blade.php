<div class="modal" id="modalForm"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/post" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="id" class="input-id">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Rekonsiliasi Obat</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content">
						<div class="row">
							<div class="col-3">
								<div class="form-group">
									<label>Judul Rekonsiliasi</label>
									<input type="text" name="judul" class="form-control input-judul" required>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label>Jenis Rekonsiliasi</label>
									<select class="js-select2 form-control input-jenis" name="jenis" style="width: 100%"required>
										<option value="awal">Awal Pasien MRS</option>
										<option value="transfer">Transfer Pasien</option>
										<option value="pulang">Pasien Pulang</option>
									</select>
								</div>
							</div>
							<div class="col-6" style="padding-top: 27px">
								<button class="btn btn-primary btn-import-data-resep" type="button">
									<i class="fa fa-download"></i> Import Semua Resep
								</button>
								@if(!empty($rekonsiliasi_awal))
								<button class="btn btn-primary btn-import-data-rekon-awal" type="button">
									<i class="fa fa-download"></i> Import Obat MRS
								</button>
								@endif
								@if(!empty($resep_pulang))
								<button class="btn btn-primary btn-import-data-resep-pulang" type="button">
									<i class="fa fa-download"></i> Import Resep Pulang
								</button>
								@endif
							</div>
						</div>
						<table class="table table-bordered table-vcenter" id="rekonsiliasi-form-table">
							<thead>
								<tr>
									<th rowspan="2" style="width: 10%">Tanggal</th>
									<th rowspan="2" style="width: 15%">Nama Obat</th>
									<th rowspan="2">Dosis</th>
									<th rowspan="2">Jumlah</th>
									<th rowspan="2">Rute</th>
									<th rowspan="2">Aturan Pakai</th>
									<th colspan="2" class="text-center" style="border-bottom: 1px solid gainsboro">Diteruskan</th>
									<th rowspan="2">Dihentikan</th>
									<th rowspan="2">Asal Obat</th>
									<th rowspan="2">Delete</th>
								</tr>
								<tr>
									<th>Dosis</th>
									<th>Aturan Pakai</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<div style="width:100%" class="p-10 text-center">
							<button class="btn btn-primary btn-circle" type="button" id="addFormButton">
								<i class="fa fa-plus"></i>
							</button>
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