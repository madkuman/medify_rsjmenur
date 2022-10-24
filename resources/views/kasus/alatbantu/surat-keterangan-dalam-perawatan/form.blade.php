<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>No BPJS</label>
			    <input type="text" class="form-control" name="no_bpjs" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>No SEP</label>
			    <input type="text" class="form-control" name="no_sep" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Surat Rujukan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_surat_rujukan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>No Rujukan</label>
			    <input type="text" class="form-control" name="no_rujukan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Surat Keterangan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_surat_keterangan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>No Antrian</label>
			    <input type="text" class="form-control" name="no_antrian" >
			</div>
			
			<div class="col-md-12"></div>

			<div class="form-group col-md-4 col-sm-12">
			    <label>Terapi</label>
			    <table width="100%" cellpadding="5" id="terapi">
			    	<tr>
			    		<td><input type="text" class="form-control" name="terapi[]" ></td>
			    		<td>
			    			<button type="button" class="btn btn-sm btn-circle btn-outline-danger remove"><i class="fa fa-times"></i></button>	
			    		</td>
			    	</tr>
			    </table>
			    <div class="text-center">
			    	<button type="button" class="btn btn-rounded btn-alt-primary mt-10 addBtn" data-id="terapi"><i class="fa fa-plus"></i> Tambah</button>
			    </div>
			</div>
			<div class="form-group col-md-4 col-sm-12">
			    <label>Alasan belum dapat dikembalikan ke fasilitas perujuk</label>
			    <table width="100%" cellpadding="5" id="alasan">
			    	<tr>
			    		<td><input type="text" class="form-control" name="alasan[]"></td>
			    		<td>
			    			<button type="button" class="btn btn-sm btn-circle btn-outline-danger remove"><i class="fa fa-times"></i></button>
			    		</td>
			    	</tr>
			    </table>
			    <div class="text-center">
			    	<button type="button" class="btn btn-rounded btn-alt-primary mt-10 addBtn" data-id="alasan"><i class="fa fa-plus"></i> Tambah</button>
			    </div>
			</div>
			<div class="form-group col-md-4 col-sm-12">
			    <label>Rencana tindak lanjut yang akan dilakukan selanjutnya</label>
			    <table width="100%" cellpadding="5" id="rencana_kunjungan">
			    	<tr>
			    		<td><input type="text" class="form-control" name="rencana_kunjungan[]" ></td>
			    		<td>
			    			<button type="button" class="btn btn-sm btn-circle btn-outline-danger remove"><i class="fa fa-times"></i></button>
			    		</td>
			    	</tr>
			    </table>
			    <div class="text-center">
			    	<button type="button" class="btn btn-rounded btn-alt-primary mt-10 addBtn" data-id="rencana_kunjungan"><i class="fa fa-plus"></i> Tambah</button>
			    </div>
			</div>	
	    </div>
	</div>