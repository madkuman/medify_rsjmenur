@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Asesmen Pra Bedah - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Buat Baru</button>
						@endif
						<h4>Asesmen Pra Bedah</h4>
						<hr>
						<div class="row">
							@php $count = count($prabedah) @endphp
							@forelse($prabedah as $item)
							<div class="col-8"> 
								@if(session('my_role_'.$kasus->nomor_kasus))
								@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
								<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
									<i class="fa fa-trash"></i>
								</button>
								@endif
								@endif
								<h5 class="mb-5 pl-5">#Asesmen Pra Bedah {{$count--}}</h5>
								@php $res = json_decode($item->val) @endphp

								@include('kasus.alatbantu.pra-bedah.tabel-hasil')
								
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
							</div>
							<hr class="my-20">
							@empty
							<div class="col-12">
								<div class="text-center py-50">
									<h4 class="font-w400 mb-5">Belum ada asesmen Asesmen Pra Bedah tersedia</h4>
									<p>Klik tombol <b>Asesmen Pra Bedah Baru</b> untuk melakukan asesmen Asesmen Pra Bedah</p>
								</div>
							</div>

							@endforelse
						</div>
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
@include('kasus.alatbantu.pra-bedah.add')
@include('kasus.alatbantu.pra-bedah.edit')
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

	$('.viewBtn').click(function(e)
	{
		var id = $(this).data('id');
		var data = $(this).data('val');


		if(data != "" && data != undefined){
			$("#viewModal input[name=id]").val(id);
			$("#viewModal input[name=keadaan_pra_bedah]").val(data.keadaan_pra_bedah);
			$("#viewModal input[name=pemeriksaan_fisik]").val(data.pemeriksaan_fisik);
			$("#viewModal input[name=gcs]").val(data.gcs);
			$("#viewModal input[name=vital_sign]").val(data.vital_sign);
			$("#viewModal input[name=td]").val(data.td);
			$("#viewModal input[name=n]").val(data.n);
			$("#viewModal input[name=suhu]").val(data.suhu);
			$("#viewModal input[name=rr]").val(data.rr);

			if(data.skull == 'on') $("#viewModal input[name=skull]").prop('checked', true);
			if(data.cervical == 'on') $("#viewModal input[name=cervical]").prop('checked', true);
			if(data.thoraks == 'on') $("#viewModal input[name=thoraks]").prop('checked', true);
			if(data.abdomen == 'on') $("#viewModal input[name=abdomen]").prop('checked', true);
			if(data.ekstremitas == 'on') $("#viewModal input[name=ekstremitas]").prop('checked', true);
			
			$("#viewModal textarea[name=asesmen]").val(data.asesmen);

			if(data.ecg == 'on') $("#viewModal input[name=ecg]").prop('checked', true);
			if(data.lab == 'on') $("#viewModal input[name=lab]").prop('checked', true);
			if(data.ro == 'on') $("#viewModal input[name=ro]").prop('checked', true);
			if(data.ct_scan == 'on') $("#viewModal input[name=ct_scan]").prop('checked', true);
			if(data.mri == 'on') $("#viewModal input[name=mri]").prop('checked', true);

			$("#viewModal input[name=lainlain]").val(data.lainlain);
			$("#viewModal textarea[name=diagnosa_pra_bedah]").val(data.diagnosa_pra_bedah);
			$("#viewModal textarea[name=planning_th_dx]").val(data.planning_th_dx);
			$("#viewModal input[name=alat_khusus]").val(data.alat_khusus);
			if(data.informed_consent == 'on') $("#viewModal input[name=informed_consent]").prop('checked', true);
		}
		$('#viewModal').modal('show');
		$("#viewModal :input").prop("disabled", true);
		$("#viewModal .editBtn").prop("disabled", false);
	})

	$('.editBtn').click(function(e){
		$("#viewModal :input").prop("disabled", false);
	})
</script>
@endsection