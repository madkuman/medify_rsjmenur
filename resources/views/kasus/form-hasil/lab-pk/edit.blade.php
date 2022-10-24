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
                    <a href="{{url('kasus/'.$kasus->nomor_kasus.'/form/'.$slug.'/labpk/'.$form->id)}}">Kembali ke Halaman Sebelumnya</a>
                    <div class="block mt-5">
                         <form method="POST" action="{{url()->current()}}">
                         <div class="block-content pb-20">
                              <h4 class="mb-5">{{$form->judul}}</h4>
                              <p>{{$form->deskripsi}}</p>
                              <hr class="mb-20">
                              @foreach($form->input as $input)
                              <div class="form-group form-builder">
                                   @include('kasus.form.lab-pk.component-view.input')
                              </div>

                              @endforeach                         
                              <button class="btn btn-primary" type="submit">Submit</button>
                         {{csrf_field()}}
                         </form>

                    </div>
               </div>
          </div>
     </div>
</main>

@endsection