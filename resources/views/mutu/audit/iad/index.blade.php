@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Medify
@endsection

@section('subtitle')
Audit (IAD)
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
								<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-iad"><i class="fa fa-pencil"></i>Buat Audit IAD</button>
							</div>
							<div class="col-12 autoscroll-x" style="height: 400px;overflow-y: scroll;">
								<table class="table table-bordered table-vcenter">
									<thead>
										<tr>
											<th style="width: 25px">#</th>
											<th style="width: 200px">Tgl</th>
											<th style="width: 50px">Nama Pasien</th>
											<th style="width: 100px">No Bed</th>
											<th style="width: 100px">Hand Hygiene</th>
											<th style="width: 100px">Menggunakan APD</th>
											<th style="width: 100px">Pembersihan kulit dengan chlorhexidine</th>
											<th style="width: 100px">Lokasi pemasangan sesuai</th>
											<th style="width: 100px">Slang infuse diganti sesuai  standar</th>
											<th style="width: 100px">Swab alcohol setiap injeksi</th>
											<th style="width: 100px">Spuit yang digunakan disposable</th>
											<th style="width: 100px">Penutup insersi dengan transparan dressing</th>
											<th style="width: 100px">Perawatan lokasi insersi setiap 4 hari dan jika kotor</th>
											<th style="width: 100px">Menggunakan stopper needles</th>
											<th style="min-width: 120px" class="text-right">Info</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>27 Agustus 2019</td>
											<td>Hari Setiawan</td>
											<td>1</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>Ya</td>
											<td>
												<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 float-right" data-toggle="tooltip" data-html="true" title="@include('mutu.audit.iad.components.tooltip')" data-placement="left">
													<i class="fa fa-info"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-iad">
													<i class="fa fa-pencil"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right">
													<i class="fa fa-trash"></i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
								@include('mutu.audit.iad.components.modal-create')
								@include('mutu.audit.iad.components.modal-edit')
							</div>

							<div class="col-12 text-center py-50">
								<h4 class="font-w400 mb-5">Belum ada Audit IAD</h4>
								<p>Klik tombol <b>Buat Audit IAD</b> untuk menambahkan Audit IAD baru</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection