@extends('rawatjalan.layouts.main')

@section('title')
Pendaftaran Pasien ke Poliklinik - Rawat Jalan - Medify
@endsection

@section('sidebarcomponent')
@include('rawatjalan.components.sidebar')
@endsection

@section('subtitle')
Pendaftaran Pasien ke Poliklinik
@endsection

@section('content')

<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-center py-20">
				<h3 class="mb-5">Konfirmasi Pendaftaran Poli</h3>
				<h5 class="text-muted font-w400">Pendaftaran Pasien ke Poliklinik</h5>
			</div>
		</div>
		<div class="row row-deck justify-content-center">
			<div class="col-md-3">
				<div class="block text-center" href="javascript:void(0)">
					<div class="block-content block-content-full block-content-sm bg-pulse">
						<span class="font-w600 text-white">Pasien</span>
					</div>
					<div class="block-content block-content-full bg-pulse-lighter">
						<img class="img-avatar img-avatar-thumb" src="{{asset($pasien->photo_thumb)}}" alt="">
					</div>
					<div class="block-content">
						<h4 class="mb-5">{{$pasien->name}}</h4>
						<h6 class="font-w400">
							@if($pasien->gender == 1) Laki laki
                                	@else Perempuan
                                	@endif, {{$pasien->age}}
                              </h6>
						<ul class="list-unstyled text-left">
							<li><i class="fa fa-address-card mr-5" data-toggle="tooltip" data-placement="top" title="Nomor Rekam Medis"></i> {{$pasien->no_rm}}</li>
							<li><i class="fa fa-map-pin mr-10" data-toggle="tooltip" data-placement="top" title="Alamat"></i> {{$pasien->address}}</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="block block-link-pop text-center" href="javascript:void()">
					<div class="block-content block-content-full block-content-sm bg-primary text-white font-w600">
						Poliklinik
					</div>

					<div class="block-content block-content-full">
						<img class="" src="{{asset($poli->image_thumb)}}" alt="" height="100">
					</div>
					<div class="block-content block-content-full block-content-sm bg-body-light">
						<div class="font-w600 mb-5 h3">{{$poli->name}}</div>
					</div>
					<div class="block-content">
						<div class="row items-push text-center">
							<div class="col-6">
								<div class="mb-5 h3">
									@if(!empty($poli->transaksi))
									{{$poli->transaksi[0]->nomor_antrian}}
									@else 
									0
									@endif
								</div>
								<div class="font-size-sm text-muted">Nomor Sekarang</div>
							</div>
							<div class="col-6">
								<div class="mb-5 h3">
									@if(!empty($poli->last_antrian))
									{{$poli->last_antrian[0]->nomor_antrian}}
									@else 
									0 
									@endif
								</div>
								<div class="font-size-sm text-muted">Nomor Terakhir</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>


<div class="row mb-100">
	<div class="col-md-12 text-center">
		<form method="POST" action="{{url('rawatjalan/poliklinik/antrian/baru/submit')}}">
			{{csrf_field()}}
			<input type="hidden" value="{{$poli->id}}" name="poliklinik_id">
			<input type="hidden" value="{{$pasien->id}}" name="pasien_id">
			<input type="hidden" value="{{$kasus_id}}" name="kasus_id">
			<input type="hidden" value="{{$rujuk}}" name="rujuk">
			<button type="button" class="btn btn-outline-danger btn-fill btn-hero" id="batal-antri">
				<i class="fa fa-trash-o" aria-hidden="true"></i> Batal
			</button>
			<button class="btn btn-primary btn-hero" type="submit">Antri</button>
		</form>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
	$('document').ready(function() {
		$('#batal-antri').on('click', function() {
			var deleteSupp = $(this).parent().find('form');
			swal({
				title: "Apa anda yakin ?",
				text: "Antrian anda tidak akan didaftarkan pada poli.",
				type: "warning",
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-default',
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
				closeOnConfirm: false,
				closeOnCancel: false,
				allowOutsideClick: false
			}, function(isConfirm) {
				if (isConfirm) {
					window.location = "{{url('/rawatjalan/poliklinik/antrian/baru')}}";
					swal("Konfirmasi Dibatalkan", "Antrian tidak dikonfirmasi. Anda belum terdaftar pada antrian poli.", "error");
				} else {
					swal("Konfirmasi Ulang", "Lakukan konfirmasi pada antrian.", "error");
				}
			});
		})
	});
</script>
@endsection
