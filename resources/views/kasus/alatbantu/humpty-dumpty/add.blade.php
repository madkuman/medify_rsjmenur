<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Humpty Dumpty</h3>
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
							<table class="humpty-dumpty table table-vcenter">
								<tr>
									<th width="10%">Paremeters</th>
									<th width="22.5%">4</th>
									<th width="22.5%">3</th>
									<th width="22.5%">2</th>
									<th width="22.5%">1</th>
								</tr>
								<tr>
									<th>Usia</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="usia" value="4" />
											<div>< 3 tahun</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="usia" value="3"/>
											<div>3 - 7 tahun</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="usia" value="2" checked="checked" />
											<div>7 - 13 tahun</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="usia" value="1"/>
											<div>>= 13 tahun</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Jenis kelamin</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="jenis_kelamin" value="4" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="jenis_kelamin" value="3" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="jenis_kelamin" value="2" checked="checked" />
											<div>Laki-laki</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="jenis_kelamin" value="1"/>
											<div>Perempuan</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Diagnosis</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="diagnosis" value="4" />
											<div>Diagnosis neurologi</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="diagnosis" value="3" />
											<div>Perubahan oksigenasi (diagnosis respiratorik, dehidrasi, anemia, anoreksia, sinkop, pusing, dsb.)</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="diagnosis" value="2" checked="checked" />
											<div>Gangguan perilaku/psikiatri</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="diagnosis" value="1"/>
											<div>Diagnosis lainnya</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Gangguan kognitif</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="gangguan_kognitif" value="4" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="gangguan_kognitif" value="3" />
											<div>Tidak menyadari keterbatasan dirinya</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="gangguan_kognitif" value="2" checked="checked" />
											<div>Lupa akan adanya keterbatasan</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="gangguan_kognitif" value="1"/>
											<div>Orientasi baik terhadap diri sendiri</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Faktor lingkungan</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="faktor_lingkungan" value="4"/>
											<div>Riwayat jatuh / Bayi diletakkan di tempat tidur dewasa</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="faktor_lingkungan" value="3"/>
											<div>Pasien menggunakan alat bantu / Bayi diletakkan dalam tempat tidur bayi/perabot rumah</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="faktor_lingkungan" value="2" checked="checked" />
											<div>Pasien diletakkan di tempat tidur</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="faktor_lingkungan" value="1"/>
											<div>Area di luar rumah sakit</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Respons terhadap pembedahan/sedasi/anastesi</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="respons" value="4" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="respons" value="3"/>
											<div>Dalam 24 jam</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="respons" value="2" checked="checked" />
											<div>Dalam 48 jam</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="respons" value="1"/>
											<div>> 48 jam / Tidak menjalani pembedahan/sedasi/anestesi</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Penggunaan medikamentosa</th>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="penggunaan_medik" value="4" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="penggunaan_medik" value="3"/>
											<div>Penggunaan multipel: sedatif, obat hipnosis, barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkose</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="penggunaan_medik" value="2" checked="checked" />
											<div>Penggunaan salah satu: sedatif, obat hipnosis, barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkose</div>
										</label>
									</td>
									<td>
										<label class="humpty-dumpty-item">
											<input type="radio" name="penggunaan_medik" value="1"/>
											<div>Penggunaan medikasi lain / Tidak ada medikasi</div>
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