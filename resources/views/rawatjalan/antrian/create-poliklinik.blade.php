@extends('rawatjalan.layouts.main')

@section('title')
Poliklinik - Rawat Jalan - Medify
@endsection

@section('sidebarcomponent')
@include('rawatjalan.components.sidebar')
@endsection

@section('subtitle')
Daftar Poliklinik
@endsection

@section('content')


<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-xl-12 py-20">
				<h3 class="mb-5">Pendaftaran Pasien ke Pelayanan</h3>
				<h5 class="text-muted font-w400">Anda akan mendaftarkan pasien ke salah satu pelayanan di rumah sakit</h5>
			</div>
			@foreach($poli as $item)
			<div class="col-md-3">
				<a class="block block-link-pop text-center" href="javascript:void()" onclick="choosePoliklinik({{$item->id}})">
					<div class="block-content block-content-full block-content-sm bg-primary">
					</div>

					<div class="block-content block-content-full">
						<img class="" src="{{asset($item->image_thumb)}}" alt="" height="100">
					</div>
					<div class="block-content block-content-full block-content-sm bg-body-light">
						<div class="font-w600 mb-5 h3">{{$item->name}}</div>
					</div>
					<div class="block-content">
						<div class="row items-push text-center">
							<div class="col-6">
								<div class="mb-5 h3">
									@if(!empty($item->transaksi))
									{{$item->transaksi[0]->nomor_antrian}}
									@else 
									0
									@endif
								</div>
								<div class="font-size-sm text-muted">Nomor Sekarang</div>
							</div>
							<div class="col-6">
								<div class="mb-5 h3">
									@if(!empty($item->last_antrian))
									{{$item->last_antrian[0]->nomor_antrian}}
									@else 
									0 
									@endif
								</div>
								<div class="font-size-sm text-muted">Total Antrian</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</main>

<form method="POST" action="{{url('rawatjalan/poliklinik/antrian/baru/konfirmasi')}}" id="formDaftar">
	{{csrf_field()}}
	<input type="hidden" value="{{$pasien_id}}" name="pasien_id">
	<input type="hidden" value="{{$kasus_id}}" name="kasus_id">
	<input type="hidden" value="{{$rujuk}}" name="rujuk">
	<input type="hidden" value="" id="formPoliklinik" name="poliklinik_id">
</form>


@endsection


@section('js')
<script type="text/javascript">
	function choosePoliklinik(id)
	{
		$('#formPoliklinik').val(id);
		$('#formDaftar').submit();
	}

</script>


@endsection