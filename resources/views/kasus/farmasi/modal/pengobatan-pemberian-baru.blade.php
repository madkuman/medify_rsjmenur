<div class="modal" id="modalFormPemberianObat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form method="POST" action="{{url()->current()}}/pemberian-post" id="form-pemberian-obat">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title text-center">Pemberian Obat</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content ">
						{{csrf_field()}}
						<div class="form-group">
							<input type="hidden" class="input-id" name="id" >
							<input type="hidden" class="input-method" name="method" >
							<label>Nama Obat</label>
							<select class="js-select2 form-control input-select-obat" style="width:100%" multiple="" data-close-on-select="false" name="cpo_ids[]" required>
								@foreach($pengobatan as $item)
									@if(config('medify.kasus.riwayat_pemberian_obat.prevent_input_jika_obat_habis'))
										<option value="{{ $item->id }}" @if($item->sisa < 1) disabled @endif>{{ "$item->nama_obat (Sisa $item->sisa)" }}</option>
									@else
										<option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<span class="badge badge-danger d-none" id="error-nama-pemberian-obat">Nama obat tidak boleh kosong !</span>
						<div class="form-group">
							<label>Jam</label>
							<input type="text" name="jam" class="form-control time input-jam" placeholder="hh:mm" id="jam-pemberian" required="" value="{{Carbon\Carbon::now()->format('H:i')}}" required="">
						</div>
						<div class="form-group">
							<label>Tanggal</label>
							<input type="date" class="form-control input-tanggal" autocomplete="off" name="tanggal" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required="">
						</div>
						<div class="form-group">
							<label>Status</label>
							<select class="form-control input-status" name="status">
								<option value="sukses">Berhasil diberikan</option>
								<option value="pasien_tolak">Pasien menolak</option>
								<option value="kondisi">Batal karena kondisi</option>
								<option value="alergi">Reaksi alergi</option>
								<option value="eso">Efek samping obat</option>
								<option value="tap">obat tidak tersedia</option>
								<option value="belum_diberikan">Belum Diberikan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Evaluasi</label>
							<textarea class="form-control input-evaluasi" name="evaluasi"></textarea>
						</div>
						<div class="form-group">
							<label>Verifikator 1</label>
							@if(config('medify.kasus.verifikator_pemberian_obat.on'))
								<input type="text" class="form-control input-verifikator-name-1" name="verifikator_name" autocomplete="off">
							@else
							<select class="form-control js-select2 input-verified-by" id="verified-by" name="verified_by" style="width: 100%">
								@foreach($kolaborator as $item)
								<option value="{{$item->user->id}}">{{$item->user->name}}</option>
								@endforeach
							</select>
							@endif
							
							@if(config('medify.kasus.ttd_verifikator_pemberian_obat.on'))
								<div id="signature-1" class="mt-1">Silahkan tanda tangan pada kotak dibawah<br/>
									<canvas id="canvas" class="mb-10" width="380" height="200" style="border:1px #c8c5c5 solid;"></canvas>
									<button type="button" class="btn btn-sm btn-outline-danger mr-5 mb-5 float-right clearCanvas">
										<i class="fa fa-trash"></i> Clear
									</button>
								</div>
								<div class="row mt-10">
									<div class="col-md-10">
										<img id="img-signature-1" src=""  class="d-none" style="width:100%; height:200px;">
										<input type="hidden" id="tmp_path_signature_1" name="tmp_path_signature_1">
									</div>
									<div class="col-md-2 mt-10">
										<button type="button" id="btn-edit-ttd-1" class="btn btn-sm btn-outline-secondary mr-5 float-right d-none">
											<i class="fa fa-edit"></i> Edit
										</button>
										<button type="button" id="btn-back-ttd-1" class="btn btn-sm btn-outline-secondary float-right mr-5 d-none">
											<i class="fa fa-refresh"></i> Kembali
										</button>
									</div>
								</div>
							@endif
						</div>
						<div class="form-group">
							<label>Verifikator 2</label>
							@if(config('medify.kasus.verifikator_pemberian_obat.on'))
								<input type="text" class="form-control input-verifikator-name-2" name="verifikator_name_2" autocomplete="off">
							@else
							<select class="form-control js-select2 input-verified-by-2" id="verified-by-2" name="verified_by_2" style="width: 100%">
								@foreach($kolaborator as $item)
								<option value="{{$item->user->id}}">{{$item->user->name}}</option>
								@endforeach
							</select>
							@endif

							@if(config('medify.kasus.ttd_verifikator_pemberian_obat.on'))
								<div id="signature-2" class="mt-1">Silahkan tanda tangan pada kotak dibawah <br>
									<canvas id="canvas2" class="mb-10" width="380" height="200" style="border:1px #c8c5c5 solid;"></canvas>
									<button type="button" class="btn btn-sm btn-outline-danger mr-5 mb-5 float-right clearCanvas2">
										<i class="fa fa-trash"></i> Clear
									</button>
								</div>
								<div class="row mt-10">
									<div class="col-md-10">
										<img id="img-signature-2" src="" class="d-none" style="width:100%; height:200px;">
										<input type="hidden" id="tmp_path_signature_2" name="tmp_path_signature_2">
									</div>
									<div class="col-md-2 mt-10">
										<button type="button" id="btn-edit-ttd-2" class="btn btn-sm btn-outline-secondary float-right mr-5 d-none">
											<i class="fa fa-edit"></i> Edit
										</button>
										<button type="button" id="btn-back-ttd-2" class="btn btn-sm btn-outline-secondary float-right mr-5 d-none">
											<i class="fa fa-refresh"></i> Kembali
										</button>
									</div>
								</div>
							@endif
						</div>
						<span class="badge badge-danger d-none" id="error-verifikator-pemberian-obat">Verifikator 1 dan Verifikator 2 tidak boleh sama !</span>
						@if(config('medify.kasus.info_pemberian_obat.on'))
							<div class="form-group">
								<label>Dibuat Oleh</label>
								<input type="text" class="form-control input-created-by" readonly value="-">
							</div>
							<div class="form-group">
								<label>Diupdate Oleh</label>
								<input type="text" class="form-control input-updated-by" readonly value="-">
							</div>
						@endif

					</div>
				</div>
				<div class="modal-footer" style="justify-content: flex-start;">
					<div class="form-group" style="width:100%">
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple pull-right save-pemberian-obat" id="submit-pemberian">Simpan</button>
						<button type="button" class="btn btn-default btn-simple pull-right mr-5" data-dismiss="modal">Batal</button>
						<button type="button" class="btn btn-danger btn-simple deleteBtnPemberian" data-id="" >Hapus</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>
