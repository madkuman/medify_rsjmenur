<table>
    <thead>
        <tr>
            <th colspan="16" >LAPORAN PASIEN KRS</th>
        </tr>
        <tr>
            <th colspan="16" style="text-transform: uppercase;">TEMPAT LAYANAN - {{$lokasi}}</th>
        </tr>
        <tr>
            <th colspan="16" style="text-transform: uppercase;">{{$start->format('d-m-Y')}} s/d {{$end->format('d-m-Y')}}</th>
        </tr>
        <tr>
            <th colspan="16" style="text-transform: uppercase;">{{config('app.name')}}</th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>No. RM</th>
            <th>Alamat</th>
            <th>Jenis Bayar</th>
            <th>Kelas Bayar</th>
            <th>No. Asuransi</th>
            <th>No. SEP</th>
            <th>Lokasi</th>
            <th>DPJP</th>
            <th>Diagnosis</th>
            <th>Tindakan</th>
            <th>Tgl MRS</th>
            <th>Tgl KRS</th>
            <th>Status Keluar RS</th>
            <th>Alasan Keluar RS</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($laporan))
        @foreach($laporan as $idx => $pasien)
        <tr>
            <td>{{$idx+1}}</td>
            <td>{{$pasien['nama']}}</td>
            <td>{{$pasien['no_rm']}}</td>
            <td>{{$pasien['alamat']}}</td>
            <td>{{$pasien['jenis_bayar']}}</td>
            <td>{{$pasien['kelas_bayar']}}</td>
            <td>{{$pasien['no_asuransi']}}</td>
            <td>{{$pasien['no_sep']}}</td>
            <td>{{$pasien['lokasi']}}</td>
            <td>{{$pasien['dpjp']}}</td>
            <td>
                @if(!empty($pasien['diagnosis']))
                @foreach($pasien['diagnosis'] as $diagnosis)
                - {{$diagnosis}}
                <br style="mso-data-placement:same-cell;" />
                @endforeach
                @else
                -
                @endif
            </td>
            <td>
                @if(!empty($pasien['tindakan']))
                @foreach($pasien['tindakan'] as $tindakan)
                - {{$tindakan}}
                <br style="mso-data-placement:same-cell;" />
                @endforeach
                @else
                -
                @endif
            </td>
            <td>{{$pasien['mrs_at']}}</td>
            <td>{{$pasien['krs_at']}}</td>
            <td>{{$pasien['krs_status']}}</td>
            <td>{{$pasien['krs_alasan']}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
