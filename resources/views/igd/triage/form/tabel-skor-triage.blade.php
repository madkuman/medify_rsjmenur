<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Triage</h3>
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
							<input type="hidden" name="kasus_id" @if(isset($kasus)) value="{{$kasus->id}}" @endif>
							<div class="row mb-20">
								<div class="form-group col-md-3 col-sm-12">
									<label for="nama_pasien">Nama Pasien</label>
									<input class="form-control" type="text" autocomplete="off" id="nama_pasien" name="nama_pasien" placeholder="Nama Pasien" @if(isset($kasus)) value="{{$kasus->identitas->nama}}" @endif>
								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label>Tanggal Kedatangan</label>
									<input type="text" class="form-control js-datepicker" name="tanggal_kedatangan" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label>Jam Kedatangan</label>
									<input type="text" class="form-control time" name="jam_kedatangan" value="">
								</div>
								<div class="col-md-3 full-only"></div>
								<!-- <div class="form-group col-md-8 col-sm-12">
									<label for="keterangan">Keterangan</label>
									<input class="form-control" type="text" autocomplete="off" id="keterangan" name="keterangan" placeholder="Keterangan tambahan (alamat, ciri-ciri, dsb.)">
									<small>Keterangan tambahan (alamat, ciri-ciri, dsb.)</small>
								</div> -->
								<div class="col-md-3">
									<div class="form-group row mb-5">
										<label class="col-12">Cara Datang</label>
										<div class="col-12">
											<select class="form-control" name="cara_datang">
												<option value="Rujukan">Rujukan</option>
												<option value="Non Rujukan">Non Rujukan</option>
												<option value="Pengantar">Pengantar</option>
												<option value="Lain-lain">Lain-lain</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group row mb-5">
										<label class="col-12">Transportasi ke IGD</label>
										<div class="col-12">
											<select class="form-control" name="transportasi_ke_igd">
												<option value="Sepeda Motor">Sepeda Motor</option>
												<option value="Mobil Pribadi">Mobil Pribadi</option>
												<option value="Kendaraan Umum">Kendaraan Umum</option>
												<option value="Ambulan">Ambulan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group row mb-5">
										<label class="col-12">Komunikasi</label>
										<div class="col-12">
											<select class="form-control" name="komunikasi">
												<option value="Telp">Telp</option>
												<option value="Tanpa Telp">Tanpa Telp</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group row mb-5">
										<label class="col-12">Anamnesa</label>
										<div class="col-12">
											<input type="text" class="form-control" name="keterangan_ganti_anamnesia">
										</div>
									</div>
								</div>
							</div>
							<table class="triage table table-vcenter">
								<tr>
									<th width="20%">Parameters</th>
									<th width="11.4285%">3</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">0</th>
									<th width="11.4285%">1</th>
									<th width="11.4285%">2</th>
									<th width="11.4285%">3</th>
								</tr>
								<tr>
									<th>Mobilitas</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="-3" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="-1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="0" checked="checked"/>
											<div>Berjalan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="1" />
											<div>Berjalan dgn Bantuan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="2"/>
											<div>Tdk dpt Berjalan</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="mobility" value="3" disabled />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Pernafasan</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="-3" />
											<div>0-6</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="-2" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="-1" />
											<div>7-11</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="0" checked="checked"/>
											<div>12-20</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="1" />
											<div>21-29</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="2" />
											<div>>=30</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="resp" value="3" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Heartrate</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="-3" />
											<div>0</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="-2"/>
											<div><50</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="-1" />
											<div>50-59</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="0" checked="checked"/>
											<div>60-100</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="1" />
											<div>101-119</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="2" />
											<div>120-139</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="heartrate" value="3" />
											<div>>=140</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Tekanan Sistolik</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="-3" />
											<div><70</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="-2"/>
											<div>70-80</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="-1" />
											<div>81-100</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="0" checked="checked"/>
											<div>101-199</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="1" disabled />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="2" />
											<div>>=200</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="systol" value="3" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Temperatur</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="-3" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="-2"/>
											<div><35</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="-1" />
											<div>35-35.9</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="0" checked="checked"/>
											<div>36-37.9</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="1" />
											<div>38-38.9</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="2"/>
											<div>>=39</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="temp" value="3" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Kesadaran</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="-3" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="-1" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="0" checked="checked"/>
											<div>Alert</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="1" />
											<div>Respond to Verbal</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="2"/>
											<div>Respond to Pain</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="conscious" value="3"/>
											<div>Unresponsive</div>
										</label>
									</td>
								</tr>
								<tr>
									<th>Trauma</th>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="-3" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="-2" disabled/>
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="-1" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="0" checked="checked"/>
											<div>Tidak</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="2" disabled="" />
											<div>-</div>
										</label>
									</td>
									<td>
										<label class="triage-item">
											<input type="radio" name="trauma" value="3" disabled="" />
											<div>-</div>
										</label>
									</td>
								</tr>

							</table>

							<hr>
							<h5 class="mb-10 pl-5">Faktor Diskriminan</h5>
							<hr>
							<div class="row">
								<div class="col-6 ml-10 row">
									<div class="col-12"><h5 class="mb-5 pl-5">P1</h5></div>
									<div class="col-6">
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="ischemic" value="1">
											<label class="custom-control-label" for="ischemic">Nyeri dada ischemic</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="uncontrolled" value="2">
											<label class="custom-control-label" for="uncontrolled">Perdarahan tidak terkontrol</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="other_join" value="3">
											<label class="custom-control-label" for="other_join">Dislokasi sendi lain</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="limb" value="4">
											<label class="custom-control-label" for="limb">Threatened limb</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="major_trauma" value="5">
											<label class="custom-control-label" for="major_trauma">Major trauma</label>
										</div>
										<label>Combustio akut:</label>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="combustio_1" value="6">
											<label class="custom-control-label" for="combustio_1">Wajah</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="combustio_2" value="7">
											<label class="custom-control-label" for="combustio_2">Inhalasi</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="combustio_3" value="8">
											<label class="custom-control-label" for="combustio_3">>20%</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="combustio_4" value="9">
											<label class="custom-control-label" for="combustio_4">Chemical</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="combustio_5" value="10">
											<label class="custom-control-label" for="combustio_5">Electrical</label>
										</div>
									</div>
									<div class="col-6 row">
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="hipoglikemia" value="11">
											<label class="custom-control-label" for="hipoglikemia">Hipoglikemia <60</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="hiperglikemia" value="12">
											<label class="custom-control-label" for="hiperglikemia">Hiperglikemia >400</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="od" value="13">
											<label class="custom-control-label" for="od">Keracunan/Overdosis</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="kejang" value="15">
											<label class="custom-control-label" for="kejang">Kejang</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="apneu" value="16">
											<label class="custom-control-label" for="apneu">Apneu</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="gasping" value="17">
											<label class="custom-control-label" for="gasping">Gasping</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="tidak_sadar" value="18">
											<label class="custom-control-label" for="tidak_sadar">Tidak Sadar</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="henti_jantung" value="19">
											<label class="custom-control-label" for="henti_jantung">Henti Jantung</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline mb-5">
											<input class="custom-control-input" type="checkbox" name="p1[]" id="nyeri_berat" value="14">
											<label class="custom-control-label" for="nyeri_berat">Nyeri berat (skor nyeri 8-10)</label>
										</div>
										<div class="form-group ml-15">
											<label for="keterangan">Pertimbangan Khusus</label>
											<input class="form-control" type="text" autocomplete="off" id="pertimbangan_khusus_p1" name="pertimbangan_khusus_p1" placeholder="Pertimbangan Khusus">
										</div>
									</div>
								</div>
								<div class="col-3 ml-10 row">
									<h5 class="mb-5 pl-5 col-12">P2</h5>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_1" value="1">
										<label class="custom-control-label" for="p2_1">Nyeri perut</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_2" value="2">
										<label class="custom-control-label" for="p2_2">Perdarahan terkontrol</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_3" value="3">
										<label class="custom-control-label" for="p2_3">Agresif/Psikosis</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_4" value="4">
										<label class="custom-control-label" for="p2_4">Defisit neurologis fokal akut</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_5" value="5">
										<label class="custom-control-label" for="p2_5">Dislokasi sendi jari tangan/kaki</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_6" value="6">
										<label class="custom-control-label" for="p2_6">Fraktur</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_7" value="7">
										<label class="custom-control-label" for="p2_7">Combustio akut (circumferencial)</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_8" value="8">
										<label class="custom-control-label" for="p2_8">Muntah profus</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 col-12">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_9" value="9">
										<label class="custom-control-label" for="p2_9">Diare profus</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5">
										<input class="custom-control-input" type="checkbox" name="p2[]" id="p2_10" value="10">
										<label class="custom-control-label" for="p2_10">Nyeri sedang (skor nyeri 5-7)</label>
									</div>
									<div class="form-group ml-15">
										<label for="keterangan">Pertimbangan Khusus</label>
										<input class="form-control" type="text" autocomplete="off" id="pertimbangan_khusus_p2" name="pertimbangan_khusus_p2" placeholder="Pertimbangan Khusus">
									</div>
								</div>
								<div class="col-3 ml-10 row">
									<h5 class="mb-5 pl-5 col-12">PONEK</h5>
									<label>Kehamilan dengan:</label>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" name="ponek[]" id="ponek_1" value="1">
										<label class="custom-control-label" for="ponek_1">Hipertensi</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" name="ponek[]" id="ponek_2" value="2">
										<label class="custom-control-label" for="ponek_2">Perdarahan pervaginam</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" name="ponek[]" id="ponek_3" value="3">
										<label class="custom-control-label" for="ponek_3">Trauma</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" name="ponek[]" id="ponek_4" value="4">
										<label class="custom-control-label" for="ponek_4">Kejang</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" name="ponek[]" id="ponek_5" value="5">
										<label class="custom-control-label" for="ponek_5">Sesak nafas berat</label>
									</div>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" name="ponek[]" id="ponek_6" value="6">
										<label class="custom-control-label" for="ponek_6">Penurunan kesadaran</label>
									</div>
									<h5 class="mb-5 pl-5 col-12">P3</h5>
									<div class="custom-control custom-checkbox custom-control-inline mb-5 ml-15 col-12">
										<input class="custom-control-input" type="checkbox" id="p3" name="p3">
										<label class="custom-control-label" for="p3">Nyeri ringan</label>
									</div>
									<div class="form-group ml-15">
										<label for="keterangan">Kasus Lain</label>
										<input class="form-control" type="text" autocomplete="off" id="kasus_lain" name="kasus_lain" placeholder="Kasus-kasus lain">
										<small>Untuk kasus-kasus selain di daftar diskriminan</small>
									</div>
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
				</div>
			</div>
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>