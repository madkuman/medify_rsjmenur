@extends('layouts.main2')

@section('title')
{{$alkes->alkes->nama}} - Daftar Alat  - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="block">
			<div class="block-content">
				<button class="btn btn-danger float-right mr-5"  id="btnDelete"><i class="fa fa-trash"></i> Hapus</button>
				<button class="btn btn-outline-success float-right mr-5" onclick="popupwindow('{{url("cssd/alkes-satuan/".$alkes->id."/print/label")}}','printLabelSemua','500','500')"><i class="fa fa-print"></i> Print Semua Label</button>
				<h5 class="mb-0"><small class="font-w400">NAMA ALAT</small></h5>
				<h4>{{$alkes->alkes->nama}}</h4>
				<hr>
			</div>
			<div class="block-header">
				<h5 class="mb-0"><small>Log Penggunaan Alat</small></h5>
			</div>
			<div class="block-content block-content-full">
				<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th>Tanggal Pemakaian</th>
							<th class="">Informasi Operasi</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 0; $total=100; @endphp
						@foreach($alkes->log as $item)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="font-w600">{{date('d F Y', strtotime($item->created_at))}}</td>
							<td class="font-w600">{{(!empty($item->transaksi->transaksi_ok->diagnosis) ? $item->transaksi->transaksi_ok->diagnosis : '-')}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</main>


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