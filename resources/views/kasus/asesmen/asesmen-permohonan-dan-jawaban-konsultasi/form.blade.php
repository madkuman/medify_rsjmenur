@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - Asesmen Permohonan dan Jawaban Konsultasi - Kasus
@endsection


@section("content")

<main id="main-container">
	@include("kasus.layouts.header")
    <div class="content" style="max-width: 1100px;">
		<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi" class="btn btn-secondary mb-3">Kembali ke Asesmen Permohonan dan Jawaban Konsultasi</a>
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="block block-bordered">
                    <div class="block-content">
						@if ($action == 'create')
                        <form id="form-post" method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/create">
						{{csrf_field()}}
						@elseif ($action == 'edit')
						<form id="form-post" method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/{{ $asesmen_permohonan_dan_jawaban_konsultasi_id }}/edit">
						{{ method_field('PUT') }}
						{{csrf_field()}}
						@else
						@endif
                            <h4 class="mb-0">{{$form->nama_show}}</h4>
                            <hr>
							<div class="medify-form-container">
								@includeIf('kasus.asesmen.asesmen-permohonan-dan-jawaban-konsultasi.form-template')
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
</main>
@endsection