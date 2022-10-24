<?php 
	// $hasil = str_replace('qwertyuiop', 'aaa', $resume->resume);
	$hasil = nl2br($resume->resume ?? '');
	// dd($hasil);
 ?>
<div style="font-size: 15px;">
	<div class="text-center" style="font-size: 16px;">
		5
	</div>
	<b><u>PSIKIATRI</u></b>
	<br>
	<span style="white-space: pre-line;">{!!$resume->jiwa ?? ''!!}</span>
	<br>
	<br>

	<b><u>RESUME</u></b>
	@if(!empty($resume))
	<br>
	<div style="width: 85%">
		<span style="white-space: normal; font-size: 13px;">{!!$hasil!!}</span>	
	</div>
	@else
	<br>
	-
	@endif
	<br><br>

	<div align="center" style="text-align: center; width: 100%;">
		<b><u>STATUS KESEHATAN</u></b>
		<table width="86%" class="table-border"  style="text-align: center; margin-right: 10px; margin-top: 5px;">
			<tr>
				<th>U</th>
				<th>A</th>
				<th>B</th>
				<th>D</th>
				<th>L</th>
				<th>G</th>
				<th>J</th>
				<th>STAKES</th>
			</tr>
			<tr>
				<td style="font-size: 17px;">{{$resume->u}}</td>
				<td style="font-size: 17px;">{{$resume->a}}</td>
				<td style="font-size: 17px;">{{$resume->b}}</td>
				<td style="font-size: 17px;">{{$resume->d}}</td>
				<td style="font-size: 17px;">{{$resume->l}}</td>
				<td style="font-size: 17px;">{{$resume->g}}</td>
				<td style="font-size: 17px;">{{$resume->j}}</td>
				<td style="font-size: 17px;">{{$resume->stakes}}</td>
			</tr>
		</table>
		<br>
		<b><u>DOKTER PEMERIKSA</u></b>
		<br><br><br><br><br>
		{{$dokter->nama}}<br>
		<p style="margin:0;white-space: pre;text-align: center">{{$dokter->keterangan}}
		</p>
	</div>
</div>