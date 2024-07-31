@extends('layouts.print')

@section('title')
Print Surat Pasien Pulang Rumah Sakit
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
    table.bordered, .bordered th {
      border: 1px solid black;
    }
</style>
@endsection

@section('content')
    <header>
        <table class="bordered" align="right" cellpadding="3">
            <tr>
                <td><b>RM. 35</b></td>
            </tr>
        </table>
    </header>

    <table width="70%" align="center">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5" style="border-bottom: 1px solid #000;">
                   <tr>
                        <td width="15%" align="left">
                            <img src="{{ public_path('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                        </td>
                        <td width="63%" align="center">
                            <p style="font-size: 14px;">PEMERINTAH PROVINSI JAWA TIMUR </p>
                            <p style="font-size: 14px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 12px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                            <p style="font-size: 14px;"><b>SURABAYA</b></p>
                        </td>
                        <td width="17%" align="left">
                            <img src="{{ public_path('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
            </td>
        </tr>
    </table>

    <table width="90%" class="bordered" align="center" cellpadding="5" style="margin-top: 20px;">
        <tr>
            <th align="center">
                <h4>SURAT PASIEN PULANG / KELUAR RUMAH SAKIT</h4>
            </th>
        </tr>
        <tr>
            <th align="center">
                <h4>Nomor : 441.6/______/305/20..........</h4>
            </th>
        </tr>
        <tr>
        	<td>
        		<table width="100%" align="center">
			    	<tr>
			    		<td colspan="3">Telah mengizinkan pulang dari Rumah Sakit Jiwa Menur Surabaya, terhadap pasien : </td>
			    	</tr>
			    	<tr>
			            <td width="22%">Nomor RM</td>
			            <td width="3%">:</td>
			            <td width="75%">{{$kasus->pasien->no_rm ?? '.........................................'}}</td>
			        </tr>
			        <tr>
			            <td>Nama</td>
			            <td>:</td>
			            <td>{{$kasus->identitas->nama ?? '.........................................'}}</td>
			        </tr>
			        <tr>
			            <td>Tanggal Lahir / Umur</td>
			            <td>:</td>
			            <td>{{ !is_null($kasus->identitas->tanggal_lahir) ? date('d/m/Y', strtotime($kasus->identitas->tanggal_lahir)) : '-'}} / {{$kasus->identitas->umur ?? '.........................................'}} Tahun</td>
			        </tr>
			        <tr>
			            <td>Jenis Kelamin</td>
			            <td>:</td>
			            <td>{{$kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}}</td>
			        </tr>
			        <tr>
			            <td>Alamat</td>
			            <td>:</td>
			            <td>{{$kasus->identitas->alamat ?? '.........................................'}}</td>
			        </tr>
			        <tr>
			            <td>Ruang Rawat</td>
			            <td>:</td>
			            <td>{{$kasus->lokasi->lokasi->nama ?? '.........................................'}}</td>
			        </tr>
			        <tr>
			            <td>Tanggal MRS</td>
			            <td>:</td>
			            <td>{{ !is_null($kasus->mrs_at) ? date('d/m/Y', strtotime($kasus->mrs_at)) : '-'}}</td>
			        </tr>
			        <tr>
			            <td>Tanggal KRS</td>
			            <td>:</td>
			            <td>{{ !is_null($kasus->krs_at) ? date('d/m/Y', strtotime($kasus->krs_at)) : '-'}}</td>
			        </tr>
			        <tr>
			            <td colspan="3">
			            	<table width="100%">
			            		<tr>
			            			<td colspan="2">Karena pasien yang tersebut diatas oleh dokter yang merawat telah dinyatakan : <b>{{ $surat_pasien_pulang_rumah_sakit->pasien_telah_dinyatakan ?? '-' }}</b></td>
			            		</tr>
			            		@if($surat_pasien_pulang_rumah_sakit->pasien_telah_dinyatakan == 'Telah dirujuk')
			            		<tr>
				            		<td><b>Rujuk ke</b> {{$surat_pasien_pulang_rumah_sakit->rujuk_ke ?? '-'}}</td>
				            	</tr>
				            	@endif
			            	</table>
			            </td>
			        </tr>
			        <tr>
			            <td colspan="3">
			                Dijemput oleh :
			            </td>
			        </tr>
			        <tr>
			            <td>Nama</td>
			            <td>:</td>
			            <td>
			            	{{$surat_pasien_pulang_rumah_sakit->nama ?? '.........................................'}}
			            </td>
			        </tr>
			        <tr>
			            <td>Alamat</td>
			            <td>:</td>
			            <td>
			            	{{$surat_pasien_pulang_rumah_sakit->alamat ?? '.........................................'}}
			            </td>
			        </tr>
			        <tr>
			            <td>Telepon</td>
			            <td>:</td>
			            <td>
			            	{{$surat_pasien_pulang_rumah_sakit->telepon ?? '.........................................'}}
			            </td>
			        </tr>
			        <tr>
			            <td width="27%">Hubungan dengan pasien</td>
			            <td width="3%">:</td>
			            <td width="70%">
			            	{{$surat_pasien_pulang_rumah_sakit->hubungan_dengan_pasien ?? '.........................................'}}
			            </td>
			        </tr>
			    </table>

			    <table width="100%" style="margin-top: 20px;">
			        <tr>
			            <td width="25%"></td>
			            <td width="25%"></td>
			            <td width="25%"></td>
			            <td width="25%">Surabaya, {{ !is_null($surat_pasien_pulang_rumah_sakit->created_at) ? indonesian_date($surat_pasien_pulang_rumah_sakit->created_at) : '_____________' }}</td>
			        </tr>
			    </table>

			    <table width="100%" style="margin-top: 20px;">
			        <tr>
			            <td align="center"><p>Keluarga yang menjemput</p></td>
			            <td align="center"><p>Dokter yang merawat</p></td>
			        </tr>
			        <tr>
			        	<td><div style="margin-bottom: 50px;"></div></td>
			        	<td align="center">
			        		@if(!is_null($kasus->admin->user->ttd ?? null))
			        			<img src="{{ public_path($kasus->admin->user->ttd ?? '') }}" width="100">
			        		@else
			        			<div style="margin-bottom: 50px;"></div>
			        		@endif
			        	</td>
			        </tr>
			        <tr>
			            <td align="center">
			            	({{$surat_pasien_pulang_rumah_sakit->nama ?? '.........................................'}})
			        	</td>
			            <td align="center">({{$kasus->admin->user->name ?? '.........................................'}})</td>            
			        </tr>
			    </table>		
        	</td>
        </tr>
    </table>
@endsection
