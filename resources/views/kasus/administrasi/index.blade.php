@extends('kasus.layouts.main')

@section('title')
{{$kasus->judul_kasus}}  - Administrasi - Kasus
@endsection

@section('content')

<!-- Main Container -->
<main id="main-container">
    @include('kasus.layouts.header')

    <div class="content">
        <div class="row">
            @include('kasus.layouts.sidebar')

            <!-- Updates -->
            <div class="col-lg-9 col-xl-9">
                <div class="row row-deck">
                        @if(empty($kasus->end_at))

                        {{--
                        <div class="col-md-12 alert alert-dark">
                        <h5 class="mb-0">{{$current_transaksi_utama->modul->name}}
                            {{$current_transaksi_utama->id}}</h5>
                        </div>
                        --}}

                        @if(empty($kasus->pasien_id))
                        <div class="col-12">
                            <div class="block">
                                <div class="block-content tab-content overflow-hidden">
                                    <div class="col-12 text-center py-50">
                                        <h4 class="font-w400 mb-5">Data pasien belum tersinkronisasi. Silahkan lakukan Sinkronisasi dahulu</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @if($kasus->lokasi->lokasi->departemen->slug != 'rawat-inap' && empty($kasus->krs_at))
                        <div class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="javascript:void(0)" onclick="daftarInap()">
                                <div class="block-header">
                                    <h3 class="block-title">Rawat Inap</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-bed fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5">Daftar Rawat Inap</h5>
                                    <p>Daftarkan pasien untuk di rawat inapkan</p>
                                </div>
                            </a>
                        </div>
                        @endif


                        @if($kasus->lokasi->lokasi->departemen->slug == 'rawat-inap' && empty($kasus->krs_at))
                        <div class="col-md-4 text-center">
                           <a class="block block-link-pop block-themed" href="javascript:void(0)" onclick="pindahRawatInap()">
                            <div class="block-header">
                                <h3 class="block-title">Rawat Inap</h3>
                            </div>
                            <div class="block-content">
                                <p class="mt-5 mb-10">
                                    <i class="fa fa-bed fa-4x "></i>
                                </p>
                                <h5 class="mb-5 ">Pindah Ruang Rawat Inap</h5>
                                <p class="">Pasien dapat pindah ke ruangan rawat inap lain.</p>
                            </div>
                            </a>
                        </div>
                        @endif
                        @if(empty($kasus->krs_at) && $kasus->pasien->gender == 2 && ($kasus->tipe_ri == 1 || $kasus->tipe_igd == 1))
                        <div class="col-md-4 text-center">
                           <a class="block block-link-pop block-themed" href="javascript:void(0)" onclick="bayiBaruLahir()">
                            <div class="block-header">
                                <h3 class="block-title">Kelahiran</h3>
                            </div>
                            <div class="block-content">
                                <p class="mt-5 mb-10">
                                    <i class="fa fa-child fa-4x "></i>
                                </p>
                                <h5 class="mb-5 ">Bayi Baru Lahir</h5>
                                <p class="">Buat kasus baru untuk bayi dari pasien yang melahirkan.</p>
                            </div>
                            </a>
                        </div>
                        @endif


                        @if($kasus->lokasi->lokasi->departemen->slug == 'rawat-jalan'  && empty($kasus->krs_at))
                        <div class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{url('pasien')}}/{{$kasus->pasien->id}}/{{$kasus->nomor_kasus}}/rujuk/rawatjalan">
                                <div class="block-header bg-success">
                                    <h3 class="block-title">Rawat Jalan</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-stethoscope fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5">Rujuk ke Poli Lain</h5>
                                    <p>Rujukkan pasien ke poli lain</p>
                                </div>
                            </a>
                        </div>
                        @endif


                        @if($kasus->lokasi->lokasi->departemen->slug == 'igd'  && empty($kasus->krs_at))
                        <div class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{url('pasien')}}/{{$kasus->pasien->id}}/{{$kasus->nomor_kasus}}/rujuk/igd" onclick="">
                                <div class="block-header bg-pulse">
                                    <h3 class="block-title">IGD</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-plus fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5">Pindah Ruangan IGD</h5>
                                    <p>Pindahkan pasien ke ruang IGD lain</p>
                                </div>
                            </a>
                        </div>
                        @endif
                        
                        {{--


                        <div class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed">
                                <div class="block-header bg-corporate-dark">
                                    <h3 class="block-title">Rujuk</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-ambulance fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5">Rujuk ke Rumah Sakit Lain</h5>
                                    <p>Anda akan mendapatkan resume lengkap untuk rumah sakit tujuan.</p>
                                </div>
                            </a>
                        </div>
                        --}}
                        <div class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="{{url('kamarjenazah')}}/permintaan_jemput/{{$kasus->pasien->id}}?kasus_id={{$kasus->id}}">
                                <div class="block-header bg-primary-darker">
                                    <h3 class="block-title">Kamar Jenazah</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-ambulance fa-4x "></i>
                                    </p>
                                    <h5 class="mb-5">Permintaan Jemput Jenazah</h5>
                                    <p>Anda akan melakukan permintaan penjemputan jenazah.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a class="block block-link-pop block-themed" href="javascript:void(0)" data-target="#unit-tindakan-modal" data-toggle="modal">
                                <div class="block-header bg-success">
                                    <h3 class="block-title">Unit Tindakan</h3>
                                </div>
                                <div class="block-content">
                                    <p class="mt-5 mb-10">
                                        <i class="fa fa-signing fa-4x"></i>
                                    </p>
                                    <h5 class="mb-5">Daftarkan Unit Tindakan</h5>
                                    <p>Anda akan mendaftarkan pasien ini ke unit tindakan tertentu</p>
                                </div>
                            </a>
                        </div>

                    @endif
                    @endif
                </div>
                @if(count($histori) > 0)
                <div class="row mb-15">
                    <div class="col-12 pl-5">
                        <div class="block mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Riwayat Rawat Inap Pasien</h3>
                                <div class="block-options">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th class="text-center" style="width: 15%;">Tgl Masuk</th>
                                        <th class="text-center" style="width: 15%;">Tgl Keluar</th>
                                        <th class="text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histori as $item)
                                    @if(isset($item->tempat_tidur) or $item->is_pindah != 1)
                                    <tr>
                                        <td>
                                            @if(isset($item->tempat_tidur))
                                            Rawat Inap - {{$item->tempat_tidur->ruangan->bangsal->nama ?? '-'}} - {{$item->tempat_tidur->ruangan->nama ?? '-'}} - {{$item->tempat_tidur->nama ?? '-'}}
                                            @elseif($item->is_pindah != 1)
                                            (Pasien Belum Didaftarkan Pada Rawat Inap)
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->waktu_masuk, '%e %B %Y')}}
                                        </td>
                                        <td class="text-center">
                                            @if(isset($item->waktu_keluar))
                                              {{app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($item->waktu_keluar, '%e %B %Y')}}
                                            @else
                                            (Belum Keluar)
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == -1)
                                            <div class="badge badge-pill badge-danger">
                                                Ditolak
                                            </div>
                                            @elseif($item->status == 0)
                                            <div class="badge badge-pill badge-warning">
                                                Menunggu Konfirmasi
                                            </div>
                                            @elseif($item->status == 1)
                                                @if(isset($item->waktu_keluar))
                                                <div class="badge badge-pill badge-primary">
                                                    Telah Keluar
                                                </div>
                                                @elseif(!isset($item->kedatangan_at))
                                                <div class="badge badge-pill badge-primary">
                                                    Pasien Belum Diantarkan
                                                </div>
                                                @else
                                                <div class="badge badge-pill badge-success">
                                                    Lokasi Sekarang
                                                </div>
                                                @endif
                                            @elseif($item->status == 2)
                                            <div class="badge badge-pill badge-info">
                                                Menunggu Tempat Tidur Kosong
                                            </div>
                                            @elseif($item->status == 3)
                                            <div class="badge badge-pill badge-primary">
                                                Telah Keluar
                                            </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == 0)
                                            <button type="button" id="batalkan" class="btn btn-danger" onclick="tolakTransaksi({{$item->id}})">
                                            Batalkan
                                            </button>
                                            @endif
                                            @if($item->status != -1)
                                            <button type="button" class="btn btn-secondary" onclick="printOpnameRiwayatRawatInap({{$item->id}})">
                                            Print Opname Rawat Inap
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($histori_jalan) > 0)
                <div class="row mb-15">
                    <div class="col-12 pl-5">
                        <div class="block mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Riwayat Rawat Jalan Pasien</h3>
                                <div class="block-options">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20%;">Poli Asal</th>
                                        <th class="text-center" style="width: 20%;">Poli Tujuan</th>
                                        <th class="text-center" style="width: 20%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histori_jalan as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{$item->poli_asal->nama}}
                                        </td>
                                        <td class="text-center">
                                            {{$item->poli_tujuan->name}}
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == -1)
                                            <div class="badge badge-pill badge-danger">
                                                Ditolak
                                            </div>
                                            @elseif($item->status == 0)
                                            <div class="badge badge-pill badge-warning">
                                                Menunggu Konfirmasi
                                            </div>
                                            <button type="button" id="batalkan" class="btn btn-danger" onclick="tolakTransaksi2({{$item->id}})">
                                            Batalkan
                                            </button>
                                            @elseif($item->status == 1)
                                                <div class="badge badge-pill badge-success">
                                                    Selesai
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-12 pl-5">
                        <div class="block mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Histori Administrasi</h3>
                                <div class="block-options">
                                </div>
                            </div>
                            <div class="block-content block-content-full">
                                <ul class="list list-timeline list-timeline-modern pull-t">
                                    <!-- Twitter Notification -->

                                    @php $showEmptyActivity = 0 @endphp
                                    @forelse($activities as $item)
                                    <li>
                                        <div class="list-timeline-time">{{$item->tanggal}} ago</div>
                                        <i class="list-timeline-icon fa {{$item->icon}} bg-info"></i>
                                        <div class="list-timeline-content">
                                            <p class="font-w600">{{$item->tab_string}}</p>
                                            <p><strong>{{$item->creator->name}}</strong> {{$item->type_string}} {{$item->tab_string}}</p>
                                        </div>
                                    </li>
                                    @empty
                                    @php $showEmptyActivity = 1 @endphp
                                    @endforelse
                                    <!-- END Twitter Notification -->

                                    

                                    
                                </ul>
                                @if($showEmptyActivity)
                                <div class="text-center py-50">
                                    <h4 class="font-w400 mb-5">Tidak ada aktivitas administrasi.</h4>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Updates -->
        </div>
    </div>
</main>
<form method="POST" action="{{url('rawatinap/transaksi/pendaftaran/tolak')}}" id="formTolak">
    {{csrf_field()}}
    <input type="hidden" id="tolakId" name="transaksi_id">
    <input type="hidden" id="tolakKeterangan" name="keterangan">
</form>
<form method="POST" action="{{url('rawatjalan/transaksi/pendaftaran/tolak')}}" id="formTolak2">
    {{csrf_field()}}
    <input type="hidden" id="tolakId2" name="transaksi_id">
    <input type="hidden" id="tolakKeterangan2" name="keterangan">
</form>
@include('kasus.administrasi.modals.bayi')
@include('kasus.administrasi.modals.daftar_inap')
@include('kasus.administrasi.modals.unit-tindakan')
<!-- END Main Container -->    
@endsection

@section('js')
@include('kasus.administrasi.js.bayi')
@include('kasus.administrasi.js.rawat_inap')
@include('kasus.administrasi.js.administrasi')
@include('kasus.administrasi.js.unit-tindakan')
@endsection