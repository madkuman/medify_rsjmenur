<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Skor Aldrete</h3>
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
								<th width="22%">Paremeters</th>
								<th width="26%">2</th>
								<th width="26%">1</th>
								<th width="26%">0</th>
							</tr>
							<tr>
								<th>Warna</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="warna" value="2" />
										<div>Merah</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="warna" value="1" />
										<div>Pucat</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="warna" value="0" />
										<div>Sianosis</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Pernafasan</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="pernafasan" value="2" />
										<div>Dapat batuk</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="pernafasan" value="1" />
										<div>Belum dapat batuk, jalan nafas baik</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="pernafasan" value="0" />
										<div>Apnea/Obstruksi</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Sirkulasi</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="sirkulasi" value="2" />
										<div>&lt;20% dari TD awal</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="sirkulasi" value="1" />
										<div>20-50% dari TD awal</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="sirkulasi" value="0" />
										<div>&gt;50% dari TD awal</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Kesadaran</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="2" />
										<div>Dapat menjawab pertanyaan</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="1" />
										<div>Mengingat nama</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="0" />
										<div>Tidak ada respon</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Aktivitas</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="2" />
										<div>Dapat menggerakkan 4 tungkai</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="1" />
										<div>Dapat menggerakkan 2 tungkai</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="0" />
										<div>Tidak dapat menggerakkan</div>
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