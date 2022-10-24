@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Medify
@endsection

@section('subtitle')
Audit (VAP)
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
								<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-vap"><i class="fa fa-pencil"></i>Buat Audit VAP</button>
							</div>
							<div class="col-12 autoscroll-x" style="height: 400px;overflow-y: scroll;">
								<table class="table table-bordered table-vcenter">
									<thead>
										<tr>
											<th style="width: 25px">#</th>
											<th style="width: 200px">Tgl</th>
											<th style="width: 50px">Nama Pasien</th>
											<th style="width: 100px">No Bed</th>
											<th style="width: 100px">HOB >30-45</th>
											<th style="width: 100px">Pengkajian setiap hari terhadap sedasi dan extubasi</th>
											<th style="width: 100px">Hand hygiene</th>
											<th style="width: 100px">Oral Hygiene 4 – 6 jam </th>
											<th style="width: 100px">Penyikatan gigi setiap 12 jam</th>
											<th style="width: 100px">Suction / manajemen sekresi</th>
											<th style="width: 100px">Profilaksis peptic ulcer</th>
											<th style="width: 100px">DVT Profilaksis</th>
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
											<td>
												<button type="button" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 float-right" data-toggle="tooltip" data-html="true" title="@include('mutu.audit.vap.components.tooltip')" data-placement="left">
													<i class="fa fa-info"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5 float-right" data-toggle="modal" data-target="#modal-edit-vap">
													<i class="fa fa-pencil"></i>
												</button>
												<button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right">
													<i class="fa fa-trash"></i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
								@include('mutu.audit.vap.components.modal-create')
								@include('mutu.audit.vap.components.modal-edit')
							</div>

							<div class="col-12 text-center py-50">
								<h4 class="font-w400 mb-5">Belum ada Audit VAP</h4>
								<p>Klik tombol <b>Buat Audit VAP</b> untuk menambahkan Audit VAP baru</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection