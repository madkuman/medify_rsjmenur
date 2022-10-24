<head>
	<title>Hasil Pemeriksaan Laboratorium Anatomi - PAPSMEAR</title>
</head>

<style type="text/css">
.small-col {
	width: 17%;
}
.big-col {
	width: 43%;
}
.med-col {
	width: 23%;
}
td {
	vertical-align: top;
}
.title {
	text-align: center; 
	font-weight: bold;
}
.left-hr{
	width: 50%; 
	margin-left: 0px;
}
.mb-5{
	margin-bottom: 0px;
}
.h5{
	font-size: 16px;
	font-weight: bold;
}

.h6{
	margin-bottom: 5px !important;
	font-weight: bold;
}

body {
	margin-top: -35px;
	margin-bottom: -30px;
	font-size: 13px;
	font-family: sans-serif;    
}
</style>
<body>
	<p>LABORATORIUM PATOLOGI ANATOMI<br>
		&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;
		{{config('app.name')}}</p>
	<hr class="left-hr">
	<p class="title">HASIL PEMERIKSAAN LABORATORIUM ANATOMI</p>
	<hr>
	<table style="width: 100vw">
		<thead>
			<tr>
				<td class="small-col" >Nama</td>
				<td class="big-col" >: {{{$transaksi->pasien->name}}}</td>
				<td class="small-col" >Register</td>
				<td class="med-col" >: {{{$transaksi->pasien->no_rm}}} </td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="small-col" >Umur/TTL</td>
				<td class="big-col" >: {{{$transaksi->pasien->age}}} Tahun / {{{$transaksi->pasien->place_of_birth}}}, {{{date('d F Y', strtotime($transaksi->pasien->date_of_birth))}}}</td>
				<td class="small-col" >Kode Sediaan</td>
				<td class="med-col" >: {{{$detail->kode_sediaan}}} </td>
			</tr>
			<tr>
				<td class="small-col" ></td>
				<td class="med-col" ></td>            
				<td class="small-col" >Dokter</td>
				<td class="med-col" >: {{{!is_null($transaksi->kasus->dpjp) ? $transaksi->kasus->dpjp->user->name : '-'}}}</td>
			</tr>
			<tr>
				<td class="small-col" >Alamat</td>
				<td class="big-col" >: {{{$transaksi->pasien->address}}}</td>
				<td class="small-col" >Rumah Sakit</td>
				<td class="med-col" >: {{config('app.name')}}</td>
			</tr>
			<tr>
				<td class="small-col" >Pangkat</td>
				<td class="big-col" >: {{{isset($transaksi->pasien->tni_pangkat->nama) ? $transaksi->pasien->tni_pangkat->nama : '-'}}}</td>
				<td class="small-col" >Poli/ Ruang</td>
				<td class="med-col" >: {{{ $transaksi->asal['nama'] }}}</td>
			</tr>
			<tr>
				<td class="small-col" >Rol / Kesatuan</td>
				<td class="big-col" >
					: {{{isset($transaksi->pasien->tni_kotama->nama) ? $transaksi->pasien->tni_kotama->nama : '-'}}} /
					{{{isset($transaksi->pasien->tni_satker->nama) ? $transaksi->pasien->tni_satker->nama : '-'}}}
				</td>
			</tr>
			<tr>
				<td class="small-col" >Tanggal Terima</td>
				<td class="big-col" >: {{{date('d F Y', strtotime($transaksi->created_at))}}}</td>
				<td class="small-col" >Tanggal Selesai</td>
                <td class="med-col" >: @if(!is_null($transaksi->result_created_at)) {{{date('d F Y', strtotime($transaksi->result_created_at))}}}
                                        @else - @endif</td>
			</tr>
		</tbody>
	</table>
	<br>
	<hr>
	<table style="width: 100vw">
		<tr>
			<td class="small-col">Diagnosa</td>
			<td class="big-col">: {{{$transaksi->diagnosis}}}</td>
			<td class="small-col"></td>
			<td class="med-col"></td>  
		</tr>
		<tr>
			<td class="small-col">Lokasi</td>
			<td class="big-col">: {{{$detail->lokasi}}}</td>
			<td class="small-col"></td>
			<td class="med-col"></td>
		</tr>
	</table>
	<hr>
	<p>Hasil Pemeriksaan Papsmear</p>
	<?php 
	$resultClass = (array)$result->sitologi_class;
	$resultGeneral = (array)$result->sitologi_general;
	$resultReactive = (array)$result->sitologi_reactive;
	$resultSpecimen = (array)$result->sitologi_specimen;
	$resultInfection = (array)$result->sitologi_infection;
	?>
	<table width="100%">
		<tr>
			<td width="33%" style="vertical-align: top; border-right: 1px solid grey; border-left: 1px solid #bfbfbf; padding-left: 3px;">
				<p class="h5 my-0 mb-10">CLASS</p>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="sel ganas negatif" value="sel ganas negatif" type="checkbox" disabled="1" @if(in_array('sel ganas negatif', $resultClass)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="sel ganas negatif">I Sel ganas negatif</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="sel abnormal" value="sel abnormal" type="checkbox" disabled="1" @if(in_array('sel abnormal', $resultClass)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="sel abnormal">II Sel abnormal, sel ganas negatif</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="sel atipik" value="sel atipik" type="checkbox" disabled="1" @if(in_array('sel atipik', $resultClass)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="sel atipik">III Sel atipik, meragukan keganasan</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="sel mencurigakan" value="sel mencurigakan" type="checkbox" disabled="1" @if(in_array('sel mencurigakan', $resultClass)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="sel mencurigakan">IV Sel mencurigakan keganasan</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="sel ganas positif" value="sel ganas positif" type="checkbox" disabled="1" @if(in_array('sel ganas positif', $resultClass)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="sel ganas positif">V Sel ganas positif</label>
				</div>

				<p class="h5 my-0 mb-10">INFECTION</p>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="Trichomonas" value="Trichomonas" type="checkbox" disabled="1" @if(in_array('Trichomonas', $resultInfection)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="Trichomonas">Trichomonas vaginalis</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="Candida" value="Candida" type="checkbox" disabled="1" @if(in_array('Candida', $resultInfection)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="Candida">Candida/ Fungal/ Jamur</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="Haemophylus" value="Haemophylus" type="checkbox" disabled="1" @if(in_array('Haemophylus', $resultInfection)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="Haemophylus">Haemophylus vaginalis</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="Coco" value="Coco" type="checkbox" disabled="1" @if(in_array('Coco', $resultInfection)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="Coco">Coco bacilus</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input class="custom-control-input" name="layanan[]" id="Herpes" value="Herpes" type="checkbox" disabled="1" @if(in_array('Herpes', $resultInfection)) 
					checked @endif style="display: inline;">
					<label class="custom-control-label" for="Herpes">Herpes simplex</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Human', $resultInfection)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Human" value="Human" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Human">Human Papiloma Virus (HPV)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Lain', $resultInfection)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Lain" value="Lain" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Lain">Lain-lain</label>
				</div>
				<p class="h5 my-0 mb-10">BETHESDA SYSTEM</p>
				<p class="h6 my-0 mb-10">Specimen Adequacy</p>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Satisfactory', $resultSpecimen)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Satisfactory" value="Satisfactory" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Satisfactory">Satisfactory</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Unsatisfactory', $resultSpecimen)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Unsatisfactory" value="Unsatisfactory" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Unsatisfactory">Unsatisfactory</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input @if(in_array('Noendocervical', $resultSpecimen)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Noendocervical" value="Noendocervical" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Noendocervical">No endocervical epithel</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input @if(in_array('Epithel', $resultSpecimen)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Epithel" value="Epithel" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Epithel">Epithel squamous < 10% </label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input @if(in_array('Manyblood', $resultSpecimen)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Manyblood" value="Manyblood" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Manyblood">Many blood / inflamatory cells</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input @if(in_array('Poorly', $resultSpecimen)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Poorly" value="Poorly" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Poorly">Poorly fixation</label>
				</div>
			</td>
			<td width="33%" style="vertical-align: top; border-right: 1px solid grey; padding-left: 3px;">
				<p class="h6 my-0 mb-10">Reactive Cellular Changes</p>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Inflammation', $resultReactive)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Inflammation" value="Inflammation" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Inflammation">Inflammation</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Radiation', $resultReactive)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Radiation" value="Radiation" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Radiation">Radiation</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('IUD', $resultReactive)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="IUD" value="IUD" type="checkbox" disabled="1">
					<label class="custom-control-label" for="IUD">IUD</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Athropy', $resultReactive)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Atrophy" value="Atrophy" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Atrophy">Atrophy with inflammation</label>
				</div>

				<p class="h6 my-0 mb-10">General Categorization</p>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Negative', $resultGeneral)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Negative" value="Negative" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Negative">Negative for intraepithelial lesion</label>
				</div>
				<div class="custom-control custom-checkbox mb-5">
					<input @if(in_array('Epithelial', $resultGeneral)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Epithelial" value="Epithelial" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Epithelial">Epithelial cell abnormalities</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input class="custom-control-input" @if(in_array('Squamous', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Squamous" value="Squamous" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Squamous">Squamous Cell</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Atypical', $resultGeneral)) 
					checked @endif style="display: inline;" id="Atypical" value="Atypical" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Atypical">Atypical Squamous Cell (ASC)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" @if(in_array('ofundetermined', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="ofundetermined" value="ofundetermined" type="checkbox" disabled="1">
					<label class="custom-control-label" for="ofundetermined">of undetermined significants (ASC-US)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input @if(in_array('cannot', $resultGeneral)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="cannot" value="cannot" type="checkbox" disabled="1">
					<label class="custom-control-label" for="cannot">cannot exclude HSIL (ASC-H)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input @if(in_array('Squamousintra', $resultGeneral)) 
					checked @endif style="display: inline;" class="custom-control-input" name="layanan[]" id="Squamousintra" value="Squamousintra" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Squamousintra">Squamous intraepithelial lesion (SIL)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" @if(in_array('Low', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Low" value="Low" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Low">Low grade squamous intraepithelial lesion (LSIL)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" name="layanan[]" @if(in_array('High', $resultGeneral)) 
					checked @endif style="display: inline;" id="High" value="High" type="checkbox" disabled="1">
					<label class="custom-control-label" for="High">High grade squamous intraepithelial lesion (HSIL)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input class="custom-control-input" @if(in_array('Squamouscarcinoma', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Squamouscarcinoma" value="Squamouscarcinoma" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Squamouscarcinoma">Squamous cell carcinoma</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input class="custom-control-input" name="layanan[]" id="Glandular" @if(in_array('Glandular', $resultGeneral)) 
					checked @endif style="display: inline;" value="Glandular" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Glandular">Glandular cell</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Atypical1', $resultGeneral)) 
					checked @endif style="display: inline;" id="Atypical1" value="Atypical1" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Atypical1">Atypical</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Endocervical', $resultGeneral)) 
					checked @endif style="display: inline;" id="Endocervical" value="Endocervical" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Endocervical">Endocervical cells (NOS or specify in comments)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Endometrial', $resultGeneral)) 
					checked @endif style="display: inline;" id="Endometrial" value="Endometrial" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Endometrial">Endometrial cells (NOS or specify in comments)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Glandularcells', $resultGeneral)) 
					checked @endif style="display: inline;" id="Glandularcells" value="Glandularcells" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Glandularcells">Glandular cells (NOS or specify in comments)</label>
				</div>
			</td>
			<td width="33%" style="vertical-align: top; border-right: 1px solid grey; padding-left: 3px;">
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Atypical2', $resultGeneral)) 
					checked @endif style="display: inline;" id="Atypical2" value="Atypical2" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Atypical2">Atypical</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" @if(in_array('Endocervicalfavor', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Endocervicalfavor" value="Endocervicalfavor" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Endocervicalfavor">Endocervical cells favor neoplastic</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" @if(in_array('Glandularcellsfavor', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Glandularcellsfavor" value="Glandularcellsfavor" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Glandularcellsfavor">Glandular cells favor neoplastic</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input class="custom-control-input" @if(in_array('Endocervicaladenocarcinoma', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Endocervicaladenocarcinoma" value="Endocervicaladenocarcinoma" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Endocervicaladenocarcinoma">Endocervical adenocarcinoma in situ</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-60">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Adenocarcinoma', $resultGeneral)) 
					checked @endif style="display: inline;" id="Adenocarcinoma" value="Adenocarcinoma" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Adenocarcinoma">Adenocarcinoma</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Endocervical1', $resultGeneral)) 
					checked @endif style="display: inline;" id="Endocervical1" value="Endocervical1" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Endocervical1">Endocervical</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" @if(in_array('Endometrial1', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Endometrial1" value="Endometrial1" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Endometrial1">Endometrial</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" @if(in_array('Extrauterine', $resultGeneral)) 
					checked @endif style="display: inline;" name="layanan[]" id="Extrauterine" value="Extrauterine" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Extrauterine">Extrauterine</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-90">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Nototherwise', $resultGeneral)) 
					checked @endif style="display: inline;" id="Nototherwise" value="Nototherwise" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Nototherwise">Not Otherwise Specified (NOS)</label>
				</div>
				<div class="custom-control custom-checkbox mb-5 ml-30" style="margin-left: 30px;">
					<input class="custom-control-input" name="layanan[]" @if(in_array('Othermalignant', $resultGeneral)) 
					checked @endif style="display: inline;" id="Othermalignant" value="Othermalignant" type="checkbox" disabled="1">
					<label class="custom-control-label" for="Othermalignant">Other Malignant Neoplasms</label>
				</div>
				<div style="margin-bottom: 40px; margin-top: 10px;">
					<table style="width: 100vw;">
						<tr>
							<td style="width: 20%"><b>Kesimpulan </b></td>
							<td style="width: 80%">:</td>
						</tr>
					</table>
					<?php echo htmlspecialchars_decode(stripslashes($result->kesimpulan ? $result->kesimpulan : '-')) ?>
				</div>
				<table style="width: 100vw; position: absolute; bottom: 550px;">
					<tr>
						<td style="text-align: center;">Dokter yang memeriksa</td>
					</tr>
					<tr>
						<td style="font-size: 40px; color: white">dummy</td>
					</tr>
					<tr>
						<td style="text-align: center;">{{{$transaksi->pemeriksa->name}}}</td>
					</tr>
				</table>
			</td>						
		</tr>
	</table>
</body>