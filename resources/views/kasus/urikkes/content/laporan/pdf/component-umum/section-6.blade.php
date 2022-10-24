
<div class="page_num">
	<p>7</p>
</div>
<table width="100%" border="1" style="margin-left: 10px;">
	<tr>
		<td class="table-header" style="width: 52%">PEMERIKSAAN</td>
		<td class="table-header" style="width: 15%">HASIL</td>
		<td class="table-header" style="width: 15%">SATUAN</td>
		<td class="table-header" style="width: 18%">NILAI NORMAL</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 5px;"><b>b. <u>Fungsi Ginjal</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Kreatinin</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->kreatinin or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">0,5 - 1,5</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Ureum / BUN</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->ureum_bun or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">g/dl</td>
		<td style="padding-left: 5px; text-align: center;">10 - 24</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Asam urat</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->asam_urat or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">L. 3,4 - 7,0<br>P. 2,4 - 5,7</td>
	</tr>
	<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr class="borderTop">
		<td style="padding-left: 5px;"><b>c. <u>Lemak Darah</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Kolesterol Total</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->kolesterol_total or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">150 - 250</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 100px;">HDL</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->hdl or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">L. 35 - 55<br>P. 45 - 65</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 100px;">LDL</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->ldl or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">65 - 175</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Triglyceride</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->triglyceride or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">50 - 200</td>
	</tr>
	<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr class="borderTop">
		<td style="padding-left: 5px;"><b>d. <u>Gula Darah</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>       
	<tr class="noBorder">
		<td style="padding-left: 20px;">Glucosa Acak</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->glukosa_acak or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;"></td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Glucosa Puasa / Red</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->glukosa_puasa or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">76 - 110</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">2 Jam PP / Red</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->glukosa_2_jam_pp or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">80 - 125</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">HBA 1C</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->hba_1c or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">%</td>
		<td style="padding-left: 5px; text-align: center;">4,5 - 6,3</td>
	</tr>
	<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr class="borderTop">
		<td style="padding-left: 5px;"><b>e. <u>Pemeriksaan Elektrolit</u></b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>      
	<tr class="noBorder">
		<td style="padding-left: 20px;">Na</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->na or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mmol/L</td>
		<td style="padding-left: 5px; text-align: center;">135 - 145</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">K</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->na or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mmol/L</td>
		<td style="padding-left: 5px; text-align: center;">3,5 5</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Cl</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->na or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mmol/L</td>
		<td style="padding-left: 5px; text-align: center;">95 - 108</td>
	</tr>
	<tr class="noBorder">
		<td style="padding-left: 20px;">Ca</td>
		<td style="padding-left: 5px; text-align: center;">{{$darah->na or '-'}}</td>
		<td style="padding-left: 5px; text-align: center;">mg/dl</td>
		<td style="padding-left: 5px; text-align: center;">8,1 - 10,4</td>
	</tr>
	<tr class="noBorder"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr class="borderTop">
		<td style="padding-left: 5px;"><b>5. IMMUNOLOGI</b></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>      
	@include('kasus.urikkes.content.laporan.pdf.component-umum.imun-custom')
</table>