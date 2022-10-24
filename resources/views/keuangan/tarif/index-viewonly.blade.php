@extends('layouts.main-simple')

@section('title')
Daftar Tarif
@endsection

@section('css')

<style>
	.dataTables_processing {
		background-color: white;
	}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="block block-rounded px-20">
			<div class="block-header py-20 row">
				<span class="col-lg-12 col-sm-12"><h4 class="mb-0">Daftar Tarif</h4><hr>
					<h5></h5>
				</span>
			</div>
			<div class="block-content">
				<form method="GET">
					<div class="row">
						<div class="col-8 col-lg-3 pr-0">
							<label>Kategori </label>
							<select class="js-select2 form-control" id="kategori" name="kategori" style="width: 100%;">
								<option value="" selected>All Kategori</option>
								@foreach($kategori as $item)
								<option value="{{$item->id}}" @if($kategori_selected == $item->id) selected @endif>{{$item->nama}}</option>
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
			<div class="block-content" style="overflow: auto;">
				<table class="table table-striped table-hover table-vcenter transaksiTable js-dataTable-full py-0" id="transaksiTable">
					<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#  </th>
							<th class="text-center" style="width: 200px;">Kategori Tarif  </th>
							<th class="text-center" >Deskripsi  </th>
							<th class="text-center" >Aksi  </th>
						</tr>
					</thead>
					<tbody>
						@foreach($tarif as $item)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$item->kategori->nama ?? '-'}}</td>
							<td>{{$item->deskripsi}}</td>
							<td><button class="btn btn-primary btn-lihat" data-id="{{$item->id}}" data-deskripsi="{{$item->deskripsi}}">Lihat</button></td>
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-single" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright" role="document">
		<div class="modal-content">
			<div class="block mb-0">
				<div class="block-content">
					<div class="loading-animation text-center p-20">
						<i class="fa fa-spinner fa-spin text-primary fa-4x"></i>
					</div>
					<div class="main-content">
						<h4 class="mb-5 tarif-nama">Nama Tarif</h4>
						<hr>
						<table class="table table-striped" style="width: 100%">
							<thead>
								<tr>
									<th>Kelas</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1A</td>
									<td>Rp 20,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')


<script type="text/javascript"> 
	$("#kategori").select2();
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 10,
		lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
		autoWidth: false
	});

	$(document).on('click', '.btn-lihat', function(){ 
		var id = $(this).data('id')
		var deskripsi = $(this).data('deskripsi')
		$('#modal-single').modal('show');
		$('#modal-single .loading-animation').show();
		$('#modal-single .main-content').hide();

		$.ajax({
			type:'GET',
			url: API_URL+"/keuangan/tarif/get-master?id="+id,
			tryCount : 0,
            dataType: 'json',
			retryLimit : 3,
			success:function(data){
				$('#modal-single .table tbody').empty()
				$.each(data, function( index, value ) {
				  	content = `
				  	<tr>
				  		<td class="h5 font-w400">`+value.kelas+`</td>
				  		<td class="h5 font-w400">`+value.harga+`</td>
				  	</tr>
				  	`
				  	$('#modal-single .table tbody').append(content)
				  	$('#modal-single .tarif-nama').text(deskripsi)
				});
				$('#modal-single .loading-animation').hide();
				$('#modal-single .main-content').show();
			},
			error : function(xhr, textStatus, errorThrown ) {
				this.tryCount++;
				if (this.tryCount <= this.retryLimit) {
					$.ajax(this);
					return;
				}        
				$('#modal-single').modal('hide');
				return callSwal("error","Gagal","Terjadi kesalahan server","");
			}
		});
	})
</script>
@endsection