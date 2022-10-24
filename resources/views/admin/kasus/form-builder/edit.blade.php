@extends('layouts.main-dashboard')

@section('css')
<style type="text/css">
.form-material
{
     padding-top: 0px
}

.opsi-container
{
     display: none
}
</style>
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<main id="main-container">
     <form method="POST">
          <input name="form_id" value="{{$form->id}}" type="hidden">
          <div class="content">
               <div class="block">
                    <div class="block-content">
                         <h4>Buat Form Baru</h4>
                         <hr>
                         <div class="row">
                              <div class="col-6">
                                   <div class="form-group">
                                        <label>Judul </label>
                                        <input type="text" name="judul" class="form-control form-control-lg" value="{{$form->judul}}">
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-6">
                                   <div class="form-group">
                                        <label>Deskripsi </label>
                                        <textarea name="deskripsi" class="form-control" rows="3">{{$form->deskripsi}}</textarea>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="js-draggable-items input-tambahan-container">
                         <div class="col-12 draggable-column">
                              @foreach($form->input as $input)
                              <div class="block border-y draggable-item">
                                   <div class="block-content block-content-full">
                                        <div class="row">
                                             <div class="col-12">
                                                  <button type="button" class="btn btn-outline-danger pull-right hapusInput">
                                                       HAPUS INPUT
                                                  </button>
                                                  <h5 class="draggable-handler"><small>INPUT #{{$loop->iteration}}</small></h5>
                                                  <input name="id[]" value="{{$loop->iteration}}" type="hidden">
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-4">
                                                  <div class="form-group">
                                                       <div class="form-material">
                                                            <input type="text" class="form-control" name="inputlabel[]" placeholder="Label Form" value="{{$input->label}}">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-4">
                                                  <select class="form-control selectType" name="inputtype[]">
                                                       <option value="text" @if($input->type == 'text') selected @endif>Teks</option>
                                                       <option value="number" @if($input->type == 'number') selected @endif>Angka</option>
                                                       <option value="textarea" @if($input->type == 'textarea') selected @endif>Paragraf</option>
                                                       <option value="datepicker" @if($input->type == 'datepicker') selected @endif>Tanggal</option>
                                                       <option value="dropdown" @if($input->type == 'dropdown') selected @endif>Dropdown</option>
                                                       <option value="radio" @if($input->type == 'radio') selected @endif>Pilihan Ganda</option>
                                                       <option value="checkboxes" @if($input->type == 'checkboxes') selected @endif>Checkboxes</option>
                                                  </select>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-3">
                                                  <div class="form-group">
                                                       <div class="form-material">
                                                            <input type="text" class="form-control" name="inputcaption[]" placeholder="Keterangan Input">
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="opsi-container" @if(in_array($input->type, $input_opsi)) style="display:block" @endif>
                                             <h5><small>OPSI PILIHAN</small></h5>
                                             <div class="opsi-tambahan-container" data-id="{{$loop->iteration}}">
                                                  @php $input_id = $loop->iteration @endphp
                                                  @if(in_array($input->type, $input_opsi))
                                                  @foreach($input->opsi as $opsi)
                                                  <div class="row">
                                                       <div class="col-4">
                                                            <div class="form-group">
                                                                 <div class="form-material">
                                                                      <input type="text" class="form-control" name="inputoption{{$input_id}}[]" placeholder="Teks Pilihan" value="{{$opsi->deskripsi}}">
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-2">
                                                            <button type="button" class="btn btn-circle btn-outline-danger hapusOpsi">
                                                                 <i class="fa fa-trash"></i>
                                                            </button>
                                                       </div>
                                                  </div>
                                                  @endforeach
                                                  @else
                                                  <div class="row">
                                                       <div class="col-4">
                                                            <div class="form-group">
                                                                 <div class="form-material">
                                                                      <input type="text" class="form-control" name="inputoption{{$input_id}}[]" placeholder="Teks Pilihan">
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-2">
                                                            <button type="button" class="btn btn-circle btn-outline-danger hapusOpsi">
                                                                 <i class="fa fa-trash"></i>
                                                            </button>
                                                       </div>
                                                  </div>
                                                  @endif
                                             </div>
                                             <div class="row">
                                                  <div class="col-4 text-center">
                                                       <button type="button" class="btn btn-circle btn-outline-primary tambahOpsi">
                                                            <i class="fa fa-plus"></i>
                                                       </button>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              @endforeach
                         </div>
                    </div>
                    <div class="block-content block-content-full pt-0">
                         <div class="row">
                              <div class="col-12 text-center">
                                   <button type="button" class="btn btn-alt-primary tambahInput">Tambah Input</button>
                              </div>
                         </div>
                    </div>
               </div>
               <button class="btn btn-primary btn-hero pull-right mb-20">Simpan</button>
          </div>
          {{csrf_field()}}
     </form>
</main>

@endsection

@section('js')
<script type="text/javascript">
     var count_input = {{count($form->input)}}
