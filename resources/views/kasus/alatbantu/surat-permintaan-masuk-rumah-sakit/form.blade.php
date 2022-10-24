<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Ruang</label>
			    <input type="text" class="form-control" name="ruang" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Kelas</label>
			    <input type="text" class="form-control" name="kelas" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Terapi yang diberikan</label>
			    <input type="text" class="form-control" name="terapi_yang_diberikan" >
			</div>
	    </div>
	</div>