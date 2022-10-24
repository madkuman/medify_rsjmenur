@extends('eusulan.layouts.main')

@section('title')
    E-usulan Laporan
@endsection

@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Laporan</h3>
        </div>
        <div class="block-content">
            <div class="row row-deck">
                @include('eusulan.laporan.components.cards')
            </div>
        </div>
    </div>
    @include('eusulan.laporan.components.modals')
@endsection

@section('js')
    @include('eusulan.laporan.components.js')
@endsection