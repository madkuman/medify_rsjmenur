@extends('layouts.print')

@section('title')
Print Surat Keterangan Dalam Perawatan - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
        /*line-height: 16px;*/
    }
    
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }

    table.separated {
      border-collapse: separate;
      border-spacing: 10px;
    }
    .separated th, .separated td {
      border: 1px solid black;
    }
    table.no-border td {
        border: none;
    }
</style>
@endsection

@section('content')
    <table cellpadding="5" align="right">
        <tr>
            <td width="90%"></td>
            <td width="10%" align="center" style="border: 1px solid #000;">RM. 15</td>
        </tr>
    </table>

    <table width="80%" align="center">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="60">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 12px;">PEMERINTAH PROVINSI JAWA TIMUR</p>
                            <p style="font-size: 12px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                            <p style="font-size: 11px;"><b>SURABAYA</b></p>
                        </td>
                        <td width="25%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="60">
                        </td>
                   </tr> 
                </table>
            </td>
        </tr>
    </table>

    <table class="bordered" width="100%" cellpadding="5">
        <tr>
            <td align="center">
                <p style="font-size: 14px;"><b>SURAT KETERANGAN DALAM PERAWATAN</b></p>
            </td>
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="15%">No. RM</td>
                        <td width="85%">: {{ $kasus->pasien->no_rm ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>: {{ $kasus->identitas->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir / Umur</td>
                        <td>: {{!is_null($kasus->identitas->tanggal_lahir ) ? indonesian_date($kasus->identitas->tanggal_lahir ): '-'}} / {{ $kasus->identitas->umur ?? '-' }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $kasus->identitas->alamat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No. BPJS</td>
                        <td>: {{ $kasus->sep->no_bpjs ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No. SEP</td>
                        <td>: {{ $kasus->sep->no_sep ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td width="20%">Diagnosa</td>
                        <td width="2%">:</td>
                        <td width="78%">
                        	{{ $kasus->diagnosisUtama->icd10->code_icd ?? '-' }} {{ $kasus->diagnosisUtama->icd10->long_desc ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td valign="top">Terapi</td>
                        <td valign="top">:</td>
                        <td>
                        	@php 
							$terapi = json_decode($surat_keterangan_dalam_perawatan->terapi);
							@endphp
                            <table width="100%">
                            	@if (count($terapi) > 0)
	                                @foreach($terapi as $item)
	                                <tr>
	                                    <td width="3%">{{$loop->iteration}}.</td>
	                                    <td width="97%">{{ $item ?? '-' }}</td>
	                                </tr>
	                                @endforeach
	                                @else
	                                <tr>
	                                	<td>-</td>
	                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Tangal Surat Rujukan</td>
                        <td>:</td>
                        <td>{{!is_null($surat_keterangan_dalam_perawatan->tanggal_surat_rujukan) ? indonesian_date($surat_keterangan_dalam_perawatan->tanggal_surat_rujukan) : '-'}}</td>
                    </tr>
                    <tr>
                        <td>No. Rujukan</td>
                        <td>:</td>
                        <td>{{ $surat_keterangan_dalam_perawatan->no_rujukan ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="no-border" width="100%">
                    <tr>
                        <td colspan="3">Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan : </td>
                    </tr>
                    @php 
						$alasan = json_decode($surat_keterangan_dalam_perawatan->alasan);
					@endphp
					
                    <tr>
                        <td colspan="3">
                        	@if (count($alasan) > 0)
                        	<ol>
                        		@foreach($alasan as $item)
                        		<li>{{ $item ?? '-' }}</li>
                        		@endforeach
                        	</ol>
                        	@else
                        	-
                        	@endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3">Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya :</td>
                    </tr>

                    @php 
						$rencana_kunjungan = json_decode($surat_keterangan_dalam_perawatan->rencana_kunjungan);
					@endphp
					
                    <tr>
                        <td colspan="3">
                        	@if (count($rencana_kunjungan) > 0)
                        	<ol>
                        		@foreach($rencana_kunjungan as $item)
                        		<li>{{ $item ?? '-' }}</li>
                        		@endforeach
                        	</ol>
                        	@else
                        	-
                        	@endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3">Surat Keterangan ini digunakan untuk  1 (satu) kali kunjungan dengan diagnosa di atas pada :</td>
                    </tr>
                    <tr>
                        <td width="15%">Tanggal</td>
                        <td width="50%">: {{!is_null($surat_keterangan_dalam_perawatan->tanggal_surat_keterangan) ? indonesian_date($surat_keterangan_dalam_perawatan->tanggal_surat_keterangan) : '-'}}</td>
                        <td width="35%"></td>
                    </tr>
                    <tr>
                        <td>No. Antrian</td>
                        <td>: {{ $surat_keterangan_dalam_perawatan->no_antrian ?? '-' }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="center">Surabaya, {{!is_null($surat_keterangan_dalam_perawatan->created_at) ? indonesian_date($surat_keterangan_dalam_perawatan->created_at) : '_____________'}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="center">Dokter Rumah Sakit</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="center" height="50"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="center">{{$kasus->admin->user->name ?? '.........................................'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection