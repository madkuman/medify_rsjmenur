@if(!empty($item->creator->avatar_thumb))
<div class="float-left mr-10">
	<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
</div>
@else
<div class="float-left mr-10">
	<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
</div>
@endif
<div class="creator">
	<h6 class="pt-10 mb-5">
		<small class="text-muted">Dibuat Oleh</small><br>
		{{$item->creator->name}}<br>
		{{date('d F y, H:i', strtotime($item->created_at))}}
	</h6>
</div>