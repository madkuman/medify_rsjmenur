@extends('kepegawaian.layouts.main')

@section('title')
Master Nama Bank
@endsection

@section('subtitle')
Master Nama Bank
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small>
					<a href="#modal_tambah" data-toggle="modal" class="pull-right btn-tambah">
					<i class="fa fa-plus-circle"></i> Tambah Nama Bank</a>
				</small> 
				Daftar Nama Bank
			</h3>
		</div>
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="" width="50px">No</th>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@php $i = 1; @endphp
					@foreach($kualifikasi as $item)
					<tr>
						<td class="">{{$i}}</td>
						<td class="font-w600">{{$item->nama}}</td>
						<td class="">
							<a href="#editmodal" data-url="{{url('/kepegawaian/master/nama-bank/edit/')}}/{{$item->id}}" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5"
								data-toggle="modal" data-id="{{$item->id}}">
								<i class="fa fa-edit"></i></a>
							<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
								data-toggle="modal" data-url="{{url('/kepegawaian/master/nama-bank/delete/')}}/{{$item->id}}" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
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
	
	@include('kepegawaian/master/nama-bank/modal-tambah')
	@include('kepegawaian/master/nama-bank/modal-edit')
	@include('kepegawaian/master/nama-bank/modal-delete')

	@endsection

	@section('js')
	<script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

	<script type="text/javascript">
		jQuery('.js-dataTable-full').dataTable({
			"ordering": true,
			pageLength: 8,
			lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
			autoWidth: false
		});

		$(document).ready(function(){
			$('.btn-spin').hide();
		})

		$(document).on("click",".btn-submit", function () {
			$('.btn-spin').show();
		})
		$(document).on("click",".btn-delete", function () {
			$('.btn-spin').show();
		})

		$(document).on("click",".btn-batal", function () {
			$('.btn-spin').hide();
		})

		$(document).on("click",".btn-outline-danger", function () {
			var url = $(this).data('url');
			var nama = $(this).data('nama');
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form_delete').attr('action',url);
			$("#show-name").html('Anda yakin ingin menghapus data Kualifikasi ' + nama + '?')

		})

		$(document).on("click",".btn-outline-info", function () {
			var url =  $(this).data('url');
			getData(url);
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form-edit').attr('action',url);
		});

		function getData(url) {
            $.ajax({
                type: "GET",
                url: url,
                beforeSend:function() {
                        $('#loading').removeClass('d-none');
                        $('#edit-content').addClass('d-none');
                    },
                success: function(data){
                    console.log(data);
                    $('#nama_edit').val(data.nama);
                    $('#loading').addClass('d-none');
                    $('#edit-content').removeClass('d-none');
                },
            });
        }
	</script>

	@endsection