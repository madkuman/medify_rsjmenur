
<div class="page_num">
	<p>3</p>
</div>
<table width="100%" border="0" style="padding-left: 20px; height: 100%;" >
	<tr>
		<th style="text-align: center; width: 35%;"></th>
		<th style="text-align: center; width: 65%;"></th>
	</tr>
	<tr>
		<td>Thorax</td>
		<td>: 
			@if(isset($klinis) and $klinis->thorax == 1)
			Normal @else {{$klinis ? $klinis->ket_thorax : '-'}} 
			@endif 
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Dada dan Paru-paru</td>
		<td>: 
			@if(isset($klinis) and $klinis->dada_paru == 1)
			Normal @else {{$klinis ? $klinis->ket_dada_paru : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Jantung</td>
		<td>:  
			@if(isset($klinis) and $klinis->jantung == 1)
			Normal @else {{$klinis ? $klinis->ket_jantung : '-'}}
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Kulit</td>
		<td>:  
			@if(isset($klinis) and $klinis->kulit == 1)
			Normal @else {{$klinis ? $klinis->ket_kulit : '-'}}
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Perut</td>
		<td>:  
			@if(isset($klinis) and $klinis->perut == 1)
			Normal @else {{$klinis ? $klinis->ket_perut : '-'}}
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Hati</td>
		<td>:  
			@if(isset($klinis) and $klinis->hati == 1)
			Normal @else {{$klinis ? $klinis->ket_hati : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Limpa</td>
		<td>:  
			@if(isset($klinis) and $klinis->limpa == 1)
			Normal @else {{$klinis ? $klinis->ket_limpa : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Extrimitas Atas</td>
		<td>:  
			@if(isset($klinis) and $klinis->extrimitas_atas == 1)
			Normal @else {{$klinis ? $klinis->ket_extrim_atas : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Extrimitas Bawah</td>
		<td>:  
			@if(isset($klinis) and $klinis->extrimitas_bwh == 1)
			Normal @else {{$klinis ? $klinis->ket_extrim_bwh : '-'}}
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Bentuk Kaki</td>
		<td>:  
			@if(isset($klinis) and $klinis->kaki == 1)
			Normal @else {{$klinis ? $klinis->ket_kaki : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Hernia/Varicocele</td>
		<td>:  
			@if(isset($klinis) and $klinis->hernia == 1)
			Normal @else {{$klinis ? $klinis->ket_hernia : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Anus/Rectum</td>
		<td>:  
			@if(isset($klinis) and $klinis->arf == 1)
			Normal @else {{$klinis ? $klinis->ket_arf : '-'}} 
			@endif
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>USG Abdomen</td>
		<td>: {{$klinis->abdomen or '-'}}</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>USG Mammae</td>
		<td>: {{$klinis->mamae or '-'}}</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>ECG</td>
		<td>: {{$klinis->ecg or '-'}}</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Ro. Thorax</td>
		<td>: {{$klinis->x_ray or '-'}}</td>
		{{-- <!-- THORAX EMANG XRAY NGE SHOW NYA --> --}}
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>Pap Smear</td>
		<td>: {{$klinis->pap_smear or '-'}}</td>
	</tr>
</table>