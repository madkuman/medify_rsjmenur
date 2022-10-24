<div class="text-center" style="font-size: 16px;">3.</div>
<table style="font-size: 15px;" class="lab"  cellpadding="0" cellspacing="0">
	<tr>
		<th>
			<b><u>HEMATOLOGI</u></b>
		</th>
		<th style="text-align: center;" colspan="2"><b>Hasil</b></th>
		<th><b>Nilai Normal</b></th>
	</tr>
	<tr>
		<td>Hemoglobin</td>
		<td>:</td>
		<td> {{!is_null($darah) ? $darah->hemoglobin : ''}} g%</td>
		<td>13.5 - 17 g%</td>
	</tr>
	<tr>
		<td>LED</td>
		<td>:</td>
		<td> {{!is_null($darah) ? $darah->led : ''}} mm/jam</td>
		<td> &lt; 7 mm/jam</td>
	</tr>
	<tr>
		<td>Eritrosit</td>
		<td>:</td>
		<td> {{!is_null($darah) ? $darah->eritrosit : ''}} Jt/mm3</td>
		<td></td>
	</tr>
	<tr>
		<td>Leukosit</td>
		<td>:</td>
		<td> {{!is_null($darah) ? $darah->leukosit : ''}} /mm3</td>
		<td><span style="font-size: 12px">4000 - 10000 mm</span></td>
	</tr>
	<tr>
		<td>HCT</td>
		<td>:</td>
		<td> {{!is_null($darah) ? $darah->hct : ''}} %</td>
		<td>P : 35 - 45%</td>
	</tr>
	<tr>
		<td>Trombosit</td>
		<td>:</td>
		<td> {{!is_null($darah) ? $darah->trombosit : ''}} ribu/mm3</td>
		<td><span style="font-size: 12px"> 150 - 400 ribu / mm3</span></td>
	</tr>
	<tr>
		<td>Diff. Count</td>
		<td>:</td>
		<td colspan="2"> {{!is_null($darah) ? $darah->diff_eosinofil : ''}}/{{!is_null($darah) ? $darah->diff_basofil : ''}}/{{!is_null($darah) ? $darah->diff_stab : ''}}/{{!is_null($darah) ? $darah->diff_segmen : ''}}/{{!is_null($darah) ? $darah->diff_limposit : ''}}/{{!is_null($darah) ? $darah->diff_monosit : ''}}</td>
	</tr>
	<tr>
		<td style="color: white; font-size: 9px;" colspan="4">.</td>
	</tr>
	<tr>
		<td>
			<b><u>KIMIA KLINIK</u></b>
		</td>
		<td style="text-align: center;" colspan="2"><b>Hasil</b></td>
		<td><b>Nilai Normal</b></td>
	</tr>
	<tr>
		<td>Bilirubin Total</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->bilirubin_total : ''}} mg/dl</td>
		<td>0.2 - 1 mg/dl</td>
	</tr>
	<tr>
		<td>Bilirubin Direk</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->bilirubin_direk : ''}} mg/dl</td>
		<td> &lt; 0.3 mg/dl</td>
	</tr>
	<tr>
		<td>Bilirubin Indirek</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->bilirubin_indirek : ''}} mg/dl</td>
		<td> &lt; 0.75 mg/dl</td>
	</tr>
	<tr>
		<td>SGOT</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->sgot : ''}} U/l</td>
		<td>0 - 35 U/l</td>
	</tr>
	<tr>
		<td>SGPT</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->sgpt : ''}} U/l</td>
		<td>0 - 37 U/l</td>
	</tr>
	<tr>
		<td>Alkali Frosfatase</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->alkali_fosfatase : ''}} U/l</td>
		<td>64 - 306 U/l</td>
	</tr>
	<tr>
		<td>Protein Total</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->total_protein : ''}} g/dL</td>
		<td>6.4 - 8.3 d /dL</td>
	</tr>
	<tr>
		<td>Kolesterol</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->kolesterol_total : ''}} mg/dl</td>
		<td>150 - 250 mg/dl</td>
	</tr>
	<tr>
		<td>HDL</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->hdl : ''}} mg/dl</td>
		<td>45 - 65 mg/dl</td>
	</tr>
	<tr>
		<td>LDL</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->ldl : ''}} mg/dl</td>
		<td>65 - 175 mg/dl</td>
	</tr>
	<tr>
		<td>Trigliserida</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->triglyceride : ''}} mg/dl</td>
		<td>50 - 200 mg/dl</td>
	</tr>
	<tr>
		<td>Glukosa Puasa</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->glukosa_puasa : ''}} mg/dl</td>
		<td>76 - 110 mg/dl</td>
	</tr>
	<tr>
		<td>Glukosa 2 Jam PP</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->glukosa_2_jam_pp : ''}} mg/dl</td>
		<td>80 - 125 mg/dl</td>
	</tr>
	<tr>
		<td>Kreatinin</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->kreatinin : ''}} mg/dl</td>
		<td>0.5 - 1.50 mg/dl</td>
	</tr>
	<tr>
		<td>BUN</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->ureum_bun : ''}} mg/dl</td>
		<td>10 - 24 mg/dl</td>
	</tr>
	<tr>
		<td>Asam Urat</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->asam_urat : ''}} mg/dl</td>
		<td>3.4 - 7 mg/dl</td>
	</tr>
	<tr>
		<td>Albumin</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->albumin : ''}} mg/dl</td>
		<td>3.5 - 5 mg/dl</td>
	</tr>
	<tr>
		<td>Globulin</td>
		<td>: </td>
		<td> {{!is_null($darah) ? $darah->globulin : ''}} mg/dl</td>
		<td>2.2 - 3.5 mg/dl</td>
	</tr>
</table>