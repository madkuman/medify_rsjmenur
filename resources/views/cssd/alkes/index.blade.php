@extends('layouts.main2')

@section('title')
Daftar Alkes - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="block">
			<div class="block-header">
				<h4>Daftar Alkes</h4>
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
				</div>
			</div>

			<div class="block-content block-content-full">
				<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th>Nama Alkes</th>
							<th class="">Stok Dipinjam</th>
							<th class="">Stok Siap</th>
							<th class="">Total Stok</th>
							<th class="">Keterangan</th>
							<th class="text-center">Detail</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($alkes as $item)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="font-w600">{{$item->nama}}</td>
							<td class="">{{count($item->cssd_stok_sedang_digunakan)}}</td>
							<td class="">{{count($item->cssd_stok_siap_pakai)}}</td>
							<td class="">{{count($item->cssd_stok_total)}}</td>
							<td class="">
								@if($item->cssd_has_ineffective_item == 1)
 								<span class="badge badge-danger">Ineffective Soon</span>
 								@else
								<span class="badge badge-primary" style="display: none">efektif</span>
								@endif
							</td>
							<td class="text-center"><a href="{{url('cssd/alkes/')}}/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</main>

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

			ineffective = 0;
			effective = 0;
			
			if (filter_ineffective && aData[5].includes("Ineffective Soon")) {
				ineffective = 1;
			}
			if (filter_effective && aData[5].includes("efektif")) {
				effective = 1;
			}

			if(ineffective || effective)
				return true;
			else
				return false;
		});
		var oTable = $('#example').dataTable();
		$('#filter input').on("click", function(e) {
			oTable.fnDraw();
		});
	});
</script>

@endsection