</script>
<script type="text/javascript">
    $(document).on('click', '.tambahOpsi', function() {
     
          var opsiTambahanContainer = $(this).parent().parent().parent().find(".opsi-tambahan-container");
          var number = opsiTambahanContainer.data("id");
          var konten = getOpsiKonten(number);
          opsiTambahanContainer.append(konten);
     });

    $(document).on('click', '.tambahInput', function() {
          var opsiTambahanContainer = $(this).parent().parent().parent().parent().find(".input-tambahan-container .draggable-column");
          count_input++
          var konten = getInputKonten(count_input);
          opsiTambahanContainer.append(konten);
          reInitSortable();
     });

    $(document).on('click', '.hapusOpsi', function() {
          var element = $(this).parent().parent();
          var container = $(this).parent().parent().parent();
          var count = container.children().length;
          if(count <= 1)
          {
               var input = element.find("input.form-control")
               input.val("");
          }
          else
          {
               element.remove();
          }
     });

    $(document).on('click', '.hapusInput', function() {
          var element = $(this).parent().parent().parent().parent();
          var container = $(this).parent().parent().parent().parent().parent();
          var count = container.children().length;
          if(count <= 1)
          {
               var input = element.find("input.form-control")
               input.val("");
          }
          else
          {
               element.remove();
          }
     });

    $(document).on('change', '.selectType', function() {
          var value = this.value
          var opsiContainer = $(this).parent().parent().parent().find(".opsi-container");
          
          if(value =='text' || value == 'textarea' || value == 'number' || value == 'datepicker') opsiContainer.hide()
          else opsiContainer.show();
     });

    function reInitSortable()
    {

          $('.draggable-column').sortable( "destroy" )
          jQuery('.js-draggable-items').each(function(){
               var el = jQuery(this);

               el.addClass('js-draggable-items-enabled');

               el.children('.draggable-column').sortable({
                    connectWith: '.draggable-column',
                    items: '.draggable-item',
                    dropOnEmpty: true,
                    opacity: .75,
                    handle: '.draggable-handler',
                    placeholder: 'draggable-placeholder',
                    tolerance: 'pointer',
                    start: function(e, ui){
                         ui.placeholder.css({
                              'height': ui.item.outerHeight(),
                              'margin-bottom': ui.item.css('margin-bottom')
                         });
                    }
               });
          });
     }


     function getOpsiKonten(number)
     {
          return `<div class="row">
                    <div class="col-4">
                         <div class="form-group">
                              <div class="form-material">
                                   <input type="text" class="form-control" name="inputoption`+number+`[]" placeholder="Teks Pilihan">
                              </div>
                         </div>
                    </div>
                    <div class="col-2">
                         <button type="button" class="btn btn-circle btn-outline-danger hapusOpsi">
                              <i class="fa fa-trash"></i>
                         </button>
                    </div>
               </div>`
          
     }

     function getInputKonten(number)
     {
          return `<div class="block border-y draggable-item">
                    <div class="block-content block-content-full">
                         <div class="row">
                              <div class="col-12">
                                   <button type="button" class="btn btn-outline-danger pull-right hapusInput">
                                        HAPUS INPUT
                                   </button>
                                   <h5 class="draggable-handler"><small>INPUT #`+number+`</small></h5>
                                   <input name="id[]" value="`+number+`"  type="hidden">
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-4">
                                   <div class="form-group">
                                        <div class="form-material">
                                             <input type="text" class="form-control" name="inputlabel[]" placeholder="Label Form">
                                        </div>
                                   </div>
                              </div>
                              <div class="col-4">
                                   <select class="form-control selectType" name="inputtype[]">
                                        <option value="text">Teks</option>
                                        <option value="number">Angka</option>
                                        <option value="textarea">Paragraf</option>
                                        <option value="datepicker">Tanggal</option>
                                        <option value="dropdown">Dropdown</option>
                                        <option value="radio">Pilihan Ganda</option>
                                        <option value="checkboxes">Checkboxes</option>
                                   </select>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-3">
                                   <div class="form-group">
                                        <div class="form-material">
                                             <input type="text" class="form-control" name="inputcaption[]" placeholder="Keterangan Input">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="opsi-container">
                              <h5><small>OPSI PILIHAN</small></h5>
                              <div class="opsi-tambahan-container" data-id="`+number+`">
                                   <div class="row">
                                        <div class="col-4">
                                             <div class="form-group">
                                                  <div class="form-material">
                                                       <input type="text" class="form-control" name="inputoption`+number+`[]" placeholder="Teks Pilihan">
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-2">
                                             <button type="button" class="btn btn-circle btn-outline-danger hapusOpsi">
                                                  <i class="fa fa-trash"></i>
                                             </button>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-4 text-center">
                                        <button type="button" class="btn btn-circle btn-outline-primary tambahOpsi">
                                             <i class="fa fa-plus"></i>
                                        </button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>`
     }

</script> 



<script src="{{url('assets/js/codebase.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  jQuery(function () {
    Codebase.helpers('draggable-items');
});
</script>
     

@endsection