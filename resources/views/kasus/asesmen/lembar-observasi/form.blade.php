<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Jam</label>
			    <input type="text" class="form-control time" name="jam" autocomplete="off">
			</div>
			<div class="col-12">
				<h4 class="pt-15">Observasi TTV</h4>
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tensi</label>
			    <input type="text" class="form-control" name="tensi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Nadi</label>
			    <input type="text" class="form-control" name="nadi" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Suhu</label>
			    <input type="text" class="form-control" name="suhu" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>RR</label>
			    <input type="text" class="form-control" name="rr" >
			</div>
			<div class="col-12">
				<h4 class="pt-15">Cairan Masuk</h4>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Infus</label>
			    <input type="number" class="form-control" name="infus" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Per OS</label>
			    <input type="number" class="form-control" name="per_os" autocomplete="off">
			</div>
			<div class="col-12">
				<h4 class="pt-15">Cairan Keluar</h4>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Urine</label>
			    <input type="number" class="form-control" name="urine" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Cairan lain lain</label>
			    <input type="number" class="form-control" name="cairan_lain_lain" autocomplete="off">
			</div>
			<div class="col-12">
				<h4 class="pt-15">Perencanaan Tindakan</h4>
			</div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Rencana Tindakan</label>
			    <textarea class="form-control" name="rencana_tindakan" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>
	    </div>
	</div>