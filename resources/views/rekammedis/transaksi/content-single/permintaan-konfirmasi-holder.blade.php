@if($transaksi->status != -1)
<small>Telah Dikirim oleh</small><br><strong>
{{$transaksi->sender->name}}<br>
{{date('d F Y, H:i', strtotime($transaksi->sender_confirmed_at))}}

</strong>
<br><br>
@if($allow_konfirmasi_terima)
<form action="{{url()->current()}}/konfirmasi-penerimaan" method="POST">
    {{csrf_field()}}
    <button class="btn btn-primary btn-hero full-only">Konfirmasi Penerimaan</button>
    <button class="btn btn-primary mobile-block">Konfirmasi Penerimaan</button>
</form>
<br>
<a href="javascript:void(0)" onclick="toggleTolakPenerimaan()">Saya tidak menerima file ini</a>

<div class="text-left row justify-content-center mt-20" style="display: none" id="formTolakPenerimaan">
	<div class="col-md-6">
		<form action="{{url()->current()}}/tolak-penerimaan" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<label>Bagaimana Anda Tidak Menerima File Ini? Jelaskan</label>
				<textarea class="form-control" name="keterangan_holder"></textarea>
			</div>
			<div class="form-group">
				<button class="btn btn-primary pull-right">Submit</button>
				<button type="button" class="btn btn-outline-danger pull-right mr-5"  onclick="toggleTolakPengiriman()">Batalkan</button>
			</div>
		</form>
	</div>
</div>


@endif
@else
	<small class="text-danger">Pengiriman Ditolak oleh</small><br><strong class="text-danger">
	{{$transaksi->sender->name}}<br>
	{{date('d F Y, H:i', strtotime($transaksi->sender_confirmed_at))}}
	</strong>
	<br>
	@if(!empty($transaksi->sender_keterangan))
	{{$transaksi->sender_keterangan}}
	@endif
@endif