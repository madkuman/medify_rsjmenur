<table>
    <thead>
        <tr>
            <th colspan="8" >LAPORAN DATA KEMATIAN</th>
        </tr>
        <tr style="text-transform: uppercase;">
            <th colspan="8" >TEMPAT LAYANAN - {{$lokasi}}</th>
        </tr>
        <tr>
            <th colspan="8" style="text-transform: uppercase;">{{$start->format('d-m-Y')}} s/d {{$end->format('d-m-Y')}}</th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Umur</th>
            <th>Alamat</th>
            <th>Tgl MRS</th>
            <th>Meninggal</th>
            <th>Jam</th>
            <th>Sebab Kematian</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($laporan))
        @foreach($laporan as $idx => $pasien)
        <tr>
            <th>{{$idx+1}}</th>
            <th>{{$pasien['nama']}}</th>
            <th>{{$pasien['umur']}}</th>
            <th>{{$pasien['alamat']}}</th>
            <th>{{$pasien['mrs']}}</th>
            <th>{{$pasien['tgl_meninggal']}}</th>
            <th>{{$pasien['jam']}}</th>
            <td>
                @if(!empty($pasien['sebab']))
                @foreach($pasien['sebab'] as $sebab)
                - {!!$sebab!!} 
                <br style="mso-data-placement:same-cell;" />
                @endforeach
                @else
                -
                @endif
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
