<div class="form-group">
	<div class="form-group">
		<label>Pilih Personel</label>
		<select class="form-control js-select2 pegawai" style="width: 100%" name="employee_id" data-s2="employee" required>
			<option value="" selected disabled>Pilih Nama Pegawai</option>
			@foreach($pegawai as $item)
			<option value="{{$item->id}}" data-jabatan="{{$item->jabatan}}" data-umur="{{$item->agejustyear}}" data-gender="{{$item->gender}}">{{$item->name}} - {{$item->nrp}}</option>
			@endforeach
		</select>
	</div>
</div>