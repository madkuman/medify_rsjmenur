<div class="form-group box-alert">
	<label>Pilih Jenis Pegawai</label><label class="text-alert" style="color: red; display: none">&nbsp;&nbsp;&nbsp;(Kolom ini harus diisi)</label>
	<div class="form-group">
		<div class="input-group" required>
			@foreach ($jenis_pegawai as $row)
			<div class="mb-5 form-check">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="status-pegawai-checkbox css-control-input" id="{{$row->nama}}" name="status[]" value={{$row->nama}}>
					<span class="css-control-indicator"></span> {{$row->nama}}
				</label>
			</div>
			@endforeach
			{{-- <div class="mb-5 form-check">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="status-pegawai-checkbox css-control-input" id="pns" name="status[]" value="PNS">
					<span class="css-control-indicator"></span> PNS
				</label>
			</div>
			<div class="mb-5 form-check">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="status-pegawai-checkbox css-control-input" id="phl" name="status[]" value="PHL">
					<span class="css-control-indicator"></span> PHL
				</label>
			</div>
			<div class="mb-5 form-check">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" class="status-pegawai-checkbox css-control-input" id="militer" name="status[]" value="MILITER">
					<span class="css-control-indicator"></span> MILITER
				</label>
			</div> --}}
		</div>
	</div>
</div>