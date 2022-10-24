<div id="add-dokter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tambah Data Dokter</h4>
			</div>
			<form method="post" action="{{url('urikkes')}}/pengaturan/dokter/save">
				<input type="hidden" name="dokter_id" value="0">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group row">
						<label class="col-3" for="">Sebagai</label>
						<div class="col-9">
							<input type="text" class="form-control form-control-lg" id="" name="sebagai" rows="3" placeholder="" value=""></input>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-3" for="">Nama Dokter</label>
						<div class="col-9">
							<input type="text" class="form-control form-control-lg" id="" name="nama" rows="3" placeholder="" value=""></input>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-3" for="">Keterangan</label>
						<div class="col-9">
							<textarea type="text" class="form-control form-control-lg" id="" name="keterangan" rows="3" placeholder="" value=""></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary"></input>
				</div>
			</form>
		</div>
	</div>
</div>