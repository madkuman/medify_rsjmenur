@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Identifikasi Pasien - Kasus
@endsection

@section('css')
<style type="text/css">
	table.dataTable th {
		box-sizing: border-box;
		font-size: 80%;
	}
</style>
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
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 ml-5 float-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-pencil"></i> Isi Checklist Identifikasi</button>
						@endif

						<h5>Audit Pelaksanaan Identifikasi Pasien</h5>
						<hr>

						@php $count = count($identifikasi) @endphp

						@if($count > 0)

						<div class="row">
							<div class="col-md-12 autoscroll-x">
								<table class="table table-sm table-borderless table-vcenter table-striped js-dataTable-full" style="width: 100%">
									<thead>
										<tr>
											<th width="10%" class="text-center">Tanggal</th>
											<th width="15%" class="text-center">Jenis Tindakan</th>
											<th width="12%" class="text-center">Memakai Gelang</th>
											<th width="12%" class="text-center">Pemakaian Gelang Sesuai</th>
											<th width="18%" class="text-center">Identitas Pasien Berupa Photo Diri *jiwa dan radioterapi</th>
											<th width="18%" class="text-center">Identifikasi 2 dari 3 (Nama, No RM, Tanggal Lahir)</th>
											<th width="18%" class="text-center">Pertanyaan dengan kalimat terbuka</th>
											<th width="15%" class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach($identifikasi as $item)
										@php $item_value = json_decode($item->val) @endphp
										<tr>
											<td class="text-center">{{$item->created_at->format('M-d')}}</td>
											<td>
												@if($item_value->jenis_tindakan == 'obat')
												Pemberian Obat
												@elseif($item_value->jenis_tindakan == 'nutrisi')
												Pemberian Pengobatan Nutrisi untuk Diet Khusus
												@elseif($item_value->jenis_tindakan == 'darah')
												Pemberian Darah dan Produk Darah
												@elseif($item_value->jenis_tindakan == 'spesimen')
												Pengambilan Spesimen
												@elseif($item_value->jenis_tindakan == 'terapi')
												Sebelum tindakan diagnostic atau therapeutic
												@endif
											</td>
											<td class="text-center">
												@if($item_value->gelang) <i class="fa fa-check"></i>@endif
											</td>
											<td class="text-center">
												@if($item_value->gelang_sesuai) <i class="fa fa-check"></i>@endif
											</td>
											<td class="text-center">
												@if($item_value->photo) <i class="fa fa-check"></i>@endif
											</td>
											<td class="text-center">
												@if($item_value->identifikasi_px) <i class="fa fa-check"></i>@endif
											</td>
											<td class="text-center">
												@if(!empty($item_value->pertanyaan_terbuka))
												@if($item_value->pertanyaan_terbuka) <i class="fa fa-check"></i>@endif
												@endif
											</td>
											<td class="text-center">
												<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 " data-toggle="tooltip" data-html="true" title="@include('kasus.alatbantu.hap.tooltip')" data-placement="left">
													<i class="fa fa-info"></i>
												</button>
												@if(session('my_role_'.$kasus->nomor_kasus))
												<button class="btn btn-circle btn-sm btn-outline-danger mr-5 mb-5 deleteBtn" data-id="{{$item->id}}">
													<i class="fa fa-trash"></i>
												</button>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						@else

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada Checklist Pelaksanaan Identifikasi Pasien </h4><br>
							<p>Klik tombol <b>Isi Checklist Identifikasi</b> untuk melakukan penilaian</p>
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

@include('kasus.alatbantu.identifikasi-pasien.create-modal')
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
</script>
@endsection