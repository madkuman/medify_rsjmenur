@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}} - Form Edukasi Pasien - Kasus
@endsection

@section('css')
<style type="text/css">
	.centered{
		text-align: center;
	}
</style>
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
						@if(session('my_role_'.$kasus->nomor_kasus))
						<button type="button" class="btn btn-rounded btn-alt-primary min-width-125 float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-pencil"></i> Form Edukasi Pasien Baru</button>
						@endif
						<h4>Edukasi Kebutuhan Pembelajaran Pasien</h4>
						<hr>
						@php $count = 1 @endphp
						@forelse($edukasi_pasien as $item)
						
						@if(session('my_role_'.$kasus->nomor_kasus))
						@if(session('my_role_'.$kasus->nomor_kasus)->admin == 1 || $item->created_by == Auth::user()->id)
						<button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						@endif
						@endif
						@if(empty($item->img_ttd))
						<span data-toggle="modal" data-target="#addTTDPasien">
						<button class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right ttdBtn" data-id="{{$item->id}}" data-toggle="tooltip" title="Tanda Tangani Form Ini">
							<i class="fas fa-file-signature"></i>
						</button>
						</span>
						@endif

						<h5 class="mb-5 pl-5">#Form {{$item->jenis}}</h5>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <table class="table table-hover table-striped table-borderless table-vcenter" id="transaksiTable">
			                        <thead>
			                            <tr>
			                                <th style="width: 40%;">Materi Edukasi</th>
			                                <th style="width: 10%;">Tanggal</th>
			                                <th class="text-center" style="width: 10%;">Durasi (menit)</th>
			                                <th class="text-center" style="width: 10%;">Metode</th>
			                                <th class="text-center" style="width: 10%;">Evaluasi</th>
			                                <th class="text-right" style="width: 10%;">Sasaran</th>
			                                <th class="text-right" style="width: 10%;">Alat Edukasi</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	@foreach($item->detail as $detail)
			                            <tr>
			                                <td class="text-left">{{$detail->materi}}</td>
			                                <td class="text-center">{{date('d/m/y', strtotime($detail->tanggal))}}</td>
			                                <td class="text-center">{{$detail->durasi}}</td>
			                                <td class="text-left">{{$detail->metode}}</td>
			                                <td class="text-left">{{$detail->evaluasi}}</td>
			                                <td class="text-left">{{$detail->sasaran}}</td>
			                                <td class="text-left">{{$detail->alat_edukasi}}</td>
			                            </tr>
			                            @endforeach
			                            <tr>
			                            	<td colspan="7">
			                            		<h5>Penjelasan pasien tentang pemberian edukasi:</h5>
			                            		{{$item->penjelasan_pasien}}
			                            	</td>
			                            </tr>
			                            <tr>
			                            	<td colspan="7">
			                            		<h5>Rekomendasi:</h5>
			                            		{{$item->rekomendasi}}
			                            	</td>
			                            </tr>
			                        </tbody>
			                    </table>
	                        </div>
							@if(!empty($item->img_ttd))
	                        <div class="col-md-12">
			                    <table width="100%">
			                    	<tr>
										<td width="40%">.</td>
										<td width="20%">.</td>
										<td width="40%" class="centered">TTD</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td class="centered">
											<img src="{{url($item->img_ttd)}}" style="max-width: 200px" alt="Tertanda.">
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td class="centered">{{$item->nama_ttd}}</td>
									</tr>
			                    </table>
	                        </div>
							@endif
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
	                        <h4 class="font-w400 mb-5">Belum ada Edukasi Pasien</h4><br>
	                        <p>Klik tombol <b>Form Edukasi Pasien Baru</b> untuk menambah hasil edukasi pembelajaran pasien</p>
	                    </div>

	                    @endforelse
					</div>
				</div>
			</div>
			<!-- END Updates -->
		</div>
	</div>
</main>

<form method="POST" action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/alat-bantu/edukasi-pasien/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>

@include('kasus.alatbantu.edukasi-pasien.add')
@include('kasus.alatbantu.edukasi-pasien.add-ttd-pasien')
<!-- END Main Container -->    
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteBtn").click(function(e){
			e.preventDefault();
			id = $(this).data("id");
			$('#deleteInputId').val(id);
			swal({
				title: "Hapus",
				text: "Apakah anda yakin akan menghapus data ini?",
				showCancelButton: true,
				reverseButtons: true,
				type: 'warning',
				confirmButtonClass: "btn btn-danger",
				cancelButtonClass: "btn btn-default",
				confirmButtonText: "Hapus",
				cancelButtonText: "Kembali",
				closeOnConfirm: false
			}).then(function(result) {
				if(result.value)
				{
					$('#formDelete').submit();
				}
			});
		});

		$(".ttdBtn").click(function(e){
			id = $(this).data("id");
			$('#edukasi-id').val(id);
		});
	});
