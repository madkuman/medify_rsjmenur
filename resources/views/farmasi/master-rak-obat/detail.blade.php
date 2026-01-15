@extends('farmasi.layouts.main')

@section('title')
Detail Master Rak Obat
@endsection

@section('content')
<div class="block">
   <div class="row pl-4 pt-4">
      <div class="col-12">
         <a href="{{url('farmasi/'.session('farmasi')->slug.'/master-rak-obat')}}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
      </div>
   </div>
   <div class="block-header bordered">
      <h3 class="block-title">
         <small>Master Rak Obat</small> <br>
         {{$master_rak_obat->nama}}
      </h3>
      <div class="block-options">
         <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/master-rak-obat/delete')}}">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$master_rak_obat->id}}">
         </form>
         <button type="submit" class="confirm-del btn btn-secondary btn-square">
            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
         </button>
         <button type="button" class="btn btn-secondary btn-square" id="edit-master-rak-obat">
            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
         </button>
      </div>
      <hr class="my-5">
   </div>
   <div class="block-content">
      <div class="block block-transparent">
         <div class="row">
            <div class="col">
               <label>DIBUAT OLEH</label>
               <h5>{{$master_rak_obat->creator->name ?? '-'}}</h5>
            </div>
            <div class="col">
               <label>TANGGAL DIBUAT</label>
               <h5>{{ indonesian_date($master_rak_obat->created_at) }}</h5>
            </div>
         </div>
      </div>
   </div>
</div>

@include('farmasi.master-rak-obat.modals.modal-edit')
@endsection

@section('css')
<style type="text/css">
   .bordered {
      border-bottom: 1px solid #eaecee;
   }
</style>
@endsection

@section('js')
<script type="text/javascript">
   $('#edit-master-rak-obat').on('click', function(){
      $('#modal-normal').modal('show');
   });

   $('.confirm-del').on('click', function(){
      var deleteSupp = $(this).parent().find('form');
      swal({
         title: 'Apa anda yakin?',
         text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#d26a5c',
         confirmButtonText: 'Hapus',
         html: false,
         preConfirm: function() {
            return new Promise(function (resolve) {
               setTimeout(function () {
                     resolve();
               }, 50);
            });
         }
      }).then(function(result){
         if (result.value) {
             deleteSupp.submit();
         } else if (result.dismiss === 'cancel') {
             swal('Batal', 'Hapus data dibatalkan.', 'error');
         }
      });
   });
</script>
@endsection