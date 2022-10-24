<!DOCTYPE html>
<html>
<head>
	<title>Invoice PO</title>
	<style type="text/css">
	body{
		font-family: sans-serif;
		font-size: 13px;
	}
	table{
		border-collapse: collapse;
		width: 100%
	}
	td, th{
		padding-left: 5px;
		padding-right: 5px;
	}
	.bordered td, .bordered th{
		border: 1px solid black;
	}
	.centered{
		text-align: center;
	}
	.righted{
		text-align: right;
	}
	.dummy{
		font-size: 25px;
	}
	.bot-border{
		border-bottom: 1px solid black;
	}
</style>
</head>
<body>
	<table>
		<tr>
			<td class="centered" width="40%">UNIT KERJA PENGADAAN BARANG JASA</td>
			<td width="60%"></td>
		</tr>
		<tr>
			<td class="centered bot-border">KELOMPOK KERJA PEMILIHAN</td>
			<td></td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="70%"></td>
			<td width="30%">Surabaya, {{indonesian_date($date)}}</td>
		</tr>
		<tr>
			<td></td>
			<td>Kepada</td>
		</tr>
		<tr>
			<td></td>
			<td>Yth {{$po->perusahaan->nama}}</td>
		</tr>
		<tr>
			<td></td>
			<td>di -</td>
		</tr>
		<tr>
			<td></td>
			<td>Surabaya</td>
		</tr>
	</table>
	<table>
		<tr>
			@if(is_null($apoteker))
			<td>SURAT PERMINTAAN BARANG/PEKERJAAN</td>
			@else
			<td>SURAT PESANAN</td>
			@endif
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<td>NO: {{$po->no_po}}</td>
		</tr>
	</table>
	<table class="bordered">
		<thead>
			<tr>
				<th class="centered">NO</th>
				<th class="centered">NAMA BARANG</th>
				<th class="centered">SAT</th>
				<th class="centered">JML</th>
				<th class="centered">HARGA</th>
				<th class="centered">DISKON</th>
				<th colspan="2" class="centered">TOTAL</th>
			</tr>
		</thead>
		<tbody>
			@foreach($po->detail as $key => $item)
			<tr>
				<td width="5%">{{$key+1}}</td>
				<td width="25%">{{$item->deskripsi}}</td>
				<td width="10%">{{$item->keterangan}}</td>
				<td width="10%">{{$item->jumlah}}</td>
				<td width="15%">{{number_format($item->harga)}}</td>
				<td width="10%">{{$item->diskon}} %</td>
				<td width="3%">Rp</td>
				<td width="22%" class="righted">{{number_format($item->subtotal)}}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"></td>
				<td colspan="2">
					Subtotal<br>
					Diskon<br>
					Total
				</td>
				<td>
					Rp<br>
					Rp<br>
					Rp<br>
				</td>
				<td class="righted">
					{{number_format($po->jumlah)}}<br>
					{{number_format($po->diskon)}}<br>
					{{number_format($po->total)}}
				</td>
			</tr>
		</tbody>
	</table>
	<table>
		<tr>
			<td width="7%">NB :</td>
			<td width="53%">
				{!!$keterangan!!}
			</td>
			<td width="40%"></td>
		</tr>
	</table>
	<br><br><br>
	<table>
		@if(is_null($apoteker))
		<tr>
			<td width="40%" class="centered">Mengetahui,</td>
			<td width="20%"></td>
			<td width="40%"></td>
		</tr>
		<tr>
			<td class="centered">{{$mengetahui->jabatan}}</td>
			<td></td>
			<td class="centered">{{$pejabat->jabatan}}</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td class="centered">{{$mengetahui->nama}}</td>
			<td></td>
			<td class="centered">{{$pejabat->nama}}</td>
		</tr>
		<tr>
			<td class="centered">{{$mengetahui->pangkat ?? '-'}} NRP. {{$mengetahui->nip ?? '-'}}</td>
			<td></td>
			<td class="centered">{{$pejabat->pangkat ?? '-'}} NRP. {{$pejabat->nip ?? '-'}}</td>
		</tr>
		@else
		<tr>
			<td width="40%" class="centered">{{$apoteker->jabatan}} Penanggung Jawab</td>
			<td width="20%"></td>
			<td width="40%" class="centered">{{$pejabat->jabatan}}</td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td class="centered">{{$apoteker->nama}}</td>
			<td></td>
			<td class="centered">{{$pejabat->nama}}</td>
		</tr>
		<tr>
			<td class="centered">
				{{$apoteker->pangkat ?? '-'}} NRP. {{$apoteker->nip ?? '-'}}
			</td>
			<td></td>
			<td class="centered">{{$pejabat->pangkat ?? '-'}} NRP. {{$pejabat->nip ?? '-'}}</td>
		</tr>
		<tr>
			<td class="centered">
				SIPA : {{$apoteker->sipa ?? '-'}}
			</td>
			<td></td>
			<td class="centered"></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td width="30%"></td>
			<td width="40%" class="centered">Mengetahui,</td>
			<td width="30%"></td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$mengetahui->jabatan}}</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3" class="dummy">.</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$mengetahui->nama}}</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$mengetahui->pangkat ?? '-'}} NRP. {{$mengetahui->nip ?? '-'}}</td>
			<td></td>
		</tr>
		@endif
	</table>
</body>
</html>