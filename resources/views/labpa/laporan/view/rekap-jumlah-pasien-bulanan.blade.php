<table>
    <thead>
        <tr>
            <th colspan="12">Bulan : {{$bulan}}</th>
        </tr>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Pemeriksaan</th>
            @foreach($perusahaan_tipe as $tipe)
            @if(count($tipe->perusahaan) > 0)
            <th colspan="{{count($tipe->perusahaan)}}">{{$tipe->nama}}</th>
            @endif
            @endforeach
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            @foreach($perusahaan as $item)
            <th>{{$item->nama}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $tarif_kategori)
            <tr>
                <td>{{$loop->iteration}}</td>
                @foreach($tarif_kategori as $item)
                    <td>{{$item}}</td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            @php
                $row_start = 4;
                $row_end = count($data)+3;
            @endphp

            @foreach($perusahaan as $item)
            @php
                $column = excel_column($loop->iteration+2);
            @endphp

            <th>=SUM({{$column}}{{$row_start}}:{{$column}}{{$row_end}}) </th>
            @endforeach
            @php
                $last_column = excel_column(count($perusahaan) + 3)
            @endphp

            <td>=SUM({{$last_column}}{{$row_start}}:{{$last_column}}{{$row_end}})</td>
        </tr>
    </tbody>
</table>
