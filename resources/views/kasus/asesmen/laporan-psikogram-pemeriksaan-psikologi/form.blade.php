<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
	    	<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Pemeriksaan</label>
			    <input type="text" class="form-control" name="tujuan_pemeriksaan" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujukan Dari</label>
			    <input type="text" class="form-control" name="rujukan_dari" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kemampuan Intelektual pada Taraf</label>
			    <input type="text" class="form-control" name="kemampuan_intelektual_berfungsi_pada_taraf" >
			</div>
    		<div class="col-12 full-only"></div>
	    	
			<div class="col-12">
				<h5 class="pt-15">Kecerdasan Umum</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecerdasan_umum" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Stabilitas Emosi</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kemampuan Adaptasi</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kepekaan Sosial</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kepekaan_sosial" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kepekaan_sosial" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kepekaan_sosial" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kepekaan_sosial" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kepekaan_sosial" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kepekaan_sosial" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Motivasi</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Daya Tahan Terhadap Stres</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stres" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stres" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stres" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stres" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stres" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stres" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12 full-only"></div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Kesimpulan</label>
			    <textarea class="form-control" name="kesimpulan" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>