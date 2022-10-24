@extends('mutu.layouts.main')

@section('title')
Mutu - Laporan - Medify
@endsection

@section('subtitle')
<span class="text-muted font-w400">Laporan</span> / Audit
@endsection

@section('content')
<main id="main-container">
	@include('mutu.layouts.navbar')
	<div class="container">
		<div class="row">
			<div class="col-12 text-center py-20">
				<h3>Laporan Audit</h3>
			</div>
			<div class="col-12 my-20 px-30">
				<input type="text" class="form-control fuzzy-search-laporan" placeholder="Cari Laporan">
			</div>
		</div>
		<div id="laporan-list">
			<ul class="list row">
				@php
				$custom_field = '<div class="form-group row">
									<label class="col-12">Pilih Bagian</label>
									<div class="col-12 col-md-8">
										<select name="penanggung_jawab" class="form-control js-select2" style="width: 100%">';

				foreach ($penanggung_jawab as $item) {
					$custom_field .= '<option value="'.$item.'">'.$item.'</option>';
				}
				$custom_field .= '</select>
								</div>
								</div>';
				@endphp
                @include('mutu.layouts.components.card-and-modal',[
					'title' => 'Idenfitikasi Resiko',
					'subtitle' => 'Idenfitikasi Resiko',
					'modal_target' => 'modal_identifikasi_resiko',
					'form_url' => 'identifikasi-resiko',
					'form_fields' => ['date_range'],
					'form_field_custom' => $custom_field
				])

				
				@php
				$custom_field_kegiatan = '<div class="form-group row">
									<label class="col-12">Pilih Bagian</label>
									<div class="col-12 col-md-8">
										<select name="penanggung_jawab" class="form-control js-select2" style="width: 100%">';

				foreach ($penanggung_jawab_kegiatan as $item) {
					$custom_field_kegiatan .= '<option value="'.$item.'">'.$item.'</option>';
				}
				$custom_field_kegiatan .= '</select>
								</div>
								</div>';
				@endphp
                @include('mutu.layouts.components.card-and-modal',[
					'title' => 'Kegiatan Pengendalian',
					'subtitle' => 'Kegiatan Pengendalian',
					'modal_target' => 'modal_kegiatan_pengendalian',
					'form_url' => 'kegiatan-pengendalian',
					'form_fields' => ['date_range'],
					'form_field_custom' => $custom_field
				])

				@include('mutu.layouts.components.card-and-modal',[
					'title' => 'Evaluasi Kegiatan Pengendalian',
					'subtitle' => 'Evaluasi Kegiatan Pengendalian',
					'modal_target' => 'modal_evaluasi_kegiatan_pengendalian',
					'form_url' => 'evaluasi-kegiatan-pengendalian',
					'form_fields' => ['date_range']
				])
			</ul>
		</div>
	</div>
</main>
@endsection

@section('js')
<script type="text/javascript" src="{{url('assets/js/plugins/listjs/list.min.js')}}"></script>
<script type="text/javascript">
	$(document).on('click', '.submit-button', function(){
		$(this).parent().parent().unbind('submit').submit();
	})
    var options = {
        valueNames: [ 'title', 'desc' ]
    };
    var laporanList = new List('laporan-list', options);
    $(".fuzzy-search-laporan").keyup(function(){
        laporanList.search($(this).val());
    });
</script>
@endsection