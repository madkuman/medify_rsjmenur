<ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary">
	<li class="nav-item">
		<a class="nav-link 
		@if(empty($active_nav) || $active_nav == 'pengobatan')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/pengobatan-pasien">Pengobatan Pasien</a>
	</li>
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'rekonsiliasi')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/rekonsiliasi">Rekonsiliasi Obat</a>
	</li>
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'konseling-obat')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/konseling-obat">Konseling Obat</a>
	</li>
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'formulir-pelayanan-obat')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/formulir-pelayanan-obat">Formulir Pelayanan Obat</a>
	</li>
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'screening-pemantauan-terapi-obat-pasien')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/screening-pemantauan-terapi-obat-pasien">Pemantauan Terapi Obat</a>
	</li>
	<li class="nav-item" >
		<a class="nav-link
		@if ($active_nav == 'formulir-pasien-pemantauan-terapi-obat')
		active
		@endif
		" href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/farmasi/formulir-pasien-pemantauan-terapi-obat">Formulir Pasien Terapi Obat</a>
	</li>
</ul>