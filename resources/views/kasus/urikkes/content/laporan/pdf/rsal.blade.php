<!DOCTYPE html>
<html>
<style type="text/css">
	html{
		padding: 0%;
		height: 100%;
	}
	body{
		font-size: 14px;
		height: 100%;
		font-family: sans-serif;
	}
	table{
		border-collapse: collapse;
	}
	.noBorderY{
		border: 1px solid black;

		border-bottom: 0;
		border-top: 0;
	}
	.noBorderLeft{
		border: 1px solid black;

		border-left: 0;
		vertical-align: top;
	}
	.noBorderRight{
		border: 1px solid black;

		border-right: 0;
		vertical-align: top;
	}
	.noBorder{
		border: 0;
	}
	.bordered{
		border: 1px solid black;
	}


	.table-title{
		padding-bottom: 5px;
		padding-top: 5px;
	}
	td div { 
		height: 33px;
		overflow: hidden; 
	}
	td{
		padding-left: 5%
		white-space: pre;
		padding-top: 0px;
		padding-bottom: 0px;
	}
	hr {
		border: none;
		height: 1px;
		/* Set the hr color */
		color: #333; /* old IE */
		background-color: #333; /* Modern Browsers */
	}
	.underlined{
		border-bottom: 1px solid currentColor;
		line-height: 0.85;
	}
</style>
<head>
	<title>Laporan Kegiatan Kesehatan - Laporan Lab</title>
