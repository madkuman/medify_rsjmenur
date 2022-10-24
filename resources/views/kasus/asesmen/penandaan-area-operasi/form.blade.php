@extends("kasus.layouts.main")

@section("title")
Form - Penandaan Area Operasi - {{$kasus->judul_kasus}} - Kasus
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/js/plugins/img-notes/dist/imgNotes.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/jquery-ui/jquery-ui.css')}}">
@endsection

@section("content")

<!-- Main Container -->
<main id="main-container">
	@include("kasus.layouts.header")

	<div class="content">
		<div class="row">
			@include("kasus.layouts.sidebar")

			<!-- Updates -->
			<div class="col-lg-9 col-xl-9">
				<div class="block block-bordered">
					<div class="block-content" id="image-container">
						@if(!$is_edit && !empty($operasi->id))

						@if($operasi->created_by == Auth::user()->id)

						<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/penandaan-area-operasi/form/{{$operasi->id}}"  class="btn btn-sm btn-info mr-5 mb-5 pull-right" data-id="{{$operasi->id}}">
							<i class="fa fa-pencil"></i> Edit
						</a>
						<button  class="btn btn-sm btn-danger mr-5 mb-5 pull-right deleteBtn" data-id="{{$operasi->id}}">
							<i class="fa fa-trash"></i> Hapus
						</button>
						@endif
						@endif
						<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/penandaan-area-operasi" class="btn btn-secondary btn-sm pull-right mr-10">Kembali</a>

						<h4>
						@if($is_edit) Form @else Hasil @endif 

						Penandaan Area Operasi</h4>
						<hr>
						@if($is_edit)
						<form method="POST" action="{{url()->current()}}">
							{{csrf_field()}}
						<input type="hidden" name="id" value="{{$operasi->id ?? ''}}">
						<div class="row justify-content-center">
							<div class="col-12">
								<div class="row ">
									<div class="form-group col-md-4 col-sm-12">
										@php
											if(!empty($operasi->tanggal_operasi)){
												$tanggal = Carbon\Carbon::parse($operasi->tanggal_operasi)->format('Y-m-d');
											}
											else{
												$tanggal = Carbon\Carbon::now()->format('Y-m-d');
											}
											if(!empty($operasi->jenis_operasi))
												$jenis_operasi = $operasi->jenis_operasi;
											else 
												$jenis_operasi = 'kecil';
										@endphp	
										<label>Tanggal Operasi </label>
										<input type="date" class="form-control" name="tanggal" value="{{$tanggal}}">
									</div>
									<div class="form-group col-md-4 col-sm-12">
										<label>Jenis Operasi</label>
										<select type="text" class="form-control" name="jenis_operasi" >
											<option value="kecil" @if($jenis_operasi == 'kecil') selected @endif>Kecil</option>
											<option value="sedang" @if($jenis_operasi == 'sedang') selected @endif>Sedang</option>
											<option value="besar" @if($jenis_operasi == 'besar') selected @endif>Besar</option>
											<option value="khusus" @if($jenis_operasi == 'khusus') selected @endif>Khusus</option>
											<option value="canggih" @if($jenis_operasi == 'canggih') selected @endif>Canggih</option>
										</select>
									</div>
									<input type="hidden" class="input-notes" name="notes">
								</div>
							</div>
						</div>
						@else
						<div class="row">
							<div class="col-3">
								<h5 class="font-w400">Tanggal Operasi</h5>
							</div>
							<div class="col-9">
								<h5>{{indonesian_date($operasi->tanggal,'d F Y')}}</h5>
							</div>
							<div class="col-3">
								<h5 class="font-w400">Jenis Operasi</h5>
							</div>
							<div class="col-9">
								<h5 class="text-uppercase">{{$operasi->jenis_operasi}}</h5>
							</div>
						</div>
						@endif

						<div class="row">
							<div class="col-8  mode-edit-alert" @if(!$is_edit) style="display: none" @endif>
								<div class=" alert alert-primary text-center">Mode Edit</div>
							</div>
							<div class="col-8 mode-view-view" @if($is_edit) style="display: none" @endif>
								<div class=" alert alert-info text-center ">Mode Lihat</div>
							</div>
							<div class="col-12 ">
								<img class="image-human-body" src="{{url('assets/img/asesmen/penandaan_daerah_operasi.jpg')}}" style="height: 550px">
							</div>
							<div class="col-8 text-center">
								<span>Scroll mouse untuk zoom gambar, dan klik lalu tahan untuk drag gambar</span>
							</div>
						</div>
						<div class="row mt-20">
							<div class="col-8">
						@if($is_edit)
								<button class="btn btn-primary pull-right">Submit</button>
								<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/penandaan-area-operasi" class="btn btn-secondary pull-right mr-10">Batal</a>
						@else
								<a href="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/penandaan-area-operasi" class="btn btn-secondary pull-right mr-10">Kembali</a>
						@endif
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form method="POST" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/asesmen/penandaan-area-operasi/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
	
</form>
@include("kasus.asesmen.penandaan-area-operasi.modal")
@endsection

@section("js")
<script src="{{url('')}}/assets/js/plugins/jquery-ui/jquery-ui-09.min.js"></script>
<script src="{{url('')}}/assets/js/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{url('')}}/assets/js/plugins/img-notes/dist/hammer.min.js"></script>
<script src="{{url('')}}/assets/js/plugins/jquery-hammer/jquery.hammer.js"></script>
<script src="{{url('')}}/assets/js/plugins/img-notes/dist/imgViewer.js"></script>
<script src="{{url('')}}/assets/js/plugins/img-notes/dist/imgNotes.js"></script>
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


	$(window).on('load', function(){


		@if(!empty($operasi->notes))
		var notes = {!! json_encode($operasi->notes) !!};
		@else
		var notes = []
		@endif

		var $img = $(".image-human-body").imgNotes({
			onEdit: function(ev, elem) {
				var $elem = $(elem);
				$('#NoteDialog').remove();
				return $('<div id="NoteDialog"></div>').dialog({
					title: "Note Editor",
					resizable: false,
					modal: true,
					height: "200",
					width: "300",
					position: { my: "left bottom", at: "right top", of: elem},
					buttons: {

						"Save": function() {
							var txt = $('textarea', this).val();
							$elem.data("note").note = txt;
							$(this).dialog("close");
							var notes = $img.imgNotes('export');
							notes = JSON.stringify(notes);
							$('.input-notes').val(notes);
						},
						"Delete": function() {
							$elem.trigger("remove");
							$(this).dialog("close");
							var notes = $img.imgNotes('export');
							notes = JSON.stringify(notes);
							$('.input-notes').val(notes);
						},
						Cancel: function() {
							$(this).dialog("close");
							var notes = $img.imgNotes('export');
							notes = JSON.stringify(notes);
							$('.input-notes').val(notes);
						}
					},
					open: function() {
						$(this).css("overflow", "hidden");
						var textarea = $('<textarea id="txt" style="height:100%; width:100%;">');
						$(this).html(textarea);
						textarea.val($elem.data("note").note);
					}
				});
			}
		});

		$img.imgNotes("import", notes);
		@if($is_edit)
		$img.imgNotes("option", "canEdit", true);
		@endif


		var notes = $img.imgNotes('export');
		notes = JSON.stringify(notes);
		$('.input-notes').val(notes);

		


	});
</script>
@endsection