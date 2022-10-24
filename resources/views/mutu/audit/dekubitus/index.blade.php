@extends('mutu.layouts.main')

@section('title')
Mutu - Audit - Medify
@endsection

@section('subtitle')
Audit (Dekubitus)
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
								<button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-dekubitus"><i class="fa fa-pencil"></i>Buat Audit Dekubitus</button>
							</div>
							<div class="col-12 autoscroll-x" style="height: 400px;overflow-y: scroll;">
								<table class="table table-bordered table-vcenter">
									<thead>
										<tr>
											<th rowspan="2" style="width: 25px">#</th>
											<th class="text-center" colspan="4" style="border-bottom: 1px solid gainsboro;">Derajat I</th>
											<th class="text-center" colspan="3" style="border-bottom: 1px solid gainsboro;">Derajat II</th>
											<th class="text-center" colspan="2" style="border-bottom: 1px solid gainsboro;">Derajat III</th>
											<th class="text-center" colspan="2" style="border-bottom: 1px solid gainsboro;">Derajat IV</th>
										</tr>
										<tr>
											<th style="width: 100px">Temperatur Kulit (Lebih Dingin/Hangat)</th>
											<th style="width: 100px">Konsistensi Jaringan (Lebih Keras/Lunak)</th>
											<th style="width: 100px">Gatal</th>
											<th style="width: 100px">Nyeri</th>
											<th style="width: 100px">Abrasi</th>
											<th style="width: 100px">Melepuh</th>
											<th style="width: 100px">Lubang yang dangkal</th>
											<th style="width: 100px">Necrosis Jaringan Subkutan</th>
											<th style="width: 100px">Lubang yang dalam</th>
											<th style="width: 100px">Necrosis Luas</th>
											<th style="width: 100px">Kerusakan Otot Tulang Tendon</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
											<td class="text-center"><i class="fa fa-check"></i></td>
										</tr>
									</tbody>
								</table>
								@include('mutu.audit.dekubitus.components.modal-create')
								@include('mutu.audit.dekubitus.components.modal-edit')
							</div>

							<div class="col-12 text-center py-50">
								<h4 class="font-w400 mb-5">Belum ada Audit Dekubitus</h4>
								<p>Klik tombol <b>Buat Audit Dekubitus</b> untuk menambahkan Audit Dekubitus baru</p>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection