<div class="col-12 text-center mt-20 mb-10">
	@php
		$url = '/uploads/kepegawaian/profile/';
		$path = public_path('/uploads/kepegawaian/profile/');
	@endphp
	@if (file_exists($path.$pegawai->photo.".png"))
		<img src="{{ URL::to($url.$pegawai->photo.".png") }}" class="img-avatar img-avatar-thumb" style="width: 150px; height: 150px; object-fit: cover">
	@elseif (file_exists($path.$pegawai->photo.".jpg"))
		<img src="{{ URL::to($url.$pegawai->photo.".jpg") }}" class="img-avatar img-avatar-thumb" style="width: 150px; height: 150px; object-fit: cover">
	@elseif (file_exists($path.$pegawai->photo.".jpeg"))
		<img src="{{ URL::to($url.$pegawai->photo.".jpeg") }}" class="img-avatar img-avatar-thumb" style="width: 150px; height: 150px; object-fit: cover">
	@else
		<img src="{{ URL::asset('assets/img/avatars/avatar9.jpg') }}" class="img-avatar img-avatar96 img-avatar-thumb">
	@endif
  <h5 class="mb-5 mt-5">{{$pegawai->name}}</h5>
  <p class="text-muted">NRP: {{$pegawai->nrp}}</p>
</div>