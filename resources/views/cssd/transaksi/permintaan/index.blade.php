@extends('layouts.main2')

@section('title')
Daftar Permintaan - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="row">
			<div class="col-3">
				<div class="block">
					<div class="block-content block-content-full">
						<H6>FILTER</H6>
						<hr>
						<div class="form-group">
							<label>Kamar Operasi</label>
							<select class="form-control js-select2" name="ruangan_ok_id" multiple id="ruangan_ok">
								@foreach($ruangan_ok as $ruang)
								<option value="{{$ruang->id}}">{{$ruang->name}}</option>
								@endforeach
							</select>
						</div>
						@php $batas_ronde = 8 @endphp
						<div class="form-group">
							<label>Ronde</label>
							<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								<select class="form-control js-select2" name="ronde_ok_min" id="ronde_ok_min">
									<option disabled selected="">Minimal</option>
									@for($i=1;$i<$batas_ronde;$i++)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
								<div class="input-group-prepend input-group-append">
									<span class="input-group-text font-w600">to</span>
								</div>
								
								<select class="form-control js-select2" name="ronde_ok_max" id="ronde_ok_max">
									<option disabled selected="">Maksimal</option>
									@for($i=1;$i<$batas_ronde;$i++)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Tanggal Operasi</label>
							<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								<input type="text" id="tanggal_min" class="form-control" id="example-daterange1" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
								<div class="input-group-prepend input-group-append">
									<span class="input-group-text font-w600">to</span>
								</div>
								<input type="text" id="tanggal_max" class="form-control" id="example-daterange2" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
							</div>
						</div>
						<div class="form-group">
							<label>Status Permintaan</label>
							<div class="custom-control custom-checkbox mb-5">
								<input class="custom-control-input" type="checkbox" name="checkselesai" id="checkselesai" value="1">
								<label class="custom-control-label" for="checkselesai">
									Selesai
								</label>
							</div>

							<div class="custom-control custom-checkbox mb-5">
								<input class="custom-control-input" type="checkbox" name="checkbelumselesai" id="checkbelumselesai" value="1" checked>
								<label class="custom-control-label" for="checkbelumselesai">
									Belum Selesai
								</label>
							</div>
						</div>
						<div class="form-group">
							<button type="button" id="filterButton" class="btn btn-primary btn-block">Filter</button>
						</div>

					</div>
				</div>
			</div>
			<div class="col-9">
				<div class="block">
					<div class="block-header">
						<h4>Daftar Permintaan</h4>
						<a href="{{url('cssd/permintaan/baru')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Permintaan Baru</a>
					</div>
					<div class="block-content block-content-full">
						<table class="table table-striped table-hover table-vcenter js-dataTable-simple" id="transaksiTable">
							<thead>
								<tr>
									<th class="d-none d-sm-table-cell text-center" style="width: 5%;">ID</th>
									<th class="d-none d-sm-table-cell text-center" style="width: 35%;">Tanggal Operasi</th>
									<th style="width: 7.5%">Kamar Operasi</th>
									<th class="d-none d-sm-table-cell text-center" style="width: 7.5%;">Ronde</th>
									<th style="width: 7.5%">Status</th>
									<th style="width: 7.5%">Detail</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</main>

@endsection

@section('js')




<script type="text/javascript">
	var table;
	draw();
	function draw(){
		table = $('#transaksiTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				type: "POST",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                	data: function(d) {
					d.ruangan_ok =  $("#ruangan_ok").val(),
					d.ronde_ok_min =  $("#ronde_ok_min").val(),
					d.ronde_ok_max =  $("#ronde_ok_max").val(),
					d.tanggal_max =  $("#tanggal_max").val(),
					d.tanggal_min =  $("#tanggal_min").val(),
					d.status_selesai =  $("#checkselesai").is(":checked"),
					d.status_belum_selesai =  $("#checkbelumselesai").is(":checked")
				},
				url: API_URL + '/cssd/permintaan/index',
			},
			language: {
				processing: '<i class="fa fa-4x fa-asterisk fa-spin text-info"></i>'
			},
			columns: [
			{ data: 'id',className: 'text-center', 
			render: function(data, type, row, meta){
				//data = '<label class="css-control css-control-success css-checkbox">&nbsp;<input type="checkbox" data-pk="'+row.id+'" class="css-control-input centang" id="centang'+row.id+'">&nbsp;<span class="css-control-indicator"></span></label>';
				data = row.id
				return data;
			}},
			{ data: 'tanggal_operasi', className: 'text-center',  },
			{ data: 'kamar_operasi', className: 'text-center',  },
			{ data: 'ronde', className: 'text-center' },
			{ data: 'status'},
			{ data: 'id',className: 'text-center', 
			render: function(data, type, row, meta){
				data = '<a class="btn btn-sm btn-circle btn-outline-primary" href="{{url("cssd/transaksi/")}}/'+row.id+'"><i class="fa fa-search-plus"></i></a>';
				return data;
			}}
			],
			order: [[ 0, "desc" ]],
			drawCallback: function(){
				updateChecked()
			},  
		});
	}

	$('#filterButton').click(function(){
		table.draw();
	})



	function updateChecked(){
		$.each(array_checked, function( index, value ) {
			var myEle = document.getElementById("centang"+value);
			if(myEle){
				myEle.checked = true;
			}
		});
	}

	var array_checked = [];

	$(document).on('click', '.centang', function(){
		pk = $(this).data("pk");
		if(this.checked) {
			array_checked.push(pk);
		} else {
			var index = array_checked.indexOf(pk);
			if (index > -1) {
				array_checked.splice(index, 1);
			}
		}
		
	})

</script>

@endsection