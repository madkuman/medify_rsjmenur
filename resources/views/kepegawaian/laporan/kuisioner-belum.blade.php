<table>
    <tr>
        <td colspan="4">LAPORAN HASIL KUISIONER</td>
    </tr>
    <tr>
        <td colspan="4">{{strtoupper($nama->nama)}}</td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td>No</td>
        <td>Profesi</td>
        <td>Nama Pegawai</td>
        <td>NIP / NRP</td>
    </tr>
    
    @foreach($data as $item)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$item->profesi_detail->title ?? '-'}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->employee->nrp ?? '-'}}</td>
    </tr>
    @endforeach
</table>