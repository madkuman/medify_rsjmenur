<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Klasifikasi ASA</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create" method="POST">
							{{csrf_field()}}
							<table class="mews table table-vcenter">
								<tr>
									<th width="33.4%">Deskripsi</th>
									<th width="66.6%">Contoh</th>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="P1" checked="checked" />
											<div class="row">
												<div class="col-4 text-center">Pasien sehat</div>
												<div class="col-8 text-center">Sehat; bukan perokok; tidak mengonsumsi alkohol/konsumsi alkohol minimal</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="P2" />
											<div class="row">
												<div class="col-4 text-center">Pasien dengan penyakit sistemik ringan</div>
												<div class="col-8 text-center">Penyakit ringan tanpa keterbatasan fungsional, seperti: perokok aktif; pengonsumsi alkohol sosial; hamil; obesitas; diabetes atau hipertensi terkontrol; penyakit paru-paru ringan</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="P3" />
											<div class="row">
												<div class="col-4 text-center">Pasien dengan penyakit sistemik akut</div>
												<div class="col-8 text-center">Keterbatasan fungsional substantif, >= 1 penyakit menengah atau akut, seperti: diabetes atau hipertensi tidak terkontrol; COPD; obesitas morbid; hepatitis aktif; penyalahgunaan/ketergantungan alkohol; memiliki implan pacemaker; moderately reduced ejection fraction (EF); ESRD dengan dialisis; bayi prematur umur <60 minggu setelah kelahiran; >3 bulan setelah MI, CVA/TIA, atau CAD/stents</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="P4" />
											<div class="row">
												<div class="col-4 text-center">Pasien dengan penyakit sistemik akut yang mengancam kelangsungan hidup</div>
												<div class="col-8 text-center"><= 3 bulan setelah MI, CVA/TIA, atau CAD/stents; cardiac ischemia atau disfungsi katup akut; severely reduced ejection fraction (EF); sepsis; DIC; ARD; ESRD tidak dengan dialisis/tidak menjalani dialisis rutin</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="P5" />
											<div class="row">
												<div class="col-4 text-center">Pasien hampir mati, tidak akan bertahan tanpa operasi</div>
												<div class="col-8 text-center">Ruptur aneurisma aorta, emboli paru massif</div>
											</div>
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label class="mews-item">
											<input type="radio" name="class" value="P6" />
											<div class="row">
												<div class="col-4 text-center">Pasien mati otak</div>
												<div class="col-8 text-center">-</div>
											</div>
										</label>
									</td>
								</tr>
							</table>
							<hr>
							<div class="row">
								<div class="col-12 bg-danger">
									<div class="custom-control custom-checkbox custom-control-inline pull-right mb-15 mt-15">
			                            <input class="custom-control-input" type="checkbox" id="emergency" name="emergency">
			                            <label class="custom-control-label" for="emergency" style="color: white">Perlu operasi darurat</label>
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