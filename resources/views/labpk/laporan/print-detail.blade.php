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
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>

<hr>
<h3 style="text-align: center">HASIL PEMERIKSAAN LABORATORIUM KLINIK</h3>
<table>
	<thead>
		<tr>
			<td class="small-col" >Pasien</td>
			<td class="big-col" >: {{$transaksi->pasien->name}}</td>
			<td class="small-col" >No. Order</td>
			<td class="med-col" >: {{$transaksi->id}}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="small-col" >No. RM</td>
			<td class="big-col" >: {{$transaksi->pasien->no_rm}}</td>
			<td class="small-col" >Status</td>
			<td class="med-col" >: ({{$transaksi->pembayaran->perusahaan->tipe['nama']}}) {{$transaksi->pembayaran->perusahaan->nama}}</td>
		</tr>
		<tr>
			<td class="small-col" >Tgl. Lahir</td>
			<td class="big-col" >: {{$transaksi->pasien->name}}</td>
			<td class="small-col" >Asal</td>
			<td class="med-col" >: {{$transaksi->asal['nama']}}</td>
		</tr>
		<tr>
			<td class="small-col" >Usia</td>
			<td class="big-col" >: {{$transaksi->pasien->age}} Tahun</td>
			<td class="small-col" >Tgl. Order</td>
			<td class="med-col" >: {{$transaksi->created_at}}</td>
		</tr>
		<tr>
			<td class="small-col" >Jns. Kelamin</td>
			<td class="big-col" >: {{$transaksi->pasien->jenis_kelamin}}</td>
			<td class="small-col" >Catatan</td>
			<td class="med-col" >: </td>
		</tr>
		<tr>
			<td class="small-col" >Dokter</td>
			<td class="big-col" >: {{$transaksi->creator['name']}}</td>
		</tr>
		<tr>
			<td class="small-col" >Diagnosa</td>
			<td class="big-col" >: {{$transaksi->diagnosis}}</td>
		</tr>
	</tbody>
</table>
<br>
<?php $no=1; ?>
<?php if($jumlah<18) $jumlah_halaman=1; else $jumlah_halaman=ceil((($jumlah-17)/34)+1); ?>
<?php if($jumlah<18) $sisa=$jumlah%17; else $sisa=($jumlah-17)%34; ?>
<?php if($jumlah<18) $kosongan=(17-$sisa)%17; else $kosongan=(34-$sisa)%34; ?>

<?php for($i=0;$i<$jumlah_halaman;$i++) { ?>
<?php if($i>0) { ?> <div style="page-break-after: always;"></div>  <?php } ?>
<table style="width: 100vw">
	<thead style="border-top: 1px solid black; border-bottom: 1px solid black ">
		<tr>
			<th>No</th>
			<th>Parameter</th>
			<th>Result</th>
			<th>Unit</th>
			<th>Flag</th>
			<th>Ref. Ranges</th>
		</tr>
	</thead>
	<tbody>
		<?php if($i==0) { ?>
		<tr>
			<td colspan="4"><b>{{$detail->tarif->deskripsi}}</b></td>
		</tr>
		<?php } ?>
		@foreach($result[$i] as $row)
		<tr>
			<td>{{$no++}}</td>
			<td>{{$row->label}}</td>
			<td>{{$row->value}}</td>
			<td>{{$row->satuan}}</td>
			<td>@if(isset($row->flag))
				{{$row->flag}}
				@else
				-
				@endif
			</td>
			<td>{{$row->referensi}}</td>
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
		<td style="text-align: center;">_______________________</td>
	</tr>
</table>
<script type="text/php">
    if ( isset($pdf) ) {
        $x = 520;
        $y = 750;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = $fontMetrics->get_font("Arial", "bold");
        $size = 11;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>