<html>
<head>
    <style type="text/css">
    td, body, th{
        font-size: 14px;
    }
    table {
        border-collapse: collapse;
        text-align: left;
        font-size: 10px;
    }

    th, td {
        border: 1px solid black;
        padding:10px 5px;
    }

    table.borderless th,
    table.borderless td{
        border:none;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    table.nopadding tr th {
      padding: 5px 5px;
    }

    table.nopadding tr td {
      padding: 0 0;
    }

    .center
    {
        text-align: center;
    }
    .bold
    {
        font-weight: 700;
    }
    .underline
    {
        text-decoration: underline;
    }
    .box
    {
        border:solid 1px #000;
    }

    .belum_ada {
      font-style: italic;
    }
</style>
</head>
<body>
    <div class="center bold">{{config('app.name')}}</div>
    <hr>
    <div class="underline center bold" style="margin-top: 20px">LAPORAN OPERASI</div>
    <table class="borderless">
        <tr style="padding-bottom: 0">
            <th style="text-align: left">Nama pasien</th>
            @if(!empty($transaksi->parent))
            <td>{{$transaksi->parent->pasien_detail->name}}</td>
            @else
            <td>{{$transaksi->pasien_detail->name}}</td>
            @endif
        </tr>
        <tr>
            <th style="text-align: left">Tanggal Lahir</th>
            @if(!empty($transaksi->parent))
            <td>{{ \Carbon\Carbon::parse($transaksi->parent->pasien_detail->date_of_birth)->format('d-m-Y')}},
              {{$transaksi->parent->pasien_detail->age}}</td>
            @else
            <td>{{ \Carbon\Carbon::parse($transaksi->pasien_detail->date_of_birth)->format('d-m-Y')}},
              {{$transaksi->pasien_detail->age}} Tahun</td>
            @endif
        </tr>
        <tr>
            <th style="text-align: left">Jenis Kelamin</th>
            @if(!empty($transaksi->parent))
            <td>{{$transaksi->parent->pasien_detail->gender == 1 ? 'Laki laki' : 'Perempuan'}}</td>
            @else
            <td>{{$transaksi->pasien_detail->gender == 1 ? 'Laki laki' : 'Perempuan'}}</td>
            @endif
        </tr>
        <tr>
            <th style="text-align: left">No Rekam Medis</th>
            @if(!empty($transaksi->parent))
            <td>{{$transaksi->parent->pasien_detail->no_rm}}</td>
            @else
            <td>{{$transaksi->pasien_detail->no_rm}}</td>
            @endif
        </tr>
    </table>
    <div class="box" style="margin-top: 20px">
        <table class="borderless center nopadding" style="width: 100%">
            <tr>
                @foreach ($peran as $item)
                    <th>
                     {{$item->nama}}
                    </th>
                  @endforeach
            </tr>
            <tr>
            @foreach ($peran as $peran_item)
                <td>
                @foreach($peran_item->members as $member)

                    {{$member->detail->name}}
                    <br>

                @endforeach
                </td>
            @endforeach
            </tr>
        </table>
        <table class="borderless" style="width: 100%">
            <tr>
                <th style="width: 40%">&nbsp;</th>
                <th style="width: 2%">
                <th style="width: 58%">&nbsp;</th>
            </tr>
            <tr>
                <td>Diagnosis Pra Bedah</td>
                <td>:</td>
                <td>{{$transaksi->hasil->diagnosis_awal}}</td>
            </tr>
            <tr>
                <td>Diagnosis Pasca Bedah</td>
                <td>:</td>
                <td>{{$transaksi->hasil->diagnosis_akhir}}</td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td colspan="2"><span class="underline">Jaringan Yang di Incisi</span></td>
            <tr>
                <td>Persiapan</td>
                <td>:</td>
                <td>{{$transaksi->hasil->persiapan}}</td>
            </tr>
            <tr>
                <td>Posisi Pasien</td>
                <td>:</td>
                <td>{{$transaksi->hasil->posisi}}</td>
            </tr>
            <tr>
                <td>Desinfeksi</td>
                <td>:</td>
                <td>{{$transaksi->hasil->disinfektan}}</td>
            </tr>
            <tr>
                <td>Insis</td>
                <td>:</td>
                <td>{{$transaksi->hasil->incisi}}</td>
            </tr>
            <tr>
                <td>Temuan Operasi</td>
                <td>:</td>
                <td>{{$transaksi->hasil->temuan_operasi}}</td>
            </tr>
            <tr>
                <td>Tindakan</td>
                <td>:</td>
                <td>{{$transaksi->hasil->tindakan}}</td>
            </tr>
            <tr>
                <td>Pendarahan</td>
                <td>:</td>
                <td>{{$transaksi->hasil->pendarahan}}</td>
            </tr>
            <tr>
                <td>Advice</td>
                <td>:</td>
                <td>{{$transaksi->hasil->advice_post  }}</td>
            </tr>
            <tr>
                <td>Pemeriksaan PA</td>
                <td>:</td>
                <td>{{$transaksi->hasil->pemeriksaan_pa  }}</td>
            </tr>
            <tr>
                <td>Jenis Operasi</td>
                <td>:</td>
                <td>{{$transaksi->hasil->jenis->nama  }}</td>
            </tr>
            <tr>
                <td>Status Pasien</td>
                <td>:</td>
                <td>{{$transaksi->hasil->status_pasien ?? '-'  }}</td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
        </table>

        <table class="borderless center" style="width: 100%">
            <tr>
                <th style="width: 25%"> Tanggal Operasi </th>
                <th style="width: 25%"> Jam Operasi Dimulai </th>
                <th style="width: 25%"> Jam Operasi Selesai </th>
                <th style="width: 25%"> Lama Anastesi </th>
            </tr>
            <tr>
                <td>{{\Carbon\Carbon::parse($transaksi->hasil->tanggal_operasi)->format('d - m - Y')}}</td>
                <td>{{\Carbon\Carbon::parse($transaksi->hasil->waktu_mulai)->format('H:i')}}</td>
                <td>{{\Carbon\Carbon::parse($transaksi->hasil->waktu_selesai)->format('H:i')}}</td>
                <td>{{\Carbon\Carbon::parse($transaksi->hasil->lama_anastesi)->format('H:i')}}</td>
            </tr>
        </table>

        <table class="borderless center" style="width: 100%">

            <tr>
                <td style="width: 75%">&nbsp;</td>
                <td style="width: 25%">&nbsp;</td>
            </tr>

            <tr>
                <td style="width: 75%">&nbsp;</td>
                <td style="width: 25%"> Paraf Dokter </td>
            </tr>
            <tr>
                <td style="width: 75%">&nbsp;</td>
                @if(!empty($peran[0]->members[0]->detail->ttd))
                <td class="text-center" style="width: 25%"><img src="{{{url('')}}}/{{{$peran[0]->members[0]->detail->ttd}}}" height="50px"></td>
                @else
                <td class="dummy" style="width: 25%">&nbsp;</td>
                @endif
            </tr>
            <tr>
                <td style="width: 75%">&nbsp;</td>
                <td style="width: 25%">{{$peran[0]->members[0]->detail->name ??'.....'}}</td>
            </tr>

        </table>

    </div>

</body>
</html>
