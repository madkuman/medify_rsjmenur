@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Status Pulang
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block block-rounded">
		<div class="block-header py-20">
			<span><h4 class="mb-0">Daftar Status Pulang</h4><hr>
				<h5></h5></span>
				<div class="block-options">
					<a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
						<i class="fa fa-plus"></i> Buat Status Pulang Baru
					</a>
				</div>
			</div>
			<div class="block-content py-20">
				<table class="table table-striped table-hover table-vcenter transaksiTable js-dataTable-full" id="transaksiTable">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">ID</th>
							<th class="text-center" >Nama</th>
							<th class="text-center" style="width: 15%;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($status_pulang as $item)
						<tr>
							<td class="text-center">{{$item->id}}</td>
							<td>{{$item->nama}}</td>
							<td>
								<a href="{{url()->current()}}/edit/{{$item->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit">
									<i class="fa fa-edit"></i>
								</a>
								<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="{{$item->id}}" data-toggle="tooltip" title="Delete">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>
		</div>
	</div>
	@endsection

	@section('js')
	
	
	<script type="text/javascript"> 
		$(document).on('click', '.remove', function(){
			var id = $(this).data("pk")			
			swal({
				title: 'Hapus',
				text: "Apakah anda yakin akan menghapus data ini?",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Hapus',
                cancelButtonText: "Batal",
				showLoaderOnConfirm: true,
				preConfirm: function() {
					return new Promise(function(resolve) {
						$.ajax({
							type: "POST",
							url: BASE_URL + "admin/status-pulang/delete",
							dataType: "json",
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							data: {
								id : id
							},
							success: function (data) {
								callSwal(data.type,data.title,data.text,0);
								if(data.type =='success')
									location.reload();
							},
							error: function () {
								callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
							}
						})
					});
				}
			})
		});
	</script>
	@endsection