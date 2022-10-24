<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">

		<div class="form-group col-sm-12">
			<label>Alasan datang indikasi dirawat</label>
			<input type="text" class="form-control" name="alasan_datang_indikasi_dirawat" >
		</div>
		<div class="form-group col-sm-12">
			<label>Diagnosa Masuk</label>
			<input type="text" class="form-control" name="diagnosa_masuk" >
		</div>
		<div class="form-group col-sm-12">
			<label>Diagnosa Utama</label>
			<input type="text" class="form-control" name="diagnosa_utama" >
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Diagnosa tambahan</label>
			<textarea class="form-control" name="diagnosa_tambahan" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Pemeriksaan Fisik</label>
			<textarea class="form-control" name="pemeriksaan_fisik" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Tindakan Prosedur Utama</label>
			<input type="text" class="form-control" name="tindakan_prosedur_utama" >
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Tindakan Prosedur Lain</label>
			<textarea class="form-control" name="tindakan_prosedur_lain" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Terapi Pengobatan Selama di RS</label>
			<textarea class="form-control" name="terapi_pengobatan_selama_di_rs" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Terapi Pengobatan Setelah Pulang</label>
			<textarea class="form-control" name="terapi_pengobatan_setelah_pulang" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Instruksi Tindak Lanjut Follow Up</label>
			<textarea class="form-control" name="instruksi_tindak_lanjut_follow_up" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12">
			<h5 class="pt-15">Lanjutan Pengobatan</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="lanjutan_pengobatan" value="Poliklinik">
					<span class="css-control-indicator"></span> Poliklinik
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="lanjutan_pengobatan" value="Puskesmas">
					<span class="css-control-indicator"></span> Puskesmas
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="lanjutan_pengobatan" value="RS Lain">
					<span class="css-control-indicator"></span> RS Lain
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="lanjutan_pengobatan" value="Lain lain">
					<span class="css-control-indicator"></span> Lain lain
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-sm-12">
			<label>Lanjutan pengobatan di</label>
			<input type="text" class="form-control" name="lanjutan_pengobatan_di" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Keadaan Keluar</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Sembuh">
					<span class="css-control-indicator"></span> Sembuh
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Belum sembuh dan perlu perawatan lanjutan">
					<span class="css-control-indicator"></span> Belum sembuh dan perlu perawatan lanjutan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Meninggal">
					<span class="css-control-indicator"></span> Meninggal
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Rujuk">
					<span class="css-control-indicator"></span> Rujuk
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-sm-12">
			<label>Rujuk ke</label>
			<input type="text" class="form-control" name="rujuk_ke" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Cara keluar</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="cara_keluar" value="Atas advis dokter">
					<span class="css-control-indicator"></span> Atas advis dokter
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="cara_keluar" value="Atas permintaan keluarga">
					<span class="css-control-indicator"></span> Atas permintaan keluarga
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="cara_keluar" value="Melarikan diri">
					<span class="css-control-indicator"></span> Melarikan diri
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12">
			<h5 class="pt-15">Alergi</h5>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_tidak_ada_alergi">
					<span class="css-control-indicator"></span> Tidak Ada Alergi
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_obat_obatan">
					<span class="css-control-indicator"></span> Obat obatan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_makanan">
					<span class="css-control-indicator"></span> Makanan
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_lainnya">
					<span class="css-control-indicator"></span> Lainnya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="col-12 full-only"></div>
		<div class="form-group col-sm-12">
			<label>Keterangan Alergi</label>
			<textarea class="form-control" name="keterangan_alergi" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
	</div>
</div>