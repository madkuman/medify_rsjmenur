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
body {
    margin-top: -35px;
    margin-bottom: -30px;
    font-size: 14px;    
    font-family: sans-serif;    
}
</style>
<body>
    <p>LABORATORIUM PATOLOGI ANATOMI<br>
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;
        {{config('app.name')}}</p>
    <hr class="left-hr">
    <p class="title">HASIL PEMERIKSAAN LABORATORIUM ANATOMI</p>
    <hr>
    <table style="width: 100vw">
        <thead>
            <tr>
                <td class="small-col" >Nama</td>
                <td class="big-col" >: {{{$transaksi->pasien->name}}}</td>
                <td class="small-col" >Register</td>
                <td class="med-col" >: {{{$transaksi->pasien->no_rm}}} </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="small-col" >Umur/TTL</td>
                <td class="big-col" >: {{{$transaksi->pasien->age}}} Tahun / {{{$transaksi->pasien->place_of_birth}}}, {{{date('d F Y', strtotime($transaksi->pasien->date_of_birth))}}}</td>
                <td class="small-col" >Kode Sediaan</td>
                <td class="med-col" >: {{{$detail->kode_sediaan}}} </td>
            </tr>
            <tr>
                <td class="small-col" ></td>
                <td class="med-col" ></td>            
                <td class="small-col" >Dokter</td>
                <td class="med-col" >: {{{$transaksi->kasus->dpjp->user->name ?? '-'}}}</td>
            </tr>
            <tr>
                <td class="small-col" >Alamat</td>
                <td class="big-col" >: {{{$transaksi->pasien->address}}}</td>
                <td class="small-col" >Rumah Sakit</td>
                <td class="med-col" >: {{is_null($transaksi->nama_rs) ? config('app.name') : $transaksi->nama_rs}}</td>
            </tr>
            <tr>
                <td class="small-col" >Pangkat</td>
                <td class="big-col" >: {{{isset($transaksi->pasien->tni_pangkat->nama) ? $transaksi->pasien->tni_pangkat->nama : '-'}}}</td>
                <td class="small-col" >Poli/ Ruang</td>
                <td class="med-col" >: {{{ $transaksi->asal['nama'] }}}</td>
            </tr>
            <tr>
                <td class="small-col" >Rol / Kesatuan</td>
                <td class="big-col" >: {{{isset($transaksi->pasien->tni_kotama->nama) ? $transaksi->pasien->tni_kotama->nama : '-'}}} /
                    {{{isset($transaksi->pasien->tni_satker->nama) ? $transaksi->pasien->tni_satker->nama : '-'}}} 
                </td>
            </tr>
            <tr>
                <td class="small-col" >Tanggal Terima</td>
                <td class="big-col" >: {{{date('d F Y', strtotime($transaksi->created_at))}}}</td>
                <td class="small-col" >Tanggal Selesai</td>
                <td class="med-col" >: @if(!is_null($transaksi->result_created_at)) {{{date('d F Y', strtotime($transaksi->result_created_at))}}}
                                        @else - @endif</td>
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <table style="width: 100vw">
        <tr>
            <td class="small-col">Diagnosa</td>
            <td class="big-col">: {{{$transaksi->diagnosis}}}</td>
            <td class="small-col"></td>
            <td class="med-col"></td>  
        </tr>
        <tr>
            <td class="small-col">Lokasi</td>
            <td class="big-col">: {{{$detail->lokasi}}}</td>
            <td class="small-col"></td>
            <td class="med-col"></td>
        </tr>
    </table>
    <hr>
    <p>Hasil Pemeriksaan {{{ucfirst($result->jenis_form)}}}</p>
    <div style=" margin-bottom: 5px;">
        <table style="width: 100vw;">
            <tr>
                <td style="width: 20%; font-weight: bold;">Makroskopis</td>
                <td style="width: 80%; font-weight: bold;">:</td>
            </tr>
        </table>
        <?php echo htmlspecialchars_decode(stripslashes($result->makroskopis ? $result->makroskopis : '-')) ?>
    </div>
    <div style=" margin-bottom: 5px;">
        <table style="width: 100vw;">
            <tr>
                <td style="width: 20%; font-weight: bold;">Mikroskopis</td>
                <td style="width: 80%; font-weight: bold;">:</td>
            </tr>
        </table>
<?php echo htmlspecialchars_decode(stripslashes($result->mikroskopis ? $result->mikroskopis : '-')) ?>    </div>
    <div style=" margin-bottom: 5px;">
        <table style="width: 100vw;">
            <tr>
                <td style="width: 20%; font-weight: bold;">Kesimpulan</td>
                <td style="width: 80%; font-weight: bold;">:</td>
            </tr>
        </table>
<?php echo htmlspecialchars_decode(stripslashes($result->kesimpulan ? $result->kesimpulan : '-')) ?>
    </div>


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
            <td style="width: 35%; text-align: center;">{{{$transaksi->pemeriksa->name}}}</td>
        </tr>
    </table>
</body>