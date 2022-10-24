@extends('layouts.main2')

@section('title')
Permintaan Operasi - Medify
@endsection

@section('sidebarcomponent')
@include('kamaroperasi.components.sidebar')
@endsection

@section('content')
<main id="main-container">
    <div class="content">
        @include('kamaroperasi.components.navbar')
        <div class="row">

            <div class="col-12">
                <div class="block block-themed">
                    <div class="block-header bg-success text-center" >
                        Permintaan Jadwal Operasi
                        <a href="{{url('kamaroperasi/pendaftaran')}}" class="btn btn-alt-success">Daftarkan Pasien untuk Operasi</a>
                    </div>
                    <div class="block-content">
                        <div class="row text-uppercase font-w600">
                            <div class="col-1 text-center"> # </div>
                            <div class="col-5"> Pasien </div>
                            <div class="col-3 text-center"> Keterangan </div>
                            <div class="col-3 text-center px-0"> Aksi </div>
                            <div class="col-12"><hr></div>
                        </div>
                        <div class="user-list">
                            <ul class="table-list">

                                @php $count = 0; @endphp
                                @forelse($transaksi as $item)
                                <li>
                                    <div class="row">
                                        <div class="col-1 pt-10">
                                            <h4 class="font-w400">{{++$count}}-{{$item->id}}</h4>
                                        </div>
                                        <div class="col-1 px-0">
                                            <img class="img-avatar" src="{{asset('assets/img/faces/avatar.jpg')}}" alt="">
                                        </div>
                                        <div class="col-4">
                                            @if(!empty($item->pasien_detail->name))
                                            {{$item->pasien_detail->name}}
                                            <div class="font-w400 font-size-xs text-muted">{{$item->pasien_detail->jenis_kelamin}}, {{$item->pasien_detail->age}} Tahun</div>
                                            <div class="font-w400 font-size-xs text-muted">
                                                @if($item->kasus_id!=0) Kasus :
                                                <a href="{{url('kasus')}}/{{$item->kasus->nomor_kasus}}"> {{$item->kasus->judul_kasus}}
                                                </a>
                                                @else
                                                -
                                                @endif
                                            </div>
                                            @endif
                                            <div class="font-w400 font-size-xs text-muted">
                                                Tanggal permintaan : {{date('d F y, H:i', strtotime($item->created_at))}}
                                            </div>
                                        </div>
                                        <div class="col-3 pt-15 text-center">
                                            <p class="text-black font-w400">
                                                @if($item->kasus_id==0)
                                                Pendaftaran dari kamar operasi
                                                @else
                                                Permintaan dari kasus
                                            @endif</p>

                                        </div>
                                        <div class="col-3 pt-15 text-center">
                                            <button type="button" class="btn btn-outline-danger btn-fill tolak-pemesanan" data-transaksi = "{{$item->id}}">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Tolak
                                            </button>
                                            <a href="{{url('kamaroperasi/pemesanan/'.$item->id)}}" class="btn btn-primary">Daftarkan</a>
                                        </div>

                                    </div>
                                </li>
                                @empty
                                <li class="text-center h3 mt-20 mb-50">Tidak Ada Permintaan Hari Ini</li>
                                @endforelse


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script type="text/javascript">
  $('document').ready(function() {
    $('.tolak-pemesanan').on('click', function() {
        var id = $(this).data("transaksi");
            //console.log(id);
            swal({
                title: "Apa anda yakin ?",
                text: "Pasien ini akan dihapus dari daftar permintaan operasi.",
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
                    window.location = "{{url('/kamaroperasi/pemesanan/tolak')}}/"+id;
                } else {
                    swal("Tolak Dibatalkan", "Tidak ada data yang berubah.", "error");
                }
            });
        })
});
</script>
@endsection
