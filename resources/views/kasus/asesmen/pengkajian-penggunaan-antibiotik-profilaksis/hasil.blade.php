

<div class="col-md-4">
	<h5 class="font-w400"><small>Tanggal Pembedahan</small><br>
		@if(!empty($item->tanggal_pembedahan))
		{{indonesian_date($item->tanggal_pembedahan) ?? "-"}}
		@else
		-
		@endif
	</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Jenis Pembedahan</small><br>
		{{$item->jenis_pembedahan ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Indikasi Pembedahan</small><br>
		{{$item->indikasi_pembedahan ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Jadwal Operasi</small><br>
		{{$item->jadwal_operasi ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Klasifikasi Operasi</small><br>
		{{$item->klasifikasi_operasi ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Waktu Mulai Insisi</small><br>
		{{$item->waktu_mulai_insisi ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Lama Operasi</small><br>
		{{$item->lama_operasi ?? "-"}}</h5>
</div>
<div class="col-12">
	<h4 class="pt-15">PEMBERIAN ANTIBIOTIK PROFILAKSIS</h4>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Obat yang diberikan</small><br>
		{{$item->obat_yang_diberikan ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Dosis</small><br>
		{{$item->dosis ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Rute</small><br>
		{{$item->rute ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Waktu Pemberian Pertama</small><br>
		{{$item->waktu_pemberian_pertama ?? "-"}}</h5>
</div>
<div class="col-md-12">
	<h5 class="font-w400"><small>Pemberian Dosis Tambahan</small><br>
		{{$item->pemberian_dosis_tambahan ?? "-"}}</h5>
</div>
@if($item->pemberian_dosis_tambahan)
<div class="col-md-4">
	<h5 class="font-w400"><small>Indikasi</small><br>
		{{$item->ya_indikasi ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Dosis</small><br>
		{{$item->ya_dosis ?? "-"}}</h5>
</div>
<div class="col-md-4">
	<h5 class="font-w400"><small>Rute</small><br>
		{{$item->ya_rute ?? "-"}}</h5>
</div>
@endif
<div class="col-md-12">
	<h5 class="font-w400"><small>Frekuensi pemberian antibiotik profilaks</small><br>
		{{$item->frekuensi_pemberian_antibiotik_profilaks ?? "-"}}</h5>
</div>
<div class="col-md-12">
	<h5 class="font-w400"><small>Lama Pemberian</small><br>
		{{$item->lama_pemberian ?? "-"}}</h5>
</div>