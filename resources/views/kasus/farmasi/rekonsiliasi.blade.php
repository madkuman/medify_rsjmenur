@extends('kasus.layouts.main')
@section('title')
{{$kasus->judul_kasus}} - Rekonsiliasi Obat - Kasus
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

							<div class="block-content px-20 pt-50">
								<div class="row">
									<div class="col-12">
										<button type="button" class="btn-alt btn-primary min-width-125 pull-right openFormBtn" data-id="" data-method="create"><i class="fa fa-pencil mr-5"></i>Form Rekonsiliasi Obat Baru</button>
										<span data-toggle="modal" data-target="#addTTDPasien"><button type="button" class="btn-alt btn-primary min-width-125" data-id=""><i class="fa fa-signature"></i>Tanda Tangan Pasien</button></span>
										<a href="{{url()->current()}}/print" type="button" class="btn-alt btn-secondary min-width-125 pull-right" target="_blank"><i class="fa fa-print mr-5"></i>Print Rekonsiliasi Obat</a>
									</div>
								</div>

								@php $count = count($rekon) @endphp
								@forelse($rekon as $rekon_item)
								<hr>
								<div class="row">
									<div class="col-12 ">
										<div class="p-10">
											<div class="row">
												<div class="col-6 pt-5">
													<h5 class=" mb-0">Rekonsiliasi Obat {{$count--}} : {{$rekon_item->judul ?? '-'}} </h5>
													<small>Dibuat Oleh : {{$rekon_item->creator->name ?? '-'}} | {{indonesian_date($rekon_item->created_at)}}</small>
												</div>
												<div class="col-6">
													<button  class="btn btn-secondary mr-5 mb-5 pull-right viewBtn" data-id="{{$rekon_item->id}}"  >
														<i class="fa fa-search"></i> Lihat Selengkapnya
													</button>
													<button  class="btn btn-secondary mr-5 mb-5 pull-right openFormBtn" data-method="edit" data-id="{{$rekon_item->id}}"  >
														<i class="fa fa-pencil"></i>
													</button>
													<button  class="btn btn-secondary mr-5 mb-5 pull-right deleteBtn" data-id="{{$rekon_item->id}}" >
														<i class="fa fa-trash"></i>
													</button>
												</div>
											</div>

										</div>
									</div>
								</div>
								@empty
								<div class="row">
									<div class="col-12">
										<div class="text-center py-50">
											<h4 class="font-w400 mb-5">Belum ada asesmen Rekonsiliasi Obat tersedia</h4>
											<p>Klik tombol <b>Form Rekonsiliasi Obat Baru</b> untuk melakukan asesmen Rekonsiliasi Obat Pasien</p>
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
<form method="POST" action="{{url()->current()}}/delete" id="formDelete">
	{{csrf_field()}}
	<input name="id" type="hidden" id="deleteInputId">
</form>
@include('kasus.farmasi.modal.rekonsiliasi-form')
@include('kasus.farmasi.modal.rekonsiliasi-view')
@include('kasus.farmasi.modal.rekonsiliasi-ttd-pasien')
@endsection


