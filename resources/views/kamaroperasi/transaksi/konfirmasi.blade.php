@extends('layouts.main2')

@section('title')
Pemesanan Kamar - Kamar Operasi - Medify
@endsection

@section('sidebarcomponent')
@include('kamaroperasi.components.sidebar')
@endsection

@section('content')
<div class="content pt-100 px-100">
  <div class="mt-50 mb-30 text-center">
    <h2 class="font-w700 text-black mb-10">Penjadwalan Operasi</h2>
    <h3 class="h5 text-muted mb-0">Konfirmasi</h3>
  </div>

  <div class="row row-deck">

    <div class="col-xl-4">
      <div class="block text-center">
        <div class="block-content block-content-full block-content-sm bg-primary text-white">
          <div class="font-w600">Informasi Pasien</div>
        </div>
        <div class="block-content block-content-full block-sticky-options pt-30 bg-body-light">
          <img class="img-avatar" src="{{asset('assets/img/avatars/avatar9.jpg')}}" alt="">
        </div>
        <div class="block-content">
          <div class="items-push">
            <div class="h5 mb-0">{{$transaksi->pasien_detail->name}}</div>
            <div class="text-muted mb-0">{{$transaksi->pasien_detail->gender == 1 ? 'Laki laki' : 'Perempuan' }}, {{$transaksi->pasien_detail->age}} Tahun</div>
            <div class="text-muted">{{$transaksi->pasien_detail->address}}</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4">
      <div class="block text-center">
        <div class="block-content block-content-full block-content-sm bg-success text-white">
          <div class="font-w600">Informasi Jadwal</div>
        </div>
        <div class="block-content pt-50">
          <div class="items-push">
            <div class="h5 mb-10">{{$jadwal}}</div>
            <div class="h5 mb-10">Ruangan : {{$ruang->name}}</div>
            <div class="h5">Ronde {{$ronde}}</div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-4">
      <div class="block text-center">
        <div class="block-content block-content-full block-content-sm bg-danger text-white">
          <div class="font-w600">Informasi Dokter</div>
        </div>
        <div class="block-content block-content-full block-sticky-options pt-30 bg-body-light">
          <img class="img-avatar" src="{{asset('assets/img/avatars/avatar9.jpg')}}" alt="">
        </div>
        <div class="block-content">
          <div class="items-push">
            <div class="h5">{{$dokter->name}}</div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="row">
    <div class="col-md-12 text-center">
      <form method="POST" action="{{url('kamaroperasi/pemesanan/'.$transaksi->id.'/submit')}}">
        {{csrf_field()}}
        <input type="hidden" value="{{$ruang->id}}" name="kamar_id">
        <input type="hidden" value="{{$transaksi->id}}" name="transaksi_id">
        <input type="hidden" value="{{$dokter->id}}" name="dokter_id">
        <input type="hidden" value="{{$ronde}}" name="nomor_ronde">
        <input type="hidden" value="{{$tanggal}}" name="jadwal">
        <button type="button" class="btn btn-danger btn-fill" id="batal-antri">
          <i class="fa fa-trash-o" aria-hidden="true"></i> Batal
        </button>
        <button class="btn btn-primary" type="submit">Daftar</button>
      </form>
    </div>
  </div>

</div>
@endsection

@section('js')
<script type="text/javascript">
  $('document').ready(function() {
    $('#batal-antri').on('click', function() {
      var deleteSupp = $(this).parent().find('form');
      swal({
        title: "Apa anda yakin ?",
        text: "Pemesanan anda akan dibatalkan.",
        type: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-default',
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        closeOnConfirm: false,
        closeOnCancel: false,
        allowOutsideClick: false
      }, function(isConfirm) {
        if (isConfirm) {
          window.location = "{{url('/kamaroperasi/pemesanan')}}";
          swal("Konfirmasi Dibatalkan", "Pemesanan tidak dikonfirmasi. Tidak ada transaksi pemesanan dilakukan.", "error");
        } else {
          swal("Konfirmasi Ulang", "Lakukan konfirmasi pada ruangan.", "error");
        }
      });
    })
  });
</script>
@endsection
