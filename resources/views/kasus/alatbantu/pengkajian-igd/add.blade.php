<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			{{csrf_field()}}
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Pengkajian IGD</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						<input type="hidden" name="pengkajian_id" id="id">
						<div class="col-md-5 col-12">
							<h5>Form Pendaftaran (Diisi Petugas Pendaftaran)</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_kedatangan">Tanggal Datang ke IGD</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" id="tgl_kedatangan" name="tgl_kedatangan" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_kedatangan">Jam</label>
								<div class="col-12">
									<input type="text" id="jam_kedatangan" name="jam_kedatangan" class="form-control time" placeholder="hh:mm" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pekerjaan">Pekerjaan</label>
								<div class="col-12">
									<select class="form-control" id="pekerjaan" id="pekerjaan" name="pekerjaan">
										<option value="TNI/POLRI" selected>TNI/POLRI</option>
										<option value="PNS">PNS</option>
										<option value="Swasta">Swasta</option>
										<option value="0">Lain-Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_pekerjaan_lain2" style="display: none;">
								<label class="col-12" for="pekerjaan_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" id="pekerjaan_lain2" name="pekerjaan_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="penghasilan">Penghasilan</label>
								<div class="col-12">
									<select class="form-control" id="penghasilan" name="penghasilan">
										<option value="Tidak Ada" selected>Tidak Ada</option>
										<option value="< 1 Juta">< 1 Juta</option>
										<option value="1 - 2,9 Juta">1 - 2,9 Juta</option>
										<option value="3 - 4,9 Juta">3 - 4,9 Juta</option>
										<option value="5 - 9,9 Juta">5 - 9,9 Juta</option>
										<option value="10 - 14,9 Juta">10 - 14,9 Juta</option>
										<option value="> 15 Juta">> 15 Juta</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="agama">Agama</label>
								<div class="col-12">
									<select class="form-control" id="agama" name="agama">
										<option value="Islam" selected>Islam</option>
										<option value="Katolik">Katolik</option>
										<option value="Kristen">Kristen</option>
										<option value="Hindu">Hindu</option>
										<option value="Budha">Budha</option>
										<option value="0">Lain-Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_agama_lain2" style="display: none;">
								<label class="col-12" for="agama_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" id="agama_lain2" name="agama_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="pendidikan">Pendidikan</label>
								<div class="col-12">
									<select class="form-control" id="pendidikan" name="pendidikan">
										<option value="SD" selected>SD</option>
										<option value="SMP">SMP</option>
										<option value="SMA">SMA</option>
										<option value="Akademi">Akademi</option>
										<option value="Sarjana">Sarjana</option>
										<option value="0">Lain-Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_pendidikan_lain2" style="display: none;">
								<label class="col-12" for="pendidikan_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" id="pendidikan_lain2" name="pendidikan_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bahasa">Bahasa</label>
								<div class="col-12">
									<select class="form-control" id="bahasa" name="bahasa">
										<option value="Indonesia">Indonesia</option>
										<option value="0">Lain-Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_bahasa_lain2" style="display: none;">
								<label class="col-12" for="bahasa_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" id="bahasa_lain2" name="bahasa_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5" id="div_penerjemah" style="display: none;">
								<label class="col-12">Penerjemah</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="penerjemah" id="penerjemah_ya" value="Ya">
										<label class="custom-control-label" for="penerjemah_ya">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="penerjemah" id="penerjemah_tdk" value="Tidak" checked="">
										<label class="custom-control-label" for="penerjemah_tdk">Tidak</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-1 full-only"></div>
						<div class="col-md-5 col-12">
							<h5>Form Keadaan Pra Hospital (Diisi Perawat)</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_kejadian">Tanggal Kejadian</label>
								<div class="col-12">
									<input type="text" class="js-datepicker form-control" autocomplete="off" id="tgl_kejadian" name="tgl_kejadian" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_kejadian">Jam</label>
								<div class="col-12">
									<input type="text" id="jam_kejadian" name="jam_kejadian" class="form-control time" placeholder="hh:mm" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tempat_kejadian">Tempat Kejadian</label>
								<div class="col-12">
									<input type="text" class="form-control" id="tempat_kejadian" name="tempat_kejadian" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="gcs">GCS</label>
								<div class="col-12">
									<input type="text" class="form-control" id="gcs" name="gcs" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="td">TD</label>
								<div class="col-12">
									<input type="text" class="form-control" name="td" id="td" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="n">N (Frekuensi per menit)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="n" id="n" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="s">S (dalam celcius)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="s" id="s" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="rr">RR (Frekuensi per menit)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="rr" id="rr" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="spo2">SPO<small>2</small> (%)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="spo2" id="spo2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="o2">O<small>2</small> (Lpm)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="o2" id="o2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">BVM</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bvm" id="bvm_ya" value="Ya">
										<label class="custom-control-label" for="bvm_ya">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bvm" id="bvm_tdk" value="Tidak" checked="">
										<label class="custom-control-label" for="bvm_tdk">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ett">ETT</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ett" id="ett" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Pipa Oro / Nasopharingeal</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pipa_oro" id="pipa_oro_ya" value="Ya">
										<label class="custom-control-label" for="pipa_oro_ya">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="pipa_oro" id="pipa_oro_tdk" value="Tidak" checked="">
										<label class="custom-control-label" for="pipa_oro_tdk">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tracheostomy">Tracheostomy</label>
								<div class="col-12">
									<input type="text" class="form-control" name="tracheostomy" id="tracheostomy" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="cpr">CPR</label>
								<div class="col-12">
									<input type="text" class="form-control" name="cpr" id="cpr" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="infus">Infus</label>
								<div class="col-12">
									<input type="text" class="form-control" name="infus" id="infus" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ngt">NGT</label>
								<div class="col-12">
									<input type="text" class="form-control" name="ngt" id="ngt" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kateter">Kateter</label>
								<div class="col-12">
									<input type="text" class="form-control" name="kateter" id="kateter" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Bidai</label>
								<div class="col-12">
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bidai" id="bidai_ya" value="Ya">
										<label class="custom-control-label" for="bidai_ya">Ya</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input class="custom-control-input" type="radio" name="bidai" id="bidai_tdk" value="Tidak" checked="">
										<label class="custom-control-label" for="bidai_tdk">Tidak</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jahit_luka">Jahit Luka</label>
								<div class="col-12">
									<input type="text" class="form-control" name="jahit_luka" id="jahit_luka" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="data_penunjang">Data Penunjang</label>
								<div class="col-12">
									<input type="text" class="form-control" name="data_penunjang" id="data_penunjang" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="obat">Obat-obatan</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat" id="obat" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="alasan_indikasi">Alasan/Indikasi dirujuk</label>
								<div class="col-12">
									<input type="text" class="form-control" name="alasan_indikasi" id="alasan_indikasi" autocomplete="off">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>Skrining Nyeri</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="provokatif">Provokatif</label>
								<div class="col-12">
									<select class="form-control" id="provokatif" name="provokatif">
										<option value="Ruda Paksa" selected>Ruda Paksa</option>
										<option value="Benturan">Benturan</option>
										<option value="Sayatan">Sayatan</option>
										<option value="0">Lain-Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_provokatif_lain2" style="display: none;">
								<label class="col-12" for="provokatif_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="provokatif_lain2" id="provokatif_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="quality">Quality</label>
								<div class="col-12">
									<select class="form-control" id="quality" name="quality">
										<option value="Tertusuk" selected>Tertusuk</option>
										<option value="Tertekan/Tertindih">Tertekan/Tertindih</option>
										<option value="Diirs-iris">Diirs-iris</option>
										<option value="0">Lain-Lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_quality_lain2" style="display: none;">
								<label class="col-12" for="quality_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="quality_lain2" id="quality_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="region">Region</label>
								<div class="col-12">
									<input type="text" class="form-control" name="region" id="region" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lokasi_menjalar">Lokasi Menjalar (kosongi bila tidak menjalar)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="lokasi_menjalar" id="lokasi_menjalar" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="skala">Skala</label>
								<div class="col-12">
									<input type="text" class="form-control" name="skala" id="skala" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="time">Time</label>
								<div class="col-12">
									<select class="form-control" id="time" name="time">
										<option value="Jarang" selected>Jarang</option>
										<option value="Hilang Timbul">Hilang Timbul</option>
										<option value="Terus Menerus">Terus Menerus</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="keadaan_umum">Keadaan Umum</label>
								<div class="col-12">
									<select class="form-control" id="keadaan_umum" name="keadaan_umum">
										<option value="Baik" selected>Baik</option>
										<option value="Sedang">Sedang</option>
										<option value="Buruk">Buruk</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="status_psikologis">Status Psikologis</label>
								<div class="col-12">
									<select class="form-control" id="status_psikologis" name="status_psikologis">
										<option value="Tenang" selected>Tenang</option>
										<option value="Cemas">Cemas</option>
										<option value="Sedih">Sedih</option>
										<option value="Depresi">Depresi</option>
										<option value="Marah">Marah</option>
										<option value="Hiperaktif">Hiperaktif</option>
										<option value="Mengganggu Sekitar">Mengganggu Sekitar</option>
										<option value="0">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5" id="div_status_psikologis_lain2" style="display: none;">
								<label class="col-12" for="status_psikologis_lain2">Lain-lain</label>
								<div class="col-12">
									<input type="text" class="form-control" name="status_psikologis_lain2" id="status_psikologis_lain2" autocomplete="off">
								</div>
							</div>
							<hr class="mt-20 mb-20">
							<h5>GCS</h5>
							<div class="form-group row mb-5">
								<label class="col-12" for="e">E</label>
								<div class="col-12">
									<input type="text" class="form-control" name="e" id="e" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="v">V</label>
								<div class="col-12">
									<input type="text" class="form-control" name="v" id="v" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="m">M</label>
								<div class="col-12">
									<input type="text" class="form-control" name="m" id="m" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="total">Total</label>
								<div class="col-12">
									<input type="text" class="form-control" name="total" id="total" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
					</div>
				</div>
			</div><!-- /.modal-dialog -->
		</form>
	</div><!-- /.modal -->
</div>