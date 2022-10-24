<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="8">LAPORAN RESPONSE TIME HARIAN</th>
        </tr>
        <tr>
            <th colspan="8">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="8">Farmasi : {{$farmasi}}</th>
        </tr>
        <tr>
            <th colspan="8">Asal Pelayanan : {{$lokasi}}</th>
        </tr>
        <tr>
            <th colspan="8">
                Jenis Resep :
                @if($jenis_resep == 'all') Semua
                @elseif($jenis_resep == 'racikan') Racikan
                @elseif($jenis_resep == 'non-racikan') Non Racikan
                @endif
            </th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>NO</th>
            <th>Dokter</th>
            <th>NAMA PASIEN</th>
            <th>NO RM</th>
            <th>ASAL</th>
            <th>RESEP</th>
            <th>JAM MASUK</th>
            <th>JAM SELESAI</th>
            <th>RESPON TIME</th>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ empty($item->dokter_nama) ? '-' : $item->dokter_nama}}</td>
            <td>{{$item->pasien_detail->name}}</td>
            <td>{{$item->pasien_detail->no_rm}}</td>
            <td>{{$item->lokasi->nama}}</td>
            <td>
                @foreach($item->final_detail->resep_detail as $detail)
                {{$detail->nama_obat}}
                @if(!$loop->last)<br>@endif
                @endforeach
            </td>
            <td>{{!empty($item->dikerjakan_at) ? date('H:i',strtotime($item->dikerjakan_at)) : '-'}}</td>
            <td>{{!empty($item->lima_benar_at) ? date('H:i',strtotime($item->lima_benar_at)) : '-'}}</td>
            <td>
                @php
                    $diff = 0;
                    if(!empty($item->dikerjakan_at) && !empty($item->lima_benar_at)){
                        $diff = $item->dikerjakan_at->diffInMinutes($item->lima_benar_at);
                    }
                @endphp
                {{$diff}}
            </td>
        </tr>
        @endforeach
        <tr>
            <th colspan="8">RERATA</th>
            <th>=AVERAGE(I9:I{{$last_row-1}})</th>
        </tr>
    </tbody>
</table>
