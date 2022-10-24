@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - HAP - Kasus
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
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 ml-5 float-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-pencil"></i> Isi Surveilans HAP</button>
						@endif

						<h5>Hospital Aquired Pneumonie (HAP)</h5>
						<hr>

						@php $count = count($hap) @endphp

						@if($count > 0)

						<div class="row">
							<div class="col-md-12 autoscroll-x">
								<table class="table table-sm table-borderless table-vcenter table-striped" style="width: 100%">
									<tr>
										<th style="min-width:120px">Parameter</th>
										@foreach($hap as $item)
										<th class="text-center">{{$item->created_at->format('d')}}</th>
										@endforeach
									</tr>
									<tr>
										<td>Demam</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->demam))
											@if($item_value->demam) <i class="fa fa-check"></i>@endif
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>Leukositosis</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->leukositosis))
											@if($item_value->leukositosis) <i class="fa fa-check"></i>@endif
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>Sputum</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->sputum))
											@if($item_value->sputum) <i class="fa fa-check"></i>@endif
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>FiO2</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->fio2))
											@if($item_value->fio2) <i class="fa fa-check"></i>@endif
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>Thorax foto gambaran pneumonia</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->thorax_foto))
											@if($item_value->thorax_foto) <i class="fa fa-check"></i>@endif
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>Kultur Sputum</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->kultur_sputum))
											@if($item_value->kultur_sputum) <i class="fa fa-check"></i>@endif
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>Kultur Sputum Keterangan</td>
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">
											@if(!empty($item_value->kultur_sputum_keterangan))
											{{$item_value->kultur_sputum_keterangan}}
											@endif
										</td>
										@endforeach
									</tr>
									<tr>
										<td>Diagnosis Dokter</td>
										@foreach($hap as $item)
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
										@foreach($hap as $item)
										@php $item_value = json_decode($item->val) @endphp
										<td class="text-center">

											<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.hap.tooltip')" data-placement="left">
												<i class="fa fa-info"></i>
											</button>

										</td>
										@endforeach
									</tr>
									<tr>
										<td>Hapus</td>
										@foreach($hap as $item)
										<td class="text-center">
											@if(session('my_role_'.$kasus->nomor_kasus))
											<button class="btn btn-circle btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
												<i class="fa fa-trash"></i>
											</button>
											@endif
										</td>
										@endforeach
									</tr>
								</table>
							</div>
						</div>
						@else

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada Form hap </h4><br>
							<p>Klik tombol <b>Isi Surveilans hap</b> untuk melakukan penilaian</p>
						</div>

						@endif

					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/hap/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.hap.create-modal')
@endsection

@section('js')

<script type="text/javascript">
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

	$('input[type=radio][name=kultur_sputum]').on('change', function() {
		if (this.value == 1) {
			$('#kultur_sputum_keterangan').show();
		}
		else{
			$('#kultur_sputum_keterangan').hide();
		}
	});
</script>
@endsection