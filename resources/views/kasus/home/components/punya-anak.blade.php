@if(count($kasus->anak) > 0)
<div class="row">
	<div class="col-12 bg-success">
		<div class="py-10 px-50">
			<span class="mb-0 text-white font-w600">Pasien ini memiliki anak</span>
			<?php $i=1; ?>
			@foreach($kasus->anak as $item)
			<a class="btn btn-alt-primary btn-sm ml-10" href="{{url('kasus/')}}/{{$item->nomor_kasus}}">Anak #{{$i}}</a>
			<?php $i++; ?>
			@endforeach
		</div>
	</div>
</div>
@endif