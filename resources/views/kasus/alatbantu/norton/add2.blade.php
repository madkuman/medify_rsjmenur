<div class="modal" id="addModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create-surveilans" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Audit Dekubitus Baru</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
						<div class="col-12">
							<h4>Gejala</h4>
						</div>
						<div class="col-md-5 col-12">
							<h6>Derajat I</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="temperatur_kulit" value="0">
									<input type="checkbox" class="css-control-input" name="temperatur_kulit" value="1">
									<span class="css-control-indicator"></span> Temperatur Kulit (Lebih Dingin/Hangat)
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="konsitensi_jaringan" value="0">
									<input type="checkbox" class="css-control-input" name="konsitensi_jaringan" value="1">
									<span class="css-control-indicator"></span> Konsistensi Jaringan (Lebih Keras/Lunak)
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="gatal" value="0">
									<input type="checkbox" class="css-control-input" name="gatal" value="1">
									<span class="css-control-indicator"></span> Gatal
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="nyeri" value="0">
									<input type="checkbox" class="css-control-input" name="nyeri" value="1">
									<span class="css-control-indicator"></span> Nyeri
								</label>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12">
							<h6>Derajat II</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="abrasi" value="0">
									<input type="checkbox" class="css-control-input" name="abrasi" value="1">
									<span class="css-control-indicator"></span> Abrasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="melepuh" value="0">
									<input type="checkbox" class="css-control-input" name="melepuh" value="1">
									<span class="css-control-indicator"></span> Melepuh
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="lubang_yang_dangkal" value="0">
									<input type="checkbox" class="css-control-input" name="lubang_yang_dangkal" value="1">
									<span class="css-control-indicator"></span> Lubang yang dangkal
								</label>
							</div>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<h6>Derajat III</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="necrosis_jaringan_subkutan" value="0">
									<input type="checkbox" class="css-control-input" name="necrosis_jaringan_subkutan" value="1">
									<span class="css-control-indicator"></span> Necrosis Jaringan Subkutan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="lubang_yang_dalam" value="0">
									<input type="checkbox" class="css-control-input" name="lubang_yang_dalam" value="1">
									<span class="css-control-indicator"></span> Lubang yang dalam
								</label>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12">
							<h6>Derajat IV</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="necrosis_luas" value="0">
									<input type="checkbox" class="css-control-input" name="necrosis_luas" value="1">
									<span class="css-control-indicator"></span> Necrosis Luas
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="kerusakan_otot_tulang" value="0">
									<input type="checkbox" class="css-control-input" name="kerusakan_otot_tulang" value="1">
									<span class="css-control-indicator"></span> Kerusakan Otot Tulang Tendon
								</label>
							</div>
						</div>
						<div class="col-12">
							<hr>
							<h4>Tatalaksana</h4>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="ganti_posisi" value="0">
									<input type="checkbox" class="css-control-input" name="ganti_posisi" value="1">
									<span class="css-control-indicator"></span> Ganti Posisi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="kasur_angin" value="0">
									<input type="checkbox" class="css-control-input" name="kasur_angin" value="1">
									<span class="css-control-indicator"></span> Kasur Angin / Air
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="perban_hidrokoloid" value="0">
									<input type="checkbox" class="css-control-input" name="perban_hidrokoloid" value="1">
									<span class="css-control-indicator"></span> Perban Hidrokoloid
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="perban_alginat" value="0">
									<input type="checkbox" class="css-control-input" name="perban_alginat" value="1">
									<span class="css-control-indicator"></span> Perban Alginat
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="krim_dan_salep" value="0">
									<input type="checkbox" class="css-control-input" name="krim_dan_salep" value="1">
									<span class="css-control-indicator"></span> Krim dan Salep
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="antibiotik" value="0">
									<input type="checkbox" class="css-control-input" name="antibiotik" value="1">
									<span class="css-control-indicator"></span> Antibiotik
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="suplemen_makanan" value="0">
									<input type="checkbox" class="css-control-input" name="suplemen_makanan" value="1">
									<span class="css-control-indicator"></span> Suplemen Makanan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="debridement" value="0">
									<input type="checkbox" class="css-control-input" name="debridement" value="1">
									<span class="css-control-indicator"></span> Debridement
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="analgesik" value="0">
									<input type="checkbox" class="css-control-input" name="analgesik" value="1">
									<span class="css-control-indicator"></span> Analgesik
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="hidden" name="pembedahan" value="0">
									<input type="checkbox" class="css-control-input" name="pembedahan" value="1">
									<span class="css-control-indicator"></span> Pembedahan
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