<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">
		<div class="form-group col-md-3 col-sm-12">
			<label>Alergi</label>
			<input type="text" class="form-control" name="alergi" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Risiko</label>
			<input type="text" class="form-control" name="risiko" >
		</div>
		<div class="col-12">
			<h4 class="pt-15">Tindak Lanjut</h4>
		</div>
		<div class="col-12">
			<h5 class="pt-15">Pulang</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pulang" value="Tidak">
					<span class="css-control-indicator"></span> Tidak
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pulang" value="Ya">
					<span class="css-control-indicator"></span> Ya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>	
		<div class="form-group col-md-3 col-sm-12">
			<label>Kontrol ulang tanggal</label>
			<input type="text" class="form-control js-datepicker" name="kontrol_ulang_tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Kontrol ulang di</label>
			<input type="text" class="form-control" name="kontrol_ulang_di" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Pulang Atas Permintaan Keluarga</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pulang_atas_permintaan_keluarga" value="Tidak">
					<span class="css-control-indicator"></span> Tidak
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pulang_atas_permintaan_keluarga" value="Ya">
					<span class="css-control-indicator"></span> Ya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">Observasi</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="observasi" value="Tidak">
					<span class="css-control-indicator"></span> Tidak
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="observasi" value="Ya">
					<span class="css-control-indicator"></span> Ya
				</label>
			</div>
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Pulang jam</label>
			<input type="text" class="form-control time" name="pulang_jam" autocomplete="off">
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">MRS</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="mrs" value="Tidak">
					<span class="css-control-indicator"></span> Tidak
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="mrs" value="Ya">
					<span class="css-control-indicator"></span> Ya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Dirawat di ruang</label>
			<input type="text" class="form-control" name="dirawat_di_ruang" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Alasan menolak MRS</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alasan_menolak_mrs_masalah_biaya">
					<span class="css-control-indicator"></span> Masalah biaya
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alasan_menolak_mrs_masalah_lokasi_rumah">
					<span class="css-control-indicator"></span> Masalah lokasi rumah
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alasan_menolak_mrs_masalah_kondisi_pasien">
					<span class="css-control-indicator"></span> Masalah kondisi pasien
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Alasan lainnya</label>
			<input type="text" class="form-control" name="alasan_lainnya" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Dirujuk</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="dirujuk" value="Tidak">
					<span class="css-control-indicator"></span> Tidak
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="dirujuk" value="Ya">
					<span class="css-control-indicator"></span> Ya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">Alasan dirujuk</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alasan_dirujuk_tempat_penuh">
					<span class="css-control-indicator"></span> Tempat penuh
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alasan_dirujuk_perlu_fasilitas_lebih">
					<span class="css-control-indicator"></span> Perlu fasilitas lebih
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alasan_dirujuk_permintaan_pasien_dan_keluarga">
					<span class="css-control-indicator"></span> Permintaan pasien dan keluarga
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Alasan lain</label>
			<input type="text" class="form-control" name="alasan_lain" >
		</div>
	</div>
</div>