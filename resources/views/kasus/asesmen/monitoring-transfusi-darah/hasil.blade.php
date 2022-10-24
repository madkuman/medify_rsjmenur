

<div class="col-md-3">
	<h5 class="font-w400"><small>Tanggal</small><br>
		{{indonesian_date($item->tanggal) ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jam</small><br>
		{{$item->jam ?? "-"}}</h5>
</div>
<div class="col-12">
	<h3 class="pt-15">Monitoring</h3>
</div>
<div class="col-12">
	<h4 class="pt-15">15 Menit Sebelum Transfusi</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Sebelum Tekanan Darah</small><br>
		{{$item['menit_15_sebelum_td'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Sebelum Nadi</small><br>
		{{$item['menit_15_sebelum_nadi'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Sebelum Transfusi</small><br>
		{{$item['menit_15_sebelum_t'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Sebelum Respiratory Rate</small><br>
		{{$item['menit_15_sebelum_rr'] ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Transfusi</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jam Mulai Transfusi</small><br>
		{{$item->jam_mulai_transfusi ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">Setelah Darah Masuk</h4>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Setelah Tekanan Darah</small><br>
		{{$item['menit_15_setelah_td'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Setelah Nadi</small><br>
		{{$item['menit_15_setelah_nadi'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Setelah Transfusi</small><br>
		{{$item['menit_15_setelah_t'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>15 Menit Setelah Respiratory Rate</small><br>
		{{$item['menit_15_setelah_rr'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>1 Jam Setelah Tekanan Darah</small><br>
		{{$item['jam_1_setelah_td'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>1 Jam Setelah Nadi</small><br>
		{{$item['jam_1_setelah_nadi'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>1 Jam Setelah Transfusi</small><br>
		{{$item['jam_1_setelah_t'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>1 Jam Setelah Respiratory Rate</small><br>
		{{$item['jam_1_setelah_rr'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Reaksi Selama Transfusi</small><br>
		{{$item->reaksi_selama_transfusi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Jam Selesai Transfusi</small><br>
		{{$item->jam_selesai_transfusi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>4 Jam Setelah Tekanan Darah</small><br>
		{{$item['jam_4_setelah_td'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>4 Jam Setelah Nadi</small><br>
		{{$item['jam_4_setelah_nadi'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>4 Jam Setelah Transfusi</small><br>
		{{$item['jam_4_setelah_t'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>4 Jam Setelah Respiratory Rate</small><br>
		{{$item['jam_4_setelah_rr'] ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Reaksi Transfusi</small><br>
		{{$item->reaksi_transfusi ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Golongan Darah</small><br>
		{{$item->golongan_darah ?? "-"}}</h5>
</div>
<div class="col-md-3">
	<h5 class="font-w400"><small>Rhesus</small><br>
		{{$item->rhesus ?? "-"}}</h5>
</div>