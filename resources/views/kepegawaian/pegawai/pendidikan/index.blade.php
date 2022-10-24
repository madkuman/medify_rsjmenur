@extends('kepegawaian.layouts.main-profile')

@section('title')
Kepegawaian | Pendidikan
@endsection

@section('subtitle')
Data Pendidikan
@endsection

@section('main-content')
<div class="card">
  <div class="card-body px-20">
    <div class="col-12 my-20">
      <div class="row">
        <div class="col-lg-12 col-12">
          <div class="row">
            <div class="col-12 text-right float-right">
              {{-- <button type="button" id="edu-add-button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-pend-umum">
                <i class="fa fa-plus mr-5 mb-10"></i> Tambah
              </button> --}}
              <a href="javascript:void(0)" class="btn-add btn btn-alt-primary pull-right"><i class="fa fa-plus mr-5 mb-10"></i> Tambah</a>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-30">
              <h5 class="card-title font-w400">PENDIDIKAN</h5>
              <hr>
              <div class="table-responsive-md">
                @if($items->total() < 1)
                  <p>Tidak ada data</p>
                @else
                  @include('kepegawaian.layouts.partials.pagination')
                  <table id="table-education" class="table table-striped table-hover mt-10">
                    <thead>
                      <tr>
                        <th style="width: 5%" class="text-center align-middle">No</th>
                        <th style="width: 25%" class="text-center align-middle">Nama Pendidikan</th>
                        <th style="width: 30%" class="text-center align-middle">Institusi</th>
                        <th style="width: 25%" class="text-center align-middle">Tanggal Lulus</th>
                        <th style="width: 15%" class="text-center align-middle">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items->getCollection() as $key => $item)
                      <tr>
                        <td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                        <td class="">{{ !empty($item->nama) ? $item->nama : '—' }}<br>
                          <span class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success'}}">{{ $item->status == 0 ? 'Belum Diverifikasi' : 'Sudah diverifikasi' }}</span>
                          <span class="nama hide">{{$item->nama}}</span>
                          <span class="jenis hide">{{$item->jenisPendidikan[0]->id}}</span>
                          <span class="strata hide">{{$item->strataPendidikan[0]->id}}</span>
                        </td>
                        <td class="text-center">{{ !empty($item->institusiPendidikan) ? $item->institusiPendidikan[0]->nama : '-' }}
                          <span class="institusi hide">{{$item->institusiPendidikan[0]->id}}</span>
                          <span class="nama-institusi hide">{{$item->institusiPendidikan[0]->nama}}</span>
                        </td>
                        <td class="">{{ !empty($item->tgl_lulus)  ? $item->tgl_lulus  : '-' }}
                          <span class="masuk hide">{{$item->tgl_masuk}}</span>
                          <span class="lulus hide">{{$item->tgl_lulus}}</span>
                        </td>

                        <td class="d-flex justify-content-center">
                          {{-- <button type="button" class="btn btn-alt-warning btn-sm mr-5 detail-pendidikan-button" data-id="{{ $item->id }}" title="Lihat Detail"><i class="fas fa-search-plus"></i></button> --}}
                          <a href="javascript:void(0)" class="btn-detail btn btn-alt-warning btn-sm mr-5 pull-right" data-id="{{$item->id}}" data-status="{{$item->status}}"><i class="fas fa-search-plus"></i></a>
                          @if($item->certificate)
                            <a href="{{route('education-file', ['emp' => $item->pegawai_id, 'id' => $item->certificate])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
                          @else
                            <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Sertifikat">
                            <i class="fa fa-file"></i></button>
                          @endif
                            <a href="javascript:void(0)" class="btn btn-alt-warning btn-sm mr-5 btn-edit" data-id="{{$item->id}}">
                            <i class="fa fa-edit"></i></a>
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
        </div>
      </div>
      {{-- <div class="row">
        <div class="col-lg-6 col-12">
          <div class="row">
            <div class="col-12 text-right float-right">
              <button type="button" id="miliedu-add-button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-pend-militer">
                <i class="fa fa-plus mr-5 mb-10"></i> Tambah
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-30">
              <h5 class="card-title font-w400">PENDIDIKAN MILITER</h5>
              <hr>
              <div class="table-responsive-md">
                @if($items2->total() < 1)
                  <p>Tidak ada data</p>
                @else
                  <div class="items-info">
                    Menampilkan <code>{{ (($items2->currentPage()-1)*$items2->perPage())+1 }}</code>-<code>{{ (($items2->currentPage())*$items2->perPage()) > $items2->total() ? $items2->total() : (($items2->currentPage())*$items2->perPage()) }}</code> dari total <code>{{$items2->total()}}</code> data
                  </div>
                  <table id="table-military-edu" class="table table-striped table-hover mt-10">
                    <thead>
                      <tr>
                        <th style="width: 10%" class="align-middle text-center">No</th>
                        <th style="width: 32%" class="align-middle text-center">Pendidikan Militer</th>
                        <th style="width: 15%" class="align-middle text-center">TMT</th>
                        <th style="width: 28%" class="align-middle text-center">Tempat</th>
                        <th style="width: 15%" class="align-middle text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items2->getCollection() as $key => $item)
                      <tr>
                        <td class="text-center">{{(($items2->currentPage() - 1) * $items2->perPage()) + ($key + 1)}}</td>
                        <td>{{ !empty($item->name) ? $item->name : '—' }}<br>
                          <span class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success'}}">{{ $item->status == 0 ? 'Belum Diverifikasi' : 'Sudah diverifikasi' }}</span>
                        </td>
                        <td class="text-center">{{ !empty($item->tmt) ? $item->tmt : '—' }}</td>
                        <td>{{ !empty($item->place) ? $item->place : '-' }}</td>
                        <td class="d-flex justify-content-center">
                          <div class="row">
                            <button type="button" class="btn btn-alt-warning btn-sm mr-5 detail-militer-button" data-id="{{ $item->id }}" title="Lihat Detail"><i class="fas fa-search-plus"></i></button>
                            @if($item->certificate)
                              <a href="{{route('militaryeducation-file', ['emp' => $item->employee_id, 'id' => $item->certificate])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
                            @else
                              <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Sertifikat">
                              <i class="fa fa-file"></i></button>
                            @endif
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
        </div>
        <div class="col-lg-6 col-12">
          <div class="row">
            <div class="col-12 text-right float-right">
              <button type="button" id="edu-add-button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-pend-umum">
                <i class="fa fa-plus mr-5 mb-10"></i> Tambah
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-30">
              <h5 class="card-title font-w400">PENDIDIKAN UMUM</h5>
              <hr>
              <div class="table-responsive-md">
                @if($items->total() < 1)
                  <p>Tidak ada data</p>
                @else
                  @include('kepegawaian.layouts.partials.pagination')
                  <table id="table-education" class="table table-striped table-hover mt-10">
                    <thead>
                      <tr>
                        <th style="width: 10%" class="text-center align-middle">No</th>
                        <th style="width: 32%" class="text-center align-middle">Pendidikan Umum</th>
                        <th style="width: 15%" class="text-center align-middle">TMT</th>
                        <th style="width: 28%" class="text-center align-middle">Tempat</th>
                        <th style="width: 15%" class="text-center align-middle">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items->getCollection() as $key => $item)
                      <tr>
                        <td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                        <td>{{ !empty($item->name) ? $item->name : '—' }}<br>
                          <span class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success'}}">{{ $item->status == 0 ? 'Belum Diverifikasi' : 'Sudah diverifikasi' }}</span>
                        </td>
                        <td class="text-center">{{ !empty($item->tmt) ? $item->tmt : '—' }}</td>
                        <td>{{ !empty($item->place)  ? $item->place : '-' }}</td>
                        <td class="d-flex justify-content-center">
                          <button type="button" class="btn btn-alt-warning btn-sm mr-5 detail-pendidikan-button" data-id="{{ $item->id }}" title="Lihat Detail"><i class="fas fa-search-plus"></i></button>
                          @if($item->certificate)
                            <a href="{{route('education-file', ['emp' => $item->employee_id, 'id' => $item->certificate])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
                          @else
                            <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Sertifikat">
                            <i class="fa fa-file"></i></button>
                          @endif
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
        </div>
      </div> --}}
      <!-- modal -->
      {{-- @include('kepegawaian.pegawai.pendidikan.manage') --}}
      @include('kepegawaian.pegawai.pendidikan.components.modal-create')
      @include('kepegawaian.pegawai.pendidikan.components.modal-detail')
      @include('kepegawaian.pegawai.pendidikan.components.modal-update')
      @include('kepegawaian.pegawai.pendidikan.components.modal-delete')
    </div>
  </div>
