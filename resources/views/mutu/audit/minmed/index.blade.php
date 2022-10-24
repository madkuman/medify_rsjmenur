@extends('mutu.layouts.main')

@section('title')
Minmed - Audit - Medify
@endsection

@section('subtitle')
Audit (Ketidaklengkapan Informed Concent)
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
								<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-minmed"><i class="fa fa-pencil"></i>Buat Audit Minmed</button>
							</div>
							<div class="col-12 autoscroll-x" style="height: 400px;overflow-y: scroll;">
								<table class="table table-bordered table-vcenter js-dataTable-full dataTable no-footer">
									<thead>
										<tr>
											<th style="width: 100px" rowspan="2">No</th>
											<th style="width: 100px" rowspan="2">No RM</th>
											<th style="width: 100px" rowspan="2">Nama Pasien</th>
											<th style="width: 100px" rowspan="2">Kasus</th>
											<th style="width: 100px" rowspan="2">Formulir</th>
											<th style="width: 100px; text-align: center;" colspan="4">Ceklis Informed Concent</th>
										</tr>
										<tr>
											<th style="width: 25px;  border-top: 1px solid gainsboro">Identitas</th>
											<th style="width: 25px;  border-top: 1px solid gainsboro">Pemberian Informasi</th>
											<th style="width: 25px;  border-top: 1px solid gainsboro">Persetujuan Tindakan Medis</th>
											<th style="width: 25px;  border-top: 1px solid gainsboro">TTD</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>123456</td>
											<td>Kevin Fachreza</td>
											<td>Ambeien Pantat Kanan</td>
											<td>Pernyataan Persetujuan Operasi / Tindakan Medis/ Tindakan Diagnostik</td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
										</tr>
									</tbody>
								</table>
								@include('mutu.audit.minmed.components.modal-create')
								@include('mutu.audit.minmed.components.modal-edit')
							</div>

							<div class="col-12 text-center py-50">
								<h4 class="font-w400 mb-5">Belum ada Audit Minmed</h4>
								<p>Klik tombol <b>Buat Audit Minmed</b> untuk menambahkan Audit Minmed baru</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection