@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}} - Konseling Obat - Kasus
@endsection

@section('content')
<main id="main-container">
	@include('kasus.layouts.header')
	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-4 col-xl-9">
				<div class="row">
					<div class="col-lg-12">
						<div class="block rounded p-0">
							
							@include('kasus.farmasi.components.navbar')

							<div class="block-content px-20 pt-20">
								<div class="row">
									<div class="col-12">
										<button type="button" class="btn-alt btn-primary min-width-125 pull-right btn_form" data-id="0">
											<i class="fa fa-pencil mr-5"></i>Form Konseling Obat Baru
										</button>
										<a href="{{url()->current()}}/print" type="button" class="btn-alt btn-secondary min-width-125 pull-right"  target="_blank"><i class="fa fa-print mr-5"></i>Print Konseling Obat</a>
									</div>
								</div>

								@php $count = count($konseling_obat) @endphp
								@forelse($konseling_obat as $data)
								<hr>
								<div class="row">
									<div class="col-12 ">
										<div class="p-10">
											<div class="row">
												<div class="col-6 pt-5">
													<h5 class=" mb-0">Konseling Obat #{{$count--}} </h5>
													<small>Dibuat Oleh : {{$data->creator->name ?? '-'}} | {{indonesian_date($data->created_at)}}</small>
												</div>
												<div class="col-6">
													<button  class="btn btn-secondary mr-5 mb-5 pull-right btn_form" data-id="{{$data->id}}" data-index="{{$loop->iteration - 1}}">
														<i class="fa fa-search"></i> Lihat Selengkapnya
													</button>
													<button  class="btn btn-secondary mr-5 mb-5 pull-right btn_form" data-method="edit" data-id="{{$data->id}}" data-index="{{$loop->iteration - 1}}">
														<i class="fa fa-pencil"></i>
													</button>
													<button  class="btn btn-secondary mr-5 mb-5 pull-right deleteBtn" data-id="{{$data->id}}" >
														<i class="fa fa-trash"></i>
													</button>
													@empty($data->json_val->ttd_img_pasien)
													<button type="button" class="btn btn-warning ttdBtn mr-5 pull-right" data-toggle="tooltip" data-placement="top" title="TTD Pasien" data-id="{{$data->id}}" data-index="{{$loop->iteration - 1}}"><i class="fa fa-pencil"></i></button>
													@endempty
												</div>
											</div>

										</div>
									</div>
								</div>
								@empty
								<div class="row">
									<div class="col-12">
										<div class="text-center py-50">
											<h4 class="font-w400 mb-5">Belum ada asesmen Konseling Obat tersedia</h4>
											<p>Klik tombol <b>Form Konseling Obat Baru</b> untuk melakukan asesmen Konseling Obat Pasien</p>
										</div>
									</div>
								</div>
								@endforelse
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="ttdModal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog modal-md" role="document">
		<div class="modal-content">
			<form  autocomplete="on" target="the_iframe" id="formTTD">
				<div class="block block-themed block-transparent mb-0">
					<div class="block-header">
						<h3 class="block-title">Tanda Tangan Persetujuan</h3>
						<div class="block-options">
							<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
								<i class="si si-close"></i>
							</button>
						</div>
					</div>
					<iframe id="the_iframe" name="the_iframe" src="javascript:false" style="display: none;"></iframe>
					<input type="hidden" name="id" value="" id="ttd_id">
					<div class="block-content" style="padding-left: 25px; padding-right: 40px;">
						{{csrf_field()}}
						<div class="row">
							<div class="col-md-12 form-group mr-2 ml-2" style="margin-bottom: 0">
								<div class="form-group">
									<label for="input_ttd_nama_pasien">Nama Pasien/Wali</label>
									<input type="text" class="form-control" id="input_ttd_nama_pasien" name="input_ttd_nama_pasien" value="{{$kasus->pasien->name}}">
								</div>
								<hr style="border-top: 2px solid #0b72c6">
								<div class="text-left">Silahkan tanda tangan pada kotak dibawah<br /></div>
								<canvas id="canvas" class="mb-10 js-canvas-ttd" width="350" height="200" style="border:2px solid;"></canvas>
								<button type="button" class="btn btn-sm btn-outline-danger mr-5 mb-5 float-right clearCanvas">
									<i class="fa fa-trash"></i> Hapus
								</button>
								<button class="btn btn-xs btn-primary float-right" style="display: none" id="buttonLoading" type="button" disabled>
									<i class="fa fa-spinner fa-spin"></i> Simpan
								</button>
								<button type="button" onclick="ajaxSubmitTTD()" id="buttonSubmitTTD" class="btn btn-xs btn-primary btn-ttd-submit float-right">
									<i class="fa fa-print"></i> Simpan
								</button>
								<button type="button" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
									Batal
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>
@include('kasus.farmasi.modal.konseling-obat-form')
@endsection


