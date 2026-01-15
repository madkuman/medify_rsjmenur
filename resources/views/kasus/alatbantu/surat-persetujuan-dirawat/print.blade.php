@extends('layouts.print')

@section('title')
Print Surat Persetujuan Dirawat
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        line-height: 16px;
    }
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td.has-border {
      border: 1px solid black;
    }
</style>
@endsection

@section('content')
    <table class="bordered" align="right" cellpadding="3">
        <tr>
            <td align="center" class="has-border">RM. 16</td>
        </tr>
        <tr>
            <td align="center">Halaman 1/1</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="60%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                            <b>RUMAH SAKIT JIWA MENUR</b> <br>
                            Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                            <b>SURABAYA</b>
                            </p>
                        </td>
                        <td width="25%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
                        </td>
                   </tr> 
                </table>
            </td>
            <td width="40%"></td>
        </tr>
    </table>

    <table width="90%" class="bordered" align="center" cellpadding="5" style="margin-top: 20px;">
        <tr>
            <th align="center">
                <h4>SURAT PERSETUJUAN DIRAWAT</h4>
            </th>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                	<tr>
                		<td colspan="3">Saya yang bertanda tangan dibawah ini : {{ $surat_persetujuan_dirawat->hubungan_dengan_pasien }}</td>
                	</tr>
                	<tr>
                		<td>Nama</td>
                		<td>:</td>
                		<td>{{$surat_persetujuan_dirawat->nama ?? '.........................................'}}</td>
                	</tr>
                	<tr>
                		<td>Alamat</td>
                		<td>:</td>
                		<td>{{$surat_persetujuan_dirawat->alamat ?? '.........................................'}}</td>
                	</tr>
                	<tr>
                		<td>No. Telepon</td>
                		<td>:</td>
                		<td>{{$surat_persetujuan_dirawat->no_telepon ?? '.........................................'}}</td>
                	</tr>

                	<tr>
                		<td colspan="3"><p style="margin-top: 10px;">Dengan ini menyediakan bahwa setuju untuk dilakukan rawat inap terhadap pasien :</p></td>
                	</tr>
                	<tr>
                		<td width="22%">No. RM</td>
                		<td width="3%">:</td>
                		<td width="75%">{{$kasus->pasien->no_rm ?? '.........................................'}}</td>
                	</tr>
                	<tr>
                		<td>Nama</td>
                		<td>:</td>
                		<td>{{$kasus->identitas->nama ?? '.........................................'}}, {{$kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
                	</tr>
                	<tr>
                		<td>Tanggal Lahir / Umur</td>
                		<td>:</td>
                		<td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : '-'}} / {{$kasus->identitas->umur ?? '.........................................'}} Tahun</td>
                	</tr>
                	<tr>
                		<td>Alamat</td>
                		<td>:</td>
                		<td>{{$kasus->identitas->alamat ?? '.........................................'}}</td>
                	</tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                	<tr>
                		<td colspan="3">Akan dirawat di :</td>
                	</tr>
                	<tr>
                		<td width="15%">Ruang</td>
                		<td width="3%">:</td>
                		<td width="82%">{{$surat_persetujuan_dirawat->ruang ?? '.........................................'}}</td>
                	</tr>
                	<tr>
                		<td>Kelas</td>
                		<td>:</td>
                		<td>{{$surat_persetujuan_dirawat->kelas ?? '.........................................'}}</td>
                	</tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="has-border">
                <table width="100%">
                	<tr>
                		<td colspan="2">Demikian persetujuan ini saya buat tanpa asa paksaan dari siapapun.</td>
                	</tr>
                	<tr>
                		<td width="50%"></td>
                		<td width="50%" align="center"><p style="margin-top: 20px; margin-bottom: 10px;">Surabaya, {{date('d F Y', strtotime($surat_persetujuan_dirawat->created_at))}}</p></td>
                	</tr>
                	<tr>
                		<td align="center">Dokter pemeriksa</td>
                		<td align="center">Yang memberi pernyataan</td>
                	</tr>
			<tr>
				<td align="center"><img src="{{url('')}}/{{$kasus->admin->user->ttd}}" style="max-width: 90px"></td>
				<td></td>
			</tr>
                	<tr>
                		<td align="center">
                			<p style="margin-top: 10px;">({{$kasus->admin->user->name ?? '.........................................'}})</p>
                		</td>
                		<td align="center">
                			<p style="margin-top: 10px;">({{$surat_persetujuan_dirawat->nama ?? '.........................................'}})</p>
                		</td>
                	</tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
