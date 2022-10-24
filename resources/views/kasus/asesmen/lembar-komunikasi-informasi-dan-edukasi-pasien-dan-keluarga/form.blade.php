<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Kebutuhan Materi Edukasi Informasi</label>
			    <textarea class="form-control" name="kebutuhan_materi_edukasi_informasi" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Edukasi</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_edukasi" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam Edukasi</label>
			    <input type="text" class="form-control time" name="jam_edukasi" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Durasi Edukasi</label>
			    <input type="text" class="form-control" name="durasi_edukasi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Metode</label>
			    <input type="text" class="form-control" name="metode" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nama Edukator Pemberi Informasi</label>
			    <input type="text" class="form-control" name="nama_edukator_pemberi_informasi" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Verifikasi</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="verifikasi_verfikasi">
			            <span class="css-control-indicator"></span> Verfikasi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nama Penerima Informasi</label>
			    <input type="text" class="form-control" name="nama_penerima_informasi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Hubungan terhadap pasien</label>
			    <input type="text" class="form-control" name="hubungan_terhadap_pasien" >
			</div>
	    </div>
	</div>