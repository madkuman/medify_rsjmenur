@extends('kepegawaian.layouts.main')

@section('title')
Master Kuisioner
@endsection

@section('subtitle')
Master Kuisioner / Pertanyaan
@endsection

@section('css')

@endsection

@section('content')
<div class="content">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				<small><a href="#" onclick="createModal()" class="pull-right">
					<i class="fa fa-plus-circle"></i> Tambah Pertanyaan</a>
				</small>
				Daftar Pertanyaan {{$kuisioner->nama}}
			</h3>
		</div>
		@php
		if(Session::has('skala')) $skala = Session::get('skala');
		else $skala = 'kosong';
		@endphp
		<input type="hidden" value="{{$skala}}" name="skala-temp">
		<div class="block-content">
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th class="text-center" style="width: 5%">No</th>
						<th class="text-center" style="width: 35%">Pertanyaan</th>
						<th class="text-center" style="width: 15%">Tipe</th>
						<th class="text-center" style="width: 35%">Pilihan Jawaban</th>
						<th class="text-center" style="width: 10%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($pertanyaan as $item)
					@php
						$val = json_decode($item->val_pilihan);
						$strval = [];
					@endphp
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$item->pertanyaan}}</td>
                        <td class="text-center">{{$val->jenis}}</td>
                        <td class="text-center">
							@foreach ($val as $key => $value )
							@php
								if ($key != 'jenis' && $key != 'id' && $key != 'default' && $key != 'dibalik' ) $strval[] = $key.': '.$value;
								else if ($key == 'default' ) $strval[] = $value;
							@endphp	
							@endforeach
							{{implode(", ",$strval)}}
						</td>
						<td class="text-center">
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-info mr-5 mb-5" onclick="editModal({{$item->id}})">
							<i class="fa fa-edit"></i></a>
							<a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
							data-toggle="modal" data-target="#deletemodal" data-id="{{$item->id}}" data-nama="Pertanyaan" data-kuisioner="{{$kuisioner->id}}">
							<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@empty
					<tr class="text-center">
						<td colspan="6">Data Pertanyaan Kosong</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="deletemodal" class="modal fade" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Hapus Data</h4>
			</div>
			<div class="modal-body">
				<p id="show-name"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a id="del-btn">
					<button type="button" class="btn btn-danger pull-right" style="margin-left: 4px ;">Hapus</button>
				</a>
			</div>
		</div>
	</div>
</div>

@include('kepegawaian.master.kuisioner.component.modal-pertanyaan')
@endsection

@section('js')


@include('kepegawaian.master.kuisioner.component.js-layout')
@include('kepegawaian.master.kuisioner.component.js-pertanyaan')

