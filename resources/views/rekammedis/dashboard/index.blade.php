@extends('rekammedis.layouts.main')

@section('title')
Rekam Medis - Medify
@endsection


@section('subtitle')
Dashboard
@endsection

@section('content')
<main id="main-container">
    @include('rekammedis.layouts.navbar')
    <div class="container">
        <div class="row row-deck">
            <div class="col-sm-3" style="max-height: 200px;">
                <div class="block">
                    <div class="block-content block-content-full clearfix">
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">1500</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Permintaan Hari Ini</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="max-height: 200px;">
                <div class="block">
                    <div class="block-content block-content-full clearfix">
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">1500</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Pengembalian Hari Ini</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="max-height: 200px;">
                <div class="block">
                    <div class="block-content block-content-full clearfix">
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">1500</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">File Tidak di RM</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="max-height: 200px;" >
                <div class="block">
                    <div class="block-content block-content-full clearfix">
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">1500</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">File di RM</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-deck">
            <div class="col-sm-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Statistik Permintaan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="js-flot-lines" style="height: 240px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Statistik Pengembalian</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="js-flot-lines2" style="height: 240px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection


@section('js')
@endsection