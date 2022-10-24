@extends('bpjs.layouts.main')

@section('title')
Rujukan BPJS
@endsection

@section('subtitle')
Dashboard
@endsection

@section('css')

<style type="text/css">
	.block-content {
		padding-bottom: 18px;
	}
	td, th{
		font-size: 12px;
	}
</style>
@endsection

@section('content')
<main id="main-container">
	@include('bpjs.layouts.navbar')
	<div class="container">
		<div class="block">
			<div class="block-content block-content-full">
				<div class="pull-right">
					<a href="{{url('bpjs/rujukan/search')}}" class="btn btn-secondary"><i class="fa fa-search"></i> Cari Nomor Rujukan</a>
					<a href="{{url('bpjs/rujukan/create')}}" class="btn btn-primary">Tambah Rujukan</a>
				</div>
				<h5>Daftar Rujukan BPJS</h5>
				<hr>
				@include('bpjs.rujukan.index.components.filter-date')
				@include('bpjs.rujukan.index.components.tables')
			</div>
		</div>
	</div>
</main>
@endsection


@section('js')
<script type="text/javascript" src="{{asset('assets/js/jquery1.10.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dataTables1.10.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    draw(null,null);
	} );
	$("#tanggal-min").on('change', function(){
		tanggal_start = $("#tanggal-min").datepicker('getFormattedDate');
        tanggal_end = $("#tanggal-max").datepicker('getFormattedDate');
        draw(tanggal_start,tanggal_end);
    });
    $("#tanggal-max").on('change', function(){
    	tanggal_start = $("#tanggal-min").datepicker('getFormattedDate');
        tanggal_end = $("#tanggal-max").datepicker('getFormattedDate');
        draw(tanggal_start,tanggal_end);
    });

	var table;
	function draw(tanggal_start,tanggal_end){
	    table = $('#bpjsTable').DataTable({
	    destroy: true,
	    autoWidth: false,
	    processing: true,
	    serverSide: true,
	    ajax: {
	        type: "POST",
	        dataType: "json",
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data:{
	            tanggal_start : tanggal_start,
	            tanggal_end : tanggal_end,
	        },
	        url: API_URL + '/bpjs/rujukan/index/feed-table',
	    },
	    columns: [
	        { data: 'id', name: 'id', className: 'text-center', 
	            render: function(data, type, row, meta){
	                return meta.row + meta.settings._iDisplayStart + 1;
	            }
	        },
	        { data: 'no_rujukan', name: 'no_rujukan', className: 'text-center' },
	        { data: 'tanggal_rujuk', name: 'tanggal_rujuk', className: "text-center",
	            render: function ( data ) {
	                var date = new Date(data);
	                return date.toShortFormat();
	            } 
	        },
	        { data: 'jenis_rujuk', name: 'jenis_rujuk', className: 'text-center',
		        render: function ( data ) {
		        	if (data == 2) {
		        		return "RJ";
		        	} else {
		        		return "RI";
		        	}
		        }
		    },
		    { data: 'no_sep', name: 'no_sep', className: 'text-center' },
		    { data: 'no_kartu', name: 'no_kartu', className: 'text-center'},
		    { data: 'nama', name: 'nama', className: 'text-center'},
		    { data: 'faskes', name: 'faskes', className: 'text-center' },
	        { data: 'no_rujukan', name: 'no_rujukan', className: 'text-center', 
	            render: function(data, type, row, meta){
	                data = '<a href="rujukan/'+data+'" class="btn btn-sm btn-primary">Detail</a>';
	                return data;
	            },
	            searchable: false,
	            sortable: false
	        },
	        ],
	        order: [[ 0, "desc" ], [ 2, "desc" ]],  
	    });
	}

	Date.prototype.toShortFormat = function() {

	    var month_names =["Januari","Februari","Maret",
	                      "April","Mei","Juni",
	                      "Juli","Agustus","September",
	                      "Oktober","November","Desember"];
	    
	    var day = this.getDate();
	    var month_index = this.getMonth();
	    var year = this.getFullYear();
	    
	    return "" + day + " " + month_names[month_index] + " " + year;
	}
</script>
@endsection