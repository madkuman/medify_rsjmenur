<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
			<div class="form-group col-md-12 col-sm-12">
			    <label>Tanggal Kontrol</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_kontrol" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-12 col-sm-12">
			    <label>Obat yang diminum</label>
			    <textarea class="form-control" name="obat_yang_diminum" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-12 col-sm-12">
			    <label>Obat yang tidak diminum</label>
			    <textarea class="form-control" name="obat_yang_tidak_diminum" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-12 col-sm-12">
			    <label>Keterangan Lain lain</label>
			    <textarea class="form-control" name="keterangan_lain_lain" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-12 col-sm-12">
			    <label>Saran</label>
			    <textarea class="form-control" name="saran" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>