@section('js')
<script type="text/javascript">
	var rekon_awal_id = "{{$rekonsiliasi_awal}}";

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


	$('#addFormButton').click(function(){
		addEmptyForm()
	})

	$('.openFormBtn').click(function(){
		var method = $(this).data('method')

		if(method == 'create')
		{
			$('#modalForm .input-jenis').val("awal")
			$('#modalForm .input-judul').val("")

			$('#modalForm .input-id').val("")
			$('#rekonsiliasi-form-table tbody').empty()
			addEmptyForm()
		}
		else
		{
			$('#rekonsiliasi-form-table tbody').empty()
			var id = $(this).data('id');
			$('#modalForm .input-id').val(id)
			var view_data = rekon_data[id]
			var text_jenis = '';
			var table_tr = '';

			$('#modalForm .input-jenis').val(view_data.jenis)
			$('#modalForm .input-judul').val(view_data.judul)

			$.each( view_data.details, function( key, item ) {
				table_tr = getContentForm(item)
				$('#modalForm table tbody').append(table_tr)

			});
			initAutoComplete()

			
		}
		$('#modalForm').modal('show')
	})

	$('.btn-import-data-rekon-awal').click(function(){
			var id = rekon_awal_id;
			var view_data = rekon_data[id]
			var text_jenis = '';
			var table_tr = '';

			$.each( view_data.details, function( key, item ) {
				table_tr = getContentForm(item)
				$('#modalForm table tbody').append(table_tr)

			});
			initAutoComplete()
	})

	$('.btn-import-data-resep').click(function(){
			$.each( resep_histori_data, function( key, item ) {
				table_tr = getContentForm(item)
				$('#modalForm table tbody').append(table_tr)
			});
			initAutoComplete()
	})

	$('.btn-import-data-resep-pulang').click(function(){
			$.each( resep_pulang_data, function( key, item ) {
				table_tr = getContentForm(item)
				$('#modalForm table tbody').append(table_tr)
			});
			initAutoComplete()
	})





	$(document).on('click', '.removeFormRow', function(){ 
		$(this).parent().parent().empty();
	});

	$('.viewBtn').click(function(){
		$('#modalView table tbody').empty()
		var id = $(this).data('id');
		var view_data = rekon_data[id]
		var text_jenis = '';
		var table_tr = '';
		if(view_data.jenis == 'awal') text_jenis = 'Awal Pasien MRS'
		else if(view_data.jenis == 'transfer') text_jenis = 'Transfer Pasien'
		else if(view_data.jenis == 'pulang') text_jenis = 'Pasien Pulang'

		$('#modalView .el-judul').text(view_data.judul)
		$('#modalView .el-jenis').text(text_jenis)

		$.each( view_data.details, function( key, item ) {
			table_tr = getContentView(item)
			$('#modalView table tbody').append(table_tr)

		});

		$('#modalView').modal('show')
	})

	function addEmptyForm(){
		var data = {
			tanggal:"", 
			obat_nama:"", 
			obat_id:"", 
			dosis:"", 
			jumlah:"", 
			rute:"",
			kategori_sediaan:"",
			aturan_pakai:"", 
			diteruskan_dosis:"", 
			diteruskan_aturan_pakai:"", 
			dihentikan:"", 
			asal_obat:""
		};
		
		content = getContentForm(data)
		$('#rekonsiliasi-form-table tbody').append(content)
		initAutoComplete()

	}

	function getContentView(data)
	{
		var content = `
			<tr>
				<td>`+data.tanggal+`</td>
				<td>`+data.obat_nama+`</td>
				<td>`+data.dosis+`</td>
				<td>`+data.jumlah+`</td>
				<td>`+data.rute+`</td>
				<td>`+data.kategori_sediaan+`</td>
				<td>`+data.aturan_pakai+`</td>
				<td>`+data.diteruskan_dosis+`</td>
				<td>`+data.diteruskan_aturan_pakai+`</td>
				<td>`+data.dihentikan+`</td>
				<td>`+data.asal_obat+`</td>
			</tr>
		`

		return content
	}


	function getContentForm(data){

		var content = `
			<tr>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="tanggal[]" class="form-control js-datepicker" autocomplete="off" value="`+data.tanggal+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="obat_nama[]" class="form-control obat-autocomplete" value="`+data.obat_nama+`" required>
						<input type="hidden" name="obat_id[]" class="form-control input-obat-id" value="`+data.obat_id+`">
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="dosis[]" class="form-control" value="`+data.dosis+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="jumlah[]" class="form-control" value="`+data.jumlah+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="rute[]" class="form-control" value="`+data.rute+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="kategori_sediaan[]" class="form-control" value="`+data.kategori_sediaan+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="aturan_pakai[]" class="form-control" value="`+data.aturan_pakai+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="diteruskan_dosis[]" class="form-control" value="`+data.diteruskan_dosis+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="diteruskan_aturan_pakai[]" class="form-control" value="`+data.diteruskan_aturan_pakai+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="dihentikan[]" class="form-control" value="`+data.dihentikan+`" required>
					</div>
				</td>
				<td>
					<div class="col-12 px-0">
						<input type="text" name="asal_obat[]" class="form-control" value="`+data.asal_obat+`" required>
					</div>
				</td>
				<td class="text-center">
					<button class="btn btn-outline-danger btn-circle removeFormRow" type="button">
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
		`;

		return content
	}
	

	var ItemObat = {};
    var typingTimer2;
    var doneTypingInterval2 = 2000;  
    $('.obatLoading').hide();   
    var currentSelectedItem;   
    var currentSelectedItemName;  

    function searchResep(search_url,suggestions,suggest, term)
    {   
        currentSelectedItem = '';
        $.ajax({
            url: search_url,
            type: 'GET',
            data: {
                keyword : term
            },
            dataType: 'json',
            success: function(response) {
                data = response.data
                for (i = 0; i < data.length; i++) {
                    var suggestword = data[i].nama;
                    suggestions.push(suggestword);
                    ItemObat[suggestword] = data[i];
                }
                suggest(suggestions);
                $('.obatLoading').hide();
            },
            error: function() {
            },
        });

    }
    function initAutoComplete(){
    	$('.obat-autocomplete').autoComplete({
    		minChars: 3,
    		source: function(term, suggest){
    			term = term.toLowerCase();
    			var search_url = API_URL+"/gudang/item/get"
    			var suggestions    = [];
    			$('.obatLoading').show();
    			clearTimeout(typingTimer2); 
    			typingTimer2 = setTimeout(searchResep(search_url,suggestions,suggest, term), doneTypingInterval2);
    		},
    		onSelect: function(event, term,item) {
    			clearTimeout(typingTimer2); 
    			var selected = ItemObat[term]
    			currentSelectedItem = ItemObat[term].id;
    			item.parent().find('.input-obat-id').val(currentSelectedItem)
    			currentSelectedItemName = term;  
    		}
    	});
    	$('.obat-autocomplete').change(function (){
    		if($(this).val() != currentSelectedItemName)
    			$(this).parent().find('.input-obat-id').val('')
    		else
    			$(this).parent().find('.input-obat-id').val(currentSelectedItem)
    	})

    	$('.js-datepicker').datepicker({
    		weekStart: 0,
    		autoclose: true,
    		todayHighlight: true,
    		orientation: 'bottom',
    		format: "dd-mm-yyyy"
    	});
    }

    var rekon_data = [];
    var resep_histori_data = [];
    var resep_pulang_data = [];
    initData();

    function initData(){
		var rekon_temp = {}
		var detail_temp = {}
		var array_detail_temp = [];
	    @foreach($rekon as $rekon_item)
	    	array_detail_temp = [];
			rekon_temp = {}
			detail_temp = {}

	    	rekon_temp = {
	    		id : "{{$rekon_item->id}}",
	    		judul : "{{$rekon_item->judul}}",
	    		jenis : "{{$rekon_item->jenis}}"
	    	}

	    	@foreach($rekon_item->details as $detail)
	    	detail_temp = {
	    		tanggal : "{{Carbon\Carbon::parse($detail->tanggal)->format('d-m-Y')}}",
	    		obat_nama : "{{$detail->obat_nama}}",
	    		obat_id : "{{$detail->obat_id}}",
	    		dosis : "{{$detail->dosis}}",
	    		jumlah : "{{$detail->jumlah}}",
	    		rute : "{{$detail->rute}}",
	    		kategori_sediaan : "{{$detail->kategori_sediaan}}",
	    		aturan_pakai : `{{$detail->aturan_pakai}}`,
	    		diteruskan_dosis : "{{$detail->diteruskan_dosis}}",
	    		diteruskan_aturan_pakai : "{{$detail->diteruskan_aturan_pakai}}",
	    		dihentikan : "{{$detail->dihentikan}}",
	    		asal_obat : "{{$detail->asal_obat}}"
	    	}
	    	array_detail_temp.push(detail_temp);
	    	@endforeach

	    	rekon_temp.details = array_detail_temp;
	    	rekon_data["{{$rekon_item->id}}"] = rekon_temp;
	    @endforeach

	    @foreach($reseps as $resep)
	    	@foreach($resep->resepDetail as $detail)
			detail_temp = {}
	    	detail_temp = {
	    		tanggal : "{{Carbon\Carbon::parse($detail->created_at)->format('d-m-Y')}}",
	    		obat_nama : "{{$detail->obat_name}}",
	    		obat_id : "{{$detail->obat_id}}",
	    		dosis : "{{ $detail->item_template->kekuatan_sediaan ?? '' }} {{ $detail->item_template->satuan_kekuatan->nama ?? '' }}",
	    		jumlah : "{{$detail->jumlah}}",
	    		rute : "{{ $detail->item_template->rute->nama ?? '' }}",
	    		kategori_sediaan : "{{ $detail->item_template->satuan ?? '' }}",
	    		aturan_pakai : `{{$detail->aturan}}`,
	    		diteruskan_dosis : "{{ $detail->item_template->kekuatan_sediaan ?? '' }} {{ $detail->item_template->satuan_kekuatan->nama ?? '' }}",
	    		diteruskan_aturan_pakai : "",
	    		dihentikan : "-",
	    		asal_obat : "Rumah Sakit"
	    	}
	    	resep_histori_data.push(detail_temp);
	    	@endforeach
	    @endforeach

	    @foreach($resep_pulang as $resep)
	    	@foreach($resep->resepDetail as $detail)
			detail_temp = {}
	    	detail_temp = {
	    		tanggal : "{{Carbon\Carbon::parse($detail->created_at)->format('d-m-Y')}}",
	    		obat_nama : "{{$detail->obat_name}}",
	    		obat_id : "{{$detail->obat_id}}",
	    		dosis : "{{ $detail->item_template->kekuatan_sediaan ?? '' }} {{ $detail->item_template->satuan_kekuatan->nama ?? '' }}",
	    		jumlah : "{{$detail->jumlah}}",
	    		rute : "{{ $detail->item_template->rute->nama ?? '' }}",
	    		kategori_sediaan : "{{ $detail->item_template->satuan ?? '' }}",
	    		aturan_pakai : `{{$detail->aturan_pakai}}`,
	    		diteruskan_dosis : "{{ $detail->item_template->kekuatan_sediaan ?? '' }} {{ $detail->item_template->satuan_kekuatan->nama ?? '' }}",
	    		diteruskan_aturan_pakai : "",
	    		dihentikan : "-",
	    		asal_obat : "Rumah Sakit"
	    	}
	    	resep_pulang_data.push(detail_temp);
	    	@endforeach
	    @endforeach


	}
</script>

<script type="text/javascript">
	// Canvas TTD Pasien

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
		// use the identity matrix while clearing the canvas
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
	// Submit TTD Pasien
	
	function ajaxSubmit(){
		// var id = $('#edukasi-id').val();
    	var nama = $('#nama-pasien').val();
    	var imgUrl = saveImg();

    	$('#buttonSubmit').hide();
        $('#buttonLoading').show();

    	var formData = new FormData();
    	// formData.append('id', id);
    	formData.append('nama', nama);
    	formData.append('imgBase64', imgUrl);

    	$.ajax({
            type: "POST",
            url: API_URL + "/kasus/{{$kasus->nomor_kasus}}/farmasi/rekonsiliasi/ttd/save",
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
