@extends('kasus.layouts.main')

@section('title')
    {{ $form->nama_show }} - Form - {{ $kasus->judul_kasus }} - Kasus
@endsection

@section('content')
    <main id="main-container">
        @include('kasus.layouts.header')
        <div class="content" style="max-width: 1100px;">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <a href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/{{ $form->slug }}"
                        class="btn btn-secondary mb-5">Kembali ke Daftar Asesmen</a>
                    <div class="block block-bordered">
                        <div class="block-content">
                            @includeIf('kasus.asesmen.' . $slug . '.form-template')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- END Main Container -->
@endsection
