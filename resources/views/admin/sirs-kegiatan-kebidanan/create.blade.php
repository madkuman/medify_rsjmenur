@extends('layouts.main-dashboard')

@section('title')
Admin - Input SIRS Kegiatan Kebidanan Baru
@endsection

@section('css')

@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<div class="content" style="margin-top:50px;">
	<div class="block p-10">
		<div class="block-header">
			<h3 class="block-title">
				@if(empty($data))
				Input SIRS - Kegiatan Kebidanan Baru
				@else
				Edit SIRS - Kegiatan Kebidanan
				@endif
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('admin/sirs-kegiatan-kebidanan/simpan')}}" method="POST">
			{{csrf_field()}}
			@if(!empty($data))
			<input type="hidden" name="id" value="{{$data->id}}">
			@endif			
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nomor Kode Kegiatan</label>
							<input type="text" class="form-control" placeholder="Nomor Kode Kegiatan" name="nomor" 
							@if(!empty($data))
							value="{{$data->nomor}}"
							@endif autocomplete="off">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Kegiatan</label>
							<input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama" 
							@if(!empty($data))
							value="{{$data->nama}}"
							@endif autocomplete="off">
						</div>
					</div>
				</div>
				<div class="row d-none" id="hide-icd-9">
					<div class="col-6">
                        <div class="form-group row icd9-class">
                            <label class="col-12" for="">Tambah ICD 9 Baru</label>
                            <div class="col-12">
                                <input type="text" class="tindakan-icd9-autocomplete form-control" id="tindakan-icd9-text"  name="desc_icd" placeholder="Ketikkan Tindakan..." value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="">
							<div class="">
                            	<input type="hidden" name="icd_9" id="icd_9">
                            </div>
                        </div>
					</div>
				</div>
				<div class="row d-none" id="hide-icd-10">
					<div class="col-6">
						<div class="form-group">
							<label>Tambah ICD 10 Baru</label>
							<input type="text" class="diagnosis-autocomplete form-control" id="nama-diagnosis" name="nama-diagnosis" placeholder="Ketikkan diagnosis...">
							<span id="diagnosis_error_wrapper"></span>
						</div>
						<div class="">
							<div class="">
								<input type="hidden" class="form-control form-control-lg" id="id-diagnosis" name="id-diagnosis" placeholder="" value="">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group text-center">
							<button type="button" id="show-icd-9" class="btn btn-rounded btn-outline-info mx-5">
								<i class="fa fa-plus mr-5"></i>Tambah ICD 9
							</button>
							<button type="button" id="show-icd-10" class="btn btn-rounded btn-outline-success mx-5">
								<i class="fa fa-plus mr-5"></i>Tambah ICD 10
							</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group pt-50">
							<button class="btn btn-info btn-hero pull-right">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	@if(!empty($data))
	<div class="row mx-0">
		<div class="col-6 pl-0 pr-5">
			<div class="block">
				<div class="block-content px-0">
					<h5 class="pl-20">Daftar ICD 9 - Spesialisasi Rujukan {{$data->nama}}</h5>
					<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($icd_9 as $isi)
							<tr>
								<td class="font-w600">{{$isi->tindakan->code_icd}} - {{$isi->tindakan->long_desc}}</td>
								<td class="">
									<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger delete-icd9 mr-5 mb-5"
									data-toggle="modal" data-id="{{$isi->id}}" data-nama="{{$isi->tindakan->long_desc}}">
									<i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-6 pr-0 pl-5">
			<div class="block">
				<div class="block-content px-0">
					<h5 class="pl-20">Daftar ICD 10 - Spesialisasi Rujukan {{$data->nama}}</h5>
					<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($icd_10 as $isi)
							<tr>
								<td class="font-w600">{{$isi->diagnosis->code_icd}} - {{$isi->diagnosis->long_desc}}</td>
								<td class="">
									<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger delete-icd10 mr-5 mb-5"
									data-toggle="modal" data-id="{{$isi->id}}" data-nama="{{$isi->diagnosis->long_desc}}">
									<i class="fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif
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
@endsection

@section('js')



