@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Asesmen Klinik Rehab Medik - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Asesmen Klinik Rehab Medik Baru</button>
						@endif
						<h4>Asesmen Klinik Rehab Medik</h4>
						<hr>
						<div class="row">
							<div class="col-12">
								@php $count = 1 @endphp
								@forelse($kemoterapi as $item)

								@if(session('my_role_'.$kasus->nomor_kasus))
								@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
								@include('kasus.alatbantu.rehab-medik.add2')
								<button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
									<i class="fa fa-trash"></i>
								</button>
								{{-- <button  class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$item->id}}">
									<i class="fa fa-pencil"></i>
								</button> --}}
								@endif
								@endif
								<h5 class="mb-5 pl-5">#Asesmen Klinik Rehab Medik {{$count++}}</h5>
							</div>
						</div>
						@php $res = json_decode($item->val) @endphp
						<div class="row mx-0">
							@include('kasus.alatbantu.rehab-medik.tabel-hasil')
						</div>
						@if(isset($res->lanjutan))
						@php $lanjutan = $res->lanjutan @endphp
						@include('kasus.alatbantu.rehab-medik.tabel-hasil-lanjutan')
						@else
						@include('kasus.alatbantu.rehab-medik.empty-lanjutan')
						@endif
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
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
							<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Klinik Rehab Medik tersedia</h4>
							<p>Klik tombol <b>Asesmen Klinik Rehab Medik Baru</b> untuk melakukan asesmen Asesmen Klinik Rehab Medik</p>
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
@include('kasus.alatbantu.rehab-medik.add')
@endsection

@section('js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});

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
</script>
@endsection