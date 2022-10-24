@extends('kepegawaian.layouts.main-profile')

@section('title')
  kepegawaian | Pangkat
@endsection

@section('subtitle')
  Master Pangkat
@endsection

@section('main-content')
  <div class="card"> 
    <div class="card-body px-20">
      <div class="col-12 my-20"> 
        <div class="row">
          <div class="col-12 text-right float-right">
            @if($is_hrd_member)
            <a href="javascript:void(0)" class="btn-add btn btn-alt-primary pull-right"><i class="fa fa-plus mr-5 mb-10"></i> Tambah</a>
           
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-30">
            <h5 class="card-title font-w400">PANGKAT</h5>
            <hr>
            <div class="table-responsive-md"> 
              @if($items->total() < 1)
                <p>Tidak ada data</p>
              @else
                @include('kepegawaian.layouts.partials.pagination')
                <table id="table-position" class="table table-striped table-hover mt-10">
                  <thead>
                    <tr>
                      <th style="width: 7%" class="align-middle text-center">No</th>
                      <th style="width: 13%" class="align-middle text-center">Pangkat</th>
                      <th style="width: 10%" class="align-middle text-center">TMT</th>
                      <th style="width: 10%" class="align-middle text-center">Korps</th>
                      <th style="width: 12%" class="align-middle text-center">Gaji</th>
                      <th style="width: 15%" class="align-middle text-center">Pejabat</th>
                      <th style="width: 11%" class="align-middle text-center">No. Surat</th>
                      <th style="width: 13%" class="align-middle text-center">Tgl Surat</th>
                      <th style="width: 10%" class="align-middle text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($items->getCollection() as $key => $item)
                    <tr>
                      <td class="text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                      <td class="pangkat">{{ !empty($item->nama) ? $item->nama: '' }}</td>
                      <td class="tmt">{{ !empty($item->tmt) ? $item->tmt : '—' }}</td>
                      <td class="{{empty($item->korps) ? 'text-center' : ''}} korps">{{ !empty($item->korps) ? $item->korps : '—' }}</td>
                      <td class="{{empty($item->salary) ? 'text-center' : ''}}">{{ !empty($item->salary) ? $item->salary_formatted : '—' }}
                        <span class="gaji hide">{{ !empty($item->salary) ? $item->salary : '—'}}</span>
                      </td>   
                      <td class="{{empty($item->supervisor) ? 'text-center' : ''}} pejabat">{{ !empty($item->supervisor) ? $item->supervisor : '—' }}</td>
                      <td class="{{empty($item->letter_number) ? 'text-center' : ''}} nosurat">{{ !empty($item->letter_number) ? $item->letter_number : '—' }}</td>
                      <td class="{{empty($item->letter_date) ? 'text-center' : ''}} tglsurat">{{ !empty($item->letter_date) ? $item->letter_date : '—' }}</td>
                      <td class="d-flex justify-content-center">
                        @if($is_hrd_member)
                        <div class="row">
                          {{-- <button type="button" class="btn btn-alt-success btn-sm mr-5 edit-position-button" data-id="{{ $item->id }}" title="Edit Data">
                            <i class="fa fa-pencil"></i>
                          </button>
                          <form class="form-delete-position" method="POST" action="" enctype="multipart/form-data">
                          {{csrf_field()}}
                            <button type="button" class="btn btn-alt-danger btn-sm delete-position-button" data-id="{{ $item->id }}" title="Hapus Data">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form> --}}
                          <a href="javascript:void(0)" class="btn btn-alt-success btn-sm mr-5 btn-edit" data-id="{{$item->id}}">
                            <i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 btn-delete" data-id="{{$item->id}}" data-nama="{{$item->nama}}">
                            <i class="fa fa-trash"></i></a>
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

        <!-- MODAL -->
        @include('kepegawaian.pegawai.pangkat.components.modal')
        @include('kepegawaian.pegawai.pangkat.components.modal-delete')
      </div>
    </div>
  </div>
@endsection

@section('script')
@include('kepegawaian.pegawai.pangkat.components.js-index')
<!-- All javascript function's files are included at main layout -->
{{-- <script type="text/javascript">
  $(document).ready(function() {
    var name = 'Data pangkat', 
        statusSuccess,
        statusError;
    
       $('.js-select2-dynamic').select2({
        tags: true
      });

    //ALERT
    @if(session('success')=='save') statusSuccess = 'save';
    @elseif(session('success')=='update') statusSuccess = 'update';
    @elseif(session('success')=='delete') statusSuccess = 'delete';
    @elseif(session('error')=='cannot save data') statusError = 'save';
    @elseif(session('error')=='cannot update data') statusError = 'update';
    @endif

    //alertSuccess(statusSuccess, name);
    //alertError(statusError, name);

    //ADD MODAL
    combodateFirst('.combodate');
    $('#button-add-position').on('click', function() {
      //formatting salary in rupiah
      convertToRupiah('#gaji');
      convertToAngka('#gaji');
      saveAlert(1, '#form-add-position','', name, 'form-add-position');


    });

    combodate('#tmt-tambah', new Date());
    combodate('#tgl-surat-tambah', new Date());



    
    //DISPLAY DATA IN EDIT MODAL
    $('.edit-position-button').on('click', function(){
      let idPosition = $(this).data('id'),
          getPosition = "{{ URL::to('/kepegawaian/get-position') }}" + "/" + idPosition;

      $.get(getPosition, function(data){
        let salary = $('#salary').val(data.salary);

        $('#pangkat-edit').val(data.nama).trigger('change');;
        $('#korps-edit').val(data.korps);
        
        combodate('#tmt-edit', new Date(data.tmt));
        $('#nama-pejabat').val(data.supervisor);
        $('#no-surat').val(data.letter_number);
        combodate('#tgl-surat', new Date(data.letter_date));
        convertToRupiah('#salary');

        $('#modal-edit-position').modal('show');
      });
      
      saveAlert(2, '#form-edit-position', "{{ URL::to('/kepegawaian/pegawai/pangkat/edit') }}", name, idPosition);
    });
      
    //DELETE CONFIRMATION
    deleteAlert('.delete-position-button', '.form-delete-position', "{{ URL::to('/kepegawaian/pegawai/pangkat/delete') }}", name);
  });
</script> --}}
@endsection