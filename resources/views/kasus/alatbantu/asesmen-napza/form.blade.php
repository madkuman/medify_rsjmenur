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
			    <input type="text" class="form-control js-datepicker" name="tanggal_pengkajian" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam Pengkajian</label>
			    <input type="text" class="form-control time" name="jam_pengkajian" >
			</div>
			
			<div class="form-group col-md-12 col-sm-12">
			    <table class="table" width="100%" id="tabel_jenis">
			    	<thead>
				    	<tr>
				    		<th>Jenis zat yang dipakai</th>
				    		<th>Sejak</th>
				    		<th>Sampai dengan</th>
				    		<th>Aksi</th>
				    	</tr>
			    	</thead>
			    	<tbody>
				    	<tr>
				    		<td><input type="text" class="form-control" name="jenis_zat_yang_dipakai[]"></td>
				    		<td>
				    			<input type="text" class="form-control js-datepicker" name="tanggal_sejak[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
				    		</td>
				    		<td>
				    			<input type="text" class="form-control js-datepicker" name="tanggal_sampai_dengan[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
				    		</td>
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
				<h5 class="pt-15">Alasan penggunaan zat</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="alasan_penggunaan_zat_diajak_teman">
			            <span class="css-control-indicator"></span> Diajak teman
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="alasan_penggunaan_zat_dipaksa_teman">
			            <span class="css-control-indicator"></span> Dipaksa teman
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="alasan_penggunaan_zat_coba_coba_keinginan_sendiri">
			            <span class="css-control-indicator"></span> Coba-coba keinginan sendiri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="alasan_penggunaan_zat_pelarian_dari_masalah">
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
			<div class="col-12">
				<h5 class="pt-15">Kriminal dirumah</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_tidak_ada_masalah">
			            <span class="css-control-indicator"></span> Tidak ada Masalah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_mencuri">
			            <span class="css-control-indicator"></span> Mencuri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_mengancam">
			            <span class="css-control-indicator"></span> Mengancam
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_menggadai">
			            <span class="css-control-indicator"></span> Menggadai
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_mengambil_barang_dengan_paksaan">
			            <span class="css-control-indicator"></span> Mengambil barang dengan paksaan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_menjual_barang_sendiri">
			            <span class="css-control-indicator"></span> Menjual barang sendiri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_mengambil_barang">
			            <span class="css-control-indicator"></span> Mengambil barang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_dirumah_merusak">
			            <span class="css-control-indicator"></span> Merusak
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Kriminal diluar rumah</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_tidak_ada_masalah">
			            <span class="css-control-indicator"></span> Tidak ada masalah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_mencuri">
			            <span class="css-control-indicator"></span> Mencuri
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_merampas_barang">
			            <span class="css-control-indicator"></span> Merampas barang
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_membunuh">
			            <span class="css-control-indicator"></span> Membunuh
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_merampok">
			            <span class="css-control-indicator"></span> Merampok
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_mengancam">
			            <span class="css-control-indicator"></span> Mengancam
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="kriminal_diluar_rumah_merusak">
			            <span class="css-control-indicator"></span> Merusak
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Catatan polisi</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="catatan_polisi_tidak_ada">
			            <span class="css-control-indicator"></span> Tidak Ada
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="catatan_polisi_ditahan_diproses_pengadilan">
			            <span class="css-control-indicator"></span> Ditahan diproses pengadilan
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="catatan_polisi_ditahan_kemudian_langsung_dipulangkan">
			            <span class="css-control-indicator"></span> Ditahan kemudian langsung dipulangkan
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Lain-lain</label>
			    <input type="text" class="form-control" name="lain_lain_catatan_polisi" >
			</div>
			<div class="col-12">
				<h5 class="pt-15">Problem sekolah</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="problem_sekolah_tidak_ada_masalah">
			            <span class="css-control-indicator"></span> Tidak ada masalah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="problem_sekolah_tidak_naik_kelas">
			            <span class="css-control-indicator"></span> Tidak naik kelas
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="problem_sekolah_berhenti_sekolah">
			            <span class="css-control-indicator"></span> Berhenti sekolah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="problem_sekolah_susah_konsentrasi_belajar">
			            <span class="css-control-indicator"></span> Susah konsentrasi belajar
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="problem_sekolah_dikeluarkan_dari_sekolah">
			            <span class="css-control-indicator"></span> Dikeluarkan dari sekolah
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="problem_sekolah_tidak_disiplin">
			            <span class="css-control-indicator"></span> Tidak Disiplin
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
	    </div>
	</div>