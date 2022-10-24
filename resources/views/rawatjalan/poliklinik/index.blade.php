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

@section('css')
@include('rawatjalan..poliklinik.components.css-index')
@endsection

@section('content')
<main id="main-container">
	@include('rawatjalan.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="form-group row">
					<div class="col-8">
						<select name="poli" class="form-control block-header bg-primary js-select2" data-size="5" id="selectPoli" style="width: 100%;">
							@foreach($all_poli as $item)
							<option value="{{$item->id}}" @if($poli_id == $item->id) selected @endif>{{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-4">
						@if (isset($dokter_id))
						<select name="dokter" class="form-control block-header bg-primary js-select2" data-size="5" id="selectDokter" style="width: 100%;">
							<option value="0" selected>Semua Dokter</option>
							@foreach ($dokter as $item)
							<option value="{{$item->id}}" {{$item->id == $dokter_id ? 'selected' : ''}}>{{$item->name}}</option>
							@endforeach
						</select>	
						@else
						<select name="dokter" class="form-control block-header bg-primary js-select2" data-size="5" id="selectDokter" style="width: 100%;">
							<option value=""></option>
						</select>
						@endif
					</div>
				</div>
				@include('rawatjalan.antrian.component-antrian')
			</div>
		</div>
	</div>
	{{--
		Button next antrian akan muncul jika:
		- list antrian ada
		- settingan di master tv sudah ada untuk poli / ruangan tersebut
		- hanya untuk dokter yang telah di select
	 --}}
	@if (count($antrians) > 0 && count($master_tv) > 0 && $dokter_id > 0)
		<a href="javascript:void(0)" class="float button-call-antrian-next" data-type="info" data-icon="fa fa-bullhorn" data-message="Pasien telah dipanggil">
			<i class="fa fa-bullhorn fa-2x my-float"></i>
		</a>
	@endif
</main>

<form method="POST" action="{{url('rawatjalan/transaksi')}}/cancel" id="formBatal">
    {{csrf_field()}}
    <input type="hidden" id="cancel_id" name="id">
    <input type="hidden" id="cancel_keterangan" name="keterangan">
    <input type="hidden" id="poli_id" name="poli_id" value="{{$poli_id}}">
    <input type="hidden" id="url" name="url" value="rawatjalan-all">
</form>
@endsection

@section('js')
@include('rawatjalan.poliklinik.components.js-index')
@endsection