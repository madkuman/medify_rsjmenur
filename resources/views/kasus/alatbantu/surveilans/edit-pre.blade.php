<div class="modal" id="editPreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/edit" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Edit Pengumpulan Data Surveilans Infeksi Luka Operasi - Pra Operasi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						{{csrf_field()}}
						<input type="hidden" name="type" value="Surveilans Infeksi Luka Pre Ops">
						<input type="hidden" name="id" value="" id="id">
						
						<div class="col-md-4 col-12">
							<h5>Pre Ops</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="suhu">Suhu Pasien</label>
								<div class="col-12">
									<select class="form-control" id="suhu" name="suhu">
										<option value=">= 38 derajat celcius" selected>>= 38 derajatcelcius</option>
										<option value="< 38 derajat celcius">< 38 derajat celcius</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="merokok">Merokok</label>
								<div class="col-12">
									<select class="form-control" id="merokok" name="merokok">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="mrsa">Screening MRSA</label>
								<div class="col-12">
									<select class="form-control" id="mrsa" name="mrsa">
										<option value="Ya, Hasilnya Positif" selected>Ya, Hasilnya Positif</option>
										<option value="Ya, Hasilnya Negatif">Ya, Hasilnya Negatif</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="albumin">Albumin</label>
								<div class="col-12">
									<input type="text" class="form-control" name="albumin" id="albumin" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gula_darah">Gula darah</label>
								<div class="col-12">
									<select class="form-control" id="gula_darah" name="gula_darah">
										<option value="> 200" selected>> 200</option>
										<option value="<= 200"><= 200</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-4"><div class="form-group row mb-5">
								<label class="col-12">Penyakit Saat ini</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="dm" id="dm">
									<span class="css-control-indicator"></span> DM
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="ggk" id="ggk">
									<span class="css-control-indicator"></span> GGK
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="sepsis" id="sepsis">
									<span class="css-control-indicator"></span> Sepsis
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="hipertensi" id="hipertensi">
									<span class="css-control-indicator"></span> Hipertensi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="na" id="na">
									<span class="css-control-indicator"></span> NA
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penyakit_lain2">Penyakit Lain-lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="penyakit_lain2" autocomplete="off" id="penyakit_lain2">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pencukuran">Pencukuran</label>
								<div class="col-12">
									<select class="form-control" id="pencukuran" name="pencukuran">
										<option value="Clipper" selected>Clipper</option>
										<option value="Silet">Silet</option>
										<option value="NA">NA</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="waktu_cukur">Waktu Pencukuran</label>
								<div class="col-12">
									<input type="text" name="waktu_cukur" class="form-control time" placeholder="hh:mm" autocomplete="off" id="waktu_cukur">
								</div>
							</div>	
							<div class="form-group row mb-5">
								<label class="col-12" for="bowel">Mechanical Bowel</label>
								<div class="col-12">
									<select class="form-control" id="bowel" name="bowel">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="steroid">Steroid Jangka Panjang</label>
								<div class="col-12">
									<select class="form-control" id="steroid" name="steroid">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="radioterapi">Radioterapi Sebelumnya</label>
								<div class="col-12">
									<select class="form-control" id="radioterapi" name="radioterapi">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="mandi">Mandi Sebelum Operasi</label>
								<div class="col-12">
									<select class="form-control" id="mandi" name="mandi">
										<option value="Chlorhexidine bodywash" selected>Chlorhexidine bodywash</option>
										<option value="Sabun lain">Sabun lain</option>
										<option value="NA">NA</option>
									</select>
								</div>
							</div>			
						</div>
						<div class="col-4">	
							<div class="form-group row mb-5">
								<label class="col-12">Penyakit Infeksi</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="kulit" id="kulit">
									<span class="css-control-indicator"></span> Infeksi Kulit
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mulut" id="mulut">
									<span class="css-control-indicator"></span> Infeksi Mulut / Gigi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="mata" id="mata">
									<span class="css-control-indicator"></span> Infeksi Mata
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="tht" id="tht">
									<span class="css-control-indicator"></span> Infeksi THT
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="paru" id="paru">
									<span class="css-control-indicator"></span> Infeksi Paru
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="gi_tract" id="gi_tract">
									<span class="css-control-indicator"></span> Infeksi GI tract
								</label>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penyakit_lain2">Penyakit Infeksi Lain-lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="infeksi_lain2" autocomplete="off" id="infeksi_lain2">
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
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>