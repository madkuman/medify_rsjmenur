@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}} - Catatan Pengobatan Pasien - Kasus
@endsection

@section('content')
<main id="main-container">
	@include('kasus.layouts.header')
	<div class="content">
		<div class="row">
				@include('kasus.layouts.sidebar')
			

			<!-- Updates -->
			<div class="col-lg-8 col-xl-9">
				<div class="row">
					<div class="col-lg-12 modal-sidebar" style="display: none; margin-bottom: 5px;">
						<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-menu"><i class="fa fa-list"></i> Menu</button>
					</div>
					<div class="col-lg-12">
						<div class="block rounded p-0">
							@include('kasus.farmasi.components.navbar')

							<div class="block-content px-20 pt-50">


								<h4>Daftar Transaksi</h4>
								<table class="table table-bordered table-vcenter" style="width: 100%;">
									<thead>
										<tr>
											<th>No</th>
											<th>Kategori</th>
											<th>Farmasi</th>
											<th>Nomor Resep</th>
											<th>Tanggal</th>
											<th width="1"></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($transaksi as $item)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>
													@if ($item->final_detail->kategori_resep == 'tpn')
														Sediaan TPN
													@elseif($item->final_detail->kategori_resep == 'dispensing_aseptik')
														Dispensing Aseptik
													@endif
												</td>
												<td>{{ $item->owner_detail->nama }}</td>
												<td>{{ $item->final_detail->nomor_resep }}</td>
												<td>{{ $item->created_at->format('d/m/Y')}}</td>
												<td><a href="{{ url()->current() }}/{{ $item->id }}/print-formulir" class="btn btn-primary">Print</a></td>
											</tr>
										@endforeach
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


@section('js')
	<script>

	</script>
@endsection
