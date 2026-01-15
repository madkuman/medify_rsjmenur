<table>
    <thead>
    <tr>
        <td colspan="3" rowspan="2">{{config('app.name')}}</td>
        <td colspan="5"></td>
    </tr>
    <tr>
        <td colspan="8"></td>
    </tr>
    <tr>
        <td colspan="8">Laporan Rekapitulasi Medical Checkup</td>
    </tr>
    <tr>
        <td colspan="8">{{indonesian_date($tanggal_min,'d F Y')}} - {{indonesian_date($tanggal_max,'d F Y')}}</td>
    </tr>
    <tr>
        <td colspan="8"></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>NO</th>
        <th>TANGGAL</th>
        <th>NO RM</th>
        <th>NAMA PASIEN</th>
        <th>JENIS KELAMIN</th>
        <th>UMUR(TH)</th>
        <th>PAKET</th>
        <th>DOKTER</th>
    </tr>
    @php
    $summary=[];
    @endphp
    @foreach($transaksi as $item)
        @php
            if(isset($summary[$item->transaksi_detail[0]->paket->nama ?? '-'])) {
                $summary[$item->transaksi_detail[0]->paket->nama ?? '-'] += 1;
            }else{
                $summary[$item->transaksi_detail[0]->paket->nama ?? '-'] = 1;
            }
        @endphp
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{date('d/m/Y',strtotime($item->ordered_at))}}</td>
            <td>{{$item->pasien_detail->no_rm}}</td>
            <td>{{$item->pasien_detail->name}}</td>
            <td>{{$item->pasien_detail->jk->nama}}</td>
            <td>{{$item->pasien_detail->age}}</td>
            <td>{{$item->transaksi_detail[0]->paket->nama ?? '-'}}</td>
            <td>{{$item->dokter->name}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="8"></td>
    </tr>
    @if(!empty($summary))
        @php(arsort($summary))
        <tr>
            <td colspan="3">
            <td colspan="3">RINGKASAN TOTAL PAKET</td>
        </tr>
        @foreach($summary as $index => $value)
            <tr>
                <td colspan="3">
                <td>{{$index}}</td>
                <td>{{$value}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