<script type="text/javascript">
	function showLayout() {
		var jenis = $('#jenis_pertanyaan').val();
		var isian = $('#isian-content');
		var layout = '';
		switch (jenis) {
			case 'pilgan':
				layout = layoutPilgan();
				isian.empty();
				isian.append(layout);
				$('#jenis_penilaian').removeClass('d-none');
				break;
			case 'skala':
				layout = layoutSkala();
				isian.empty();
				isian.append(layout);
				$('#jenis_penilaian').removeClass('d-none');
				break;
			default:
				$('#jenis_penilaian').addClass('d-none');
				isian.empty();
		}
	}

	function setSkala() {
		if ($('#set-skala').is(':checked')) {
			var val = $('input[name=skala-temp]').val();
			var valpilihan = JSON.parse(val);
			var objLenght = Object.keys(valpilihan).length;
			$('input[name=batas_skala]').val(objLenght - 2);
			var angka = 1;
			var inputValue = [];
			for(var prop in Object.values(valpilihan))
			{
				inputValue.push(valpilihan[angka]);
				angka++;
			}
			showKeterangan(inputValue);
		}
	}

	function createModal(params) {
		create_layouts = `<label class="col-12 control-label">Pertanyaan</label><br>`
		+`<div class="col-12">`
		+`<input type="text" class="form-control" name="pertanyaan" autocomplete="off" required>`
		+`</div>`;
		$("#pertanyaan_create_layout").empty();
		$("#pertanyaan_create_layout").append(create_layouts);
		$('#jenis_penilaian').addClass('d-none');
		$('#modal-title').empty();
		$('#modal-title').append('Tambah');
		$('#isian-content').empty();
		$('#modal-form').attr('action', '{{url()->current()}}/baru');
		$("#modal-form").find('input:text, input:password, input:file, select, textarea').val('');
		$('#modal-create-pertanyaan').modal('show');
	}

	function editModal(id)
	{
		edit_layouts = `<label class="col-12 control-label">Pertanyaan</label><br>`
		+`<div class="col-10">`
		+`<input type="text" class="form-control" name="pertanyaan" autocomplete="off" required>`
		+`</div>`
		+`<div class="col-2">`
		+`<label class="css-control css-control-primary css-checkbox">`
		+`<input type="checkbox" name="dibalik" class="css-control-input" value="1">`
		+`<span class="css-control-indicator"></span> Dibalik`
		+`</label>`
		+`</div>`;
		$("#pertanyaan_create_layout").empty();
		$("#pertanyaan_create_layout").append(edit_layouts);
		$.ajax({
			url: API_URL + '/kepegawaian/pertanyaan/get/'+ id,
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
				$('#modal-title').empty();
				$('#modal-title').append('Edit');
				$('#modal-form').attr('action', '{{url()->current()}}/edit');
				$("#modal-form").find('input:text, input:password, input:file, select, textarea').val('');
				$('#loading').removeClass('d-none');
				$('#form-content').addClass('d-none');
			},
			success: function(data) {
				var tipe = data.tipe;
				var pertanyaan = data.pertanyaan;
				var kuisionerid = data.kuisioner_id;
				var valpilihan = JSON.parse(data.val_pilihan);
				
				$('#kuisionerid').val(kuisionerid);
				$('#pertanyaanid').val(id);
				$('input[name=pertanyaan]').val(pertanyaan);
				$('input[name=pertanyaanid]').val(id);
				$('#jenis_pertanyaan').val(tipe);
				$('#bagian').val(data.bagian_id).trigger('change');
				if (valpilihan['dibalik'] == 1) {
					$('input[name="dibalik"]').prop('checked', true);
				}
				if (data.bobot == -1) {
					$('input[name="bobot"][value="-1"]').prop('checked', true);
				}else {
					$('input[name="bobot"][value="1"]').prop('checked', true);
				}

				$('#jenis_penilaian').addClass('d-none');
				showLayout();
				switch (tipe) {
					case 'pilgan':
						delete valpilihan['jenis'];
						delete valpilihan['dibalik'];
						var count = 0;
						var huruf = 'a';
						for(var prop in Object.values(valpilihan))
						{
							if (count > 0) {
								addPilihan(valpilihan[huruf]);
							} else {
								$('#val_pilgan_1').val(valpilihan[huruf]);
							}
							count++;
							huruf = nextChar(huruf);
						}
						break;
					case 'skala':
						delete valpilihan['jenis'];
						delete valpilihan['id'];
						delete valpilihan['dibalik'];
						var objLenght = Object.keys(valpilihan).length;
						$('input[name=batas_skala]').val(objLenght);
						var angka = 1;
						var inputValue = [];
						for(var prop in Object.values(valpilihan))
						{
							inputValue.push(valpilihan[angka]);
							angka++;
						}
						showKeterangan(inputValue);
						break;
					default:
						break;
				}

				$('#loading').addClass('d-none');
				$('#form-content').removeClass('d-none');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest, textStatus, errorThrown);
			},
		});

		$('#modal-create-pertanyaan').modal('show');
	}

	$(document).on("click",".btn-outline-danger", function () {
		var id = $(this).data('id')
		var nama = $(this).data('nama');
		var kuisioner = $(this).data('kuisioner');
		console.log(id,nama);
		$("#del-btn").attr('href','{{url("kepegawaian/master/kuisioner/")}}'+ '/' + kuisioner + '/pertanyaan' + '/' + id + '/hapus')
		$("#show-name").html('Anda yakin ingin menghapus data ' + nama + '?')
	})
</script>
@endsection