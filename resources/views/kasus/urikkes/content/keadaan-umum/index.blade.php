@extends('kasus.layouts.main')

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-4 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block rounded p-0">
                            @include('kasus.pemeriksaan-awal.components.navbar')
                            <div class="block-content tab-content overflow-hidden px-50 pb-30">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn-alt btn-primary min-width-125 float-right" data-toggle="modal" data-target="#modal-create-rencana-asuhan"><i class="fa fa-pencil"></i> Buat Pemeriksaan Umum</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <button type="button" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 float-right" onclick="diagnosisDeleteModal(457)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5 float-right" onclick="diagnosisDeleteModal(457)">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                        <h5 class="font-w600 mb-5">PEMERIKSAAN 1</h5>
                                        <h5 class="font-w400 mb-0"><small>Keadaan Umum</small></h5>
                                        <h5 class="mb-15 font-w400">Baik</h5>

                                        <h5 class="font-w400 mb-0"><small>Airways</small></h5>
                                        <h5 class="mb-15 font-w400">
                                            <ul>
                                                <li>Patent</li>
                                                <li>Stridor</li>
                                            </ul>
                                        </h5>

                                        <h5 class="font-w400 mb-0"><small>Breathing</small></h5>
                                        <h5 class="mb-15 font-w400">
                                            <ul>
                                                <li>Gerakan Dada : Simetris, Asimetris</li>
                                                <li>Jenis : Normal</li>
                                            </ul>
                                        </h5>

                                        <h5 class="font-w400 mb-0"><small>Circulation</small></h5>
                                        <h5 class="mb-15 font-w400">
                                            <ul>
                                                <li>Jaundice</li>
                                                <li>Kulit Pucat</li>
                                            </ul>
                                        </h5>

                                        <h5 class="font-w400 mb-0"><small>Disability</small></h5>
                                        <h5 class="mb-15 font-w400">
                                            <ul>
                                                <li>Eye : </li>
                                                <li>Verbal : </li>
                                                <li>Motorik : </li>
                                                <li>Total : </li>
                                            </ul>
                                        </h5>
                                        <h6>
                                            <small class="text-muted">Dibuat Oleh</small><br>
                                            Dr Kevin Fachreza, SpIT
                                            <span class="float-right font-w400"><i class="fa fa-clock-o text-muted"></i> 12 September 2018</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Updates -->
    </div>
</main>

@endsection

@section('js')
@endsection
