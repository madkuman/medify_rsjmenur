<table>
    <thead>
        <tr>
            <th></th>
            <th>TRIWULAN {{$triwulan}} {{$tahun}}</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="6" >LAPORAN {{$title}} {{$division}}</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="6">{{config('app.name')}}</th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th rowspan="3">NO</th>
            <th rowspan="3">POLI</th>
            <th rowspan="3">BULAN</th>
            @foreach($perusahaan_tipe as $item)
            <th colspan="{{count($item->perusahaan)*2}}">{{$item->nama}}</th>
            @endforeach
            <th rowspan="2" colspan="2">JUMLAH</th>
            <th rowspan="2" colspan="2">JENIS KELAMIN</th>
            <th rowspan="3">TOTAL</th>
        </tr>
        <tr>
            @foreach($perusahaan as $item)
            <th colspan="2">{{$item->nama}}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($perusahaan as $item)
            <th>BARU</th>
            <th>LAMA</th>
            @endforeach
            <th>BARU</th>
            <th>LAMA</th>
            <th>Laki2</th>
            <th>Perempuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($poli as $index => $poli_item)
            @php $count_index = 0 @endphp
            <tr>
                <th rowspan="4">{{$loop->iteration}}</th>
                <th rowspan="4">{{$poli_item->name}}</th>
                <th>{{$bulan[0]}}</th>
                @for($i=0;$i<$jumlahKolom;$i++)
                <td>{{$laporan[$poli_item->id]['count-'.$count_index++] ?? '0'}}</td>
                @endfor
            </tr>
            @for($bulan_index=1;$bulan_index<3;$bulan_index++)
            <tr>
                <th>{{$bulan[$bulan_index]}}</th>
                @for($i=0;$i<$jumlahKolom;$i++)
                <td>{{$laporan[$poli_item->id]['count-'.$count_index++] ?? '0'}}</td>
                @endfor                
            </tr>
            @endfor
            <tr>
                <th>Jumlah</th>
                @for($i=0;$i<$jumlahKolom;$i++)
                <td>{{$laporan[$poli_item->id]['count-'.$count_index++] ?? '0'}}</td>
                @endfor              
            </tr>
            <tr></tr>
        @endforeach
    </tbody>
</table>
