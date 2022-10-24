<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Hari</label>
			    <input type="text" class="form-control" name="hari" >
			</div>	
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Pukul</label>
			    <input type="text" class="form-control time" name="pukul" autocomplete="off">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Dokter yang memeriksa</label>
	            <select name="dokter_yang_memeriksa" class="form-control form-control-lg js-select2" id="dokter_yang_memeriksa" data-placeholder="Pilih Dokter yang memeriksa" style="width: 100%;">
	                <option value="">Silahkan Pilih</option>
					@foreach($dokter as $dokters)
					<option value="{{$dokters->name}}">{{$dokters->name}}</option>
					@endforeach
    			</select>
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Persangkaan kematian</label>
			    <input type="text" class="form-control" name="persangkaan_kematian" >
			</div>
	    </div>
	</div>