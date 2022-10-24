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
          <div class="row">
               @include('kasus.layouts.sidebar')
               <div class="col-lg-9">
                    <div class="block">
                         <div class="block-content">
                              @if(session('my_role_'.$kasus->nomor_kasus))
                              <a href="{{url()->current()}}/create" class="btn-alt btn-rounded btn-primary min-width-125 float-right"><i class="fa fa-pencil"></i> Isi Form Baru</a>
                              @endif
                              <h4>{{$form->judul}} </h4>
                              @forelse($hasil as $item)
                              <div class="p-20">
                                   <hr class="my-20">
                                   <a href="{{url()->current()}}/hasil/{{$item->id}}"><h5 class="mb-5 text-primary">Hasil {{$item->form->judul}} {{$loop->iteration}}</h5></a>
                                   <div class="creator">
                                        <h6 class="pt-10">
                                             <small class="text-muted">Dibuat Oleh</small><br>
                                             {{$item->creator->name}}<br>
                                             {{date('d F y, H:i', strtotime($item->created_at))}}
                                        </h6>
                                   </div>
                              </div>
                              @empty

                              <div class="text-center py-50">
                                   <h4 class="font-w400 mb-5">Belum ada hasil {{$form->judul}} tersedia</h4>
                                   <p>Klik tombol <b>Isi Form Baru</b> untuk mengisi form {{$form->judul}}</p>
                              </div>

                              @endforelse
                         </div>
                    </div>
               </div>
          </div>
     </div>
</main>

@endsection

@section('js')


@endsection