@extends('highlevel.layouts.main')

@section('title')
High Level Report
@endsection

@section('subtitle')
@endsection

@section('content')

<main id="main-container">
	@include('highlevel.layouts.navbar')
    <div class="container">
        <div class="row">
        	<div class="col-xl-3 mb-20">
	        	
        @include('highlevel.layouts.sidebar')
            </div>
            <div class="col-xl-9 text-center py-20">
                <div class="alert alert-info alert-dismissable col-md-12" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-close="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <h5 class="alert-heading font-w400"><span class="fa fa-bar-chart"></span> High Level Report</h5>
                    <p class="mb-0">Menu ini akan membantu anda untuk mendapatkan garis besar informasi dari modul-modul pada Sistem Informasi {{config('app.name')}}. Pilih modul pada sidebar kiri untuk menampilkan grafik laporan modul tersebut.</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection