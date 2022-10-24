<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Pemeriksaan</label>
			    <input type="text" class="form-control" name="tujuan_pemeriksaan" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujukan Dari</label>
			    <input type="text" class="form-control" name="rujukan_dari" >
			</div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Hasil</label>
			    <textarea class="form-control" name="hasil" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>