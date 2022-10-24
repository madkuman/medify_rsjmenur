
<div class="page_num">
	<p>8</p>
</div>
<b><u>KESIMPULAN</u></b>:<br>
{!!nl2br($resume->resume ?? '')!!}
<br><br>
<b><u>SARAN</u></b>:<br>
{!!nl2br($resume->saran ?? '')!!}
<br><br>
<div style="position: relative;">
	<div style="width: 60%; text-align: center; position: absolute; right: 0px; ">
		Surabaya, {{$waktu_print}}<br>Dokter Pemeriksa
		<br><br><br>
		{{$dokter->nama}}<br>
		<span style="white-space: pre">{{$dokter->keterangan}}</span>
	</div>
</div>