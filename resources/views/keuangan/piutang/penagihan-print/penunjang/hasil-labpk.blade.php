<head>
	<title>Hasil Pemeriksaan Laboratorium Klinik</title>
</head>
<style type="text/css">
.small-col {
	width: 100px;
}
.big-col {
	width: 300px;
}
.med-col {
	width: 150px;
}
</style>
<body>
	@php $page=1; @endphp
	<?php /*
	@foreach($result as $row)
	@if ($page>1)
	<div style="page-break-after: always;"></div>
	@endif
	@php $page++ @endphp
	<img src="{{asset('assets/img/rumkital.png')}}" style="float: left; width: 10%; display: inline;">
	<h3 style="text-align: center;"><br/>{{config('app.name')}}</h3>
	<p style="text-align: center;">Satukan Tekad Berikan Layanan "TERBAIK"<br/>(Terpercaya, Efisien, Ramah, Berkualitas, Akurat, Inovatif, dan Komunikatif)</p>
	<hr>
	<h3 style="text-align: center">HASIL PEMERIKSAAN LABORATORIUM KLINIK</h3>
	<table>
		<thead>
			<tr>
				<td class="small-col" >Pasien</td>
				<td class="big-col" >: {{$row->transaksi->pasien->name}}</td>
				<td class="small-col" >No. Ref</td>
				<td class="med-col" >: {{$row->transaksi->id}}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="small-col" >No. RM</td>
				<td class="big-col" >: {{$row->transaksi->pasien->no_rm}}</td>
				<td class="small-col" >Status</td>
				<td class="med-col" >: ({{$row->transaksi->pembayaran->perusahaan->tipe['nama']}}) {{$row->transaksi->pembayaran->perusahaan->nama}}</td>
			</tr>
			<tr>
				<td class="small-col" >Tgl. Lahir</td>
				<td class="big-col" >: {{date('d/m/Y', strtotime($row->transaksi->pasien->date_of_birth))}}</td>
				<td class="small-col" >Asal</td>
				<td class="med-col" >: {{$row->transaksi->asal['nama']}}</td>
			</tr>
			<tr>
				<td class="small-col" >Usia</td>
				<td class="big-col" >: {{$row->transaksi->pasien->age}} Tahun</td>
				<td class="small-col" >Tgl. Order</td>
				<td class="med-col" >: {{$row->transaksi->created_at->format('d/m/Y h:i')}}</td>
			</tr>
			<tr>
				<td class="small-col" >Jns. Kelamin</td>
				<td class="big-col" >: {{$row->transaksi->pasien->jenis_kelamin}}</td>
				<td class="small-col" >Catatan</td>
				<td class="med-col" >: </td>
			</tr>
			<tr>
				<td class="small-col" >Dokter</td>
				<td class="big-col" >: {{$row->transaksi->kasus->dpjp_detail->name ?? '-'}}</td>
			</tr>
			<tr>
				<td class="small-col" >Diagnosa</td>
				<td class="big-col" >: {{$row->transaksi->kasus->diagnosisUtama->icd10->long_desc ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<br>
	@if(isset($row->result))
		<?php $no=1; ?>
		<?php if($row->hasil['jumlah']<18) $jumlah_halaman=1; else $jumlah_halaman=ceil((($row->hasil['jumlah']-17)/34)+1); ?>
		<?php if($row->hasil['jumlah']<18) $sisa=$row->hasil['jumlah']%17; else $sisa=($row->hasil['jumlah']-17)%34; ?>
		<?php if($row->hasil['jumlah']<18) $kosongan=(17-$sisa)%17; else $kosongan=(34-$sisa)%34; ?>

		<?php for($i=0;$i<$jumlah_halaman;$i++) { ?>
			<?php if($i>0) { ?> <div style="page-break-after: always;"></div>  <?php } ?>
			<table style="width: 100vw">
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
					@foreach($row->hasil['result'][$i] as $rr)
					@if(!is_null($rr->group_test) && $rr->group_test != $current_head)    <?php $current_head = $rr->group_test; ?>
					<tr><th colspan="5">{{$row->group_test}}</th></tr>
					@endif
					<tr>
						<td>{{$row->test_name}}</td>
						<td>{{$row->result}}</td>
						<td>{{$row->unit}}</td>
						<td>{{$row->nilai_normal}}</td>
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
		@endif


		<table style="width: 100vw">
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
	@endforeach */?>

	@foreach($lis_result as $row)
	@if ($page>1)
	<div style="page-break-after: always;"></div>
	@endif
	@php $page++ @endphp
	<img src="{{asset('assets/img/rumkital.png')}}" style="float: left; width: 10%; display: inline;">
	<h3 style="text-align: center;"><br/>{{config('app.name')}}</h3>
	<p style="text-align: center;">Satukan Tekad Berikan Layanan "TERBAIK"<br/>(Terpercaya, Efisien, Ramah, Berkualitas, Akurat, Inovatif, dan Komunikatif)</p>
	<hr>
	<h3 style="text-align: center">HASIL PEMERIKSAAN LABORATORIUM KLINIK</h3>
	<table>
		<thead>
			<tr>
				<td class="small-col" >Pasien</td>
				<td class="big-col" >: {{$row->transaksi->pasien->name}}</td>
				<td class="small-col" >No. Ref</td>
				<td class="med-col" >: {{$row->transaksi->id}}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="small-col" >No. RM</td>
				<td class="big-col" >: {{$row->transaksi->pasien->no_rm}}</td>
				<td class="small-col" >Status</td>
				<td class="med-col" >: ({{$row->transaksi->pembayaran->perusahaan->tipe['nama']}}) {{$row->transaksi->pembayaran->perusahaan->nama}}</td>
			</tr>
			<tr>
				<td class="small-col" >Tgl. Lahir</td>
				<td class="big-col" >: {{date('d/m/Y', strtotime($row->transaksi->pasien->date_of_birth))}}</td>
				<td class="small-col" >Asal</td>
				<td class="med-col" >: {{$row->transaksi->asal['nama']}}</td>
			</tr>
			<tr>
				<td class="small-col" >Usia</td>
				<td class="big-col" >: {{$row->transaksi->pasien->age}} Tahun</td>
				<td class="small-col" >Tgl. Order</td>
				<td class="med-col" >: {{$row->transaksi->created_at->format('d/m/Y h:i')}}</td>
			</tr>
			<tr>
				<td class="small-col" >Jns. Kelamin</td>
				<td class="big-col" >: {{$row->transaksi->pasien->jenis_kelamin}}</td>
				<td class="small-col" >Catatan</td>
				<td class="med-col" >: </td>
			</tr>
			<tr>
				<td class="small-col" >Dokter</td>
				<td class="big-col" >: {{$row->transaksi->kasus->dpjp_detail->name ?? '-'}}</td>
			</tr>
			<tr>
				<td class="small-col" >Diagnosa</td>
				<td class="big-col" >: {{$row->transaksi->kasus->diagnosisUtama->icd10->long_desc ?? '-'}}</td>
			</tr>
		</tbody>
	</table>
	<br>
		<?php $no=1; ?>
		<?php if($row->konten['jumlah']<18) $jumlah_halaman=1; else $jumlah_halaman=ceil((($row->konten['jumlah']-17)/34)+1); ?>
		<?php if($row->konten['jumlah']<18) $sisa=$row->konten['jumlah']%17; else $sisa=($row->konten['jumlah']-17)%34; ?>
		<?php if($row->konten['jumlah']<18) $kosongan=(17-$sisa)%17; else $kosongan=(34-$sisa)%34; ?>

		<?php for($i=0;$i<$jumlah_halaman;$i++) { ?>
			<?php if($i>0) { ?> <div style="page-break-after: always;"></div>  <?php } ?>
			<table style="width: 100vw">
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
							<td colspan="4"><b>Hasil {{$row->hasil->created_at->format('d F Y h:i')}}</b></td>
						</tr>
					<?php } ?>
					<?php $current_head = null; ?>
					@foreach($row->konten['result'][$i] as $rr)
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


		<table style="width: 100vw">
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
	@endforeach
</body>