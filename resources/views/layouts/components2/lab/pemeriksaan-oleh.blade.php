<div class="col-12">
	<div class="row">
		<div class="col-sm-12 col-lg-3">
			<div class="float-left mr-10 mt-10">
				<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{asset($transaksi->result_creator['avatar_thumb'])}}" alt="">
			</div>
			<h6 class="pt-10">
				<small class="text-muted">Pemeriksaan Oleh</small><br>
				{{$transaksi->result_creator['name']}}<br>
				<small class="text-muted"> {{date('d F y, H:i', strtotime($transaksi->result_created_at))}} </small>
			</h6>
		</div>
		@if(!is_null($transaksi->verified_at))
		<div class="col-sm-12 col-lg-3">
			<div class="float-left mr-10 mt-10">
				<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{asset($transaksi->verificator['avatar_thumb'])}}" alt="">
			</div>
			<h6 class="pt-10">
				<small class="text-muted">Verifikasi Oleh</small><br>
				{{$transaksi->verificator->name}}<br>
				<small class="text-muted"> {{date('d F y, H:i', strtotime($transaksi->verified_at))}} </small>
			</h6>
		</div>
		@endif
	</div>
</div>