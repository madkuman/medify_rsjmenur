<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
    		<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal pengkajian</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pengkajian" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam pengkajian</label>
			    <input type="text" class="form-control time" name="jam_pengkajian" autocomplete="off">
			</div>	

			<div class="form-group col-md-7 col-sm-12">
			    <label>Riwayat pemakaian zat</label>
			    <textarea class="form-control" name="riwayat_pemakaian_zat" rows="5"> </textarea>
			</div>
			
			<div class="form-group col-md-12 col-sm-12">
			    <table class="table" width="100%" id="tabel_jenis">
			    	<thead>
				    	<tr>
				    		<th>Jenis zat yang dipakai</th>
				    		<th>Sejak</th>
				    		<th>Sampai dengan</th>
				    		<th>Hapus</th>
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
			            <span class="css-control-indicator"></span> Coba coba keinginan sendiri
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
			    <label>Komplikasi medik jiwa</label>
			    <input type="text" class="form-control" name="komplikasi_medik_jiwa" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Perilaku kriminal didalam rumah</label>
			    <input type="text" class="form-control" name="perilaku_kriminal_didalam_rumah" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Perilaku kriminal diluar rumah</label>
			    <input type="text" class="form-control" name="perilaku_kriminal_diluar_rumah" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Problem masyarakat</label>
			    <input type="text" class="form-control" name="problem_masyarakat" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Riwayat perawatan dirumah sakit</label>
			    <input type="text" class="form-control" name="riwayat_perawatan_dirumah_sakit" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Riwayat rehabilitasi napza</label>
			    <input type="text" class="form-control" name="riwayat_rehabilitasi_napza" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal selesai pengkajian</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_selesai_pengkajian" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam selesai pengkajian</label>
			    <input type="text" class="form-control time" name="jam_selesai_pengkajian" autocomplete="off">
			</div>
	    </div>
	</div>