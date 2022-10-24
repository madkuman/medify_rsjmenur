<table class="" style="width: 100%">
	<tbody>
		<tr>
			<td style="width: 50%">Diagnosa Pra Bedah</td>
			<td style="width: 5%"> : </td>
			<td style="width: 45%" class="">{{$res->diagnosa_pra_bedah}}</td>
		</tr>
		<tr>
			<td>Planning : Th/ Dx</td>
			<td> : </td>
			<td class="">{{$res->planning_th_dx}}</td>
		</tr>
		<tr>
			<td>Alat Khusus</td>
			<td> : </td>
			<td class="">{{$res->alat_khusus}}</td>
		</tr>
	</tbody>
</table>
<div class="pt-10 mb-10">
	<button  class="btn btn-primary mr-5 mb-5 viewBtn" data-id="{{$item->id}}"  data-val="{{$item->val}}">
		<i class="fa fa-search"></i> Lihat Selengkapnya
	</button>
</div>