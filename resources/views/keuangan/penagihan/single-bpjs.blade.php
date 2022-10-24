@extends('keuangan.layouts.main')

@section('title')
Pembayaran Paket Penagihan - Keuangan
@endsection

@section('css')
@endsection
@section('content')
@include('keuangan.piutang.components.header')

<div class="block">
  <div class="block-content">
    <h4 class="mb-30">{{$paket->judul}}</h4>
    <hr>
    <h5>Nomor Surat : {{is_null($paket->nomor_surat) ? '-' : $paket->nomor_surat}}<button class="btn btn-info ml-50" id="edit_nomor_btn"><i class="fa fa-pencil"></i> Edit</button></h5>
    <hr>
  </div>
  <form id="penagihan_form" method="POST">
    {{csrf_field()}}
  </form>
  <div class="block-content">
      <table class="table table-bordered table-vcenter">
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
        @php $total = 0 @endphp

        @foreach($paket->detail_bpjs as $item)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->kategori_bpjs->name}}</td>
          <td>Rp {{number_format($item->total)}}</td>
          <td>
            <a href="{{url()->current()}}/bpjs/{{$item->id}}" class="btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Detail">&nbsp;<i class="fa fa-search-plus"></i></a>&nbsp
          </td>
        </tr>
          @php $total += $item->total @endphp
          @endforeach
          <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>Rp {{number_format($total)}}</strong></td>
            <td></td>
          </tr>
        </table>
    </div>
    
      <button id="kirim_btn" class="btn btn-hero btn-primary" type="button">
        <i class="fa fa-paperplane"></i>
        Kirim Penagihan
      </button>
  </div>
  @include('keuangan.penagihan.components.modal-edit-nomor-surat')
  @endsection

  @section('js')
    <script type="text/javascript">
      $(document).on('click', '#kirim_btn', function(){
        swal({
            title: 'Simpan Penagihan',
            text: 'Apakah anda yakin mengirim penagihan ini?',
            type: 'info',
            confirmButtonText: 'Ya',
            showCancelButton: true,
            cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.value) {
                $("#penagihan_form").submit();
            }
        });
      })
      $(document).on('click', '#edit_nomor_btn', function(){
        $("#edit_nomor_modal").modal('show');
      })
    </script>
  @endsection