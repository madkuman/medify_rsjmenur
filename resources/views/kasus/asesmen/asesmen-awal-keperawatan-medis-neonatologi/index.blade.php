@extends("kasus.layouts.main")

@section("title")
{{$kasus->judul_kasus}} - {{ $form->nama_show ?? '' }} - Kasus
@endsection

@section("content")

<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content">
						@if(session("my_role_".$kasus->nomor_kasus))

						<a href="{{url('')}}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/create" class="btn btn-rounded btn-alt-primary min-width-125 float-right"><i class="fa fa-pencil"></i> {{ $form->nama_show ?? '' }} </a>
						@endif

						<h4>{{ $form->nama_show ?? '' }}</h4>
						<hr>
						@php $count = count($hasil) @endphp
						@forelse($hasil as $hasil_item)

						@if(session("my_role_".$kasus->nomor_kasus))
						@if($hasil_item->created_by == Auth::user()->id)
						<button  class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$hasil_item->id}}">
							<i class="fa fa-trash"></i>
						</button>
						<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/edit/{{ $hasil_item->id }}" class="btn btn-sm btn-circle btn-outline-warning mr-5 mb-5 pull-right editBtn" data-id="{{$hasil_item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-pencil"></i>
						</a>
						@endif
						@endif

						<a type="btn" href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/print/{{ $hasil_item->id }}" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" target="_blank">
							<i class="fa fa-print"></i>
						</a>
						<a href="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/view/{{ $hasil_item->id }}" class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right showBtn" data-id="{{$hasil_item->id}}" data-index="{{$loop->iteration - 1}}">
							<i class="fa fa-search"></i>
						</a>

						<h5 class="mb-5 pl-5">#{{ $form->nama_show ?? '' }} {{$count}}</h5>

						@php
							$data_val = json_decode($hasil_item->val);
						@endphp
						@if (($data_val->ttd_persetujuan_pasien ?? null) == null)
							<div class="d-flex justify-content-end w-100">
								@empty($data_val->ttd_persetujuan_pasien)
									<button id="btnTtdPersetujuanPasien-{{$hasil_item->id}}" data-for="Persetujuan Pasien" type="button" data-ttd-type="ttd_persetujuan_pasien" class="btn btn-primary mr-5 align-middle btn-add-ttd" data-id="{{$hasil_item->id}}" title="Tambah Tanda Persetujuan Pasien" data-original-title="Tambah Tanda Tangan Persetujuan Pasien">
										<i class="fas fa-file-signature"></i>
										<span>TTD Persetujuan Pasien</span>
									</button>
								@endempty
							</div>
						@endif

						@if(!empty($hasil_item->creator->avatar_thumb))
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url($hasil_item->creator->avatar_thumb)}}" alt="">
						</div>
						@else
						<div class="float-left mr-10">
							<img class="img-avatar img-avatar-sm img-avatar-thumb" src="{{url("assets/img/placeholder.jpg")}}" alt="">
						</div>
						@endif
						<div class="creator">
							<h6 class="pt-10">
								<small class="text-muted">Dibuat Oleh</small><br>
								{{$hasil_item->creator->name}}<br>
								{{date("d F y, H:i", strtotime($hasil_item->created_at))}}
							</h6>
						</div>

						<hr class="my-20">
						@php $count-- @endphp
						@empty

						<div class="text-center py-50">
							<h4 class="font-w400 mb-5">Belum ada asesmen {{ $form->nama_show ?? '' }} tersedia</h4>
							<p>Klik tombol <b>{{ $form->nama_show ?? '' }} Baru</b> untuk melakukan asesmen {{ $form->nama_show ?? '' }}</p>
						</div>

						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/asesmen/{{$form->slug}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">

</form>
@includeIf('kasus.asesmen.'.$slug.'.modal-ttd')
@endsection
@section("js")
<script type="text/javascript">
	$(".deleteBtn").click(function(e){
		e.preventDefault();
		id = $(this).data("id");
		$("#deleteInputId").val(id);
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus data ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: "warning",
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value)
			{
				$("#formDelete").submit();
			}
		});
	});
