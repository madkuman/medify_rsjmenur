<ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary">
	<li class="nav-item">
		<a class="nav-link 
		@if(empty($active_nav) || $active_nav == 'tagihan')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/tagihan">Tagihan</a>
	</li>

	@if($kasus->kelas_id!=14)
	@php $pembayaran = $kasus->pembayaran @endphp

	@if(!empty($pembayaran))
	@if($pembayaran->perusahaan->tipe->slug == 'tunai')
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'histori')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/histori-bayar">Histori Pembayaran & DP</a>
	</li>

	@elseif($pembayaran->perusahaan->tipe->slug == 'bpjs')
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'bpjs')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/bpjs">BPJS</a>
	</li>
	@endif
	@endif
	@endif
</ul>