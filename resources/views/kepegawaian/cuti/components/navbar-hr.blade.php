
@php
$cekPrefix = explode('/', request()->path())[2] ?? '';
@endphp
<div class="col-12  my-20">
	<ul class="nav nav-tabs-alt">
		<li class="nav-item">
			<a class="nav-link @if($cekPrefix == 'pengajuan' || $cekPrefix == '') active @endif" href="{{url('/kepegawaian/cuti/pengajuan')}}">Pengajuan</a>
		</li>
		<li class="nav-item">
			<a class="nav-link @if($cekPrefix == 'kuota') active @endif" href="{{url('/kepegawaian/cuti/kuota')}}">Kuota</a>
		</li>
	</ul>
</div>