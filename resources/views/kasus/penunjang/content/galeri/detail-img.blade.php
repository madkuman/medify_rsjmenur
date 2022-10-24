@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Penunjang - Kasus
@endsection

@section('css')
<style type="text/css">
.avatar-preview {
	border-radius: 0;
}
.avatar-preview div {
	border-radius: 0;
}
.avatar-upload {
	margin: 20px auto;
}
.text-link {
	cursor: pointer;
	text-decoration: underline;
	color: blue;
}
</style>
<link rel="stylesheet" type="text/css"  href="{{asset('plugins/megazoom/start/skins/skin_round_silver/global.css')}}"/>

@endsection

@section('content')

<!-- Main Container -->

<main id="main-container">
	@include('kasus.layouts.header')

	<div class="content">
		<div class="row">
			@include('kasus.layouts.sidebar')

			<!-- Updates -->
			<div class="col-lg-4 col-xl-9">
				<div class="row">
					<div class="col-lg-12">
						@if(empty($kasus->pasien_id))
						<div class="block">
							<div class="block-content tab-content overflow-hidden">
								<div class="col-12 text-center py-50">
									<h4 class="font-w400 mb-5">Data pasien belum tersinkronisasi. Silahkan lakukan Sinkronisasi dahulu</h4>
								</div>
							</div>
						</div>
						@else
						<div class="block">
							<div class="block-content tab-content overflow-hidden">
								<div class="row">
									<div class="col-1">
										<img src="{{url($item->creator->avatar_thumb)}}" style="height: 50px">
									</div>
									<div class="col-8 text-left">
										<h5 class="mb-0">{{$item->creator->name}}<br>
											<small class="text-muted">{{date('d F Y H:i', strtotime($item->created_at))}}</small>
										</h5>
									</div>
									<div class="col-3 text-right">
										<a href="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang#galeri')}}" class="btn btn-info">
											Kembali ke galeri
										</a>
									</div>
								</div>
								<hr>
								<table>
									<tr>
										<td>
											<a class="btn btn-primary" href="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang/galeri/detail-img/'.$item->id)}}?action=previous"><i class="si si-arrow-left"></i>&nbsp;&nbsp;Prev Post
											</a>	
										</td>
										<td>
											<a class="btn btn-primary" href="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang/galeri/detail-img/'.$item->id)}}?action=next">Next Post&nbsp;&nbsp;<i class="si si-arrow-right"></i>
											</a>	
										</td>
									</tr>
								</table>
								<div class="row" style="padding-top: 1%">
									<div class="col-12" style="width: 100%" id="gallery-item-container">
										@if($item->file_type == 'link')
										<iframe src="{{$item->file_primary}}" width="818px" height="600px"></iframe>
										@elseif($item->file_type == 'image')
										<div id="markersAndPlaylist" style="display:none">
										 
										    <!-- info window-->
										    <ul data-info="">
										        <!-- info window HTML content-->
										    </ul>
										     
										    <!-- markers -->
										    <ul data-markers="">
										        <!-- markers  content -->
										    </ul>
										     
										</div>
										<div class="d-none d-lg-block" id="penunjangDivPC"></div>
										<div class="d-none d-md-block d-lg-none" id="penunjangDivTab"></div>
										<div class="d-sm-block d-md-none" id="penunjangDivHP"></div>
										<!-- start viewer, display:none is added in case that js is disabled! -->
										
										@elseif($item->file_type == 'video')
											<video width="818px" height="600px" controls>
												<source src="{{asset($item->file_primary)}}" type="{{mime_content_type($item->file_primary)}}">
											</video>
										@elseif($item->file_type == 'pdf')
											<iframe src="{{asset($item->file_primary)}}" width="100%" height="600px"></iframe>
										@else
									        <div class="options-container">
									            <img class="img-fluid options-item mx-auto d-block" style="max-width: 50%; max-height: 50%; cursor: pointer;" src="{{asset($item->file_thumb)}}">
									            <div class="options-overlay bg-black-op-75">
									                <div class="options-overlay-content">
									                    <h3 class="h4 text-white mb-10 text-uppercase">Preview tidak tersedia</h3>
									                    <button class="btn btn-sm btn-rounded btn-alt-info selector" onclick="popupwindow('{{asset($item->file_primary)}}','Viewer',500,500)">
									                        <i class="fa fa-pencil"></i> Lihat
									                    </button>
									                </div>
									            </div>
									        </div>
										@endif
										</div>
									</div>
									<hr>
									@if(session('my_role_'.$kasus->nomor_kasus))
									<button class="btn btn-sm btn-outline-primary pull-right" type="button" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-pencil"></i></button>
									<button class="btn btn-sm btn-outline-danger pull-right mr-5" type="button" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-trash"></i></button>
									<br>
									@endif
									<div class="show-container" style="padding-bottom: 5%">
										<h5>{{$item->judul}}</h5>
										<p style=" white-space: pre-line;">{{$item->caption}}</p>
										@foreach($item->komentar as $comment)
										<div class="block" style="background-color: #FFFFFF; padding: 8px;margin-bottom: 2px;">
											<div class="row">
												<div class="col-1">
													<img src="{{url($comment->creator->avatar_thumb)}}" style="height: 50px;">
												</div>
												<div class="col-11 text-left">
													<b>{{$comment->creator->name}}</b> <small class="text-muted"> {{date('d F Y', strtotime($comment->created_at))}}</small>
													<br>
													<textarea style="display: none;" rows="2" class="form-control" id="komentarEdit_{{$comment->id}}">{{$comment->konten}}</textarea>
													<p style="white-space: pre-line;" id="komentar_{{$comment->id}}">{{$comment->konten}}</p>
												</div>
												@if($comment->created_by == Auth::user()->id)
												<div class="col-12">
													<button style="display: none; margin-top: 1%" type="button" class="btn btn-alt-primary pull-right" onclick="simpanKomentar({{$comment->id}})" id="tombolSimpan_{{$comment->id}}">Submit</button>
												</div>
												<table style="width: 100%;" id="tabel_edit_delete_{{$comment->id}}">
													<tr>
														<td style="width: 85%"></td>
														<td style="width: 7%; text-align: right;">
															<p class="text-link"><a onclick="editKomentar('{{$comment->id}}')">Edit</a></p>
														</td>
														<td style="width: 1%; text-align: center;"><p>|</p></td>
														<td style="width: 7%">
															<p class="text-link"><a onclick="deleteKomentar('{{$comment->id}}')">Delete</a></p>
														</td>
													</tr>
												</table>
												@endif
											</div>
										</div>
										@endforeach
										@if(session('my_role_'.$kasus->nomor_kasus))
										<div class="block" style="background-color: #EEEEEE; padding: 8px; margin-bottom: 2px;">
											<div class="row">
												<div class="col-1">
													<img src="{{url(Auth::user()->avatar_thumb)}}" style="height: 50px">
												</div>
												<div class="col-11 text-left">
													<form action="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang/galeri/detail-img/'.$item->id.'/komentar')}}" method="post">
														{{csrf_field()}}
														<b>{{Auth::user()->name}} (Anda)</b><br>
														<textarea class="form-control" rows="2" placeholder="Tambahkan komentar.." name="komentar"></textarea>
													</div>
													<div class="col-12" style="padding-top: 1%">
														<button type="submit" class="btn btn-alt-primary pull-right">Submit</button>
													</div>
												</form>
											</div>
										</div>
										@endif
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
				<!-- END Updates -->
			</div>
		</div>
	</main>
	<!-- END Main Container -->    
	@if(session('my_role_'.$kasus->nomor_kasus))
	@include('kasus.penunjang.content.galeri.detail-img-modal')
	@endif
	@include('kasus.penunjang.content.galeri.create')
	<form action="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang/galeri/detail-img/deletekomentar')}}" method="post" id="deleteKomentarForm">
		{{csrf_field()}}
		<input type="hidden" name="komentarId" id="deleteKomentarId">
	</form>
	<form action="{{url('kasus/'.$kasus->nomor_kasus.'/penunjang/galeri/detail-img/updatekomentar')}}" method="post" id="updateKomentarForm">
		{{csrf_field()}}
		<input type="hidden" name="komentarId" id="updateKomentarId">
		<input type="hidden" name="komentar" id="updateKomentar">
	</form>

	@endsection

	@section('js')
	<script type="text/javascript" src="{{asset('plugins/megazoom/start/java/FWDMegazoom.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/megazoom/js/FWDUtils.js')}}"></script>
   	<script type="text/javascript" src="{{asset('plugins/jquery.media/jquery.media.js')}}"></script>
	<script type="text/javascript">
		@if($item->file_type == 'image')

			var megazoom;
			FWDUtils.onReady(function(){
			megazoom =  new FWDMegazoom({
				//----main----//
				parentId:"penunjangDivPC",
				markersAndInfoWindowId:"markersAndPlaylist",
				displayType:"responsive",
				skinPath:"{{asset('plugins/megazoom/start/skins')}}",
				imagePath:"{{asset($item->file_primary)}}",
				preloaderText:"Loading image...",
				useEntireScreen:"yes",
				addKeyboardSupport:"yes",
				addDoubleClickSupport:"yes",
				disableMouseWheel:"yes",
				autoScale:"yes",
				zoomerWidth:800,
				zoomerHeight:640,
				imageWidth:{{$dimension['width']}},
				imageHeight:{{$dimension['height']}},
				zoomFactor:1.4,
				doubleClickZoomFactor:1,
				startZoomFactor:"default",
				panSpeed:8,
				zoomSpeed:.1,
				backgroundColor:"#FFFFFF",
				preloaderFontColor:"#585858",
				preloaderBackgroundColor:"#FFFFFF",
				//----lightbox-----//
				lightBoxWidth:800,
				lightBoxHeight:550,
				lightBoxBackgroundOpacity:.8,
				lightBoxBackgroundColor:"#000000",
				//----controller----//
				buttons:"moveLeft, moveRight, moveDown, moveUp, scrollbar, hideOrShowMarkers, hideOrShowController, info, fullscreen",
				buttonsToolTips:"Move left, Move right, Move down, Move up, Zoom level: , Hide markers/Show markers, Hide controller/Show controller, Info, Full screen/Normal screen",
				controllerPosition:"bottom",
				inversePanDirection:"yes",
				startSpaceBetweenButtons:10,
				spaceBetweenButtons:10,
				startSpaceForScrollBarButtons:20,
				startSpaceForScrollBar:6,
				hideControllerDelay:3,
				controllerMaxWidth:900,
				controllerBackgroundOpacity:1,
				controllerOffsetY:0,
				scrollBarOffsetX:0,
				scrollBarHandlerToolTipOffsetY:4,
				zoomInAndOutToolTipOffsetY:-4,
				buttonsToolTipOffsetY:0,
				hideControllerOffsetY:2,
				buttonToolTipFontColor:"#585858",
				//----navigator----//

				//----info window----//
				infoWindowBackgroundOpacity:.6,
				infoWindowBackgroundColor:"#FFFFFF",
				infoWindowScrollBarColor:"#585858",
				//----markers-----//
				showMarkersInfo:"no",
				markerToolTipOffsetY:0,
				markerToolTipOffsetY:2,
				//----context menu----//
				showScriptDeveloper:"no",
				contextMenuLabels:"Move left, Move right, Move down, Move up, Zoom in/Zoom out, Hide markers/Show markers, Hide controller/Show controller, Info, Full screen/Normal screen",
				contextMenuBackgroundColor:"#d1cfcf",
				contextMenuBorderColor:"#8f8d8d",
				contextMenuSpacerColor:"#acacac",
				contextMenuItemNormalColor:"#585858",
				contextMenuItemSelectedColor:"#FFFFFF",
				contextMenuItemDisabledColor:"#b7b4b4"
			});
		})
		@endif


	// $('#lightgallery').lightGallery();

	$(document).ready(function(){
		Codebase.helpers(['select2']);
	});
	function showModal() {
		$('#modal').modal('show');
	}


	$('.lg-backdrop').click(function(){
		alert('hide');
	})

	function editPenunjang(id)
	{
		$(".show-container-"+id).hide();
		$(".edit-container-"+id).show();
	}

	function editPenunjangCancel(id)
	{
		$(".show-container-"+id).show();
		$(".edit-container-"+id).hide();
	}

	function deletePenunjang(id)
	{
		swal({
			title: "Hapus",
			text: "Apakah anda yakin akan menghapus hasil penunjnang ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value){
				$('#inputIDDelete').val(id)
				$('#formDelete').submit();
			}
		});
	}
	function deleteKomentar(id)
	{
		swal({
			title: "Hapus",
			text: "Apakah anda yakin ingin menghapus komentar ini?",
			showCancelButton: true,
			reverseButtons: true,
			type: 'warning',
			confirmButtonClass: "btn btn-danger",
			cancelButtonClass: "btn btn-default",
			confirmButtonText: "Hapus",
			cancelButtonText: "Kembali",
			closeOnConfirm: false
		}).then(function(result) {
			if(result.value){
				$('#deleteKomentarId').val(id)
				$('#deleteKomentarForm').submit();
			}
		});
	}
	function editKomentar(id)
	{
		$(`#komentar_${id}`).css('display', 'none');
		$(`#tabel_edit_delete_${id}`).css('display', 'none');
		$(`#komentarEdit_${id}`).css('display', '');
		$(`#tombolSimpan_${id}`).css('display', '');
	}
	function simpanKomentar(id)
	{
		$("#updateKomentarId").val(id);
		let komentar = document.getElementById(`komentarEdit_${id}`).value;
		$("#updateKomentar").val(komentar);
		$("#updateKomentarForm").submit();
	}


    $(function () {
    		var pdfMediaWidth = $('#gallery-item-container').width();
       	$('.media-pdf').media({width: pdfMediaWidth,height:500});
    });
</script>
@endsection