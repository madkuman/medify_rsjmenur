<div class="form-group">
	<div class="form-group">
		<label>Pilih Tanda Tangan</label>
		<select class="form-control js-select2" style="width: 100%" name="ttd_id">
			@foreach($tanda_tangan as $item)
			<option value="{{$item->id}}">{{$item->alias}}</option>
			@endforeach
		</select>
	</div>
</div>