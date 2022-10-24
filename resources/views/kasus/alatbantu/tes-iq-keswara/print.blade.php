@extends('layouts.print')

@section('title')
Print Pemeriksaan Psikologi Keswara - {{$kasus->identitas->nama}}
@endsection

@section('css')
<style type="text/css">
    body, p {
        font-size: 13px;
        font-family: Dejavu Sans;
        /*line-height: 16px;*/
    }
    
    table.bordered {
      border-collapse: collapse;
    }
    table.bordered, .bordered th, .bordered td {
      border: 1px solid black;
    }
    .word-break {
        word-wrap: break-word;width:100%;
    }
    .footer {
        width: 100%;
        text-align: right;
        position: fixed;
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }
</style>
@endsection

@section('content')
    {{-- <div class="footer">
        Psikologi Keswara - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$tes_iq_keswara->id.'}'}} | Halaman <span class="pagenum"></span> of 2
    </div> --}}

    <table width="100%" align="center" style="border-bottom: 5px double #000;">
        <tr>
            <td width="100%" valign="top">
                <table width="100%" cellpadding="5">
                   <tr>
                        <td width="20%" align="right">
                            <img src="{{ asset('assets/img/logo/jer_basuki_mawa_beya.png') }}" height="80">
                        </td>
                        <td width="60%" align="center">
                            <p style="font-size: 14px;"><b>PEMERINTAH PROVINSI JAWA TIMUR</b></p>
                            <p style="font-size: 22px;"><b>RUMAH SAKIT JIWA MENUR</b></p>
                            <p style="font-size: 10px;">Jln. Menur No. 120, Telp. (031) 5021635, 5021637</p>
                        </td>
                        <td width="20%" align="left">
                            <img src="{{ asset('assets/img/logo/rsj_menur_logo.png') }}" height="80">
                        </td>
                   </tr> 
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="5" style="margin-top: 15px;">
        <tr>
            <td width="90%"></td>
            <td width="15%" align="center" bgcolor="#000" style="border: 3px solid #d9d9d9;">
                <p style="font-size: 14px; color: #fff;"><b>rahasia</b></p>
            </td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td align="center"><p style="font-size: 12"><b><u>HASIL EVALUASI PSIKOLOGI</u></b></p></td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;" cellpadding="3">
    	<tr>
    		<td colspan="3"><b>Identitas</b></td>
    	</tr>
        <tr>
            <td width="23%">Nama</td>
            <td width="2%">:</td>
            <td width="76%"><b>{{ $kasus->identitas->nama ?? '-' }}</b></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $kasus->identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td>{{ $kasus->identitas->umur ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pendidikan</td>
            <td>:</td>
            <td>{{ $kasus->pasien->pendidikan->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $kasus->identitas->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td>:</td>
            <td>{{ !is_null($tes_iq_keswara->tanggal_pemeriksaan) ? indonesian_date($tes_iq_keswara->tanggal_pemeriksaan) : '_________________'}}</td>
        </tr>
    </table>

    <table width="100%" class="" style="margin-top: 20px;">
    	<tr>
    		<td width="3%"><b>I.</b></td>
    		<td width="97%"><b>Alasan Pengiriman</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>{{ $tes_iq_keswara->alasan_pengiriman ?? '-'}}</td>
    	</tr>
    	<tr>
    		<td style="padding-top: 15px;"><b>II.</b></td>
    		<td style="padding-top: 15px;"><b>Observasi Umum</b></td>
    	</tr>

    	@php 
			$checked = '<div style="font-family: ZapfDingbats, sans-serif;">4</div>';
		@endphp

    	<tr>
    		<td style="padding-top: 10px;"><b>A.</b></td>
    		<td style="padding-top: 10px;"><b>Sikap terhadap tester dan situasi tes</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">1.</td>
    					<td width="40%">Bisa bekerja sama</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->bisa_bekerja_sama == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->bisa_bekerja_sama == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->bisa_bekerja_sama == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->bisa_bekerja_sama == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->bisa_bekerja_sama == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Tidak mau bekerja sama</td>
    				</tr>
    				<tr>
    					<td>2.</td>
    					<td>Aktif</td>
    					<td align="center">{!! $tes_iq_keswara->aktif == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->aktif == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->aktif == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->aktif == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->aktif == 'RS' ? $checked : '' !!}</td>
    					<td>Pasif</td>
    				</tr>
    				<tr>
    					<td>3.</td>
    					<td>Tenang</td>
    					<td align="center">{!! $tes_iq_keswara->sikap_tenang == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->sikap_tenang == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->sikap_tenang == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->sikap_tenang == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->sikap_tenang == 'RS' ? $checked : '' !!}</td>
    					<td>Tegang</td>
    				</tr>
    				<tr>
    					<td>4.</td>
    					<td>Mudah menjawab</td>
    					<td align="center">{!! $tes_iq_keswara->mudah_menjawab == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->mudah_menjawab == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->mudah_menjawab == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->mudah_menjawab == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->mudah_menjawab == 'RS' ? $checked : '' !!}</td>
    					<td>Sulit menjawab</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>B.</b></td>
    		<td><b>Sikap terhadap diri sendiri</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">5.</td>
    					<td width="40%">Yakin</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->yakin == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->yakin == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->yakin == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->yakin == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->yakin == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Ragu-ragu</td>
    				</tr>
    				<tr>
    					<td>6.</td>
    					<td>Kritis</td>
    					<td align="center">{!! $tes_iq_keswara->kritis == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->kritis == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->kritis == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->kritis == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->kritis == 'RS' ? $checked : '' !!}</td>
    					<td>Menerima</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>C.</b></td>
    		<td><b>Cara kerja</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">7.</td>
    					<td width="40%">Cepat</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cepat == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cepat == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cepat == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cepat == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cepat == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Lambat</td>
    				</tr>
    				<tr>
    					<td>8.</td>
    					<td>Hati-hati</td>
    					<td align="center">{!! $tes_iq_keswara->hati_hati == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->hati_hati == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->hati_hati == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->hati_hati == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->hati_hati == 'RS' ? $checked : '' !!}</td>
    					<td>Ceroboh</td>
    				</tr>
    				<tr>
    					<td>9.</td>
    					<td>Berpikir cepat</td>
    					<td align="center">{!! $tes_iq_keswara->berpikir_cepat == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->berpikir_cepat == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->berpikir_cepat == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->berpikir_cepat == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->berpikir_cepat == 'RS' ? $checked : '' !!}</td>
    					<td>Berpikir lambat</td>
    				</tr>
    				<tr>
    					<td>10.</td>
    					<td>Rapi</td>
    					<td align="center">{!! $tes_iq_keswara->rapi == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->rapi == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->rapi == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->rapi == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->rapi == 'RS' ? $checked : '' !!}</td>
    					<td>Sembarangan</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>D.</b></td>
    		<td><b>Perilaku</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">11.</td>
    					<td width="40%">Tenang</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->perilaku_tenang == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->perilaku_tenang == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->perilaku_tenang == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->perilaku_tenang == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->perilaku_tenang == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Hiperaktif</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>E.</b></td>
    		<td><b>Reaksi terhadap kegagalan</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">12.</td>
    					<td width="40%">Mengetahui</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->mengetahui == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->mengetahui == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->mengetahui == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->mengetahui == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->mengetahui == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Tidak tahu</td>
    				</tr>
    				<tr>
    					<td>13.</td>
    					<td>Bekerja keras</td>
    					<td align="center">{!! $tes_iq_keswara->bekerja_keras == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->bekerja_keras == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->bekerja_keras == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->bekerja_keras == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->bekerja_keras == 'RS' ? $checked : '' !!}</td>
    					<td>Kurang usaha</td>
    				</tr>
    				<tr>
    					<td>14.</td>
    					<td>Tenang</td>
    					<td align="center">{!! $tes_iq_keswara->reaksi_gagal_tenang == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->reaksi_gagal_tenang == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->reaksi_gagal_tenang == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->reaksi_gagal_tenang == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->reaksi_gagal_tenang == 'RS' ? $checked : '' !!}</td>
    					<td>Gelisah</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>F.</b></td>
    		<td><b>Reaksi dan cara bicara</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">15.</td>
    					<td width="40%">Tenang</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_tenang == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_tenang == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_tenang == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_tenang == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_tenang == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Janggal</td>
    				</tr>
    				<tr>
    					<td>16.</td>
    					<td>Semakin giat</td>
    					<td align="center">{!! $tes_iq_keswara->semakin_giat == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->semakin_giat == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->semakin_giat == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->semakin_giat == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->semakin_giat == 'RS' ? $checked : '' !!}</td>
    					<td>Kurang bergairah</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>G.</b></td>
    		<td><b>Bahasa dan cara bicara</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">17.</td>
    					<td width="40%">Cara bicara baik</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cara_bicara_baik == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cara_bicara_baik == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cara_bicara_baik == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cara_bicara_baik == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->cara_bicara_baik == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Kurang baik</td>
    				</tr>
    				<tr>
    					<td>18.</td>
    					<td>Jawaban jelas</td>
    					<td align="center">{!! $tes_iq_keswara->jawaban_jelas == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->jawaban_jelas == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->jawaban_jelas == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->jawaban_jelas == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->jawaban_jelas == 'RS' ? $checked : '' !!}</td>
    					<td>Tidak jelas/tidak dapat dimengerti</td>
    				</tr>
    				<tr>
    					<td>19.</td>
    					<td>Spontan</td>
    					<td align="center">{!! $tes_iq_keswara->spontan == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->spontan == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->spontan == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->spontan == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->spontan == 'RS' ? $checked : '' !!}</td>
    					<td>Hanya bicara jika ditanya</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>H.</b></td>
    		<td><b>Visual motorik</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">20.</td>
    					<td width="40%">Reaksi Cepat</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_cepat == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_cepat == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_cepat == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_cepat == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->reaksi_cepat == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Reaksi Lambat</td>
    				</tr>
    				<tr>
    					<td>21.</td>
    					<td>Coba-coba</td>
    					<td align="center">{!! $tes_iq_keswara->coba_coba == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->coba_coba == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->coba_coba == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->coba_coba == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->coba_coba == 'RS' ? $checked : '' !!}</td>
    					<td>Hati-hati dan sistematis</td>
    				</tr>
    				<tr>
    					<td>22.</td>
    					<td>Gerakan Baik</td>
    					<td align="center">{!! $tes_iq_keswara->gerakan_baik == 'TS' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->gerakan_baik == 'T' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->gerakan_baik == 'S' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->gerakan_baik == 'R' ? $checked : '' !!}</td>
    					<td align="center">{!! $tes_iq_keswara->gerakan_baik == 'RS' ? $checked : '' !!}</td>
    					<td>Gerakan janggal</td>
    				</tr>
    			</table>
    		</td>
    	</tr>

    	<tr>
    		<td><b>I.</b></td>
    		<td><b>Motorik</b></td>
    	</tr>
    	<tr>
    		<td></td>
    		<td>
    			<table width="100%" class="bordered" cellpadding="3">
    				<tr>
    					<td width="5%">23.</td>
    					<td width="40%">Koordinasi baik</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->koordinasi_baik == 'TS' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->koordinasi_baik == 'T' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->koordinasi_baik == 'S' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->koordinasi_baik == 'R' ? $checked : '' !!}</td>
    					<td width="5%" align="center">{!! $tes_iq_keswara->koordinasi_baik == 'RS' ? $checked : '' !!}</td>
    					<td width="40%">Koordinasi kurang baik</td>
    				</tr>
    			</table>
    		</td>
    	</tr>
    </table>

    {{-- <div style="page-break-after: always;"></div> --}}

    <table width="100%" class="" style="margin-top: 20px;">
    	<tr>
    		<td width="3%"><b>III.</b></td>
    		<td width="97%"><b>Hasil Tes</b></td>
    	</tr>
    	<tr>
    		<td colspan="2"><b>Intelegensi Umum : {{ $tes_iq_keswara->intelegensi_umum ?? '-' }}</b></td>
    	</tr>
    </table>

    <table width="100%" class="bordered" cellpadding="3" style="margin-top: 20px;">
    	<tr>
    		<th width="15%" rowspan="2" align="center">Aspek Psikologis</th>
    		<th width="27%" rowspan="2" align="center">Gambaran keadaan anak jika memperoleh skor / nilai tinggi</th>
    		<th width="5%" align="center">TS</th>
    		<th width="7%" colspan="2" align="center">T</th>
    		<th width="7%" colspan="2" align="center">S</th>
    		<th width="7%" colspan="2" align="center">R</th>
    		<th width="5%" align="center">RS</th>
    		<th width="27%" rowspan="2" align="center">Gambaran keadaan anak jika memperoleh skor / nilai rendah</th>
    	</tr>
    	<tr>
    		<th align="center">8</th>
    		<th align="center">7</th>
    		<th align="center">6</th>
    		<th align="center">5</th>
    		<th align="center">4</th>
    		<th align="center">3</th>
    		<th align="center">2</th>
    		<th align="center">1</th>
    	</tr>

    	<tr>
    		<td align="center">Pengertian Umum</td>
    		<td align="center">Telah memahami dan mengerti hal-hal/kejadian di lingkungan sekitarnya. Mampu memahami fungsi suatu benda dan bisa mencari pemecahan masalah yang tepat</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'TS' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'T1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'T2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'S1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'S2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'R1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'R2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pengertian_umum == 'RS' ? $checked : '' !!}</td>
    		<td align="center">Belum dapat memahami hal/kejadian di lingkungan sekitarnya, dan belum dapat memberikan pemecahan masalah yang tepat.</td>
    	</tr>
    	<tr>
    		<td align="center">Kemampuan Visual-Motor</td>
    		<td align="center">Mampu mengkoordinasikan penglihatan dan gerakan tangan dengan baik</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'TS' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'T1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'T2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'S1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'S2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'R1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'R2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_visual_motor == 'RS' ? $checked : '' !!}</td>
    		<td align="center">Belum dapat mengkoordinasikan penglihatan dan gerakan tangan dengan baik</td>
    	</tr>
    	<tr>
    		<td align="center">Kemampuan Berhitung</td>
    		<td align="center">Sudah memiliki konsep mengenai angka dan hitungan dengan benar</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'TS' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'T1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'T2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'S1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'S2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'R1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'R2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_berhitung == 'RS' ? $checked : '' !!}</td>
    		<td align="center">Belum memiliki konsep mengenai angka dan hitungan</td>
    	</tr>
    	<tr>
    		<td align="center">Kemampuan mengingat dan Berkonsentrasi</td>
    		<td align="center">Mampu memusatkan perhatian pada satu hal secara menetap dan lama</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'TS' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'T1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'T2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'S1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'S2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'R1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'R2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->kemampuan_mengingat_dan_berkonsentrasi == 'RS' ? $checked : '' !!}</td>
    		<td align="center">Belum dapat memusatkan perhatian pada satu hal secara menetap dan lama</td>
    	</tr>
    	<tr>
    		<td align="center">Perbendaharaan Kata</td>
    		<td align="center">Memiliki banyak perbendaharaan kata dan mampu memaparkan dengan baik.</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'TS' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'T1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'T2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'S1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'S2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'R1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'R2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->perbendaharaan_kata == 'RS' ? $checked : '' !!}</td>
    		<td align="center">Perbendaharaan kata relatif sedikit dan belum mampu untuk memaparkan dengan baik pada orang lain</td>
    	</tr>
    	<tr>
    		<td align="center">Pemahaman dan penalaran</td>
    		<td align="center">Mudah memahami suatu persoalan dan bisa menggunakan daya nalar / logika berpikir untuk membuat keputusan</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'TS' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'T1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'T2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'S1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'S2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'R1' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'R2' ? $checked : '' !!}</td>
    		<td align="center">{!! $tes_iq_keswara->pemahaman_dan_penalaran == 'RS' ? $checked : '' !!}</td>
    		<td align="center">Cenderung membutuhkan waktu lama untuk memahami suatu persoalan dan sering mengalami kesulitan dalam menggunakan logika berpikir</td>
    	</tr>
    </table>

    <div style="page-break-after: always;"></div>

    <table width="100%" class="" cellpadding="3">
    	<tr>
    		<td><b>IV. Ringkasan Dan Saran</b></td>
    	</tr>
    	<tr>
    		<td>
                <div class="word-break">
                    {!! nl2br(e($tes_iq_keswara->ringkasan_dan_saran ?? '-')) !!}
                </div>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<p style="margin-top: 30px;">
    			    <b>Catatan:</b>  
                    <div class="word-break">
                        {!! nl2br(e($tes_iq_keswara->catatan ?? "-")) !!}
                    </div>
    			</p>
    		</td>
    	</tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">Surabaya, {{ !is_null($tes_iq_keswara->created_at) ? indonesian_date($tes_iq_keswara->created_at) : '_____________' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Psikolog</b></td>
        </tr>
		@if(isset($tes_iq_keswara->creator->ttd) && !empty($tes_iq_keswara->creator->ttd))
			<tr>
				<td></td>
				<td align="center" height="50"><img src="{{{url('')}}}/{{{$tes_iq_keswara->creator->ttd}}}" height="50px"></td>
			</tr>
		@else
			<tr>
				<td></td>
				<td align="center" height="50"></td>
			</tr>
		@endif
        <tr>
            <td></td>
            <td align="center">
            	<p><u>{{$tes_iq_keswara->creator->name ?? '.........................................'}}</u></p>
            </td>
        </tr>
    </table>
@endsection

@section('scripts')
<script type="text/php">
    if (isset($pdf)) {
        $x = $pdf->get_width() - 300;
        $y = $pdf->get_height() - 34;
        $text = "Psikologi Keswara - {{'{'.$kasus->nomor_kasus.'}'}}{{'{'.$tes_iq_keswara->id.'}'}} | Halaman {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 9;
        $color = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle = 0.0;
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script> 
@endsection