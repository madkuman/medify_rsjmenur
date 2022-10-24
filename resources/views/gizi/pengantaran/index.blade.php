@extends('gizi.layouts.index')

@section('title')
Gizi Pengantaran
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				Daftar Pengantaran Makanan <small>{{$date}}</small>
			</h3>
		</div>
		<div class="block-content" id="filter">
			<div class="form-group row">
				<div class="col-2">
					<label>Waktu Makan</label>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" name="example-checkbox1" id="filter-pagi" value="option1" checked="">
						<label class="custom-control-label" for="filter-pagi">Pagi</label>
					</div>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" name="example-checkbox2" id="filter-siang" value="option2" checked>
						<label class="custom-control-label" for="filter-siang">Siang</label>
					</div>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" name="example-checkbox3" id="filter-sore" value="option3" checked>
						<label class="custom-control-label" for="filter-sore">Sore</label>
					</div>
				</div>
				<!-- <div class="col-2">
					<label>&nbsp;</label>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" name="example-checkbox1" id="filter-pagi" value="option1" checked="">
						<label class="custom-control-label" for="filter-pagi">Snack Pagi</label>
					</div>
					<div class="custom-control custom-checkbox mb-5">
						<input class="custom-control-input" type="checkbox" name="example-checkbox3" id="filter-sore" value="option3" checked>
						<label class="custom-control-label" for="filter-sore">Snack Sore</label>
					</div>
				</div> -->
				<div class="col-md-3">
					<label>Tanggal</label>
					<form action="{{url()->current()}}" method="GET">
						<div class="input-group">
							<input type="text" class="js-datepicker form-control" id="filter-tanggal" 
							name="tanggal" data-week-start="1" data-autoclose="true" 
							data-today-highlight="true" data-date-format="dd-mm-yyyy" autocomplete="off"
							placeholder="Pilih Tanggal Pengantaran">
							<!-- <div class="input-group-append">
								<button type="submit" class="btn btn-secondary">Filter</button>
							</div> -->
						</div>
						<label>Lokasi</label>
						<select name="lokasi" id="pokok_sore" class="form-control js-select2" style="width: 100%;" data-size="2" required>   
							<option value="0" selected disabled>Pilih Lokasi Pengantaran</option>
							@php $j = count($bangsal) @endphp
							@for($i=0;$i<$j;$i++)
							<option value="{{$bangsal[$i]->id}}">{{$bangsal[$i]->nama}}</option>
							@endfor
						</select>
						<button type="submit" class="btn btn-secondary pull-right">Filter</button>
					</form>
				</div>
			</div>
		</div>
		<div class="block-header">
			<h3 class="block-tittle">
				<small><a href="{{url('gizi/pengantaran/print')}}?tanggal=
				@if(!empty($date))
				{{$date}}
				@else
				{{date('d F Y')}}
				@endif
				&lokasi={{$lokasi}}" class="pull-right mr-15"><i class="fal fa-print"></i> Print Pengantaran Makanan</a></small>
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama Pasien</th>
						<th class="">Ruangan</th>
						<th class="">Waktu</th>
						<th>Diantar pada</th>
						<th class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
					@php $i=1; @endphp
					@foreach($data as $waktu)
						@foreach($waktu as $detail)
						<tr>
							<td>{{$i}}</td>
							<td class="font-w600">{{$detail['pemesanan']->pasien->name}}</td>
							<td class="">{{$detail[0]->lokasi->nama}}</td>
							<td class="">
							<span class="badge badge-success">
							@if($detail[0]->waktu_makan_id == 1)
							Makan Pagi
							@elseif($detail[0]->waktu_makan_id == 2)
							Makan Siang
							@elseif($detail[0]->waktu_makan_id == 3)
							Makan Sore
							@elseif($detail[0]->waktu_makan_id == 4)
							Snack Pagi
							@elseif($detail[0]->waktu_makan_id == 5)
							Snack Sore
							@endif 
							</span></td>
							@if(empty($detail[0]->delivered_at))
							<td>Belum Diantar</td>
							@else
							<td>{{$detail[0]->delivered_at}} - {{$detail[0]->pengantar->name}}</td>
							@endif
							<td>
								<div class="custom-control custom-checkbox mb-5">
								@if(empty($detail[0]->delivered_at))
								<button data-id="{{$detail['pemesanan']->id}}" data-waktu="{{$detail['0']->waktu_makan_id}}" class="btn btn-primary">
								<i class="fa fa-check"></i></button>
								@else
								<span class="badge badge-success">checked</span>
								@endif
								</div>
							</td>
							<!-- <td class="text-center"><a href="{{url('gizi/pemesanan/id')}}" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a></td> -->
						</tr>
						@php $i++; @endphp		
						@endforeach
					@endforeach					
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
		pageLength: 10,
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		autoWidth: false
	});

	$(document).ready(function() {
		$.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
			var f_pagi = $('#filter-pagi').is(':checked');
			var f_siang = $('#filter-siang').is(':checked');
			var f_sore = $('#filter-sore').is(':checked');

			var show_waktu = 0
			if (f_pagi && aData[3].includes("Pagi")) {
				show_waktu = 1;
			}
			if (f_siang && aData[3].includes("Siang")) {
				show_waktu = 1;
			}
			if (f_sore && aData[3].includes("Sore")) {
				show_waktu = 1;
			}
			
			if(show_waktu) return true
				else return false;
		});
		var oTable = $('#example').dataTable();
		$('#filter input').on("click", function(e) {
			oTable.fnDraw();
		});

		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; 
		var yyyy = today.getFullYear();

		if(dd<10) {
			dd = '0'+dd
		} 

		if(mm<10) {
			mm = '0'+mm
		} 


		today = dd + '-' + mm + '-' + yyyy;
		//$('#filter-tanggal').val(today)

	});

	$(".btn-primary").click(function(){
		var id = $(this).data('id');
		var waktu = $(this).data('waktu');
		var tombol = $(this);
		var atas = tombol.parent();
		console.log($(this));
		$.ajax({
			url : API_URL + '/gizi/pengantaran/'+id+'?waktu='+waktu+'',
			dataType: 'json',
			success: function(data){
                   console.log(data);
                   console.log(tombol.parent());
                   tombol.parent().empty();
                   atas.append('<span class="badge badge-success">checked</span>');
                }
		});
	});
</script>
@endsection