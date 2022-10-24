<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>

	<p class="title">RADIOLOGI</p>
	<hr>
	<table style="width: 100%; font-size: 13px;">
		<thead>
			<tr>
				<td class="small-col" >Nama</td>
				<td class="big-col" >: {{$row['transaksi']->pasien->name}}</td>\
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="small-col" >Umur/TTL</td>
				<td class="big-col" >: {{$row['transaksi']->pasien->age}} Tahun / {{$row['transaksi']->pasien->place_of_birth}}, {{date('d F Y', strtotime($row['transaksi']->pasien->date_of_birth))}}</td>
				<td class="small-col" >Register</td>
				<td class="med-col" >: {{$row['transaksi']->pasien->no_rm}} </td>          
			</tr>
			<tr>
				<td class="small-col" >Alamat</td>
				<td class="big-col" >: {{$row['transaksi']->pasien->address}}</td>
				<td class="small-col" >Rumah Sakit</td>
				<td class="med-col" >: {{is_null($row['transaksi']->nama_rs) ? config('app.name') : $row['transaksi']->nama_rs}}</td>
			</tr>
			<tr>
				<td class="small-col" >Pangkat</td>
				<td class="big-col" >: {{($row['transaksi']->pasien->tni_pangkat_id != 0) ? $row['transaksi']->pasien->tni_pangkat->nama : '-'}}</td>
				<td class="small-col" >Poli/ Ruang</td>
				<td class="med-col" >: {{ $row['transaksi']->asal['nama'] }}</td>
			</tr>
			<tr>
				<td class="small-col" >Rol / Kesatuan</td>
				<td class="big-col" >: {{($row['transaksi']->pasien->tni_kotama_id != 0) ? $row['transaksi']->pasien->tni_kotama->nama : '-'}} /
					{{($row['transaksi']->pasien->tni_satker_id != 0) ? $row['transaksi']->pasien->tni_satker->nama : '-'}} 
				</td>
				<td class="small-col" >Tanggal Terima</td>
				<td class="med-col" >: {{date('d F Y', strtotime($row['transaksi']->created_at))}}</td>
			</tr>
			<tr>
				<td class="small-col" >Dokter</td>
				<td class="big-col" >: {{$dpjp->user->name ?? '-'}}</td>
				<td class="small-col" >Tanggal Selesai</td>
				<td class="med-col" >: {{date('d F Y', strtotime($row['transaksi']->result_created_at))}}</td>
			</tr>
		</tbody>
	</table>
	<hr>
		<?php $no=1; ?>
		<?php if($d['jumlah']<18) $jumlah_halaman=1; else $jumlah_halaman=ceil((($d['jumlah']-17)/34)+1); ?>
		<?php if($d['jumlah']<18) $sisa=$d['jumlah']%17; else $sisa=($d['jumlah']-17)%34; ?>
		<?php if($d['jumlah']<18) $kosongan=(17-$sisa)%17; else $kosongan=(34-$sisa)%34; ?>

		<?php for($i=0;$i<$jumlah_halaman;$i++) { ?>
			<?php if($i>0) { ?> <div style="page-break-after: always;"></div>  <?php } ?>
			<table style="width: 100%">
				<thead style="border-top: 1px solid black; border-bottom: 1px solid black ">
					<tr>
						<th>Parameter</th>
						<th>Result</th>
						<th>Unit</th>
						<th>Ref. Ranges</th>
					</tr>
				</thead>
				<tbody>
					<?php if($i==0) { ?>
						<tr>
							<td colspan="4"><b>Hasil {{$hasil->created_at->format('d F Y h:i')}}</b></td>
						</tr>
					<?php } ?>
					<?php $current_head = null; ?>
					@foreach($d['result'][$i] as $rr)
					@if(!is_null($rr->group_test) && $rr->group_test != $current_head)    <?php $current_head = $rr->group_test; ?>
					<tr><th colspan="5">{{$rr->group_test}}</th></tr>
					@endif
					<tr>
						<td>{{$rr->test_name}}</td>
						<td>{{$rr->result}}</td>
						<td>{{$rr->unit}}</td>
						<td>{{$rr->nilai_normal}}</td>
					</tr>
					@endforeach
					<?php if($i+1==$jumlah_halaman) { ?>
						<?php for($j=0;$j<$kosongan;$j++) { ?>
							<tr>
								<td style="color: white">A</td>
								<td style="color: white">A</td>
								<td style="color: white">A</td>
								<td style="color: white">A</td>
								<td style="color: white">A</td>
								<td style="color: white">A</td>
							</tr>
						<?php }} ?>
					</tbody>
				</table>
				<hr>
				<div style="text-align: center;"> Print at {{date('Y-m-d h:i:s a', time())}}</div>
			<?php } ?>
<table style="width: 100%">
	<tr>
		<td style="width: 65%">Kesimpulan :</td>
		<td style="width: 35%"></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">Verificator :</td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align: center;">Dr. Arief Sukma Hariyanto, Sp.PK</td>
	</tr>
</table>