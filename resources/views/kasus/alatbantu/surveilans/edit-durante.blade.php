<div class="modal" id="editDuranteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<form action="{{url()->current()}}/create" method="POST">
			<div class="modal-content" >
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header ">
						<h3 class="block-title">Form Edit Pengumpulan Data Surveilans Infeksi Luka Operasi - Durante Operasi</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<div class="block-content row">
						{{csrf_field()}}
						<input type="hidden" name="type" value="Surveilans Infeksi Luka Durante Ops">
							<input type="hidden" name="lokasi_id" value="{{$kasus->lokasi->lokasi->id}}">
						<div class="col-md-4 col-12">
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_mrs">Tanggal MRS</label>
								<div class="col-12">
									<input type="text" id="tgl_mrs" class="js-datepicker form-control" autocomplete="off" name="tgl_mrs" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tgl_operasi">Tanggal Operasi</label>
								<div class="col-12">
									<input type="text" id="tgl_operasi" class="js-datepicker form-control" autocomplete="off" name="tgl_operasi" data-week-start="1" data-autoclose="true" data-date-format="dd/mm/yy" value="">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="lama_operasi">Lama Operasi</label>
								<div class="col-12">
									<input type="text" id="lama_operasi" name="lama_operasi" class="form-control time" placeholder="hh:mm" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_operasi">Jenis Operasi</label>
								<div class="col-12">
									<select class="form-control" id="jenis_operasi" name="jenis_operasi">
										<option value="Elektif" selected>Elektif</option>
										<option value="Darurat">Darurat</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="operasi_trauma">Operasi Karena Trauma</label>
								<div class="col-12">
									<select class="form-control" id="operasi_trauma" name="operasi_trauma">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="ruang">Ruang Operasi</label>
								<div class="col-12">
									<select class="form-control" id="ruang" name="ruang">
										<option value="1" selected>1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="bb">Berat Badan (kg)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="bb" name="bb" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kualifikasi">Kualifikasi Dokter Bedah</label>
								<div class="col-12">
									<select class="form-control" id="kualifikasi" name="kualifikasi">
										<option value="Spesialis" selected>Spesialis</option>
										<option value="Konsultan">Konsultan</option>
										<option value="Associate Specialist">Associate Specialist</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kualifikasi_lain2">Kualifikasi lain-lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="kualifikasi_lain2" name="kualifikasi_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="prosedur">Prosedur Operasi</label>
								<div class="col-12">
									<select class="form-control" id="prosedur" name="prosedur">
										<option value="LSCS" selected>LSCS</option>
										<option value="Appendictomy">Appendictomy</option>
										<option value="ORIF">ORIF</option>
										<option value="Explorasi CCBD">Explorasi CCBD</option>
										<option value="Lain-lain">Lain-lain</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="prosedur_lain2">Prosedur Operasi lain-lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="prosedur_lain2" name="prosedur_lain2" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="diagnosa">Diagnosa</label>
								<div class="col-12">
									<input type="text" class="form-control" id="diagnosa" name="diagnosa" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="multiprosedur">Multiprosedur dengan insisi yang sama</label>
								<div class="col-12">
									<select class="form-control" id="multiprosedur" name="multiprosedur">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="klasifikasi">Klasifikasi Luka</label>
								<div class="col-12">
									<select class="form-control" id="klasifikasi" name="klasifikasi">
										<option value="Bersih" selected>Bersih</option>
										<option value="Terkontaminasi">Terkontaminasi</option>
										<option value="Bersih Terkontaminasi">Bersih Terkontaminasi</option>
										<option value="Kotor">Kotor</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="asa_scoring">ASA Scoring</label>
								<div class="col-12">
									<select class="form-control" id="asa_scoring" name="asa_scoring">
										<option value="1 - Pasien tidak ada kelainan sistemik selain yang akan dioperasi" selected>1 - Pasien tidak ada kelainan sistemik selain yang akan dioperasi</option>
										<option value="2 - Pasien ada gangguan sistemik ringan">2 - Pasien ada gangguan sistemik ringan</option>
										<option value="3 - Pasien ada gangguan sistemik sedang/berat - ada gangguan aktivitas">3 - Pasien ada gangguan sistemik sedang/berat - ada gangguan aktivitas</option>
										<option value="4 - Pasien ada gangguan sistemik berat dan mengancam jiwa">4 - Pasien ada gangguan sistemik berat dan mengancam jiwa</option>
										<option value="5 - Pasien ada gangguan berat, dilakukan/tidak dilakukan tindakan dapat meninggal dalam 24 jam">5 - Pasien ada gangguan berat, dilakukan/tidak dilakukan tindakan dapat meninggal dalam 24 jam</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group row mb-5">
								<label class="col-12" for="sirkulasi">Sirkulasi Udara</label>
								<div class="col-12">
									<input type="text" class="form-control" id="sirkulasi" name="sirkulasi" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="air_count">Air Count OT</label>
								<div class="col-12">
									<input type="text" class="form-control" id="air_count" name="air_count" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="kelembaban">Kelembaban Ruang OT</label>
								<div class="col-12">
									<input type="text" class="form-control" id="kelembaban" name="kelembaban" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="tekanan">Tekanan Udara</label>
								<div class="col-12">
									<select class="form-control" id="tekanan" name="tekanan">
										<option value="Positif" selected>Positif</option>
										<option value="Negatif">Negatif</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jamur">Jamur AC</label>
								<div class="col-12">
									<select class="form-control" id="jamur" name="jamur">
										<option value="Positif" selected>Positif</option>
										<option value="Negatif">Negatif</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="drain">Drain</label>
								<div class="col-12">
									<select class="form-control" id="drain" name="drain">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_drain">Jenis Drain (apabila menggunakan)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="jenis_drain" name="jenis_drain" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="suhu_ruang">Suhu Ruang (&#176;C)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="suhu_ruang" name="suhu_ruang" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="implant">Implant</label>
								<div class="col-12">
									<select class="form-control" id="implant" name="implant">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jenis_implant">Jenis Implant (apabila menggunakan)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="jenis_implant" name="jenis_implant" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="cssd">Sterilisasi CSSD</label>
								<div class="col-12">
									<select class="form-control" id="cssd" name="cssd">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="antibiotik">Antibiotik Tambahan</label>
								<div class="col-12">
									<select class="form-control" id="antibiotik" name="antibiotik">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="obat_antibiotik">Antibiotik Tambahan Saat Op (apabila diberikan)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="obat_antibiotik" name="obat_antibiotik" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="dosis_antibiotik">Dosis</label>
								<div class="col-12">
									<input type="text" class="form-control" id="dosis_antibiotik" name="dosis_antibiotik" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_antibiotik">Diberikan jam</label>
								<div class="col-12">
									<input type="text" class="form-control time" id="jam_antibiotik" placeholder="hh:mm" name="jam_antibiotik" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12">Disinfeksi Kulit</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" id="chlorhexidine" name="chlorhexidine">
									<span class="css-control-indicator"></span> Chlorhexidine
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" id="povidone_iodine" name="povidone_iodine">
									<span class="css-control-indicator"></span> Povidone Iodine
								</label>
							</div>
							<div class="form-group mb-5">
								<label class="css-control css-control-primary css-checkbox">
									<input type="checkbox" class="css-control-input" id="alkohol_70" name="alkohol_70">
									<span class="css-control-indicator"></span> Alkohol 70%
								</label>
							</div>
							
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group row mb-5">
								<label class="col-12" for="disinfeksi_lain">Disinfeksi Kulit Lain-lain (tulis yang tidak tercantum diatas)</label>
								<div class="col-12">
									<input type="text" class="form-control" id="disinfeksi_lain" name="disinfeksi_lain" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="staff">Jumlah Staff</label>
								<div class="col-12">
									<input type="text" class="form-control" id="staff" name="staff" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="instrumen">Indikator Instrumen / Alat Steril</label>
								<div class="col-12">
									<select class="form-control" id="instrumen" name="instrumen">
										<option value="Intenal" selected>Intenal</option>
										<option value="External">External</option>
										<option value="Tidak Ada">Tidak Ada</option>
									</select>
								</div>
							</div>

							<div class="form-group row mb-5">
								<label class="col-12" for="profilaksis">Profilaksis</label>
								<div class="col-12">
									<select class="form-control" id="profilaksis" name="profilaksis">
										<option value="Ya" selected>Ya</option>
										<option value="Tidak">Tidak</option>
									</select>
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="obat_profilaksis">Obat Profilaksis (apabila diberikan)</label>
								<div class="col-12">
									<input type="text" class="form-control" name="obat_profilaksis" id="obat_profilaksis" autocomplete="off">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="dosis_profilaksis">Dosis</label>
								<div class="col-12">
									<input type="text" class="form-control" name="dosis_profilaksis" autocomplete="off" id="dosis_profilaksis">
								</div>
							</div>
							<div class="form-group row mb-5">
								<label class="col-12" for="jam_profilaksis">Diberikan jam</label>
								<div class="col-12">
									<input type="text" class="form-control time" name="jam_profilaksis" placeholder="hh:mm" autocomplete="off" id="jam_profilaksis">
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