@extends('kepegawaian.layouts.main')

@section('title')
Master Corporate Grade
@endsection

@section('subtitle')
Master Corporate Grade / Grade
@endsection

@section('css')

@endsection

@section('content')

<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title"> 
				Daftar Corporate Grade
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th width="50px">No</th>
						<th>Nama Grade</th>
						<th>Level</th>
						<th>Profesi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@for($i = 1 ; $i < 7 ; $i++)
					<tr>
						<td class="">{{$i}}</td>
						<td class="font-w600">D{{$i}}</td>
						<td class="font-w600">{{$i}}</td>
						<td class="font-w600">Dokter</td>
						<td class="">
							<a href="{{url()->current()}}/baru" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5">
								<i class="fa fa-edit"></i>
							</a>
						</td>
					</tr>
					@endfor
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="deletemodal" class="modal fade" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p id="show-name"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a id="del-btn">
					<button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
				</a>
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
</script>

@endsection