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
            <th colspan="16">PENERIMAAN DAN PENGELUARAN BPJS {{config('app.name')}}</th>                            
        </tr>
        <tr>
            <th colspan="16">TAHUN ANGGARAN : {{$tahun}}</th>                            
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">URAIAN</th>
            <th>KODE</th>
            <th rowspan="2">JANUARI</th>
            <th rowspan="2">FEBRUARI</th>
            <th rowspan="2">MARET</th>
            <th rowspan="2">APRIL</th>
            <th rowspan="2">MEI</th>
            <th rowspan="2">JUNI</th>
            <th rowspan="2">JULI</th>
            <th rowspan="2">AGUSTUS</th>
            <th rowspan="2">SEPTEMBER</th>
            <th rowspan="2">OKTOBER</th>
            <th rowspan="2">NOVEMBER</th>
            <th rowspan="2">DESEMBER</th>
            <th rowspan="2">JUMLAH</th>
        </tr>
        <tr>
            <th>MAP</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>PENERIMAAN</td>
            <td></td>
            @for($i=1;$i<=12;$i++)
            <td>{{$penerimaan_total[$i]}}</td>
            @endfor
            <td>{{$penerimaan_total['total']}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Sisa Bulan Lalu</td>
            <td></td>
            <td>-</td>
            @for($i=2;$i<=12;$i++)
            <td>{{$sisa[$i-1]}}</td>
            @endfor
            <td>{{$sisa['total'] - $sisa[1]}}</td>
        </tr>
        @php $layer1 = 1;@endphp
        @foreach($penerimaan as $item)
        @php $layer2 = 'a'; $layer3 = 1; @endphp
            @if($item->layer == 1)
            <tr>
                <td>{{$layer1++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->kode_anggaran}}</td>
                @for($i=1;$i<=12;$i++)
                <td>{{$item[$i]}}</td>
                @endfor
                <td>{{$item['total']}}</td>
            </tr>
            @foreach($penerimaan as $item2)
            @php $layer3 = 1; @endphp
                @if($item2->layer == 2 and $item2->parent_id == $item->id)
                <tr>
                    <td></td>
                    <td>&nbsp;{{$layer2++}}. {{$item2->name}}</td>
                    <td>{{$item2->kode_anggaran}}</td>
                    @for($i=1;$i<=12;$i++)
                    <td>{{$item2[$i]}}</td>
                    @endfor
                    <td>{{$item2['total']}}</td>
                </tr>
                @foreach($penerimaan as $item3)
                    @if($item3->layer == 3 and $item3->parent_id == $item2->id)
                    <tr>
                        <td></td>
                        <td>&nbsp;--- {{$layer3++}}. {{$item3->name}}</td>
                        <td>{{$item3->kode_anggaran}}</td>
                        @for($i=1;$i<=12;$i++)
                        <td>{{$item3[$i]}}</td>
                        @endfor
                        <td>{{$item3['total']}}</td>
                    </tr>
                    @endif
                @endforeach
                @endif
            @endforeach
            @endif
        @endforeach
        <tr>
            @for($i=1;$i<=16;$i++)
            <td> </td>
            @endfor
        </tr>
        <tr>
            <td></td>
            <td>PENGELUARAN</td>
            <td></td>
            @for($i=1;$i<=12;$i++)
            <td>{{$pengeluaran_total[$i]}}</td>
            @endfor
            <td>{{$pengeluaran_total['total']}}</td>
        </tr>
        @php $layer1 = 1;@endphp
        @foreach($pengeluaran as $item)
        @php $layer2 = 'a'; $layer3 = 1; @endphp
            @if($item->layer == 1)
            <tr>
                <td>{{$layer1++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->kode_anggaran}}</td>
                @for($i=1;$i<=12;$i++)
                <td>{{$item[$i]}}</td>
                @endfor
                <td>{{$item['total']}}</td>
            </tr>
            @foreach($pengeluaran as $item2)
            @php $layer3 = 1; @endphp
                @if($item2->layer == 2 and $item2->parent_id == $item->id)
                <tr>
                    <td></td>
                    <td>&nbsp;{{$layer2++}}. {{$item2->name}}</td>
                    <td>{{$item2->kode_anggaran}}</td>
                    @for($i=1;$i<=12;$i++)
                    <td>{{$item2[$i]}}</td>
                    @endfor
                    <td>{{$item2['total']}}</td>
                </tr>
                @foreach($pengeluaran as $item3)
                    @if($item3->layer == 3 and $item3->parent_id == $item2->id)
                    <tr>
                        <td></td>
                        <td>&nbsp;--- {{$layer3++}}. {{$item3->name}}</td>
                        <td>{{$item3->kode_anggaran}}</td>
                        @for($i=1;$i<=12;$i++)
                        <td>{{$item3[$i]}}</td>
                        @endfor
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
            @for($i=1;$i<=12;$i++)
            <td>{{$sisa[$i]}}</td>
            @endfor
            <td>{{$sisa['total']}}</td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <td></td>
            <td>JUMLAH</td>
            <td></td>
            @for($i=1;$i<=12;$i++)
            <td>{{$total[$i]}}</td>
            @endfor
            <td>{{$total['total']}}</td>
        </tr>
    </thead>
</table>