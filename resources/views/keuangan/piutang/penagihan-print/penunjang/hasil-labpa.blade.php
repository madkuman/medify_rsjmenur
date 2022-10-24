<head>
	<title>Hasil Pemeriksaan Laboratorium Anatomi</title>
</head>

<style type="text/css">
.small-col {
	width: 17%;
}
.big-col {
	width: 43%;
}
.med-col {
	width: 23%;
}
td {
	vertical-align: top;
}
.title {
	text-align: center; 
	font-weight: bold;
}
.left-hr{
	width: 50%; 
	margin-left: 0px;
}
.mb-5{
    margin-bottom: 5px;
}
.h5{
    font-size: 16px;
    font-weight: bold;
}

.h6{
    margin-bottom: 5px !important;
    font-weight: bold;
}

body {
    margin-top: -35px;
    margin-bottom: -30px;
    font-size: 13px;
    font-family: sans-serif;    
}
</style>
<body>
    @php $page=1; @endphp
    @foreach($result as $row)
    @if ($page>1)
    <div style="page-break-after: always;"></div>
    @endif
    @php $page++; @endphp
    <p>LABORATORIUM PATOLOGI ANATOMI<br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        {{config('app.name')}}<br>
    Jl.Menur No. 120, Kode Pos 60282.</p>
    <hr class="left-hr">
    <p class="title">HASIL PEMERIKSAAN LABORATORIUM ANATOMI</p>
    <hr>
    <table style="width: 100vw">
        <thead>
            <tr>
                <td class="small-col" >Nama</td>
                <td class="big-col" >: {{{$row->transaksi->pasien->name}}}</td>
                <td class="small-col" >Register</td>
                <td class="med-col" >: {{{$row->transaksi->pasien->no_rm}}} </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="small-col" >Umur/TTL</td>
                <td class="big-col" >: {{{$row->transaksi->pasien->age}}} Tahun / {{{$row->transaksi->pasien->place_of_birth}}}, {{{date('d F Y', strtotime($row->transaksi->pasien->date_of_birth))}}}</td>
                <td class="small-col" >Kode Sediaan</td>
                <td class="med-col" >: {{{$row->hasil->kode_sediaan}}} </td>
            </tr>
            <tr>
                <td class="small-col" >Alamat</td>
                <td class="big-col" >: {{{$row->transaksi->pasien->address}}}</td>
                <td class="small-col" >Rumah Sakit</td>
                <td class="med-col" >: {{is_null($row->transaksi->nama_rs) ? 'RSJ Menur' : $row->transaksi->nama_rs}}</td>
            </tr>
            <tr>
                <td class="small-col" >Pangkat</td>
                <td class="big-col" >: {{{isset($row->transaksi->pasien->tni_pangkat->nama) ? $row->transaksi->pasien->tni_pangkat->nama : '-'}}}</td>
                <td class="small-col" >Poli/ Ruang</td>
                <td class="med-col" >: {{{ $row->transaksi->asal['nama'] }}}</td>
            </tr>
            <tr>
                <td class="small-col" >Rol / Kesatuan</td>
                <td class="big-col" >: {{{isset($row->transaksi->pasien->tni_kotama->nama) ? $row->transaksi->pasien->tni_kotama->nama : '-'}}} /
                    {{{isset($row->transaksi->pasien->tni_satker->nama) ? $row->transaksi->pasien->tni_satker->nama : '-'}}} 
                </td>
                <td class="small-col" >Tanggal Terima</td>
                <td class="med-col">: {{{date('d F Y', strtotime($row->transaksi->created_at))}}}</td>
            </tr>
            <tr>
                <td class="small-col" > Dokter</td>
                <td class="big-col" >: {{{$row->transaksi->kasus->dpjp->user->name ?? '-'}}}</td>
                <td class="small-col" >Tanggal Selesai</td>
                <td class="med-col" >: @if(!is_null($transaksi->result_created_at)) {{{date('d F Y', strtotime($transaksi->result_created_at))}}}
                                        @else - @endif</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table style="width: 100vw">
        <tr>
            <td class="small-col">Diagnosa</td>
            <td class="big-col">: {{{$row->transaksi->diagnosis}}}</td>
            <td class="small-col"></td>
            <td class="med-col"></td>  
        </tr>
        <tr>
            <td class="small-col">Lokasi</td>
            <td class="big-col">: {{{$row->hasil->lokasi}}}</td>
            <td class="small-col"></td>
            <td class="med-col"></td>
        </tr>
    </table>
    <hr>
    @if(!is_null($row->hasil->result))
        @php $hasil = json_decode($row->hasil->result) @endphp
        @if($hasil->jenis_form == "papsmear")
            @include('keuangan.piutang.penagihan-print.penunjang.labpa-papsmear')
        @else
            @include('keuangan.piutang.penagihan-print.penunjang.labpa-form')
        @endif
    @endif

    <table style="width: 100vw; page-break-inside: avoid;">
        <tr>
            <td style="width: 65%"></td>
            <td style="width: 35%; text-align: center;">Dokter yang memeriksa</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size: 40px; color: white">dummy</td>
        </tr>
        <tr>
            <td style="width: 65%"></td>
            <td style="width: 35%; text-align: center;">{{{$row->transaksi->pemeriksa->name}}}</td>
        </tr>
    </table>
    @endforeach
</body>