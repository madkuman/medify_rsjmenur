<table>
    <thead>
        <tr>
            <th colspan="8">PASIEN {{$layanan}} MENURUT JENIS PENYAKIT</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th>NO.</th>
            <th>NO DTD</th>
            <th>NO DAFTAR TERPERINCI</th>
            <th>GOLONGAN SEBAB-SEBAB PENYAKIT</th>
            @foreach($perusahaan_tipe as $item)
            <th>{{$item->nama}}</th>
            @endforeach
            <th>JUMLAH</th>
        </tr>
        <tr>
        </tr>
        @php $row = 5 @endphp
        @php
            $total_perusahaan = count($perusahaan_tipe)-1;
            $start_column = 'E';
            $last_column = 'E';
            for($i=0;$i<$total_perusahaan;$i++){
                $last_column++;
            }
        @endphp
        @foreach($dtds as $dtd)
        <tr>
            <th>{{$loop->iteration}}</th>
            <th>{{$dtd->no_dtd}}</th>
            <th>{{$dtd->no_daftar_terperinci}}</th>
            <th>{{$dtd->golongan_sebab_sebab_sakit}}</th>
            @foreach($perusahaan_tipe as $item)
            <th>{{$transaksi[$dtd->id][$item->id] ?? 0}}</th>
            @endforeach
            <th>=SUM({{$start_column}}{{$row}}:{{$last_column}}{{$row}})</th>
        </tr>
        @php $row ++ @endphp

        @if($loop->iteration == 496)
        @php $row = 505 @endphp
        <tr></tr>
        <tr>
            <th colspan="4">2. Penyebab Kecelakaan</th>
        </tr>
        <tr>
            <th>NO.</th>
            <th>NO DTD</th>
            <th>NO DAFTAR TERPERINCI</th>
            <th>GOLONGAN SEBAB-SEBAB PENYAKIT</th>
            @foreach($perusahaan_tipe as $item)
            <th>{{$item->nama}}</th>
            @endforeach
            <th>JUMLAH</th>
        </tr>
        <tr>
        </tr>
        @endif

        @endforeach
    </thead>
</table>
