<div class="row">
	<div class="col-12 text-right float-right">
		@if($is_hrd_member)
		<a href="javascript:void(0)" class="btn-add btn btn-alt-primary pull-right"><i class="fa fa-plus mr-5 mb-10"></i> Tambah</a>
		@endif
	</div>
</div>
<div class="row">
	<div class="col-12 mb-30">
		<h5 class="card-title font-w400">JABATAN</h5>
		<hr>
		<div class="table-responsive-md">
			@if($items->total() < 1)
			<p>Tidak ada data</p>
			@else
			@include('kepegawaian.layouts.partials.pagination')
			<table id="table-department" class="table table-striped table-hover mt-10"> 
				<thead>
					<tr>
						<th style="width: 10%" class="align-middle text-center">No</th>
						{{-- <th style="width: 20%" class="align-middle text-center">Departemen</th> --}}
						<th style="width: 20%" class="align-middle text-center">Jabatan</th>
						<th style="width: 20%" class="align-middle text-center">Nomer Surat</th>
						<th style="width: 20%" class="align-middle text-center">Tanggal Surat</th>
						<th style="width: 25%" class="align-middle text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items->getCollection() as $key => $item)
					<tr>
						<td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
						{{-- <td class="">{{ $item->departemen->nama ?? ''}}
							<span class="departemen hide">{{ $item->departemen_id}}</span>
						</td> --}}
						<td class="">{{ $item->jabatan->nama}}
							<span class="jabatan hide">{{ $item->jabatan_id}}</span>
						</td>
						<td class="number">{{ $item->no_surat }}</td>
						<td class="date">{{ $item->tgl_surat }}</td>
						<td class="d-flex justify-content-center">
							@if($is_hrd_member)
							<div class="row">
								{{-- <button type="button" class="btn btn-alt-success btn-sm mr-5 edit-department-button" data-id="{{ $item->id }}" title="Edit Data">
									<i class="fa fa-pencil"></i>
								</button>
								<form class="form-delete-department" method="POST" action="" enctype="multipart/form-data">
									{{csrf_field()}}
									<button type="button" class="btn btn-alt-danger btn-sm delete-department-button" data-id="{{ $item->id }}" title="Hapus Data">
										<i class="fa fa-trash"></i>
									</button>
								</form> --}}
								<a href="javascript:void(0)" class="btn btn-alt-success btn-sm mr-5 btn-edit" data-id="{{$item->id}}">
									<i class="fa fa-edit"></i></a>
									<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 btn-delete" data-id="{{$item->id}}" data-nama="{{$item->jabatan->nama}}">
									<i class="fa fa-trash"></i></a>
							</div>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@include('kepegawaian.layouts.partials.pagination_bottom')
			@endif
		</div>
	</div>  
</div>