<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
    		<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Tes</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_tes" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nomor</label>
			    <input type="text" class="form-control" name="nomor" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Tes</label>
			    <input type="text" class="form-control" name="tujuan_tes" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kemampuan Intelegensi</label>
			    <input type="text" class="form-control" name="kemampuan_intelegensi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kategori</label>
			    <input type="text" class="form-control" name="kategori" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
				<label>Dokter Pemeriksa</label>
				<select name="dokter_pemeriksa" class="form-control js-select2" style="width: 100%;" id="dokter" required>  
					<option value="" selected disabled>Pilih Dokter Pemeriksa</option>
					@foreach($dokter as $item)
					<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="col-12">
				<h5 class="pt-15">Penalaran Kongkrit</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang mampu berpikir kongkrit praktis dan realistis, sehingga sulit mengambil keputusan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu mengambil keputusan berdasarkan data yang menyertai dan berpikir realistis yang kongkrit praktis
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_kongkrit" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_kongkrit" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_kongkrit" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_kongkrit" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_kongkrit" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Penalaran Abstrak</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Sulit menemukan inti persoalan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu dalam membentuk pengertian dan menemukan inti persoalan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_abstrak" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_abstrak" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_abstrak" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_abstrak" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="penalaran_abstrak" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				<h5 class="pt-15">Pemahaman Verbal</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Sulit memahami suatu arahan dan instruksi serta membutuhkan waktu untuk mengerti penjelasan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mudah memahami dan berpikir dengan menggunakan penguasaan bahasa
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="pemahaman_verbal" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="pemahaman_verbal" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="pemahaman_verbal" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="pemahaman_verbal" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="pemahaman_verbal" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kemampuan Numerik</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Cenderung kesulitan dalam mengerjakan soal hitungan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu menerapkan konsep aritmatik dan berpikir logis menggunakan angka-angka
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_numerik" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_numerik" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_numerik" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_numerik" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_numerik" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				<h5 class="pt-15">Daya Analisis Sintesa</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang mampu berpikir menyeluruh dalam menghadapi persoalan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Kemampuan berpikir menyeluruh, menangkap, dan membentuk sesuatu
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisis_sintesa" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisis_sintesa" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisis_sintesa" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisis_sintesa" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisis_sintesa" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Daya Bayang Ruang</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang mampu berpikir konstruktif teknis dan kurang kritis dalam berpikir
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu berpikir konstruktif teknis, kritis dengan menggunakan komponen ruang
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_bayang_ruang" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_bayang_ruang" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_bayang_ruang" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_bayang_ruang" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_bayang_ruang" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Konsentrasi & Daya Ingat</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ingatan serta konsentrasi kurang tajam dan mudah lupa sehingga sulit untuk menyelesaikan persoalan-persoalan hafalan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Memiliki kemampuan mengingat dan berkonsentrasi yang memadai untuk menyelesaikan persoalan-persoalan hafalan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="konsentrasi_daya_ingat" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="konsentrasi_daya_ingat" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="konsentrasi_daya_ingat" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="konsentrasi_daya_ingat" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="konsentrasi_daya_ingat" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kemampuan Skolastik</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang mampu dalam menyelesaiakn persoalan-persoalan akademik secara umum
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu dalam menyelesaikan persoalan-persoalan akademik secara umum
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_skolastik" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_skolastik" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_skolastik" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_skolastik" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_skolastik" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kematangan Emosi</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Emosional, mudah tersinggung, dan lebih dipengaruhi perasaan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Kemampuan mengendalikan emosi dengan baik dan tidak mudah reaktif terhadap situasi lingkungan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kematangan_emosi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kematangan_emosi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kematangan_emosi" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kematangan_emosi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kematangan_emosi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kemasakan Sosial</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang memperhatikan tuntunan-tuntunan sosial
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Peka atau tanggap terhadap perasaan dan kebutuhan orang lain di lingkungan sosial
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemasakan_sosial" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemasakan_sosial" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemasakan_sosial" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemasakan_sosial" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemasakan_sosial" value="Sangat Tinggi">
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
					Kaku, kurang luwes, membutuhkan waktu lama untuk menyesuaikan diri
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
			            <input type="radio" class="css-control-input" name="kemampuan_adaptasi" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
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
				<h5 class="pt-15">Motivasi Berprestasi</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Mudah puas, kurang memiliki dorongan yang kuat untuk mencapai hasil atau prestasi yang lebih dari sekedarnya
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Memiliki dorongan untuk melakukan pekerjaan secara maksimal serta berusahan untuk mencapai hasil atau prestasi dengan sebaik mungkin
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kecepatan Kerja</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Lambat dalam mengerjakan tugas, kurang cekatan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Cepat dalam mengerjakan tugas dan menyesuaikan diri dengan situasi baru
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Ketelitian</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Ceroboh dan kurang hati-hati dalam mengerjakan tugas
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Cermat dan hati-hati dalam mengerjakan tugas
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Ketekunan atau Keuletan</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang tekun dan mudah bosan dengan rutinitas yang monoton
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Sabar dan tahan dengan tugas rutin serta tidak mudah bosan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan_keuletan" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan_keuletan" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan_keuletan" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan_keuletan" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan_keuletan" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Daya Tahan Terhadap Stres</h5>
				<p><b>Gambaran Individu (Skor Rendah)</b> <br>
					Kurang mampu mengerjakan tugas dibawah tekanan
				</p>

				<p><b>Gambaran Individu (Skor Tinggi)</b> <br> 
					Mampu mengerjakan tugas meskipun dalam situasi yang menekan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stress" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stress" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stress" value="Sedang">
			            <span class="css-control-indicator"></span> Sedang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stress" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_terhadap_stress" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>

			<div class="col-12">
				<h5 class="pt-15">Overal</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="overall" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="overall" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="overall" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="form-group col-md-3 col-sm-12">
			    <label>Judul Minat 1</label>
			    <input type="text" class="form-control" name="judul_minat[]" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Minat 1</label>
			    <input type="text" class="form-control" name="minat[]" >
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="form-group col-md-3 col-sm-12">
			    <label>Judul Minat 2</label>
			    <input type="text" class="form-control" name="judul_minat[]" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Minat 2</label>
			    <input type="text" class="form-control" name="minat[]" >
			</div>

			<div class="form-group col-md-7 col-sm-12">
			    <label>Saran Pemilihan Penjurusan</label>
			    <textarea class="form-control" name="saran_pemilihan_penjurusan" rows="5"> </textarea>
			</div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Deskripsi</label>
			    <textarea class="form-control" name="deskripsi" rows="5"> </textarea>
			</div>
	    </div>
	</div>