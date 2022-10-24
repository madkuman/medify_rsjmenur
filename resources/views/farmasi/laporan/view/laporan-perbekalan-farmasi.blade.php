<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">LAPORAN MUTASI STOK</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Periode : {{indonesian_date($date_start,'d F Y')}} - {{indonesian_date($date_end,'d F Y')}}</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Farmasi : {{$farmasi_names}}</th>
        </tr>
        <tr>
            <th colspan="{{$count_column}}">Kategori : {{$kategori_names}}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">NAMA BARANG</th>
            <th rowspan="2">SATUAN</th>
            <th rowspan="2">KADALUARSA</th>
            <th rowspan="2">HARGA SATUAN</th>
            <th colspan="4">STOK AWAL</th>
            <th colspan="4">PEMASUKAN</th>
            <th colspan="4">PENGELUARAN / PEMAKAIAN</th>
            <th colspan="4">PENYESUAIAN</th>
            <th colspan="4">STOK AKHIR</th>
        </tr>
        <tr>
            @for($i=0;$i<5;$i++)
            <th>JUMLAH</th>
            <th>NILAI (RP)</th>
            <th>TOTAL STOK</th>
            <th>TOTAL NILAI (RP)</th>
            @endfor
        </tr>
        @php $last_item = '' @endphp
        @php $total_data = count($data) @endphp
        @php $row_span = 0 @endphp
        @php $row = 9 @endphp
        @php $echo_sum = 0 @endphp

        @foreach($data as $index => $item)

        @if($last_item != $item->nama)
            @php $last_item = $item->nama @endphp
            @php $row_span = 1 @endphp
            @for($i=$index+1;$i<$total_data;$i++)
                @if($data[$i]->nama == $last_item)
                    @php $row_span++ @endphp
                @else
                    @php break; @endphp
                @endif   
            @endfor
            @php $echo_sum = 1 @endphp
        @else
        @php $echo_sum = 0 @endphp
        @endif

        @php $harga = empty($item->harga_saat_itu) ? $item->harga : $item->harga_saat_itu @endphp

        <tr>
            <td>{{$loop->iteration}}</td>
            @if($echo_sum)
                <td rowspan="{{$row_span}}">{{$item->nama}}</td>
            @endif  
            @if($echo_sum)
                <td rowspan="{{$row_span}}">{{$item->satuan}}</td>
            @endif  
            <td>{{indonesian_date($item->kadaluarsa,'d-m-Y')}}</td>
            <td>{{$harga}}</td>
            <td>{{$item->stok_awal}}</td>
            {{-- stok awal --}}
            <td>{{$harga * $item->stok_awal}}</td>
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(F{{$row}}:F{{$row+$row_span - 1}})</td>
            @endif  
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(G{{$row}}:G{{$row+$row_span - 1}})</td>
            @endif

            {{-- pemasukan --}}
            <td>{{$item->penerimaan}}</td>
            <td>{{$harga * $item->penerimaan}}</td>
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(J{{$row}}:J{{$row+$row_span - 1}})</td>
            @endif  
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(K{{$row}}:K{{$row+$row_span - 1}})</td>
            @endif

            {{-- pemakaian --}}
            <td>{{$item->pemakaian}}</td>
            <td>{{$harga * $item->pemakaian}}</td>
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(N{{$row}}:N{{$row+$row_span - 1}})</td>
            @endif
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(O{{$row}}:O{{$row+$row_span - 1}})</td>
            @endif

            {{-- pemakaian --}}
            <td>{{$item->penyesuaian}}</td>
            <td>{{$harga * $item->penyesuaian}}</td>
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(R{{$row}}:R{{$row+$row_span - 1}})</td>
            @endif
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(S{{$row}}:S{{$row+$row_span - 1}})</td>
            @endif

            {{-- stok akhir --}}
            <td>{{$item->stok_akhir}}</td>
            <td>{{$harga * $item->stok_akhir}}</td>
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(V{{$row}}:V{{$row+$row_span - 1}})</td>
            @endif
            @if($echo_sum)
                <td rowspan="{{$row_span}}">=SUM(W{{$row}}:W{{$row+$row_span - 1}})</td>
            @endif
        </tr>
        @php $row++ @endphp
        @endforeach
        <tr>
            <th colspan="3">TOTAL</th>
            @for($i=4;$i<=$count_column;$i++)
            @php $current_column = excel_column($i) @endphp
            <th>=SUM({{$current_column}}9:{{$current_column}}{{$last_row-1}})</th>
            @endfor
        </tr>
    </tbody>
</table>
