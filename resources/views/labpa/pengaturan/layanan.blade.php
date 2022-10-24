@extends('layouts.main2')
@section('title')
Laboratorium Patologi Anatomi
@endsection
@section('css')
<style type="text/css">
	.headcols {
            position:absolute; 
            width:5em; 
            left:0;
            top:auto;
            border-right: 0px none black; 
            border-top-width:3px; /*only relevant for first row*/
            margin-top:-3px; /*compensate for top border*/
        }

        .longs { background:yellow; letter-spacing:1em; }

        .table-bordered, .table-bordered td, .table-bordered th {
        	/*border-right: none !important;*/
        }

        .table2, .table2 .td2, .table2 .th2 {
        	border-left: none !important;
        }

        .th3 {
        	border-bottom: 1px solid #eaecee !important;
        }
</style>
@endsection
@section('content')
@include('labpa.components.header')

<div class="content">
    <div class="block block-themed">
        <div class="block-header" style="background-color:#ffffff">
            <h3 class="block-title" style="font-weight: 550; color: black">Tarif Layanan {{$tarif->deskripsi}}</h3>
        </div>

        <div class="clearfix"></div>
        <div class="block-content">
        	<div class="row">
        		<div class="col-md-12" style="overflow-x: scroll;">
        			@include('layouts.components2.lab.tabel-pengaturan-harga')
        		</div>
        	</div>
        </div>
    </div>
</div>

@include('labpa.components.footer')

@endsection