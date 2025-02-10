@extends((request()->has('layouts') ? request()->layouts : 'kasus').'.layouts.main')

@section("title")
{{$kasus->judul_kasus ?? ''}} - General Consent Treatment - Kasus
@endsection


@section("content")

<main id="main-container">
	@if (!is_null($nomor_kasus))
	@include("kasus.layouts.header")
	@endif
    <div class="content" style="max-width: 1100px;">
		@if (!is_null($nomor_kasus))
		<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/general-consent-treatment" class="btn btn-secondary mb-3">Kembali ke General Consent For Treatment</a>
		@else
		<a href="{{ url('pasien') }}/{{$pasien->id}}" class="btn btn-secondary mb-3">Kembali ke Pasien</a>
		@endif
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="block block-bordered">
                    <div class="block-content">
						@if ($action == 'create' && !is_null($nomor_kasus))
                        <form id="form-post" method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/general-consent-treatment/form/create">
						{{csrf_field()}}
						@elseif ($action == 'create' && is_null($nomor_kasus))
                        <form id="form-post" method="POST" action="{{ url('pasien') }}/asesmen/general-consent-treatment/form/create">
						{{csrf_field()}}
						@elseif ($action == 'edit' && !is_null($nomor_kasus))
						<form id="form-post" method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/general-consent-treatment/form/edit?id={{ $general_consent_id }}">
						{{ method_field('PUT') }}
						{{csrf_field()}}
						@elseif ($action == 'edit' && is_null($nomor_kasus))
						<form id="form-post" method="POST" action="{{ url('pasien') }}/asesmen/general-consent-treatment/form/edit?id={{ $general_consent_id }}">
						{{ method_field('PUT') }}
						{{csrf_field()}}
						@endif
                            <h4 class="mb-0">{{$form->nama_show}}</h4>
                            <hr>
							<div class="medify-form-container">
								@includeIf('kasus.asesmen.general-consent-treatment.form-template')
							</div>
						@if ($action == 'create' || $action == 'edit')
                        	<br>
                            <button id="btn-submit" class="btn btn-primary">@if ($action == 'create') Simpan @else Perbaharui @endif</button>
                        </form>
						@else
						@endif
                    </div>
                </div>
            </div>
        </div>
	</div>
</main>
@endsection