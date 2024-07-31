<!DOCTYPE html>
<html>
<head>
	<title>Label Obat TPN</title>
	<style type="text/css">
		html{
			margin: 3px;
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
   @foreach ($transaksi->final_detail->resep_detail as $detail)
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

   <table width="100%" style="line-height: 8px">
      <tr>
         <td width="28%" class="font-bold" style="font-size: 6pt">No / Tgl Resep</td>
         <td width="55%" style="font-size: 6pt">: {{ $transaksi->no_resep ?? '-' }} / @if(!empty($transaksi->created_at)) {{ indonesian_date($transaksi->created_at) }} @else - @endif</td>
         <td width="17%" class="font-bold" style="font-size: 6pt; text-align: center">RUTE</td>
      </tr>
      <tr>
         <td class="font-bold" style="font-size: 6pt">Nama / Ruangan</td>
         <td style="font-size: 6pt">: 
            @if(!empty($transaksi->pasien_detail->name)) {{ substr($transaksi->pasien_detail->name, 0, 15) }}... 
            @else - 
            @endif / {{ $transaksi->lokasi->nama ?? '-' }} / {{ $transaksi->pasien_detail->JenisKelaminLp ?? '-' }}
         </td>
         <td class="font-bold" style="font-size: 6pt; text-align: center">@if(!empty($detail->tpn_rute_pemberian)) {{ substr($detail->tpn_rute_pemberian, 0, 6) }} @else - @endif</td>
      </tr>
      <tr>
         <td class="font-bold" style="font-size: 6pt">Tgl. Lahir / No.RM</td>
         <td style="font-size: 6pt">: 
           @if (!empty($transaksi->pasien_detail->date_of_birth)) {{ date('d-m-Y', strtotime($transaksi->pasien_detail->date_of_birth)) }} 
           @else - 
           @endif / {{ $transaksi->pasien_detail->no_rm ?? '-' }}               
         </td>
         @php
            $vol_total = 0;
            if (!empty($detail->racikan)) {
               foreach ($detail->racikan as $racikan) {
                  $vol_total += $racikan->jumlah ?? 0;
               }
            }
         @endphp
         <td style="font-size: 4.5pt">Vol Total: {{ $vol_total ?? 0 }} mL</td>
      </tr>
      <!--sediaan obat-->
      <tr>
         <td style="font-size: 6pt"><b>Sediaan Obat</b></td>
         <td colspan="2">
            @php
               $total_iteration = 0;
               $items_racikan = [];
               if (!empty($detail->racikan)) {
                  $total_item = count($detail->racikan);
                  $total_iteration = (int)floor($total_item / 2);
               }
            @endphp
            <table width="100%">
               @if (!empty($detail->racikan))
               @foreach ($detail->racikan as $i => $racikan)
               <tr>
                  <td width="50%" style="font-size: 6pt">{{$i+1}}. {{ $racikan->nama_obat ?? '-' }}</td>
               </tr>
               @endforeach
               @endif
            </table>
         </td>
      </tr>
      <!--sediaan obat-->
      <tr>
         <td class="font-bold" style="font-size: 6pt">Tgl Penyiapan</td>
         <td colspan="2" style="font-size: 6pt">: @if(!empty($transaksi->created_at)) {{ indonesian_date($transaksi->created_at) }} <b>Jam:</b> {{ date('H:i', strtotime($transaksi->created_at)) }} @else - @endif <b>BUD:</b> - <b>JAM:</b> -</td>
      </tr>
      <tr>
         <td class="font-bold" style="font-size: 6pt">Catatan</td>
         <td colspan="2" style="font-size: 6pt">: -</td>
      </tr>
   </table>

   @if(isset($transaksi->final_detail->resep_detail[$i+1]))
	<div style="page-break-after: always;"></div>
	@endif
   @endforeach
</body>

</html>