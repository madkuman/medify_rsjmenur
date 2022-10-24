<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Tes</label>
			    <input type="text" class="form-control" name="tujuan_tes" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keperluan</label>
			    <input type="text" class="form-control" name="keperluan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujukan dari</label>
			    <input type="text" class="form-control" name="rujukan_dari" >
			</div>
	    	
	    	<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kecerdasan Umum</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk memahami &  mengkaji persoalan serta memberikan respon yang sesuai
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
				<h5 class="pt-15">Sistematika Berpikir</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang sistematis dalam berpikir
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Siatematis dalam berpikir
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistematika_berpikir" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistematika_berpikir" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistematika_berpikir" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistematika_berpikir" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistematika_berpikir" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistematika_berpikir" value="Sangat Tinggi">
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
			<div class="col-12">
				<h5 class="pt-15">Stabilitas Emosi</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk mengendalikan perasaan & mudah panik / reaktif dalam menghadapi tekanan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Kemampuan yang sangat baik untuk mengendalikan perasaan & tidak mudah panik / reaktif dalam menghadapi tekanan
				</p>
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
				<h5 class="pt-15">Kerja Sama</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk menjalin hubungan kerja / sosialisasi dalam suatu tim untuk mencapai tujuan bersama
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Kemampuan yang sangat baik untuk menjalin hubungan kerja / sosialisasi dalam suatu tim untuk mencapai tujuan bersama
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kepekaan Sosial</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ketidakmampuan untuk mengenali kebutuhan & perasaan orang lain serta menindaklanjuti respon
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Kemampuan yang sangat baik untuk mengenali kebutuhan & perasaan orang lain serta menindaklanjuti respon
				</p>
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
				<h5 class="pt-15">Kemampuan Adaptasi</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kaku, kurang luwes, membutuhkan waktu yang lama untuk menyesuaikan diri
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu menyesuaikan diri dengan perubahan situasi
				</p>
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
				<h5 class="pt-15">Motivasi</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Tidak mempunyai dorongan / keinginan untuk selalu mencapai prestasi terbaik, tidak siap menghadapi tantangan, tidak mau belajar & berusaha
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mempunyai dorongan / keinginan yang kuat untuk selalu mencapai prestasi terbaik, siap menghadapi tantangan,  mau belajar & berusaha
				</p>
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
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kemampuan Intelektual Berfungsi pada Taraf </label>
			    <input type="text" class="form-control" name="kemampuan_intelektual" >
			</div>
	    </div>
	</div>