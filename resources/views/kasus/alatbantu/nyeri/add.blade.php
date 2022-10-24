<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<form action="{{url()->current()}}/create" method="POST">
				{{csrf_field()}}
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Skrining Nyeri</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-6 col-12">
							<div class="form-group row mb-5">
								<label class="col-12">Penilaian Nyeri</label>
								<div class="col-12">
									<select class="form-control" id="penilaian_nyeri" name="penilaian_nyeri">
										@for($i=0;$i<=10;$i++)
										<option value="{{$i}}">{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="mt-5 mb-20">
								<img src="{{url('assets/icons/svg/emot-1.svg')}}" style="width: 40px;">
								<img src="{{url('assets/icons/svg/emot-2.svg')}}" style="width: 40px;">
								<img src="{{url('assets/icons/svg/emot-3.svg')}}" style="width: 40px;">
								<img src="{{url('assets/icons/svg/emot-4.svg')}}" style="width: 40px;">
								<img src="{{url('assets/icons/svg/emot-5.svg')}}" style="width: 40px;">
								<img src="{{url('assets/icons/svg/emot-6.svg')}}" style="width: 40px;">
								<img src="{{url('assets/icons/svg/emot-7.svg')}}" style="width: 40px;">
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Kondisi Nyeri</label>
								<div class="col-12">
									<select class="form-control" id="kondisi_nyeri" name="kondisi_nyeri">
										<option value="Nyeri Kronis">Nyeri Kronis</option>
										<option value="Nyeri Akut">Nyeri Akut</option>
										<option value="Tidak ada nyeri">Tidak ada nyeri</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5 mt-20">
								<label class="col-12">Nyeri hilang apabila</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="nyeri_hilang[]" value="Minum Obat">
									<span class="css-control-indicator"></span> Minum Obat
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="nyeri_hilang[]" value="Istirahat">
									<span class="css-control-indicator"></span> Istirahat
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="nyeri_hilang[]" value="Mendengar Musik">
									<span class="css-control-indicator"></span> Mendengar Musik
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="nyeri_hilang[]" value="Berubah posisi / tidur">
									<span class="css-control-indicator"></span> Berubah posisi / tidur
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Lain-lain (yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="nyeri_hilang[]">
								</div>
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="form-group row mb-5">
								<label class="col-12">Provokatif</label>
								<div class="col-12">
									<textarea class="form-control" name="provokatif"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Quality</label>
								<div class="col-12">
									<textarea class="form-control" name="quality"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Region</label>
								<div class="col-12">
									<textarea class="form-control" name="region"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Scala</label>
								<div class="col-12">
									<textarea class="form-control" name="scala"></textarea>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Time</label>
								<div class="col-12">
									<textarea class="form-control" name="time"></textarea>
								</div>
							</div>
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
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>