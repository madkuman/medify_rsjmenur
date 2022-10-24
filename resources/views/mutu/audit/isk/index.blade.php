@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Medify
@endsection

@section('subtitle')
Audit (ISK)
@endsection

@section('content')


<main id="main-container">
    @include('mutu.layouts.navbar')
    <div class="content">
		<div class="row">
			<div class="col-12">
				<div class="block">
					<div class="content pt-20">
						<div class="row">
							<a class="pl-20" href="{{url()->previous()}}"><i class="si si-action-undo"></i>&nbsp;&nbsp;&nbsp;Kembali ke halaman sebelumnya</a>
							<div class="col-lg-12 mb-20">
								<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-isk"><i class="fa fa-pencil"></i>Buat Audit ISK</button>
							</div>
							<div class="col-12 autoscroll-x" style="height: 400px;overflow-y: scroll;">
								<table class="table table-bordered table-vcenter">
									<thead>
										<tr>
											<th style="width: 25px">#</th>
											<th style="width: 200px">Tgl</th>
											<th style="width: 50px">Nama Pasien</th>
											<th style="width: 100px">Pemasangan sesuai indikasi</th>
											<th style="width: 100px">APD Tepat</th>
											<th style="width: 100px">Pemasangan menggunakan alat steril</th>
											<th style="width: 100px">Hand Hygiene</th>
											<th style="width: 100px">Segera dilepas jika tidak indikasi</th>
											<th style="width: 100px">Pengisian balon sesuai 30 ml</th>
											<th style="width: 100px">Fiksasi kateter dengan plester</th>
											<th style="width: 100px">Urine bag menggantung</th>
											<th style="min-width: 120px" class="text-right">Info</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>27 Agustus 2019</td>
											<td>Hari Setiawan</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>
												<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 float-right" data-toggle="tooltip" data-html="true" title="@include('mutu.audit.isk.components.tooltip')" data-placement="left">
													<i class="fa fa-info"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-isk">
													<i class="fa fa-pencil"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right">
													<i class="fa fa-trash"></i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
								@include('mutu.audit.isk.components.modal-create')
								@include('mutu.audit.isk.components.modal-edit')
							</div>

							<div class="col-12 text-center py-50">
								<h4 class="font-w400 mb-5">Belum ada Audit ISK</h4>
								<p>Klik tombol <b>Buat Audit ISK</b> untuk menambahkan Audit ISK baru</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection