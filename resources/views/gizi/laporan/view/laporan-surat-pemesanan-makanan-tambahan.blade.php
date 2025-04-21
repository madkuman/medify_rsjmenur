<table>
    <tr>
        <td colspan="10">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="10">RUMAH SAKIT JIWA MENUR PROVINSI JAWA TIMUR</td>
    </tr>

    <tr>
        <td colspan="10">INSTALASI GIZI</td>
    </tr>
    <tr>
        <td colspan="10"></td>
    </tr>
    <tr>
        <td colspan="10">SURAT PEMESANAN MAKANAN</td>
    </tr>
    <tr>
        <td colspan="10"></td>
    </tr>
    <tr>
        <td></td>
        <td>TANGGAL</td>
        <td colspan="3">: {{ indonesian_date(strtotime($date)) }}</td>
    </tr>
    <tr>
        <td></td>
        <td>WAKTU MAKAN</td>
        <td colspan="3">: {{ $waktu_makan->nama }}</td>
    </tr>
    <tr>
        <td colspan="10"></td>
    </tr>
    <tr>
        <td rowspan="4">NO</td>
        <td rowspan="4">JENIS MAKANAN</td>
        <td colspan="{{ $colspan * 2 }}">RUANGAN DAN KELAS PERAWATAN</td>
        <td rowspan="3" colspan="2">JML</td>
        <td rowspan="4">TTL</td>
    </tr>
    <tr>
        @foreach ($kelas as $index => $item)
            <td colspan="{{ count($item['bangsal_ids']) * 2 }}">{{ $index }}</td>
        @endforeach
    </tr>
    <tr>
        @foreach ($kelas as $index => $item)
            @foreach ($item['bangsal_nama'] as $value)
                <td colspan="2">{{ strtoupper($value) }}</td>
            @endforeach
        @endforeach
    </tr>
    <tr>
        @foreach ($kelas as $index => $item)
            @foreach ($item['bangsal_nama'] as $value)
                <td>L</td>
                <td>P</td>
            @endforeach
        @endforeach
        <td>L</td>
        <td>P</td>
    </tr>
    @php
        $no = 0;
        $start_row = 14;
        $end_row = $start_row;
    @endphp
    @foreach ($data_utama as $index => $item)
        <tr>
            <td>{{ ++$no }}</td>
            <td>{{ $index }}</td>
            @foreach ($item as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
        @if ($loop->last)
            <tr>
                <td></td>
                <td>JUMLAH PER GENDER</td>
                @php $column = 'C' @endphp
                @foreach ($item as $value)
                    <td>=SUM({{ $column }}{{ $start_row }}:{{ $column }}{{ $end_row }})</td>
                    @php $column++ @endphp
                @endforeach
            </tr>
            <tr>
                <td></td>
                <td>TOTAL</td>
                @php
                    $column1 = 'C';
                    $column2 = 'D';
                @endphp
                @for ($i = 0; $i < count($item) / 2 - 1; $i++)
                    <td colspan="2">
                        ={{ $column1 }}{{ $end_row + 1 }}+{{ $column2 }}{{ $end_row + 1 }}</td>
                    @php
                        $column1++;
                        $column2++;
                    @endphp
                    @php
                        $column1++;
                        $column2++;
                    @endphp
                @endfor
                <td>={{ $column1 }}{{ $end_row + 1 }}+{{ $column2 }}{{ $end_row + 1 }}</td>
            </tr>
        @endif
        @php $end_row++ @endphp
    @endforeach

    @php
        $end_row += 2;
        $start_row = $end_row;
        $end_row = $start_row;
    @endphp

    {{-- @foreach ($data_tambahan as $index => $item)
        <tr>
            @if ($loop->iteration == 1)
            <td>{{++$no}}</td>
            @else
                <td></td>
            @endif
            <td>{{$index}}</td>
            @foreach ($item as $value)
                <td>{{$value}}</td>
            @endforeach
        </tr>
        @if ($loop->last)
            <tr>
                <td></td>
                <td>JUMLAH PER GENDER</td>
                @php $column = 'C' @endphp
                @foreach ($item as $value)
                    <td>=SUM({{$column}}{{$start_row}}:{{$column}}{{$end_row}})</td>
                    @php $column++ @endphp
                @endforeach
            </tr>
            <tr>
                <td></td>
                <td>TOTAL</td>
                @php $column1 = 'C'; $column2= 'D'; @endphp
                @for ($i = 0; $i < count($item) / 2 - 1; $i++)
                    <td colspan="2">={{$column1}}{{$end_row+1}}+{{$column2}}{{$end_row+1}}</td>
                    @php $column1++;$column2++ @endphp
                    @php $column1++;$column2++ @endphp
                @endfor
                    <td>={{$column1}}{{$end_row+1}}+{{$column2}}{{$end_row+1}}</td>
            </tr>
        @endif
        @php $end_row++ @endphp
    @endforeach --}}
</table>
