@extends('layouts.main2')

@section('title')
{{$alkes->nama}} - Alkes - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="block">
			<div class="block-content">
				<a href="{{url('cssd/alkes/'.$alkes->id.'/edit')}}" class="btn btn-info float-right"><i class="fa fa-pencil"></i> Edit</a>
				<button class="btn btn-danger float-right mr-5"  id="btnDelete"><i class="fa fa-trash"></i> Hapus</button>
				<h5 class="mb-0"><small class="font-w400">NAMA ALAT</small></h5>
				<h4>{{$alkes->nama}}</h4>
				<hr>
				<div class="row">
					<div class="col-3">
						<h6 class="mb-0"><small class="font-w400">STOK TOTAL</small></h6>
						<h5>{{count($alkes->cssd_stok_total ?? [])}}</h5>
						<h6 class="mb-0"><small class="font-w400">STOK SIAP PAKAI</small></h6>
						<h5>{{count($alkes->cssd_stok_siap_pakai ?? [])}}</h5>
						<h6 class="mb-0"><small class="font-w400">STOK SEDANG DIGUNAKAN</small></h6>
						<h5>{{count($alkes->cssd_stok_sedang_digunakan ?? [])}}</h5>
					</div>
					<div class="col-3">
						<h6 class="mb-0"><small class="font-w400">BATAS PENGGUNAAN EFEKTIF</small></h6>
						<h5>{{$alkes->max_pemakaian}}</h5>
						<h6 class="mb-0"><small class="font-w400">KETERANGAN</small></h6>
						<h5>{{$alkes->keterangan}}</h5>
					</div>
					<div class="col">
						<h6 class="mb-0"><small class="font-w400">PROSEDUR STERILISASI</small></h6>
						<h5 class="font-w400" style="white-space:pre-wrap;">{!!$alkes->prosedur_sterilisasi!!}</h5>
					</div>
				</div>
			</div>
			<div class="block-content-full">
			</div>
		</div>
		<div class="block">
			<div class="block-header">
				<h4>Daftar Stok</h4>
				<div class="pull-right">
					<a href="javascript:void(0)" class="btn btn-outline-success" onclick="popupwindow('{{url("cssd/alkes/".$alkes->id."/print/label-semua")}}','printLabelSemua','500','500')"><i class="fa fa-print"></i> Print Semua Label</a>
					<a href="{{url('cssd/alkes/baru')}}" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSatuan"><i class="fa fa-plus"></i> Tambah Stok Alat</a>
				</div>
			</div>
			<div class="block-content" id="filter">
				<div class="form-group row">
					<div class="col-2">
						<label>Efektifitas Alat</label>
						<div class="custom-control custom-checkbox mb-5">
							<input class="custom-control-input" type="checkbox" name="example-checkbox1" id="filter-effective" value="option1" checked="">
							<label class="custom-control-label" for="filter-effective">Effective</label>
						</div>
						<div class="custom-control custom-checkbox mb-5">
							<input class="custom-control-input" type="checkbox" name="example-checkbox2" id="filter-ineffective" value="option2" checked>
							<label class="custom-control-label" for="filter-ineffective">Ineffective Soon</label>
						</div>
					</div>
					<div class="col-2">
						<label>Ketersediaan Alat</label>
						<div class="custom-control custom-checkbox mb-5">
							<input class="custom-control-input" type="checkbox" name="example-checkbox1" id="filter-ready" value="option1" checked="">
							<label class="custom-control-label" for="filter-ready">Ready</label>
						</div>
						<div class="custom-control custom-checkbox mb-5">
							<input class="custom-control-input" type="checkbox" name="example-checkbox2" id="filter-out" value="option2" checked>
							<label class="custom-control-label" for="filter-out">Out</label>
						</div>
					</div>
				</div>
			</div>

			<div class="block-content block-content-full">
				<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th>Kode Barang</th>
							<th class="">Sisa Pemakaian</th>
							<th class="">Status</th>
							<th class="">Keterangan</th>
							<th class="text-center">Detail</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 0; $total=100; @endphp
						@foreach($alkes->cssd_alkes_satuan as $item)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="font-w600">{{$item->slug}}</td>
							<td class="font-w600">{{$alkes->max_pemakaian - $item->jumlah_pemakaian}}</td>
							<td class="">
								@if(!empty($item->ok_transaksi_id))
								<span class="text-warning">OUT</span>
								@else
								<span class="text-primary">READY</span>
								@endif
							</td>
							<td class="">
								@if($item->is_effective == 0)
								<span class="badge badge-danger">Ineffective Soon</span>
								@else
								<span class="badge badge-primary" style="display: none">efektif</span>
								@endif
							</td>
							<td class="text-center"><a href="{{url('cssd/alkes-satuan/')}}/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</main>

<div class="modal fade" id="modalTambahSatuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Alat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{url('cssd/alkes-satuan/baru')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<label>Stok Tambahan</label>
						<input class="form-control" type="number" name="stok" required="">
					</div>
					<input class="form-control" type="hidden" name="alkes_id" required="" value="{{$alkes->id}}">
					<div class="form-group">
						<label>Perkiraan Jumlah Pemakaian</label>
						<input class="form-control" type="number" name="jumlah_pemakaian" required="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>


<form method="POST" action="{{url('cssd/alkes/'.$alkes->id.'/delete')}}" id="formDelete">
	{{csrf_field()}}
</form>

@endsection

@section('js')




<script type="text/javascript">
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 10,
		lengthMenu: [[10,20,50,100], [10,20,50,100]],
		autoWidth: false
	});

	$(document).ready(function() {
		$.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
			var filter_ineffective = $('#filter-ineffective').is(':checked');
			var filter_effective = $('#filter-effective').is(':checked');
			var filter_ready = $('#filter-ready').is(':checked');
			var filter_out = $('#filter-out').is(':checked');

			ineffective = 0;
			effective = 0;
			ready = 0;
			out = 0;
			
			if (filter_ineffective && aData[4].includes("Ineffective Soon")) {
				ineffective = 1;
			}
			if (filter_effective && aData[4].includes("efektif")) {
				effective = 1;
			}
			if (filter_ready && aData[3].includes("READY")) {
				ready = 1;
			}
			if (filter_out && aData[3].includes("OUT")) {
				out = 1;
			}

			if((ineffective || effective) && (ready || out))
				return true;
			else
				return false;
		});
		var oTable = $('#example').dataTable();
		$('#filter input').on("click", function(e) {
			oTable.fnDraw();
		});
	});

	
	$('#btnDelete').click(function(){
		swal({
			title: 'Apakah anda yakin?',
			text: "Anda tidak dapat mengembalikan data yang dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$('#formDelete').submit();
			}
		})
	})
</script>


@endsection