@extends('farmasi.layouts.main')

@section('title')
Master Rak Obat
@endsection

@section('content')
<div class="block">
   <div class="block-header block-header-default">
      <h3 class="block-title">Master Rak Obat</h3>
      <div class="block-options">
         <button type="submit" class="btn btn-sm btn-primary btn-square" data-toggle="modal"
            data-target="#modal-normal">
            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Rak Obat Baru
         </button>
      </div>
   </div>
   <div class="block-content block-content-full">
      <table class="table table-hover" id="table-rak-obat">
         <thead>
            <tr>
               <th style="width: 5%">ID</th>
               <th class="d-none d-sm-table-cell" style="width: 50%; text-align: center">Nama Rak Obat</th>
               <th class="d-none d-sm-table-cell" style="width: 45%; text-align: center">Detail</th>
            </tr>
         </thead>
         <tbody>
            @php $i = 1 @endphp
            @foreach($master_rak_obat as $row)
            <tr data-href="{{url('farmasi/'.session('farmasi')->slug.'/master-rak-obat/'.$row->id)}}">
               <td>{{$i++}}</td>
               <td>
                  <p class="font-w600 mb-0">{{$row->nama}}</p>
               </td>
               <td style="text-align: center">
                  <a href="{{url('farmasi/'.session('farmasi')->slug.'/master-rak-obat/'.$row->id)}}"
                     class="btn btn-sm btn-primary mr-5 mb-5"><i class="fa fa-search-plus"></i> Lihat</a>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>

@include('farmasi.master-rak-obat.modals.modal-add')
@endsection

@section('css')

<style type="text/css">
   .clickable-row {
      cursor: pointer;
   }

   .modal-content {
      border-radius: 0;
   }

   table.dataTable {
      border-collapse: collapse !important;
   }
</style>
@endsection

@section('js')
<script type="text/javascript">
   let table = $('#table-rak-obat').DataTable({
      searching: true,
      ordering: true,
      pageLength: 10,
      lengthChange: false,
      columnDefs: [
         { 
            'searchable': false, 
            'targets': [0,2] 
         },
      ]
   });
  
</script>
@endsection