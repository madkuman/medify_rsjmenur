<table>
    <thead>
        <tr>
            <th colspan="8">2. PASIEN RAWAT INAP MENURUT JENIS PENYAKIT</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th rowspan="3">NO.</th>
            <th rowspan="3">NO DTD</th>
            <th rowspan="3">NO DAFTAR TERPERINCI</th>
            <th rowspan="3">GOLONGAN SEBAB-SEBAB PENYAKIT</th>
            <th colspan="8">BPJS</th>
            <th rowspan="3">UMUM&nbsp;</th>
            <th rowspan="3">Kerjasama</th>
            <th rowspan="3">JUMLAH</th>
        </tr>
        <tr>
            <th colspan="3">TNI AL</th>
            <th rowspan="2">TNI NON AL &amp; KEL</th>
            <th rowspan="2">PURN</th>
            <th rowspan="2">ANH</th>
            <th rowspan="2">MANDIRI</th>
            <th rowspan="2">PBI</th>
        </tr>
        <tr>
            <th>MIL</th>
            <th>PNS</th>
            <th>KEL</th>
        </tr>
        <tr>
            <?php for($i=0;$i<13;$i++) { ?>
            <th>{{$i+1}}</th>
            <?php } ?>
            <th> </th>
            <th>14</th>
        </tr>
        @php $row = 7 @endphp
        @foreach($dtds as $dtd)
        <tr>
            <th>{{$loop->iteration}}</th>
            <th>{{$dtd->no_dtd}}</th>
            <th>{{$dtd->no_daftar_terperinci}}</th>
            <th>{{$dtd->golongan_sebab_sebab_sakit}}</th>
            <th>{{$transaksi[$dtd->id]['tni_al'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['pns_al'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['kel_al'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['non_al'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['purna'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['anh'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['mandiri'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['pbi'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['umum'] ?? 0}}</th>
            <th>{{$transaksi[$dtd->id]['kerjasama'] ?? 0}}</th>
            <th>=SUM(E{{$row}}:N{{$row}})</th>
        </tr>
        @php $row ++ @endphp

        @if($loop->iteration == 496)
        @php $row = 509 @endphp
        <tr></tr>
        <tr>
            <th colspan="4">2. Penyebab Kecelakaan</th>
        </tr>
        <tr>
            <th rowspan="3">NO.</th>
            <th rowspan="3">NO DTD</th>
            <th rowspan="3">NO DAFTAR TERPERINCI</th>
            <th rowspan="3">GOLONGAN SEBAB-SEBAB PENYAKIT</th>
            <th colspan="8">BPJS</th>
            <th rowspan="3">UMUM&nbsp;</th>
            <th rowspan="3"> </th>
            <th rowspan="3">JUMLAH</th>
        </tr>
        <tr>
            <th colspan="3">TNI AL</th>
            <th rowspan="2">TNI NON AL &amp; KEL</th>
            <th rowspan="2">PURN</th>
            <th rowspan="2">ANH</th>
            <th rowspan="2">MANDIRI</th>
            <th rowspan="2">PBI</th>
        </tr>
        <tr>
            <th>MIL</th>
            <th>PNS</th>
            <th>KEL</th>
        </tr>
        <tr>
            <?php for($i=0;$i<13;$i++) { ?>
            <th>{{$i+1}}</th>
            <?php } ?>
            <th> </th>
            <th>14</th>
        </tr>
        @endif

        @endforeach
    </thead>
</table>
