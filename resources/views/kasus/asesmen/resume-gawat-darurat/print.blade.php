<!DOCTYPE html>
<html>
<head>
	<title>RESUME GAWAT DARURAT</title>
	<style type="text/css">
		table{
			font-family: sans-serif;
			width: 100%;
			font-size: 13px;
			border-collapse: collapse;
		}
		.bordered td, .bordered th{
			border: 1px solid black;
			padding-left: 5px;
			padding-right: 5px;
		}
		td{
			vertical-align: top;
		}
		.centered td, .centered{
			text-align: center;
		}
		.margin-minus{
			margin-left: -1px;
			margin-right: -1px;
			margin-bottom: -1px;
		}
		.margin-minus td{
			padding-left: 5px;
			padding-right: 5px;
		}
		.noBorder td{
			border: 1px solid white !important;
			vertical-align: top
		}
		.cbx::after{
			content: "4";
			line-height: 0.6;
			z-index: 100;
			font-family: ZapfDingbats, sans-serif;
		}
		.cb{
			border: 1px solid black;
			display: inline-block;
			width: 7px;
			height: 7px;
			margin-right: 5px;
		}
		.tab{
			padding-left: 20px !important;
		}
		.ml{
			margin-left: 40px;
		}
		.indent{
			padding-left: 45px !important;
		}
		.title{
			padding-top: 20px;
			padding-bottom: 20px;
			text-align: center;
		}
		.outer{
			border: 1px solid black;
		}
		.box{
			height: 60px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="90%"></td>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				RM.06
			</td>
		</tr>
	</table>
	<table style="margin-top: -20px;">
		<tr>
			<td width="55%">
				<table>
					<tr>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/pemprov-jatim.png" height="55">
						</td>
						<td width="60%" style="text-align: center; font-size: 10px;">
							<b>
								PEMERINTAH PROVINSI JAWA TIMUR<br>
								RUMAH SAKIT JIWA MENUR<br>
								Jln Menur No.120, Telp(031)5021635,5021637<br>
								Surabaya
							</b>
						</td>
						<td width="20%" style="text-align: center;">
							<img src="{{url('')}}/assets/img/menur.png" height="55">
						</td>
					</tr>
				</table>
			</td>
			<td width="45%"></td>
		</tr>
	</table>
	<table class="bordered" style="margin-top: 10px; margin-bottom: 10px;">
		<tr>
			<td class="title"><b style="font-size: 17px">RESUME GAWAT DARURAT</b><br>(diisi oleh dokter)</td>
		</tr>
	</table>
	<table class="bordered" style="border-collapse: separate; margin-bottom: 10px;">
		<tr>
			<td width="32%" class="centered box"><b>ALERGI: </b><br>{{$item->alergi}}
			</td>
			<td width="32%" class="centered box"><b>RISIKO: </b><br>{{$item->risiko}}
			</td>
			<td width="36%" class="centered box"><b>TANGGAL DAN JAM: </b><br> {{date('j F Y', strtotime($item->created_at))}}, {{date('H:i', strtotime($item->created_at))}}
			</td>
		</tr>
	</table>
	<table class="margin-minus outer" cellpadding="3">
		<tr>
			<td><b>I.</b></td>
			<td><b>DIAGNOSA</b></td>
			<td>:</td>
			<td colspan="2">{{$kasus->diagnosisUtama->icd10->code_icd}} - {{$kasus->diagnosisUtama->icd10->long_desc}}</td>
		</tr>
		<tr>
			<td><b>II.</b></td>
			<td><b>TERAPI</b></td>
			<td>:</td>
			<td colspan="2">
				@foreach($kasus->resep as $resep)
				@foreach($resep->resepDetail as $detail)
				{{($detail->kategori == 'racikan') ? $detail->racikan : $detail->obat_name}}, {{$detail->jumlah}} {{$detail->type}} <br>				
				@endforeach
				@endforeach
			</td>
		</tr>
		<tr>
			<td><b>III.</b></td>
			<td colspan="4"><b>TINDAK LANJUT</b></td>
		</tr>
		<tr>
			<td width="2%"></td>
			<td width="30%">A. Pulang</td>
			<td>:</td>
			<td width="25%"><div class="cb @if($item->pulang == 'Tidak') cbx @endif"></div>Tidak</td>
			<td width="43%"><div class="cb @if($item->pulang == 'Ya') cbx @endif"></div>Ya, kontrol ulang tanggal {{$item->kontrol_ulang_tanggal ? date('j F Y', strtotime($item->kontrol_ulang_tanggal)) : '-'}}</td>
		</tr>
		<tr>
			<td colspan="4"></td>
			<td class="tab">di {{$item->kontrol_ulang_di ?? '...........................................'}}</td>
		</tr>
		<tr>
			<td></td>
			<td>B. Pulang atas permintaan keluarga</td>
			<td>:</td>
			<td><div class="cb @if($item->pulang_atas_permintaan_keluarga == 'Tidak') cbx @endif"></div>Tidak</td>
			<td><div class="cb @if($item->pulang_atas_permintaan_keluarga == 'Ya') cbx @endif"></div>Ya</td>
		</tr>
		<tr>
			<td></td>
			<td>C. Observasi</td>
			<td>:</td>
			<td><div class="cb @if($item->observasi == 'Tidak') cbx @endif"></div>Tidak</td>
			<td><div class="cb @if($item->observasi == 'Ya') cbx @endif"></div>Ya, pulang jam {{$item->pulang_jam}}</td>
		</tr>
		<tr>
			<td></td>
			<td>D. MRS</td>
			<td>:</td>
			<td><div class="cb @if($item->mrs == 'Tidak') cbx @endif"></div>Tidak / Menolak, alasan :</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_menolak_mrs_masalah_biaya == '1') cbx @endif"></div> Masalah Biaya</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_menolak_mrs_masalah_lokasi_rumah == '1') cbx @endif"></div> Masalah Lokasi Rumah</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_menolak_mrs_masalah_kondisi_pasien == '1') cbx @endif"></div> Masalah Kondisi Pasien</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_lainnya != '') cbx @endif"></div> Lainnya, {{$item->alasan_lainnya}}</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2"><div class="cb @if($item->mrs == 'Ya') cbx @endif"></div> Ya, dirawat di ruang {{$item->dirawat_di_ruang}}</td>
		</tr>
		<tr>
			<td></td>
			<td>E. Dirujuk</td>
			<td>:</td>
			<td><div class="cb @if($item->dirujuk == 'Tidak') cbx @endif"></div>Tidak</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2"><div class="cb @if($item->dirujuk == 'Ya') cbx @endif"></div> Ya, alasan :</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_dirujuk_tempat_penuh == '1') cbx @endif"></div> Tempat penuh</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_dirujuk_perlu_fasilitas_lebih == '1') cbx @endif"></div> Perlu fasilitas lebih</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_dirujuk_permintaan_pasien_dan_keluarga == '1') cbx @endif"></div> Permintaan pasien dan keluarga</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="2" class="indent"><div class="cb @if($item->alasan_lain != '') cbx @endif"></div> Lainnya, {{$item->alasan_lain}}</td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">Dokter</td>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td colspan="5"><br><br></td>
		</tr>
		<tr>
			<td></td>
			<td class="centered">{{$kasus->dpjp->user->name}}</td>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td colspan="5"><br></td>
		</tr>
	</table>
</body>
</html>