<div class="form-group">
	<label for="penyedia">Asuransi</label>
	<select class="form-control js-select2" id="filter_asuransi_tipe_id" name="asuransi_ids[]"  multiple="multiple" style="width: 100%;">
		@foreach($asuransi_tipe as $item)
			<option value="{{$item->id}}">{{$item->nama}}</option>
		@endforeach
	</select>
	<small>Kosongkan untuk melakukan filter semua asuransi</small>
</div>