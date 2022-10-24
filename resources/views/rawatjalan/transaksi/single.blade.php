@extends('rawatjalan.layouts.main')

@section('title')
Transaksi - Rawat Jalan
@endsection

@section('sidebarcomponent')
@include('rawatjalan.components.sidebar')
@endsection

@section('subtitle')
Transaksi
@endsection

@section('css')
@endsection

@section('content')


<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="text-center">
			<h4 class="mb-5">Pendaftaran Pasien Selesai!</h4>
			<h5><small>Silahkan print dokumen dokumen dibawah ini</small></h5>
		</div>
		<div class="row justify-content-center row-deck">
			@if(!empty($transaksi->nomor_sep))
			<div class="col-lg-4 col-sm-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">SEP BPJS</h4>
						<div class="py-20">
							<img src="{{url('')}}/assets/img/bpjs-logo.png" height="100">
						</div>
						<button class="btn btn-primary" onclick="printSEP()">Print</button>
						<!-- <small class="text-danger">Print SEP selain dari modul BPJS tidak diperbolehkan</small>
						<button class="btn btn-primary" disabled="">Print</button> -->
					</div>
				</div>
			</div>
			@endif
			<div class="col-lg-4 col-sm-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Nomor Antrian Pasien</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fa fa-ticket fa-4x"></i>
							</div>
						</div>
						<button class="btn btn-primary" onclick="printAntrian()">Print</button>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Boarding Pass</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fas fa-user-tag fa-4x"></i>
							</div>
						</div>
						<button class="btn btn-primary" onclick="printBoardingPass()">Print</button>
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
			@if(!empty($transaksi->nomor_sep))
			<div class="col-lg-4 col-sm-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Edit SEP BPJS</h4>
						<div class="py-20">
							<img src="{{url('')}}/assets/img/bpjs-logo.png" height="100">
						</div>
						<a class="btn btn btn-secondary" href="{{url('rawatjalan/transaksi')}}/sep-edit/{{$transaksi->id}}">Edit SEP BPJS</a>
					</div>
				</div>
			</div>
			@endif
			<div class="col-lg-4 col-sm-12">
				<div class="block">
					<div class="block-content text-center">
						<h4 class="mb-0">Batalkan Transaksi</h4>
						<div class="py-20">
							<div class="py-20">
								<i class="fas fa-times fa-4x"></i>
							</div>
						</div>
						@if($transaksi->status == -1)
						<h6 class="mb-0">
							<span class="text-danger">TRANSAKSI TELAH DIBATALKAN</span><br><br>
							Waktu : {{$transaksi->cancel_at->format('d F y, H:i')}}<br>
							Oleh : {{$transaksi->cancel_user->name}}<br>
							Keterangan : {{$transaksi->cancel_keterangan}}
						</h6>
						@else
						<button class="btn btn btn-danger" onclick="confirmSwalBatalkan({{$transaksi->id}})">Batalkan</button>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="text-center mb-20">
			<a href="{{url('pasien')}}" class="btn btn-success">Kembali ke Halaman Pasien</a>
		</div>
	</div>
</main>

<form method="POST" action="{{url('rawatjalan/transaksi')}}/cancel" id="formBatal">
    {{csrf_field()}}
    <input type="hidden" id="cancel_id" name="id">
    <input type="hidden" id="cancel_keterangan" name="keterangan">
    <input type="hidden" id="poli_id" name="poli_id" value="{{$transaksi->poli_id}}">
    <input type="hidden" id="url" name="url" value="rawatjalan-all">
</form>
@endsection

@section('js')
<script type="text/javascript">
	function printSEP(){

		var print_sep_url = BASE_URL + "bpjs/sep/{{$transaksi->nomor_sep}}/print";
		popupwindow(print_sep_url, "Print SEP Pasien", 600, 900);
	}

	function printAntrian(){

		var print_karcis_url = BASE_URL + "rawatjalan/antrian/print/{{$transaksi->id}}";
		popupwindow(print_karcis_url, "Print Nomor Antrian Pasien", 600, 500);
	}

	function printBoardingPass(){

		var print_boarding_pass_url = BASE_URL + "rawatjalan/boarding-pass/print/{{$transaksi->id}}";
		popupwindow(print_boarding_pass_url, "Print Boarding Pass Pasien", 400, 1200);
	}

	function printLabelPasien(){

		var print_label_pasien_url = BASE_URL + "pasien/{{$transaksi->pasien_id}}/print/label";
		popupwindow(print_label_pasien_url, "Print Label Pasien", 600, 1200);
	}


	function confirmSwalBatalkan(id)
	{
		swal({
			title: 'Apa anda yakin?',
			input: 'text',
			text: "Mengapa anda membatalkan transaksi ini?",
			type: 'warning',
			confirmButtonClass: 'btn btn-primary',
			cancelButtonClass: 'btn btn-outline-danger',
			showCancelButton: true,
			confirmButtonText: 'Tolak Transaksi',
			cancelButtonText: 'Batal',
			inputValidator: (value) => {
				return !value && 'Masukan Alasan Pembatalan!'
			}
		}).then((result) => {
			if (result.value) {
				$('#cancel_keterangan').val(result.value)            
				$('#cancel_id').val(id)
				$('#formBatal').submit()
			}
		})
	}


</script>
@endsection