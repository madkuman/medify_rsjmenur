@extends('layouts.main2')

@section('title')
Pengajuan Cuti
@endsection

@section('content')
<main id="main-container">
    <div class="row">
        <div class="col-12">
            @include('kepegawaian.layouts.partials.navbar-non-member',['judul_halaman' => 'Cuti'])
        </div>
    </div>

    <div class="container">
        <h3 class="mb-0">Kuota Cuti</h3>
        @include('kepegawaian.cuti.components.navbar-staff')
        <div class="block mt-10">
            <div class="block-header block-header-default">
                <h3 class="block-title">Kuota Cuti Saya</h3>
                <hr>
            </div>
            @include('kepegawaian.cuti.kuota-staff.index.kuota-cuti-blocks')
            @include('kepegawaian.cuti.kuota-staff.index.table-mutasi')
        </div>
    </div>

</main>
<form method="post" action="{{url()->current()}}/delete" id="form-delete">
    {{ csrf_field() }}
</form>
@endsection

@section('js')
@include('kepegawaian.cuti.kuota-staff.index.table-mutasi-js')
@endsection