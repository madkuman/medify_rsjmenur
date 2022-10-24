@if(!empty($kasus->ibu))
<div class="row">
	<div class="col-12 bg-primary">
		<div class="py-10 px-50">
			<span class="mb-0 text-white font-w600">Bayi ini adalah anak dari Pasien sebagai berikut</span>
			<a href="{{url('kasus/')}}/{{$kasus->ibu->nomor_kasus}}" class="btn btn-alt-primary btn-sm ml-10">&nbsp;&nbsp;&nbsp;&nbsp;Ibu&nbsp;&nbsp;&nbsp;&nbsp;</a>
		</div>
	</div>
</div>
@endif