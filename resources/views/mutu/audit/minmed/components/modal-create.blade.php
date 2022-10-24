<div class="modal" id="modal-create-minmed" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Audit Minmed Kelengkapan Informed Concent</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-12">
							<div class="form-group mb-5 row mx-0">
								<label class="col-12 px-0">No RM</label>
								<input type="text" name="no_rm" class="form-control col-6">
							</div>
							<div class="form-group mb-5 row mx-0">
								<label class="col-12 px-0">Kasus</label>
								<select class="form-control col-6 js-select2" style="width: 50%">
									<option>Ambeien Pantat Kanan</option>
									<option>Kanker Payudara Kiri</option>
								</select>
							</div>
							<div class="form-group mb-5 row mx-0">
								<label class="col-12 px-0">Formulir</label>
								<select class="form-control col-6 js-select2" style="width: 50%">
									<option>Persetujuan Tindakan Medis Pemasangan CVC</option>
									<option>Persetujuan Tindakan Transfusi Darah</option>
									<option>Persetujuan Tindakan Pemasangan Alat Bantu Napas / Intubasi</option>
									<option>Persetujuan Tindakan Hemodialisis</option>
									<option>Persetujuan Tindakan Pembiusan</option>
									<option>Persetujuan Operasi / Tindakan Medis / Tindakan Diagnostik</option>
									<option>Penolakan Operasi / Tindakan Medis / Tindakan Diagnostik</option>
								</select>
							</div>
							<h5 class="mb-5 mt-30">Checklist Kelengkapan Informed Concent</h5>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="identitas">
									<span class="css-control-indicator"></span> Identitas
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pemberian_informasi">
									<span class="css-control-indicator"></span> Pemberian Informasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="persetujuan_tindakan">
									<span class="css-control-indicator"></span> Persetujuan Tindakan Medis
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ttd">
									<span class="css-control-indicator"></span> TTD
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-group">
							<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->