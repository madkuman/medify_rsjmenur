<style>
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
</style>

<table>
    <thead>
        <tr>
            <th colspan="3">{{config('app.name')}}</th>
        </tr>
        <tr>
            <th colspan="3" style="text-decoration: underline;">BENDAHARA BADAN PENYELENGGARA JAMINAN SOSIAL</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th colspan="4">LAPORAN PENERIMAAN DAN PENGELUARAN</th>                            
        </tr>
        <tr>
            <th colspan="4">DANA BPJS PPK  III {{config('app.name')}}</th>                            
        </tr>
        <tr>
            <th colspan="4">BULAN {{$bulan}}</th>                            
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">URAIAN</th>
            <th>KODE</th>
            <th rowspan="2">PENERIMAAN</th>
        </tr>
        <tr>
            <th>MAP</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>Sisa Bulan Lalu</td>
            <td></td>
            <td>{{$sisa_lalu['total']}}</td>
        </tr>
        @php $layer1 = 1;@endphp
        @foreach($penerimaan as $item)
        @php $layer2 = 'a'; $layer3 = 1; @endphp
            @if($item->layer == 1)
            <tr>
                <td>{{$layer1++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->kode_anggaran}}</td>
                <td>{{$item['total']}}</td>
            </tr>
            @foreach($penerimaan as $item2)
            @php $layer3 = 1; @endphp
                @if($item2->layer == 2 and $item2->parent_id == $item->id)
                <tr>
                    <td></td>
                    <td>&nbsp;{{$layer2++}}. {{$item2->name}}</td>
                    <td>{{$item2->kode_anggaran}}</td>
                    <td>{{$item2['total']}}</td>
                </tr>
                @foreach($penerimaan as $item3)
                    @if($item3->layer == 3 and $item3->parent_id == $item2->id)
                    <tr>
                        <td></td>
                        <td>&nbsp;--- {{$layer3++}}. {{$item3->name}}</td>
                        <td>{{$item3->kode_anggaran}}</td>
                        <td>{{$item3['total']}}</td>
                    </tr>
                    @endif
                @endforeach
                @endif
            @endforeach
            @endif
        @endforeach
        
    </tbody>
    <thead>
        <tr>
            <td></td>
            <td>JUMLAH</td>
            <td></td>
            <td>{{$penerimaan_total['total']}}</td>
        </tr>
    </thead>
    <thead>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">URAIAN</th>
            <th>KODE</th>
            <th rowspan="2">PENGELUARAN</th>
        </tr>
        <tr>
            <th>MAP</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
        </tr>
    </thead>
    <tbody>

        @php $layer1 = 1;@endphp
        @foreach($pengeluaran as $item)
        @php $layer2 = 'a'; $layer3 = 1; @endphp
            @if($item->layer == 1)
            <tr>
                <td>{{$layer1++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->kode_anggaran}}</td>
                <td>{{$item['total']}}</td>
            </tr>
            @foreach($pengeluaran as $item2)
            @php $layer3 = 1; @endphp
                @if($item2->layer == 2 and $item2->parent_id == $item->id)
                <tr>
                    <td></td>
                    <td>&nbsp;{{$layer2++}}. {{$item2->name}}</td>
                    <td>{{$item2->kode_anggaran}}</td>
                    <td>{{$item2['total']}}</td>
                </tr>
                @foreach($pengeluaran as $item3)
                    @if($item3->layer == 3 and $item3->parent_id == $item2->id)
                    <tr>
                        <td></td>
                        <td>&nbsp;--- {{$layer3++}}. {{$item3->name}}</td>
                        <td>{{$item3->kode_anggaran}}</td>
                        <td>{{$item3['total']}}</td>
                    </tr>
                    @endif
                @endforeach
                @endif
            @endforeach
            @endif
        @endforeach
        <tr>
            <td></td>
            <td>Sisa Bulan ini</td>
            <td></td>
            <td>{{$sisa['total']}}</td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <td></td>
            <td>JUMLAH</td>
            <td></td>
            <td>{{$total['total']}}</td>
        </tr>
    </thead>
</table>