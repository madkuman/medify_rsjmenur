<div class="content pt-0">
	<div class="row">
		@include('kasus.datamedis.content.identitas.components.informasi-umum')
	</div>
	<div class="row">
		@include('kasus.datamedis.content.identitas.components.informasi-pembayaran')
	</div>
	<div class="row">
		@include('kasus.datamedis.content.identitas.components.informasi-kunjungan-ringkas')
	</div>
	<div class="row">
		@if($has_gigi_salah || $has_trauma_bur_gigi)
			@include('kasus.datamedis.content.identitas.components.informasi-khusus')
		@endif
	</div>
	<div class="row">
		@include('kasus.datamedis.content.identitas.components.identitas-medis')
	</div>
	
	<h6 class="pt-10">
		<small class="text-muted">Terakhir di Update Oleh</small><br>
		{{ $identitas->update_user->name ?? '-'}}<br>
		<span> {{ $identitas->updated_at->format('d F Y H:i') }} </span>
		
	</h6>{{--
	<div class="row">
		@include('kasus.datamedis.content.identitas.components.riwayat-pengobatan')
	</div>
	<div class="row">
		@include('kasus.datamedis.content.identitas.components.riwayat-neonatus')
	</div>
	--}}
</div>
