@extends('kasus.layouts.main')

@section('title')
    {{ $kasus->judul_kasus }} - Psikologi - Kasus
@endsection

@section('content')
    <main id="main-container">
        @include('kasus.layouts.header')

        <div class="content">
            <div class="row">
                @include('kasus.layouts.sidebar')
                <div class="col-lg-9 col-xl-9">
                    <div class="block">
                        <ul class="nav nav-tabs nav-tabs-block nav-justified nav-primary" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  @if (session('active_nav') != 'galeri') active @endif" href="#asesmen"
                                    id="nav-asesmen">Asesmen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (session('active_nav') == 'galeri') active @endif" href="#galeri"
                                    id="nav-galeri">Galeri</a>
                            </li>

                        </ul>
                        <div class="block-content tab-content overflow-hidden">
                            <div class="tab-pane fade fade-left @if (session('active_nav') != 'galeri') show active @endif"
                                id="asesmen" role="tabpanel">
                                <div class="block-content">
                                    <ul class="list row row-deck">
                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/alat-bantu/surat-sehat-rohani">
                                                <div class="block-header">
                                                    <h3 class="block-title">Surat Sehat Rohani</h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Surat Sehat Rohani</h5>
                                                    <p class="desc">Surat Sehat Rohani</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/psikologi/visum">
                                                <div class="block-header">
                                                    <h3 class="block-title">Visum</h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Visum</h5>
                                                    <p class="desc">Visum</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/psikologi/pemeriksaan-psikologi-dewasa">
                                                <div class="block-header">
                                                    <h3 class="block-title">Pemeriksaan Psikologi Dewasa (IQ dan Minat
                                                        Bakat)</h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Pemeriksaan Psikologi Dewasa</h5>
                                                    <p class="desc">Pemeriksaan Psikologi Dewasa</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/psikologi/pemeriksaan-psikologi-anak">
                                                <div class="block-header">
                                                    <h3 class="block-title">Pemeriksaan Psikologi Anak</h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Pemeriksaan Psikologi Anak</h5>
                                                    <p class="desc">Pemeriksaan Psikologi Anak</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/psikologi/laporan-pemeriksaan-psikologi">
                                                <div class="block-header">
                                                    <h3 class="block-title">Laporan Pemeriksaan Psikologi</h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Laporan Hasil Pemeriksaan Psikologi</h5>
                                                    <p class="desc">Laporan Evaluasi Psikologi (Deskripsi dan Psikogram)
                                                        Dewasa</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/psikologi/laporan-hasil-pemeriksaan-psikologi-rekruitmen">
                                                <div class="block-header">
                                                    <h3 class="block-title">Laporan Hasil Pemeriksaan Psikologi Rekruitmen
                                                    </h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Laporan Hasil Pemeriksaan Psikologi Rekruitmen
                                                    </h5>
                                                    <p class="desc">Laporan Hasil Pemeriksaan Psikologi Rekruitmen</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="col-md-4 text-center">
                                            <a class="block block-link-pop block-themed"
                                                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/psikologi/self-reporting-questionnaire">
                                                <div class="block-header">
                                                    <h3 class="block-title">Self Reporting Questionnaire
                                                    </h3>
                                                </div>
                                                <div class="block-content">
                                                    <p class="mt-5 mb-10">
                                                        <i class="fa fa-calculator fa-4x "></i>
                                                    </p>
                                                    <h5 class="mb-5 title">Self Reporting Questionnaire
                                                    </h5>
                                                    <p class="desc">Self Reporting Questionnaire</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade fade-left @if (session('active_nav') == 'galeri') show active @endif"
                                id="galeri" role="tabpanel">
                                @include('kasus.psikologi.galery.index')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('kasus.psikologi.galery.modal')
@endsection

@section('js')
    <script type="text/javascript">
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('.btn-delete-galeri-item').click(function() {
            var title = $(this).data('title')
            var id = $(this).data('id')
            swal({
                title: 'Apakah Anda Yakin?',
                text: "File " + title + " akan terhapus dari sistem",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-secondary',
                cancelButtonClass: 'btn btn-primary',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.value) {
                    $('#formDeleteGaleriItem .input-id').val(id)
                    $('#formDeleteGaleriItem').submit();
                }
            })
        })
    </script>
@endsection
