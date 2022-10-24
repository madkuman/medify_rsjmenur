@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Tanda Sepsis - Kasus
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Sepsis Baru</button>
						@endif
						<h4>Sepsis</h4>
						<hr>
						@php $count = count($sepsis) @endphp
						@if($count > 0)

						<div class="row">
							<div class="col-12">
								<table class="table table-sm table-striped table-borderless table-vcenter" style="width: 100%">
									<thead>
										<tr>
											<th style="min-width:120px" >Parameter</th>
											@foreach($sepsis as $item)
											<th class="text-center">{{$item->created_at->format('d')}}</th>
											@endforeach
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Hipotermia dan/atau Hipertermia</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->hipotermia))
												@if($item_value->hipotermia) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Hipotensi</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->hipotensi))
												@if($item_value->hipotensi) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Menggigil</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->menggigil))
												@if($item_value->menggigil) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Hipoxia</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->hipoxia))
												@if($item_value->hipoxia) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Anuria</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->anuria))
												@if($item_value->anuria) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Leukositosis</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->leukositosis))
												@if($item_value->leukositosis) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Shock</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->shock))
												@if($item_value->shock) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td> Terjadi di Luar Rumah Sakit</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->terjadi_di_luar_rs))
												@if($item_value->terjadi_di_luar_rs) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td> Kultur Darah</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->kultur_darah))
												@if($item_value->kultur_darah) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td> Kultur Darah Keterangan</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->kultur_darah_keterangan))
												{{$item_value->kultur_darah_keterangan ?? ''}}
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td> Kultur Urine</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->kultur_urine))
												@if($item_value->kultur_urine) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td> Kultur Urine Keterangan</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->kultur_urine_keterangan))
												{{$item_value->kultur_urine_keterangan ?? ''}}
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Diagnosis Dokter</td>
											@foreach($sepsis as $item)
											@php $item_value = json_decode($item->val) @endphp
											<td class="text-center">
												@if(!empty($item_value->dx_dokter))
												@if($item_value->dx_dokter) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Info</td>
											@foreach($sepsis as $item)
											<td class="text-center">
											<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.isk.tooltip')" data-placement="left">
												<i class="fa fa-info"></i>
											</button>
											</td>
											@endforeach
										</tr>
										<tr>
											<td>Hapus</td>
											@foreach($sepsis as $item)
											<td class="text-center">
											@if(session('my_role_'.$kasus->nomor_kasus))
											<button class="btn btn-circle btn-sm btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
												<i class="fa fa-trash"></i>
											</button>
											@endif
											</td>
											@endforeach
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						@else
						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada Asesmen Tanda Sepsis Tersedia</h4>
							<p>Klik tombol <b>Tanda Sepsis Baru</b> untuk mencatat Asesmen Tanda Sepsis</p>
						</div>
						@endif
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
@include('kasus.alatbantu.tanda-sepsis.add')
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

	$('input[type=checkbox][name=kultur_darah]').on('change', function() {
		var value = $('input[type=checkbox][name=kultur_darah]').is(':checked');
		if (value) {
			$('#kultur_darah_keterangan_text').val('');
			$('#kultur_darah_keterangan').show();
		}
		else{
			$('#kultur_darah_keterangan_text').val('');
			$('#kultur_darah_keterangan').hide();
		}
	});

	$('input[type=checkbox][name=kultur_urine]').on('change', function() {
		var value = $('input[type=checkbox][name=kultur_darah]').is(':checked');
		if (value) {
			$('#kultur_urine_keterangan_text').val('');
			$('#kultur_urine_keterangan').show();
		}
		else{
			$('#kultur_urine_keterangan_text').val('');
			$('#kultur_urine_keterangan').hide();
		}
	});
</script>
@endsection