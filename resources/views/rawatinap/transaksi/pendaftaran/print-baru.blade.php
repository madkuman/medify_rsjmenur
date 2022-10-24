@extends('rawatinap.layouts.main')

@section('title')
Transaksi - Rawat Rawat Inap
@endsection

@section('sidebarcomponent')
@include('rawatinap.components.sidebar')
@endsection

@section('subtitle')
Transaksi
@endsection

@section('css')
@endsection

@section('content')


<main id="main-container">
	@include('rawatinap.layouts.navbar')
	<div class="container">
		<div class="text-center">
			<h4 class="mb-5">Pendaftaran Pasien Selesai!</h4>
			<h5><small>Silahkan print dokumen dokumen dibawah ini</small></h5>
		</div>
		<div class="row justify-content-center row-deck">
			@if(!empty($transaksi->kasus->active_sep->no_sep))
			<div class="col-lg-4 col-12">
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
			<div class="col-lg-4 col-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Boarding Pass</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fas fa-ticket fa-4x"></i>
							</div>
						</div>
						<button class="btn btn-primary" onclick="printBoardingPass()">Print</button>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Surat Opname</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fas fa-user-tag fa-4x"></i>
							</div>
						</div>
						<button class="btn btn-primary" onclick="konfirmasiPrint(1)">Print</button>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Gelang Pasien</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fa fa-circle-o-notch fa-4x"></i>
							</div>
						</div>
						<button class="btn btn-primary" onclick="printGelang()">Print</button>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Menuju ke Bangsal {{$transaksi->tempat_tidur->ruangan->bangsal->nama}}</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fas fa-bed fa-4x"></i>
							</div>
						</div>
						<a href="{{url('rawatinap/bangsal')}}/{{$transaksi->tempat_tidur->ruangan->bangsal->id}}" class="btn btn-primary">Menuju ke Halaman {{$transaksi->tempat_tidur->ruangan->bangsal->nama}}</a>
					</div>
				</div>
			</div>
		</div>
		<div class="text-center mb-20">
			<a href="{{url('rawatinap')}}" class="btn btn-success">Kembali ke Rawat Inap</a>
		</div>
	</div>
</main>
@endsection

@section('js')
<script type="text/javascript">
	function printSEP(){

		var print_sep_url = BASE_URL + "bpjs/sep/{{$transaksi->kasus->active_sep->no_sep ?? ''}}/print";
		popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
	}

	function printBoardingPass(){

		var print_boarding_pass_url = BASE_URL + "rawatinap/boarding-pass/print/{{$transaksi->id}}";
		popupwindow(print_boarding_pass_url, "Print Boarding Pass Pasien", 400, 1200);
	}

	function konfirmasiPrint(index) {
		var url = "{{url('rawatinap/transaksi/pendaftaran/konfirmasi/print?transaksi_id=')}}{{$transaksi->id}}&bed_id={{$bed->id}}"
		popupwindow(url,'Konfirmasi Print',620,1000);

	}

	function printGelang(){
		popupwindow("{{url('')}}/pasien/{{$transaksi->pasien_id}}/print/gelangdewasa", '', 600, 800);
	}

</script>
@endsection