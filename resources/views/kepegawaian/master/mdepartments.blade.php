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
            <button type="button" id="button-add-mdepartment" class="btn btn-secondary pull-right" data-toggle="modal" data-target="#add-mdepartment"><i class="fa fa-plus mr-5 mb-10"></i>Tambah</button>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-20">
            <h5 class="card-title text-muted font-w400">MASTER DATA DEPARTEMEN</h5>
            <hr>
            <div class="col-12 my-10">
              
              @if($items->total() < 1)
                <p>Tidak ada data</p>
              @else
                @include('kepegawaian.layouts.partials.pagination')
                <table class="table table-striped table-hover">
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
                          <button type="button" class="btn btn-success btn-sm mr-5 btn-edit-mdepartment" data-id="{{$item->id}}"><i class="fa fa-pencil" title="Edit Data"></i></button>
                          <form class="form-delete-mdepartment" method="post" action="" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <button type="button" class="btn btn-danger btn-sm btn-delete-mdepartment" data-id="{{ $item->id }}" title="Hapus Data"><i class="fa fa-trash"></i></button>
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
        @include('kepegawaian.master.mdepartment_form')
      </div>
    </div>
  </div>	
</div>
@endsection

@section('script')
<!-- All javascript function's files are included at main layout --> 
<script type="text/javascript">
  $(document).ready(function(){
    var name = 'Master data departemen', 
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
    $('#button-add-mdepartment').on('click', function() {
      saveAlert(1, '#form-add-mdepartment','', name, 'form-add-mdepartment');
    });

    // DISPLAY DATA IN EDIT MODAL
    $('.btn-edit-mdepartment').on('click', function(){
      let idMdepartment = $(this).data('id'),
          getMdepartment = "{{URL::to('/kepegawaian/get-mdepartment')}}" + "/" + idMdepartment;

      $.get(getMdepartment, function(data){
        $('#nama-mdepartment').val(data.name);
        $('#edit-mdepartment').modal('show');
      });

      saveAlert(2, '#form-edit-mdepartment', "{{URL::to('/kepegawaian/master/departemen/edit')}}", name, idMdepartment);
    });
    
    //DELETE CONFIRMATION
    deleteAlert('.btn-delete-mdepartment', '.form-delete-mdepartment', "{{ URL::to('/kepegawaian/master/departemen/delete') }}", name);
  });
</script>
@endsection