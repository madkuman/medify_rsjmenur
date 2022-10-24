<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Gastrointestinal</h3>
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
								<th width="22%">Paremeter</th>
								<th width="78%" colspan="2">Status</th>
							</tr>
							<tr>
								<th>Keluhan Gastro</th>
								<td>
									<label class="mews-item" id="normal">
										<input type="radio" name="gastro" checked="" />
										<div>Tidak Ada</div>
									</label>
								</td>
								<td>
									<label class="mews-item" id="tidak-normal">
										<input type="radio" name="gastro" />
										<div>Ada</div>
									</label>
								</td>
							</tr>
							<tr>
								<td></td>
								<td id="gastro-ket" style="display:none;" colspan="2">
									<input type="text" name="keluhan" autocomplete="off" placeholder="Sebutkan Keluhan" class="form-control" />
								</td>
							</tr>
							<tr>
								<th>Pembatasan Makan</th>
								<td>
									<label class="mews-item" id="makan-normal">
										<input type="radio" name="makan" checked="" />
										<div>Tidak Ada</div>
									</label>
								</td>
								<td>
									<label class="mews-item" id="makan-tidak-normal">
										<input type="radio" name="makan" />
										<div>Ada</div>
									</label>
								</td>
							</tr>
							<tr>
								<td></td>
								<td id="makan-ket" style="display:none;" colspan="2">
									<input type="text" name="batas-makan" autocomplete="off" placeholder="Sebutkan pembatasan makanan" class="form-control" />
								</td>
							</tr>

							</table>
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