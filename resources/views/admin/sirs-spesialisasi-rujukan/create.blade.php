@extends('layouts.main-dashboard')

@section('title')
Admin - Input SIRS Spesialisasi Rujukan Baru
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
				Input SIRS - Spesialisasi Rujukan Baru
				@else
				Edit SIRS - Spesialisasi Rujukan
				@endif
			</h3>
		</div>
		<div class="block-content">
			<!--ketika dikoding ini diganti ya action sama methodnya -->
			<form action="{{url('admin/sirs-spesialisasi-rujukan/simpan')}}" method="POST">
				{{csrf_field()}}
				@if(!empty($data))
				<input type="hidden" name="id" value="{{$data->id}}">
				@endif			
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label>Nama Spesialisasi Rujukan</label>
							<input type="text" class="form-control" placeholder="Nama Spesialisasi" name="nama" 
							@if(!empty($data))
							value="{{$data->nama}}"
							@endif autocomplete="off">
						</div>
						<div class="form-group text-center">
							<button type="button" id="show-icd" class="btn btn-rounded btn-outline-info">
								<i class="fa fa-plus mr-5"></i>Tambah ICD 10
							</button>
						</div>
						<div class="d-none" id="hide-icd">
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
						<div class="form-group pt-50">
							<button class="btn btn-info btn-hero pull-right">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	@if(!empty($data))
	<div class="block p-10">
		<div class="block-content">
			<h5>Daftar ICD 10 - Spesialisasi Rujukan {{$data->nama}}</h5>
			<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($icd as $isi)
					<tr>
						<td class="font-w600">{{$isi->diagnosis->code_icd}} - {{$isi->diagnosis->long_desc}}</td>
						<td class="">
							<a href="#deletemodal" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5"
							data-toggle="modal" data-id="{{$isi->id}}" data-nama="{{$isi->diagnosis->long_desc}}">
							<i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
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
		pageLength: 15,
		lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
		autoWidth: false
	});

	$("#show-icd").click(function(e){
		$(`#show-icd`).addClass("d-none");
		$(`#hide-icd`).removeClass("d-none");
	});

	function deleteModal(id)
	{
		swal({
			title: 'Apakah Anda Yakin?',
			text: "ICD 10 akan terhapus dari daftar ini",
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
	$(document).on("click",".btn-outline-danger", function () {
		var id = $(this).data('id')
		var nama = $(this).data('nama');
		console.log(id,nama);
		$("#del-btn").attr('href','{{url('admin/sirs-spesialisasi-rujukan/delete-icd10')}}' + '/' + id)
		$("#show-name").html('Anda yakin ingin menghapus data ICD 10 ' + nama + '?')

	})

	jQuery( function() {
		AutoCompleteCreateDiagnosis.init();
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
</script>

@endsection