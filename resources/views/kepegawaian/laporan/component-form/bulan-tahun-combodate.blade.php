<div class="form-group">                        
	{{Form::label('cetak_date', 'Pilih Bulan dan Tahun')}}
	<input type="text" class="form-control" id="cetakBulananPolos" name="bulan_tahun" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" required placeholder="yyyy-mm" value="{{$current_month}}">
</div>