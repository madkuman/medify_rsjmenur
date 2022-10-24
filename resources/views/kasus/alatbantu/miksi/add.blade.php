<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Eliminasi Miksi</h3>
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
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th>Status Miksi</th>
								<td>
									<label class="mews-item" id="normal">
										<input type="radio" name="miksi" checked="" />
										<div>Normal</div>
									</label>
								</td>
								<td>
									<label class="mews-item" id="tidak-normal">
										<input type="radio" name="miksi" />
										<div>Tidak Normal</div>
									</label>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td id="miksi-ket" style="display:none;" colspan="2">
									<input type="text" name="kelainan" autocomplete="off" placeholder="Sebutkan" class="form-control" />
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Jumlah</th>
								<td>
									<label>
										<input type="text" name="jumlah" class="form-control">
									</label>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Warna</th>
								<td>
									<label class="mews-item" id="jernih">
										<input type="radio" name="warna" checked="" value="Jernih" />
										<div>Jernih</div>
									</label>
								</td>
								<td>
									<label class="mews-item" id="kuning">
										<input type="radio" name="warna" value="Kuning" />
										<div>Kuning</div>
									</label>
								</td>
								<td>
									<label class="mews-item" id="keruh">
										<input type="radio" name="warna" value="Keruh" />
										<div>Keruh</div>
									</label>
								</td>
								<td>
									<label class="mews-item" id="memerah">
										<input type="radio" name="warna" value="Memerah" />
										<div>Memerah</div>
									</label>
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