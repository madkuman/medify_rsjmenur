<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="col-12">
				<h5 class="pt-15">Pasien Dijemput Oleh</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nama</label>
			    <input type="text" class="form-control" name="nama" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Alamat</label>
			    <input type="text" class="form-control" name="alamat" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Telepon</label>
			    <input type="text" class="form-control" name="telepon" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Hubungan dengan pasien</label>
			    <input type="text" class="form-control" name="hubungan_dengan_pasien" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Pasien telah dinyatakan</label>
	            <select name="pasien_telah_dinyatakan" class="form-control form-control-lg js-select2" id="pasien_telah_dinyatakan" data-placeholder="Pilih Pasien telah dinyatakan" data-tags="true" style="width: 100%;">
	                <option value="">Silahkan Pilih</option>
					<option value="Sembuh sosial">Sembuh sosial</option>
					<option value="Selesai rehabilitasi T&R Napza">Selesai rehabilitasi T&R Napza</option>
					<option value="Belum membaik">Belum membaik</option>
					<option value="Meninggal">Meninggal</option>
					<option value="Telah dirujuk">Telah dirujuk</option>
					<option value="Pulang paksa">Pulang paksa</option>
					<option value="Pulang atas permintaan keluarga">Pulang atas permintaan keluarga</option>
					<option value="Pulang atas permintaan sendiri">Pulang atas permintaan sendiri</option>
					<option value="Pulang dropping">Pulang dropping</option>
    			</select>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujuk ke</label>
			    <input type="text" class="form-control" name="rujuk_ke" >
			</div>
	    </div>
	</div>