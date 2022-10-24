<div class="modal" id="modal-create-iad" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Audit IAD Bundle Checklist Baru</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<div class="form-group mb-5">
								<label class=" mb-5">Tanggal</label>
								<input type="text" class="js-datepicker form-control datepicker" class="form-control" name="tanggal" placeholder="Tanggal " data-autoclose="true" autocomplete="off">
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Nama</label>
								<div class="col-12">
									<select class="js-select2 form-control" name="nama" style="width: 100%">
										<option value="Hari S" selected>Hari S</option>
										<option value="Aldi F">Aldi F</option>
										<option value="Farhan M">Farhan M</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">No. Bed</label>
								<div class="col-12">
									<select class="js-select2 form-control" name="bed" style="width: 100%">
										<option value="1" selected>1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								</div>
							</div>	
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12 pt-20">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hand_hygiene">
									<span class="css-control-indicator"></span> Hand Hygiene
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="menggunakan_apd">
									<span class="css-control-indicator"></span> Menggunakan APD
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="pembersihan_kulit_dengan_chlorhexidine">
									<span class="css-control-indicator"></span> Pembersihan kulit dengan chlorhexidine
								</label>
							</div>	
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="lokasi_pemasangan_sesuai">
									<span class="css-control-indicator"></span> Lokasi pemasangan sesuai
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="slang_infuse_diganti_sesuai_standar">
									<span class="css-control-indicator"></span> Slang infuse diganti sesuai standar
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="swab_alcohol_setiap_injeksi">
									<span class="css-control-indicator"></span> Swab alcohol setiap injeksi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="spuit_yang_digunakan_disposable">
									<span class="css-control-indicator"></span> Spuit yang digunakan disposable
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="penutup_insersi_dengan_transparan_dressing">
									<span class="css-control-indicator"></span> Penutup insersi dengan transparan dressing
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="perawatan_lokasi_insersi_setiap_4_hari_dan_jika_kotor">
									<span class="css-control-indicator"></span> Perawatan lokasi insersi setiap 4 hari dan jika kotor
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="menggunakan_stopper_needles">
									<span class="css-control-indicator"></span> Menggunakan stopper needles
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