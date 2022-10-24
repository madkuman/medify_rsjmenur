@extends('layouts.main2')

@section('title')
Pengembalian #{{$transaksi->id}} - CSSD
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('cssd.layouts.navbar')
		<div class="block">
			<div class="block-content block-content-full">
				<div class="row">
					<div class="col-12">
						<H6>TRANSAKSI PENGEMBALIAN #{{$transaksi->id}}</H6>
						<hr>
						<div class="row">
							<div class="col">
								<h5><small>KAMAR OPERASI</small><br>{{$transaksi->transaksi_ok->ruangan->name}}</h5>
							</div>
							<div class="col">
								<h5><small>TANGGAL OPERASI</small><br>{{date('d F Y', strtotime($transaksi->transaksi_ok->jadwal_operasi))}}</h5>
							</div>
							<div class="col">
								<h5><small>RONDE</small><br>{{$transaksi->transaksi_ok->nomor_ronde}}</h5>
							</div>
							<div class="col">
								<h5><small>DIAGNOSIS</small><br>{{$transaksi->transaksi_ok->diagnosis}}</h5>
							</div>
							<div class="col">
								<h5><small>DOKTER</small><br>{{$transaksi->transaksi_ok->dokter->name}}</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="block">
					<div class="block-content block-content-full">
						<div class="row">
							<div class="col-8">
								<H6>DAFTAR PENGEMBALIAN ALAT</H6>
								<table class="table table-borderless table-vcenter">
									<tr>
										<th>NAMA ALKES</th>
										<th>JUMLAH</th>
									</tr>
									@foreach($transaksi->detail_group as $alkes)
									<tr>
										<td>{{$alkes->alkes->nama}}</td>
										<td>{{$alkes->total}}</td>
									</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="block">
					<div class="block-content block-content-full">
						@if($transaksi->status == 1)
						<div class="row">
							<div class="col-12">
								<button class="btn btn-outline-primary pull-right" onclick="showEdit()">Edit</button>
								<H6>DAFTAR PENERIMAAN ALAT</H6>
							</div>
							<div class="col-8" id="show-container">
								<table class="table table-borderless table-vcenter">
									<tr>
										<th>NAMA ALKES</th>
										<th>KODE</th>
									</tr>
									@foreach($transaksi->detail as $alkes)
									@if(!empty($alkes->alkes_satuan_id))
									<tr>
										<td>{{$alkes->alkes->nama}}</td>
										<td>{{$alkes->alkes_satuan->slug}}</td>
									</tr>
									@endif
									@endforeach
								</table>
							</div>

							<div class="col-12" id="edit-container" style="display: none">
								<div class="row">
									<div class="col-8">
										<div class="form-group">
											<input class="form-control" id="kodeAlkes" placeholder="Masukkan Kode Barang">
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<button class="btn btn-outline-primary" id="buttonSubmit">Submit</button>
										</div>
									</div>
								</div>
								<form action="{{url()->current()}}/kembalikan-alkes" method="POST">
									<input name="is_edit" type="hidden" value="true"> 
									{{csrf_field()}}
									@foreach($transaksi->detail as $alkes)
									@if(!empty($alkes->alkes_satuan_id))
									<div class="row">
										<div class="col-5">
											<div class="form-group">
												<input type="text" class="form-control" readonly="" value="{{$alkes->alkes->nama}}`" name="nama[]">
											</div>
										</div>
										<div class="col-5">
											<div class="form-group">
												<input type="text" class="form-control" readonly="" value="{{$alkes->alkes_satuan->slug}}" name="slug[]">
											</div>
										</div>
										<div class="col-2 text-center">
											<button type="button" class="btn btn-outline-danger btn-circle btnDelete"><i class="fa fa-trash"></i></button>
										</div>
									</div>
									@endif
									@endforeach

									<div id="pengiriman-container">
									</div>
									<div class="form-group mt-50">
										<button type="button" class="btn btn-secondary" onclick="hideEdit()">Batalkan</button>
										<button class="btn btn-primary"  id="submitBtn">Simpan & Kirimkan Alkes</button>
									</div>
								</form>
							</div>
						</div>
						@elseif($transaksi->status == -1)
						<div class="text-center pt-20">
							<h5 class="text-danger mb-5">Transaksi Telah Ditolak</h5>
							<p>{{$transaksi->keterangan_tolak}} </p>
						</div>
						<span>Ditolak oleh : <strong>{{$transaksi->sender->name}}</strong> </span><br>
						<span>{{date('d F Y H:i', strtotime($transaksi->sent_at))}}</span>
						@else
						<H6>PENERIMAAN ALAT</H6>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<input class="form-control" id="kodeAlkes" placeholder="Masukkan Kode Barang">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<button class="btn btn-outline-primary" id="buttonSubmit">Submit</button>
									<button class="btn btn-outline-default" data-toggle="modal" data-target="#modalInputManual">Input Manual</button>
								</div>
							</div>
						</div>
						<form action="{{url()->current()}}/kembalikan-alkes" method="POST">
							{{csrf_field()}}
							<div id="pengiriman-container">
							</div>
							<div class="form-group text-center mt-50">
								<button class="btn btn-primary" disabled=""  id="submitBtn">Simpan & Kirimkan Alkes</button><br><br>
								<a href="javascript:void(0)" class="text-danger" data-toggle="modal" data-target="#modalTolak">Tolak Permintaaan</a>
							</div>
						</form>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div id="modalTolak" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tolak Transaksi</h4>
				<button type="button pull" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="{{url()->current()}}/tolak-transaksi" method="POST">
				{{csrf_field()}}
				<div class="modal-body">
					<p>Mengapa anda menolak transaksi ini?</p>
					<textarea class="form-control" rows="3" name="keterangan"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>

	</div>
