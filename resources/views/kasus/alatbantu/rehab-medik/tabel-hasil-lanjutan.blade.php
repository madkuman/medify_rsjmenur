@if(session('my_role_'.$kasus->nomor_kasus))
@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right mb-5" data-toggle="modal" data-target="#addModal2"><i class="fa fa-pencil"></i> Asesmen Lanjutan Baru</button>
@endif
@endif
<table class="table table-bordered table-vcenter">
	<thead>
		<tr>
			<th colspan="6" class="text-center" style="border-bottom: 1px solid gainsboro;">
				ASESMEN LANJUTAN
			</th>
		</tr>
		<tr>
			<th>#</th>
			<th>Kesadaran</th>
			<th>Anamnesia</th>
			<th>Diagnosa</th>
			<th>Tindakan Terapi</th>
			<th class="text-right">Aksi</th>
		</tr>
	</thead>
	<tbody>
		@php $i=1 @endphp
		@foreach($lanjutan as $lanjutans)
		<tr>
			<td>{{$i++}}</td>
			<td>{{$lanjutans->lanjutan_kesadaran}}</td>
			<td>{{$lanjutans->lanjutan_anamnesia}}</td>
			<td>{{$lanjutans->lanjutan_diagnosa}}</td>
			<td>{{$lanjutans->lanjutan_tindakan_terapi}}</td>
			<td>
				<!-- PAKE HAPUS NGGAK? -->
			</td>
		</tr>
		@endforeach
	</tbody>
</table>