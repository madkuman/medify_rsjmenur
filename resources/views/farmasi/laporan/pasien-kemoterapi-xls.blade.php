<table>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="4">{{config('app.name')}}</td>
    </tr>
    <tr>
        <td colspan="4">DEPARTEMEN FARMASI</td>
    </tr>
    <tr>
        <td colspan="4">{{strtoupper(session('farmasi')->nama)}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="14" align="center">REKAPITULASI PASIEN KEMOTERAPI</td>
    </tr>
    <tr>
        <td colspan="14" align="center">Tanggal {{indonesian_date(date('d F Y',strtotime($min_date)))}} - {{indonesian_date(date('d F Y',strtotime($max_date)))}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>NO.</td>
        <td>TGL PEMBAYARAN</td>
        <td>NAMA PASIEN</td>
        <td>JENIS KELAMIN</td>
        <td>UMUR</td>
        <td>RUANGAN</td>
        <td>DIAGNOSA</td>
        <td>NAMA OBAT</td>
        <td>DOSIS YANG DIBUTUHKAN</td>
        <td>CARA PEMBERIAN</td>
        <td>VOLUME AMP/VIAL</td>
        <td>JUMLAH AMP/VIAL</td>
        <td>VOLUME INFUS</td>
        <td>NAMA INFUS</td>
    </tr>

    @php $no=1 @endphp
    <?php $total_all=0 ?>
    @forelse($transaksi as $row)
        @foreach($row->final_detail->resep_detail as $res)
        <tr>
            <td align="center">{{$no++}}</td>
            <td align="center">{{date('d-M-Y',strtotime($row->paid_at))}}</td>
            <td>{{$row->pasien_detail->name ?? strtoupper($row->nama_pasien) ?? '-'}}</td>
            <td align="center">{{$row->pasien_detail->jenis_kelamin_lp ?? '-'}}</td>
            <td align="center">{{!empty($row->pasien_detail->age) ? $row->pasien_detail->age.' tahun' : '-'}}</td>
            <td>{{$row->lokasi->nama ?? '-'}}</td>
            <td>{{$row->kasus->diagnosis_utama->icd10->long_desc ?? '-'}}</td>
            <td>{{$res->nama_obat ?? '-'}}</td>
            <td align="center">{{$res->dosis ?? '-'}}</td>
            <td align="center">{{$res->satuan_penggunaan ?? '-'}}</td>
            <td align="center">{{$res->volume_amp ?? '-'}}</td>
            <td align="center">{{$res->jumlah_amp ?? '-'}}</td>
            <td align="center">{{$res->volume_infus ?? '-'}}</td>
            <td>{{$res->nama_infus ?? '-'}}</td>
        </tr>
        @endforeach
    @empty
    <tr>
        <td colspan="14" align="center">Data belum tersedia</td>
    </tr>
    @endforelse
</table>