
<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_sm')}}" height="50"></td>
    </tr>
</table>
<p class="text-right">Surabaya, {{$tanggal}}</p>


<table>
    <tr>
        <td>Nomor</td>
        <td>:</td>
        <td>B/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/{{$bulan}}/2018</td>
    </tr>
    <tr>
        <td>Klasifikasi</td>
        <td>:</td>
        <td>Biasa</td>
    </tr>
    <tr>
        <td>Lampiran</td>
        <td>:</td>
        <td>Bendel</td>
    </tr>
    <tr>
        <td>Perihal</td>
        <td>:</td>
        <td><span style="text-decoration: underline;">Tagihan Biaya Perawatan</span> </td>
    </tr>
</table>

<br><br>
<table>
    <tr>
        <td width="70%" rowspan="6"></td>
        <td>Kepada :</td>
    </tr>
    <tr>
        <td>Yth : Bagian Klaim</td>
    </tr>
    <tr>
        <td>YAKES @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>di</td>
    </tr>
    <tr>
        <td>@foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->alamat}}@endforeach</td>
    </tr>
</table>
<br>
<br>

<ol>
    <li>Bersama ini dikirimkan tagihan biaya perawatan/pengobatan yang menjadi tanggungan YAKES @foreach($perusahaan as $item){{ $loop->first ? '' : ', ' }}{{$item->nama}}@endforeach atas nama terlampir.</li>
    <li>Sehubungan dengan hal tersebut, mohon segera melakukan penyelesaian administrasi pembayaran melalui rekening atas nama <strong>{{config('app.name')}}</strong> nomor rekening :
        <br><br>
        &ensp;&ensp;&ensp;&ensp;<strong >142 - 00 - 1553003 - 2</strong>
    </li>
    <li>Demikian terima kasih atas perhatian dan kerjasamanya.</li>
</ol>




<br>
<br>

<div class="footer">
    NB.
    <ol style="margin:0;padding: 0;padding-left: 20px">
        <li>Pembayaran paling lambat 2 (dua) minggu setelah Tagihan diterima</li>
        <li style="text-decoration: underline;">Harap mencantumkan nama perusahaan waktu melakukan transfer</li>
    </ol>
</div>
