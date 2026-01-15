<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Berapa tahun menempuh pendidikan</label>
			    <input type="text" class="form-control" name="berapa_tahun_menempuh_pendidikan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nomor identitas responden</label>
			    <input type="text" class="form-control" name="nomor_identitas_responden" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nomor identitas pewawancara</label>
			    <input type="text" class="form-control" name="nomor_identitas_pewawancara" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Titik waktu penilaian</label>
			    <input type="text" class="form-control" name="titik_waktu_penilaian" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Waktu wawancara</label>
			    <input type="text" class="form-control js-datepicker" name="waktu_wawancara" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="col-12">
				<h5 class="pt-15">Situasi hidup saat wawancara</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="situasi_hidup_saat_wawancara" value="Mandiri di komunitas">
			            <span class="css-control-indicator"></span> Mandiri di komunitas
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="situasi_hidup_saat_wawancara" value="Hidup dengan bantuan">
			            <span class="css-control-indicator"></span> Hidup dengan bantuan (fisik, keuangan, atau sosial)
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="situasi_hidup_saat_wawancara" value="Dirawat di rumah sakit">
			            <span class="css-control-indicator"></span> Dirawat di rumah sakit
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<table width="100%" class="table table-bordered table-vcenter table-responsive">
					<tr>
						<th colspan="2">Dalam 30 hari terakhir, berapa besar kesulitan yang anda alami dalam :</th>
						<th width="8%" class="text-center">Tidak ada</th>
						<th width="8%" class="text-center">Ringan</th>
						<th width="8%" class="text-center">Sedang</th>
						<th width="8%" class="text-center">Berat</th>
						<th width="18%" class="text-center">Sangat berat atau tidak mampu melakukan</th>
					</tr>
					<tr>
						<td width="5%" align="center">S1</td>
						<td width="45%">Berdiri untuk jangka waktu lama misalnya 30 menit? </td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berdiri_untuk_jangka_waktu_yang_lama" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berdiri_untuk_jangka_waktu_yang_lama" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berdiri_untuk_jangka_waktu_yang_lama" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berdiri_untuk_jangka_waktu_yang_lama" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berdiri_untuk_jangka_waktu_yang_lama" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S2</td>
						<td>Melakukan pekerjaan rumah?</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="melakukan_pekerjaan_rumah" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="melakukan_pekerjaan_rumah" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="melakukan_pekerjaan_rumah" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="melakukan_pekerjaan_rumah" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="melakukan_pekerjaan_rumah" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S3</td>
						<td>Mempelajari hal baru, misalnya pergi ke tempat baru? </td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempelajari_hal_baru" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempelajari_hal_baru" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempelajari_hal_baru" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempelajari_hal_baru" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempelajari_hal_baru" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S4</td>
						<td>Apakah anda mengalami kesulitan bergabung dalam aktivitas di masyarakat? (Contohnya kegiatan keagamaan, perayaan) seperti halnya yang dilakukan orang lain?</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mengalami_kesulitan_bergabung" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mengalami_kesulitan_bergabung" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mengalami_kesulitan_bergabung" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mengalami_kesulitan_bergabung" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mengalami_kesulitan_bergabung" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S5</td>
						<td>Sejauh mana kondisi kesehatan anda mempengaruhi anda secara emosional?</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kesehatan_mempengaruhi_emosional" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kesehatan_mempengaruhi_emosional" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kesehatan_mempengaruhi_emosional" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kesehatan_mempengaruhi_emosional" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kondisi_kesehatan_mempengaruhi_emosional" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-12">
				<table width="100%" class="table table-bordered table-vcenter table-responsive">
					<tr>
						<th colspan="2">Dalam 30 hari terakhir, berapa besar kesulitan yang anda alami dalam :</th>
						<th width="8%" class="text-center">Tidak ada</th>
						<th width="8%" class="text-center">Ringan</th>
						<th width="8%" class="text-center">Sedang</th>
						<th width="8%" class="text-center">Berat</th>
						<th width="18%" class="text-center">Sangat berat atau tidak mampu melakukan</th>
					</tr>
					<tr>
						<td width="5%" align="center">S6</td>
						<td width="45%">Berkonsentrasi dalam melakukan sesuatu selama 10 menit?</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berkonsentrasi_dalam_melakukan_sesuatu" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berkonsentrasi_dalam_melakukan_sesuatu" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berkonsentrasi_dalam_melakukan_sesuatu" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berkonsentrasi_dalam_melakukan_sesuatu" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berkonsentrasi_dalam_melakukan_sesuatu" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S7</td>
						<td>Untuk berjalan dalam jarak yang jauh, misalnya 1 kilometer?</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berjalan_dalam_jarak_yang_jauh" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berjalan_dalam_jarak_yang_jauh" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berjalan_dalam_jarak_yang_jauh" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berjalan_dalam_jarak_yang_jauh" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berjalan_dalam_jarak_yang_jauh" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S8</td>
						<td>Mandi</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mandi" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mandi" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mandi" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mandi" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mandi" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S9</td>
						<td>Berpakaian</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berpakaian" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berpakaian" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berpakaian" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berpakaian" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berpakaian" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S10</td>
						<td>Berhubungan dengan orang baru yang belum dikenal </td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berhubungan_dengan_orang_baru" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berhubungan_dengan_orang_baru" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berhubungan_dengan_orang_baru" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berhubungan_dengan_orang_baru" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="berhubungan_dengan_orang_baru" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S11</td>
						<td>Mempertahankan pertemanan</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempertahankan_pertemanan" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempertahankan_pertemanan" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempertahankan_pertemanan" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempertahankan_pertemanan" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="mempertahankan_pertemanan" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>

					<tr>
						<td align="center">S12</td>
						<td>Kembali bekerja atau bersekolah </td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kembali_bekerja_atau_bersekolah" value="Tidak ada">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kembali_bekerja_atau_bersekolah" value="Ringan">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kembali_bekerja_atau_bersekolah" value="Sedang">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kembali_bekerja_atau_bersekolah" value="Berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
						<td align="center">
							<label class="css-control css-control-primary css-radio w-100">
					            <input type="radio" class="css-control-input" name="kembali_bekerja_atau_bersekolah" value="Sangat berat">
					            <span class="css-control-indicator"></span>
					        </label>
						</td>
					</tr>
				</table>
			</div>

			<div class="form-group col-md-3 col-sm-12">
			    <label>Secara keseluruhan dalam 30 hari ini, secara keseluruhan, ada berapa hari anda mengalami kesulitan tersebut? </label>
			    <input type="text" class="form-control" name="berapa_hari_anda_mengalami_kesulitan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Dalam 30 hari terakhir, selama beberapa hari anda sama sekali tidak mampu melakukan aktifitas atau pekerjaan seperti biasa karena ada masalah kesehatan? </label>
			    <input type="text" class="form-control" name="berapa_hari_sama_sekali_tidak_mampu_melakukan_aktifitas" >
			</div>
			<div class="form-group col-md-4 col-sm-12">
			    <label>Dalam 30 hari terakhir, dengan tidak memperhitungkan hari dimana anda sama sekali tidak mampu beberapa hari anda harus mengurangi aktifitas atau pekerjaan yang biasa dilakukan karena masalah kesehatan tersebut?</label>
			    <input type="text" class="form-control" name="berapa_hari_anda_harus_mengurangi_aktifitas" >
			</div>
	    </div>
	</div>