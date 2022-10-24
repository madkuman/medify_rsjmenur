@extends('highlevel.layouts.main')

@section('title')
Keuangan - High Level Report
@endsection

@section('subtitle')
Keuangan
@endsection

@section('content')

<main id="main-container">
	@include('highlevel.layouts.navbar')
    <div class="container">
        <div class="row">
        	<div class="col-xl-3 mb-20">
	        	
        @include('highlevel.layouts.sidebar')
            </div>
            <div class="col-xl-9">
            	<div class="row">
            		<div class="col mx-0 px-0">
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">Rp {{number_format($pemasukan_total,0)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Pemasukan</div>
            				</div>
            			</div>
            		</div>
            		<div class="col mx-0 px-0">
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">Rp {{number_format($pengeluaran_total,0)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Pengeluaran</div>
            				</div>
            			</div>
            		</div>
            		<div class="col mx-0 px-0">
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">Rp {{number_format($utang_total,0)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Utang</div>
            				</div>
            			</div>
            		</div>
            		<div class="col mx-0 px-0">	
            			<div class="block text-right">
            				<div class="block-content block-content-full clearfix">
            					<div class="font-size-h3 font-w600">Rp {{number_format($piutang_total,0)}}</div>
            					<div class="font-size-sm font-w600 text-uppercase text-muted">Piutang</div>
            				</div>
            			</div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-xl-6">
            			<div class="block">
            				<div class="block-header bg-primary-lighter">
            					<h3 class="block-title">
            						Pemasukan <small>Minggu ini</small>
            					</h3>
            				</div>
            				<div class="block-content block-content-full">
            					<div class="pull-all pt-30">
            						<!-- Lines Chart Container -->
            						<canvas class="js-chartjs-dashboard-lines"></canvas>
            					</div>
            				</div>
            			</div>
            		</div>
            		<div class="col-xl-6">
            			<div class="block">
            				<div class="block-header bg-earth-lighter">
            					<h3 class="block-title">
            						Pengeluaran <small>Minggu ini</small>
            					</h3>
            				</div>
            				<div class="block-content block-content-full text-center">
            					<div class="pull-all pt-30">
            						<!-- Lines Chart Container -->
            						<canvas class="js-chartjs-dashboard-lines2"></canvas>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="{{asset('js/keuangan/dashboard.js')}}"></script>
@endsection