</script>
<script type="text/javascript">
$('.tambahRecord').click(function() {
	id = $(this).attr("id");
	content = `
		<tr>
            <td>
		        <input type="text" autocomplete="off" name="materi[]" class="form-control" required>
		    </td>
		    <td>
		        <input type="text" class="js-datepicker form-control" name="tanggal[]" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd/mm/yyyy" value="{{date('d/m/Y', time())}}" required="">
		    </td>
		    <td>
		        <input type="text" autocomplete="off" name="durasi[]" class="form-control" required="">
		    </td>
		    <td>
		        <select name="metode[]" class="js-select2 form-control" style="width: 100%" required="">
		            <option value="Diskusi" selected>A. Diskusi</option>
		            <option value="Ceramah">B. Ceramah</option>
		            <option value="Praktek">C. Praktek</option>
		            <option value="Demo">D. Demo</option>
		        </select>
		    </td>
		    <td>
		        <select name="evaluasi[]" class="js-select2 form-control" style="width: 100%" required="">
		            <option value="Mengerti" selected>A. Mengerti</option>
		            <option value="Kurang Mengerti">B. Kurang Mengerti</option>
		            <option value="Tidak Mengerti">C. Tidak Mengerti</option>
		        </select>
		    </td>
		    <td>
		        <input type="text" autocomplete="off" name="sasaran[]" class="form-control" required="">
		    </td>
		    <td>
		        <select name="alat_edukasi[]" class="js-select2 form-control" style="width: 100%" required="">
		            <option value="Leaflet/Banner" selected>A. Leaflet/Banner</option>
		            <option value="Model/Peraga">B. Model/Peraga</option>
		        </select>
		    </td>
            <td class="text-right">
                <button class="btn btn-alt-danger btn-sm remove" type="button"><i class="fa fa-remove"></i></button>
            </td>
        </tr>
	`;
	
	if(id == "tambahAdmisi")
		$('#admisiTable tr:last').after(content);
	else if(id == "tambahKeperawatan")
		$('#keperawatanTable tr:last').after(content);
	else if(id == "tambahManageNyeri")
		$('#manageNyeriTable tr:last').after(content);
	else if(id == "tambahDpjp")
		$('#dpjpTable tr:last').after(content);
	else if(id == "tambahDiet")
		$('#dietTable tr:last').after(content);
	else if(id == "tambahPsikologi")
		$('#psikologiTable tr:last').after(content);
	else if(id == "tambahFarmasi")
		$('#farmasiTable tr:last').after(content);

	$('.js-select2').select2();
	$('.js-datepicker').datepicker();
});

$(document).on('click', '.remove', function() {
	var element = $(this).parent().parent();
	element.remove();
});
</script>
<script type="text/javascript">
    $(".nav-tabs").find("li a").last().click();

    var url = document.URL;
    var hash = url.substring(url.indexOf('#'));

    $(".nav-tabs").find("li a").each(function(key, val) {

    	if (hash == $(val).attr('href')) {
    		$(val).click();
    	}
	    $(val).click(function(ky, vl) {
	        // console.log($(this).attr('href')+"1");
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
        if(lokasi === '')
        {
        	$('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $('#admisi').addClass('show active');
            $('#nav-admisi').addClass('active');    
        }
        else
        {
            $('.tab-pane').removeClass('show active');
            $('.nav-link').removeClass('active');
            $(''+lokasi+'').addClass('show active');
            $('#nav-'+hash_baru+'').addClass('active');    
        }
    }

    $(document).ready(function() {
        locationchange();
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
		var id = $('#edukasi-id').val();
    	var nama = $('#nama-pasien').val();
    	var imgUrl = saveImg();

    	$('#buttonSubmit').hide();
        $('#buttonLoading').show();

    	var formData = new FormData();
    	formData.append('id', id);
    	formData.append('nama', nama);
    	formData.append('imgBase64', imgUrl);

    	$.ajax({
            type: "POST",
            url: API_URL + "/kasus/{{$kasus->nomor_kasus}}/alat-bantu/edukasi-pasien/add-ttd-pasien",
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