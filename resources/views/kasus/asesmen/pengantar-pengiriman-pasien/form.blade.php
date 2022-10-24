<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-12 col-sm-12">
			    <label>Rumah Sakit Tujuan</label>
			    <input type="text" class="form-control" name="rumah_sakit_tujuan" >
			</div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-12 col-sm-12">
			    <label>Saran Perawatan dan Pengobatan Lebih Lanjut</label>
			    <textarea class="form-control" name="saran_perawatan_dan_pengobatan_lebih_lanjut" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>