<!DOCTYPE html>
<html>
<head>
	<title>Perincian Biaya Piutang</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
			font-size: 13px;
			font-weight: 600 !important;
		}
		@page{
			margin-top: 25px;
			margin-bottom: 25px; 
		}
		.table {
			width: 100%;
			max-width: 100%;
			border-collapse: collapse;
		}
		.table-bordered, .table-bordered th {
			border: 1px solid #000;
		}
		.table-bordered td {
			font-weight: normal;
			border-left: 1px solid #000;
			border-right: 1px solid #000;
		}

		.table-bordered td, .table-bordered th{
			padding: 4px;
		}
		.text-left {
			text-align: left
		}
		.text-right {
			text-align: right
		}
		.float-right{
			float: right;
		}

		.text-center
		{
			text-align: center
		}
		td.hr{
			border-bottom: 1px solid  #000;
		}
		tr.none-bold th
		{
			font-weight: 400;
		}
		li{
			margin: 10px 0;
		}
		.footer {
			position: fixed;
			bottom: 0px;
		}
		h2
		{
			font-weight: 800;
		}

		.table
		{
			width: 100%;
		}
		table.table,.table th,.table td {
			border-collapse: collapse;
		}
		.table th, .table td {
			padding: 2px;
			vertical-align: top
		}
		.date td{
			text-align: center;
		}
		.list{
			width: 100%;
		}
		.list td{
			font-size: 12px;
		}
		.nogap td{
			line-height: 10px;
		}
		td{
			line-height: 10px;
		}
		hr{
			margin-top: 5px; 
			margin-bottom: 5px;
		}
		.pemasukan-show{
			display: table-cell !important;
		}
		.pemasukan-hide{
			display: none;
		}
		.f-13{
			font-size: 13px;
		}
	</style>
</head>
<body>
	<table width="100%" class="nogap" style="font-size: 14px;">
		<tr>
			<td>RUMAH SAKIT JIWA MENUR SURABAYA PROVINSI JAWA TIMUR</td>
		</tr>
		<tr>
			<td>Jl.Menur No. 120, Kode Pos 60282.</td>
		</tr>
		<tr>
			<td>Surabaya</td>
		</tr>
		<tr>
			<td>Telp: (031)5021635 Fax: (031)5021637</td>
		</tr>
		<tr>
			<td>-----------------------------------------------------</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td>No Kwitansi</td>
			<td>:</td>
			<td>PTG{{$piutang->id}}</td>
		</tr>
		<tr>
			<td>No Medrec</td>
			<td>:</td>
			<td>{{$piutang->pasien->no_rm}}</td>
		</tr>
		<tr>
			<td width="20%">Status</td>
			<td width="2%">:</td>
			<td width="38%"></td>
			<td width="15%">Tanggal</td>
			<td width="2%">:</td>
			<td width="23%">{{date('d M Y')}}</td>
		</tr>
		<tr>
			<td>Dokter</td>
			<td>:</td>
			<td colspan="4">@if(!empty($piutang->piutang->kasusTagihan)){{$piutang->piutang->kasusTagihan->kasus->admin->user->name ?? '-'}} @else {{$piutang->piutang->dokter->name ?? '-'}} @endif</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td colspan="4">{{$piutang->pasien->name ?? ''}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td colspan="4">{{$piutang->pasien->address ?? ''}} {{$piutang->pasien->alamat_kecamatan->nama ?? ''}}, {{$piutang->pasien->alamat_kota->nama ?? ''}}<br></td>
		</tr>
		<tr>
			<td>Unit</td>
			<td>:</td>
			<td>{{$piutang->piutang->kasusTagihan->kasus->lokasi->lokasi->nama ?? '-'}}</td>
		</tr>
	</table>
	<hr>

	<table class="list">
		<tr>
			<th style="font-size: 15px; width: 4%;">No</th>
			<th style="font-size: 15px; width: 76%;">Uraian</th>
			<th style="font-size: 15px; width: 20%; text-align: right;">Subtotal</th>
		</tr>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
		@php $total = 0 @endphp
		@foreach($inacbg as $key => $item)
		<tr>
			<td class="text-center">
				{{$loop->iteration}}
			</td>
			<td>
				<span style="text-transform: uppercase;">{{$item->kategori}}</span>
			</td>
			<td>
				Rp <b style="float: right;">{{number_format($item->subtotal,0)}}</b>
			</td>
		</tr>
		@php $total += $item->subtotal @endphp
		@endforeach
	</table>
	<hr width="100%">
	<table width="100%">
		<tbody>
			<tr>
				<td width="60%" class="text-right">Jumlah Total</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;:</td>
				<td class="text-right">
					<strong>{{number_format($total)}}</strong>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="color: white">dummy</td>
			</tr>
		</tbody>
	</table>
	<table width="100%">
		<tr>
			<td width="45%" class="text-center">Operator :</td>
			<td width="10%"></td>
			<td width="45%" class="text-center">Surabaya, {{indonesian_date(date('d F Y'))}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>                
			<td class="text-center">{{$nama_kasir}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td class="text-center">&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td class="text-center">&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td class="text-center">&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td class="text-center">
				(...................)
			</td>
		</tr>
	</table>
</body>
</html>
