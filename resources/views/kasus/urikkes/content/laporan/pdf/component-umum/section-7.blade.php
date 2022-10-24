
<div class="page_num">
	<p>6</p>
</div>
<table width="100%" border="1" style="margin-right: 20px;">
	<tr>
		<td class="table-header" style="width: 39%">PEMERIKSAAN</td>
		<td class="table-header" style="width: 15%">HASIL</td>
		<td class="table-header" style="width: 15%">SATUAN</td>
		<td class="table-header" style="width: 31%">NILAI NORMAL</td>
	</tr>
	<tr class="borderTop">
		<td style="padding-left: 5px;"><b>3. <u>DARAH LENGKAP</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>      
	<tr class="noBorder">
		<td style="padding-left: 23px;">Hemoglobin</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->hemoglobin or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">gr%</td>
		<td style="padding-left: 5px; text-align: left;">L. 13,0-17; P. 11,5-16</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Eritrosit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->eritrosit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">jt/mm3</td>
		<td style="padding-left: 5px; text-align: left;">L. 4,3-6,0; P. 3,9-5,0</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Jumlah Lekosit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->leukosit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">btr/mm3</td>
		<td style="padding-left: 5px; text-align: left;">4000-10.000</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">LED</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->led or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mm/jam</td>
		<td style="padding-left: 5px; text-align: left;">L. < 7 ; P. < 15</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Trombosit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->trombosit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">ribu/mm3</td>
		<td style="padding-left: 5px; text-align: left;">150.000 - 400.000</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Hematokrit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->hematokrit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">L. 40-54; P. 35-45;</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">MCV</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->mcv or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">fl</td>
		<td style="padding-left: 5px; text-align: left;">82 - 92</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">MCH</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->mch or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">pg</td>
		<td style="padding-left: 5px; text-align: left;">27 - 31</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">MCHC</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->mchc or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">g/dl</td>
		<td style="padding-left: 5px; text-align: left;">32 - 37</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Retikulosit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->retikulosit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">0,5 - 1,5</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 5px;">Diff : Eosinofil</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->diff_eosinofil or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">1 - 3</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 43px;">Basofil</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->diff_basofil or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">0 - 1</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 43px;">Stab</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->diff_stab or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">2 - 6</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 43px;">Segmen</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->diff_segmen or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">50 - 70</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 43px;">Limposit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->diff_limposit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">20 - 40</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 43px;">Monosit</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->diff_monosit or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: left;">2 - 8</td>
	</tr>
	<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr style="border:1;">
		<td style="padding-left: 15px; padding-top: 4px; padding-bottom: 4px;" >Golongan Darah</td>
		<td style="padding-left: 5px; padding-top: 4px; padding-bottom: 4px; text-align: center;">{{$klinis->gol_darah}}</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="borderTop">
		<td style="padding-left: 5px;"><b>4. <u>KIMIA KLINIK</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr> 
	<tr class="noBorder">
		<td style="padding-left: 5px;"><b>a. <u>Fungsi Liver</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>      
	<tr class="noBorder">
		<td style="padding-left: 23px;">Bilirubin Total</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->bilirubin_total or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: left;">< 0,2 - 1</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Direk</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->bilirubin_direk or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: left;">< 0,3</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Indirek</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->bilirubin_indirek or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: left;">< 0,75</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Alkali Fosfatase</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->alkali_fosfatase or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">U/I</td>
		<td style="padding-left: 5px; text-align: left;">64 - 306</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Gamma GT</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->gamma_gt or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">U/I</td>
		<td style="padding-left: 5px; text-align: left;">7 - 50</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">SGOT</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->sgot or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">U/I</td>
		<td style="padding-left: 5px; text-align: left;">0 - 35</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">SGPT</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->sgpt or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">U/I</td>
		<td style="padding-left: 5px; text-align: left;">0 - 37</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Protein Total</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->total_protein or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: left;">6,4 - 8,3</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Albumin</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->albumin or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: left;">3,5 - 5,0</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Globulin</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->globulin or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: left;">2,2 - 3,5</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 23px;">Cholinnesterase</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->cholinnesterase or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">kU/L</td>
		<td style="padding-left: 5px; text-align: left;">L. 5,32 - 12,92<br>P. 4,26 - 11,25</td>
	</tr>
	<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>