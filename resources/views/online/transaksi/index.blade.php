@extends('layouts.main2')

@section('title')
Daftar Pemesanan
@endsection

@section('css')

@endsection

@section('content')
<main id="main-container">
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('assets/img/photos/photo26@2x.jpg');">
        <div class="bg-black-op-75">
            <div class="content content-top content-full text-center">
                <div class="py-20">
                    <h1 class="h2 font-w700 text-white mb-10">Online Admission</h1>
                    <h2 class="h4 font-w400 text-white-op mb-0">Pendaftaran Layanan Rumah Sakit Secara Online, Wow!</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="content-heading">
            Statistik <small class="d-none d-sm-inline">Hari Ini</small>
        </div>
        <div class="row gutters-tiny">
            <!-- Pending -->
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded block-transparent bg-gd-sun">
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="{{$statistik->total}}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Total Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pending -->

            <!-- Canceled -->
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded block-transparent bg-gd-cherry">
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="{{$statistik->expired}}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Expired</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Canceled -->

            <!-- Completed -->
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded block-transparent bg-gd-lake">
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="{{$statistik->poli}}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Rawat Jalan</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Completed -->

            <!-- All -->
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded block-transparent bg-gd-dusk">
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-white" data-toggle="countTo" data-to="{{$statistik->medcheck}}">0</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Medical Checkup</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END All -->
        </div>
        <!-- END Statistics -->

        <!-- Orders -->
        <div class="content-heading">
            Transaksi (35)
        </div>
        <div class="block block-rounded">
            <div class="block-content" id="filter">
                <form method="GET">
                    <div class="form-group row">
                        <div class="col-3">
                            <label>Status Transaksi</label>
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="waiting" id="filter-pagi" value="1"  @if($waiting == 1) checked @endif>
                                <label class="custom-control-label" for="filter-pagi">Menunggu Konfirmasi</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="confirmed" id="filter-siang" value="1"  @if($confirmed == 1) checked @endif>
                                <label class="custom-control-label" for="filter-siang">Selesai</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" name="expired" id="filter-sore" value="1" @if($expired == 1) checked @endif>
                                <label class="custom-control-label" for="filter-sore">Expired</label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pasien</th>
                            <th class="">Tujuan Layanan</th>
                            <th class="">Status</th>
                            <th class="">Kode Booking</th>
                            <th class="">Expired Dalam</th>
                            <th class="text-center">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>

                       
                        @foreach($transaksi as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="font-w600">{{$item->pasien->name}}</td>
                            <td class="">@if(!empty($item->layanan->nama)) {{$item->layanan->nama}} @endif</td>
                            <td class="">{{$item->status_text}}</td>
                            <td class="">{{15000 + $item->kode_booking}}</td>
                            <td class="">
                                 @if($item->status_expired == -1)
                                <span class="badge badge-danger">{{ $item->expired_human  }}</span>
                                @elseif($item->status_expired == 0)
                                <span class="badge badge-success">{{ $item->expired_human  }}</span>
                                @elseif($item->status_expired == 1)
                                <span class="badge badge-primary">Selesai</span>
                                @endif
                            </td>
                            <td class="text-center"><button class="btn btn-primary" onclick="konfirmasi({{$item->id}})">Konfirmasi</button></td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Orders -->
    </div>
    <!-- END Page Content -->
</main>

<form method="POST" id="formDelete" action="{{url('online/transaksi/konfirmasi')}}">
    {{csrf_field()}}
    <input id="inputDeleteID" type="hidden" name="id">
</form>

@endsection

@section('js')




<script type="text/javascript">
    jQuery('.js-dataTable-full').dataTable({
        "ordering": true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        autoWidth: false
    });

    function konfirmasi(id)
    {
        $('#inputDeleteID').val(id);
        swal({
            title: 'Are you sure?',
            text: "Apakah anda yakin telah menerima uang transfer ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-outline-primary',
            confirmButtonText: 'Ya, konfirmasi!',
            showLoaderOnConfirm: true,
            preConfirm: function(){
                $('#formDelete').submit();
            }
        })
    }
</script>
@endsection
