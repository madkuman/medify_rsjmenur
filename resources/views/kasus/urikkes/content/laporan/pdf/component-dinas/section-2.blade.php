
<div class="text-center" style="font-size: 16px;">6.</div>
<div class="" style="padding-right:15px;">
	<div style="margin-left: 5%; margin-right: 5%; font-size: 15px; white-space: pre-line; height: 212px;">
		<b><u>SARAN</u></b>
		{!!$resume->saran ?? ''!!}
	</div>
	<hr style="margin-left: 5%; margin-right: 5%;">
	<div style="margin-left: 5%; margin-right: 5%; font-size: 15px; white-space: pre;height: 150px">
		<b><u>RIWAYAT SAKIT</u></b><br>@if(isset($klinis)){!!nl2br($klinis->riwayat_sakit)!!} @endif
	</div>
	<div style="margin-left: 5%; margin-right: 5%; font-size: 15px; white-space: pre">
		<b><u>CATATAN HASIL LAB</u></b><br>@if(isset($resume)){!!nl2br($resume->catatan_lab ?? '')!!} @endif
	</div>
</div>