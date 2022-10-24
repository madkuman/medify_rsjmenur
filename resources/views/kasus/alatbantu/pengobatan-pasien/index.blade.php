@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Catatan Pengobatan Pasien - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right reded" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Catatan Pengobatan Pasien Baru</button>
						@endif
						<h4>Catatan Pengobatan Pasien</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($pengobatan as $item)

						@php 
						$res = json_decode($item->val); 
						$riwayat = isset($res->riwayat) ?   $res->riwayat : '[]';
						@endphp
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>

						@if(!isset($res->selesai))
						<a  class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 pull-right"data-toggle="tooltip" title="Selesai" data-placement="bottom" href="{{url()->current()}}/selesai/{{$item->id}}">
							<i class="fa fa-check"></i>
						</a>
						@endif
						@endif
						<button type="btn" class="btn btn-sm btn-rounded btn-alt-success mr-5 mb-5 pull-right tatalaksana-btn min-width-125" data-id="{{$item->id}}" data-selesai="{{isset($res->selesai)}}" data-pemberian="{{json_encode($riwayat)}}" id="tatalaksana-btn-{{$item->id}}">
							<i class="fa fa-pencil"></i> Isi Pemberian
						</button>
						@endif
						<h5 class="mb-5 pl-5">#Catatan Pengobatan Pasien {{$count++}}</h5>
						<div class="row" id="fungsional-{{$item->id}}">
							@include('kasus.alatbantu.pengobatan-pasien.tabel-hasil')
						</div>
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10 pt-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10 pt-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date('d F y, H:i', strtotime($item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen Catatan Pengobatan Pasien tersedia</h4>
							<p>Klik tombol <b>Catatan Pengobatan Pasien Baru</b> untuk melakukan asesmen Catatan Pengobatan Pasien</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>
@include('kasus.alatbantu.pengobatan-pasien.add')
@include('kasus.alatbantu.pengobatan-pasien.pemberian')
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

	$(document).ready(function(){
		$(".deleteBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputId').val(id);
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus data ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
				{
					$('#formDelete').submit();
				}
			});
		});
	});

	$('submit-pemberian')

	$(".tatalaksana-btn").click(function(e){
		pemberian_id = $(this).data('id');
		var pemberian = $(this).data('pemberian');
		console.log(pemberian);

		if($(this).data('selesai')){
			$('#tanggal-pemberian').hide();
			$('#jam-pemberian').hide();
			$('#submit-pemberian').hide();
		}else{
			$('#submit-pemberian').show();
			$('#tanggal-pemberian').show();
			$('#jam-pemberian').show();
		}
		if(pemberian && Array.isArray(pemberian)){
			$('.td-tanggal').remove();
			$('.td-jam').remove();
			$('.td-aksi').remove();
			for (var i = 0; i < pemberian.length; i++) {
				$('#tr-tanggal').append(`
					<td width="150" class="td-tanggal td-${i}">
						<div class="show-${i}"> ${pemberian[i].tanggal}
						<input type="text" class="form-control" value="${pemberian[i].tanggal}" style="display:none;" name="tgl[]">
					</td>
				`);
				$('#tr-jam').append(`
					<td class="td-jam  td-${i}">
						<div class="show-${i}"> ${pemberian[i].jam}
						<input type="text" class="form-control" value="${pemberian[i].jam}" style="display:none;" name="jam[]">
					</td>
				`)
				$('#tr-aksi').append(`
					<td class="td-aksi text-center  td-${i}">
						<button class="btn-outline-danger btn-circle btn-sm btn delete-detail" data-id="${i}">
							<i class="fa fa-trash"></i>
						</button>
						<button class="btn-outline-primary btn-circle btn-sm btn" data-id="${i}" style="display:none;">
							<i class="fa fa-trash"></i>
						</button>
						<button class="btn-outline-success btn-circle btn-sm btn" data-id="${i}" style="display:none;">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				`);
				$('.delete-detail').on('click', function(){
					var index = $(this).data('id');
					console.log('.td-'+index);
					$('.td-'+index).remove();
				})
			}
		}
		$('#id-pemberian').val(pemberian_id)

		$('#tatalaksana-modal').modal('toggle');
	});
</script>
@endsection