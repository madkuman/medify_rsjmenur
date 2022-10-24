@extends('kepegawaian.layouts.main-profile')

@section('title')
  Kepegawaian | Surat Peringatan
@endsection

@section('subtitle')
  DATA SURAT PERINGATAN
@endsection

@section('main-content')
<div class="card">
  <div class="card-body px-20">
    <div class="col-12 my-20">
      <div class="row">
        <div class="col-12 text-right float-right">
          @if($is_hrd_member)
          <button id="button-add-family" type="button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-family">
            <i class="fa fa-plus mr-5 mb-10"></i> Tambah
          </button>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-30">
          <h5 class="card-title font-w400">DATA SURAT PERINGATAN</h5>
          <hr>
          <div class="table-responsive-md">
            @if($items->count() < 1)
              <p>Tidak ada data</p>
            @else
              @include('kepegawaian.layouts.partials.pagination')
              <table id="table-family" class="table table-striped table-hover mt-10"> 
                <thead>
                  <tr>
                    <th style="width: 5%" class="align-middle text-center">No</th>
                    <th style="width: 12%" class="align-middle text-center">Jenis Surat</th>
                    <th style="width: 10%" class="align-middle text-center">Taggal Surat</th>
                    <th style="width: 10%" class="align-middle text-center">No Surat</th>
                    <th style="width: 13%" class="align-middle text-center">Judul Surat</th>
                    <th style="width: 8%" class="align-middle text-center">Konten Surat</th>
                    <th style="width: 10%" class="align-middle text-center">Upload File</th>
                    <th style="width: 12%" class="align-middle text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $key => $item)
                  @php
                      $stringCut = substr($item->konten_surat, 0, 50);
                  @endphp
                    <tr>
                      <td>{{$key+1}}</td>
                      <td style="text-align: center" >{{$item->masterJenisSuratPeringatan->nama}}</td>
                      <td style="text-align: center" >{{$item->date_format}}</td>
                      <td style="text-align: center" >{{$item->no_surat}}</td>
                      <td style="text-align: center" >{{$item->judul_surat}}</td>
                      <td style="text-align: center; text-align: justify; " >{!! $stringCut !!}...</td>
                      <td style="text-align: center" >{{$item->nama_file}}</td>
                      <td style="text-align: center">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opsi</button>
                          <div class="dropdown-menu" aria-labelledby="btn_dropdown_kasus">
                            <a type="button" class="dropdown-item" href="{{route('print-pdf',['id' => $item->id])}}" target="_blank">Print Konten Surat</a>
                            <a class="dropdown-item" type="button" href="{{route('download-file', $item->id)}}">Print File Surat</a>
                            <a href="#modal-edit" class="dropdown-item" data-url="{{route('get-surat_peringatan', $item->id)}}" 
                              data-toggle="modal" id="btn-edit" >Edit</a>
                            <a href="#modal_delete" class="dropdown-item" data-url="{{route('delete-surat_peringatan', $item->id)}}" 
                              data-toggle="modal" id="btn-delete" >Hapus</a>
                          </div>
                      </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @include('kepegawaian.layouts.partials.pagination_bottom')
            @endif
          </div>
        </div>
      </div>

      <!-- modal -->
      @include('kepegawaian.pegawai.surat-peringatan.manage')
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<!-- All javascript function's files are included at main layout -->
<script type="text/javascript">
  $(document).ready(function(){
		$('.btn-spin').hide();
		})

		$(document).on("click",".btn-submit", function () {
			$('.btn-spin').show();
		})
		$(document).on("click",".btn-delete", function () {
			$('.btn-spin').show();
		})

		$(document).on("click",".btn-batal", function () {
			$('.btn-spin').hide();
		})

 var konten = document.getElementById("konten_surat");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
 
  var edit_konten = document.getElementById("edit_konten_surat");
    CKEDITOR.replace(edit_konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;

  $(document).ready(function(){
    var name = 'Data Surat Peringatan';

    jsSelect2();
    
    //ADD MODAL
    //using combodate as datepicker
    $('#tanggal_surat').datepicker({format: "yyyy-mm-dd",autoclose:true}).datepicker('setDate', new Date()); 
    $('#edit_tanggal_surat').datepicker({format: "yyyy-mm-dd",autoclose:true}).datepicker('setDate', new Date()); 

    $('#button-add-surat').on('click', function() {
      saveAlert(1, '#form-add-family','', name, '');
    });
    $('#button_edit_surat').on('click', function() {
      saveAlert(1, '#form-edit-surat','', name, '');
    });

    //DISPLAY DATA IN EDIT MODAL
    $(document).on('click','#btn-edit', function(){
      var url = $(this).data('url');
      getData(url);
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form-edit-surat').attr('action',url);
    })

    function getData(url) {
      $.ajax({
        type: "GET",
        url: url,
        beforeSend:function() {
					$('#loading').removeClass('d-none');
					$('#edit-content').addClass('d-none');
				},
        success: function(data){
          $('#form-edit-surat #jenis_surat').val(data.master_jenis_surat_peringatan.id).trigger('change');
          $('#form-edit-surat #edit_tanggal_surat').val(data.tanggal_surat);
          $('#form-edit-surat #no_surat').val(data.no_surat);
          $('#form-edit-surat #judul_surat').val(data.judul_surat);
          CKEDITOR.instances['edit_konten_surat'].setData(data.konten_surat);
          $('#loading').addClass('d-none');
				  $('#edit-content').removeClass('d-none');
        },
      });
    }
    
    //DELETE CONFIRMATION
    $(document).on("click","#btn-delete", function () {
			var url = $(this).data('url');
			$(".selected").removeClass("selected");
			$(this).parent().parent().addClass("selected");
			$('#form_delete').attr('action',url);
			$("#show-name").html('Anda yakin ingin menghapus data surat peringatan');

		})
  });
</script>
@endsection