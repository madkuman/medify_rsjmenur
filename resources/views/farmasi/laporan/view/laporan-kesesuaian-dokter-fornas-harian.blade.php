<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="8">Laporan Kesesuaian {{$jenis_resep}} Dokter Menulis Resep - Harian</th>
        </tr>
        <tr>
            <th colspan="8">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>NO</th>
            <th>NAMA PASIEN</th>
            <th>NO RM</th>
            <th>TGL RESEP</th>
            <th>ASAL</th>
            <th>NAMA DOKTER</th>
            <th>STATUS</th>
            <th>ITEM TIDAK SESUAI</th>
        </tr>
        @foreach($data as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->pasien_detail->name}}</td>
            <td>{{$item->pasien_detail->no_rm}}</td>
            <td>{{$item->created_at->format('d/m/Y')}}</td>
            <td>{{$item->lokasi->nama}}</td>
            <td>{{$item->dokter->name}}</td>
            <td>
                @if($item->$jenis_resep_query)SESUAI
                @else TIDAK SESUAI
                @endif
            </td>

            <td>
                @if(!$item->$jenis_resep_query)
                @foreach($item->final_detail->resep_detail as $detail)
                    @if($detail->$jenis_resep_query == 0  && !empty($detail->obat_detail))
                        @if($detail->obat_detail->item_template->jenis == 'Obat')
                        {{$detail->nama_obat}}<br>
                        @endif
                        @foreach($detail->racikan as $racikan_detail)
                            @if($racikan_detail->$jenis_resep_query == 0)
                                {{$racikan_detail->nama_obat}}<br>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
