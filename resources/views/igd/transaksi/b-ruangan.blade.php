@extends('layouts.main')

@section('title')
	Pendaftaran Pasien - IGD - Medify
@endsection

@section('sidebarcomponent')
    @include('igd.components.sidebar')
@endsection

@section('content')
<div class="row page-title-container">  
   <div class="icon">  
       <i class="fa fa-exchange"></i>  
   </div>  
   <div class="title">  
       Pendaftaran Pasien Baru<br><small>Pilih Ruangan yang Dituju</small>
   </div>
</div>  


<div class="row">
@foreach($ruangan as $item)
   <div class="col-md-3">
      <div class="card">
        <div class="card-header text-center">
          <h2>{{$item->name}}</h2>
        </div>
        <div class="card-body text-center" >
          Kapasitas ruangan yang tersisa
          @if(!empty($item->kapasitas))
          <h2 class="title" style="margin-bottom: 35px">
          {{$sisa=$item->kapasitas-$item->count}}</h2>
          @else <h2 class="title" style="margin-bottom: 35px">0</h2>
          @endif
          @if($sisa!=0)
          <form method="POST" action="{{url('igd/ruangan/baru/konfirmasi')}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$pasien_id}}" name="pasien_id">
            <input type="hidden" value="{{$kasus_id}}" name="kasus_id">
            <input type="hidden" value="{{$item->id}}" name="ruangan_id">
            <button class="btn btn-primary" type="submit">Pilih</button>
          </form>
          @else
          Ruangan IGD ini penuh. Silahkan pilih ruangan lain.
          @endif
        </div>
        <div class="card-footer text-center">

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
