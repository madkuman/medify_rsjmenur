<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Teks</label>
			    <input type="text" class="form-control" name="teks" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Angka</label>
			    <input type="number" class="form-control" name="angka" autocomplete="off">
			</div>
    		<div class="col-12 full-only"></div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Text Area</label>
			    <textarea class="form-control" name="text_area" rows="5"> </textarea>
			</div>
			<div class="col-12 full-only"></div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Waktu</label>
			    <input type="text" class="form-control time" name="waktu" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Select</label>
	            <select name="select" class="form-control form-control-lg js-select2" id="select" data-placeholder="Pilih Select" style="width: 100%;">
	                <option value="">Silahkan Pilih</option>
					<option value="Select 1">Select 1</option>
					<option value="Select 2">Select 2</option>
    			</select>
			</div>
			<div class="col-12">
				<h5 class="pt-15">Radio</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="radio" value="Radio 1">
			            <span class="css-control-indicator"></span> Radio 1
			        </label>
			    </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-radio">
			            <input type="radio" class="css-control-input" name="radio" value="Radio 2">
			            <span class="css-control-indicator"></span> Radio 2
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
			<div class="col-12">
				<h5 class="pt-15">Checkbox</h5>
			</div>
			<div class="col-md-3">
			    <div class="form-group mb-5">
			        <label class="css-control css-control-primary css-checkbox">
			            <input type="checkbox" value="1" class="css-control-input" name="checkbox_checkbox_1">
			            <span class="css-control-indicator"></span> Checkbox 1
			        </label>
			    </div>
			</div>
			<div class="col-12">
				&nbsp;
			</div>
	    </div>
	</div>