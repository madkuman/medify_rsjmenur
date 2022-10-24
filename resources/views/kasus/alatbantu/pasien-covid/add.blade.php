<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" >
			<div class="block block-themed block-transparent mb-0">
				<div class="block-header ">
					<h3 class="block-title">Ceklis Pasien Covid-19</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="si si-close"></i>
						</button>
					</div>
				</div>
				<div class="block-content row">
					<div class="col-md-12">
						<form action="{{url()->current()}}/save" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="id_covid" value="0" id="idCovid">
							<table class="mews table table-vcenter">
								<tr>
									<th width="48%">Paremeters</th>
									<th width="26%">Ya</th>
									<th width="26%">Tidak</th>
								</tr>
								<tr>
									<th class="text-left">Apakah pasien demam/riwayat demam &ge; 38 &deg;C &lt;14 hari?</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="demam" class="covid-changes" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="demam" class="covid-changes" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
								<tr>
									<th class="text-left">Apakah pasien saat ini batuk-pilek/nyeri tenggorokan atau sesak nafas &lt;14 hari?</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="bapil" class="covid-changes" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="bapil" class="covid-changes" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
								<tr>
									<th class="text-left">Apakah pasien ISPA atau pneumonia berat &lt;14 hari?
										 <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="bottom"  data-html="true" data-container="body" title="<ol type='a'>
											<li> Pasien remaja atau dewasa, disertai salah satu:
											</li>
											<ol type='1'>
												<li>RR&gt;30x/menit</li>
												<li>distress pernafasan berat</li>
												<li>saturasi oksigen &lt;90%</li>
											</ol>
											<li>Pasien anak batuk dan sesak, disertai salah satu:

											<ol type='1'>
												<li>sianosis sentral</li>
												<li>saturasi &lt;90%</li>
												<li>tarikan dinding dada berat</li>
												<li>tidak mampu menyusu/minum, letargi, kejang, penurunan keadaan</li>
												<li>takipea:</li>
												<ul type='disc'>
													<li>&lt;2 bulan &ge;60x/menit</li>
													<li>2-11 bulan &ge;50x/menit</li>
													<li>1-5 tahun &ge;40x/menit</li>
													<li>&gt;5tahun &ge;30x/menit</li>
												</ul>
											</ol>
											</li>
										</ol>">
						                    <i class="fa fa-question-circle"></i>
						                </button>
									</th>
									<td>
										<label class="mews-item">
											<input type="radio" name="nafas" class="covid-changes" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td>
										<label class="mews-item">
											<input type="radio" name="nafas" class="covid-changes" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<table class="mews table table-vcenter" style="display: none;">
								<tr>
									<th class="text-left" width="48%">Pasien menjalani pemeriksaan lab?</th>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="covid-lab" name="lab" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="covid-lab" name="lab" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="if-covid-lab-show" style="display:none;" >
								<table class="mews table table-vcenter">
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Leukosit Normal</th>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_leukosit" value="0" checked="" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_leukosit" value="1" />
												<div>Tidak</div>
											</label>
										</td>
									</tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Leukositosis</th>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_leukositosis" value="1" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_leukositosis" value="0" checked />
												<div>Tidak</div>
											</label>
										</td>
									</tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Leukopenia</th>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_leukopenia" value="1" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_leukopenia" value="0" checked />
												<div>Tidak</div>
											</label>
										</td>
									</tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Limfopenia</th>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_limfopenia" value="1" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" class="lab" name="lab_limfopenia" value="0" checked />
												<div>Tidak</div>
											</label>
										</td>
									</tr>
								</table>
							</div>
							<table class="mews table table-vcenter" style="display: none;">
								<tr>
									<th class="text-left" width="48%">Pasien menjalani pemeriksaan radiologi?</th>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="covid-radio" name="radio" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="covid-radio" name="radio" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="if-covid-radio-show" style="display:none;" >
								<table class="mews table table-vcenter">
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Normal</th>
										<td width="26%">
											<label class="mews-item">
												<input class="radio" type="radio" name="radio_normal" value="0" checked="" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input class="radio" type="radio" name="radio_normal" value="1"/>
												<div>Tidak</div>
											</label>
										</td>
									</tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Infiltrat unilateral</th>
										<td width="26%">
											<label class="mews-item">
												<input class="radio" type="radio" name="radio_unilateral" value="1" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input class="radio" type="radio" name="radio_unilateral" value="0" checked />
												<div>Tidak</div>
											</label>
										</td>
									</tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">infiltrat bilateral</th>
										<td width="26%">
											<label class="mews-item">
												<input class="radio" type="radio" name="radio_bilateral" value="1" />
												<div>Ya</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input class="radio" type="radio" name="radio_bilateral" value="0" checked />
												<div>Tidak</div>
											</label>
										</td>
									</tr>
								</table>
							</div>
							<table class="mews table table-vcenter">
								<tr>
									<th class="text-left" width="48%">Apakah pasien pernah berpergian ke luar negeri  &lt;14 hari sebelum gejala?</th>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="travel-negara" name="travel_negara" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="travel-negara" name="travel_negara" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="if-travel-negara-show" style="display:none;" >
								<table class="mews table table-vcenter">
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Negara yang dikunjungi pasien</th>
										<td width="52%">
											<select class="form-control js-select2" name="negara[]" id="select-negara" data-placeholder="Pilih Negara" data-close-on-select="false"
											multiple="multiple" data-tags="true" style="width: 100%">
												<option>Korea Selatan</option>
												<option>Iran</option>
												<option>Jepang</option>
												<option>Singapura</option>
												<option>Hong Kong</option>
												<option>Bahrain</option>
												<option>Kuwait</option>
												<option>Thailand</option>
												<option>Malaysia</option>
												<option>Uni Emirates Arab</option>
												<option>Irak</option>
												<option>Vietnam</option>
												<option>Israel</option>
												<option>Macau</option>
												<option>Lebanon</option>
												<option>Oman</option>
												<option>Pakistan</option>
												<option>Qatar</option>
												<option>India</option>
												<option>Filipina</option>
												<option>Afghanistan</option>
												<option>Nepal</option>
												<option>Cambodia</option>
												<option>Srilanka</option>
											</select>
										</td>
									</tr>
								</table>
							</div>
							<table class="mews table table-vcenter">
								<tr>
									<th class="text-left" width="48%">Apakah pasien pernah berpergian/tinggal di daerah area transmisi &lt;14 hari sebelum gejala?</th>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="travel-daerah" name="travel_daerah" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" class="travel-daerah" name="travel_daerah" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="if-travel-daerah-show" style="display:none;" >
								<table class="mews table table-vcenter" tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Daerah area transmisi yang dikunjungi pasien</th>
										<td width="52%">
											<select class="form-control js-select2" id="select-daerah" name="daerah[]" data-placeholder="Pilih Daerah" data-close-on-select="false"
											multiple="multiple" data-tags="true"  style="width: 100%">
												<option></option>
												<option value="Jakarta">Jakarta</option>
												<option value="Bandung">Bandung</option>
												<option value="Yogyakarta">Yogyakarta</option>
												<option value="Solo">Solo</option>
												<option value="Denpasar/Bali">Denpasar/Bali</option>
												<option value="Bogor">Bogor</option>
												<option value="Tangerang">Tangerang</option>
												<option value="Manado">Manado</option>
												<option value="Pontianak">Pontianak</option>
												<option value="Surabaya">Surabaya</option>
												<option value="Malang">Malang</option>
											</select>
										</td>
									</tr>
								</table>
							</div>
							<table class="mews table table-vcenter">
								<tr>
									<th width="48%" class="text-left">Apakah pasien termasuk kasus probable atau pernah kontak erat dengan pasien Covid-19 &lt; 14 hari sebelum gejala?
										<button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="bottom"  data-html="true" data-container="body" title="<ol type='a'>
											<li>Petugas kesehatan yang merawat/memeriksa/membersihkan ruangan tanpa APD
											</li>
											<li>Orang yang berada dalam satu ruangan yang sama dengan kasus dalam 2-14 hari sebelum gejala
											</li>
											<li>Orang yang berpergian bersama radius 1 meter 2-14 hari sebelum gejala
											</li>
										</ol>">
						                    <i class="fa fa-question-circle"></i>
						                </button>
									</th>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" name="kontak" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input type="radio" name="kontak" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>

							<table class="mews table table-vcenter">
								<tr>
									<th width="48%" class="text-left">Apakah Ada Hasil Rapid Test?
									</th>
									<td width="26%">
										<label class="mews-item">
											<input class="rapid-test" type="radio" name="rapid_test" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input class="rapid-test" type="radio" name="rapid_test" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="rapid-test-ya" style="display: none;">
								<table class="mews table table-vcenter">
									<tr>
										<td width="5%"></td>
										<th width="43%" class="text-left">Bagaimana Hasil Rapid Test-nya?
										</th>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" name="hasil_rapid_test" class="hasil_rapid_test" value="1" />
												<div>Positif</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" name="hasil_rapid_test" class="hasil_rapid_test" value="0" checked />
												<div>Negatif</div>
											</label>
										</td>
									</tr>
								</table>
							</div>

							<table class="mews table table-vcenter">
								<tr>
									<th width="48%" class="text-left">Apakah Ada Hasil Swab PCR?
									</th>
									<td width="26%">
										<label class="mews-item">
											<input class="swab" type="radio" name="swab" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input class="swab" type="radio" name="swab" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="swab-ya" style="display: none;">
								<table class="mews table table-vcenter">
									<tr>
										<td width="5%"></td>
										<th width="43%" class="text-left">Bagaimana Hasil Swab PCR-nya?
										</th>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" name="hasil_swab" class="hasil_swab" value="1" />
												<div>Positif</div>
											</label>
										</td>
										<td width="26%">
											<label class="mews-item">
												<input type="radio" name="hasil_swab" class="hasil_swab" value="0" checked />
												<div>Negatif</div>
											</label>
										</td>
									</tr>
								</table>
							</div>
							<table class="mews table table-vcenter">
								<tr>
									<th width="48%" class="text-left">Apakah Ada Penyebab Klinis Lain?
									</th>
									<td width="26%">
										<label class="mews-item">
											<input class="is_penyebab_klinis_lain" type="radio" name="is_penyebab_klinis_lain" value="1" />
											<div>Ya</div>
										</label>
									</td>
									<td width="26%">
										<label class="mews-item">
											<input class="is_penyebab_klinis_lain" type="radio" name="is_penyebab_klinis_lain" value="0" checked />
											<div>Tidak</div>
										</label>
									</td>
								</tr>
							</table>
							<div id="alasan-wrap" style="display: none">
								<table class="mews table table-vcenter" tr>
									<tr>
										<td width="5%"></td>
										<th class="text-left" width="43%">Adanya penyebab lain berdasarkan klinis yang meyakinkan</th>
										<td width="52%" class="text-left">
											<textarea class="form-control" id="alasan-input" name="alasan" rows="3" placeholder="Penyebab Klinis Lain"></textarea>
											<small>Jika kolom ini terisi, maka pasien PDP dan ODP akan menjadi negatif. Kecuali, jika ada hasil SWAB PCR</small>
										</td>
									</tr>
								</table>
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