</div>

<form method="POST" action="" id="formDelete">
  {{csrf_field()}}
</form>
@endsection

@section('script')
<!-- All javascript function's files are included at main layout -->
@include('kepegawaian.pegawai.pendidikan.components.js')
{{-- <script type="text/javascript">
  $(document).ready(function() {
    var nameEdu = 'Data pendidikan umum',
        nameMil = 'Data pendidikan militer',
        urlGetEdu = "{{ URL::to('/kepegawaian/get-education') }}" + "/",
        urlGetMil = "{{ URL::to('/kepegawaian/get-military-education') }}" + "/",
        urlEditEdu = "{{ URL::to('/kepegawaian/pegawai/pendidikan/umum/edit') }}",
        urlEditMil = "{{ URL::to('/kepegawaian/pegawai/pendidikan/militer/edit') }}",
        urlGetMEducation = "{{ URL::to('/kepegawaian/get-meducation') }}" + "/",
        urlDeleteEdu = "{{ URL::to('/kepegawaian/pegawai/pendidikan/umum/delete') }}",
        urlDeleteMil = "{{ URL::to('/kepegawaian/pegawai/pendidikan/militer/delete') }}",
        urlVerificationEdu = "{{ URL::to('/kepegawaian/pegawai/pendidikan/umum/verification') }}",
        urlVerificationMil = "{{ URL::to('/kepegawaian/pegawai/pendidikan/militer/verification') }}",
        urlImageEdu = "{{ URL::to('/kepegawaian/get-image/education') }}",
        urlImageMil = "{{ URL::to('/kepegawaian/get-image/military') }}";

    jsSelect2();

    // FUNCTIONS
    //function check image exists
    function UrlExists(url){
      var req = new XMLHttpRequest();
      req.open('GET', url, false);
      req.send();
      return req.status==200;
    }

    function formatDate(tmt) {
      let date = new Date(tmt),
          monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
          day = date.getDate(),
          monthIndex = date.getMonth(),
          year = date.getFullYear(),
          hh = date.getHours(),
          mm = date.getMinutes();

      if (hh == 00 && mm == 00) {
        return day + ' ' + monthNames[monthIndex] + ' ' + year;
      } else {
        if(hh < 10) hh = "0" + hh;
        if(mm < 10) mm = "0" + mm;
        return day + ' ' + monthNames[monthIndex] + ' ' + year + ', ' + hh + '.' + mm;
      }
    }

    function verifAlert(param1, param2, url, id, name) {
      $(param1).on('click', function() {
        console.log(id);
        swal({
          title: "Apakah anda yakin?",
          text: "Pastikan " + name.toLowerCase() + " yang akan diverifikasi sudah benar",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: 'Tidak',
          closeOnConfirm: false,
          confirmButtonText: "Ya, saya yakin!",
          confirmButtonColor: "#ec6c62"
        })
        .then((isConfirm) => {
          if(isConfirm.value) {
            $(param2).attr('action', url + "/" + id).submit();
          }
          else {
            swal("Batal Verifikasi", name + " tidak diverifikasi", "error");
          }
        });
      });
    }

    //ADD MODAL
    yearPicker();
    $('#miliedu-add-button').on('click', function(){
      saveAlert(1, '#form-add-miliedu','', nameMil, 'form-add-miliedu');
    });
    $('#edu-add-button').on('click', function(){
      saveAlert(1, '#form-add-edu','', nameEdu, 'form-add-edu');
    });

    //DISPLAY DATA IN EDIT MODAL
    $('.edit-military-edu-button').on('click', function() {
      let idEmployee = $(this).data('id');

      $('#modal-detail-militer').modal('hide');
      $.get(urlGetMil + idEmployee, function(data){
        let json = JSON.parse(data);

        $('#nama-pend-militer-edit').val(json["ret"].name);
        $('#tahun-pend-militer-edit').val(json["ret"].tmt);
        yearPicker();
        $('#tempat-pend-militer-edit').val(json["ret"].place);
        $('#modal-edit-pend-militer').modal('show');
      });
      saveAlert(2, '#form-edit-miliedu', urlEditMil, nameMil, idEmployee);
    });

    $('.edit-edu-button').on('click', function() {
      let idEmployee = $(this).data('id');

      $('#modal-detail-pendidikan').modal('hide');
      $.get(urlGetEdu + idEmployee, function(data){
        let json = JSON.parse(data);

        $('#tingkat-pend-umum-edit').val(json["ret"].level);
        jsSelect2();
        $('#nama-pend-umum-edit').val(json["ret"].name);
        $('#tahun-pend-umum-edit').val(json["ret"].tmt);
        yearPicker();
        $('#tempat-pend-umum-edit').val(json["ret"].place);
        $('#modal-edit-pend-umum').modal('show');
      });
      saveAlert(2, '#form-edit-edu', urlEditEdu, nameEdu, idEmployee);
    });

    // DISPLAY DATA IN DETAIL MODAL
    $('.detail-militer-button').on('click', function() {
      let idEmployee = $(this).data('id');

      $.get(urlGetMil + idEmployee, function(data) {
        let json = JSON.parse(data);
        $('#info-nama-mil').html(json["ret"].name);
        $('#info-tahun-mil').html(json["ret"].tmt);
        $('#info-tempat-mil').html(json["ret"].place);
        $('#info-uploader-mil').html(formatDate(json["ret"].created_at));
        $('#modal-detail-militer #creator').html(json["ret"].creator_name);
        if(json["ret"].status) {
          $('#verif-button-mil').empty();
          $('#verify-div-mil').hide();
          if (json["ret"].verification_file) {
            var href = `{{url('kepegawaian/pegawai/pendidikan/militer')}}/`+idEmployee+`/sertifikat/`+json["ret"].verification_file;
            $('#info-verificator-mil').html("<p class='text-muted font-400 mb-1'>DIVERIFIKASI OLEH</p><h6 class='mb-2'>" + json["verificator"].name + "</h6><h6 class='font-w400 mb-5'>" +  formatDate(json["ret"].verified_at) + `</h6><a href="`+href+`" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i> Lihat Surat Verifikasi</a>`);
          } else {
            $('#info-verificator-mil').html("<p class='text-muted font-400 mb-1'>DIVERIFIKASI OLEH</p><h6 class='mb-2'>" + json["verificator"].name + "</h6><h6 class='font-w400 mb-5'>" +  formatDate(json["ret"].verified_at) + `</h6>`);
          }

        } else {
          $('#info-verificator-mil').empty();
          $('#verify-div-mil').show();
          $('#verif-button-mil').html('<button type="button" class="btn btn-alt-primary verification-button-mil"><i class="fa fa-check mr-5"></i>Verifikasi</button>');
          verifAlert('.verification-button-mil', '.form-verifikasi-mil', urlVerificationMil, idEmployee, nameMil);
        }
        $('.delete-military-edu-button').attr("data-id", idEmployee);
        $('.edit-military-edu-button').attr("data-id", idEmployee);
        $('#modal-detail-militer').modal('show');
      });
    });

    $('.detail-pendidikan-button').on('click', function() {
      let idEmployee = $(this).data('id');

      $.get(urlGetEdu + idEmployee, function(data) {
        let json = JSON.parse(data);

          $('#info-nama-pend').html(json["ret"].name);
          $('#info-tahun-pend').html(json["ret"].tmt);
          $('#info-tempat-pend').html(json["ret"].place);
          $('#info-uploader-pend').html(formatDate(json["ret"].created_at));
          $('#modal-detail-pendidikan #creator').html(json["ret"].creator_name);
          if(json["ret"].status) {
            $('#verif-button-edu').empty();
            $('#verify-div-edu').hide();
            if (json["ret"].verification_file) {
              var href = `{{url('kepegawaian/pegawai/pendidikan/umum')}}/`+idEmployee+`/sertifikat/`+json["ret"].verification_file;
              $('#info-verificator-edu').html("<p class='text-muted font-400 mb-1'>DIVERIFIKASI OLEH</p><h6 class='mb-2'>" + json["verificator"].name + "</h6><h6 class='font-w400 mb-5'>" +  formatDate(json["ret"].verified_at) + `</h6><a href="`+href+`" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i> Lihat Surat Verifikasi</a>`);
            } else {
              $('#info-verificator-edu').html("<p class='text-muted font-400 mb-1'>DIVERIFIKASI OLEH</p><h6 class='mb-2'>" + json["verificator"].name + "</h6><h6 class='font-w400'>" +  formatDate(json["ret"].verified_at) + `</h6>`);
            }
          } else {
            $('#info-verificator-edu').empty();
            $('#verify-div-edu').hide();
            $('#verif-button-edu').html('<button type="button" class="btn btn-alt-primary verification-button-edu"><i class="fa fa-check mr-5"></i>Verifikasi</button>');
            verifAlert('.verification-button-edu', '.form-verifikasi-edu', urlVerificationEdu, idEmployee, nameEdu);
          }
          $('.delete-edu-button').attr("data-id", idEmployee);
          $('.edit-edu-button').attr("data-id", idEmployee);
          $('#modal-detail-pendidikan').modal('show');
      });
    });

    //DELETE CONFIRMATION
    deleteAlert('.delete-military-edu-button', '#formDelete', urlDeleteMil , nameMil);
    deleteAlert('.delete-edu-button', '#formDelete', urlDeleteEdu, nameEdu);

    //UPLOAD FILE
    $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
      var input = $(this).parents('.input-group').find(':text'),
        log = label;

      if (input.length) {
        input.val(log);
      } else {
        if (log) alert(log);
      }
		});
		function readURL(input, type) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          if (type == 1) {
            $('#img-upload').attr('src', e.target.result);
          } else if(type == 2) {
            $('#img-uploadEdu').attr('src', e.target.result);
          } else if(type == 3) {
            $('#img-verify-upload').attr('src', e.target.result);
          } else if(type == 4) {
            $('#img-verify-uploadEdu').attr('src', e.target.result);
          }
        }
        reader.readAsDataURL(input.files[0]);
      }
		}

		$("#imgInp").change(function(){
		    readURL(this, 1);
		});
    $("#imgInpEdu").change(function(){
		    readURL(this, 2);
		});
    $("#imgVerifyInp").change(function(){
        readURL(this, 3);
    });
    $("#imgVerifyInpEdu").change(function(){
        readURL(this, 4);
    });
  });
</script> --}}
@endsection