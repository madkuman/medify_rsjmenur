<input type="hidden" name="id" value="" id="id">
	<div class="block-content" style="padding-left: 25px; padding-right: 25px;">
	    {{csrf_field()}}
	    <div class="row">
	    	
    		<div class="form-group col-md-3 col-sm-12">
			    <label>Tanggal Pemeriksaan</label>
			    <input type="text" class="form-control js-datepicker" name="tanggal_pemeriksaan" data-week-start="1" data-autoclose="true" data-today-highlight="true" autocomplete="off" data-date-format="dd/mm/yyyy">
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Tujuan Pemeriksaan</label>
			    <input type="text" class="form-control" name="tujuan_pemeriksaan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
			    <label>Rujukan</label>
			    <input type="text" class="form-control" name="rujukan" >
			</div>
			<div class="form-group col-md-3 col-sm-12">
				<label>Dokter Pemeriksa</label>
				<select name="dokter_pemeriksa" class="form-control js-select2" style="width: 100%;" id="dokter" required>  
					<option value="" selected disabled>Pilih Dokter Pemeriksa</option>
					@foreach($dokter as $item)
					<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-7 col-sm-12">
			    <label>Hasil</label>
			    <textarea class="form-control" name="hasil" rows="5"> </textarea>
			</div>
	    </div>
	</div>