<div style="margin-left: 5%; font-size: 15px;padding-right: 15px;">
	<div class="text-center" style="font-size: 16px;">
		2.
	</div>
	<table style="font-size: 16px;" width="100%">
		<tr>
			<td width="55%"><b>Gigi dan rongga mulut</b></td>
			<td>@if(isset($gigi)) {{$gigi->kelainan_gigi}} @endif</td>
		</tr>
	</table>
	<br><br>
	<table style="font-size: 16px;" width="80%">
		<tr>
			<td><b>Mata</b></td>
			<td>: OD</td>
			<td colspan="2">@if(isset($mata)) @if($mata->od == 1) Normal @else {{$mata->ket_od}} @endif @endif</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td> &nbsp;&nbsp;OS</td>
			<td colspan="2">@if(isset($mata)) @if($mata->os == 1) Normal @else {{$mata->ket_os}} @endif @endif</td>
		</tr>
		<tr>
			<td>- VOD</td>
			<td>@if(isset($mata)) {{$mata->visus_od}} @endif</td>
			<td>Koreksi</td>
			<td>@if(isset($mata)) {{$mata->koreksi_od}} @endif</td>
		</tr>
		<tr>
			<td>- VOS</td>
			<td>@if(isset($mata)) {{$mata->visus_os}} @endif</td>
			<td>Koreksi</td>
			<td>@if(isset($mata)) {{$mata->koreksi_os}} @endif</td>
		</tr>
		<br>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Add</td>
			<td>@if(isset($mata)) {{$mata->add}} @endif</td>
		</tr>
	</table>
	<table style="font-size: 16px;">
		<tr>
			<td><b>Membedakan Warna</b></td>
			<td>:</td>
			<td>@if(isset($mata)) {{$mata->membedakan_warna}} @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Leher</b></td>
			<td>:</td>
			<td>@if($klinis->leher == 1) Normal @else {{$klinis->ket_leher}} @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Dada</b></td>
			<td>:</td>
			<td>@if($klinis->dada_paru == 1) Normal @else {{$klinis->ket_dada_paru}} @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Jantung</b></td>
			<td>:</td>
			<td>@if($klinis->jantung == 1) Normal @else {{$klinis->ket_jantung}} @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Abdomen</b></td>
			<td>:</td>
			<td>@if(!empty($klinis->abdomen)) @if($klinis->abdomen_viscera == 1) Normal @else {{$klinis->ket_abdomen_viscera}} @endif @else - @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Extremitas atas</b></td>
			<td>:</td>
			<td>@if($klinis->extrimitas_atas == 1) Normal @else {{$klinis->ket_extrim_atas}} @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Extremitas bawah</b></td>
			<td>:</td>
			<td>@if($klinis->extrimitas_bwh == 1) Normal @else {{$klinis->ket_extrim_bwh}} @endif</td>
		</tr>
		<tr><td colspan="2" style="color: white; font-size: 8px;">dummy</td></tr>
		<tr>
			<td><b>Hemmorhoid</b></td>
			<td>:</td>
			<td>@if($klinis->arf == 1) Normal @else {{$klinis->ket_arf}} @endif</td>
		</tr>
	</table>

</div>