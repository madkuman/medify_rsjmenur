@extends('layouts.print')

@section('title')
Print Penilaian Kualitas Hidup Lansia, Diadaptasi dari EQ-5d
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
    table.bordered, .bordered th, .bordered td {
      	border: 1px solid black;
    }
    .section {
        padding: 5px;
        margin-bottom: 15px;
        border: 1px solid #000;
    }
    ol li.list {
        margin-bottom:10px;
    }
    ol {
        padding-left: 15px;
    }
</style>
@endsection

@section('content')
    <header>
        <table width="100%">
            <tr>
            	<td width="85%"></td>
                <td width="15%" align="center">
                	<div style="border: 1px solid #000; padding: 3px;">
                		RM. 12.K4
                	</div>
                </td>
            </tr>
        </table>
    </header>

    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="15%" align="left">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="50">
                        </td>
                        <td width="70%" align="center">
                            <p style="font-size: 10px;">PEMERINTAH PROVINSI JAWA TIMUR <br>
                            <b>RUMAH SAKIT JIWA MENUR</b> <br>
                            Jln. Menur No. 120, Telp. (031) 5021635, 5021637 <br>
                            <b>SURABAYA</b>
                            </p>
                        </td>
                        <td width="15%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="50">
                        </td>
                   </tr> 
                </table>
            </td>
            <td width="50%">
                <table width="100%" style="margin-left: 25px;">
                    <tr>
                        <td width="40%">No. Rekam Medis</td>
                        <td width="2%">:</td>
                        <td width="58%">{{ $kasus->pasien->no_rm }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir / Umur</td>
                        <td>:</td>
                        <td>{{ date('d-m-Y', strtotime($kasus->identitas->tanggal_lahir)) }} / {{ $kasus->identitas->umur }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 20px;">
        <tr>
            <td align="center">
                <h4>PENILAIAN KUALITAS HIDUP LANDIA, DIADAPTASI DARI EQ-5D</h4>        
            </td>
        </tr>
    </table>

    @php 
		$checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>' 
	@endphp

    <ol type="A">
    	<li><b>PERGERAKAN</b> <br>
    		<ol>
		    	<li>Saya tidak bermasalah untuk berjalan keliling <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">5</th>
		    				<th align="center">4</th>
		    				<th align="center">3</th>
		    				<th align="center">2</th>
		    				<th align="center">1</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_masalah_berjalan_keliling) ? date('d/m/Y', strtotime($item->tanggal_tidak_masalah_berjalan_keliling)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_untuk_berjalan_keliling == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_untuk_berjalan_keliling == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_untuk_berjalan_keliling == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_untuk_berjalan_keliling == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_untuk_berjalan_keliling == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya mengalami masalah untuk berjalan keliling <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_masalah_berjalan_keliling) ? date('d/m/Y', strtotime($item->tanggal_masalah_berjalan_keliling)) : '' }}</th>
			    				<th align="center">{!! $item->saya_mengalami_masalah_untuk_berjalan_keliling == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_masalah_untuk_berjalan_keliling == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_masalah_untuk_berjalan_keliling == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_masalah_untuk_berjalan_keliling == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_masalah_untuk_berjalan_keliling == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya hanya terbaring dikasur <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_terbaring_di_kasur) ? date('d/m/Y', strtotime($item->tanggal_terbaring_di_kasur)) : '' }}</th>
			    				<th align="center">{!! $item->saya_hanya_terbaring_di_kasur == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_hanya_terbaring_di_kasur == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_hanya_terbaring_di_kasur == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_hanya_terbaring_di_kasur == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_hanya_terbaring_di_kasur == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>
		    </ol>
    	</li>

    	<li style="margin-top: 10px;"><b>MENGURUS DIRI</b> <br>
    		<ol>
		    	<li>Saya tidak bermasalah untuk mengurus diri sendiri <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">5</th>
		    				<th align="center">4</th>
		    				<th align="center">3</th>
		    				<th align="center">2</th>
		    				<th align="center">1</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_mengurus_diri_sendiri) ? date('d/m/Y', strtotime($item->tanggal_mengurus_diri_sendiri)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_mengurus_diri_sendiri == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_mengurus_diri_sendiri == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_mengurus_diri_sendiri == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_mengurus_diri_sendiri == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_mengurus_diri_sendiri == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya bermasalah untuk membersihkan dan memakai pakaian sendiri <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_bermasalah_membersihkan_pakaian) ? date('d/m/Y', strtotime($item->tanggal_bermasalah_membersihkan_pakaian)) : '' }}</th>
			    				<th align="center">{!! $item->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_untuk_membersihkan_dan_memakai_pakaian_sendiri == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya tidak mampu sama sekali untuk membersihkan dan memakai pakaian sendiri <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_mampu_sama_sekali_memakai_pakaian) ? date('d/m/Y', strtotime($item->tanggal_tidak_mampu_sama_sekali_memakai_pakaian)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_mampu_memakai_pakaian_sendiri == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_mampu_memakai_pakaian_sendiri == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_mampu_memakai_pakaian_sendiri == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_mampu_memakai_pakaian_sendiri == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_mampu_memakai_pakaian_sendiri == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>
		    </ol>
    	</li>

    	<li style="margin-top: 10px;"><b>AKTIVITAS HARIAN</b> <br>
    		<ol>
		    	<li>Saya tidak bermasalah dalam melakukan aktivitas harian <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">5</th>
		    				<th align="center">4</th>
		    				<th align="center">3</th>
		    				<th align="center">2</th>
		    				<th align="center">1</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_aktivitas_harian) ? date('d/m/Y', strtotime($item->tanggal_aktivitas_harian)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_melakukan_aktivitas_harian == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_melakukan_aktivitas_harian == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_melakukan_aktivitas_harian == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_melakukan_aktivitas_harian == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_bermasalah_melakukan_aktivitas_harian == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya bermasalah dalam melakukan aktivitas harian <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_bermasalah_aktivitas_harian) ? date('d/m/Y', strtotime($item->tanggal_bermasalah_aktivitas_harian)) : '' }}</th>
			    				<th align="center">{!! $item->saya_bermasalah_melakukan_aktivitas == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_melakukan_aktivitas == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_melakukan_aktivitas == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_melakukan_aktivitas == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_bermasalah_melakukan_aktivitas == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya tidak dapat menjalankan aktivitas harian sama sekali <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_dapat_menjalankan_aktivitas) ? date('d/m/Y', strtotime($item->tanggal_tidak_dapat_menjalankan_aktivitas)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_dapat_menjalankan_aktivitas == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_dapat_menjalankan_aktivitas == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_dapat_menjalankan_aktivitas == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_dapat_menjalankan_aktivitas == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_dapat_menjalankan_aktivitas == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>
		    </ol>
    	</li>

    	<li style="margin-top: 10px;"><b>NYERI / SAKIT</b> <br>
    		<ol>
		    	<li>Saya tidak mempunyai keluhan nyeri atau sakit <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">5</th>
		    				<th align="center">4</th>
		    				<th align="center">3</th>
		    				<th align="center">2</th>
		    				<th align="center">1</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_punya_keluhan_nyeri) ? date('d/m/Y', strtotime($item->tanggal_tidak_punya_keluhan_nyeri)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya mempunyai keluhan nyeri atau sakit yang sedang <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_punya_keluhan_nyeri_sedang) ? date('d/m/Y', strtotime($item->tanggal_tidak_punya_keluhan_nyeri_sedang)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_sedang == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_sedang == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_sedang == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_sedang == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_sedang == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya mempunyai keluhan nyeri atau sakit yang berat <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_punya_keluhan_nyeri_berat) ? date('d/m/Y', strtotime($item->tanggal_tidak_punya_keluhan_nyeri_berat)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_berat == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_berat == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_berat == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_berat == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_punya_keluhan_nyeri_berat == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>
		    </ol>
    	</li>

    	<li style="margin-top: 10px;"><b>GELISAH / CEMAS / SEDIH</b> <br>
    		<ol>
		    	<li>Saya tidak gelisah maupun depresi <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">5</th>
		    				<th align="center">4</th>
		    				<th align="center">3</th>
		    				<th align="center">2</th>
		    				<th align="center">1</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_gelisah) ? date('d/m/Y', strtotime($item->tanggal_tidak_gelisah)) : '' }}</th>
			    				<th align="center">{!! $item->saya_tidak_gelisah_maupun_depresi == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_gelisah_maupun_depresi == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_gelisah_maupun_depresi == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_gelisah_maupun_depresi == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_tidak_gelisah_maupun_depresi == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya mengalami gelisah atau depresi sedang <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_tidak_gelisah_maupun_depresi_sedang) ? date('d/m/Y', strtotime($item->tanggal_tidak_gelisah_maupun_depresi_sedang)) : '' }}</th>
			    				<th align="center">{!! $item->saya_mengalami_gelisah_maupun_depresi_sedang == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_gelisah_maupun_depresi_sedang == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_gelisah_maupun_depresi_sedang == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_gelisah_maupun_depresi_sedang == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_gelisah_maupun_depresi_sedang == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>

		    	<li style="margin-top: 10px;">Saya mengalami gelisah maupun depresi berat <br>
		    		<table width="100%" class="bordered">
		    			<tr>
		    				<th align="center">Tanggal</th>
		    				<th align="center">Selalu</th>
		    				<th align="center">Sering</th>
		    				<th align="center">Kadang-kadang</th>
		    				<th align="center">Jarang</th>
		    				<th align="center">Tidak pernah</th>
		    			</tr>
		    			<tr>
		    				<th align="center"></th>
		    				<th align="center">1</th>
		    				<th align="center">2</th>
		    				<th align="center">3</th>
		    				<th align="center">4</th>
		    				<th align="center">5</th>
		    			</tr>

		    			@foreach($penilaian_kualitas_hidup_lansia as $item)
		    				<tr>
			    				<th align="center">{{ !is_null($item->tanggal_gelisah_maupun_depresi_berat) ? date('d/m/Y', strtotime($item->tanggal_gelisah_maupun_depresi_berat)) : '' }}</th>
			    				<th align="center">{!! $item->saya_mengalami_tgelisah_maupun_depresi_berat == 'Selalu' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_tgelisah_maupun_depresi_berat == 'Sering' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_tgelisah_maupun_depresi_berat == 'Kadang kadang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_tgelisah_maupun_depresi_berat == 'Jarang' ? $checked : '' !!}</th>
			    				<th align="center">{!! $item->saya_mengalami_tgelisah_maupun_depresi_berat == 'Tidak pernah' ? $checked : '' !!}</th>
			    			</tr>
		    			@endforeach
		    		</table>
		    	</li>
		    </ol>
    	</li>
    </ol>
    
    <table width="100%">
    	<tr>
    		<td colspan="6">Keterangan :</td>
    	</tr>
    	<tr>
    		<td width="20%">Sangat Baik</td>
    		<td width="2%">:</td>
    		<td width="46%">61-75</td>
    		<td width="20%">Kurang Baik</td>
    		<td width="2%">:</td>
    		<td width="10%">16-30</td>
    	</tr>
    	<tr>
    		<td>Baik</td>
    		<td>:</td>
    		<td>46-60</td>
    		<td>Tidak Baik</td>
    		<td>:</td>
    		<td>1-15</td>
    	</tr>
    	<tr>
    		<td>Cukup</td>
    		<td>:</td>
    		<td>31-45</td>
    		<td></td>
    		<td></td>
    		<td></td>
    	</tr>
    </table>

@endsection