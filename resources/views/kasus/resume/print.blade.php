@extends('layouts.print')

@section('title')
Print Ringkasan Pulang - {{$kasus->pasien->name}}
@endsection

@section('css')
<style type="text/css">
body {
    font-size: 0.9em;
}
td{
    vertical-align: top;
}
</style>
@endsection

@section('content')

<table width="100%">
    <tr>
        <td width="100%"><img src="{{config('app.kop_lg')}}" height="50"></td>
    </tr>
</table>


<hr>
<h4 class="text-center"><center>RINGKASAN KELUAR (RESUME)</center>
    <center>No RM :000000{{$kasus->pasien->no_rm}}</center>
</h4>

<table width="100%">
    <tr>
        <th width="20%"></th>
        <th width="30%"></th>
        <th width="15%"></th>
        <th width="35%"></th>
    </tr>
    <tr>
        <td>Nama Pasien</td>
        <td>: {{$kasus->pasien->name}}</td>
        <td>Tgl Lahir</td>
        <td>: 
            {{strftime('%d %B %Y',strtotime($kasus->pasien->date_of_birth))}} / {{$kasus->pasien->age}} thn - @if($kasus->pasien->gender == 1) L @else P @endif
        </td>
    </tr>
    <tr>
        <td>Pangkat / Gol</td>
        <td>: 
            @if($kasus->pasien->is_anggota == 1)
            {{$kasus->pasien->tni_pangkat->nama or '-'}}
            @else 
            -
            @endif
        </td>
        <td>Pekerjaan </td>
        <td>: {{$kasus->pasien->job or '-'}}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td colspan="3">: 
            {{$kasus->pasien->address}}, 
            @if(!empty($kasus->pasien->alamat_kecamatan))
            {{$kasus->pasien->alamat_kecamatan->nama or '-'}}, {{$kasus->pasien->alamat_kota->nama or '-'}} 
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="4">Masuk RS Tgl: @php setlocale(LC_ALL,"ID") @endphp 
            @if(count($kasus->TransaksiRawatInap) != 0) {{strftime('%d %B %Y',strtotime($kasus->TransaksiRawatInap[0]->waktu_masuk))}}  @else {{strftime('%d %B %Y',strtotime($kasus->created_at))}}  @endif
            ; KRS tgl: @if(is_null($kasus->krs_at)) - @else {{strftime('%d %B %Y',strtotime($kasus->krs_at))}} @endif; Lama dirawat: {{$durasi or '-'}} hari; Ruang: {{$kasus->lokasi->lokasi->nama or '-'}}
        </td>
    </tr>
</table>
<hr>
<br>

<table width="100%">
    <tr>
        <th width="5%"></th>
        <th width="35%"></th>
        <th width="2%"></th>    
        <th width="58%"></th>
    </tr>
    <tr>
        <td>1.</td>
        <td>Diagnosa Masuk </td>
        <td>:</td>
        <td>{{$resume->diagnosa_masuk}}</td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Diagnosa Utama </td>
        <td>:</td>
        <td>{{$resume->diagnosa_utama}}</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Diagnosa Tambahan</td>
        <td>:</td>
        <td>{{$resume->diagnosa_tambahan}}</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Jenis Tindakan</td>
        <td>:</td>
        <td>{{$resume->jenis_tindakan}}</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Alasan Dirawat</td>
        <td>:</td>
        <td>{{$resume->alasan_rawat}}</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>Ringkasan Penyakit</td>
        <td>:</td>
    </tr>
    <tr>
        <td></td>
        <td>- Riwayat Penyakit Sekarang</td>
        <td>:</td>
        <td>{{$resume->ringkasan}}</td>
    </tr>
    <tr>
        <td></td>
        <td>- Pemeriksaan Fisik</td>
        <td>:</td>
        <td>{{$resume->pemeriksaan_fisik}}</td>
    </tr>
    <tr>
        <td></td>
        <td>- Lab / Ro / CT Scan / MRI / USG / ...</td>
        <td>:</td>
        <td>{{$resume->lab}}</td>
    </tr>
    @php 
        $terapi = $resume->terapi;
        $terapi_array = (explode("\n",$terapi));
    @endphp

    @foreach ($terapi_array as $key => $item) {
    <tr>
        @if($key == 0)
        <td>7.</td>
        <td>Terapi Pasien</td>
        <td>:</td>
        @else
        <td></td>
        <td></td>
        <td></td>
        @endif
        <td>{{$item}}</td>
    </tr>
    @endforeach
    <tr>
        <td>8.</td>
        <td>Hasil Konsul</td>
        <td>:</td>
        <td>{{$resume->hasil_konsul}}</td>
    </tr>
    <tr>
        <td>9.</td>
        <td>Perkembangan selama dirawat / Komplikasi / Prognosa</td>
        <td>:</td>
        <td>{{$resume->perkembangan}}</td>
    </tr>
    <tr>
        <td>10.</td>
        <td>Keadaan Waktu Pulang </td>
        <td>:</td>
        <td>{{$resume->keadaan_krs}}</td>
    </tr>
    <tr>
        <td>11.</td>
        <td>Waktu kontrol ulang tanggal
        <td>:</td>
        <td>{{$resume->waktu_kontrol}} ; Klinik : {{$resume->poli->name ?? '-'}} ; Rumah Sakit : {{config('app.name')}} ;</td>
    </tr>
    <tr>
        <td>12.</td>
        <td>Instruksi / Saran tindak lanjut</td>
        <td>:</td>
        <td>{{$resume->instruksi}}</td>
    </tr>
    <tr>
        <td>13.</td>
        <td colspan="3">Bila memerlukan tindakan segera, kembali ke UGD {{config('app.name')}} atau rumah sakit terdekat</td>
    </tr>
</table>
<table width="100%">
    <tr>
        <th width="5%"></th>
        <th width="30%"></th>
        <th width="30%"></th>
        <th width="35%"></th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center">Surabaya, {{strftime('%d %B %Y',strtotime($now))}} Jam {{strftime('%H:%M',strtotime($now))}}</td>
    </tr>
    <tr>
        <td></td>
        <td class="text-center">Pasien / Keluarga,</td>
        <td></td>
        <td class="text-center">DPJP,</td>
    </tr>
    @if(empty($dpjp->user->ttd))
    <tr>
        <td colspan="4"><br></td>
    </tr>
    <tr>
        <td colspan="4"><br></td>
    </tr>
    <tr>
        <td colspan="4"><br></td>
    </tr>
    @else
    <tr>
        <td colspan="3">
            <br>
        </td>
        <td class="text-center">
            <img src="{{url('')}}/{{$dpjp->user->ttd}}" height="150px" style="filter: contrast(0);">
        </td>
    </tr>
    @endif
    <tr>
        <td></td>
        <td class="text-center">(........................)</td>
        <td></td>
        <td class="text-center">{{$dpjp->user->name or '-'}}</td>
    </tr>
    <tr>
        <td></td>
        <td class="text-center">(Tanda tangan dan nama)</td>
        <td></td>
        <td class="text-center"></td>
    </tr>
</table>

@endsection