</script>
{{-- canvasTtd --}}
<script type="text/javascript">
    var canvasTtd, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        pos = {};

    var lineColor = "black",
        lineWidth = 2;

    function initCanvasTtd() {
        canvasTtd = document.getElementById('canvasTtd');
        canvasTtd.style.touchAction = "none";
        ctx = canvasTtd.getContext("2d");
        w = canvasTtd.width;
        h = canvasTtd.height;

        canvasTtd.addEventListener("pointermove", function (e) {
            e.preventDefault();
            findXY('move', e)
        }, false);
        canvasTtd.addEventListener("pointerdown", function (e) {
            e.preventDefault();
            findXY('down', e)
        }, false);
        canvasTtd.addEventListener("pointerup", function (e) {
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
    function clearCanvasTtd() {
        // Use the identity matrix while clearing the canvas
        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.clearRect(0, 0, w, h);
    }

    function saveImgTtd() {
        var dataURL = canvasTtd.toDataURL();
        return dataURL;
    }

    function getMousePos(canvasTtd, evt) {
        var rect = canvasTtd.getBoundingClientRect();
        return {
            x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvasTtd.width,
            y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvasTtd.height
        };
    }

    function findXY(res, e) {
        pos = getMousePos(canvasTtd, e);
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
        initCanvasTtd();
        $(".clearCanvasTtd").click(function(e){
            clearCanvasTtd();
        });
    });	
</script>
{{-- modal --}}
<script type="text/javascript">
    $(".btn-add-ttd").click(function(e){
        clearCanvasTtd();
        ttd_id = $(this).attr('data-id');
        dataFor = $(this).attr('data-for');
        ttdType = $(this).attr('data-ttd-type');

		let namaPasien = '{{$kasus->pasien->name ?? ''}}'
		$("#nama_persetujuan_pasien").val(namaPasien)
        // console.log(ttd_id,dataFor,this)
        $("#addTtd").modal("toggle");
        $("#ttdUntuk").text(dataFor);
    });
    // submitTtd
	$('#btnSubmitTtd').on( 'click', function() {       
		var imgUrl = saveImgTtd();
		var namaPersetujuanPasien = $("#nama_persetujuan_pasien").val();

		$(this).prop('disabled', true);
		$(this).css({ cursor: "not-allowed" });
		$('#btnSubmitTtd .simpanTTD').hide();
		$('#btnSubmitTtd .loadingSimpanTTD').show();

		var formDataTtd = new FormData();
		formDataTtd.append('id', ttd_id);
		formDataTtd.append('type', ttdType);
		formDataTtd.append('imgBase64', imgUrl);
		formDataTtd.append('persetujuan_pasien', namaPersetujuanPasien);

		$.ajax({
			type: "POST",
			url: "{{url()->current()}}/add-ttd",
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: formDataTtd,
			cache: false,
			contentType: false,
			processData: false,
			async: true,

			success: function(response) {
				// callSwal(data.ttd, data.type, data.title, data.text);
				callSwal('success', 'TTD Berhasil', 'TTD Berhasil Ditambahkan', 0);
				if(ttdType == 'ttd_persetujuan_pasien') {
					$(`#btnTtdPersetujuanPasien-${ttd_id}`).hide(); 
				}
				$("#addTtd").modal("toggle");
				$('#btnSubmitTtd').prop('disabled', false);
				$('#btnSubmitTtd').css({ cursor: "pointer" });
				$('#btnSubmitTtd .simpanTTD').show();
				$('#btnSubmitTtd .loadingSimpanTTD').hide();
			},
			error: function(error) {
				// console.log(error, 2)
				callSwal('error', 'TTD Gagal', 'Silahkan Coba Lagi', 0);
				$('#btnSubmitTtd').prop('disabled', false);
				$('#btnSubmitTtd').css({ cursor: "pointer" });
				$('#btnSubmitTtd .simpanTTD').show();
				$('#btnSubmitTtd .loadingSimpanTTD').hide();
			}
		});
	})
</script>
@endsection