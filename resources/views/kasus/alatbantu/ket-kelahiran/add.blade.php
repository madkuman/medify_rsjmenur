<div class="modal" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Keterangan Kelahiran</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form method="POST" action="{{url()->current()}}/create">
							{{csrf_field()}}
							<div class="form-group  mb-20">
								<label class=" mb-5">Suami Dari</label>
								<input type="text" name="suami" class="form-control" required value="{{$istri_dari}}">
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Pangkat</label>
								<input type="text" name="pangkat" class="form-control" required value="{{$pangkat}}">
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Kesatuan</label>
								<input type="text" name="kesatuan" class="form-control" required value="{{$kesatuan}}">
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Tanggal Kelahiran</label>
								<input type="text" class="js-datepicker form-control datepicker" class="form-control" name="tanggal" placeholder="Tanggal Kelahiran" data-autoclose="true" autocomplete="off">
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Jam Kelahiran</label>
								<input type="text" name="jam_kelahiran" class="form-control time" placeholder="hh:mm">
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Jenis Kelamin</label>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input kelamin" type="radio" name="kelamin" id="kelamin_l" value="1" checked="">
										<label class="custom-control-label" for="kelamin_l">Laki-Laki</label>
									</div>
									<div class="custom-control custom-radio">
										<input class="custom-control-input kelamin" type="radio" name="kelamin" id="kelamin_p" value="2">
										<label class="custom-control-label" for="kelamin_p">Perempuan</label>
									</div>
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Nomor Partus</label>
								<input type="text" name="no_pastur" class="form-control" required>
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Nama Dokter</label>	
								<select name="dokter" class="form-control js-select2" style="width: 100%;" required>  
									<option value="" selected disabled>Pilih Dokter</option>
									<option value="0">Tidak Ada</option>
									@foreach($dokter as $d)
									<option value="{{$d->id}}">{{$d->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group  mb-20">
								<label class=" mb-5">Nama Penolong</label>	
								<select name="perawat" class="form-control js-select2" style="width: 100%;" required>  
									<option value="" selected disabled>Pilih Penolong</option>
									<option value="0">Tidak Ada</option>
									@foreach($perawat as $p)
									<option value="{{$p->id}}">{{$p->name}}</option>
									@endforeach
								</select>
							</div>

							<div class="modal-footer">
								<div class="form-group">
									<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
									<!-- id="submitPrintKelahiran" -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>