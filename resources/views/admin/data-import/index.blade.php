@extends('layouts.main-dashboard')

@section('title')
Admin - Daftar Import
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="{{url('admin/data-import/create')}}" class="pull-right">
				<i class="fa fa-plus-circle"></i> Import Data Baru</a></small> 
				Daftar Import
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="">ID</th>
						<th>Jenis</th>
						<th>File</th>
						<th>Status</th>
						<th>Progress</th>
						<th>Error Log</th>
					</tr>
				</thead>
				<tbody>
				@php $i = 1; @endphp
				@foreach($data as $isi)
					<tr>
						<td class="">{{$isi->id}}</td>
						<td class="font-w600">{{$isi->jenis}}</td>
						<td class="font-w600"><a href="{{url('')}}/{{$isi->file_path}}" class="btn btn-info"><i class="fa fa-download"></i> Download</a></td>
						</td>
						<td>
							@if($isi->status == 'done')
								<span class="badge badge-success">Done</span> 
							@elseif($isi->status == 'error')
								<span class="badge badge-danger">Error</span>
							@elseif($isi->status == 'progress')
								<span class="badge badge-primary"><i class="fa fa-spin fa-gear"></i> Progress</span>
							@else
								<span class="badge badge-secondary">Waiting</span>
							@endif
						</td>
						<td class="">
							{{$isi->current_row}} / {{$isi->total_row}}
						</td>
						<td class="">
							@if(!empty($isi->keterangan))
							<button data-keterangan="{{$isi->keterangan}}" class="btn btn-danger btn-log-error">Log Error</button>
							@endif
						</td>
					</tr>
				@php $i++; @endphp	
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal" id="logErrorModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Log Error</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
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

	$(document).on('click', '.btn-log-error', function(){
		var content = $(this).data('keterangan');
		$('#logErrorModal .modal-body').html('<pre><code>'+content+'</code></pre>')
		$('#logErrorModal').modal('show');
	
	})
</script>

@endsection