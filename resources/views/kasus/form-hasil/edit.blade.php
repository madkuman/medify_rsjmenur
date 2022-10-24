@extends('kasus.layouts.main')

@section('css')
<style type="text/css">
.hidden{
     display: none;
}
</style>
@endsection

@section('content')

<main id="main-container">
     @include('kasus.layouts.header')
     <div class="content">
          <div class="row justify-content-center">
               <div class="col-8">
                    <a href="{{url('kasus/'.$kasus->nomor_kasus.'/form/'.$slug.'/custom/'.$form->id)}}">Kembali ke Halaman Sebelumnya</a>
                    <div class="block mt-5">
                         <form method="POST" action="{{url()->current()}}" autocomplete="off">
                         <div class="block-content">
                              <h4 class="mb-5">{{$form->judul}}</h4>
                              <p>{{$form->deskripsi}}</p>
                              <hr>
                         </div>
                         @php $page = 0 @endphp
                         @php $array_page = $form->pages @endphp
                         @foreach($form->input as $input)
                         @if($page != $input->page)
                         @if(!$loop->first)
                         @if(in_array($page-1,$array_page))
                         <button type="button"  class="btn btn-secondary" data-go="{{$page-1}}">Prev</button>
                         @endif
                         @if(in_array($page+1,$array_page))
                         <button type="button"  class="btn btn-secondary"  data-go="{{$page+1}}">Next</button>
                         @endif
                         </div>
                         @endif
                    @php $page = $input->page @endphp
                    @php $array_page[] = $input->page @endphp
                    <div class="block-content block-content-full page @if(!$loop->first) hidden @endif" data-page="{{$page}}"> 
                         <div class="pb-20">Halaman {{$page}}</div>
                         @endif
                         <div class="form-group form-builder">
                              @if($input->type == 'text')
                              @include('admin.kasus.form-builder.components-view.text')
                              @elseif($input->type == 'textarea')
                              @include('admin.kasus.form-builder.components-view.textarea')
                              @elseif($input->type == 'dropdown')
                              @include('admin.kasus.form-builder.components-view.dropdown')
                              @elseif($input->type == 'radio')
                              @include('admin.kasus.form-builder.components-view.radio')
                              @elseif($input->type == 'checkboxes')
                              @include('admin.kasus.form-builder.components-view.checkboxes')
                              @elseif($input->type == 'datepicker')
                              @include('admin.kasus.form-builder.components-view.datepicker')
                              @elseif($input->type == 'number')
                              @include('admin.kasus.form-builder.components-view.number')
                              @elseif($input->type == 'h2')
                              @include('admin.kasus.form-builder.components-view.h2')
                              @elseif($input->type == 'h3')
                              @include('admin.kasus.form-builder.components-view.h3')
                              @elseif($input->type == 'h4')
                              @include('admin.kasus.form-builder.components-view.h4')
                              @elseif($input->type == 'notes')
                              @include('admin.kasus.form-builder.components-view.notes')
                              @elseif($input->type == 'score')
                              @include('admin.kasus.form-builder.components-view.score')
                              @elseif($input->type == 'radio-score')
                              @include('admin.kasus.form-builder.components-view.radio-score')
                              @elseif($input->type == 'checkboxes-score')
                              @include('admin.kasus.form-builder.components-view.checkboxes-score')
                              @endif
                         </div>
                         @if($loop->last)
                         @if(in_array($page-1,$array_page))
                         <button type="button" class="btn btn-secondary"  data-go="{{$page-1}}">Prev</button>
                         @endif
                         <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    @endif

                    @endforeach
                    {{csrf_field()}}
                    </form>
               </div>
          </div>
     </div>
</main>

@endsection

@section('js')
@foreach($form->input as $input)
@if($input->type == 'score')
@include('admin.kasus.form-builder.components-view.score-js')
@endif
@endforeach

<script type="text/javascript">


     $('.btn-secondary').click(function(){
          targetPage = $(this).data("go");
          $(".page").each(function() {
               if($(this).data("page") != targetPage) $(this).hide();
               else elementin = $(this)
          });

          elementin.fadeIn();


     })
</script>


@endsection