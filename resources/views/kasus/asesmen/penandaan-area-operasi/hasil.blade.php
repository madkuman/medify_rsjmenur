

<div class="col-md-4">
	<h5 class="font-w400"><small>Tanggal Operasi</small><br>
		{{indonesian_date($item->tanggal_operasi) ?? "-"}}
	</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400 text-uppercase"><small>Jenis Operasi</small><br>
		{{$item->jenis_operasi ?? "-"}}
	</h5>
</div>
<div class="col-md-12">
	<a href="{{url()->current()}}/view/{{$item->id}}" class="btn btn-secondary">Lihat Gambar</a>
</div>