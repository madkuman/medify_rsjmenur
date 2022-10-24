@extends('igd.layouts.main')

@section('title')
Konfirmasi - IGD - Medify
@endsection

@section('subtitle')
Konfirmasi
@endsection

@section('content')

<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-center py-20">
				<h3 class="mb-5">Konfirmasi Pendaftaran IGD</h3>
				<h5 class="text-muted font-w400">Pendaftaran Pasien ke IGD</h5>
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
							<li><i class="fa fa-address-card mr-5" data-toggle="tooltip" data-placement="top" title="Nomor Rekam Medis">
								
							</i> {{$pasien->no_rm}}</li>
							<li><i class="fa fa-map-pin mr-10" data-toggle="tooltip" data-placement="top" title="Alamat"></i> {{$pasien->address}}</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="block block-link-pop text-center" href="javascript:void()">
					<div class="block-content block-content-full block-content-sm bg-primary text-white font-w600">
						Ruangan
					</div>

					<div class="block-content block-content-full block-content-sm ">
						<div class="font-w600 mb-5 h1 mt-20 mb-50">{{$ruangan->name}}</div>
					</div>
					<div class="block-content">
						<div class="row items-push text-center">
							<div class="col-12">
								Kapasitas bed tersedia
								<h2>
									@if(!empty($ruangan->kapasitas))
									{{$ruangan->kapasitas-$ruangan->count}}
									@else 
									0
									@endif
								</h2>
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
    		<form method="POST" action="{{url('igd/transaksi/baru/submit')}}">
			{{csrf_field()}}
			<input type="hidden" value="{{$ruangan->id}}" name="ruangan_id">
			<input type="hidden" value="{{$pasien->id}}" name="pasien_id">
			<input type="hidden" value="{{$kasus_id}}" name="kasus_id">
			<button type="button" class="btn btn-outline-danger btn-fill btn-hero" id="batal-antri">
				<i class="fa fa-trash-o" aria-hidden="true"></i> Batal
			</button>
			<button class="btn btn-primary btn-hero" type="submit">Konfirmasi</button>
		</form>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
	$('document').ready(function() {
		$('#batal-antri').on('click', function() {

			swal({
				title: "Apa anda yakin ?",
				text: "Anda akan mengisi ulang data pasien dan ruangan IGD",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: 'btn btn-primary',
				cancelButtonClass: 'btn btn-default',
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					window.location = "{{url('/igd/transaksi/baru')}}";
				}
			})


		})
	});
</script>
@endsection
