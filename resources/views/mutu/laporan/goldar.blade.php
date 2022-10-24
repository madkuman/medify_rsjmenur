<?php $acc = count($result); ?>
<table>
	<tr>
		<td colspan="7">LAPORAN KECEPATAN PELAYANAN LAB PK</td>
	</tr>
	<tr>
		<td colspan="5">Pemeriksaan : Golongan Darah</td>
		<td colspan="2"> {{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Tanggal</b></td>
		<td><b>No RM</b></td>
		<td><b>Nama</b></td>
		<td><b>Lokasi</b></td>
		<td><b>Hasil Input</b></td>
		<td><b>Hasil Sistem</b></td>
	</tr>
	@foreach($result as $i => $r)
		<?php
		$hasil = json_decode($r->hasil_golongan_darah->lis_result);
		foreach($hasil as $h){
			if($h->test_name == "Golongan Darah + Rhesus")
			{
				$goldar = $h->result;
				break;
			}
		}
		if($goldar != $r->gol_darah)
			$acc--;
		?>
		<tr>
			<td>{{$i+1}}</td>
			<td>{{$r->created_at->format('d/M/Y')}}</td>
			<td>{{$r->pasien->no_rm}}</td>
			<td>{{$r->pasien->name ?? '-'}}</td>
			<td>{{$r->asal->nama ?? '-'}}</td>
			<td>{{$r->gol_darah}}</td>
			<td>{{$goldar}}</td>
		</tr>
	@endforeach
	<tr></tr>
	<tr></tr>
	<tr>
		<td colspan="3">Kecepatan Pelayanan</td>
		<td>{{$acc}} / {{count($result)}}</td>
		@if($acc == 0 && count($result) == 0)
			<td colspan="3">100 %</td>
		@else
			<td colspan="3">{{round((($acc/count($result))*100),2)}} %</td>
		@endif
	</tr>
</table>