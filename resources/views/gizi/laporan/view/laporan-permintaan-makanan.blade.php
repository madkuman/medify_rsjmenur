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
        <td colspan="10">BON PERMINTAAN MAKANAN PASIEN BANGSAL {{strtoupper($bangsal->nama)}}</td>
    </tr>
    <tr>
        <td colspan="10"></td>
    </tr>
    <tr>
        <td></td>
        <td>TANGGAL</td>
        <td colspan="3">: {{indonesian_date(strtotime($date))}}</td>
        <td></td>
        <td></td>
        <td colspan="2">BANGSAL</td>
        <td>: {{$bangsal->nama}}</td>
    </tr>
    <tr>
        <td colspan="10"></td>
    </tr>
    <tr>
        <td>NO</td>
        <td>NAMA PASIEN</td>
        <td>L/P</td>
        <td>UNIT</td>
        <td>NO RM</td>
        <td>DIET</td>
        <td>P</td>
        <td>Si</td>
        <td>M</td>
        <td>KETERANGAN</td>
    </tr>
    @php
    $no = 0;
    $row_start = 10;
    $row_end = 9;
    @endphp
    @foreach($data as $pemesanan)
        @php
            $row_end++;
        @endphp
    <tr>
        <td>{{++$no}}</td>
        <td>{{$pemesanan->pasien->name}}</td>
        <td>{{$pemesanan->pemesanan_detail[0]->gender == 1 ? 'L':'P'}}</td>
        <td>{{$pemesanan->pemesanan_detail[0]->ruangan->nama}}</td>
        <td>{{$pemesanan->pasien->no_rm}}</td>
        <td>{{$pemesanan->pemesanan_detail[0]->diet->nama}}</td>
        @php
        $waktu_makan_ids = [];
        foreach ($pemesanan->pemesanan_detail as $pemesanan_detail){
            $waktu_makan_ids[] = $pemesanan_detail->waktu_makan_id;
        }
        @endphp
        <td>{{in_array(1,$waktu_makan_ids) ? '1' : ''}}</td>
        <td>{{in_array(2,$waktu_makan_ids) ? '1' : ''}}</td>
        <td>{{in_array(3,$waktu_makan_ids) ? '1' : ''}}</td>
        <td>{{$pemesanan->pemesanan_detail[0]->catatan}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="6">JUMLAH</td>
        <td>=SUM(G{{$row_start}}:G{{$row_end}})</td>
        <td>=SUM(H{{$row_start}}:H{{$row_end}})</td>
        <td>=SUM(I{{$row_start}}:I{{$row_end}})</td>
    </tr>
</table>