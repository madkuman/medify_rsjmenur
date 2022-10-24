@extends('layouts.main')

@section('title')
    Barang - Gudang - Medify
@endsection

@section('sidebarcomponent')
    @include('warehouse.components.sidebar')
@endsection

@section('content')

    <div class="row page-title-container">
        <div class="icon">
            <i class="fa fa-medkit" aria-hidden="true"></i>
        </div>
        <div class="title">
            Barang<br>
            <small>
                Daftar semua Kategori
            </small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url('warehouse/category/new')}}" class="btn btn-fill btn-round btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Kategori Baru</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    </div>
                    <div class="hr-custom"></div>
                    <div class="row" id="hasilSearch">
                        @php $i=0 @endphp
                        @foreach($category as $row)
                            <div class="col-md-3" style="margin-bottom: 25px;">
                                <div class="card-custom card-inverse-custom card-info-custom">
                                    <div class="card-block-custom">
                                        <h4 class="card-title">@if(mb_strlen($row->name) > 18 ) {{mb_substr($row->name,0,18)."..."}} @else {{$row->name}} @endif</h4>
                                        <h5 class="card-category">Total : {{$count[$i++]}} Barang</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        /*html {
        font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
        font-size: 14px;
        }*/

        .card label {
            font-size: 11px;
            margin-bottom: 0;
            text-transform: none;
        }

        h5 {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
            margin: 0;
        }

        .card-custom {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
        }

        .card-block-custom {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }

        .card-img-top-custom {
            display: block;
            width: 100%;
            height: 220px;
        }

        .card-title-custom {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text-custom {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

        .card-footer-custom {
            font-size: 1em;
            position: static;
            top: 0;
            left: 0;
            max-width: 100%;
            padding: .75em 1em;
            color: rgba(0, 0, 0, .4);
            border-top: 1px solid rgba(0, 0, 0, .05) !important;
            background: #fff;
        }

        .card-inverse-custom .btn-custom {
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .profile-custom {
            position: absolute;
            top: -12px;
            display: inline-block;
            overflow: hidden;
            box-sizing: border-box;
            width: 25px;
            height: 25px;
            margin: 0;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar-custom {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .profile-inline-custom {
            position: relative;
            top: 0;
            display: inline-block;
        }

        .profile-inline-custom ~ .card-title-custom {
            display: inline-block;
            margin-left: 4px;
            vertical-align: top;
        }

        .text-bold-custom {
            font-weight: 700;
        }

        #custom-search-input{
            padding: 3px;
            border: solid 1px #E4E4E4;
            border-radius: 6px;
            background-color: #fff;
        }

        #custom-search-input input{
            border: 0;
            box-shadow: none;
        }

        #custom-search-input button{
            margin: 2px 0 0 0;
            background: none;
            box-shadow: none;
            border: 0;
            color: #666666;
            padding: 0 8px 0 10px;
            /*border-left: solid 1px #ccc;*/
        }

        #custom-search-input button:hover{
            border: 0;
            box-shadow: none;
            border-left: solid 1px #ccc;
        }

        #custom-search-input .glyphicon-search{
            font-size: 23px;
        }

        input:focus {
            box-shadow: 0 0 5px rgba(81, 203, 238, 1);
            /*padding: 3px 0px 3px 3px;
            margin: 5px 1px 3px 0px;*/
            border: 1px solid rgba(81, 203, 238, 1);
        }

        .hr-custom {
            margin-top: 1rem; 
            margin-bottom: 1rem; 
            border: 0;
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