@section('js')
<script type="text/javascript">
	var data = JSON.parse({!!json_encode(str_replace("`", "'", $konseling_obat))!!});

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
	});


	$('.btn_form').click(function(){
		openFormModal();
		var data_id = $(this).data('id');
		var item = data[$(this).data("index")];
		var method = $(this).data("method") ?? null;
		
		if ((item != "" && item != undefined) || data_id != 0) {
			var value = JSON.parse(item.val);
			$('#modal-konseling-obat-form #metode').val(value.metode);
			$('#modal-konseling-obat-form #uraian').val(value.uraian);
			$('#modal-konseling-obat-form #rekomendasi').val(value.rekomendasi);
			$('#modal-konseling-obat-form #id').val(data_id);
			$('#modal-konseling-obat-form #metode').attr('readonly', (method != 'edit'));
			$('#modal-konseling-obat-form #uraian').attr('readonly', (method != 'edit'))
			$('#modal-konseling-obat-form #rekomendasi').attr('readonly', (method != 'edit'))
			if(method != 'edit') {
				$('#modal-konseling-obat-form .modal-footer').hide() 
			} else {
				$('#modal-konseling-obat-form .modal-footer').show();
			}
		} else {
			$('#modal-konseling-obat-form #id').val(null);
			$('#modal-konseling-obat-form #metode').val(null);
			$('#modal-konseling-obat-form #uraian').val(null);
			$('#modal-konseling-obat-form #rekomendasi').val(null);
			$('#modal-konseling-obat-form .modal-footer').show();
		};
	})

	function openFormModal(){
		$('#modal-konseling-obat-form').modal('show')
	}

</script>
<script type="text/javascript">
    var canvas = [];
    var ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        pos = {};

    var lineColor = "black",
        lineWidth = 7;

    $(document).ready(function() {
        $('.js-canvas-ttd').each(function(i, obj) {
            canvas_id = $(this).attr('id');
            initCanvas(canvas_id);
        });
    });

    $(document).on('click', '.clearCanvas', function(e){
        canvas_id = $(this).siblings('canvas').attr('id');
        clearCanvas(canvas_id);
    });

    $(document).on('click', '.btn-ttd-submit', function () {
        $('.btn-ttd-submit').hide();
        $('.btn-ttd-loading').show();
        
        $('.js-canvas-ttd').each(function(i, obj) {
            canvas_id = $(this).attr('id');
            ttd_img = saveImg(canvas_id);
            $(this).siblings('input').val(ttd_img);
        });
        $(this).parents('form').submit();
    });

    function initCanvas(canvas_id) {
        canvas[canvas_id] = document.getElementById(canvas_id);
        canvas[canvas_id].style.touchAction = "none";
        ctx = canvas[canvas_id].getContext("2d");
        w = canvas[canvas_id].width;
        h = canvas[canvas_id].height;

        canvas[canvas_id].addEventListener("pointermove", function (e) {
            e.preventDefault();
            findXY(canvas[canvas_id], 'move', e)
        }, false);
        canvas[canvas_id].addEventListener("pointerdown", function (e) {
            e.preventDefault();
            findXY(canvas[canvas_id], 'down', e)
        }, false);
        canvas[canvas_id].addEventListener("pointerup", function (e) {
            e.preventDefault();
            findXY(canvas[canvas_id], 'up', e)
        }, false);
    }
    
    function getMousePos(canvas_el, evt) {
        var rect = canvas_el.getBoundingClientRect();
        return {
            x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas_el.width,
            y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas_el.height
        };
    }

    function findXY(canvas_el,resp, e) {
        pos = getMousePos(canvas_el, e);
        prevX = currX;
        prevY = currY;
        currX = pos.x;
        currY = pos.y;
        
        if (resp == 'down') {
            flag = true;
        }
        if (resp == 'up') {
            flag = false;
        }
        if (resp == 'move') {
            if (flag) {
                draw(canvas_el);
            }
        }
    }

    function draw(canvas_el) {
        canvas_el.getContext("2d").beginPath();
        canvas_el.getContext("2d").strokeStyle = lineColor;
        canvas_el.getContext("2d").lineWidth = lineWidth;
        canvas_el.getContext("2d").moveTo(prevX, prevY);
        canvas_el.getContext("2d").lineTo(currX, currY);
        canvas_el.getContext("2d").closePath();
        canvas_el.getContext("2d").stroke();
    }

    function saveImg(canvas_id) {
        return document.getElementById(canvas_id).toDataURL();
    }
    
    function clearCanvas(canvas_id) {
        document.getElementById(canvas_id).getContext("2d").setTransform(1, 0, 0, 1, 0, 0);
        document.getElementById(canvas_id).getContext("2d").clearRect(0, 0, document.getElementById(canvas_id).width, document.getElementById(canvas_id).height);
    }
</script>
<script>
    var nama = null;
    $(".ttdBtn").click(function(e){
        var ttd_id = $(this).data('id');
        $('#ttd_id').val(ttd_id);
        $("#ttdModal").modal("toggle");
    });

    function ajaxSubmitTTD(){
        var id = $('#ttd_id').val();
		  var nama_pasien = $('#input_ttd_nama_pasien').val();
        var img_base64 = saveImg(canvas_id);

        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        var formData3 = new FormData();
        formData3.append('id', id);
        formData3.append('imgBase64', img_base64);
        formData3.append('nama_pasien', nama_pasien);
        
        $.ajax({
            type: "POST",
            url: "{{url()->current()}}/add-ttd-pasien",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData3,
            cache: false,
            contentType: false,
            processData: false,
            async: false,

            success: function(data) {
                callSwal(data.type,data.title,data.text,data.url);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();                    
            },
            error: function() {
                callSwal('error', 'TTD Gagal', 'Silahkan Coba Lagi', 0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });
    }
</script>


@endsection
