
<div class="page_num">
	<p style="padding-bottom: 0px; margin-bottom: 0px;">2</p>
</div>
<u><b><h4 class="page2-title">PEMERIKSAAN FISIK</h4></b></u>
<table width="100%" border="0" style="padding-right: 20px;">
	<tr>
		<th style="text-align: center; width: 35%;"></th>
		<th style="text-align: center; width: 65%;"></th>
	</tr>
	<tr>
		<td>Tinggi Badan</td>
		<td>: {{$identitas->tinggi_badan or '-'}} cm</td>
	</tr>
	<tr>
		<td>Berat Badan</td>
		<td>: {{$identitas->berat_badan or '-'}} Kg</td>
	</tr>
	<tr>
		<td>Tensi</td>
		<td>: {{$identitas->tekanan_darah_tensi or '-'}} mm/Hg</td>
	</tr>
	<tr>
		<td>Nadi</td>
		<td>: {{$identitas->nadi or '-'}} mm/Hg</td>
	</tr>
	<tr>
		<td>Bentuk Badan</td>
		<td>: {{$identitas->bentuk_badan}}</td>
	</tr>
	<tr>
		<td>Kepala</td> 
		@if(isset($klinis) and $klinis->kepala == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_kepala : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td>Leher</td> 
		@if(isset($klinis) and $klinis->leher == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_leher : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td>Kel. Gondok</td> 
		@if(isset($klinis) and $klinis->gondok == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_gondok : '-'}}</td>
		@endif
		
	</tr>
	<tr><td class="sm-text">&nbsp;</td><td class="sm-text">&nbsp;</td></tr>
	<tr>
		<td>Mata</td><td></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Visus OD</td>
		<td>: {{isset($mata) ? $mata->visus_od : '-'}}
			<span style="padding-left: 20px">
				Koreksi: 
			  {{isset($mata) ? $mata->koreksi_od : '-'}}
			</span>
		</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Visus OS</td>
		<td>:  {{isset($mata) ? $mata->visus_os : '-'}} 
			<span style="padding-left: 20px">
				Koreksi: {{isset($mata) ? $mata->koreksi_os : '-'}}
			</span>
		</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Visus ODS</td>
		<td>: {{isset($mata) ? $mata->visus_ods : '-'}} <span style="padding-left: 20px">Add: {{isset($mata) ? $mata->add : '-'}} </span></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Bentuk Pupil</td>
		<td>: {{isset($mata) ? $mata->bentuk_pupil : '-'}} </td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Warna</td>
		<td>: {{isset($mata) ? $mata->membedakan_warna : '-'}}</td>
	</tr>
	<tr><td class="sm-text">&nbsp;</td><td class="sm-text">&nbsp;</td></tr>
	<tr>
		<td>Telinga</td><td></td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Liang</td>
		<td>: {{isset($telinga) ? $telinga->liang : '-'}}</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Tajam Dengar</td>
		<td>: {{isset($telinga) ? $telinga->tajam_pendengaran : '-'}}</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Gendang Kanan</td>
		<td>:  {{isset($telinga) ? $telinga->gendang_kanan : '-'}}</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Gendang Kiri</td>
		<td>:  {{isset($telinga) ? $telinga->gendang_kiri : '-'}}</td>
	</tr>
	<tr>
		<td style="padding-left: 20px;">Audiometri</td>
		<td>: AD : {{isset($telinga) ? $telinga->audio_ad : '-'}} 
			<span style="padding-left: 20px;">
				AS :  {{isset($telinga) ? $telinga->audio_as : '-'}}
			</span>
		</td>
	</tr>
	<tr><td class="sm-text">&nbsp;</td><td class="sm-text">&nbsp;</td></tr>
	<tr>
		<td>Hidung</td> 
		@if(isset($klinis) and $klinis->hidung == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_hidung : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td>Foto Water</td> 
		@if(isset($klinis) and $klinis->sinus == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_sinus : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td>Tenggorokan</td> 
		@if(isset($klinis) and $klinis->tenggorokan == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_tenggorokan : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td style="padding-left: 20px;">Rongga Mulut</td> 
		@if(isset($klinis) and $klinis->mulut == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_mulut : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td style="padding-left: 20px;">Lidah</td> 
		@if(isset($klinis) and $klinis->lidah == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_lidah : '-'}}</td>
		@endif
		
	</tr>
	<tr>
		<td style="padding-left: 20px;">Tonsil</td> 
		@if(isset($klinis) and $klinis->tonsil == 1)
		<td>: Normal</td>
		@else
		<td>: {{$klinis ? $klinis->ket_tonsil : '-'}}</td>
		@endif
		
	</tr>
	<tr><td class="sm-text">&nbsp;</td><td class="sm-text">&nbsp;</td></tr>
	<tr>
		<td>Gigi</td>
		<td>: DMF @if(!empty($gigi)) {{$gigi->dmf}}@endif</td>
	</tr>
</table>