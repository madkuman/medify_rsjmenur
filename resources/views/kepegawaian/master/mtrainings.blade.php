@extends('kepegawaian.layouts.main')

@section('title')
  {{$htmlheader_title}}
@endsection

@section('subtitle')
  {{$contentheader_title}}
@endsection

@section('content')
<div class="container">
  <div class="block">
    <div class="card-body px-20">
      <div class="col-12 my-20">
        <div class="row">
          <div class="col-12 text-right float-right mt-10">
            <button type="button" id="button-add-mtraining" class="btn btn-secondary pull-right" data-toggle="modal" data-target="#add-mtraining"><i class="fa fa-plus mr-5 mb-10"></i>Tambah</button>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-20">
            <h5 class="card-title text-muted font-w400">MASTER DATA KURSUS / PELATIHAN / SEMINAR</h5>
            <hr>
            <div class="col-12 my-10">
              
              @if($items->total() < 1)
                <p>Tidak ada data</p>
              @else
                @include('kepegawaian.layouts.partials.pagination')
                <!-- Tabel -->
                <table id="table-mtraining" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10%" class="align-middle text-center">No</th>
                      <th style="width: 30%" class="align-middle text-center">Nama</th>
                      <th style="width: 20%" class="align-middle text-center">Created at</th>
                      <th style="width: 20%" class="align-middle text-center">Updated at</th>
                      <th style="width: 20%" class="align-middle text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($items->getCollection() as $key => $item)
                    <tr>
                      <td class="align-middle text-center">{{(($items->currentPage() - 1) * $items->perPage()) + ($key + 1)}}</td>
                      <td class="align-middle">{{$item->name}}</td>
                      <td class="align-middle text-center">{{$item->created_at->diffForHumans()}}</td>
                      <td class="align-middle text-center">{{$item->updated_at->diffForHumans()}}</td>
                      <td class="d-flex justify-content-center align-self-center">
                        <div class="row">
                          <button type="button" class="btn btn-success btn-sm mr-5 btn-edit-mtraining" data-id="{{$item->id}}" title="Edit Data"><i class="fa fa-pencil"></i></button>
                          <form class="form-delete-mtraining" method="post" action="" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <button type="button" class="btn btn-danger btn-sm btn-delete-mtraining" data-id="{{ $item->id }}" title="Hapus Data"><i class="fa fa-trash"></i></button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Pagination -->
                @include('kepegawaian.layouts.partials.pagination_bottom')
              @endif
            </div>
          </div>
        </div>
        @include('kepegawaian.master.mtraining_form')
      </div>
    </div>
  </div>	
</div>
@endsection

@section('script')
<!-- All javascript function's files are included at main layout -->  
<script type="text/javascript">
  $(document).ready(function(){

    var name = 'Master data pelatihan', 
      statusSuccess,
      statusError;
    
    //ALERT
    @if(session('success')=='save') statusSuccess = 'save';
    @elseif(session('success')=='updated') statusSuccess = 'update';
    @elseif(session('success')=='delete') statusSuccess = 'delete';
    @elseif(session('error')=='fail') statusError = 'save';
    @elseif(session('error')=='fail_update') statusError = 'update';
    @endif

    //alertSuccess(statusSuccess, name);
    //alertError(statusError, name);

    //ADD MODAL
    $('#button-add-mtraining').on('click', function() {
      saveAlert(1, '#form-add-mtraining','', name, 'form-add-mtraining');
    });

    //DISPLAY DATA IN EDIT MODAL
    $('.btn-edit-mtraining').on('click', function(){
      let idMtraining = $(this).data('id'),
          getMtraining = "{{URL::to('/kepegawaian/get-mtraining')}}" + "/" + idMtraining;

      $.get(getMtraining, function(data){
        $('#nama-mtraining').val(data.name);
        $('#edit-mtraining').modal('show');
      });
      
      saveAlert(2, '#form-edit-mtraining', "{{URL::to('/kepegawaian/master/pelatihan/edit')}}", name, idMtraining);
    });
    
    //DELETE CONFIRMATION
    deleteAlert('.btn-delete-mtraining', '.form-delete-mtraining', "{{ URL::to('/kepegawaian/master/pelatihan/delete') }}", name);
  });
</script>
@endsection