</div>

<div id="modalInputManual" class="modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Input Manual</h4>
				<button type="button pull" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="block block-transparent">
				<div class="block-content row">
					<div class="col-8">
						<div class="form-group">
							<input class="form-control" id="kodeAlkesManual" placeholder="Masukkan Kode Barang">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<button class="btn btn-outline-primary" id="buttonSubmitManual">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
	var countAlat = 0;
	$(document).on('click', '.btnDelete', function() {
		var element = $(this).parent().parent();
		countAlat = countAlat-1;
		element.remove();
		checkIfAbleToSubmit();
	})

	$(document).on('click', '#buttonSubmit', function() {
		searchAlkesBarcode();
	})
	$(document).on('click', '#buttonSubmitManual', function() {
		searchAlkesManual();
		$('#modalInputManual').modal('hide');
	})

	var timer = null;
	$('#kodeAlkes').keyup(function(e) {
		clearTimeout(timer);
		timer = setTimeout(function() {
			searchAlkesBarcode();
		}, 1000);
		if ( e.keyCode === 13 ) { 
			searchAlkesBarcode();
		}
	});
	$('#kodeAlkesManual').keyup(function(e) {
		if ( e.keyCode === 13 ) { 
			searchAlkesManual();
			$('#modalInputManual').modal('hide');
		}
	});

	function showEdit()
	{
		$('#show-container').hide();
		$('#edit-container').show();
	}
	function hideEdit()
	{
		$('#edit-container').hide();
		$('#show-container').show();
	}

	function searchAlkesBarcode()
	{
		var kode = $('#kodeAlkes').val();
		searchAlkesSatuan(kode);
	}

	function searchAlkesManual()
	{
		var kode = $('#kodeAlkesManual').val();
		searchAlkesSatuan(kode);
	}

	function searchAlkesSatuan(kode)
	{
		clearTimeout(timer);
		$.ajax({
			type: "GET",
			contentType: "application/json; charset=utf-8",
			dataType: 'json',
			url: API_URL + '/cssd/alkes-satuan/get/'+kode,
			success: function (result) {
				if(result == 0)
				{
					swal({
						type: 'error',
						title: 'Alkes Gagal Ditemukan',
						html: 'Cek kembali kode anda',
						timer: 1000,
						onOpen: () => {
							swal.showLoading()
							timerInterval = setInterval(() => {
								swal.getContent().querySelector('strong')
								.textContent = swal.getTimerLeft()
							}, 100)
						},
						onClose: () => {
							clearInterval(timerInterval)
							$('#kodeAlkes').val('');
						}
					}).then((result) => {
						if (result.dismiss === swal.DismissReason.timer) {
						}
					})
				}
				else
				{
					kode = result.slug;
					nama = result.alkes.nama;
					$('#pengiriman-container').append(`

						<div class="row">
						<div class="col-5">
						<div class="form-group">
						<input type="text" class="form-control" readonly="" value="`+nama+`" name="nama[]">
						</div>
						</div>
						<div class="col-5">
						<div class="form-group">
						<input type="text" class="form-control" readonly="" value="`+kode+`" name="slug[]">
						</div>
						</div>
						<div class="col-2 text-center">
						<button type="button" class="btn btn-outline-danger btn-circle btnDelete"><i class="fa fa-trash"></i></button></div>
						</div>
						</div>
						`)

					clearTimeout(timer);
					$('#kodeAlkes').val('');
					$('#kodeAlkesManual').val('');
					countAlat += 1;
					checkIfAbleToSubmit();
				}

			}
		});
	}

	checkIfAbleToSubmit();

	function checkIfAbleToSubmit()
	{
		var btn = jQuery('#submitBtn');
		if(countAlat == 0 ) btn.attr('disabled', 'disabled');
		else btn.removeAttr("disabled"); 
	}
</script>



@endsection