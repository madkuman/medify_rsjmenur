<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Nyeri saat Pasien Tidak Sadar</h3>
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
									<th width="20%">Paremeters</th>
									<th width="20%">1</th>
									<th width="20%">2</th>
									<th width="20%">3</th>
									<th width="20%">4</th>
								</tr>
								<tr>
									<th>Ekspresi wajah</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="ekspresi" value="1" />
											<div>Relaks/santai</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="ekspresi" value="2"/>
											<div>Sedikit mengerut, misal mengerutkan dahi</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="ekspresi" value="3" />
											<div>Mengerut secara penuh, misal hingga menutup kelopak mata</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="ekspresi" value="4"/>
											<div>Meringis</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Pergerakan ekstremitas atas</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="movement" value="1" />
											<div>Tidak ada pergerakan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="movement" value="2"/>
											<div>Sedikit membungkuk</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="movement" value="3" />
											<div>Membungkuk penuh dengan fleksi pada jari</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="movement" value="4" />
											<div>Retraksi permanen</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Kompensasi terhadap ventilator</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="ventilator" value="1" />
											<div>Pergerakan yang menoleransi</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="ventilator" value="2"/>
											<div>Batuk dengan pergerakan</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="ventilator" value="3"  />
											<div>Melawan ventilator</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="ventilator" value="4" />
											<div>Tidak mampu mengontrol ventilator</div>
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