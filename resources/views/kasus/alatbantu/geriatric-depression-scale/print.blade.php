@extends('layouts.print')

@section('title')
Print Geriatric Depression Scale
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
            	<td width="90%"></td>
                <td width="10%" align="center">
                	<div style="border: 1px solid #000; padding: 3px;">
                		RM. 12.K3
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

    <table width="100%">
        <tr>
            <td align="center">
                <h4><i>GERIATRIC DEPRESSION SCALE / GDS</i></h4>        
            </td>
        </tr>
        <tr>
        	<td>Bila ada keluhan atau indikasi depresi, mohon diisi instrumen berikut !</td>
        </tr>
        <tr>
        	<td>Pilihlah jawaban yang paling tepat, yang sesuai dengan perasaan pasuen / responden dalam dua minggu terakhir.</td>
        </tr>
    </table>

    <table width="100%" class="bordered" cellpadding="5">
    	<tr>
    		<th width="5%" align="center">NO</th>
    		<th width="75%" align="center">PERASAAN</th>
    		<th width="10%" align="center">YA</th>
    		<th width="10%" align="center">TIDAK</th>
    	</tr>
    	<tr>
    		<td align="center">1.</td>
    		<td>Apakah anda sebenarnya puas dengan kehidupan anda?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_telah_puas_dengan_kehidupan == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_telah_puas_dengan_kehidupan == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">2.</td>
    		<td>Apakah anda telah meninggalkan banyak kegiatan dan minat atau kesenangan anda?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_telah_meninggalkan_banyak_kegiatan == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_telah_meninggalkan_banyak_kegiatan == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">3.</td>
    		<td>Apakah anda merasa kehidupan anda kosong?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_kehidupan_kosong == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_kehidupan_kosong == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">4.</td>
    		<td>Apakah anda sering merasa bosan?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_sering_bosan == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_sering_bosan == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">5.</td>
    		<td>Apakah anda mempunyai semangan yang baik setiap saat?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_punya_semangan_baik == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_punya_semangan_baik == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">6.</td>
    		<td>Apakah anda takut bahwa sesuatu yang buruk akan terjadi pada anda?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_takut_akan_sesuatu_buruk == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_takut_akan_sesuatu_buruk == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">7.</td>
    		<td>Apakah anda merasa bahagia untuk sebagian besar hidup anda?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_bahagia == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_bahagia == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">8.</td>
    		<td>Apakah anda sering merasa tidak berdaya?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_tidak_berdaya == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_tidak_berdaya == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">9.</td>
    		<td>Apakah anda lebih senang tinggal dirumah daripada pergi ke luar dan mengerjakan sesuatu hal yang baru?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_senang_tinggal_dirumah == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_senang_tinggal_dirumah == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">10.</td>
    		<td>Apakah anda merasa mempunyai banyak masalah dengan daya ingat anda dibandingkan kebanyakan orang?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_punya_banyak_masalah == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_punya_banyak_masalah == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">11.</td>
    		<td>Apakah anda pikir bahwa hidup anak sekarang ini menyenangkan?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_berpikir_hidup_menyenangkan == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_berpikir_hidup_menyenangkan == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">12.</td>
    		<td>Apakah anda merasa tidak berharga seperti perasaan anda?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_tidak_berharga == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_tidak_berharga == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">13.</td>
    		<td>Apakah anda merasa penuh semangat?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_penuh_semangat == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_penuh_semangat == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">14.</td>
    		<td>Apakah anda merasa bahwa keaadaan anda tidak ada harapan?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_tidak_ada_harapan == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_merasa_tidak_ada_harapan == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td align="center">15.</td>
    		<td>Apakah anda pikir orang lain lebih baik keadaannya dari anda?</td>
    		<td align="center">
    			{{ $gds->apakah_anda_pikir_orang_lain_lebih_baik == 'Ya' ? 'YA' : ''}}
    		</td>
    		<td align="center">
    			{{ $gds->apakah_anda_pikir_orang_lain_lebih_baik == 'Tidak' ? 'TIDAK' : ''}}
    		</td>
    	</tr>
    	<tr>
    		<td colspan="2" align="center">SKOR</td>
    		<td></td>
    		<td></td>
    	</tr>
    </table>

    <table width="100%">
    	<tr>
    		<td>Setiap jawaban mempunyai nilai 1</td>
    	</tr>
    	<tr>
    		<td>Skor antara 5-9 menunjukkan kemungkinan besar depresi</td>
    	</tr>
    	<tr>
    		<td>Skor 10 atau lebih menunjukkan depresi</td>
    	</tr>
    </table>

@endsection