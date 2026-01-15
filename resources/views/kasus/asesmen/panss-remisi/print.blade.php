<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Panss Remisi</title>
   <style>
      body, p {
			font-size: 14px;
			font-family: Arial, Helvetica, sans-serif;
		}

      #main-table {
         border: 1px solid black;
         border-collapse: collapse;
      }

      .bordered {
         border: 1px solid black;
         border-collapse: collapse;
      }
   </style>
</head>
<body>
   @php $res = json_decode($panss_remisi->val) @endphp
   <table width="100%" style="text-align: center; font-size: 16px">
      <tr><td><b>POSITIVE AND NEGATIVE SYNDROMES SCALE</b></td></tr>
      <tr><td><b>QUICKSCORE FORM</b></td></tr>
      <tr><td><b>(FORM PANSS REMISI)</b></td></tr>
   </table>

   <table width="100%" style="margin-top: 40px">
      <tr>
         <td width="20%">NAMA PASIEN</td>
         <td width="5%">:</td>
         <td width="70%">{{ $kasus->pasien->name ?? '-' }}</td>
      </tr>
      <tr>
         <td width="20%">NO. RM</td>
         <td width="5%">:</td>
         <td width="70%">{{ $kasus->pasien->no_rm ?? '-' }}</td>
      </tr>
      <tr>
         <td width="20%">DPJP</td>
         <td width="5%">:</td>
         <td width="70%">{{ $kasus->Dpjp->user->name ?? '-' }}</td>
      </tr>
      <tr>
         <td width="20%">TTD DPJP</td>
         <td width="5%">:</td>
         @if (!empty($kasus->Dpjp->user->ttd))
         <td width="70%"><img src="{{ asset($kasus->Dpjp->user->ttd) }}" alt="ttd_dpjp" style="max-width: 90px"></td>
         @else
         <td width="70%"></td>
         @endif
      </tr>
   </table>
   
   <table id="main-table" width="100%" style="margin-top: 40px; text-align: center; vertical-align: middle;">
      <thead>
         <tr>
            <th rowspan="2" width="40%" style="text-align: left" class="bordered">Positive and Negative Syndromes Scale</th>
            <th colspan="2" width="40%" class="bordered">Tgl Pemeriksaan</th>
            <th rowspan="2" width="10%" class="bordered">SCORE</th>
         </tr>
         <tr>
            {{-- <td class="bordered">MASUK</td>
            <td class="bordered">KELUAR</td> --}}
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
      </thead>
      <tbody>
         <!-- isiain -->
         <tr>
            <td style="text-align: left" class="bordered">P I  : WAHAM</td>
            {{-- <td class="bordered">{{ is_null($res->p1_masuk) ? '-' : date('d-m-Y', strtotime($res->p1_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->p1_keluar) ? '-' : date('d-m-Y', strtotime($res->p1_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->p1_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">P 2 : KEKACAUAN PROSES BERFIKIR(CONSEPTUALORGANIZATION)</td>
            {{-- <td class="bordered">{{ is_null($res->p2_masuk) ? '-' : date('d-m-Y', strtotime($res->p2_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->p2_keluar) ? '-' : date('d-m-Y', strtotime($res->p2_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->p2_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">P 3 : PERILAKU HALUSINASI</td>
            {{-- <td class="bordered">{{ is_null($res->p3_masuk) ? '-' : date('d-m-Y', strtotime($res->p3_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->p3_keluar) ? '-' : date('d-m-Y', strtotime($res->p3_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->p3_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">N I : AFEK TUMPUL</td>
            {{-- <td class="bordered">{{ is_null($res->n1_masuk) ? '-' : date('d-m-Y', strtotime($res->n1_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->n1_keluar) ? '-' : date('d-m-Y', strtotime($res->n1_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->n1_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">N 4 : PENARIKAN DIRI DARI HUBUNGAN SOSIAL SECARA PASIF/APATIS</td>
            {{-- <td class="bordered">{{ is_null($res->n4_masuk) ? '-' : date('d-m-Y', strtotime($res->n4_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->n4_keluar) ? '-' : date('d-m-Y', strtotime($res->n4_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->n4_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">N 6 : KURANGNYA SPONTANITAS DAN ARUS PERCAKAPAN</td>
            {{-- <td class="bordered">{{ is_null($res->n6_masuk) ? '-' : date('d-m-Y', strtotime($res->n6_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->n6_keluar) ? '-' : date('d-m-Y', strtotime($res->n6_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->n6_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">G 5 : MEKANISME DAN SIKAP TUBUH</td>
            {{-- <td class="bordered">{{ is_null($res->g5_masuk) ? '-' : date('d-m-Y', strtotime($res->g5_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->g5_keluar) ? '-' : date('d-m-Y', strtotime($res->g5_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->g5_score }}</td>
         </tr>
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left">G 9 : ISI PIKIRAN YANG TIDAK  BIASA</td>
            {{-- <td class="bordered">{{ is_null($res->g9_masuk) ? '-' : date('d-m-Y', strtotime($res->g9_masuk)) }}</td> --}}
            {{-- <td class="bordered">{{ is_null($res->g9_keluar) ? '-' : date('d-m-Y', strtotime($res->g9_keluar)) }}</td> --}}
            <td class="bordered" colspan="2">{{ !empty($res->tanggal_pemeriksaan) ? date('d-m-Y', strtotime($res->tanggal_pemeriksaan)) : '-' }}</td>
            <td class="bordered">{{ $res->g9_score }}</td>
         </tr>

         <!-- total score -->
         <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left"><b>TOTAL SCORE</b></td>
            @php
               $total_score = $res->p1_score + $res->p2_score + $res->p3_score + $res->n1_score + $res->n4_score + $res->n6_score + $res->g5_score + $res->g9_score;
            @endphp
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">{{ $total_score }}</td>
         </tr>

          <!-- persen peningkatan score -->
          <tr>
            <td class="bordered">&nbsp;</td>
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">&nbsp;</td>
         </tr>
         <tr>
            <td class="bordered" style="text-align: left"><b>PERSEN PENINGKATAN SCORE</b></td>
            @php
               if (!empty($previous_panss_remisi)) {
                  $previous_panss_remisi_val = json_decode($previous_panss_remisi->val);
                  $total_score_previous = $previous_panss_remisi_val->p1_score + $previous_panss_remisi_val->p2_score + $previous_panss_remisi_val->p3_score + $previous_panss_remisi_val->n1_score + $previous_panss_remisi_val->n4_score + $previous_panss_remisi_val->n6_score + $previous_panss_remisi_val->g5_score + $previous_panss_remisi_val->g9_score;
                  $nilai_selisih = $total_score - $total_score_previous;
                  $persen_peningkatan_score =  (($nilai_selisih/$total_score_previous) * 100);
               } else {
                  $persen_peningkatan_score = '-';
               }
              
            @endphp
            {{-- <td class="bordered">&nbsp;</td>
            <td class="bordered">&nbsp;</td> --}}
            <td class="bordered" colspan="2"></td>
            <td class="bordered">{{ is_string($persen_peningkatan_score) ? '-' : number_format($persen_peningkatan_score, 2) }}%</td>
         </tr>

      </tbody>
   </table>


</body>
</html>