<!DOCTYPE html>
<html>
<head>
	<title>Label Obat UDD Rawat Inap</title>
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
			font-size: 10.5px;
		}
		.rs-subtitle {
			font-size: 7.5px;
			border-bottom: 1px solid black;
		}
      .font-bold {
         font-weight: bold;
      }
	</style>
</head>

<body>

   @foreach ($resep_detail as $i => $detail)
   <div class="text-center" style="width: 100%;">
      <div class="rs-title">
         <b>INSTALASI FARMASI RSJ MENUR</b>
      </div>
      <div class="rs-subtitle">
         {{-- <b>JL. Menur No 120 Kode Pos 60282 (031) 5021635 PSW : 114<br>
         APOTEKER : {{$farmasi->kasie ?? '-'}}<br>
			NO.SIPA : {{$farmasi->no_sipa ?? '-'}}</b> --}}
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
         <td colspan="2" style="font-size: 10pt; text-align: center" class="font-bold">{{ $detail[1] ?? '-' }}</td>
      </tr>
      <tr>
			<td colspan="2" style="font-size: 8pt">{{ $transaksi->pasien_detail->no_rm ?? '-' }} / {{ $transaksi->lokasi->nama ?? '-' }}</td>
			<td colspan="2" style="font-size: 6pt; padding-left: 3.5px">Tgl Lhr : @if (!empty($transaksi->pasien_detail->date_of_birth)) {{ date('d/m/Y', strtotime($transaksi->pasien_detail->date_of_birth)) }} 
				@else - 
				@endif
         </td>
		</tr>
      <tr>
         <td colspan="2" style="font-size: 8pt; vertical-align: middle">{{ $detail[0]->nama_obat ?? '-' }}</td>
         <td colspan="2">
            <table width="100%">
               <tr>
                  <td style="font-size: 6pt"><b>Exp</b></td>
                  <td style="font-size: 6pt"><b>Jumlah</b></td>
               </tr>
               <tr>
                  <td style="font-size: 6pt">@if(!empty($exp_dates[$i])) {{ $exp_dates[$i] }} @else - @endif</td>
                  @php
                     $jumlah = 0;
                     if (!empty($detail[1])) {
                        switch ($detail[1]) {
                           case '07.00':
                              $jumlah = $detail[0]->aturan_per_jam_1 ?? 0;
                              break;
                           case '13.00':
                              $jumlah = $detail[0]->aturan_per_jam_2 ?? 0;
                              break;
                           case '19.00':
                              $jumlah = $detail[0]->aturan_per_jam_3 ?? 0;
                              break;
                           case '24.00':
                              $jumlah = $detail[0]->aturan_per_jam_4 ?? 0;
                              break;
                           case '22.00':
                              $jumlah = $detail[0]->aturan_per_jam_5 ?? 0;
                              break;
                           default:
                              break;
                        }
                     }
                  @endphp
                  <td style="font-size: 6pt">{{ $jumlah }} {{ $detail[0]->satuan }}</td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="4" style="font-size: 6pt; word-wrap: break-word;">Aturan Pakai : <span style="font-size: 8pt; line-height: 10px">{{ $detail[0]->aturan ?? '-' }}</span></td>
      </tr>
      <tr>
         <td colspan="2" style="font-size: 6pt">Catatan : {{ $detail[0]->default_catatan ?? '-' }}</td>
         <td colspan="2" style="font-size: 6pt; padding-left: 3.5px">Sesudah Makan</td>
      </tr>
   </table>


   @if(isset($resep_detail[$i+1]))
	<div style="page-break-after: always;"></div>
	@endif
   @endforeach
</body>

</html>