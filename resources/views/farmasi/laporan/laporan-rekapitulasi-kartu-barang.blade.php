<table border="1">
    <tr>
        <td colspan="{{ $full_colspan }}">PEMERINTAH PROVINSI JAWA TIMUR</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}">RUMAH SAKIT JIWA MENUR</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}">Jln Menur No. 120 Telp (031) 5021635,5021637 Surabaya</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}"></td>
    </tr>
    <tr>
        <td>Provinsi</td>
        <td colspan="{{ $full_colspan - 4 }}">: Jawa Timur</td>
        <td>Tahun Anggaran</td>
        <td colspan="2">: {{ $request['tahun_anggaran'] }}</td>
    </tr>
    <tr>
        <td>Satuan Kerja</td>
        <td colspan="{{ $full_colspan - 4 }}">: RS Jiwa Menur Surabaya Medis (070601)</td>
        <td>Triwulan</td>
        <td colspan="2">: {{ $request['triwulan'] }}</td>
    </tr>
    <tr>
        <td>Gudang</td>
        <td colspan="{{ $full_colspan - 1 }}">: {{ $farmasi_list->pluck('nama')->implode(', ') }}</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}"></td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}">REKAPITULASI MUTASI BARANG</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}">Periode Tanggal {{ $date_start->format("d M Y") }} s/d {{ $date_end->format('d M Y') }}</td>
    </tr>
    <tr>
        <td colspan="{{ $full_colspan }}"></td>
    </tr>
    <tr>
        <td rowspan="3">No</td>
        <td rowspan="3">Kode Bidang</td>
        <td rowspan="3">Kode Rekening</td>
        <td rowspan="3">Kelompok/Bidang Barang</td>
        <td rowspan="3">Satuan</td>
        <td rowspan="2" colspan="2">Keadaan Awal</td>
        <td colspan="6">Mutasi</td>
        <td rowspan="2" colspan="2">Keadaan Akhir</td>
    </tr>
    <tr>
        <td colspan="2">Bertambah (APBD)</td>
        <td colspan="2">Bertambah (Non APBD)</td>
        <td colspan="2">Berkurang</td>
    </tr>
    <tr>
        <td>Jml</td>
        <td>Nilai (Rp)</td>
        <td>Jml</td>
        <td>Nilai (Rp)</td>
        <td>Jml</td>
        <td>Nilai (Rp)</td>
        <td>Jml</td>
        <td>Nilai (Rp)</td>
        <td>Jml</td>
        <td>Nilai (Rp)</td>
    </tr>
    <tr>
        @for ($i = 1; $i <= 14; $i++)
            <td>{{ $i }}</td>
            @if ($i == 2)
                <td></td>
            @endif
        @endfor
    </tr>
    @php
        $nomor = 1;
    @endphp
    @foreach ($master_kode_bidang->where('parent_id', '=', null) as $parent)
        @php
            $kode_bidang_id_ids = $master_kode_bidang->where('parent_id', $parent->id)->pluck('id')->push($parent->id)->values()->toArray();
            $laporan_data = $data->whereIn('kode_bidang_id', $kode_bidang_id_ids);
        @endphp
        <tr>
            <td><b>{{ $nomor++ }}</b></td>
            <td><b>{{ $parent->kode }}</b></td>
            <td></td>
            <td><b>{{ $parent->nama }}</b></td>
            <td></td>

            <td><b>{{ $laporan_data->sum('keadaan_awal_jumlah')}}</b></td>
            <td><b>{{ $laporan_data->sum('keadaan_awal_subtotal')}}</b></td>
            <td><b>{{ $laporan_data->sum('bertambah_apbd_jumlah')}}</b></td>
            <td><b>{{ $laporan_data->sum('bertambah_apbd_subtotal')}}</b></td>
            <td><b>{{ $laporan_data->sum('bertambah_non_apbd_jumlah')}}</b></td>
            <td><b>{{ $laporan_data->sum('bertambah_non_apbd_subtotal')}}</b></td>
            <td><b>{{ $laporan_data->sum('berkurang_jumlah')}}</b></td>
            <td><b>{{ $laporan_data->sum('berkurang_subtotal')}}</b></td>
            <td><b>{{ $laporan_data->sum('keadaan_akhir_jumlah')}}</b></td>
            <td><b>{{ $laporan_data->sum('keadaan_akhir_subtotal')}}</b></td>
        </tr>
        @foreach ($master_kode_bidang->where('parent_id', $parent->id) as $item)
            @php
                $laporan_data = $data->where('kode_bidang_id', $item->id);
            @endphp
            <tr>
                <td></td>
                <td>{{ $item->kode }}</td>
                <td></td>
                <td>{{ $item->nama }}</td>
                <td></td>

                <td>{{ $laporan_data->sum('keadaan_awal_jumlah')}}</td>
                <td>{{ $laporan_data->sum('keadaan_awal_subtotal')}}</td>
                <td>{{ $laporan_data->sum('bertambah_apbd_jumlah')}}</td>
                <td>{{ $laporan_data->sum('bertambah_apbd_subtotal')}}</td>
                <td>{{ $laporan_data->sum('bertambah_non_apbd_jumlah')}}</td>
                <td>{{ $laporan_data->sum('bertambah_non_apbd_subtotal')}}</td>
                <td>{{ $laporan_data->sum('berkurang_jumlah')}}</td>
                <td>{{ $laporan_data->sum('berkurang_subtotal')}}</td>
                <td>{{ $laporan_data->sum('keadaan_akhir_jumlah')}}</td>
                <td>{{ $laporan_data->sum('keadaan_akhir_subtotal')}}</td>
            </tr>
        @endforeach
    @endforeach
</table>