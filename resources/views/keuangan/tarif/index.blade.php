@extends('keuangan.layouts.main')

@section('title')
Daftar Tarif - Keuangan
@endsection

@section('css')

<style>
	.dataTables_processing {
		background-color: white;
	}
</style>
@endsection
@section('content')
@include('keuangan.tarif.components.header')

<div class="row">
	<div class="col-md-12">
		<div class="block block-rounded">
			<div class="block-header py-20">
				<span><h4 class="mb-0">Daftar Tarif</h4><hr>
					<h5></h5></span>
					<div class="block-options">
						<a href="{{url()->current()}}/baru" class="btn btn-sm btn-primary btn-hero">
							<i class="fa fa-plus"></i> Buat Tarif
						</a>
					</div>
				</div>
				<div class="block-content">
					<form method="GET">
						<div class="row">
							<div class="col-3">
								<label>Kategori </label>
								<select class="js-select2 form-control" id="departemen" name="departemen" style="width: 100%;">
									<option value="" selected>All Kategori</option>
									@foreach($kategori as $item)
									<option value="{{$item->id}}" @if(isset($kategori_selected) && $kategori_selected==$item->id) selected @endif>{{$item->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-2 pt-30">
								<button id="buttonRefresh" style="margin-bottom: 5px" url="" class="btn btn-md btn-alt-primary" data-toggle="tooltip" title="Refresh Tarif">
									<i class="fa fa-search"></i> Filter
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="block-content py-20">
					<table class="table table-striped table-hover table-vcenter transaksiTable js-dataTable-full" id="transaksiTable">
						<thead>
							<tr>
								<th class="text-center" style="width: 50px;">#  </th>
								<th class="text-center" style="width: 200px;">Kategori Tarif  </th>
								<th class="text-center" >Deskripsi  </th>
								<th class="text-center" style="width: 15%;">Aksi      </th>
							</tr>
						</thead>
						<tbody>
							@foreach($tarif as $item)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$item->kategori->nama ?? '-'}}</td>
								<td>{{$item->deskripsi}}</td>
								<td>
									<a href="{{url()->current()}}/{{$item->id}}" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail Transaksi">
										<i class="fa fa-search-plus"></i>
									</a>
									<a href="{{url()->current()}}/edit/{{$item->id}}" class="btn btn-sm btn-alt-warning" data-toggle="tooltip" title="Edit Detail Transaksi">
										<i class="fa fa-edit"></i>
									</a>
									<button class="btn btn-sm btn-alt-danger remove" id="remove" data-pk="{{$item->id}}" data-toggle="tooltip" title="Delete Transaksi">
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
	</div>
	@endsection

	@section('js')
	
	
	<script type="text/javascript"> 
		$("#departemen").select2();
		var table = jQuery('.js-dataTable-full').dataTable({
						"ordering": true,
						pageLength: 10,
						lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
						autoWidth: false
					});
		$(document).on('click', '.remove', function(){
			var id = $(this).data("pk")			
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				showLoaderOnConfirm: true,
				preConfirm: function() {
					return new Promise(function(resolve) {
						$.ajax({
							type: "POST",
							url: API_URL + "/keuangan/tarif/delete",
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