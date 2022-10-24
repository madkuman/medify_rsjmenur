@extends('kepegawaian.layouts.main')

@section('title')
Master Kuisioner
@endsection

@section('subtitle')
Master Kuisioner
@endsection

@section('css')

@endsection

@section('content')

<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="#" data-toggle="modal" data-target="#modal-create-kuisioner" class="pull-right">
					<i class="fa fa-plus-circle"></i> Tambah Kuisioner</a>
				</small>
				<div id="tahun">
					Daftar Kuisioner
				</div> 
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" style="width: 5%">No</th>
						<th style="width: 55%; text-align: center">Nama Kuisioner</th>
						<th style="width: 15%; text-align: center">Pertanyaan</th>
						<th style="width: 15%; text-align: center">Status</th>
						<th style="width: 10%; text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
                    @php $i = 1; @endphp
					@foreach($kuisioner as $item)
					<tr>
						<td class="text-center">{{$i}}</td>
                        <td>{{$item->nama}}</td>
                        <td class="text-center"><a href="{{url('/kepegawaian/master/kuisioner/'.$item->id.'/pertanyaan')}}" class="btn btn-rounded btn-noborder btn-outline-primary min-width-125">{{$item->pertanyaan->count()}} Pertanyaan</a></td>
						<td class="text-center">
							<span class="badge badge-{{$item->status_aktif == 0 ? 'danger' : 'success'}}">{{$item->status}}</span>
							@if ($item->publik == 1)
							<span class="badge badge-primary">Publik</span>
							@endif
						</td>
						<td class="text-center">
							<a href="#" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5" onclick="editModal({{$item->id}})">
							<i class="fa fa-edit"></i></a>
							<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
							data-toggle="modal" data-id="{{$item->id}}" data-tanya="{{$item->pertanyaan->count()}}" data-nama="{{$item->nama}}">
							<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@php $i++; @endphp	
					@endforeach
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

@include('kepegawaian.master.kuisioner.component.modal-create-kuisioner')
@include('kepegawaian.master.kuisioner.component.modal-edit-kuisioner')
@endsection

@section('js')


<script type="text/javascript">
function editModal(id) {
	$.ajax({
		url: API_URL + '/kepegawaian/kuisioner/get/'+ id,
		type: 'GET',
		dataType: 'json',
		beforeSend:function() {
			$('#loading').removeClass('d-none');
			$('#edit-content').addClass('d-none');
		},
		success: function(data) {
			var nama = data.nama;
			var status = data.status_aktif;
			$('#departemen-edit').select2().val("").trigger('change');
			
			if (status == 1) $('#status-edit').attr('checked', true);
			else $('#status-edit').attr('checked', false);

			if (data.publik == 1) {
				$('#publik-edit').prop('checked', true);
				$('#departemen-edit').prop('disabled', false);
				if (data.departemen_id != null) {
					$('#departemen-edit').select2().val(data.departemen_id).trigger('change');
				}
			}
			else {
				$('#departemen-edit').prop('disabled', true);
				$('#publik-edit').prop('checked', false);
			}

			$('#kuisionerid-edit').val(id);
			$('#nama-edit').val(nama);
			$('#deskripsi-edit').val(data.deskripsi);

			$('#loading').addClass('d-none');
			$('#edit-content').removeClass('d-none');
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest, textStatus, errorThrown);
		},
	});

	$('#modal-edit-kuisioner').modal('show');
}

jQuery('.js-dataTable-full').dataTable({
	"ordering": true,
	pageLength: 8,
	lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
	autoWidth: false
});

$(document).on("click",".btn-outline-danger", function () {
	var id = $(this).data('id')
	var nama = $(this).data('nama')
	var tanya = $(this).data('tanya');
	console.log(id,nama);
	$("#del-btn").attr('href','{{url("kepegawaian/master/kuisioner/")}}'+ '/' + id + '/hapus')
	if (tanya > 0) {
		$("#show-name").html('<b>Terdapat ' + tanya + ' pertanyaan dalam kuisioner ini.</b><br>Anda yakin ingin menghapus Kuisioner ' + nama + '?')
	}else {
		$("#show-name").html('Anda yakin ingin menghapus Kuisioner ' + nama + '?')
	}
})

$("#modal-create-kuisioner").on("hidden.bs.modal", function () {
	$('#publik').attr('checked', false);
	$('#departemen').select2().val("").trigger('change');
	$('#departemen').prop('disabled', true);
	$('#form-add-kuisioner')[0].reset();
});

$(document).on("change", ".publik-check", function () {
	element_id = $(this).prop('id');
	element_status = $(this).prop('checked');
	str = element_id.split('-');
	$('#departemen').select2().val("").trigger('change');
	if (str.length > 1) {
		if (element_status == true) $('#departemen-edit').prop('disabled', false);
		else $('#departemen-edit').prop('disabled', true);
	} else {
		if (element_status == true) $('#departemen').prop('disabled', false);
		else $('#departemen').prop('disabled', true);
	}
});
</script>
@endsection