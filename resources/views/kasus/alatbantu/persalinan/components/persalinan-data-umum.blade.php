
<div class="row">
	<div class="col-12">
		<h5>Data Umum</h5>
	</div>
	<div class="col-3">
		<div class="form-group row mb-5">
			<label class="col-12" for="nama_suami">Nama Suami</label>
			<div class="col-12">
				<input type="text" name="nama_suami" class="form-control">
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="form-group row mb-5">
			<label class="col-12" for="usia_kehamilan">Usia Kehamilan</label>
			<div class="col-12">
				<input type="number" name="usia_kehamilan" class="form-control">
				<small>Dalam satuan minggu, contoh : 8, 9</small>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<div class="form-group row mb-5">
			<label class="col-12" for="maternal">Maternal</label>
			<div class="col-12">
				<select class="form-control" name="maternal">
					<option value="Hidup">Hidup</option>
					<option value="Mati">Mati</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group row mb-5 sebab-kematian-container">
			<label class="col-12" for="sebab_kematian">Sebab Kematian</label>
			<div class="col-12">
				<select class="form-control" name="sebab_kematian">
					<option value="" selected></option>
					<option value="Perdarahan">Perdarahan</option>
					<option value="Pre-Eklampsia">Pre-Eklampsia</option>
					<option value="Infeksi">Infeksi</option>
					<option value="Jantung">Jantung</option>
					<option value="Lain Lain">Lain lain</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="form-group row mb-5 keterangan-sebab-kematian-container">
			<label class="col-12" for="keterangan_sebab_kematian">Keterangan Sebab Kematian</label>
			<div class="col-12">
				<input type="text" class="form-control" name="keterangan_sebab_kematian">
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<div class="form-group row mb-5 waktu-kematian-container">
			<label class="col-8" for="kematian_tanggal">Tanggal Kematian</label>
			<label class="col-4" for="kematian_jam">Jam</label>
			<div class="col-8">
				<input type="text" class="form-control js-datepicker" name="kematian_tanggal" autocomplete="off" data-autoclose="true" data-today-highlight="true" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-end-date="+0d">
			</div>
			<div class="col-4">
				<input type="text" name="kematian_jam" class="form-control time" placeholder="hh:mm">
			</div>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group row mb-5 masa-kematian-container">
			<label class="col-12" for="masa_kematian">Masa Kematian</label>
			<div class="col-12">
				<select class="form-control" name="masa_kematian">
					<option value="" selected></option>
					<option value="Hamil">Hamil</option>
					<option value="Persalinan">Persalinan</option>
					<option value="Nifas">Nifas</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-3">
		<div class="form-group row mb-5 masa-kematian-nifas-container">
			<label class="col-12" for="kematian_nifas">Nifas</label>
			<div class="col-12">
				<input type="text" class="form-control" name="kematian_nifas">
				<small>Nifas hari keberapa saat meninggal. Apabila ibu meninggal pada masa nifas (6 jam - 42 hari post partum). Contoh : 12 hari post partum, apabila ibu meninggal 12 hari setelah bersalin
				</small>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-2">
		<div class="form-group row mb-5">
			<label class="col-12" for="gravida">Gravida</label>
			<div class="col-12">
				<input type="text" name="gpa_gravida" class="form-control">
			</div>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group row mb-5">
			<label class="col-12" for="para">Para</label>
			<div class="col-12">
				<input type="text" name="gpa_para" class="form-control">
			</div>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group row mb-5">
			<label class="col-12" for="abortus">Abortus</label>
			<div class="col-12">
				<input type="text" name="gpa_abortus" class="form-control">
			</div>
		</div>
	</div>
</div>
<div class="mb-20"></div>