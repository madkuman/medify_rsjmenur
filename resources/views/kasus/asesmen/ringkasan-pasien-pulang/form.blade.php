<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">

		<div class="col-12">
			<h4 class="pt-15">Anamnesa</h4>
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keluhan Utama</label>
			<input type="text" class="form-control" name="keluhan_utama" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Perjalanan Penyakit Pasien</label>
			<input type="text" class="form-control" name="perjalanan_penyakit_pasien" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keluhan Lain</label>
			<input type="text" class="form-control" name="keluhan_lain" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Riwayat Penyakit Dahulu</h4>
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Riwayat Penyakit Sebelumnya</label>
			<input type="text" class="form-control" name="riwayat_penyakit_sebelumnya" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Riwayat Keluarga</label>
			<input type="text" class="form-control" name="riwayat_keluarga" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Riwayat Penyakit Lain lain</label>
			<input type="text" class="form-control" name="riwayat_penyakit_lain_lain" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Pemeriksaan Saat MRS</h4>
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Fisik</label>
			<input type="text" class="form-control" name="fisik" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Psikiatrik</label>
			<input type="text" class="form-control" name="psikiatrik" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Laboratorium</label>
			<input type="text" class="form-control" name="laboratorium" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Radiologi</label>
			<input type="text" class="form-control" name="radiologi" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Pemeriksaan Lain lain</label>
			<input type="text" class="form-control" name="pemeriksaan_lain_lain" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Indikasi MRS</h4>
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Indikasi MRS Diagnosa Masuk</label>
			<input type="text" class="form-control" name="indikasi_mrs_diagnosa_masuk" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Diagnosa Akhir</h4>
		</div>
		<div class="full-only col-md-1"></div>
		<div class="form-group col-md-8 col-sm-12">
			<label>Axis 1</label>
			<input type="text" class="form-control" name="axis_1" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>ICD 10 Axis 1</label>
			<input type="text" class="form-control" name="icd_10_axis_1" >
		</div>
		<div class="full-only col-12"></div>
		<div class="full-only col-md-1"></div>
		<div class="form-group col-md-8 col-sm-12">
			<label>Axis 2</label>
			<input type="text" class="form-control" name="axis_2" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>ICD 10 Axis 2</label>
			<input type="text" class="form-control" name="icd_10_axis_2" >
		</div>
		<div class="full-only col-12"></div>
		<div class="full-only col-md-1"></div>
		<div class="form-group col-md-8 col-sm-12">
			<label>Axis 3</label>
			<input type="text" class="form-control" name="axis_3" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>ICD 10 Axis 3</label>
			<input type="text" class="form-control" name="icd_10_axis_3" >
		</div>
		<div class="full-only col-12"></div>
		<div class="full-only col-md-1"></div>
		<div class="form-group col-md-8 col-sm-12">
			<label>Axis 4</label>
			<input type="text" class="form-control" name="axis_4" >
		</div>
		<div class="full-only col-12"></div>
		<div class="full-only col-md-1"></div>
		<div class="form-group col-md-8 col-sm-12">
			<label>Axis 5</label>
			<input type="text" class="form-control" name="axis_5" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Informasi Lainnya</h4>
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-7 col-sm-12">
			<label>Masalah Utama yang Dihadapi</label>
			<textarea class="form-control" name="masalah_utama_yang_dihadapi" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-7 col-sm-12">
			<label>Konsultasi</label>
			<textarea class="form-control" name="konsultasi" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-7 col-sm-12">
			<label>Perjalanan Penyakit Selama Perawatan</label>
			<textarea class="form-control" name="perjalanan_penyakit_selama_perawatan" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-7 col-sm-12">
			<label>Tindakan Medis Operatif/ Non Operatif</label>
			<textarea class="form-control" name="tindakan_medis_operatif_non_operatif" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Keadaan Waktu KRS</label>
			<input type="text" class="form-control" name="keadaan_waktu_krs" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>(Bila Meninggal) Sebab Meninggal</label>
			<input type="text" class="form-control" name="sebab_meninggal" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Tindak Lanjut</label>
			<input type="text" class="form-control" name="tindak_lanjut" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Catatan Khusus</label>
			<input type="text" class="form-control" name="catatan_khusus" >
		</div>
	</div>
</div>