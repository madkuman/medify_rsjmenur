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
		<div class="row justify-content-center">
			<div class="col-xl-12 text-center py-20">
				<h3 class="mb-5">Pilih ruangan IGD</h3>
				<h5 class="text-muted font-w400">Pendaftaran Pasien ke IGD</h5>
			</div>
			@forelse($ruangan as $item)
			<div class="col-md-3">
				<a class="block block-link-pop text-center" href="javascript:void(0)" onclick="chooseRuangan({{$item->id}})">
					<div class="block-content block-content-full block-content-sm bg-danger">
					</div>

					<div class="block-content block-content-full">
						<div class="font-w600 mb-5 h1">{{$item->name}}</div>
					</div>
					<div class="block-content">
						<div class="row items-push text-center">
							<div class="col-12">
								<div class="mb-5 h3">
									{{$sisa=$item->kapasitas-$item->count}}
								</div>
								<div class="font-size-sm text-muted">Sisa Bed</div>
							</div>
						</div>
					</div>
				</a>

			</div>
			@empty
			Kosong
			@endforelse
		</div>
	</div>
</main>

<form method="POST" action="{{url('igd/transaksi/baru/konfirmasi')}}" id="formDaftar">
	{{csrf_field()}}
	<input type="hidden" value="{{$pasien_id}}" name="pasien_id">
	<input type="hidden" value="{{$kasus_id}}" name="kasus_id">
	<input type="hidden" id="ruangan_id" name="ruangan_id">
</form>


@endsection

@section('js')
<script type="text/javascript">
	function chooseRuangan(id)
	{
		$('#ruangan_id').val(id);
		$('#formDaftar').submit();
	}

</script>

@endsection