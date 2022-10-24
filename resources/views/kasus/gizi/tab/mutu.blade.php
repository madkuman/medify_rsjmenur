<div class="row">
	<div class="col-lg-12 mb-20">
		<h4>Mutu Gizi</h4>
	</div>

	<div class="col-md-12">
		<form action="{{url('kasus/'.$nomor_kasus.'/datamedis/gizi/sisa-diet')}}" method="POST">
			{{csrf_field()}}
			<div class="block-content block-header-default">
				<div class="form-group row mx-0 mb-20">
					<label class="col-12 px-0">Diet</label>
					<select class="form-control col-5" name="diet" required="">
						<option value="" disabled="" hidden="" selected="">Pilih Diet</option>
						<option value="Sesuai" @if($kasus->gizi_diet == 'Sesuai') selected @endif >Sesuai</option>
						<option value="Tidak Sesuai" @if($kasus->gizi_diet == 'Tidak Sesuai') selected @endif >Tidak Sesuai</option>
					</select>
				</div>
				<div class="form-group row mx-0 mb-20">
					<label class="col-12 px-0">Makanan Tersisa</label>
					<select class="form-control col-5" name="sisa" required="">
						<option value="" disabled="" hidden="" selected="">Makanan Tersisa</option>
						<option value="Banyak" @if($kasus->gizi_sisa == 'Banyak') selected @endif>Banyak</option>
						<option value="Sedikit" @if($kasus->gizi_sisa == 'Sedikit') selected @endif>Sedikit</option>
						<option value="Tidak Tersisa" @if($kasus->gizi_sisa == 'Tidak Tersisa') selected @endif >Tidak Tersisa</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary btn-square">
					<i class="fa fa-paper-plane"></i> Simpan
				</button>
			</div>
		</form>
	</div>
</div>