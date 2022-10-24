<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">PEWS</h3>
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
									<th width="11.4285%">0</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">3</th>
								</tr>
								<tr>
									<th>Perilaku</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="perilaku" value="0" checked="" />
											<div>Bermain/sesuai</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="perilaku" value="1"/>
											<div>Tidur</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="perilaku" value="2" />
											<div>Iritabel</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="perilaku" value="3"/>
											<div>Letargi/bingung atau berkurangnya respons terhadap nyeri</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Kardio Vaskular</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="vaskular" value="0" checked="" />
											<div>Merah jambu atau waktu pengisian kapiler 1-2 detik</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="vaskular" value="1"/>
											<div>Pucat atau waktu pengisian kapiler 3 detik</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="vaskular" value="2" />
											<div>Abu-abu atau waktu pengisian kapiler 4 detik atau takikardia >20 laju normal</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="vaskular" value="3" />
											<div>Abu-abu atau mottled atau waktu pengisian kapiler ≥5 detik atau takikardia >30 laju normal atau bradikardi</div>
										</label>
									</td>									
								</tr>
								<tr>
									<th>Respirasi</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="respirasi" value="0" checked="" />
											<div>Normal, tidak ada retraksi</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respirasi" value="1"/>
											<div>>10 di atas normal, penggunaan otot bantu napas atau O2 30% atau 3 L/menit</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respirasi" value="2"  />
											<div>>20 di atas normal, retraksi atau O2 30% atau 6 L/men</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="respirasi" value="3" />
											<div>≥5 di bawah normal dengan retraksi, merintih atau O2 50% atau 8 L/menit</div>
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