<input type="hidden" name="id" value="" id="id">
<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	{{csrf_field()}}
	<div class="row">

		<div class="form-group col-md-3 col-sm-12">
			<label>Dirawat yang ke</label>
			<input type="text" class="form-control" name="dirawat_yang_ke" >
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Ruang</label>
			<input type="text" class="form-control" name="ruang" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Pindah Ruang ke</label>
			<input type="text" class="form-control" name="pindah_ruang_ke" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Kelas</label>
			<input type="text" class="form-control" name="kelas" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Pindah Kelas ke</label>
			<input type="text" class="form-control" name="pindah_kelas_ke" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Pengirim/Rujukan</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pengirim_rujukan" value="Puskesmas">
					<span class="css-control-indicator"></span> Puskesmas
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pengirim_rujukan" value="RS">
					<span class="css-control-indicator"></span> RS
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="pengirim_rujukan" value="Lainnya">
					<span class="css-control-indicator"></span> Lainnya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Tempat Pengirim/Rujukan</label>
			<input type="text" class="form-control" name="nama_pengirim_rujukan" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Kasus Visum</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="kasus_visum" value="Tidak">
					<span class="css-control-indicator"></span> Tidak
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="kasus_visum" value="Ya">
					<span class="css-control-indicator"></span> Ya
				</label>
			</div>
		</div>
		<div class="col-12">
			&nbsp;
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>DPJP</label>
			<input type="text" class="form-control" name="dpjp" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Case Manager</label>
			<input type="text" class="form-control" name="case_manager" >
		</div>
		<div class="form-group col-md-3 col-sm-12">
			<label>Lama Dirawat</label>
			<input type="text" class="form-control" name="lama_dirawat" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Diagnosa</h5>
		</div>
		<div class="col-12 row mx-0">
			<div class="col-md-6 col-12 pl-0">
				<div class="form-group col-sm-12 pl-0">
					<label>Diagnosa Masuk</label>
					<input type="text" class="form-control" name="diagnosa_masuk" >
				</div>
				<div class="form-group col-sm-12 pl-0">
					<label>Diagnosa Masuk Tambahan</label>
					<textarea class="form-control" name="diagnosa_masuk_tambahan" rows="5"> </textarea>
				</div>
			</div>
			<div class="col-md-6 col-12 pl-0">
				<div class="form-group col-sm-12 pl-0">
					<label>Diagnosa Keluar</label>
					<input type="text" class="form-control" name="diagnosa_keluar" >
				</div>					
				<div class="form-group col-sm-12 pl-0">
					<label>Diagnosa Keluar Tambahan</label>
					<textarea class="form-control" name="diagnosa_keluar_tambahan" rows="5"> </textarea>
				</div>	
			</div>
		</div>
		<div class="col-12">
			<h5 class="pt-15">Tindakan</h5>
		</div>
		<div class="form-group col-md-6 col-sm-12">
			<label>Tindakan yang dilakukan</label>
			<textarea class="form-control" name="tindakan_yang_dilakukan" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
		<div class="col-12">
			<h5 class="pt-15">Keadaan Keluar</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Sembuh">
					<span class="css-control-indicator"></span> Sembuh
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Belum sembuh perlu perawatan lanjutan">
					<span class="css-control-indicator"></span> Belum sembuh perlu perawatan lanjutan
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="keadaan_keluar" value="Meninggal">
					<span class="css-control-indicator"></span> Meninggal
				</label>
			</div>
		</div>
		<div class="col-md-3">
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
		<div class="form-group col-md-3 col-sm-12">
			<label>Rujuk ke</label>
			<input type="text" class="form-control" name="rujuk_ke" >
		</div>
		<div class="col-12">
			<h5 class="pt-15">Cara keluar</h5>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="cara_keluar" value="Atas advis dokter">
					<span class="css-control-indicator"></span> Atas advis dokter
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-radio">
					<input type="radio" class="css-control-input" name="cara_keluar" value="Atas permintaan keluarga">
					<span class="css-control-indicator"></span> Atas permintaan keluarga
				</label>
			</div>
		</div>
		<div class="col-md-3">
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
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_tidak_ada_alergi">
					<span class="css-control-indicator"></span> Tidak ada alergi
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_obat_obatan">
					<span class="css-control-indicator"></span> Obat obatan
				</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group mb-5">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" value="1" class="css-control-input" name="alergi_makanan">
					<span class="css-control-indicator"></span> Makanan
				</label>
			</div>
		</div>
		<div class="col-md-3">
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
		<div class="form-group col-md-7 col-sm-12">
			<label>Keterangan Alergi</label>
			<textarea class="form-control" name="keterangan_alergi" rows="5"> </textarea>
		</div>
		<div class="col-12 full-only"></div>
	</div>
</div>