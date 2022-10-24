<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="col-12">
				<h5 class="pt-15">Yang Memberi Persyaratan</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Hubungan dengan pasien</label>
			    <input type="text" class="form-control" name="hubungan_dengan_pasien" >
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
			    <label>No Telepon</label>
			    <input type="text" class="form-control" name="no_telepon" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Persetujuan Rawat Inap</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Ruang</label>
			    <input type="text" class="form-control" name="ruang" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kelas</label>
			    <input type="text" class="form-control" name="kelas" >
			</div>
	    </div>
	</div>