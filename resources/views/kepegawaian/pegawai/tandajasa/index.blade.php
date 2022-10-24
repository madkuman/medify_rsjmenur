@extends('kepegawaian.layouts.main-profile')

@section('title')
{{$htmlheader_title}}
@endsection

@section('subtitle')
{{$contentheader_title}}
@endsection

@section('main-content')
<div class="card">
  <div class="card-body px-20">
    <div class="col-12 my-20">
      <div class="row">
        <div class="col-12 text-right float-right">

          @if($is_hrd_member)
          <button id="button-add-appretiation" type="button" class="btn btn-alt-primary pull-right" data-toggle="modal" data-target="#modal-add-appretiation">
            <i class="fa fa-plus mr-5 mb-10"></i> Tambah
          </button>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-30">
          <h5 class="card-title font-w400">TANDA JASA</h5>
          <hr>
          <div class="table-responsive-md">
            @if($items->total() < 1)
            <p>Tidak ada data</p>
            @else
            @include('kepegawaian.layouts.partials.pagination')
            <table id="table-appretiation" class="table table-striped table-hover mt-10"> 
              <thead>
                <tr>
                  <th style="width: 10%" class="text-center">No</th>
                  <th style="width: 20%" class="text-center">Tanda Jasa</th>
                  <th style="width: 20%" class="text-center">TMT</th>
                  <th style="width: 25%" class="text-center">No.ST/Kep</th>
                  <th style="width: 10%" class="text-center">Status</th>
                  <th style="width: 15%" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items->getCollection() as $key => $item)
                <tr>
                  <td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                  <td class="@if (empty($item->name)) text-center @endif">{{ $item->name }}</td>
                  <td class="@if (empty($item->tmt_formatted)) text-center @endif">{{ !empty($item->tmt_formatted) ? $item->tmt_formatted : '—'}}</td>
                  <td class="@if (empty($item->st_number)) text-center @endif">{{ !empty($item->st_number) ? $item->st_number : '—'}}</td>
                  <td class="text-center"><span class="badge {{ $item->status == 0 ? 'badge-danger' : 'badge-success'}}">{{ $item->status == 0 ? 'Belum Diverifikasi' : 'Sudah diverifikasi' }}</span></td>
                  <td class="d-flex justify-content-center">
                    <div class="row">
                      <button type="button" class="btn btn-alt-warning btn-sm mr-5 detail-appretiation-button" data-id="{{ $item->id }}" title="Lihat Detail">
                        <i class="fas fa-search-plus"></i>
                      </button>
                      @if($item->certificate)
                      <a href="{{route('appretiation-file', ['emp' => $item->employee_id, 'id' => $item->certificate])}}" class="btn btn-alt-warning btn-sm mr-5" title="Lihat Sertifikat" target="_blank"><i class="fa fa-file"></i></a>
                      @else
                      <button type="button" class="btn btn-alt-warning btn-sm mr-5" disabled title="Lihat Detail">
                        <i class="fa fa-file"></i></button>
                        @endif
                        @if($is_hrd_member)
                        <button type="button" class="btn btn-alt-success btn-sm mr-5 edit-appretiation-button" data-id="{{ $item->id }}" title="Edit Data">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <form class="form-delete-appretiation" method="POST" action="" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <button type="button" class="btn btn-alt-danger btn-sm delete-appretiation-button" data-id="{{ $item->id }}" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
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
        <!-- modal -->
        @include('kepegawaian.pegawai.tandajasa.manage')
      </div>
    </div>
  </div>
  @endsection

  @section('script')
  <!-- All javascript function's files are included at main layout -->
  <script type="text/javascript">
    $(document).ready(function() {
      var name = 'Data tanda jasa',
      urlGetAppretiation = "{{ URL::to('/kepegawaian/get-appretiation') }}" + "/",
      urlEditAppretiation = "{{ URL::to('/kepegawaian/pegawai/tanda-jasa/edit') }}",
      urlDeleteAppretiation = "{{ URL::to('/kepegawaian/pegawai/tanda-jasa/delete') }}",
      urlVerification = "{{ URL::to('/kepegawaian/pegawai/tanda-jasa/verification') }}",
      urlImage = "{{ URL::to('/kepegawaian/get-image/appretiation') }}";

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
    combodateFirst('.combodate');
    combodate('#tmt', new Date());
    $('#button-add-appretiation').on('click', function() {
      combodateFirst('.combodate');
      saveAlert(1, '#form-add-appretiation','', name, '');
    });

    //DISPLAY DATA IN EDIT MODAL
    $('.edit-appretiation-button').on('click', function(){
      let idEmployee = $(this).data('id');

      $.get(urlGetAppretiation + idEmployee, function(data) {
        let json = JSON.parse(data);

        $('#appretiation').val(json["ret"].name);
        if(json["ret"].tmt == '0000-00-00 00:00:00')
          combodate('#tmt-edit', '0000-00-00');
        else
          combodate('#tmt-edit', new Date(json["ret"].tmt));
        $('#st-number').val(json["ret"].st_number);
        $('#modal-edit-appretiation').modal('show');
      });
      saveAlert(2, '#form-edit-appretiation', urlEditAppretiation, name, idEmployee);
    });
    
    // DISPLAY DATA IN DETAIL MODAL
    $('.detail-appretiation-button').on('click', function() {
      let idEmployee = $(this).data('id');

      $.get(urlGetAppretiation + idEmployee, function(data) {
        let json = JSON.parse(data);
        console.log(json);

        $('#info-nama-tj').html(json["ret"].name);
        $('#info-tmt-tj').html(formatDate(json["ret"].tmt));
        $('#info-nost-tj').html(json["ret"].st_number);
        $('#info-uploader').html(formatDate(json["ret"].created_at));
        $('#creator').html(json["ret"].creator_name);
        if(json["ret"].status) {
          $('#info-verificator').html("<p class='text-muted font-400 mb-1'>DIVERIFIKASI OLEH</p><h6 class='mb-2'>" + json["verificator"].name + "</h6><h6 class='font-w400'>" +  formatDate(json["ret"].verified_at) + "</h6>");
        } else {
          $('#verif-button').html('<div class="modal-footer"><form class="form-verifikasi" method="POST" action="" enctype="multipart/form-data">{{csrf_field()}}<button type="button" class="btn btn-alt-primary verification-button"><i class="fa fa-check mr-5"></i>Verifikasi</button></form></div>');
          verifAlert('.verification-button', '.form-verifikasi', urlVerification, idEmployee, name);
        }
        $('#modal-detail-appretiation').modal('show');
      });
    });

    //DELETE CONFIRMATION
    deleteAlert('.delete-appretiation-button', '.form-delete-appretiation', urlDeleteAppretiation, name);

    //UPLOAD FILE
    $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
      var input = $(this).parents('.input-group').find(':text'),
      log = label;
      
      if( input.length ) {
        input.val(log);
      } else {
        if( log ) alert(log);
      }
    });
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#img-upload').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgInp").change(function(){
      readURL(this);
    });
  });
</script>
@endsection