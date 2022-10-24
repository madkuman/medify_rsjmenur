@extends('layouts.main2')

@section('title')
Pelaksanaan - Kamar Operasi - Medify
@endsection

@section('css')
@include('kamaroperasi.pelaksanaan.components.css')
@endsection

@section('content')
<main id="main-container">
	<div class="content">
		@include('kamaroperasi.components.navbar')
		<div class="row">
			<div class="col-12">
				<div class="block block-rounded">
					<div class="block-header">
						<h3 class="block-title">{{ $transaksi->judul or 'Pelaksanaan Operasi' }}</h3>
					</div>
					@if(isset($transaksi->parent_id))
					<div class="col-12 bg-primary py-10">
						<span class="font-w600 text-white">Operasi Utama:  </span>
						<a class="btn btn-alt-primary btn-sm ml-10" href="{{url('kamaroperasi/pelaksanaan')}}/{{$transaksi->parent->id}}">{{$transaksi->parent->judul}}</a>
					</div>
					@else
					@if(count($transaksi->child) != 0)
					<div class="col-12 bg-primary py-10">
						<span class="font-w600 text-white">Operasi Join:  </span>
						@foreach($transaksi->child as $child)
						<a class="btn btn-alt-primary btn-sm ml-10" href="{{url('kamaroperasi/pelaksanaan')}}/{{$child->id}}">{{$child->judul}}</a>
						@endforeach
					</div>
					@endif
					@endif
					<div class="block-content" style="padding: 0px">
						@if(isset($transaksi->parent_id))
						@php($trans_info = $transaksi->parent)
						@include('kamaroperasi.pelaksanaan.components.operasi-info-child')
						@else
						@php($trans_info = $transaksi)
						@include('kamaroperasi.pelaksanaan.components.operasi-info-parent')
						@endif
						@include('kamaroperasi.pelaksanaan.components.navbar')
						<div class="block-content tab-content">
							<div class="tab-pane main-tab-pane active" id="rencana_operasi_div" role="tabpanel">
								@include('kamaroperasi.pelaksanaan.rencana.index')
							</div>
							<div class="tab-pane main-tab-pane" id="hasil_operasi_div" role="tabpanel">
								@include('kamaroperasi.pelaksanaan.hasil.index')
							</div>
							<div class="tab-pane main-tab-pane" id="tim_div" role="tabpanel">
								@include('kamaroperasi.pelaksanaan.tim.index')
							</div>
							<div class="tab-pane main-tab-pane" id="pengaturan_div" role="tabpanel">
								@include('kamaroperasi.pelaksanaan.pengaturan.index')
							</div>
							<div class="tab-pane main-tab-pane" id="tagihan_div" role="tabpanel">
								@include('kamaroperasi.pelaksanaan.tagihan.index')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('kamaroperasi.pelaksanaan.rencana.modals')
	@include('kamaroperasi.pelaksanaan.pengaturan.modals')
	@include('kamaroperasi.pelaksanaan.tagihan.create-modal')
	@include('kamaroperasi.pelaksanaan.tagihan.create-manual-modal')
	@include('kamaroperasi.pelaksanaan.tagihan.edit-modal')
	@include('kamaroperasi.pelaksanaan.tagihan.delete-modal')
</main>

@endsection

@section('js')
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lightgallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-fullscreen.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-pager.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-zoom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/lightgallery/lg-video.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#lightgallery").lightGallery({
			pager: true,
			zoom: true,
			actualSize: true,
			fullscreen: true,
			selector: '.katalog',
		});
		initSelect2Pemakaian();
	});

	
</script>
<script type="text/javascript">
	Dropzone.autoDiscover = false;
	var base_url = "{{URL::asset('')}}";
	var myDropzone = new Dropzone('#my-dropzone');
	function deleteFoto(foto_id)
	{	
		swal({
			title: 'Apa anda yakin menghapus file ini?',
			text: "File yang telah dihapus tidak dapat dikembalikan",
			type: 'warning',
			confirmButtonClass: 'btn btn-danger',
			cancelButtonClass: 'btn btn-primary',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: 'GET',
					url: '{{url("kamaroperasi/delete/gambar")}}',
					data: {
						id: foto_id,
					},
					success: function(result){
						var foto = document.getElementById(result.trim());
						var tombol = document.getElementById(result.trim()+"_btn");
						console.log(foto,tombol);
						foto.remove();
						tombol.remove();
						callSwalNewtab("success","Berhasil","Foto Berhasil Dihapus",0);
						$('#lightgallery').data('lightGallery').destroy(true);
						$("#lightgallery").lightGallery({
							pager: true,
							zoom: true,
							actualSize: true,
							fullscreen: true,
							selector: '.katalog',
						});
					}
				});
			}
		})
	}
	myDropzone.on("success", function(file,response)
	{	
	});
</script>
<script type="text/javascript">
	$(".nav-tabs").find("li a").last().click();

	var url = document.URL;
	var hash = url.substring(url.indexOf('#'));

	$(".main-tab").find("li a").each(function(key, val) {

		if (hash == $(val).attr('href')) {
			$(val).click();
		}
		$(val).click(function(ky, vl) {
			console.log($(this).attr('href')+"1");
			location.hash = $(this).attr('href');
		});

	});

	window.onhashchange = locationchange;

	function locationchange()
	{   
		var lokasi = location.hash;
		var satuan = lokasi.split("");
		satuan.splice(0,1);
		var hash_baru = satuan.join("");
		console.log(hash_baru+"2");
		if(lokasi === '')
		{
			$('.main-tab-pane').removeClass('show active');
			$('.main-nav-link').removeClass('active');
			$('#rencana_operasi_div').addClass('show active');
			$('#nav-rencana_operasi').addClass('active');    
		}
		else
		{
			$('.main-tab-pane').removeClass('show active');
			$('.main-nav-link').removeClass('active');
			$(''+lokasi+'_div').addClass('show active');
			$('#nav-'+hash_baru+'').addClass('active');    
		}
	}

	$(document).ready(function() {
		locationchange();
	});
</script>
@include('kamaroperasi.pelaksanaan.tagihan.create-js')
@include('kamaroperasi.pelaksanaan.tagihan.create-manual-js')
@include('kamaroperasi.pelaksanaan.tagihan.edit-js')
@include('kasus.datamedis.content.js.tindakan-main')
@include('kamaroperasi.pelaksanaan.components.js-obat')
@include('kamaroperasi.pelaksanaan.tim.js-tim')
@include('kamaroperasi.pelaksanaan.pengaturan.js-dokter')
@include('kamaroperasi.pelaksanaan.pengaturan.js-diagnosis')
@endsection