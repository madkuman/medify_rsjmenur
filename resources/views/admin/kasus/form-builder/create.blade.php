@extends('layouts.main-dashboard')

@section('css')
<style type="text/css">
.form-material
{
     padding-top: 0px
}

.opsi-container, .skor-container
{
     display: none
}

#sidebutton {
  height: 120px;
  background: white;
  padding: 13px;
}
</
</style>
@endsection

@section('content')

@include('admin.layouts.components.sidebar')
@include('layouts.components2.navbar-dashboard')

<main id="main-container">
          <div class="content">
               <div class="row justify-content-center">
                    <div class="col-10">
                         <div class="block">
                              <div class="block-content">
                                   <h4>Buat Form Baru</h4>
                                   <hr>
                                   <div class="row">
                                        <div class="col-6">
                                             <div class="form-group">
                                                  <label>Judul </label>
                                                  <input type="text" name="judul" class="form-control form-control-lg formJudul">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-6">
                                             <div class="form-group">
                                                  <label>Deskripsi </label>
                                                  <textarea name="deskripsi" class="form-control formDeskripsi" rows="3"></textarea>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div id="halaman-container">
                         </div>
                         <div class="text-center">
                              <button type="button" class="btn btn-outline-info tambahHalaman"><i class="fa fa-plus"></i> Tambah Halaman</button>
                         </div>
                         <hr>
                         <button class="btn btn-primary btn-hero pull-right mb-20 buttonSubmit">Simpan</button>
                    </div>
               </div>
          </div>
          {{csrf_field()}}
</main>

@endsection

