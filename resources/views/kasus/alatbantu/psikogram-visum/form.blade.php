<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    		
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Pemeriksaan</label>
			    <input type="text" class="form-control" name="tujuan_pemeriksaan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujukan dari</label>
			    <input type="text" class="form-control" name="rujukan_dari" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Intelegensi Umum</h5>
				<p>
					Kemampuan untuk memahami dan mengkaji persoalan  /  permasalahan  untuk direspon sesuai tuntutan yang ada
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi_umum" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi_umum" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi_umum" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi_umum" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi_umum" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="intelegensi_umum" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Daya Nalar</h5>
				<p>
					Kemampuan berpikir logis dengan mengarahkan pikiran dan perhatian pada suatu persoalan serta dapat membedakan hal-hal penting dan tidak penting
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_nalar" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_nalar" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_nalar" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_nalar" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_nalar" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_nalar" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Daya Analisa Sintesa</h5>
				<p>
					Kemampuan menguraikan persoalan dan menangkap aspek-aspek terkait dengan memahami esensi persoalan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa_sintesa" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa_sintesa" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa_sintesa" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa_sintesa" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa_sintesa" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_analisa_sintesa" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Fleksibilitas Berpikir</h5>
				<p>
					Kemampuan untuk dapat menemukan berbagai alternatif pemecahan masalah dengan cepat, lancar, disertai kelincahan berpikir, agar bisa mencari jalan keluar yang efektif jika mendapat hambatan
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
				<h5 class="pt-15">Kemampuan Berkomunikasi</h5>
				<p>
					Kemampuan untuk menangkap dan mengekspresikan gagasan, kemauan, perasaan dalam bentuk bahasa dalam konteks ketepatan, kecermatan pengertian dan kesepakatan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_berkomunikasi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_berkomunikasi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_berkomunikasi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_berkomunikasi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_berkomunikasi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_berkomunikasi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kemampuan Pengambilan Keputusan</h5>
				<p>
					Kemampuan yang bernilai baik ditetapkan berdasarkan pertimbangan matang yang secara relatif telah memperhitungkan semua aspek untuk menelaah masalah yang harus dipecahkan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_pengambilan_keputusan" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_pengambilan_keputusan" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_pengambilan_keputusan" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_pengambilan_keputusan" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_pengambilan_keputusan" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kemampuan_pengambilan_keputusan" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kreativitas</h5>
				<p>
					Kemampuan melakukan perubahan ke arah perbaikan dan pembaruan disertai kemampuan menciptakan sesuatu yang original
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kreativitas" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kreativitas" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kreativitas" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kreativitas" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kreativitas" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="kreativitas" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Potensi Kerja</h5>
				<p>
					Sumber daya kerja yang teraktualisasikan dengan mengerahkan segenap daya dan upaya mencapai target kerja yang diinginkan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="potensi_kerja" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="potensi_kerja" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="potensi_kerja" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="potensi_kerja" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="potensi_kerja" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="potensi_kerja" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Perencanaan Kerja</h5>
				<p>
					Kemampuan menyusun langkah kerja dan menentukan prioritas penanganan untuk mencapai sasaran kerja
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="perencanaan_kerja" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="perencanaan_kerja" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="perencanaan_kerja" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="perencanaan_kerja" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="perencanaan_kerja" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="perencanaan_kerja" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Daya Tahan Kerja</h5>
				<p>
					Kemampuan mempertahankan situasi "menekan" tanpa mempengaruhi prestasi kerja
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
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
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="daya_tahan_kerja" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Inisiatif</h5>
				<p>
					Suatu tindakan aktif dalam merespon persoalan dan mengantisipasi kemungkinan
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
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
			            <input type="radio" class="css-control-input" name="inisiatif" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="inisiatif" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Motivasi, Dorongan & Ambisi</h5>
				<p>
					Dorongan atau keinginan untuk selalu mencapai prestasi yang terbaik, siap menghadapi tantangan serta mau belajar dan berusaha
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_dorongan_ambisi" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_dorongan_ambisi" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_dorongan_ambisi" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_dorongan_ambisi" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_dorongan_ambisi" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="motivasi_dorongan_ambisi" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Komitmen Pada Tugas</h5>
				<p>
					Kesiapan menjalankan tugas dengan melibatkan diri dalam penyelesaian keseluruhan proses kerja
				</p>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="komitmen_pada_tugas" value="Sangat Rendah">
			            <span class="css-control-indicator"></span> Sangat Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="komitmen_pada_tugas" value="Rendah">
			            <span class="css-control-indicator"></span> Rendah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="komitmen_pada_tugas" value="Hampir Cukup">
			            <span class="css-control-indicator"></span> Hampir Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="komitmen_pada_tugas" value="Cukup">
			            <span class="css-control-indicator"></span> Cukup
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="komitmen_pada_tugas" value="Tinggi">
			            <span class="css-control-indicator"></span> Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="komitmen_pada_tugas" value="Sangat Tinggi">
			            <span class="css-control-indicator"></span> Sangat Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Stabilitas Emosi</h5>
				<p>
					Suatu keadaan kematangan emosi dimana individu mampu mengendalikan perasaan-perasaannya serta tidak mudah reaktif ataupun panik dalam menghadapi tekanan
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
				<p>
					Kemampuan untuk menjalin hubungan kerja/sosialisasi dalam sebuah tim
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
				<p>
					Kemampuan akan kepedulian dan mengenali kebutuhan dan perasaan orang lain serta menindaklanjuti respon yang ada
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
	    </div>
	</div>