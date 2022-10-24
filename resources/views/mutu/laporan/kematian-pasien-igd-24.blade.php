<table>
    <tr>
        <td colspan="7">LAPORAN KEMATIAN PASIEN IGD Kurang Dari 24 JAM</td>
    </tr>
    <tr>
        <td colspan="7" align="center">{{indonesian_date($start)}} - {{indonesian_date($end)}}</td>
    </tr>
    <tr>
        <td align="center"><b>No</b></td>
        <td align="center"><b>No RM</b></td>
        <td align="center"><b>Nama</b></td>
        <td align="center"><b>Tgl Masuk</b></td>
        <td align="center"><b>Tgl Kematian</b></td>
        <td align="center"><b>Lokasi</b></td>
        <td align="center"><b>Score</b></td>
    </tr>
    @foreach($data as $item)
        @if($item->kasus->kurang_dari_24)
            <tr>
                <td align="center">{{$loop->iteration}}</td>
                <td align="center">{{$item->kasus->pasien->no_rm }}</td>
                <td>{{$item->kasus->pasien->name }}</td>
                <td>{{indonesian_date($item->kasus->datangigd_at,'d F Y H:i')}}</td>
                <td>
                    {{ indonesian_date($item->kasus->krs_at,'d F Y H:i') }}
                </td>
                <td align="center">{{$item->ruangan->name}}</td>
                <td align="center">{{$item->kasus->score ?? '-'}}</td>
            </tr>
        @endif
    @endforeach
</table>