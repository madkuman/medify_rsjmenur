@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Surat Pernyataan Kesanggupan Pembiayaan - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus) && count($surat) < 1)
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Surat Pernyataan Kesanggupan Pembiayaan Baru</button>
						@elseif(count($surat) > 0)
						<a href="{{url()->current()}}/print" target="_blank" type="button" class="btn btn-rounded btn-alt-info min-width-125 float-right"><i class="fa fa-print"></i> Print Surat</a>
						@endif

						<h4>Surat Pernyataan Kesanggupan Pembiayaan</h4>
						<hr>
						@php $count = 1;@endphp
						@forelse($surat as $item)
						@php
							$val = json_decode($item->val);
						@endphp
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>	
						@if(empty($val->img_ttd))					
						<button  class="btn btn-sm btn-outline-primary mr-5 mb-5 pull-right addTTD" data-toggle="modal" data-target="#addTTD" data-id="{{$item->id}}">
							<i class="fa fa-pencil"></i> TTD Pembuat
						</button>
						@endif
						@endif
						@endif

						<h5 class="mb-5 pl-5">#Surat Pernyataan Kesanggupan Pembiayaan {{$count++}}</h5>
						@php $res = json_decode($item->val) @endphp
						<div class="row" id="">
							@include('kasus.asesmen.surat-pernyataan-kesanggupan-pembiayaan.table-hasil')
						</div>
                  
						@if(!empty($item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url('assets/img/placeholder.jpg')}}" alt="">
						</div>
						@endif

						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$item->creator->name}}<br>
								{{date('d F y, H:i', strtotime($item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada Surat Pernyataan Kesanggupan Pembiayaan tersedia</h4>
							<p>Klik tombol <b>Surat Pernyataan Kesanggupan Pembiayaan Baru</b> untuk membuat Surat Pernyataan Kesanggupan Pembiayaan</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/asesmen/surat-pernyataan-kesanggupan-pembiayaan/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>

@include('kasus.asesmen.surat-pernyataan-kesanggupan-pembiayaan.add')
@include('kasus.asesmen.surat-pernyataan-kesanggupan-pembiayaan.add-ttd-penanda')
@endsection

@section('js')
@include('kasus.asesmen.surat-pernyataan-kesanggupan-pembiayaan.js')
<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.time').mask('00:00');
	});
</script>
<script type="text/javascript">
	// CANVAS FOR TTD FIELD

	var canvas, ctx, flag = false,
		prevX = 0,
		currX = 0,
		prevY = 0,
		currY = 0,
		pos = {};

	var lineColor = "black",
		lineWidth = 2;

	function initCanvas() {
		canvas = document.getElementById('canvas');
		canvas.style.touchAction = "none";
		ctx = canvas.getContext("2d");
		w = canvas.width;
		h = canvas.height;

		canvas.addEventListener("pointermove", function (e) {
			e.preventDefault();
			findXY('move', e)
		}, false);
		canvas.addEventListener("pointerdown", function (e) {
			e.preventDefault();
			findXY('down', e)
		}, false);
		canvas.addEventListener("pointerup", function (e) {
			e.preventDefault();
			findXY('up', e)
		}, false);
	}

	// draw line
	function draw() {
		ctx.beginPath();
		ctx.strokeStyle = lineColor;
		ctx.lineWidth = lineWidth;
		ctx.moveTo(prevX, prevY);
		ctx.lineTo(currX, currY);
		ctx.closePath();
		ctx.stroke();
	}

	// clear canvas
	function clearCanvas() {
		// Use the identity matrix while clearing the canvas
    	ctx.setTransform(1, 0, 0, 1, 0, 0);
		ctx.clearRect(0, 0, w, h);
	}

	function saveImg() {
		var dataURL = canvas.toDataURL();
		return dataURL;
	}

	function getMousePos(canvas, evt) {
		var rect = canvas.getBoundingClientRect();
		return {
			x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
			y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
		};
	}

	function findXY(res, e) {
		pos = getMousePos(canvas, e);
		prevX = currX;
		prevY = currY;
		currX = pos.x;
		currY = pos.y;
		
		if (res == 'down') {
			flag = true;
		}
		if (res == 'up') {
			flag = false;
		}
		if (res == 'move') {
			if (flag) {
				draw();
			}
		}
	}

	$(document).ready(function() {
        initCanvas();
        $(".clearCanvas").click(function(e){
			clearCanvas();
		});
    });	
</script>
<script type="text/javascript">
	// SUBMIT TTD FORM
	function ajaxSubmit(){
		var id = $('#id-item').val();    	
    	var imgUrl = saveImg();

    	$('#buttonSubmit').hide();
        $('#buttonLoading').show();

    	var formData = new FormData();
    	formData.append('id', id);    	
    	formData.append('imgBase64', imgUrl);

    	$.ajax({
            type: "POST",
            url: BASE_URL + "/kasus/{{$kasus->nomor_kasus}}/asesmen/surat-pernyataan-kesanggupan-pembiayaan/add-ttd",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                callSwal(data.type,data.title,data.text,data.url);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
    			clearCanvas();

            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });
	}
</script>
@endsection