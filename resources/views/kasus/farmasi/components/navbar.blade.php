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
</ul>