</head>
<body>
	<div style="text-align: center; position: absolute; width: 22.8%;">
		{{config('app.name')}}
		<hr>
	</div>
	<div style="align-content: center; text-align: center;">
		<div style="margin-bottom: 8px">
			<img src="{{asset('assets/img/rumkital.png')}}" width="13%">
		</div>
		<span class="underlined">HASIL PEMERIKSAAN LABORATORIUM</span>
	</div>
	<table width="100%" class="noBorder">
		<tr>
			<th width="15%">&nbsp;</th>
			<th width="1%">&nbsp;</th>
			<th width="44%">&nbsp;</th>
			<th width="15%">&nbsp;</th>
			<th width="1%">&nbsp;</th>
			<th width="24%">&nbsp;</th>
		</tr>
		<tr>
			<td>Nama</td>
			<td>: </td>
			<td>{{$identitas->nama}}</td>
			<td>Umur</td>
			<td>: </td>
			<td>{{$identitas->age_year}} Tahun</td>
		</tr>
		<tr>
			<td>Pangkat/NRP</td>
			<td>: </td>
			<td>@if(!empty($pasien->tni_pangkat_singkat)) {{$pasien->tni_pangkat_singkat}} @else - @endif &nbsp;&nbsp;&nbsp; NRP. {{$pasien->tni_nrp}}</td>
			<td>Jenis Kelamin</td>
			<td>: </td>
			<td>@if($pasien->gender == 1) Laki-laki @else Perempuan @endif</td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>: </td>
			<td>{{$pasien->tni_jabatan ?? '-'}}</td>
			<td>Tgl Periksa</td>
			<td>: </td>
			<td>{{$tgl_periksa}}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: </td>
			<td>{{$pasien->address}}</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table width="100%" style="border:0; margin-top: 10px">
		<tr style="border:0;">
			<th  width="50%" style="padding-left: 20px;">
				<b><u>HEMATOLOGI</u></b>
			</th>
			<th width="50%" style="padding-left: 20px;">
				<b><u>KIMIA KLINIK</u></b>
			</th>
		</tr>
	</table>
	<table style="width: 100vw">
		<tr>
			<td class="bordered table-title" style="text-align: center; width: 20%;">PEMERIKSAAN</td>
			<td class="bordered table-title" style="text-align: center; width: 10%;">HASIL</td>
			<td class="bordered table-title" style="text-align: center; width: 20%;">NORMAL</td>
			<td class="bordered table-title" style="text-align: center; width: 20%;">PEMERIKSAAN</td>
			<td class="bordered table-title" style="text-align: center; width: 10%;">HASIL</td>
			<td class="bordered table-title" style="text-align: center; width: 20%;">NORMAL</td>
		</tr>
		<tr>
			<td rowspan="3" class="bordered">Hemoglobin</td>
			<td rowspan="3" class="bordered text-center">@if(isset($darah)){{$darah->hemoglobin}}@endif</td>
			<td rowspan="3" class="bordered">L. 13,5 - 17,0 g% <br> P.12,0 - 14,0 g%</td>
			<td class="noBorderY">Bilirubin direk</td>
			<td class="noBorderY text-center">@if(isset($darah)){{$darah->bilirubin_direk}}@endif</td>
			<td class="noBorderY">0,0 - 0,3 mg/dl</td>
		</tr>
		<tr>
			<td class="noBorderY">Bilirubin indirek</td>
			<td class="noBorderY text-center">@if(isset($darah)){{$darah->bilirubin_indirek}}@endif</td>
			<td class="noBorderY">0,0 - 0,7 mg/dl</td>
		</tr>
		<tr>
			<td class="noBorderY">Bilirubin total</td>
			<td class="noBorderY text-center">@if(isset($darah)){{$darah->bilirubin_total}}@endif</td>
			<td class="noBorderY">0,0 - 1,2 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">Lekosit</td>
			<td class="bordered">@if(isset($darah)){{$darah->leukosit}}@endif</td>
			<td class="bordered">5000 - 10000/mm<sup>3</sup></td>
			<td class="bordered">Alkalis phospatase</td>
			<td class="bordered">@if(isset($darah)){{$darah->alkali_fosfatase}}@endif</td>
			<td class="bordered">L. &lt;258 u/l<br>P. 15-40th. 37-111<br>P. >40th. 37-123</td>
		</tr>
		<tr>
			<td rowspan="2" class="bordered">Eritrosit</td>
			<td rowspan="2" class="bordered">@if(isset($darah)){{$darah->eritrosit}}@endif</td>
			<td rowspan="2" class="bordered">L. 4,3 - 6,0 jt/mm<sup>3</sup><br>P. 3,9 - 5,0 jt/mm<sup>3</sup></td>
			<td class="noBorderY">SGOT</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->sgot}}@endif</td>
			<td class="noBorderY">36-50 u/l</td>
		</tr>
		<tr>
			<td class="noBorderY" style="border-bottom: 1px solid black">SGPT</td>
			<td class="noBorderY" style="border-bottom: 1px solid black">@if(isset($darah)){{$darah->sgpt}}@endif</td>
			<td class="noBorderY" style="border-bottom: 1px solid black">&lt;55 u/l</td>
		</tr>
		<tr>
			<td rowspan="3" class="bordered">Hematokrit</td>
			<td rowspan="3" class="bordered">@if(isset($darah)){{$darah->hematokrit}}@endif</td>
			<td rowspan="3" class="bordered">L. 40 - 54 %<br>P. 35 - 45%</td>
			<td class="noBorderY">HBs Ag (RPHA)</td>
			<td class="noBorderY">@if(isset($imun)){{$imun->hbs_ag}}@endif</td>
			<td class="noBorderY">(-) Negatif</td>
		</tr>
		<tr>
			<td class="noBorderY">Anti HIV</td>
			<td class="noBorderY">@if(isset($imun)){{$imun->anti_hiv}}@endif</td>
			<td class="noBorderY">(-) Negatif</td>
		</tr>
		<tr>
			<td class="noBorderY">VDRL</td>
			<td class="noBorderY">@if(isset($imun)){{$imun->vdrl}}@endif</td>
			<td class="noBorderY">(-) Negatif</td>
		</tr>
		<tr>
			<td class="bordered">Trombosit</td>
			<td class="bordered">@if(isset($darah)){{$darah->trombosit}}@endif</td>
			<td class="bordered">150-400 ribu/mm<sup>3</sup></td>
			<td class="bordered">Protein Total</td>
			<td class="bordered">@if(isset($darah)){{$darah->total_protein}}@endif</td>
			<td class="bordered">6,5 - 8,5 g/dl</td>
		</tr>
		<tr>
			<td rowspan="3" class="bordered">LED/BBS (1 jam)</td>
			<td rowspan="3" class="bordered">@if(isset($darah)){{$darah->led}}@endif</td>
			<td rowspan="3" class="bordered">L. &lt; 10 mm <br> P. &lt; 20 mm</td>
			<td class="noBorderY">Globulin</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->globulin}}@endif</td>
			<td class="noBorderY">2,6 - 3,4 g/dl</td>
		</tr>
		<tr>
			<td class="noBorderY">Gamma GT</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->gamma_gt}}@endif</td>
			<td class="noBorderY">L.11-43u/l; P.9-37u/l</td>
		</tr>
		<tr>
			<td class="noBorderY" style="border-bottom: 1px solid black">Albumin</td>
			<td class="noBorderY" style="border-bottom: 1px solid black">@if(isset($darah)){{$darah->albumin}}@endif</td>
			<td class="noBorderY" style="border-bottom: 1px solid black">3,5 - 5 mg/dl</td>
		</tr>
		<tr>
			<td rowspan="8" class="bordered">Diff. Count :
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eosinofil
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Basofil
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stab
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Segmen
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Limfosit
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monosit
				<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retikulosit
			</td>
			<td rowspan="8" class="bordered">
				@if(isset($darah)){{$darah->diff_eosinofil}}@endif
				<br>@if(isset($darah)){{$darah->diff_basofil}}@endif
				<br>@if(isset($darah)){{$darah->diff_stab}}@endif
				<br>@if(isset($darah)){{$darah->diff_segmen}}@endif
				<br>@if(isset($darah)){{$darah->diff_limfosit}}@endif
				<br>@if(isset($darah)){{$darah->diff_monosit}}@endif
				<br>@if(isset($darah)){{$darah->diff_retikulosit}}@endif
			</td>
			<td rowspan="8" class="bordered">
				<br>1 - 3 %
				<br>0 - 1 %
				<br>2 - 6 %
				<br>50 - 70 %
				<br>20 - 40 %
				<br>2 - 8 %
				<br>0,5 - 1,5 %
			</td>
			<td class="noBorderY">Kreatinin serum</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->kreatinin}}@endif</td>
			<td class="noBorderY">0,5 - 1,5 mg/dl</td>
		</tr>
		<tr>
			<td class="noBorderY">Ureum Darah (BUN)</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->ureum_bun}}@endif</td>
			<td class="noBorderY">&lt; 50 mg/dl</td>
		</tr>
		<tr>
			<td class="noBorderY">Asam urat</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->asam_urat}}@endif</td>
			<td class="noBorderY">L. 3,5 - 7,2 mg/dl</td>
		</tr>
		<tr>
			<td class="noBorderY" style="padding-bottom: 0px;"></td>
			<td class="noBorderY" style="padding-bottom: 0px;"></td>
			<td class="noBorderY" style="padding-bottom: 0px;">P. 2,5 - 6,0 mg/dl</td>
		</tr>
		<tr>
			<td class="noBorderY">PSA (ECLIA)</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->psa_eclia}}@endif</td>
			<td class="noBorderY">&lt; 4 ng/ml</td>
		</tr>
		<tr>
			<td class="noBorderY">Natrium</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->na}}@endif</td>
			<td class="noBorderY">135 - 145 mEq/l</td>
		</tr>
		<tr>
			<td class="noBorderY">Kalium</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->k}}@endif</td>
			<td class="noBorderY">3,5 - 5,0 mEq/l</td>
		</tr>
		<tr>
			<td class="noBorderY">Khloride</td>
			<td class="noBorderY">@if(isset($darah)){{$darah->cl}}@endif</td>
			<td class="noBorderY">95 - 108 mEq/l</td>
		</tr>
		<tr>
			<td class="bordered" style="font-weight: bold;">Gol. Darah</td>
			<td class="bordered">{{$identitas->golongan_darah}}</td>
			<td class="bordered"></td>
			<td class="bordered">Kalsium</td>
			<td class="bordered">@if(isset($darah)){{$darah->ca}}@endif</td>
			<td class="bordered">8,4 - 10,4 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">MCV</td>
			<td class="bordered">@if(isset($darah)){{$darah->mcv}}@endif</td>
			<td class="bordered">82 - 92 fl</td>
			<td class="bordered">Glukosa acak</td>
			<td class="bordered">@if(isset($darah)){{$darah->glukosa_acak}}@endif</td>
			<td class="bordered">2,5 - 5,0 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">MCH</td>
			<td class="bordered">@if(isset($darah)){{$darah->mch}}@endif</td>
			<td class="bordered">27 - 31 fl</td>
			<td class="bordered">Glukosa Puasa</td>
			<td class="bordered">@if(isset($darah)){{$darah->glukosa_puasa}}@endif</td>
			<td class="bordered">70 - 110 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">MCHC</td>
			<td class="bordered">@if(isset($darah)){{$darah->mchc}}@endif</td>
			<td class="bordered">32 - 37 fl</td>
			<td class="bordered">Glukosa 2 Jam PP</td>
			<td class="bordered">@if(isset($darah)){{$darah->glukosa_2_jam_pp}}@endif</td>
			<td class="bordered">&lt;140 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">Coomb's Test</td>
			<td class="bordered">@if(isset($imun)){{$imun->coomb_test}}@endif</td>
			<td class="bordered"></td>
			<td class="bordered">HBA 1C</td>
			<td class="bordered">@if(isset($darah)){{$darah->hba_1c}}@endif</td>
			<td class="bordered">&lt;200 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">Malaria</td>
			<td class="bordered">@if(isset($imun)){{$imun->ict_malaria}}@endif</td>
			<td class="bordered"></td>
			<td class="bordered">Cholesterol total</td>
			<td class="bordered">@if(isset($darah)){{$darah->kolesterol_total}}@endif</td>
			<td class="bordered">150 - 250 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">Waktu Pendarahan</td>
			<td class="bordered">@if(isset($darah)){{$darah->pendarahan}}@endif</td>
			<td class="bordered">1 - 6 m<sup>3</sup></td>
			<td class="bordered">HDL - Cholesterol</td>
			<td class="bordered">@if(isset($darah)){{$darah->hdl}}@endif</td>
			<td class="bordered">35 - 65 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">Waktu Pembekuan</td>
			<td class="bordered">@if(isset($darah)){{$darah->pembekuan}}@endif</td>
			<td class="bordered">9 - 15 m<sup>3</sup></td>
			<td class="bordered">LDL - Cholesterol</td>
			<td class="bordered">@if(isset($darah)){{$darah->ldl}}@endif</td>
			<td class="bordered">&le; 130 mg/dl</td>
		</tr>
		<tr>
			<td class="bordered">P T</td>
			<td class="bordered">@if(isset($darah)){{$darah->pt}}@endif</td>
			<td class="bordered">Kontrol</td>
			<td class="bordered">Triglyseride</td>
			<td class="bordered">@if(isset($darah)){{$darah->triglyceride}}@endif</td>
			<td class="bordered">&lt; 170 mg/dl</td>
		</tr>
	</table>
	<div style="margin-top: 3px;">
		<b><u>URINALISIS</u></b>
	</div>
	<table width="100%" class="bordered" style="table-layout: fixed;">
		<tr>
			<td class="noBorderRight" width="16%">Reaksi (Ph)</td>
			<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->ph}}@endif</td>
			<td class="noBorderRight" width="16%"><b>Sedimen</b></td>
			<td class="noBorderLeft" width="12%">: </td>
			<td class="noBorderRight" width="16%"><b>Tes Kehamilan</b></td>
			<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->tes_kehamilan}}@endif</td>
		</tr>
		<tr>
			<td class="noBorderRight" width="16%">Berat Jenis</td>
			<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->berat_jenis}}@endif</td>
			<td class="noBorderRight" width="16%">Eritrosit</td>
			<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->eritrosit}}@endif</td>
			<td class="noBorderRight" width="16%"><b>Tes Narkoba</b></td>
			<td class="noBorderLeft" width="28%">: </td>
		</tr>

		<!-- {{-- tidak dapat dilakukan include narkoba karena tidak dapat mengupdate variabel narkoba_show --}} -->
		<!-- {{--
			Narkoba
			1. Dicek apakah di centang
			2. Dicek apakah sudah pernah di show apa belum

			--}} -->

			<tr>
				<td class="noBorderRight" width="16%">Protein</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->protein}}@endif</td>
				<td class="noBorderRight" width="16%">Lekosit</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->leuko}}@endif</td>
				@php $is_show = 0 @endphp
				@foreach($narkoba as $key => $value)
				@if($value == 1)
				@if($key == 0 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Morfin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->morphin}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 1 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Metamphetamine</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->metamphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 2 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Amphetamin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->amphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 3 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Diazepam</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->diazepam}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 4 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Ganja</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->ganja}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@endif
				@endif
				@endforeach
				@if($is_show == 0)
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="28%"></td>
				@endif
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Reduksi</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->reduksi}}@endif</td>
				<td class="noBorderRight" width="16%">Epitel</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->epitel}}@endif</td>
				@php $is_show = 0 @endphp
				@foreach($narkoba as $key => $value)
				@if($value == 1)
				@if($key == 0 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Morfin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->morphin}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 1 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Metamphetamine</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->metamphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 2 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Amphetamin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->amphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 3 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Diazepam</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->diazepam}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 4 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Ganja</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->ganja}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@endif
				@endif
				@endforeach
				@if($is_show == 0)
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="28%"></td>
				@endif
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Bilirubin</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->bilirubin}}@endif</td>
				<td class="noBorderRight" width="16%">Bakteri</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->bakteri}}@endif</td>
				@php $is_show = 0 @endphp
				@foreach($narkoba as $key => $value)
				@if($value == 1)
				@if($key == 0 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Morfin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->morphin}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 1 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Metamphetamine</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->metamphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 2 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Amphetamin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->amphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 3 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Diazepam</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->diazepam}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 4 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Ganja</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->ganja}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@endif
				@endif
				@endforeach
				@if($is_show == 0)
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="28%"></td>
				@endif
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Urobilirubin</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->urobilirubin}}@endif</td>
				<td class="noBorderRight" width="16%">Silinder</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->cylinder}}@endif</td>
				@php $is_show = 0 @endphp
				@foreach($narkoba as $key => $value)
				@if($value == 1)
				@if($key == 0 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Morfin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->morphin}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 1 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Metamphetamine</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->metamphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 2 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Amphetamin</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->amphetamine}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 3 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Diazepam</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->diazepam}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@elseif($key == 4 && $narkoba_show[$key] == 0)
				<td class="noBorderRight" width="16%">Ganja</td>
				<td class="noBorderLeft" width="28%">: @if(isset($urine)){{$urine->ganja}}@endif</td>
				@php $narkoba_show[$key] = 1 @endphp
				@php $is_show = 1 @endphp
				@php break @endphp
				@endif
				@endif
				@endforeach
				@if($is_show == 0)
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="28%"></td>
				@endif
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Urobilinogen</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->urobilinogen}}@endif</td>
				<td class="noBorderRight" width="16%">Kristal</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->kristal}}@endif</td>
				<td class="noBorderRight" width="44%" rowspan="4" colspan="2"><p style="font-weight: 600;margin-bottom: 0;margin-top: 0">Catatan: </p><p style="white-space: pre;margin-bottom: 0;margin-top: 0">{!!nl2br($resume->catatan_lab ?? '')!!}</p></td>
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Keton</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->keton}}@endif</td>
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="12%"></td>
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Nitrit</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->nitrit}}@endif</td>
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="12%"></td>
			</tr>
			<tr>
				<td class="noBorderRight" width="16%">Warna</td>
				<td class="noBorderLeft" width="12%">: @if(isset($urine)){{$urine->warna}}@endif</td>
				<td class="noBorderRight" width="16%"></td>
				<td class="noBorderLeft" width="12%"></td>
			</tr>
		</table>
		<div style="width: 100%; margin-top: 20px; text-align: right; margin-right: 20px">
			<div style="text-align:center; display: inline-block; float: right; font-size:16px;">
				Surabaya, {{$sekarang}}
				<br>
				Dokter Urrikkes,
				<br><br><br>
				{{$dokter->nama}}
				<br>
				<span style="white-space: pre">{{$dokter->keterangan}}
				</span>
			</div>
		</div>
	</body>
	</html>