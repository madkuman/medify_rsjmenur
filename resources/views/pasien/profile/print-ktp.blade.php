@if(isset($pasien->photo_identity))
<img src="{{url($pasien->photo_identity)}}">
@else
<table width="100%">
	<tr>
		<td style="text-align: center; font-size: 20px;"><i>(Foto tidak ditemukan)</i></td>
	</tr>
</table>
@endif