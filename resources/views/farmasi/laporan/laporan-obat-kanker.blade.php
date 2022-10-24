<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Obat Kanker</title>
  <style>
    body { 
      font-family: Calibri; 
      color: black 
    }
    .mt-10 {
      margin-top: 10px;
    }
    .mt-20 {
      margin-top: 20px;
    }
    .mt-15 {
      margin-top: 15px;
    }
    .width-40 {
      width: 40%;
    }
    .block {
      /*width: 100%;*/
      /*background-color: red;*/
    }
    .table {
      width: 100%;
    }
    .table, td {
      border-collapse: collapse;
    }
    .table td {
      padding: 10px;
    }
    .bordered {
      border: 1px solid black;
    }
    .bordered td {
      border: 1px solid black;
    }
    .borderless td {
      border: 0 !important;
    }
    .table.pt-4 td {
      padding: 4px;
      font-size: 12px;
    }
    .table.pt-4 td.pt-20 {
      padding: 20px;
    }
  </style>
</head>
<body>

  <div class="block">
    <table class="table bordered">
      <tr>
        <td width="50%" align="center">
          PELAYANAN PENCAMPURAN OBAT KANKER <br> 
          INSTALASI FARMASI {{config('app.name')}}
        </td>
        <td width="20%" align="center">Hari : {{ indonesian_date($transaksi->created_at, 'l') }}</td>
        <td width="30%" align="center">Tanggal : {{ indonesian_date($transaksi->created_at) }}</td>
      </tr>
    </table>
  </div>

  <div class="block mt-15">
    <table class="table pt-4 bordered">
      <tr>
        <td width="20%">
          @if($transaksi->pasien_detail)
          Nama : <br> {{ $transaksi->pasien_detail->name}}
          @else
          Nama : <br> {{$transaksi->nama_pasien ?? 'Pasien Bebas'}}
          @endif
        </td>
        <td width="10%">
          No. RM : <br> {{$transaksi->pasien_detail ? $transaksi->pasien_detail->no_rm : "-"}}
        </td>
        <td width="6%">
          JKel : <br> {{$transaksi->pasien_detail ? ($transaksi->pasien_detail->gender == 1 ? 'L' : 'P'): "-"}}
        </td>
        <td width="14%">
          @php
              $date_of_birth = $transaksi->pasien_detail->date_of_birth ?? '-';
          @endphp          
          Tgl Lahir : <br> {{$transaksi->pasien_detail ? indonesian_date($transaksi->pasien_detail->date_of_birth) : '-'}} ({{$transaksi->pasien_detail->age ?? '-'}} Tahun)
        </td>
        <td width="10%">
          Bb : <br> {{$transaksi->kasus->identitas->berat_badan ?? '-'}}
        </td>
        <td width="10%">
          Tinggi : <br> {{$transaksi->kasus->identitas->tinggi_badan ?? '-'}}
        </td>
        <td width="15%">
          Ruangan : <br> {{ $transaksi->kasus->lokasi->lokasi->nama ?? 'Kemoterapi'}}
        </td>
        <td width="15%">
          Diagnosa : <br> {{$transaksi->kasus->diagnosisUtama->icd10->long_desc ?? '-'}}
        </td>
      </tr>
    </table>
  </div>

  <div class="block mt-15">
    <table class="table pt-4 bordered">
      <tr>
        <td width="20%">
          PROTOKOL
        </td>
        <td width="80%">
          DOKTER PENANGGUNG JAWAB : {{$transaksi->kasus->dpjp->name ?? '-'}}
        </td>
      </tr>
    </table>
  </div>

  <div class="block mt-15">
    <table class="table pt-4 bordered">
      <tr>
        <td width="2%" align="center">No.</td>
        <td width="10%" align="left">Obat</td>
        <td width="10%" align="center">Dosis yang dibutuhkan</td>
        <td width="20%" align="left">Cara Pemberian</td>
        <td width="5%" align="center">Volume Amp/Vial</td>
        <td width="5%" align="center">Jml Amp/Vial</td>
        <td width="5%" align="center">Volume Pelarut</td>
        <td width="10%" align="center">Nama dan Volume Infus</td>
        <td width="5%" align="center">Nama Dagang</td>
        <td width="8%" align="center">Pabrik</td>
        <td width="10%" align="center">No. Batch</td>
        <td width="10%" align="center">Exp. Date</td>
      </tr>
      @foreach($transaksi->final_detail->resep_detail as $i => $detail)
      @foreach($detail->racikan as $kan)
     
      <tr>
        <td width="2%" align="center">{{++$i}}.</td>
        <td width="10%" align="left">{{$kan->obat_detail->item_detail->nama}}</td>
        <td width="10%" align="center">{{$detail->dosis}}</td>
        <td width="20%" align="center">{{$detail->satuan_penggunaan}} {{$detail->lama_pemberian}}</td>
        <td width="5%" align="center">{{$kan->volume}}</td>
        <td width="5%" align="center">{{$kan->jumlah}}</td>
        <td width="5%" align="center">{{$detail->volume_pelarut}}</td>
        <td width="10%" align="center">{{$detail->obat_detail->item_detail->nama ?? '-'}} , {{$detail->volume_infus}}</td>
        <td width="5%" align="center">{{$detail->dagang}}</td>
        <td width="8%" align="center">{{$detail->pabrik}}</td>
        <td width="10%" align="center">{{$detail->batch}}</td>
        <td width="10%" align="center">{{$detail->exp_date}}</td>
      </tr>
      @endforeach
      @endforeach
    </table>
  </div>

  <div class="block mt-15">
    <table class="table pt-4 bordered">
      <tr>
        <td width="2%">No.</td>
        <td width="" colspan="2">KONDISI PENYIMPANAN :</td>
        <td width="" colspan="2">STABILITAS :</td>
      </tr>
      @foreach($transaksi->final_detail->resep_detail as $i => $detail)
      <tr>
        <td width="" align="center">{{$loop->iteration}}.</td>
        <td width="">{{$detail->kondisi}}</td>
        <td width="">{{$detail->penyimpanan}}</td>
        <td width="">{{$detail->stabilitas_time}}</td>
        <td width="">{{$detail->stabilitas_date}}</td>
      </tr>
      @endforeach
    </table>
  </div>

  <div class="block width-40 mt-15">
    <table class="table w-50 pt-4 bordered">
      <tr>
        <td width="50%" height="60" align="left" valign="top">
          OBAT DITERIMA PRODUKSI
          <table class="table mt-20 borderless">
            <tr>
              <td>JAM :</td>
              <td>PARAF :</td>
            </tr>
          </table>
        </td>
        <td width="50%" rowspan="2" align="center" valign="top" class="pt-20">
          APOTEKER <br style="margin-top: 20px;">
          <div class="mt-15">{{session('farmasi')->kasie}}</div>
        </td>
      </tr>
      <tr>
        <td width="50%" height="60" align="left" valign="top">
          OBAT DITERIMA PERAWAT
          <table class="table mt-20 borderless">
            <tr>
              <td>JAM :</td>
              <td>PARAF :</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>

</body>
</html>