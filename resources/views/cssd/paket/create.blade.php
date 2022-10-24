@extends('layouts.main2')

@section('title')
Manajemen Paket - CSSD - Medify
@endsection

@section('css')
<style>
	.title-hasil {
		font-size: 11pt;
		font-weight: bold;
	}

	.btn_delete {
		position: absolute;
		bottom: 5px;
	}

	.nav {
		width: 100%;
		right: 0;
		margin: 0;
	}

	.nav-link {
		color: white;
	}

	.nav-tabs-block .nav-link.active {
		background-color: #389CF5;
		color: white;
	}

	.nav-item {
		padding: 0;
		background-color: #3078f4;
	}

	.itemform {
		margin-bottom: 15px;
	}

	.select2_paket {
		margin-bottom: 15px;
	}

	.plus_button {
		margin-bottom: 15px;
	}
</style>
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
					<div class="block-header">
						<h3 class="block-title">Buat Paket Baru</h3>
						<hr>
					</div>
					<div class="block-content">
						<form action="{{ url('cssd/pengaturan/paket/new') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="tipe" class="form-control" value="alkes">
							<div id="form">
								<div class="row form-group">
									<div class="col-6">
										<label>Nama Paket</label>
										<input type="text" name="nama_paket" class="form-control" placeholder="Nama Paket" required="">
									</div>
								</div>
								<hr>
								<div id="item_container" >
								</div>

								<div class="row">
									<div class="col-12 text-center">
										<button type="button" class="btn btn-primary plus_button" id="add_more_item" tipe=""><i class="fa fa-plus"></i></button>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-12">
										<button type="submit" class="btn btn-primary">SUBMIT</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@section('js')
<script>
	$("#manajemen_paket").addClass('active');
	var append_item = function(initials = ''){
		if(initials != '') selected = '<option value="'+initials.id+'">'+initials.name+'</option>';
		else selected = '';

		$("#item_container").append(`<div class="row itemform">
			<div class="col-6">
			<label>Barang</label>
			<select class="js-select2 form-control" style="width: 100%;" name="item[]" data-placeholder="Masukkan Nama Barang" required>
			</select>
			</div>
			<div class="col-5">
			<label>Jumlah</label>
			<input type="number" name="jumlah[]" class="form-control" placeholder="Masukkan Jumlah" required>
			</div>
			<div class="col-1">
			<button type="button" class="btn btn-danger btn_delete" onclick="delete_button(this)"><i class="fa fa-trash"></i></button>
			</div>
			</div>`);
		Codebase.helpers(['select2']);
		$(".js-select2").last().select2({
			data : initials,
			ajax : {
				url: API_URL + "/cssd/alkes/search",
				delay: 250,
				dataType: 'json',
				data: function (params) {
					var query = {
						search: params.term,
						keyword: params.term,
					}
					return query;
				},
				processResults: function (data, params) {
					params.page = params.page || 1;

					return {
						results:  $.map(data.data, function (item) {
							return {
								id: item.id,
								text: item.nama
							};
						}),
						pagination: {
							more: (params.page * data.per_page) < data.total
						}
					};
				},
			}
		});
	};
</script>
<script type="text/javascript">  
	$("#add_more_item").click(function(){
		append_item('');
	});

	var delete_button = function(param){
		$(param).parents('.itemform').remove();
	};

</script>

<script>
	$(document).ready(function(){
		window.prev_tipe = '';
	});
</script>
@endsection