<script type="text/javascript">
	jQuery('.js-dataTable-full').dataTable({
		"ordering": true,
		pageLength: 8,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false,
		"searching": false
	});

	$("#show-icd-10").click(function(e){
		$(`#show-icd-10`).addClass("d-none");
		$(`#hide-icd-10`).removeClass("d-none");
	});

	$("#show-icd-9").click(function(e){
		$(`#show-icd-9`).addClass("d-none");
		$(`#hide-icd-9`).removeClass("d-none");
	});

	function deleteModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "Kegiatan Kebidanan akan terhapus dari daftar",
			type: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'btn btn-secondary',
			cancelButtonClass: 'btn btn-danger',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.value) {
				swal(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
			}
		})

	}
	$(document).on("click",".delete-icd9", function () {
        var id = $(this).data('id')
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/sirs-kegiatan-kebidanan/delete-icd9')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data ICD 9 Kegiatan Kebidanan :<br><b>' + nama + '</b>?')

    })
    $(document).on("click",".delete-icd10", function () {
        var id = $(this).data('id')
        var nama = $(this).data('nama');
        console.log(id,nama);
        $("#del-btn").attr('href','{{url('admin/sirs-kegiatan-kebidanan/delete-icd10')}}' + '/' + id)
        $("#show-name").html('Anda yakin ingin menghapus data ICD 10 Kegiatan Kebidanan :<br><b>' + nama + '</b>?')

    })

    jQuery( function() {
		AutoCompleteCreateDiagnosis.init();
		AutoCompleteCreateTindakanICD9.init();
	});

	var AutoCompleteCreateDiagnosis = function() {

		var ListLayanan = {};
        //console.log(ListLayanan)

        var initAutoComplete = function(){
        	jQuery('.diagnosis-autocomplete').autoComplete({
        		minChars: 2,
        		source: function(term, suggest){
        			term = term.toLowerCase();

        			$.ajax({
        				url: API_URL+"/kasus/get/list/diagnosis?keyword="+term,
        				type: 'GET',
        				dataType: 'json',
        				tryCount : 0,
        				retryLimit : 3,
        				beforeSend: function(){
        					$('#diagnosis_error_wrapper').hide();
        				},
        				success: function(response) {
        					data = response.data
        					if(data.length > 0){
        						for (i = 0; i < data.length; i++) {
        							var suggestword = data[i].code_icd+" - "+data[i].long_desc;
        							ListLayanan[suggestword] = data[i];
        							suggestions.push(suggestword);
        							var suggestword = {};
        						}
        						suggest(suggestions);
        					}
        					else
        					{
        						$('#diagnosis_error_wrapper').text('Diagnosis tidak ditemukan, gunakan keyword lain').show();
        					}
        				},
        				error: function() {
        					this.tryCount++;
        					if (this.tryCount <= this.retryLimit) {
        						$.ajax(this);
        						return;
        					}            
        					return;
        				},
        			});

        			var suggestions    = [];


        		},
        		onSelect: function(event, term, item) {
        			var text = ListLayanan[term].code_icd + " - " + ListLayanan[term].long_desc
        			$("#nama-diagnosis").val(text);
        			$("#id-diagnosis").val(ListLayanan[term].id)
        			$('#submit-create-diagnosis').prop('disabled',false);
                    //$("#tindakan-input-edit-daftar-id").val(ListLayanan[term].id);
                }
            });
        };

        return {
        	init: function () {
        		initAutoComplete();
        	}
        };
    }();

    var AutoCompleteCreateTindakanICD9 = function() {

        var ListLayanan = {};

        var initAutoComplete = function(){
            jQuery('.tindakan-icd9-autocomplete').autoComplete({
                minChars: 3,
                delay : 750,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    
                    var search_tindakan_url = API_URL+"/kasus/get/list/icd9?keyword="+term
                    $.ajax({
                        url: search_tindakan_url,
                        type: 'GET',
                        dataType: 'json',
                        tryCount : 0,
                        retryLimit : 3,
                        success: function(response) {
                            data = response.data
                            for (i = 0; i < data.length; i++) {
                                var suggestword = data[i].code_icd+" - "+data[i].long_desc;
                                ListLayanan[suggestword] = data[i];
                                suggestions.push(suggestword);
                                var suggestword = {};
                            }
                            suggest(suggestions);
                        },
                        error: function() {
                            this.tryCount++;
                            if (this.tryCount <= this.retryLimit) {
                                $.ajax(this);
                                return;
                            }            
                            return;
                        },
                    });

                    var suggestions    = [];


                },
                onSelect: function(event, term, item) {
                    var text = ListLayanan[term].code_icd + " - " + ListLayanan[term].long_desc
                    $("#tindakan-icd9-text").val(text);
                    $("#icd_9").val(ListLayanan[term].id);
                    $("#submit-create-tindakan").prop('disabled',false);
                }
            });
        };

        return {
            init: function () {
                initAutoComplete();
            }
        };
    }();
</script>

@endsection