<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Observasi Tindakan ECT</title>

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
      <tr><td><b>OBSERVASI KLIEN DENGAN TINDAKAN ECT</b></td></tr>
   </table>

   <table width="70%" style="margin-top: 30px" style="text-align: left">
      <tr>
         <td width="30%">
            <table>
               <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td>{{ $kasus->pasien->name ?? '-' }}</td>
               </tr>
               <tr>
                  <td>Umur</td>
                  <td>:</td>
                  <td>{{ $kasus->pasien->Age ?? '-' }} Tahun</td>
               </tr>
               <tr>
                  <td>No. Reg</td>
                  <td>:</td>
                  <td>{{ $kasus->pasien->no_rm ?? '-' }}</td>
               </tr>
            </table>
         </td>
         <td width="40%">
            <table>
               <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td>{{ $kasus->pasien->JenisKelamin ?? '-' }}</td>
               </tr>
               <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td>{{ $kasus->pasien->address ?? '-' }}</td>
               </tr>
               <tr>
                  <td>Ruangan</td>
                  <td>:</td>
                  <td>{{ $kasus->lokasi->lokasi->nama ?? '-' }}</td>
               </tr>
            </table>
         </td>
      </tr>
   </table>

   <table width="100%" style="margin-top: 30px; text-align: center" class="bordered">
     <thead>
         <tr>
            <td rowspan="2" class="bordered">No</td>
            <th colspan="9" class="bordered">PERSIAPAN ECT</th>
            <th colspan="10" class="bordered">PELAKSANAAN ECT</th>
            <th colspan="5" class="bordered">POST ECT</th>
            <th colspan="3" class="bordered">Serah Terima</th>
         </tr>
         <tr>
            <td class="bordered">Tgl</td>
            <td class="bordered">Jam</td>
            <td class="bordered">T</td>
            <td class="bordered">N</td>
            <td class="bordered">S</td>
            <td class="bordered">RR</td>
            <td class="bordered">Puasa</td>
            <td class="bordered">Ptg Ru</td>
            <td class="bordered">Ptg ECT</td>
            <td class="bordered">T</td>
            <td class="bordered">N</td>
            <td class="bordered">S</td>
            <td class="bordered">RR</td>
            <td class="bordered">Jam ECT</td>
            <td class="bordered">Dosis</td>
            <td class="bordered">Dr.</td>
            <td class="bordered">Pwt</td>
            <td class="bordered">Jam</td>
            <td class="bordered">Kesadaran</td>
            <td class="bordered">T</td>
            <td class="bordered">N</td>
            <td class="bordered">S</td>
            <td class="bordered">RR</td>
            <td class="bordered">Ket</td>
            <td class="bordered">Jam</td>
            <td class="bordered">Pet ECT</td>
            <td class="bordered">Ptg Ru</td>
         </tr>
      </thead>

      <tbody>
         @foreach ($ect as $item)
         @php $res = json_decode($item->val) @endphp
         <tr style="word-wrap: break-word;">
            <td class="bordered">{{ $loop->iteration }}</td>
            <td class="bordered">{{ is_null($res->tgl_persiapan_ect) ? '-' : date('d-m-Y', strtotime($res->tgl_persiapan_ect)) }}</td>
            <td class="bordered">{{ $res->jam_persiapan_ect }}</td>
            <td class="bordered">{{ $res->t_persiapan_ect }}</td>
            <td class="bordered">{{ $res->n_persiapan_ect }}</td>
            <td class="bordered">{{ $res->s_persiapan_ect }}</td>
            <td class="bordered">{{ $res->rr_persiapan_ect }}</td>
            <td class="bordered">{{ $res->puasa_persiapan_ect }}</td>
            @php
               $user = \App\User::find($res->ptg_ru_persiapan_ect);
            @endphp
            <td class="bordered">{{ $user->name }}</td>
            @php
               $user = \App\User::find($res->ptg_ect_persiapan_ect);
            @endphp
            <td class="bordered">{{ $user->name }}</td>
            <td class="bordered">{{ $res->t_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->n_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->s_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->rr_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->jam_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->dosis_pelaksanaan_ect }}</td>
            @php
               $dokter = \App\User::find($res->dr_pelaksanaan_ect);
            @endphp
            <td class="bordered">{{ $dokter->name ?? '-' }}</td>
            @php
               $perawat = \App\User::find($res->pwt_pelaksanaan_ect);
            @endphp
            <td class="bordered">{{ $perawat->name ?? '-' }}</td>
            <td class="bordered">{{ $res->jam2_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->kesadaran_pelaksanaan_ect }}</td>
            <td class="bordered">{{ $res->t_post_ect }}</td>
            <td class="bordered">{{ $res->n_post_ect }}</td>
            <td class="bordered">{{ $res->s_post_ect }}</td>
            <td class="bordered">{{ $res->rr_post_ect }}</td>
            <td class="bordered">{{ $res->ket_post_ect }}</td>
            <td class="bordered">{{ $res->jam_serah_ect }}</td>
            @php
               $user = \App\User::find($res->ptg_ect_serah_ect);
            @endphp
            <td class="bordered">{{ $user->name ?? '-' }}</td>
            @php
               $user = \App\User::find($res->ptg_ruangan_serah_ect);
            @endphp
            <td class="bordered">{{ $user->name ?? '-' }}</td>
         </tr>
         @endforeach
        
      </tbody>
   </table>


</body>
</html>