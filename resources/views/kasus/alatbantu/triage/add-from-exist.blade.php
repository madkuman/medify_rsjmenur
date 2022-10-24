<div class="modal" id="addTriage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Triage</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create-from-exist" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="kasus_id" @if(isset($kasus)) value="{{$kasus->id}}" @endif>
							<div class="row">
								<div class="form-group col-12">
			                        <label for="nama_pasien">Nama Pasien</label>
			                        <input class="form-control" type="text" autocomplete="off" id="nama_pasien" name="nama_pasien" placeholder="Nama Pasien" @if(isset($kasus)) value="{{$kasus->identitas->nama}}" @endif>
			                    </div>
			                </div>
							<div class="form-group">
		                        <label for="triage_id">Pilih Triage...</label>
		                        <select name="triage_id" id="triage_id" class="js-select2 form-control" style="width: 100%" required>
		                            <option value=""></option>
		                            @forelse($triage_exist as $item)
									<option value="{{$item->id}}">{{$item->nama_pasien or '-'}}, Score: {{$item->score}} (Kreator: {{$item->creator->name}})</option>
									@empty
									@endforelse
		                        </select>
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