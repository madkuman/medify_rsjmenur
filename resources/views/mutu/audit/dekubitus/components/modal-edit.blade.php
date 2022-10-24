<div class="modal" id="modal-edit-dekubitus" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="{{url()->current()}}/create" method="POST">
		<div class="modal-dialog modal-lg">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Edit Audit Dekubitus</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-5 col-12">
							<h6>Derajat I</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="temperatur_kulit">
									<span class="css-control-indicator"></span> Temperatur Kulit (Lebih Dingin/Hangat)
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="konsitensi_jaringan">
									<span class="css-control-indicator"></span> Konsistensi Jaringan (Lebih Keras/Lunak)
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="gatal">
									<span class="css-control-indicator"></span> Gatal
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="nyeri">
									<span class="css-control-indicator"></span> Nyeri
								</label>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12">
							<h6>Derajat II</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="abrasi">
									<span class="css-control-indicator"></span> Abrasi
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="melepuh">
									<span class="css-control-indicator"></span> Melepuh
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="lubang_yang_dangkal">
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
									<input type="checkbox" class="css-control-input" name="necrosis_jaringan_subkutan">
									<span class="css-control-indicator"></span> Necrosis Jaringan Subkutan
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="lubang_yang_dalam">
									<span class="css-control-indicator"></span> Lubang yang dalam
								</label>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-6 col-12">
							<h6>Derajat IV</h6>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="necrosis_luas">
									<span class="css-control-indicator"></span> Necrosis Luas
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" name="kerusakan_otot_tulang">
									<span class="css-control-indicator"></span> Kerusakan Otot Tulang Tendon
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