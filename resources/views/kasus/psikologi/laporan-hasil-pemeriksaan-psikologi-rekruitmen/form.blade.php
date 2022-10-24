<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Posisi yang dituju</label>
			    <input type="text" class="form-control" name="posisi_yang_dituju" >
			</div>

	    	<div class="col-12">
				<h5 class="pt-15">Intelegensi</h5>
				<p>
					Tingkat kecerdasan umum
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Daya Tangkap</h5>
				<p>
					Kemampuan dalam memahami informasi yang diberikan atau permasalahan yang ada disekitarnya
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tangkap" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tangkap" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tangkap" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tangkap" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tangkap" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tangkap" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>
			
			<div class="col-12">
				<h5 class="pt-15">Daya Analisa</h5>
				<p>
					Kemampuan dalam memahami menguraikan permasalahan, melakukan analisa dan membuat suatu kesimpulan atas suatu masalah
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Daya Konsentrasi</h5>
				<p>
					Kemampuan mengarahkan dan memusatkan perhatian pada satu hal tanpa mudah teralihkan oleh hal lainnya
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_konsentrasi" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_konsentrasi" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_konsentrasi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_konsentrasi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_konsentrasi" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_konsentrasi" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Bekerja Dengan Angka</h5>
				<p>
					Kemampuan untuk menganalisa dan memecahkan masalah dengan hitungan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="bekerja_dengan_angka" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="bekerja_dengan_angka" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="bekerja_dengan_angka" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="bekerja_dengan_angka" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="bekerja_dengan_angka" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="bekerja_dengan_angka" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Sistematika Kerja</h5>
				<p>
					Membuat perencanaan dalam bekerja, sehingga kinerja yang dimiliki menjadi lebih efektif dan efisien
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistimatika_kerja" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistimatika_kerja" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistimatika_kerja" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistimatika_kerja" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistimatika_kerja" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="sistimatika_kerja" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Ketelitian Kerja</h5>
				<p>
					Kecermatan dalam mengerjakan tugas-tugas yang berhubungan dengan pengamatan visual - motorik
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian_kerja" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian_kerja" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian_kerja" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian_kerja" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian_kerja" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketelitian_kerja" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kecepatan Kerja</h5>
				<p>
					Kecekatan atau ketanggapan dalam menghadapi tugas-tugas yang bersifat visual - motorik
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kecepatan_kerja" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Ketekunan Kerja</h5>
				<p>
					Ketekunan/keuletan menghadapi tugas rutin dan monoton serta kemampuan menyelesaikan tugas hingga selesai
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="ketekunan" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Daya Tahan Kerja</h5>
				<p>
					Kemampuan untuk mempertahankan hasil kerja yang optimal dalam situasi yang kompleks dan penuh tekanan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Inisiatif</h5>
				<p>
					Keinginan untuk memulai tugas secara mandiri tanpa arahan atau perintah orang lain
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Motivasi Berprestasi</h5>
				<p>
					Kemampuan untuk menunjukkan dan meningkatkan prestasi serta upaya untuk mencapai hasil kerja yang optimal
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_berprestasi" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Percaya Diri</h5>
				<p>
					Keyakinan atas kemampuan yang dimiliki dalam berinteraksi sosial serta yakin pada keputusannya
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="percaya_diri" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="percaya_diri" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="percaya_diri" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="percaya_diri" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="percaya_diri" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="percaya_diri" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Menyesuaikan Diri</h5>
				<p>
					Kemampuan untuk menyesuaikan diri dengan lingkungan dan situasi yang berbeda
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="menyesuaikan_diri" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="menyesuaikan_diri" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="menyesuaikan_diri" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="menyesuaikan_diri" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="menyesuaikan_diri" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="menyesuaikan_diri" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Stabilitas Emosi</h5>
				<p>
					Mampu mengendalikan perasaan dan dorongan dalam diri, bereaksi tenang atas situasi dan masalah yang dihadapi
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
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
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="stabilitas_emosi" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kerjasama</h5>
				<p>
					Kesediaan untuk aktif berpartisipasi dalam berkelompok
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Kurang Sekali">
			            <span class="css-control-indicator"></span> Kurang Sekali
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Kurang">
			            <span class="css-control-indicator"></span> Kurang
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
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Baik">
			            <span class="css-control-indicator"></span> Baik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kerja_sama" value="Baik Sekali">
			            <span class="css-control-indicator"></span> Baik Sekali
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>

			<div class="col-12">
				<h5 class="pt-15">Kesimpulan</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kesimpulan" value="Disarankan">
			            <span class="css-control-indicator"></span> Disarankan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kesimpulan" value="Dipertimbangkan">
			            <span class="css-control-indicator"></span> Dipertimbangkan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kesimpulan" value="Tidak Disarankan">
			            <span class="css-control-indicator"></span> Tidak Disarankan
			        </label>
			    </div>
			</div>

			<div class="col-12">
				&nbsp;
			</div>
    		
			<div class="col-md-7 col-sm-12">
				<div class="form-group mb-5">
				    <label>Uraian Psikologis</label>
				    <textarea class="form-control" name="uraian_psikologis" rows="5"> </textarea>
				</div>
			</div>
			
			<div class="col-md-7 col-sm-12">
				<div class="form-group mb-5">
				    <label>Kelebihan</label>
				    <textarea class="form-control" name="kelebihan" rows="5"> </textarea>
				</div>
			</div>

			<div class="col-md-7 col-sm-12">
				<div class="form-group mb-5">
				    <label>Kelemahan</label>
				    <textarea class="form-control" name="kelemahan" rows="5"> </textarea>
				</div>
			</div>

			<div class="col-md-7 col-sm-12">
				<div class="form-group mb-5">
				    <label>Saran</label>
				    <textarea class="form-control" name="saran" rows="5"> </textarea>
				</div>
			</div>
	    </div>
	</div>