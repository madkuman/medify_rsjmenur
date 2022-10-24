<table class="" style="width: 100%">
	<tbody>
		<tr>
			<td style="width: 50%">Pasien datang dari ruang</td>
			<td style="width: 5%"> : </td>
			<td style="width: 45%" class="">{{$res->pasien_datang_dari_ruang}}</td>
		</tr>
		<tr>
			<td>Jam</td>
			<td> : </td>
			<td class="">{{$res->jam}}</td>
		</tr>
		<tr>
			<td>Keluhan Utama</td>
			<td> : </td>
			<td class="">{{$res->keluhan_utama}}</td>
		</tr>
	</tbody>
</table>
<div class="pt-10 mb-10">
	<button  class="btn btn-primary mr-5 mb-5  viewBtn" data-id="{{$item->id}}"  data-val="{{$item->val}}">
		<i class="fa fa-search"></i> Lihat Selengkapnya
	</button>
</div>