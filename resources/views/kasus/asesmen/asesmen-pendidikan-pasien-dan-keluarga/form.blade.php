<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="col-12">
				<h4 class="pt-15">Pasien</h4>
			</div>
			<div class="col-12">
				<h5 class="pt-15">Agama Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Islam">
			            <span class="css-control-indicator"></span> Islam
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Budha">
			            <span class="css-control-indicator"></span> Budha
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Katolik">
			            <span class="css-control-indicator"></span> Katolik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Hindu">
			            <span class="css-control-indicator"></span> Hindu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Protestan">
			            <span class="css-control-indicator"></span> Protestan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Konghuchu">
			            <span class="css-control-indicator"></span> Konghuchu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_pasien" value="Lain lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Keyakinan Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_pasien_pantangan_pemeriksaan_hari_tertentu">
			            <span class="css-control-indicator"></span> Pantangan pemeriksaan hari tertentu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_pasien_pantangan_masuk_keluar_rs_hari_tertentu">
			            <span class="css-control-indicator"></span> Pantangan masuk keluar RS hari tertentu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_pasien_hanya_ingin_dilayani_sesama_jenis">
			            <span class="css-control-indicator"></span> Hanya ingin dilayani sesama jenis
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_pasien_pantangan_nomor_tertentu_yang_dihindari">
			            <span class="css-control-indicator"></span> Pantangan nomor tertentu yang dihindari
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan untuk nilai dan keyakinan pasien</label>
			    <input type="text" class="form-control" name="keterangan_untuk_nilai_dan_keyakinan_pasien" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Pendidikan Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_pasien_sd">
			            <span class="css-control-indicator"></span> SD
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_pasien_smp">
			            <span class="css-control-indicator"></span> SMP
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_pasien_sma">
			            <span class="css-control-indicator"></span> SMA
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_pasien_perguruan_tinggi">
			            <span class="css-control-indicator"></span> Perguruan Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_pasien_tidak_sekolah">
			            <span class="css-control-indicator"></span> Tidak Sekolah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_pasien_lain_lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Bahasa yang digunakan pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="bahasa_yang_digunakan_pasien_indonesia">
			            <span class="css-control-indicator"></span> Indonesia
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="bahasa_yang_digunakan_pasien_isyarat">
			            <span class="css-control-indicator"></span> Isyarat
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="bahasa_yang_digunakan_pasien_lain_lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Keterbatasan Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_tuli">
			            <span class="css-control-indicator"></span> Tuli
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_bisu">
			            <span class="css-control-indicator"></span> Bisu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_kooperatif">
			            <span class="css-control-indicator"></span> Kooperatif
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_perlu_kursi_roda">
			            <span class="css-control-indicator"></span> Perlu kursi roda
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_hidup_dalam_pikirannya_sendiri">
			            <span class="css-control-indicator"></span> Hidup dalam pikirannya sendiri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_tidak_ada_keterbatasan_fisik">
			            <span class="css-control-indicator"></span> Tidak ada keterbatasan fisik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_tampak_mutualisme_atau_negativistic">
			            <span class="css-control-indicator"></span> Tampak mutualisme atau negativistic
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_pasien_mampu_berdiskusi">
			            <span class="css-control-indicator"></span> Mampu berdiskusi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Emosi Motivasi Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_pasien_tenang">
			            <span class="css-control-indicator"></span> Tenang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_pasien_labil">
			            <span class="css-control-indicator"></span> Labil
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_pasien_tampak_acuh">
			            <span class="css-control-indicator"></span> Tampak acuh
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_pasien_belum_mampu_diajak_komunikasi">
			            <span class="css-control-indicator"></span> Belum mampu diajak komunikasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_pasien_tampak_agresif">
			            <span class="css-control-indicator"></span> Tampak agresif
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_pasien_mampu_komunikasi">
			            <span class="css-control-indicator"></span> Mampu komunikasi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kesediaan Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_pasien_bersedia_diberi_informasi">
			            <span class="css-control-indicator"></span> Bersedia diberi informasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_pasien_mampu_menerima_informasi">
			            <span class="css-control-indicator"></span> Mampu menerima informasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_pasien_belum_mampu_menerima_informasi">
			            <span class="css-control-indicator"></span> Belum mampu menerima informasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_pasien_tidak_bersedia_diberi_informasi">
			            <span class="css-control-indicator"></span> Tidak bersedia diberi informasi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h4 class="pt-15">Keluarga Pasien</h4>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Hubungan dengan pasien</label>
			    <input type="text" class="form-control" name="hubungan_dengan_pasien" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Agama Keluarga Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Islam">
			            <span class="css-control-indicator"></span> Islam
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Budha">
			            <span class="css-control-indicator"></span> Budha
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Katolik">
			            <span class="css-control-indicator"></span> Katolik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Hindu">
			            <span class="css-control-indicator"></span> Hindu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Protestan">
			            <span class="css-control-indicator"></span> Protestan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Konghuchu">
			            <span class="css-control-indicator"></span> Konghuchu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="agama_keluarga_pasien" value="Lain lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Keyakinan Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_keluarga_pantangan_pemeriksaan_hari_tertentu">
			            <span class="css-control-indicator"></span> Pantangan pemeriksaan hari tertentu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_keluarga_pantangan_masuk_keluar_rs_hari_tertentu">
			            <span class="css-control-indicator"></span> Pantangan masuk keluar RS hari tertentu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_keluarga_hanya_ingin_dilayani_sesama_jenis">
			            <span class="css-control-indicator"></span> Hanya ingin dilayani sesama jenis
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keyakinan_keluarga_pantangan_nomor_tertentu_yang_dihindari">
			            <span class="css-control-indicator"></span> Pantangan nomor tertentu yang dihindari
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan untuk nilai dan keyakinan keluarga</label>
			    <input type="text" class="form-control" name="keterangan_untuk_nilai_dan_keyakinan_keluarga" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Pendidikan Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_keluarga_sd">
			            <span class="css-control-indicator"></span> SD
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_keluarga_smp">
			            <span class="css-control-indicator"></span> SMP
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_keluarga_sma">
			            <span class="css-control-indicator"></span> SMA
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_keluarga_perguruan_tinggi">
			            <span class="css-control-indicator"></span> Perguruan Tinggi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_keluarga_tidak_sekolah">
			            <span class="css-control-indicator"></span> Tidak Sekolah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pendidikan_keluarga_lain_lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Bahasa Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="bahasa_keluarga_indonesia">
			            <span class="css-control-indicator"></span> Indonesia
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="bahasa_keluarga_isyarat">
			            <span class="css-control-indicator"></span> Isyarat
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="bahasa_keluarga_lain_lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Keterbatasan Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_tuli">
			            <span class="css-control-indicator"></span> Tuli
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_bisu">
			            <span class="css-control-indicator"></span> Bisu
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_kooperatif">
			            <span class="css-control-indicator"></span> Kooperatif
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_perlu_kursi_roda">
			            <span class="css-control-indicator"></span> Perlu kursi roda
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_tidak_ada_keterbatasan_fisik">
			            <span class="css-control-indicator"></span> Tidak ada keterbatasan fisik
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_mampu_berdiskusi">
			            <span class="css-control-indicator"></span> Mampu berdiskusi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="keterbatasan_keluarga_lain_lain">
			            <span class="css-control-indicator"></span> Lain lain
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Emosi Motivasi Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_keluarga_tenang">
			            <span class="css-control-indicator"></span> Tenang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_keluarga_labil">
			            <span class="css-control-indicator"></span> Labil
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_keluarga_tampak_acuh">
			            <span class="css-control-indicator"></span> Tampak acuh
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_keluarga_belum_mampu_diajak_komunikasi">
			            <span class="css-control-indicator"></span> Belum mampu diajak komunikasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="emosi_motivasi_keluarga_mampu_komunikasi">
			            <span class="css-control-indicator"></span> Mampu komunikasi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kesediaan Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_keluarga_bersedia_diberi_informasi">
			            <span class="css-control-indicator"></span> Bersedia diberi informasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_keluarga_mampu_menerima_informasi">
			            <span class="css-control-indicator"></span> Mampu menerima informasi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kesediaan_keluarga_tidak_bersedia_diberi_informasi">
			            <span class="css-control-indicator"></span> Tidak bersedia diberi informasi
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h4 class="pt-15">Kebutuhan Edukasi</h4>
			</div>
			<div class="col-12">
				<h5 class="pt-15">Edukasi Pasien</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="edukasi_pasien_penyakit_yang_diderita">
			            <span class="css-control-indicator"></span> Penyakit yang diderita
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="edukasi_pasien_teknik_rehabilitasi_terapi_kerja_latihan_asertif">
			            <span class="css-control-indicator"></span> Teknik rehabilitasi terapi kerja latihan asertif
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="edukasi_pasien_tindakan_keperawatan_fiksasi_tak_dll">
			            <span class="css-control-indicator"></span> Tindakan keperawatan fiksasi TAK dll
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="edukasi_pasien_tindakan_medis_ect_konvensional_dll">
			            <span class="css-control-indicator"></span> Tindakan medis ECT konvensional dll
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="edukasi_pasien_pemeriksaan_penunjang_lab_rontgen_dll">
			            <span class="css-control-indicator"></span> Pemeriksaan penunjang lab rontgen dll
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Masalah Keperawatan</label>
			    <input type="text" class="form-control" name="masalah_keperawatan" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rencana edukasi pasien tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="rencana_edukasi_pasien_tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kebutuhan Edukasi Keluarga</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kebutuhan_edukasi_keluarga_obat_yang_dikonsumsi">
			            <span class="css-control-indicator"></span> Obat yang dikonsumsi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kebutuhan_edukasi_keluarga_managemen_nyeri">
			            <span class="css-control-indicator"></span> Managemen nyeri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kebutuhan_edukasi_keluarga_diet_dan_nutrisi">
			            <span class="css-control-indicator"></span> Diet dan nutrisi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kebutuhan_edukasi_keluarga_cuci_tangan">
			            <span class="css-control-indicator"></span> Cuci tangan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kebutuhan_edukasi_keluarga_inform_consent">
			            <span class="css-control-indicator"></span> Inform consent
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kebutuhan_edukasi_keluarga_general_consent">
			            <span class="css-control-indicator"></span> General consent
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rencana edukasi keluarga tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="rencana_edukasi_keluarga_tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
	    </div>
	</div>