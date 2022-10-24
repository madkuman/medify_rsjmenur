@extends('layouts.main2')

@section('title')
Manajemen Paket - CSSD - Medify
@endsection

@section('css')
	<style>
	.title-hasil {
		font-size: 11pt;
		font-weight: bold;
	}

	.btn_delete {
		position: absolute;
		bottom: 5px;
	}

	.nav {
		width: 100%;
		right: 0;
		margin: 0;
	}

	.nav-link {
		color: white;
	}

	.nav-tabs-block .nav-link.active {
		background-color: #389CF5;
		color: white;
	}

	.nav-item {
		padding: 0;
		background-color: #3078f4;
	}

	.itemform {
		margin-bottom: 15px;
	}

	.select2_paket {
		margin-bottom: 15px;
	}

	.plus_button {
		margin-bottom: 15px;
	}
</style>
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
					<div class="block-header">
						<h3 class="block-title">{{ ucwords($paket->nama) }}</h3>
						<button class="btn btn-outline-success mr-5" onclick="popupwindow('{{url("cssd/pengaturan/paket/".$paket->id."/print/label")}}','Print Label Paket','500','500')"><i class="fa fa-print"></i> Print Semua Label</button>
						<a href="{{url('cssd/pengaturan/paket/edit/'.$paket->id)}}" class="btn btn-secondary" style="margin-left: 10px;"><i class="fa fa-edit"></i> Edit Paket</a>
						<hr>
					</div>
					<div class="block-content">
						<div class="row">
							<div class="col-6">
								<p><b>INFORMASI PAKET</b></p>

								<table class="table table-borderless">
									<tr>
										<th>Tipe Paket</th>
										<td>: {{ ucwords($paket->tipe) }}</td>
									</tr>
									<tr>
										<th>Nama Paket</th>
										<td>: {{ $paket->nama }}</td>
									</tr>
									<tr>
										<th>Kode Paket</th>
										<td>: {{ $paket->slug }}</td>
									</tr>
								</table>
							</div>
						</div>
						<hr>

						<div class="row">
							<div class="col-6">
								<p><b>DAFTAR BARANG</b></p>

								<table class="table table-sm table-striped table-hover">
									<thead>
										<tr>
											<th>NO</th>
											<th>NAMA</th>
											<th>SATUAN</th>
											<th>JUMLAH</th>
										</tr>
									</thead>
									@php
									$no = 1;
									@endphp
									@foreach ($items as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $item->getItem->nama }}</td>
										<td>{{ $item->getItem->satuan ? $item->getItem->satuan : '-' }}</td>
										<td>{{ $item->jumlah }}</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@section('js')
<script>
	$("#manajemen_paket").addClass('active');
</script>

<script>
	$(document).ready(function(){
      // window.prev_tipe = '{{ $paket->tipe }}';
  	});
</script>
@endsection