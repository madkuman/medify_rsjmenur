<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Observasi Transfusi Darah</title>

   <style>
      body, p {
			font-size: 12px;
			font-family: Arial, Helvetica, sans-serif;
		}

      .bordered {
         border: 1px solid black;
         border-collapse: collapse;
      }

      .text-center {
         text-align: center;
         vertical-align: middle;
      }

      .vertical-top {
         vertical-align: top;
      }

      table {
         width: 100%;
      }
   </style>
</head>
<body>
   @php
      $item = json_decode($transfusi_darah->val);
      // dd($transfusi_darah);
   @endphp
   <table width="100%" style="text-align: center;">
      <tr>
         <td></td>
         <td style="text-align: right">RM 21.2</td>
      </tr>
      <tr>
         <td width="30%">
            <img src="{{asset(config('app.kop_lg'))}}" alt="logo" style="height: 90px; max-height: 90px">
         </td>
         <td width="70%" style="padding-left: 30px;">
            <table width="100%" style="border: 1px solid black">
               <tr><td>NO. REKAM MEDIS: {{ $kasus->pasien->no_rm ?? '-' }}</td></tr>
               <tr><td>NAMA: {{ $kasus->pasien->name ?? '-' }}</td></tr>
               <tr><td>TANGGAL LAHIR/UMUR: {{ $kasus->pasien->date_of_birth ?? '-' }} / {{ $kasus->pasien->Age ?? '-' }}</td></tr>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="2" style="font-size: 10px; text-align: right">JENIS KELAMIN: @if(!empty($kasus->pasien->JenisKelamin)) {{ strtoupper($kasus->pasien->JenisKelamin) }} @else - @endif</td>
      </tr>
   </table>

   <br>
   <table>
      <thead>
         <tr>
            <td><b>LEMBAR OBSERVASI TRANSFUSI DARAH</b></td>
         </tr>
      </thead>
   </table>
   <br>
   
   <table width="100%" class="bordered">
      <thead>
         <tr>
            <th colspan="3" style="text-align: left" class="bordered">Diisi Oleh Perawat</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td width="30%" class="bordered" style="border-bottom: none;">Jenis komponen darah: {{ $item->jenis_komponen_darah }}</td>
            <td width="40%" class="bordered" style="text-align: center; border-bottom: none">Tanda tangan dan nama DPJP/Dokter pemberi instruksi transfusi darah:</td>
            <td width="30%" class="bordered" style="border-bottom: none">Nama pasien / keluarga pasien : {{ $item->nama_pasien_keluarga }}</td>
         </tr>
         <tr>
            <td class="bordered" style="border-top: none; border-bottom: none">No kantong darah: {{ $item->no_kantong_darah }}</td>
            <td style="padding-top: 35px"></td>
            <td style="border-left: 1px solid black;"></td>
         </tr>
         <tr>
            <td class="bordered" style="border-top: none">Golongan darah: {{ $item->golongan_darah }}</td>
            <td></td>
            <td class="bordered" style="border-top: none">Hubungan dengan pasien: {{ $item->hubungan }}</td>
         </tr>

         <!-- 2 -->
         <tr>
            <td class="text-center" style="border-right: 1px solid black">Tanda tangan dan nama petugas</td>
            <td class="text-center" style="border-top: 1px solid black">Tanda tangan dan nama perawat yang</td>
            <td class="text-center" style="border-left: 1px solid black">Tanda tangan dan nama</td>
         </tr>
         <tr>
            <td class="text-center" style="border-right: 1px solid black">yang melakukan transfusi darah</td>
            <td class="text-center" >melakukan kroscek ulang</td>
            <td class="text-center" style="border-left: 1px solid black">pasien / keluarga pasien</td>
         </tr>
         <tr>
            <td style="padding-top: 70px"></td>
            <td class="bordered" style="border-top: none"></td>
            <td></td>
         </tr>
      </tbody>
   </table>

   <!-- 3 -->
   <br>
   <table width="100%" class="bordered">
      <tr>
         <th colspan="6" class="bordered" style="text-align: left">Obat-obatan yang diberikan sebelum atau selama transfusi</th>
      </tr>
      <tr style="text-align: center">
         <td width="30%" class="bordered">Nama Obat</td>
         <td width="10%" class="bordered">Dosis Obat</td>
         <td width="10%" class="bordered">Rute Pemberian</td>
         <td width="10%" class="bordered">Waktu Pemberian</td>
         <td width="20%" class="bordered">Nama Perawat</td>
         <td width="20%" class="bordered">Paraf</td>
      </tr>
      <tr>
         @php
            $obat = \App\Models\Farmasi\ItemsTemplate::find($item->nama_obat_1 ?? ''); 
         @endphp
         <td class="bordered">{{ $obat->nama }}</td>
         <td class="bordered">{{ $item->dosis_obat_1 }}</td>
         <td class="bordered">{{ $item->rute_pemberian_1 }}</td>
         <td class="bordered">{{ $item->waktu_pemberian_1 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_1 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered text-center">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr>
         @php
            $obat = \App\Models\Farmasi\ItemsTemplate::find($item->nama_obat_2 ?? ''); 
         @endphp
         <td class="bordered">{{ $obat->nama }}</td>
         <td class="bordered">{{ $item->dosis_obat_2 }}</td>
         <td class="bordered">{{ $item->rute_pemberian_2 }}</td>
         <td class="bordered">{{ $item->waktu_pemberian_2 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_2 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered text-center">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr>
         @php
            $obat = \App\Models\Farmasi\ItemsTemplate::find($item->nama_obat_3 ?? ''); 
         @endphp
         <td class="bordered">{{ $obat->nama }}</td>
         <td class="bordered">{{ $item->dosis_obat_3 }}</td>
         <td class="bordered">{{ $item->rute_pemberian_3 }}</td>
         <td class="bordered">{{ $item->waktu_pemberian_3 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_3 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered text-center">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
   </table>


   <!-- 4 -->
   <br>
   <table width="100%" class="bordered">
      <tr>
         <th colspan="12" class="bordered" style="text-align: left">Observasi Transfusi</th>
      </tr>
      <tr style="text-align: center">
         <td width="5%" class="bordered">Tgl</td>
         <td width="5%" class="bordered">Jam</td>
         <td width="5%" class="bordered">Waktu</td>
         <td width="10%" class="bordered">Reaksi Transfusi*</td>
         <td width="10%" class="bordered">Keluhan/GCS</td>
         <td width="5%" class="bordered">TD</td>
         <td width="5%" class="bordered">N</td>
         <td width="5%" class="bordered">RR</td>
         <td width="10%" class="bordered">S</td>
         <td width="10%" class="bordered">Lainnya**</td>
         <td width="10%" class="bordered">Nama Perawat</td>
         <td width="20%" class="bordered">Paraf</td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_1 }}</td>
         <td class="bordered">{{ $item->jam_1 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_1 }}</td>
         <td class="bordered">{{ $item->keluhan_1 }}</td>
         <td class="bordered">{{ $item->td_1 }}</td>
         <td class="bordered">{{ $item->n_1 }}</td>
         <td class="bordered">{{ $item->rr_1 }}</td>
         <td class="bordered">{{ $item->s_1 }}</td>
         <td class="bordered">{{ $item->lainnya_1 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_1 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_2 }}</td>
         <td class="bordered">{{ $item->jam_2 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_2 }}</td>
         <td class="bordered">{{ $item->keluhan_2 }}</td>
         <td class="bordered">{{ $item->td_2 }}</td>
         <td class="bordered">{{ $item->n_2 }}</td>
         <td class="bordered">{{ $item->rr_2 }}</td>
         <td class="bordered">{{ $item->s_2 }}</td>
         <td class="bordered">{{ $item->lainnya_2 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_2 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_3 }}</td>
         <td class="bordered">{{ $item->jam_3 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_3 }}</td>
         <td class="bordered">{{ $item->keluhan_3 }}</td>
         <td class="bordered">{{ $item->td_3 }}</td>
         <td class="bordered">{{ $item->n_3 }}</td>
         <td class="bordered">{{ $item->rr_3 }}</td>
         <td class="bordered">{{ $item->s_3 }}</td>
         <td class="bordered">{{ $item->lainnya_3 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_3 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_4 }}</td>
         <td class="bordered">{{ $item->jam_4 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_4 }}</td>
         <td class="bordered">{{ $item->keluhan_4 }}</td>
         <td class="bordered">{{ $item->td_4 }}</td>
         <td class="bordered">{{ $item->n_4 }}</td>
         <td class="bordered">{{ $item->rr_4 }}</td>
         <td class="bordered">{{ $item->s_4 }}</td>
         <td class="bordered">{{ $item->lainnya_4 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_4 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_5 }}</td>
         <td class="bordered">{{ $item->jam_5 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_5 }}</td>
         <td class="bordered">{{ $item->keluhan_5 }}</td>
         <td class="bordered">{{ $item->td_5 }}</td>
         <td class="bordered">{{ $item->n_5 }}</td>
         <td class="bordered">{{ $item->rr_5 }}</td>
         <td class="bordered">{{ $item->s_5 }}</td>
         <td class="bordered">{{ $item->lainnya_5 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_5 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name ?? '' }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_6 }}</td>
         <td class="bordered">{{ $item->jam_6 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_6 }}</td>
         <td class="bordered">{{ $item->keluhan_6 }}</td>
         <td class="bordered">{{ $item->td_6 }}</td>
         <td class="bordered">{{ $item->n_6 }}</td>
         <td class="bordered">{{ $item->rr_6 }}</td>
         <td class="bordered">{{ $item->s_6 }}</td>
         <td class="bordered">{{ $item->lainnya_6 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_6 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_7 }}</td>
         <td class="bordered">{{ $item->jam_7 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_7 }}</td>
         <td class="bordered">{{ $item->keluhan_7 }}</td>
         <td class="bordered">{{ $item->td_7 }}</td>
         <td class="bordered">{{ $item->n_7 }}</td>
         <td class="bordered">{{ $item->rr_7 }}</td>
         <td class="bordered">{{ $item->s_7 }}</td>
         <td class="bordered">{{ $item->lainnya_7 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_7  ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr style="text-align: center">
         <td class="bordered">{{ $item->tgl_8 }}</td>
         <td class="bordered">{{ $item->jam_8 }}</td>
         <td class="bordered">0</td>
         <td class="bordered">{{ $item->reaksi_8 }}</td>
         <td class="bordered">{{ $item->keluhan_8 }}</td>
         <td class="bordered">{{ $item->td_8 }}</td>
         <td class="bordered">{{ $item->n_8 }}</td>
         <td class="bordered">{{ $item->rr_8 }}</td>
         <td class="bordered">{{ $item->s_8 }}</td>
         <td class="bordered">{{ $item->lainnya_8 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_8 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
   </table>


   <!-- 5 -->
   <br>
   <table width="100%" class="bordered">
      <tr>
         <th colspan="6" class="bordered" style="text-align: left">Obat-obatan yang diberikan setelah transfusi</th>
      </tr>
      <tr style="text-align: center">
         <td width="30%" class="bordered">Nama Obat</td>
         <td width="10%" class="bordered">Dosis Obat</td>
         <td width="10%" class="bordered">Rute Pemberian</td>
         <td width="10%" class="bordered">Waktu Pemberian</td>
         <td width="20%" class="bordered">Nama Perawat</td>
         <td width="20%" class="bordered">Paraf</td>
      </tr>
      <tr>
         @php
            $obat = \App\Models\Farmasi\ItemsTemplate::find($item->nama_obat_transfusi_1 ?? ''); 
         @endphp
         <td class="bordered">{{ $obat->nama }}</td>
         <td class="bordered">{{ $item->dosis_obat_transfusi_1 }}</td>
         <td class="bordered">{{ $item->rute_pemberian_transfusi_1 }}</td>
         <td class="bordered">{{ $item->waktu_pemberian_transfusi_1 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_1 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered text-center">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr>
         @php
            $obat = \App\Models\Farmasi\ItemsTemplate::find($item->nama_obat_transfusi_2 ?? ''); 
         @endphp
         <td class="bordered">{{ $obat->nama }}</td>
         <td class="bordered">{{ $item->dosis_obat_transfusi_2 }}</td>
         <td class="bordered">{{ $item->rute_pemberian_transfusi_2 }}</td>
         <td class="bordered">{{ $item->waktu_pemberian_transfusi_2 }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_2 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered text-center">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
      <tr>
         @php
            $obat = \App\Models\Farmasi\ItemsTemplate::find($item->nama_obat_transfusi_3 ?? ''); 
         @endphp
         <td class="bordered">{{ $obat->nama ?? '' }}</td>
         <td class="bordered">{{ $item->dosis_obat_transfusi_3 ?? '' }}</td>
         <td class="bordered">{{ $item->rute_pemberian_transfusi_3 ?? '' }}</td>
         <td class="bordered">{{ $item->waktu_pemberian_transfusi_3 ?? '' }}</td>
         @php
            $perawat = \App\User::find($item->nama_perawat_transfusi_3 ?? '');
         @endphp
         <td class="bordered">{{ $perawat->name }}</td>
         <td class="bordered text-center">
            @if (!empty($perawat->ttd))
            <img src="{{asset($perawat->ttd)}}" style="width: 20px; max-width: 20px">
            @endif
         </td>
      </tr>
   </table>

   <br>
   <br>
   <br>
   <br>
   <table width="100%" class="bordered">
      <tr style="text-align: center">
         <td class="bordered" width="50%"><b>Tanda Reaksi Transfusi</b></td>
         <td class="bordered" width="50%"><b>Langkah yang Dilakukan Pada Reaksi Transfusi</b></td>
      </tr>
      <tr>
         <td width="50%" class="borderd">
            <table>
               <tr><td>1. Urtikaria</td></tr>
               <tr><td>2. Demam</td></tr>
               <tr><td>3. Gatal</td></tr>
               <tr><td>4. Takikardia</td></tr>
               <tr><td>5. Hemoglobinuria</td></tr>
               <tr><td>6. Nyeri dada</td></tr>
               <tr><td>7. Nyeri kepala</td></tr>
               <tr><td>8. Sesak</td></tr>
               <tr><td>9. Syok</td></tr>
            </table>
         </td>
         <td class="bordered" width="50%">
            <table>
               <tr><td>1. Stop transfusi darah, ganti infus set dan berikan NaCl 0,9% 100 ml, cek tanda vital</td></tr>
               <tr><td>2. Lapor DPJP/dokter pemberi instruksi</td></tr>
               <tr><td>3. Lakukan prosedur penanganan pasien reaksi transfusi sesuai dengan instruksi dokter yang memberikan transfusi</td></tr>
               <tr><td>4. Kirim ke laborat :
                  Form reaksi transfusi yang telah diisi
                  Sisa darah dalam kantong darah yang telah ditransfusikan pada pasien
                  Sampel darah pasien sebanyak 3-5 ml dalam tabung EDTA yang berisi antikoagula
               </td></tr>
            </table>
         </td>
      </tr>
   </table>

   <!-- 6 -->
   <table>
      <tr><td>* diisi dengan ya atau tidak (ada reaksi transfusi)</td></tr>
      <tr><td>** warna, jumlah produksi urin, dll</td></tr>
   </table>
  
</body>
</html>