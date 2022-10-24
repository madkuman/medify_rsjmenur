
<div class="content pt-0">
	<div class="block-content tab-content overflow-hidden px-50 pb-30">
		<h5 class="font-w600">Daftar Layanan Yang Dipesan</h5>
		
		@php $current_paket = -1 @endphp
		@foreach($layanan as $item)
		@if($current_paket != $item->paket_id)
		@if(!$loop->first)
	</ol>
	@endif

	@if($loop->first && empty($item->paket->nama))
	<h6 class="mb-5 mt-20 text-uppercase">TANPA PAKET</h6>
	@else
	<h6 class="mb-5 mt-20 text-uppercase">{{$item->paket->nama}}</h6>
	@endif

	@php $current_paket = $item->paket_id @endphp


	<ol>
		@endif
		<li>{{$item->tarif->deskripsi}}</li>

		@if($loop->last)
	</ol>
	@endif

	@endforeach
</ol>
</div>
</div>