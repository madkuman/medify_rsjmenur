@extends('gizi.layouts.index')

@section('title')
Gizi Stok
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Bahan Makanan
			</h3>
		</div>
		<div class="block-content" id="filter">
			<div class="form-group row">
				<div class="col-2">
					<label>Filter</label>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" id="stok-aman" value="on" checked="">
						<label class="custom-control-label" for="stok-aman">Stok Aman</label>
					</div>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" id="stok-akan-habis" value="on" checked="">
						<label class="custom-control-label" for="stok-akan-habis">Stok Mau Habis</label>
					</div>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" id="stok-habis" value="on" checked="">
						<label class="custom-control-label" for="stok-habis">Stok Habis</label>
					</div>
				</div>
			</div>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Bahan</th>
						<th class="">Satuan</th>
						<th class="">Stok Saat Ini</th>
						<th class="">Stok Minimal</th>
						<th class="">Status</th>
					</tr>
				</thead>
				<tbody>
					@php $j = count($bahan) @endphp
					@for($i=0;$i<$j;$i++)
					<tr>
						<td class="text-center">{{$i+1}}</td>
						<td class="font-w600">{{$bahan[$i]->nama}}</td>
						<td class="">{{$bahan[$i]->satuan}}</td>
						<td class="">{{$bahan[$i]->stok}}</td>
						<td class="">{{$bahan[$i]->stok_minimal}}</td>
						<td class="">
							<!--delete kalo mau production-->
							@if($bahan[$i]->stok > $bahan[$i]->stok_minimal)
							<span class="badge badge-primary" style="display: none">Safe Stock</span>
							@elseif($bahan[$i]->stok < $bahan[$i]->stok_minimal)
							<span class="badge badge-warning">Low Stock</span>
							@elseif($bahan[$i]->stok == 0)
							<span class="badge badge-danger">Out of Stock</span>
							@endif
						</td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('js')




<script type="text/javascript">
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});

	$(document).ready(function() {
		$.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
			var lowstock = $('#stok-akan-habis').is(':checked');
			var outstock = $('#stok-habis').is(':checked');
			var safestock = $('#stok-aman').is(':checked');
			
			var show = 0

			if (lowstock && aData[5].includes("Low Stock")) {
				show = 1;
			}
			if (outstock && aData[5].includes("Out of Stock")) {
				show = 1;
			}
			if (safestock && aData[5].includes("Safe Stock")) {
				show = 1;
			}

			if(show) return true
				else return false;
		});
		var oTable = $('#example').dataTable();
		$('#filter input').on("click", function(e) {
			oTable.fnDraw();
		});

	});
</script>
@endsection