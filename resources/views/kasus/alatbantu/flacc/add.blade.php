<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<form action="{{url()->current()}}/create" method="POST">
					{{csrf_field()}}
					<div class="block-header ">
						<h3 class="block-title">Skala Flacc</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<div class="col-md-12">
							<table class="triage table table-vcenter">
								<tr>
									<th width="25%">Parameters</th>
									<th width="25%">0</th>
									<th width="25%">1</th>
									<th width="25%">2</th>
								</tr>
								<tr>
									<th>Wajah</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="wajah" value="0" checked="checked"/>
											<div>Tidak ada ekspresi tertentu atau senyum</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="wajah" value="1"/>
											<div>Sesekali meringis atau mengerutkan kening, ditarik, tertarik</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="wajah" value="2"/>
											<div>Sering ke dagu bergetar konstan, rahang terkatup</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Kaki</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="kaki" value="0" checked="checked"/>
											<div>Yang normal posisi atau santai</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="kaki" value="1"/>
											<div>Gelisah, gelisah, tegang</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="kaki" value="2"/>
											<div>Menendang, atau kaki dibuat</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Aktivitas</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="aktivitas" value="0" checked="checked"/>
											<div>Berbaring tenang, posisi normal,  bergerak dengan mudah</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="aktivitas" value="1"/>
											<div>Menggeliat, pergeseran, bolak-balik, tegang</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="aktivitas" value="2"/>
											<div>Melengkung, kaku atau menyentak</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Menangis</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="menangis" value="0" checked="checked"/>
											<div>Tidak ada teriakan (terjaga atau tertidur)</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="menangis" value="1"/>
											<div>Erangan atau merintih, sesekali keluhan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="menangis" value="2"/>
											<div>Menangis terus, Jeritan atau isak tangis, keluhan sering</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Consolability</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="consolability" value="0" checked="checked"/>
											<div>Konten, santai</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="consolability" value="1"/>
											<div>Diyakinkan oleh menyentuh sesekali, memeluk atau sedang berbicara dengan, distractible</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="consolability" value="2"/>
											<div>Sulit untuk konsol atau kenyamanan</div>
										</label>
									</td>
								</tr>
							</table>
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
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>