<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    		
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Tes</label>
			    <input type="text" class="form-control" name="tujuan_tes" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujukan dari</label>
			    <input type="text" class="form-control" name="rujukan_dari" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kecerdasan Umum</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk memahami & mengkaji persoalan serta memberikan respon yang sesuai
				</p>
				<p><b>Gambaran Individu (Skor Tinggi)</b> <br>
					Kemampuan yang sangat baik untuk memahami & mengkaji persoalan serta memberikan respon yang sesuai
				</p>
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
				<h5 class="pt-15">Fleksibilitas Berpikir</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk menemukan alternatif pemecahan masalah dengan cepat, lancar untuk mencari jalan keluar yang efektif ketika menghadapi hambatan
				</p>
				<p><b>Gambaran Individu (Skor Tinggi)</b> <br>
					Kemampuan yang sangat baik untuk menemukan alternatif pemecahan masalah dengan cepat, lancar, untuk mencari jalan keluar yang efektif ketika menghadapi hambatan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="fleksibilitas_berpikir" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="fleksibilitas_berpikir" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="fleksibilitas_berpikir" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="fleksibilitas_berpikir" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="fleksibilitas_berpikir" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="fleksibilitas_berpikir" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Analisa Sintesa</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk  menguraikan persoalan & menangkap aspek-aspek terkait dengan memahami esensinya
				</p>
				<p><b>Gambaran Individu (Skor Tinggi)</b> <br>
					Kemampuan yang sangat baik untuk menguraikan persoalan & menangkap aspek-aspek terkait dengan memahami esensinya
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="analisa_sintesa" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="analisa_sintesa" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="analisa_sintesa" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="analisa_sintesa" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="analisa_sintesa" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="analisa_sintesa" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Berpikir Konseptual</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk mengidentifikasi pola/hubungan antar situasi, menyimpulkan berbagai informasi, & menciptakan konsep baru
				</p>
				<p><b>Gambaran Individu (Skor Tinggi)</b> <br>
					Kemampuan yang sangat baik untuk mengidentifikasi pola/hubungan antar situasi, menyimpulkan berbagai informasi, & menciptakan konsep baru
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="berpikir_konseptual" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="berpikir_konseptual" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="berpikir_konseptual" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="berpikir_konseptual" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="berpikir_konseptual" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="berpikir_konseptual" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kemampuan Intelektual Berfungsi pada Taraf </label>
			    <input type="text" class="form-control" name="kemampuan_intelektual" >
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Kesimpulan</label>
			    <textarea class="form-control" name="kesimpulan" rows="5" id="js-ckeditor"> </textarea>
			</div>
	    </div>
	</div>