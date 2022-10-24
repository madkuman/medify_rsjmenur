<div class="col-lg-12 mb-5">
	@if($allow_crud)
	<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-update-info-khusus"><i class="fa fa-pencil"></i> Edit</button>
	@endif
	<h5 class="text-uppercase pt-15">INFORMASI KHUSUS</h5>
</div>
<div class="col-12">
	<div class="row">
		@if($has_gigi_salah)
		<div class="col-6">
			<h5 class="mb-0"><small>Cabut gigi salah</small></h5>
			<h5 class="font-w400">{{$identitas->cabut_gigi_salah ? 'Ada' : 'Tidak Ada'}}</h5>
		</div>
		@endif
		@if($has_trauma_bur_gigi)
		<div class="col-6">
			<h5 class="mb-0"><small>Trauma bur gigi</small></h5>
			<h5 class="font-w400">{{$identitas->trauma_bur_gigi ? 'Ada' : 'Tidak Ada'}}</h5>
		</div>
		@endif
	</div>
</div>

<div class="col-lg-12"><hr></div>

<div class="modal fade" id="modal-update-info-khusus" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="block rounded block-transparent mb-0">
				<div class="block-header">
					<h3 class="block-title">Edit Informasi Khusus</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content py-0">
					<form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/identitas/update-khusus" method="post">
						{{ csrf_field() }}

						<div class="form-group row">
							<div class="col-12">
								<input type="hidden" class="form-control form-control-lg" id="" name="identitas_id" placeholder="" value="{{ $identitas->id }}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12">
								@if($has_gigi_salah)
									<div class="custom-control custom-checkbox mb-5">
										<input class="custom-control-input" type="checkbox" name="cabut_gigi_salah" id="example-checkbox1" value="1" checked>
										<label class="custom-control-label" for="example-checkbox1">Ada salah Cabut Gigi</label>
									</div>
								@endif
								@if($has_trauma_bur_gigi)
									<div class="custom-control custom-checkbox mb-5">
										<input class="custom-control-input" type="checkbox" name="trauma_bur_gigi" id="example-checkbox2" value="1">
										<label class="custom-control-label" for="example-checkbox2">Ada Trauma Bur Gigi</label>
									</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 text-center">
								<button type="submit" class="btn-alt btn-hero btn-click-animate btn-primary min-width-175 pull-right">
									<i class="fa fa-send mr-5"></i> Simpan
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>