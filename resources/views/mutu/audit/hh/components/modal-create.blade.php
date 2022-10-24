<div class="modal" id="modal-create-hh" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}

			<input type='hidden' value="" name="count" id="count">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Audit Hand Hygiene Baru</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content ">
						<div class="row">
							<div class="col-4">
								<div class="form-group mb-5">
									<label class="mb-5">Tanggal</label>
									<input type="text" class="js-datepicker form-control datepicker" class="form-control" name="tanggal" placeholder="Tanggal " data-autoclose="true" autocomplete="off"  data-date-format="dd/mm/yyyy" required="" value="{{Carbon\Carbon::today()->format('d/m/Y')}}">
								</div>
							</div>
							<div class="col-4">
								<div class="form-group row mb-5">
									<label class="col-12">Jam Mulai</label>
									<div class="col-12">
										<input type="text" name="jam_mulai" class="form-control time" placeholder="hh:mm" required="">
									</div>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group row mb-5">
									<label class="col-12">Jam Selesai</label>
									<div class="col-12">
										<input type="text" name="jam_selesai" class="form-control time" placeholder="hh:mm" required="">
									</div>
								</div>	
							</div>
						</div>
						<div id="tindakan-checkboxes-container">
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<button class="btn btn-primary btn-tambah-kesempatan text-center" type="button">Tambah Kesempatan</button>
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