@section('js')
<script type="text/javascript">
     var count_input = 0
     var count_page = 0
     var count_opsi = 0
     var dataform = {input:[]};

     $(document).on('change', '.formJudul', function() {
          var value = this.value
          dataform.judul = value;
     });

     $(document).on('change', '.formDeskripsi', function() {
          var value = this.value
          dataform.deskripsi = value;
     });

     /*--------------HALAMAN------------*/

     $(document).on('click', '.tambahHalaman', function() {
          count_page++
          var opsiTambahanContainer = $("#halaman-container");
          var konten =  getPageKonten(count_page);
          opsiTambahanContainer.append(konten);
     });


     $(document).on('click', '.hapusPage', function() {
          updateHalamanInput()
          page = $(this).parent().data("page")
          deleteInputBasedOnPages(page);
          $(this).parent().remove();
          updateHalaman()
          updateHalamanInput()
     });

     function getHalaman(element)
     {
          halaman = element.closest(".page").data("page")
          return halaman;
     }

     function updateHalaman()
     {
          var i = 1;
          count_page = 0
          $(".page").each(function() {
               $(this).data("page",i);
               $(this).attr("id",'page-'+i);
               $(this).find('p').html('Halaman ' + i);
               i++;
               count_page++;
          });
     }

     function updateHalamanInput()
     {
          $(".draggable-item").each(function() {
               id = $(this).data("id");
               object = getObjectInput($(this),'object',id)
               halaman = getHalaman($(this))
               object.page = halaman;
          });
     }


     /*------------INPUT------------*/

     $(document).on('click', '.tambahInput', function() {
          var opsiTambahanContainer = $(this).parent().parent().parent().parent().find(".input-tambahan-container .draggable-column");
          count_input++
          count_opsi++

          page = $(this).closest(".page").data("page");
          inputInfo = {id:count_input,page:page,label:"",caption:"",type:"text",opsi:[{id:count_opsi,deskripsi:"",extra_input:"",skor:""}]}
          dataform.input.push(inputInfo)

          var opsi_konten = getOpsiKonten(count_input,count_opsi);
          var konten = getInputKonten(count_input,opsi_konten);
          opsiTambahanContainer.append(konten);
          reInitSortable();
          reInitSelect2();
          reInitSelect2Score();
     });

     $(document).on('click', '.hapusInput', function() {
          var element = $(this).parent().parent().parent();
          var container = $(this).parent().parent().parent().parent();
          element.remove()

          index = getObjectInput($(this),'index')
          array_input = getObjectInput($(this),'array')
          array_input.splice(index, 1);
     });


     function getObjectInput(element,return_type = 'object',input_id="0")
     {
          if(input_id == 0)
               input_id = element.closest(".draggable-item").data("id")
          
          var array_input = dataform.input
          if(return_type == 'array')
               return array_input
          var result = {}
          for(i=0;i<array_input.length;i++)
          {
               currentValue = array_input[i]
               if(currentValue.id == input_id){
                    if(return_type == 'object')
                         return currentValue;
                    else if(return_type == 'index')
                         return i
               }
          };

          return 0
     }

     function deleteInputBasedOnPages(page)
     {
          var array_input = dataform.input
          var result = {}
          for(i=0;i<array_input.length;i++)
          {
               currentValue = array_input[i]
               if(currentValue.page == page){
                    array_input.splice(i, 1);
                    deleteInputBasedOnPages(page);
                    break;
               }
          };
     }



     function updateInputOrder()
     {
          var i = 1;
          $(".draggable-item").each(function() {
               id = $(this).data("id");
               object = getObjectInput($(this),'object',id)
               object.order = i;
               i++;
          });
     }



     /*------------SELECT TYPE------------*/

     $(document).on('change', '.selectType', function() {
          var value = this.value
          var opsiContainer = $(this).parent().parent().parent().find(".opsi-container");
          var skorContainer = $(this).parent().parent().parent().find(".skor-container");
          
          if(value =='checkboxes' || value == 'dropdown' || value == 'radio' || value == 'radio-score' || value == 'checkboxes-score' ) opsiContainer.show()
               else opsiContainer.hide();

          if(value =='checkboxes' || value == 'radio') toggleOpsi(opsiContainer, '.input-option-ekstra','.input-option-skor')
          else if(value == 'radio-score' || value == 'checkboxes-score') 
          {
               toggleOpsi(opsiContainer, '.input-option-skor','.input-option-ekstra')
          }  
          else if(value == 'dropdown')
          {
               toggleOpsi(opsiContainer,'', '.input-option-ekstra')
               toggleOpsi(opsiContainer,'', '.input-option-skor')
          }


          if(value == 'score') skorContainer.show()
          else skorContainer.hide()

          input_item = getObjectInput($(this))
          input_item.type = value

          if(value == 'radio-score' || value == 'checkboxes-score') 
          {
               editFormSkorReference(input_item.id,input_item.label)
          } 

     });

     /*------------ LABEL ------------*/

     $(document).on('change', '.labelName', function() {
          var value = this.value
          var title = $(this).parent().parent().parent().parent().parent().parent().find('.block-title-label')
          title.html(value);

          input_item = getObjectInput($(this))
          input_item.label = value
          if(input_item.type == 'radio-score' || input_item.type == 'checkboxes-score') 
          {
               editFormSkorReference(input_item.id,value)
          }
          
     });
     
     /*------------ CAPTION ------------*/

     $(document).on('change', '.inputCaption', function() {
          var value = this.value

          input_item = getObjectInput($(this))
          input_item.caption = value
     });

     /*------------INPUT OPSI------------*/

     $(document).on('click', '.tambahOpsi', function() {
          count_opsi++

          opsiInfo = {id:count_opsi,deskripsi:"",extra_input:0,skor:""}
          input_item = getObjectInput($(this))
          input_item.opsi.push(opsiInfo)

          value = input_item.type

          var opsiTambahanContainer = $(this).parent().parent().parent().find(".opsi-tambahan-container");
          var number = opsiTambahanContainer.data("id");
          var konten = getOpsiKonten(number,count_opsi);
          opsiTambahanContainer.append(konten);

          if(value =='checkboxes' || value == 'radio') toggleOpsi(opsiTambahanContainer, '.input-option-ekstra','.input-option-skor')
          else if(value == 'radio-score' || value == 'checkboxes-score') toggleOpsi(opsiTambahanContainer, '.input-option-skor','.input-option-ekstra')           
          else if(value == 'dropdown')
          {
               toggleOpsi(opsiTambahanContainer,'', '.input-option-ekstra')
               toggleOpsi(opsiTambahanContainer,'', '.input-option-skor')
          }
     });

     $(document).on('click', '.hapusOpsi', function() {
          input = getObjectInput($(this))
          index = getObjectOpsi($(this),input,'index')
          opsi_array = getObjectOpsi($(this),input,'array')
          opsi_array.splice(index, 1);

          var element = $(this).parent().parent();
          element.remove();


     });

     function toggleOpsi(element,show,hide)
     {
          if(show != '') element.find(show).show()
          if(hide != '') element.find(hide).hide()
     }

     function getObjectOpsi(element,input_item,return_type = 'object')
     {
          opsi_id = element.closest(".opsi-item").data("id")
          array_opsi = input_item.opsi
          if(return_type == 'array')
               return array_opsi
          var result = {}
          for(j=0;j<array_opsi.length;j++)
          {
               currentValue = array_opsi[j]
               if(currentValue.id == opsi_id)
               {
                    if(return_type == 'object')
                         return currentValue
                    else if(return_type == 'index')
                         return j
               }     
          }

          return 0
     }


     $(document).on('change', '.opsiTambahanDeskripsi', function() {
          var value = this.value
          input_item = getObjectInput($(this))
          opsi_item = getObjectOpsi($(this),input_item)
          opsi_item.deskripsi = value
     });

     $(document).on('change', '.opsiTambahanEkstra', function() {
          var value = this.value
          input_item = getObjectInput($(this))
          opsi_item = getObjectOpsi($(this),input_item)
          if(opsi_item.extra_input == 1) value = 0
               else value = 1
          opsi_item.extra_input = value
     });

     $(document).on('change', '.opsiTambahanSkor', function() {
          var value = this.value
          input_item = getObjectInput($(this))
          opsi_item = getObjectOpsi($(this),input_item)
          opsi_item.skor = value
     });

     /*------------SKOR--------------*/

     var formSkorReference = [];

     function addFormSkorReference(id,text)
     {
          obj = {id:id,text:text}
          formSkorReference.push(obj);
     }

     function removeFormSkorReference(id)
     {
          for(i=0;i<formSkorReference.length;i++)
          {
               currentValue = formSkorReference[i]
               if(currentValue.id == id){
                    formSkorReference.splice(i, 1);
               }
          };
     }

     function editFormSkorReference(id,text)
     {
          removeFormSkorReference(id)
          addFormSkorReference(id,text)
          reInitSelect2Score()
     }

     function updateDataSelectSkor()
     {
          $(".selectSkor").each(function() {
               value = $(this).select2("val")
               input = getObjectInput($(this))
               input.skor_input_id = value
          });
     }

     function refillSelectSkor()
     {
          $(".selectSkor").each(function() {
               input = getObjectInput($(this))
               $(this).val(input.skor_input_id).trigger("change");
          });
     }


     function reInitSortable()
     {
          // if(count_page > 1)
          //      $('.draggable-column').sortable( "destroy" )

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

     function reInitSelect2Score()
     {
          updateDataSelectSkor()
          $('.selectSkor').select2('destroy').empty().select2({data: formSkorReference})
          refillSelectSkor()
     }

     function reInitSelect2()
     {
          $('.js-select2').select2();
     }


     function getOpsiKonten(number,id)
     {
          return `<div class="row opsi-item" data-id="`+id+`">
                    <div class="col-4">
                         <div class="form-group">
                              <div class="form-material">
                                   <input type="text" class="form-control opsiTambahanDeskripsi" name="inputoption`+number+`[]" placeholder="Teks Pilihan">
                              </div>
                         </div>
                    </div>
                    <div class="col-3 input-option-ekstra">
                         <label class="css-control css-control-sm css-control-secondary css-switch">
                              <input type="checkbox" class="css-control-input opsiTambahanEkstra" name='inputoptionekstra`+number+`'>
                              <span class="css-control-indicator"></span> Ekstra Input
                         </label>
                    </div>
                    <div class="col-3 input-option-skor">
                         <div class="form-group">
                              <div class="form-material">
                                   <input type="text" class="form-control opsiTambahanSkor" name="inputoptionskor`+number+`[]" placeholder="Skor">
                              </div>
                         </div>
                    </div>
                    <div class="col-1">
                         <button type="button" class="btn btn-circle btn-outline-danger hapusOpsi">
                              <i class="fa fa-trash"></i>
                         </button>
                    </div>
               </div>`
          
     }

     function getInputKonten(number,opsi_konten)
     {
          return `<div class="block borderless block-themed mb-5 draggable-item " id="input-item-`+number+`" data-id="`+number+`">
                    <div class="draggable-handler block-header">
                         <h3 class="block-title"><span class="block-title-label">Input</span> #`+number+`</h3>
                         <div class="block-options mr-15">
                              <button type="button" class="btn-block-option hapusInput">
                                   <i class="si si-trash"></i>
                              </button>
                              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                         </div>
                    </div>
                    <div class="block-content block-content-full">
                         <input name="id[]" value="`+number+`" type="hidden">
                         <div class="row">
                              <div class="col-4">
                                   <div class="form-group">
                                        <div class="form-material">
                                             <input type="text" class="form-control labelName" name="inputlabel[]" placeholder="Label Form">
                                        </div>
                                   </div>
                              </div>
                              <div class="col-4">
                                   <select class="form-control js-select2 selectType" name="inputtype[]">
                                        <optgroup label="Input">
                                             <option value="text">Teks</option>
                                             <option value="number">Angka</option>
                                             <option value="textarea">Paragraf</option>
                                             <option value="datepicker">Tanggal</option>
                                             <option value="dropdown">Dropdown</option>
                                             <option value="radio">Pilihan Ganda</option>
                                             <option value="checkboxes">Checkboxes</option>
                                        </optgroup>
                                        <optgroup label="Header dan Catatan">
                                             <option value="h2">Header 2</option>
                                             <option value="h3">Header 3</option>
                                             <option value="h4">Header 4</option>
                                             <option value="notes">Catatan</option>
                                        </optgroup>
                                        <optgroup label="Skor">
                                             <option value="score">Skor</option>
                                             <option value="radio-score">Pilihan Ganda Skor</option>
                                             <option value="checkboxes-score">Checkboxes Skor</option>
                                        </optgroup>
                                   </select>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-3">
                                   <div class="form-group">
                                        <div class="form-material">
                                             <input type="text" class="form-control inputCaption" name="inputcaption[]" placeholder="Keterangan Input">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="skor-container">
                              <div class="row">
                                   <div class="col-4">
                                        <label>Pilih Form</label><br>
                                        <select class="form-control js-select2 selectSkor" name="selectSkor[]" multiple>
                                        </select>
                                        <br><small>Pilih Sumber Perhitungan Skor</small>
                                   </div>
                              </div>
                         </div>
                         <div class="opsi-container">
                              <h5><small>OPSI PILIHAN</small></h5>
                              <div class="opsi-tambahan-container" data-id="`+number+`">
                                   `+opsi_konten+`
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

     function getPageKonten(page)
     {
          return `<div class="page" id="page-`+page+`" data-page="`+page+`">
               <button class="btn btn-outline-danger btn-simple btn-circle hapusPage pull-right"><i class="fa fa-trash"></i></button>
               <p class="mb-15">Halaman `+page+`</p>
               <div class="block">
                    <div class="js-draggable-items input-tambahan-container">
                         <div class="col-12 draggable-column px-0">
                         </div>
                    </div>
                    <div class="block-content block-content-full">
                         <div class="row">
                              <div class="col-12 text-center">
                                   <button type="button" class="btn btn-alt-primary tambahInput">Tambah Input</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>`
     }

     $('.buttonSubmit').click(function(){
          updateHalamanInput()
          updateInputOrder()
          updateDataSelectSkor()
          $.ajax({
               type: "POST",
               url: "{{url()->current()}}",
               dataType: "json",
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: dataform,
               success: function (data) 
               {
                    console.log(data);
                    callSwal(data.type,data.title,data.text,data.url);
                    $('#noRM').val('');
               },
               error: function () 
               {
                    callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    console.log(data);

               }
          });
     })

</script> 



<script src="{{url('assets/js/codebase.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{url('assets/js/plugins/stickykit/jquery.sticky-kit.min.js')}}"></script>
<script>
   jQuery(function () {
      Codebase.helpers('draggable-items');
 });

   $("#sidebutton").stick_in_parent({
     'offset_top' : 76
   });
</script>


@endsection