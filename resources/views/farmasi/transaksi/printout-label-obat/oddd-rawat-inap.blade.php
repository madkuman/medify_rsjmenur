<!DOCTYPE html>
<html>
<head>
	<title>Label Obat ODDD Rawat Inap</title>
	<style type="text/css">
		html{
			margin:10px;
			/* margin-left: 20px; */
			margin-bottom: 0px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}
		@page{
			margin-bottom: 0px;
		}
		.page-break {
			page-break-after: always;
		}
		.text-center {
			text-align: center !important;
		}
		.rs-title { 
			font-size: 11px;
		}
		.rs-subtitle {
			font-size: 8px;
			border-bottom: 1px solid black;	
		}
      .font-bold {
         font-weight: bold;
      }
	</style>
</head>

<body>

	@foreach ($resep_detail as $i => $detail)
	<div class="text-center" style="width: 100%; border-bottom: 1px solid black;">
      <div class="rs-title">
         <b>INSTALASI FARMASI RSJ MENUR</b>
      </div>
   </div>

	<table width="100%" style="line-height: 8px;">
		<tr>
         <td width="30%" style="font-size: 6pt">No. {{ $transaksi->nomor_antrian ?? '-' }}</td>
         <td width="35%" style="font-size: 6pt">Tgl: @if(!empty($transaksi->created_at)) {{ indonesian_date($transaksi->created_at) }} @else - @endif</td>
         <td width="35%" colspan="2" style="font-size: 6pt; text-align: center">Diminum/Dipakai</td>
      </tr>
		<tr>
         <td colspan="2" style="font-size: 8pt"> @if(!empty($transaksi->pasien_detail->name)) 
            {{ substr($transaksi->pasien_detail->name, 0, 20) }}... @else - @endif / {{ $transaksi->pasien_detail->JenisKelaminLp ?? '-' }}
         </td>
         <td colspan="2" style="font-size: 10pt; text-align: center" class="font-bold">{{ $resep_detail[$i][0] ?? '-' }}</td>
      </tr>
		<tr>
			<td colspan="2" style="font-size: 8pt">{{ $transaksi->pasien_detail->no_rm ?? '-' }} / {{ $transaksi->lokasi->nama ?? '-' }}</td>
			<td colspan="2" style="font-size: 6pt">Tgl Lhr : @if (!empty($transaksi->pasien_detail->date_of_birth)) {{ date('d/m/Y', strtotime($transaksi->pasien_detail->date_of_birth)) }} 
				@else - 
				@endif</td>
		</tr>
		<!-- nama obat -->
		<tr>
			<td colspan="2" style="font-size: 6pt"><b>Nama</b></td>
			<td style="font-size: 6pt"><b>Exp</b></td>
			<td style="font-size: 6pt"><b>Jumlah</b></td>
		</tr>
		@foreach ($resep_detail[$i][1] as $resep_i => $item)
		<tr>
			<td style="font-size: 7pt" colspan="2">{{ $item->nama_obat ?? '-' }}</td>
			@php
				$jumlah = 0;
				if (!empty($resep_detail[$i][0])) {
					switch ($resep_detail[$i][0]) {
						case '07.00':
							$jumlah = $item->aturan_per_jam_1 ?? 0;
							break;
						case '13.00':
							$jumlah = $item->aturan_per_jam_2 ?? 0;
							break;
						case '19.00':
							$jumlah = $item->aturan_per_jam_3 ?? 0;
							break;
						case '24.00':
							$jumlah = $item->aturan_per_jam_4 ?? 0;
							break;
						case '22.00':
							$jumlah = $item->aturan_per_jam_5 ?? 0;
							break;
					}
				}
			@endphp
			<td style="font-size: 6pt">{{ $exp_dates[$resep_i] }}</td>
			<td style="font-size: 6pt">{{ $jumlah }} {{ $item->satuan ?? '-' }}</td>
		</tr>
		@endforeach

	</table>


	@if(isset($resep_detail[$i+1]))
	<div style="page-break-after: always;"></div>
	@endif
   @endforeach

</body>

</html>