<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Screening Pemantauan Terapi Obat Pasien</title>

   <style>
      body, p {
			font-size: 14px;
			font-family: Arial, Helvetica, sans-serif;
		}

      .bordered {
         border: 1px solid black;
         border-collapse: collapse;
      }
   </style>
</head>
<body>
   <table width="100%" style="text-align: center; font-size: 16px">
      <tr>
         <td width="10%">
            <img src="{{ asset(config("app.kop_lg")) }}" alt="kop-lg" style="width: 80px; max-width: 80px;">
         </td>
         <td width="90%"><b>HASIL CEKLIST PASIEN DENGAN PEMANTAUAN TERAPI OBAT</b></td>
      </tr>
   </table>
   <br>

   <table class="table table-bordered table-vcenter bordered" width="100%">
      <thead>
         <tr>
            <th width="20%" class="bordered" style="vertical-align: middle">Nama Pasien</th>
            <th width="10%" class="bordered" style="vertical-align: middle">No. RM</th>
            <th width="35%" class="bordered" style="vertical-align: middle">Hasil Cek List Pemantauan Terapi Obat</th>
            <th width="35%" class="bordered" style="vertical-align: middle">Alasan</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($pemantauan_terapi as $item)
         @php $res = json_decode($item->val) @endphp
         <tr>
            <td class="bordered">{{ $kasus->pasien->name ?? '' }}</td>
            <td class="bordered" style="text-align: center">{{ $kasus->pasien->no_rm ?? '' }}</td>
            @php
               $hasil_cek_list = '';
               if (!empty($res->polifarmasi) || !empty($res->variasi_rute) || !empty($res->variasi_aturan) || !empty($res->variasi_cara_pemberian)) {
                  $hasil_cek_list = 'Dilakukan Pemantauan Terapi Obat';
               }

               $polifarmasi = !empty($res->polifarmasi) ? 'Polifarmasi' : ''; 
               $variasi_rute = !empty($res->variasi_rute) ? ', Variasi Rute' : ''; 
               $varasi_aturan = !empty($res->varasi_aturan) ? 'Variasi Aturan' : ''; 
               $variasi_cara_pemberian = !empty($res->variasi_cara_pemberian) ? ', Variasi Cara Pemberian' : ''; 
            @endphp
            <td style="text-align: center" class="bordered">{{ $hasil_cek_list ?? ''}}</td>
            <td style="text-align: center" class="bordered">{{ $polifarmasi ?? '' }} {{ $variasi_rute ?? '' }} {{ $varasi_aturan ?? '' }} {{ $variasi_cara_pemberian ?? '' }}</td>
         </tr>
         @endforeach
         <tr>
            <td class="bordered">Tanggal, pukul</td>
            <td class="bordered" colspan="3">{{ indonesian_date(now()) }}, {{ date('H:i', strtotime(now())) }}</td>
         </tr>
         <tr>
            <td class="bordered">Nama</td>
            <td class="bordered" colspan="3">{{ Auth::user()->name ?? '' }}</td>
         </tr>
      </tbody>
   </table>

</body>
</html>