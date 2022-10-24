@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}} - Catatan Pengobatan Pasien - Kasus
@endsection

@section('css')
	<style type="text/css">
		.zoom {
			bottom: 190px;
		}

		.zoom-out {
			bottom: 120px;
		}
		.zoom-init {
			bottom: 50px;
		}
		.tableFixHead {
			overflow-y: auto; height: 100px;
			border:none!important;
		}
		.tableFixHead .headrow-1
		{
			top: 0;
		}
		.tableFixHead .headrow-2
		{
			top: 40px;
		}

		.tableFixHead .headrow-1, .tableFixHead .headrow-2
		{
			position: sticky;
			background: white;
			box-shadow: inset 1px 1px #eaecee, 0 1px #eaecee;
			border:none;
			z-index: 999;
		}

		.tableFixHead .headcol {
			background: white;
			position: sticky;
			width: 5em;
			left: 0;
			top: auto;
			border-top-width: 1px;
			margin-top: -1px;
			font-weight: 600;
			border:none;
			box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
		}

		.tableFixHead .headcolrow{
			z-index: 1000;
			position: sticky;
			left: 0;
			top: 0;
			background: white;
			box-shadow: inset 0px 1px #eaecee, 1px 1px #eaecee;
		}
		.tr-striped, .tr-striped td{
			background-color: #fbfbfb!important;
		}


	</style>
@endsection

@section('content')
<main id="main-container">
	@include('kasus.layouts.header')
	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-4 col-xl-9">
				<div class="row">
					<div class="col-lg-12">
						<div class="block rounded p-0">
							@include('kasus.farmasi.components.navbar')

							<div class="block-content px-20 pt-50">
								
								<button type="button" class="btn btn-primary min-width-125 pull-right" data-toggle="modal" data-target="#riwayatModal"><i class="fa fa-chart-area mr-5"></i>Riwayat Pemberian Obat</button>

								<button type="button" class="btn btn-secondary min-width-125 pull-right  mr-10 isiObatBtn" data-method="create" data-id=""><i class="fa fa-plus mr-5"></i>Obat Baru</button>

								<a class="btn btn-secondary pull-right mr-5" href="{{url()->current()}}/print" target="_blank">
									<i class="fa fa-print mr-5"></i>Print
								</a>

								<h4>Catatan Pengobatan Pasien</h4>
								<table class="table table-bordered table-vcenter">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Obat</th>
											<th>Aturan</th>
											<th>Rute</th>
											<th>Keterangan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										@php $count = 1 @endphp
										@forelse($pengobatan as $item)
										<tr>
											<td>{{$count++}}</td>
											<td><p style="white-space: pre;" class="{{ !empty($item->selesai_at) ? "text-primary" : "" }}">{{$item->nama_obat ?? "-"}}</p></td>
											<td>{{$item->aturan_pemakaian ?? "-"}}</td>
											<td>{{$item->rute ?? "-"}}</td>
											<td>{{$item->keterangan ?? "-"}}</td>
											<td>
												<button type="button" class="btn btn-secondary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
												<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
													@if(session('my_role_'.$kasus->nomor_kasus))
												
													@if(empty($item->selesai_at))
													<a class="dropdown-item isiPemberianBtn" href="javascript:void(0)" data-id="" data-obat-px-id="{{$item->id}}" data-nama="{{$item->nama_obat}}" data-method="create">
														<i class="fa fa-plus mr-5"></i>Isi Pemberian
													</a>
													<a class="dropdown-item" href="{{url()->current()}}/selesai/{{$item->id}}">
														<i class="fa fa-check mr-5"></i>Selesaikan
													</a>

													@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)

													<a class="dropdown-item isiObatBtn" href="javascript:void(0)" data-content="{{json_encode($item)}}" data-id="{{$item->id}}" data-method="edit">
														<i class="fa fa-pencil mr-5"></i>Edit
													</a>
													<a class="dropdown-item deleteObatBtn" href="javascript:void(0)" data-id="{{$item->id}}">
														<i class="fa fa-trash mr-5"></i>Hapus
													</a>

													@endif

													@else

													<a class="dropdown-item" href="{{url()->current()}}/selesai-batal/{{$item->id}}">
														<i class="fa fa-times mr-5"></i>Batal Selesai
													</a>

													@endif

													@endif
												</div>
											</td>
										</tr>
										@empty
										<tr>
											<td colspan="6">
												<div class="text-center py-50">
													<h4 class="font-w400 mb-5">Belum ada asesmen Catatan Pengobatan Pasien tersedia</h4>
													<p>Klik tombol <b>Catatan Pengobatan Pasien</b> untuk melakukan asesmen Catatan Pengobatan Pasien</p>
												</div>
											</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>
<form method="POST" action="{{url()->current()}}/pemberian-delete" id="formDeletePemberian">
	{{csrf_field()}}
	<input name="id" type="hidden" class="input-id">
</form>
@include('kasus.farmasi.modal.pengobatan-riwayat')
@include('kasus.farmasi.modal.pengobatan-pemberian-baru')
@include('kasus.farmasi.modal.pengobatan-add')

@endsection

@section('js')
@include('kasus.farmasi.pengobatan-components.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');

		var zoom = 1;

		$('.zoom').on('click', function(){
			zoom += 0.1;
			$('.target').css('zoom', zoom);
		});
		$('.zoom-init').on('click', function(){
			zoom = 1;
			$('.target').css('zoom', zoom);
		});
		$('.zoom-out').on('click', function(){
			zoom -= 0.1;
			$('.target').css('zoom', zoom);
		});
	});

	$(document).ready(function(){
		$('[rel="tooltip"]').tooltip({trigger: "hover"});
	});

	$(document).ready(function(){
		$(".deleteObatBtn").click(function(e){
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
