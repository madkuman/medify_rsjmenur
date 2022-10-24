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
            <th colspan="{{$column['num']+3}}">LAPORAN REKAP PENGELUARAN</th>                            
        </tr>
        <tr>
            <th colspan="{{$column['num']+3}}">DANA BPJS PPK  III {{config('app.name')}}</th>                            
        </tr>
        <tr>
            <th colspan="{{$column['num']+3}}">BULAN : {{$bulan}}</th>                            
        </tr>
        <tr>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th rowspan="4">NO</th>
            <th rowspan="4">URAIAN</th>
            @foreach($kategori_par1 as $kat)
                @if(count($kat->child)>0)
                    @php $col = 0; @endphp
                    @foreach($kategori_par2 as $kat2)
                        @if($kat2->parent_id == $kat->id and count($kat2->child)>0)
                            @php $col = $col+count($kat2->child); @endphp
                        @elseif ($kat2->parent_id == $kat->id)
                            @php $col = $col+1; @endphp
                        @endif
                    @endforeach
                    <th colspan="{{$col}}">{{$kat->name}}</th>
                @else
                    <th rowspan="3">{{$kat->name}}</th>
                @endif
            @endforeach
            <th rowspan="4">JUMLAH</th>
        </tr>
        <tr>
            @foreach($kategori_par1 as $kat)
                @if(count($kat->child)>0)
                    @php $col = 0; @endphp
                    @foreach($kategori_par2 as $kat2)
                        @if($kat2->parent_id == $kat->id and count($kat2->child)>0)
                            <th colspan="{{count($kat2->child)}}">{{$kat2->name}}</th>
                        @elseif ($kat2->parent_id == $kat->id)
                            <th rowspan="2">{{$kat2->name}}</th>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- @foreach($kategori_par2 as $kat)
            @if(count($kat->child)>0)
            <th colspan="{{count($kat->child)}}">{{$kat->name}}</th>
            @else
            <th rowspan="2">{{$kat->name}}</th>
            @endif
            @endforeach --}}
        </tr>
        <tr>
            @foreach($kategori_par3 as $kat)
            <th>{{$kat->name}}</th>
            @endforeach 
        </tr> 
        <tr>
            @foreach($kategori_par1 as $kat)
                @if(count($kat->child)>0)
                    @foreach($kategori_par2 as $kat2)
                        @if($kat2->parent_id == $kat->id and count($kat2->child)>0)
                            @foreach($kategori_par3 as $kat3)
                                @if($kat3->parent_id == $kat2->id)
                                    <th>{{$kat3->kode_anggaran}}</th>
                                @endif
                            @endforeach
                        @elseif($kat2->parent_id == $kat->id)
                            <th>{{$kat2->kode_anggaran}}</th>
                        @endif
                    @endforeach
                @else
                    <th>{{$kat->kode_anggaran}}</th>
                @endif
            @endforeach  
            <th></th>
        </tr>          
        <tr>
            @for ($i=1;$i<=$column['num']+3;$i++)
            <th>{{$i}}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($pengeluaran as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->judul}}</td>
            @for ($i=1;$i<=$column['num'];$i++)
                @if(in_array($column[$i], $kategori_pajak))
                    @if(count($item->detail))
                        @foreach($item->detail as $detail)
                            @if($column[$i]==$detail->kategori_id)
                                @if($detail->jumlah > 0)
                                    <td>{{$detail->jumlah}}</td>
                                @else
                                    <td>-</td>
                                @endif
                            @endif
                        @endforeach
                    @else
                        <td>-</td>
                    @endif
                @else
                    @if($column[$i]==$item->kategori_id)
                        <td>{{$item->dibayarkan}}</td>
                    @else
                        <td>-</td>
                    @endif
                @endif
            @endfor
            <td>{{$item->total}}</td>
        </tr>
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td></td>
            <td>JUMLAH</td>
            @for ($i=1;$i<=$column['num'];$i++)
                <td>{{$total[$i]}}</td>
            @endfor
            <td>{{$total['total']}}</td>
        </tr>
    </thead>
</table>