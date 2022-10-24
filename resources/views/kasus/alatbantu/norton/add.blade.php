<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Norton Dekubitus</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/create" method="POST">
						<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
							{{csrf_field()}}
							<table class="mews table table-vcenter">
								<tr>
								<th width="22%">Paremeters</th>
								<th width="26%">4</th>
								<th width="26%">3</th>
								<th width="26%">2</th>
								<th width="26%">1</th>
							</tr>
							<tr>
								<th>Kondisi Fisik</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="fisik" value="4" checked="" />
										<div>Baik</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="fisik" value="3"/>
										<div>Lumayan</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="fisik" value="2" />
										<div>Buruk</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="fisik" value="1" />
										<div>Sangat Buruk</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Kesadaran</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="4" checked="" />
										<div>Komposmentis</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="3"/>
										<div>Apatis</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="2" />
										<div>Konfus/Soporus</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="kesadaran" value="1" />
										<div>Stupor/Koma</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Aktifitas</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="4" checked="" />
										<div>Ambulan</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="3"/>
										<div>Ambulan dgn bantuan</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="2" />
										<div>Hanya duduk</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="aktifitas" value="1" />
										<div>Tiduran</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Mobilitas</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="mobilitas" value="4" checked="" />
										<div>Bergerak bebas</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="mobilitas" value="3"/>
										<div>Sedikit terbatas</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="mobilitas" value="2" />
										<div>sangat terbatas</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="mobilitas" value="1" />
										<div>Tidak bisa bergerak</div>
									</label>
								</td>
							</tr>
							<tr>
								<th>Inkontines</th>
								<td>
									<label class="mews-item">
										<input type="radio" name="inkontines" value="4" checked="" />
										<div>Tidak</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="inkontines" value="3"/>
										<div>Terkadang</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="inkontines" value="2" />
										<div>Sering inkostinesia urin</div>
									</label>
								</td>
								<td>
									<label class="mews-item">
										<input type="radio" name="inkontines" value="1" />
										<div>Inkostinesia alvi &amp; urin</div>
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