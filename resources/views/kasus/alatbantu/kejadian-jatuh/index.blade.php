@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Form Kejadian Jatuh - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Form Kejadian Jatuh Baru</button>
						@endif
						<h4>Form Kejadian Jatuh</h4>
						<hr>
						<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
							<tr>
								<th>Tanggal</th>
								<th>Akibat Jatuh</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
							@forelse($jatuh as $item)
							<tr>
								<td>{{$item->created_at->format('M-d')}}</td>
								<td>{{$item->akibat_jatuh}}</td>
								<td>{{$item->keterangan}}</td>
								<td>
									@if(session('my_role_'.$kasus->nomor_kasus))
									@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)

									<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.monitoring-ventilator.tooltip')" data-placement="left">
										<i class="fa fa-info"></i>
									</button>
									<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
										<i class="fa fa-trash"></i>
									</button>
									@endif
									@endif
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="5">

									<div class="text-center py-50">
										<h4 class="font-w400 mb-5">Belum ada asesmen Form Kejadian Jatuh tersedia</h4>
										<p>Klik tombol <b>Form Kejadian Jatuh Baru</b> untuk melakukan asesmen Form Kejadian Jatuh</p>
									</div>
								</td>

							</tr>

							@endforelse
						</table>
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
@include('kasus.alatbantu.kejadian-jatuh.add')
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