<table>
    @for ($i = 0; $i < $page; $i++)
    <thead>
        <tr>
            <th colspan="3">{{config('app.name')}}</th>
            <th colspan="6">&nbsp;</th>
            <td>BENTUK</td>
            <td>: KU-300</td>
        </tr>
        <tr>
            <th colspan="3" style="text-decoration: underline;">DEPARTEMEN</th>
            <td colspan="6">&nbsp;</td>
            <td>HALAMAN</td>
            <td>: {{$i+1}}</td>
        </tr>
        <tr>
            <td colspan="9"></td>
            <td>LEMBAR</td>
            <td>: I, II, III, IV</td>
        </tr>
        <tr>
            <th colspan="11">BUKU KAS - BANK</th>                            
        </tr>
        <tr>
            <th colspan="11">TAHUN ANGGARAN : {{$tahun}}</th>                            
        </tr>
        <tr>
            <th colspan="11" style="text-transform: uppercase;">BULAN : {{$bulan}}</th>                            
        </tr>
        <tr>
            <td>KOTAMA</td>
            <td>: </td>
            <th colspan="9"></th>
        </tr>
        <tr>
            <td>KAKU</td>
            <td>: </td>
            <th colspan="9"></th>
        </tr>
        <tr>
            <td>PEKAS</td>
            <td>: </td>
            <th colspan="9"></th>
        </tr>
        <tr>
            <th rowspan="3">NO BK</th>
            <th rowspan="3">URAIAN</th>
            <th rowspan="3">REF</th>
            <th rowspan="3">DEBET</th>
            <th rowspan="3">KREDIT</th>
            <th rowspan="2" colspan="2">TUNAI</th>
            <th colspan="4">BANK</th>
        </tr>
        <tr>
            <th colspan="2">MANDIRI NO.142.000.400.4148</th>
            <th colspan="2">BNI NO.00.498.350.70</th>
        </tr>
        <tr>
            <th>DEBET</th>
            <th>KREDIT</th>
            <th>DEBET</th>
            <th>KREDIT</th>
            <th>DEBET</th>
            <th>KREDIT</th>
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
        </tr>
    </thead>
    <tbody>
    @if($i == 0)
        <tr>
            <td>PM</td>
            <td>Sisa Bulan Lalu</td>
            <td>&nbsp;</td>
            <td>
                @if($sisa['flag'] == '2')
                    {{$sisa['total']}}
                @endif
            </td>
            <td>
                @if($sisa['flag'] == '1')
                    {{$sisa['total']}}
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    @else
        <tr>
            <td>&nbsp;</td>
            <td>Jumlah Dipindahkan</td>
            <td>&nbsp;</td>
            <td>{{$total[$i-1]['debet']}}</td>
            <td>{{$total[$i-1]['kredit']}}</td>
            <td>{{$total[$i-1]['tunai_debet']}}</td>
            <td>{{$total[$i-1]['tunai_kredit']}}</td>
            <td>{{$total[$i-1]['mandiri_debet']}}</td>
            <td>{{$total[$i-1]['mandiri_kredit']}}</td>
            <td>{{$total[$i-1]['bni_debet']}}</td>
            <td>{{$total[$i-1]['bni_kredit']}}</td>
        </tr>
    @endif
    @for($j = ($i*$perpage); $j < ($i*$perpage)+$perpage; $j++)
    @if ($j<$count)
        <tr>
            <td>{{$j+1}}</td>
            <td>{{$kas[$j]['judul']}}</td>
            <td>&nbsp;</td>
            <td>
                @if($kas[$j]['flag'] == '2')
                    {{$kas[$j]['total']}}
                @endif
            </td>
            <td>
                @if($kas[$j]['flag'] == '1')
                    {{$kas[$j]['total']}}
                @endif
            </td>
            <td>
                @if($kas[$j]['akun']['id']=='1' and $kas[$j]['flag'] == '2')
                    {{$kas[$j]['total']}}
                @endif
            </td>
            <td>
                @if($kas[$j]['akun']['id']=='1' and $kas[$j]['flag'] == '1')
                    {{$kas[$j]['total']}}
                @endif
            </td>
            <td>
                @if($kas[$j]['akun']['id']=='3' and $kas[$j]['flag'] == '2')
                    {{$kas[$j]['total']}}
                @endif
            </td>
            <td>
                @if($kas[$j]['akun']['id']=='3' and $kas[$j]['flag'] == '1')
                    {{$kas[$j]['total']}}
                @endif
            </td><td>
                @if($kas[$j]['akun']['id']=='2' and $kas[$j]['flag'] == '2')
                    {{$kas[$j]['total']}}
                @endif
            </td>
            <td>
                @if($kas[$j]['akun']['id']=='2' and $kas[$j]['flag'] == '1')
                    {{$kas[$j]['total']}}
                @endif
            </td>
        </tr>
    @endif
    @endfor
    </tbody>
    <thead>
    @if($i == $page - 1)
        <tr>
            <th>&nbsp;</th>
            <th>TOTAL</th>
            <th>&nbsp;</th>
            <td>{{$total[$i]['debet']}}</td>
            <td>{{$total[$i]['kredit']}}</td>
            <td>{{$total[$i]['tunai_debet']}}</td>
            <td>{{$total[$i]['tunai_kredit']}}</td>
            <td>{{$total[$i]['mandiri_debet']}}</td>
            <td>{{$total[$i]['mandiri_kredit']}}</td>
            <td>{{$total[$i]['bni_debet']}}</td>
            <td>{{$total[$i]['bni_kredit']}}</td>
        </tr>
    @else
        <tr>
            <th>&nbsp;</th>
            <th>JUMLAH DIPINDAHKAN</th>
            <th>&nbsp;</th>
            <td>{{$total[$i]['debet']}}</td>
            <td>{{$total[$i]['kredit']}}</td>
            <td>{{$total[$i]['tunai_debet']}}</td>
            <td>{{$total[$i]['tunai_kredit']}}</td>
            <td>{{$total[$i]['mandiri_debet']}}</td>
            <td>{{$total[$i]['mandiri_kredit']}}</td>
            <td>{{$total[$i]['bni_debet']}}</td>
            <td>{{$total[$i]['bni_kredit']}}</td>
        </tr>
    @endif
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    @endfor
</table>