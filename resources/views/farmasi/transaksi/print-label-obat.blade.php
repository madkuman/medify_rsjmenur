<!DOCTYPE html>
<html>
<head>
	<title>Cetak Label Obat</title>
	<style type="text/css">
		html{
			margin:10px;
			margin-left: 20px;
			margin-bottom: 0px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}
		@page{
			margin-bottom: 0px;
		}
		.page-break {
			page-break-after: always;
		}
		.box {
			border: 1px solid black;
		}
		.table {
			width: 100%;
			max-width: 100%;
			border-collapse: collapse;
		}
		.text-small {
			font-size: 10px;
			line-height: 9px;
		}
		.text-med{
			font-size: 12px;
			font-weight: bold;
		}
		.text-center {
			text-align: center !important;
		}
		.text-right{
			text-align: right;
		}
		.rs-title { 
			font-size: 11px;
		}
		.rs-subtitle {
			font-size: 8px;
			border-bottom: 1px solid black;	
		}
		.tiny{
			font-size: 8px;
		}
		.uppercase{
			text-transform: uppercase;
		}
	</style>
</head>
<body>
	@foreach($transaksi->final_detail->resep_detail as $i => $detail)
	<div class="box">
		<div class="text-center" style="width: 100%">
			<div class="rs-title">
				<b>INSTALASI FARMASI RSJ MENUR</b>
			</div>
			<div class="rs-subtitle">
				<b>JL. Menur No 120 Kode Pos 60282 (031) 5021635 PSW : 114<br>
				APOTEKER : {{$farmasi->kasie ?? '-'}}<br>
				NO.SIPA : {{$farmasi->no_sipa ?? '-'}}</b>
			</div>
		</div>
		<div style="margin-top: 0px;">
			<table class="tiny" width="100%">
				<tr>
					<td width="34%">No: {{$transaksi->final_detail->nomor_resep}}</td>
					<td width="33%">Tgl: {{ date('d M Y') }}</td>
					<td width="33%">Tgl lhr: {{$transaksi->pasien_detail ? date("d/m/Y", strtotime($transaksi->pasien_detail->date_of_birth)) : '-'}}</td>
				</tr>
			</table>
			<table class="text-small" width="100%">
				<tr>
					<td class="uppercase" width="63%">{{substr($transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien, 0,20)}}</td>
					<td class="text-right" width="37%">({{$transaksi->pasien_detail ? $transaksi->pasien_detail->gender == '2' ? 'P' : 'L' : '-'}}) ({{$transaksi->pasien_detail ? $transaksi->pasien_detail->no_rm : '-'}})</td>
				</tr>
				<tr>
					<td class="uppercase">{{$detail->nama_obat}}</td>
					<td class="text-right tiny">
						<b style="font-size: 12px;">{{$detail->jumlah ?? '-'}}</b>
						Exp @if($detail->log->count() == 0) (-) @endif
						@if(!$detail->tipe)
						@php $ctr = 0 @endphp
						@foreach($detail->log as $log)
						@if($ctr) 
						@else {{ date('j/m/Y', strtotime($log->detail_item->kadaluarsa)) }}
						@endif
						@php $ctr++ @endphp
						@endforeach
						@endif
					</td>	
				</tr>
				<tr>
					<td colspan="2" class="text-med">Pemakaian : {{$detail->aturan}}</td>
				</tr>
			</table>
		</div>
	</div>
	@if(isset($transaksi->final_detail->resep_detail[$i+1]))
	<div style="page-break-after: always;"></div>
	@endif
	@endforeach
</body>
</html>