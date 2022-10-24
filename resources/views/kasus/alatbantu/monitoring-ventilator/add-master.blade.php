<div class="modal" id="editModalMaster" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form Ventilator untuk VAP</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/edit-master" method="POST">
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
							<input type="hidden" class="input-id" name="id" value="">
							{{csrf_field()}}
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>TANGGAL PASANG</label>
										<input type="text" name="tanggal_pasang" class="form-control js-datepicker "  autocomplete="off" data-week-start="1" data-autoclose="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required="" data-today-highlight="true">
										
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>TANGGAL LEPAS</label>
										<input type="text" name="tanggal_lepas" class="form-control js-datepicker "  autocomplete="off" data-week-start="1" data-autoclose="true" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" data-today-highlight="true">
									</div>
								</div>
								<div class="col-4">
									<div class="mb-5">
										<label>Jenis Ventilator</label>
									</div>


									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="jenis_ventilator" value="Tracheostomy" >
											<span class="css-control-indicator"></span> Tracheostomy
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="jenis_ventilator" value="ETT">
											<span class="css-control-indicator"></span> ETT
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
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>