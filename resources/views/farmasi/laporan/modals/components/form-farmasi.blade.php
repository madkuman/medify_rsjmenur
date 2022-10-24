<div class="form-group">
	<label for="penyedia">Farmasi</label>
	<select class="form-control js-select2" id="farmasi_ids" name="farmasi_ids[]" placeholder="Pilih Farmasi" multiple="multiple" style="width: 100%;">
		@foreach($pharmacy as $pharm)
			<option value="{{$pharm->id}}">{{$pharm->nama}}</option>
		@endforeach
	</select>
	<small>Kosongkan untuk melakukan filter semua farmasi</small>
</div>

<label class="css-control css-control-primary css-radio">
	<input type="radio" class="css-control-input" name="farmasi_kriteria" value="inklusi" checked>
	<span class="css-control-indicator"></span> Inklusi
</label>
<label class="css-control css-control-primary css-radio">
	<input type="radio" class="css-control-input" name="farmasi_kriteria" value="eksklusi">
	<span class="css-control-indicator"></span> Eksklusi
</label>