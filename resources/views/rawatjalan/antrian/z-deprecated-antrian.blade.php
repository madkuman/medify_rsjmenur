@extends('layouts.main')

@section('title')
	Pendaftaran Pasien - Rawat Jalan - Medify
@endsection

@section('sidebarcomponent')
    @include('rawatjalan.components.sidebar')
@endsection

@section('content')
<div class="row page-title-container">  
   <div class="icon">  
       <i class="fa fa-exchange"></i>  
   </div>  
   <div class="title">  
       Antrian Poliklinik<br><small>Daftar antrian poliklinik pada hari ini</small>
   </div>  
</div>  


<div class="row">
@foreach($poli as $item)
   <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <div class="image small">
            <img height="50px" src="{{asset($item->image_thumb)}}" onerror="imgError(this);">
          </div>
          <h4>{{$item->name}}</h4>
        </div>
        <div class="card-body text-center" >
          Nomor yang sedang dilayani
          @if(!empty($item->transaksi))
          <h2 class="title" style="margin-bottom: 35px">
          {{$item->transaksi[0]->nomor_antrian}}</h2>
          @else <h2 class="title" style="margin-bottom: 35px">0</h2>
          @endif
        </div>
        <div class="card-footer text-center">
          <strong>NOMOR ANTRIAN TERAKHIR :
          <br />@if(!empty($item->last_antrian))
          {{$item->last_antrian[0]->nomor_antrian}}
          @else 0 @endif</strong>
        </div>
      </div>
   </div>
@endforeach
</div>

@endsection

@section('css')
	<style type="text/css">
		.form-group {
            margin-bottom: 5px;
        }

        .card label {
            font-size: 11px;
            margin-bottom: 0;
            text-transform: none;
        }

        .small {
          padding: 10px;
        }

        /*.form-control {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 4px;
            font-size: 12px;
            color: #565656;
            padding: 8px 12px;
            height: 30px;
            -webkit-box-shadow: none;
            box-shadow: none;
        }*/

        .btn {
            /*border-width: 2px;*/
            /*background-color: transparent;*/
            font-weight: 400;
            padding: 8px 16px;
            /*border: 1px solid #888888;*/
            /*color: #FFFFFF;*/
            /*background-color: #888888;*/
            cursor: pointer;
            /*margin-bottom: 5px;*/
            font-size: 1em;
            line-height: 1.42857143;
        }

        .btn-size {
            /*border-width: 2px;*/
            /*background-color: transparent;*/
            font-weight: 400;
            padding: 8px 16px;
            /*border: 1px solid #888888;*/
            /*color: #FFFFFF;*/
            /*background-color: #888888;*/
            cursor: pointer;
            /*margin-bottom: 5px;*/
            font-size: 0.875rem;
            line-height: 1.42857143;
        }

        .card .card-body .control-label {
            text-align: left;
            padding-top: 18px;
        }

        .card-header {
          display: inherit;
        }

        #loader-4 span{
          display: inline-block;
          width: 20px;
          height: 20px;
          border-radius: 100%;
          background-color: #3498db;
          margin: 35px 5px;
          opacity: 0;
        }

        #loader-4 span:nth-child(1){
          animation: opacitychange 1s ease-in-out infinite;
        }

        #loader-4 span:nth-child(2){
          animation: opacitychange 1s ease-in-out 0.33s infinite;
        }

        #loader-4 span:nth-child(3){
          animation: opacitychange 1s ease-in-out 0.66s infinite;
        }

        @keyframes opacitychange{
          0%, 100%{
            opacity: 0;
          }

          60%{
            opacity: 1;
          }
        }

        div.dataTables_wrapper div.dataTables_length label {
            font-weight: normal;
            text-align: left;
            white-space: nowrap;
        }

        .card label {
            font-size: 0.75rem;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .input-group-sm>.input-group-btn>select.btn:not([size]):not([multiple]), .input-group-sm>select.form-control:not([size]):not([multiple]), .input-group-sm>select.input-group-addon:not([size]):not([multiple]), select.form-control-sm:not([size]):not([multiple]) {
            height: calc(1.9999rem + 2px);
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 75px;
            display: inline-block;
        }

        .btn.disabled, .btn:disabled {
            cursor: not-allowed;
            opacity: .40;
        }

        .btn-default.disabled, .btn-default:disabled {
            background-color: #888888 !important;
            border-color: #888888 !important;
        }
	</style>
@endsection
