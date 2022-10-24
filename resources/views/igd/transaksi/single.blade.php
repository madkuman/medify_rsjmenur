@extends('igd.layouts.main')

@section('title')
Ruangan - IGD - Medify
@endsection

@section('subtitle')
Ruangan
@endsection

@section('content')


<main id="main-container">
	@include('igd.layouts.navbar')
	<div class="container">
		<div class="text-center">
			<h4 class="mb-5">Pendaftaran Pasien Selesai!</h4>
			<h5><small>Silahkan print dokumen dokumen dibawah ini</small></h5>
		</div>
		<div class="row justify-content-center row-deck">
			@if(!empty($transaksi->nomor_sep))
			<div class="col-4">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">SEP BPJS</h4>
						<div class="py-20">
							<img src="{{url('')}}/assets/img/bpjs-logo.png" height="100">
						</div>
						<button class="btn btn-primary" onclick="printSEP()">Print</button>
					</div>
				</div>
			</div>
			@endif

			<div class="col-4">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Gelang Pasien</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fa fa-ticket fa-4x"></i>
							</div>
						</div>
						<button class="btn btn-primary" onclick="printGelang()">Print</button>
					</div>
				</div>
			</div>
				<div class="col-lg-4 col-sm-12">
					<div class="block">
						<div class="block-content text-center">
							<h4 class="mb-0">Label Pasien</h4>
							<div class="py-20">
								<div class="py-20">
									<i class="fa fa-tag fa-4x"></i>
								</div>
							</div>
							<button class="btn btn-primary" onclick="printLabelPasien()">Print</button>
						</div>
					</div>
				</div>
		</div>
		<div class="text-center">
			<a href="{{url('pasien')}}" class="btn btn-success">Kembali ke Halaman Pasien</a>
		</div>
	</div>
</main>

@endsection

@section('js')
<script type="text/javascript">
	
	function printSEP(){

		var print_sep_url = BASE_URL + "bpjs/sep/{{$transaksi->nomor_sep}}/print";
		popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
	}

	function printGelang() {
		var print_sep_url = BASE_URL + "pasien/{{$transaksi->pasien_id}}/print/gelangdewasa";
		popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
	}

	function printLabelPasien(){

		var print_label_pasien_url = BASE_URL + "pasien/{{$transaksi->pasien_id}}/print/label";
		popupwindow(print_label_pasien_url, "Print Label Pasien", 600, 1200);
	}

</script>

@endsection