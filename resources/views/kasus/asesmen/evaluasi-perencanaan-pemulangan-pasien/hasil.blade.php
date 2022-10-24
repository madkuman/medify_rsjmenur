

<div class="col-md-3">
	<h5 class="font-w400"><small>Tanggal</small><br>
	@if(!empty($item->tanggal))
		{{indonesian_date($item->tanggal) ?? "-"}}
	@else
	-
	@endif
	</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jam</small><br>
		{{$item->jam ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Implementasi P3</small><br>
		{{$item->implementasi_p3 ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Evaluasi</small><br>
		{{$item->evaluasi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Materi</small><br>
		{{$item->materi ?? "-"}}</h5>
</div>