<div class="modal" id="editModalMaster" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Form CVC untuk BSI</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				@if(!empty($master_bsi->val))
				@php $master_bsi = json_decode($master_bsi->val) @endphp
				@endif
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
										<input type="text" name="tanggal_pasang" class="form-control js-datepicker "  autocomplete="off" data-week-start="1" data-autoclose="true" data-date-format="dd-mm-yyyy" data-today-highlight="true" placeholder="dd-mm-yyyy" required="">
										
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>TANGGAL LEPAS</label>
										<input type="text" name="tanggal_lepas" class="form-control js-datepicker "  autocomplete="off" data-week-start="1" data-autoclose="true" data-date-format="dd-mm-yyyy"data-today-highlight="true" placeholder="dd-mm-yyyy">
									</div>
								</div>
								<div class="col-4">
									<div class="mb-5">
										<label>Lokasi CVC</label>
									</div>


									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="lokasi" value="subclavia" >
											<span class="css-control-indicator"></span> Subclavia
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="lokasi" value="jugularis" >
											<span class="css-control-indicator"></span> Jugularis
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="lokasi" value="femuralis" >
											<span class="css-control-indicator"></span> Femuralis
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="lokasi" value="cephalic" >
											<span class="css-control-indicator"></span> Cephalic
										</label>
									</div>
									<div class="mb-5">
										<input class="form-control" name="lokasi_lainnya">
										<small>Isi Jika Pemasangan CVC pada Lokasi Lainnya</small>
									</div>
								</div>
								<div class="col-4">
									<div class="mb-5">
										<label>Nomor CVC</label>
									</div>

									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="nomor" value="12">
											<span class="css-control-indicator"></span> 12
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="nomor" value="7">
											<span class="css-control-indicator"></span> 7
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="nomor" value="5">
											<span class="css-control-indicator"></span> 5
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="nomor" value="4">
											<span class="css-control-indicator"></span> 4
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="nomor" value="3">
											<span class="css-control-indicator"></span> 3
										</label>
									</div>
									<div class="mb-5">
										<input class="form-control" name="nomor_lainnya">
										<small>Isi Jika Pemasangan menggunakan Nomor CVC Lainnya</small>
									</div>
								</div>
								<div class="col-4">
									<div class="mb-5">
										<label>Jenis CVC</label>
									</div>


									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="jenis" value="4">
											<span class="css-control-indicator"></span> 4 lumen
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="jenis" value="2">
											<span class="css-control-indicator"></span> 3 lumen
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="jenis" value="2">
											<span class="css-control-indicator"></span> 2 lumen
										</label>
									</div>
									<div class="mb-5">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" name="jenis" value="1">
											<span class="css-control-indicator"></span> 1 lumen
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