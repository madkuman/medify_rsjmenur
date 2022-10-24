<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Alergi</label>
			    <input type="text" class="form-control" name="alergi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Risiko</label>
			    <input type="text" class="form-control" name="risiko" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pengkajian</label>
			    <input type="text" class="form-control datepicker" name="tanggal_pengkajian" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam Pengkajian</label>
			    <input type="text" class="form-control time" name="jam_pengkajian" autocomplete="off">
			</div>
			<div class="col-12">
				<h5 class="pt-15">Riwayat Pemakaian Napza</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="riwayat_pemakaian_napza" value="Tidak Ada">
			            <span class="css-control-indicator"></span> Tidak Ada
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="riwayat_pemakaian_napza" value="Ada">
			            <span class="css-control-indicator"></span> Ada
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			
			<div class="form-group col-md-12 col-sm-12">
			    <table class="table" width="100%" id="tabel_jenis">
			    	<thead>
				    	<tr>
				    		<th>Jenis Napza yang dipakai</th>
				    		<th>Sejak</th>
				    		<th>Sampai dengan</th>
				    		<th>Cara Pakai</th>
				    		<th>Aksi</th>
				    	</tr>
			    	</thead>
			    	<tbody>
				    	<tr>
				    		<td><input type="text" class="form-control" name="jenis_napza_yang_dipakai[]"></td>
				    		<td>
				    			<input type="text" class="form-control js-datepicker" name="tanggal_sejak[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy" autocomplete="off">
				    		</td>
				    		<td>
				    			<input type="text" class="form-control js-datepicker" name="tanggal_sampai_dengan[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy" autocomplete="off">
				    		</td>
				    		<td><input type="text" class="form-control" name="cara_pakai[]"></td>
				    		<td>
				    			<button type="button" class="btn btn-rounded btn-alt-danger min-width-125 remove"><i class="fa fa-times"></i> Hapus</button>
				    		</td>
				    	</tr>
			    	</tbody>
			    </table>

			    <div class="text-center">
			    	<button type="button" class="btn btn-rounded btn-alt-primary min-width-125" id="addJenis"><i class="fa fa-plus"></i> Tambah</button>
			    </div>
			</div>


			<div class="col-12">
				<h5 class="pt-15">Etiologi penggunaan zat</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="etiologi_penggunaan_zat_diajak_teman">
			            <span class="css-control-indicator"></span> Diajak teman
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="etiologi_penggunaan_zat_dipaksa_teman">
			            <span class="css-control-indicator"></span> Dipaksa teman
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="etiologi_penggunaan_zat_coba_coba_keinginan_sendiri">
			            <span class="css-control-indicator"></span> Coba-coba keinginan sendiri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="etiologi_penggunaan_zat_pelarian_dari_masalah">
			            <span class="css-control-indicator"></span> Pelarian dari masalah
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Komplikasi medik/jiwa</label>
			    <input type="text" class="form-control" name="komplikasi_medik_jiwa" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Perilaku kriminal di dalam rumah sendiri</label>
			    <input type="text" class="form-control" name="perilaku_kriminal_di_dalam_rumah_sendiri" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Perilaku kriminal di luar rumah</label>
			    <input type="text" class="form-control" name="perilaku_kriminal_di_luar_rumah" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Problem sekolah/keluarga/pekerjaan/masyarakat</label>
			    <input type="text" class="form-control" name="problem_masyarakat" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Riwayat perawatan di rumah sakit terkait napza</label>
			    <input type="text" class="form-control datepicker" name="riwayat_perawatan_di_rumah_sakit_terkait_napza" autocomplete="off">
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Riwayat rehabilitasi napza sebelumnya</label>
			    <input type="text" class="form-control datepicker" name="riwayat_rehabilitasi_napza_sebelumnya" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tempat rehabilitasi</label>
			    <input type="text" class="form-control" name="tempat_rehabilitasi" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Riwayat relaps dengan/tanpa rehabilitasi napza</label>
			    <input type="text" class="form-control datepicker" name="riwayat_relaps_dengan_tanpa_rehabilitasi_napza" autocomplete="off">
			</div>
			<div class="col-12">
				<h5 class="pt-15">Faktor penyebab relaps (bisa lebih dari satu faktor)</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_diajak_teman">
			            <span class="css-control-indicator"></span> Diajak teman
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_dipaksa_teman">
			            <span class="css-control-indicator"></span> Dipaksa teman
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_tidak_memiliki_aktivitas_berarti">
			            <span class="css-control-indicator"></span> Tidak memiliki aktivitas berarti
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_dendam_setelah_masa_pemulihan">
			            <span class="css-control-indicator"></span> Dendam setelah masa pemulihan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_konflik_dengan_orang_tua">
			            <span class="css-control-indicator"></span> Konflik dengan orang tua
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_bergabung_dengan_pengguna_zat">
			            <span class="css-control-indicator"></span> Bergabung dengan pengguna zat
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_tidak_mampu_menahan_suggest">
			            <span class="css-control-indicator"></span> Tidak mampu menahan suggest
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="faktor_penyebab_relaps_keinginan_untuk_menggunakan">
			            <span class="css-control-indicator"></span> Keinginan untuk menggunakan
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Riwayat seks bebas</label>
			    <input type="text" class="form-control datepicker" name="riwayat_seks_bebas">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Anggota keluarga yang menggunakan napza</label>
			    <input type="text" class="form-control" name="anggota_keluarga_yang_menggunakan_napza" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal selesai pengkajian</label>
			    <input type="text" class="form-control datepicker" name="tanggal_selesai_pengkajian">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam selesai pengkajian</label>
			    <input type="text" class="form-control time" name="jam_selesai_pengkajian" autocomplete="off">
			</div>
	    </div>
	</div>