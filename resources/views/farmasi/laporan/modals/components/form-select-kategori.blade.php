<div class="form-group">
	<label for="penyedia">Kategori Barang</label>
	<select class="form-control js-select2" id="kategori" name="kategori[]" placeholder="Pilih Kategori" multiple="multiple" style="width: 100%;">
		@foreach($kategori as $gori)
		<option value="{{$gori->id}}">{{$gori->nama}}</option>
		@endforeach
	</select>
	<small>Kosongkan untuk melakukan filter semua kategori</small>
</div>