<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="col-12">
				<h5 class="pt-15">MRS</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Alasan Masuk</label>
			    <input type="text" class="form-control" name="alasan_masuk" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Diagnosa Masuk</label>
			    <input type="text" class="form-control" name="diagnosa_masuk" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Diagnosa Keperawatan saat MRS</label>
			    <input type="text" class="form-control" name="diagnosa_keperawatan_saat_mrs" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Estimasi Lamanya Perawatan Pasien</label>
			    <input type="text" class="form-control" name="estimasi_lamanya_perawatan_pasien" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">KRS</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keadaan KRS</label>
			    <input type="text" class="form-control" name="keadaan_krs" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Diagnosa Keluar</label>
			    <input type="text" class="form-control" name="diagnosa_keluar" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Diagnosa Keperawatan saat KRS</label>
			    <input type="text" class="form-control" name="diagnosa_keperawatan_saat_krs" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Lama Dirawat</label>
			    <input type="text" class="form-control" name="lama_dirawat" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Pemeriksaan Penunjang</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_penunjang_laboratorium">
			            <span class="css-control-indicator"></span> Laboratorium
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_penunjang_eeg">
			            <span class="css-control-indicator"></span> EEG
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_penunjang_bm">
			            <span class="css-control-indicator"></span> BM
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_penunjang_ekg">
			            <span class="css-control-indicator"></span> EKG
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_penunjang_foto_rontgen">
			            <span class="css-control-indicator"></span> Foto Rontgen
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pemeriksaan_penunjang_lainnya">
			            <span class="css-control-indicator"></span> Lainnya
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Pemeriksaan Penunjang Lain lain</label>
			    <input type="text" class="form-control" name="pemeriksaan_penunjang_lain_lain" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Pasien tinggal dengan</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pasien_tinggal_dengan_suami_istri">
			            <span class="css-control-indicator"></span> Suami istri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pasien_tinggal_dengan_sendiri">
			            <span class="css-control-indicator"></span> Sendiri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pasien_tinggal_dengan_orang_tua">
			            <span class="css-control-indicator"></span> Orang tua
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pasien_tinggal_dengan_anak">
			            <span class="css-control-indicator"></span> Anak
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pasien_tinggal_dengan_keluarga_lain">
			            <span class="css-control-indicator"></span> Keluarga Lain
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="pasien_tinggal_dengan_lainnya">
			            <span class="css-control-indicator"></span> Lainnya
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Pasien tinggal dengan keluarga lain</label>
			    <input type="text" class="form-control" name="pasien_tinggal_dengan_lain_lain" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan lain lain</label>
			    <input type="text" class="form-control" name="keterangan_lain_lain" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Rencana kegiatan pasien saat pulang</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="rencana_kegiatan_pasien_saat_pulang_bekerja">
			            <span class="css-control-indicator"></span> Bekerja
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="rencana_kegiatan_pasien_saat_pulang_sekolah">
			            <span class="css-control-indicator"></span> Sekolah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="rencana_kegiatan_pasien_saat_pulang_lainnya">
			            <span class="css-control-indicator"></span> Lainnya
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan Pekerjaan</label>
			    <input type="text" class="form-control" name="keterangan_pekerjaan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan Jenjang Pendidikan</label>
			    <input type="text" class="form-control" name="keterangan_jenjang_pendidikan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan Kegiatan Lain</label>
			    <input type="text" class="form-control" name="keterangan_kegiatan_lain" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Perlu bantuan dalam hal</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="perlu_bantuan_dalam_hal_minum_obat">
			            <span class="css-control-indicator"></span> Minum Obat
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="perlu_bantuan_dalam_hal_mandi">
			            <span class="css-control-indicator"></span> Mandi
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="perlu_bantuan_dalam_hal_makan">
			            <span class="css-control-indicator"></span> Makan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="perlu_bantuan_dalam_hal_berhias">
			            <span class="css-control-indicator"></span> Berhias
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="perlu_bantuan_dalam_hal_toiletting">
			            <span class="css-control-indicator"></span> Toiletting
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Alat Medis yang digunakan saat keluar RS</h5>
			</div>
			<div class="col-md-2">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="alat_medis_yang_digunakan_saat_keluar_rs" value="Tidak Ada">
			            <span class="css-control-indicator"></span> Tidak Ada
			        </label>
			    </div>
			</div>
			<div class="col-md-2">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="alat_medis_yang_digunakan_saat_keluar_rs" value="Ada">
			            <span class="css-control-indicator"></span> Ada
			        </label>
			    </div>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan alat medis yang digunakan</label>
			    <input type="text" class="form-control" name="keterangan_alat_medis_yang_digunakan" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Alat Bantu yang digunakan saat keluar RS</h5>
			</div>
			<div class="col-md-2">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="alat_bantu_yang_digunakan_saat_keluar_rs" value="Tidak Ada">
			            <span class="css-control-indicator"></span> Tidak Ada
			        </label>
			    </div>
			</div>
			<div class="col-md-2">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="alat_bantu_yang_digunakan_saat_keluar_rs" value="Ada">
			            <span class="css-control-indicator"></span> Ada
			        </label>
			    </div>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan alat bantu yang digunakan</label>
			    <input type="text" class="form-control" name="keterangan_alat_bantu_yang_digunakan" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Resiko Jatuh dan Nyeri</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Skor Resiko Jatuh  saat KRS</label>
			    <input type="text" class="form-control" name="skor_resiko_jatuh__saat_krs" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Skor Resiko Nyeri Saat KRS</label>
			    <input type="text" class="form-control" name="skor_resiko_nyeri_saat_krs" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Diet Khusus</h5>
			</div>
			<div class="col-md-2">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="diet_khusus" value="Tidak Ada">
			            <span class="css-control-indicator"></span> Tidak Ada
			        </label>
			    </div>
			</div>
			<div class="col-md-2">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="diet_khusus" value="Ada">
			            <span class="css-control-indicator"></span> Ada
			        </label>
			    </div>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Keterangan Diet Khusus</label>
			    <input type="text" class="form-control" name="keterangan_diet_khusus" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Nasehat Tenaga Medis</h5>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nasehat</label>
			    <input type="text" class="form-control" name="nasehat" >
			</div>
	    </div>
	</div>