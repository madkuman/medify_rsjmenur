@if($allow_konfirmasi_kirim)
<form action="{{url()->current()}}/setuju-pengiriman" method="POST">
	<div class="full-only">
		{{csrf_field()}}
		<button type="button" class="btn btn-outline-danger btn-hero mr-5" onclick="toggleTolakPengiriman()">Tolak</button>
		<button class="btn btn-primary btn-hero">Setuju</button>
	</div>
	<div class="mobile-block">
		{{csrf_field()}}
		<button type="button" class="btn btn-outline-danger btn-hero mr-5 mb-5 width-100" onclick="toggleTolakPengiriman()">Tolak</button>
		<button class="btn btn-primary btn-hero width-100">Setuju</button>
	</div>
</form>


<div class="text-left row justify-content-center mt-20" style="display: none" id="formTolakPengiriman">
	<div class="col-md-6">
		<form action="{{url()->current()}}/tolak-pengiriman" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<label>Mengapa Anda Menolak Permintaan Ini? Jelaskan</label>
				<textarea class="form-control" name="keterangan_sender"></textarea>
			</div>
			<div class="form-group">
				<button class="btn btn-primary pull-right">Submit</button>
				<button type="button" class="btn btn-outline-danger pull-right mr-5"  onclick="toggleTolakPengiriman()">Batalkan</button>
			</div>
		</form>
	</div>
</div>
@endif