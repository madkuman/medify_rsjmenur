@for($i=0;$i<$res->max;$i++)
<tr>
	<td class="text-center">{{$res->suami[$i] or '-'}}</td>
	<td class="text-center">{{$res->lama[$i] or '-'}}</td>
	<td class="text-center">{{$res->umur[$i] or '-'}}</td>
	<td class="text-center">{{$res->tahun[$i] or '-'}}</td>
	<td class="text-center">{{$res->tempat[$i] or '-'}}</td>
	<td class="text-center">{{$res->jenis[$i] or '-'}}</td>
	<td class="text-center">{{$res->penolong[$i] or '-'}}</td>
	<td class="text-center">{{$res->penyulit[$i] or '-'}}</td>
	<td class="text-center">{{$res->jenis_anak[$i] or '-'}}</td>
	<td class="text-center">{{$res->bb_anak[$i] or '-'}}</td>
	<td class="text-center">{{$res->pb_anak[$i] or '-'}}</td>
	<td class="text-center">{{$res->keadaan_anak[$i] or '-'}}</td>
	<td class="text-center">
		@if(session('my_role_'.$kasus->nomor_kasus))
		@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
		<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
			<i class="fa fa-trash"></i>
		</button>
		@endif
		@endif
	</td>
</tr>
@endfor