@extends('igd.layouts.blank')

@section('title')
Mesin Antrian
@endsection

@section('css')
<style type="text/css">
	.square{
		display: block;
	}
</style>

@endsection

@section('content')
<main class="container pt-20">
	<div id="header">
		<div class="text-center">
			<img src="{{asset(config('app.logo_url'))}}" height="100px">
		</div>
		<h4 class="text-center mb-30 mt-10" id="pilih_loket">Pilih Loket</h4>
		<h4 class="text-center mb-30 mt-10 hide" id="tekan_button">Klik tombol untuk panggil ke antrian berikutnya</h4>
	</div>
	<div id="loket_container">
		@foreach($loket as $item)
		<div class="row">
			<div class="col-12">
				<a class="block block-link-shadow" href="javascript:void(0)" onclick="chooseLoket({{$item->id}},'{{$item->nama}}')">
					<div class="block-content text-center">
						<h3 class="mb-20 mt-20">{{$item->nama}}</h3>
					</div>
				</a>
			</div>
		</div>

		@endforeach
	</div>
	<div id="button_container" class="hide">
		<div class="row">
			<div class="col-12">
				<a class="block block-link-shadow" href="javascript:void(0)" onclick="callNext()">
					<div class="block-content text-center">
						<h3 id="loket_nama"></h3>
						<hr>
						<h3 class="mb-20 mt-20">Panggil Antrian Berikutnya</h3>
					</div>
				</a>
			</div>
		</div>
	</div>
</main>
@endsection

@section('js')
<script type="text/javascript">
	var loket_id = 0
	var nama_loket = '';
	function chooseLoket(id,nama_loket)
	{
		$('#loket_nama').text(nama_loket)
		loket_id = id;
		$('#loket_container').fadeOut(500, function() {
			$('#button_container').fadeIn()
		})
		$('#pilih_loket').fadeOut(500, function() {
			$('#tekan_button').fadeIn()
		})
	}

	function callNext()
	{
		$.ajax({
			type: "GET",
			dataType: 'json',
			url: API_URL + '/igd/antrian-button/call-next/'+loket_id,
			tryCount : 0, 
			retryLimit : 3,
			success: function (result) {
				if(result.status == 1)
					callSwal('success','Berhasil','Antrian Berikutnya Akan Dipanggil Beberapa Saat Lagi',0)
				else
					callSwal('error','Gagal','Tidak Ada Antrian Tersedia',0)
			},
			error : function(xhr, textStatus, errorThrown ) {
				if (textStatus == 'timeout') {
					this.tryCount++;
					if (this.tryCount <= this.retryLimit) {
						$.ajax(this);
						return;
					}            
					return;
				}
				if (xhr.status == 500) {
					callSwal('error','Error','Kesalahan Server Hubungi Admin',0)
					reset();
				} else {
					callSwal('error','Error','Kesalahan Server Hubungi Admin',0)
					reset();
				}
			}
		});
	}



</script>
@endsection
