@extends('rawatinap.layouts.main')

@section('title')
    {{ $bangsal->nama }} - Rawat Inap - Medify
@endsection

@section('subtitle')
    {{ $bangsal->nama }}
@endsection

@section('content')
    <main id="main-container">
        @include('rawatinap.layouts.navbar')
        <div class="container">
            <div class="row gutters-tiny">
                <div class="col">
                    <div class="block text-center">
                        <div class="block-content">
                            <p class="font-size-h1 mb-5 text-success">
                                <strong>{{ $bangsal->count_tempat_tidur_total - $bangsal->count_tempat_tidur_kosong }}</strong>
                            </p>
                            <p class="font-size-md font-w600 text-uppercase">
                                Bed Terisi
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="block text-center">
                        <div class="block-content">
                            <p class="font-size-h1 mb-5 text-success">
                                <strong>{{ $bangsal->count_tempat_tidur_kosong }}</strong>
                            </p>
                            <p class="font-size-md font-w600 text-uppercase">
                                Bed Kosong
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-10">Daftar Pasien</h4>

            <div class="form-group">
                <input type="text" class="form-control fuzzy-search" placeholder="Cari Pasien">
            </div>
            <div id="kasus-rawatinap">
                <ul class="list">
                    @php $count = 0; @endphp
                    @foreach ($bangsal->ruangan as $ruang)
                        @foreach ($ruang->bed as $bed)
                            <li>
                                <div class="block">
                                    <div
                                        class="block-content pb-20 @if (empty($bed->transaksi->pasien)) bg-secondary-lighter @endif ">
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 text-center h-100 d-flex align-self-center">
                                                <h5 class="mb-0">{{ $ruang->nama }} - {{ $bed->nama }}</h5>
                                            </div>
                                            <div class="col-md-1 p-0 text-center flex-center-vertically">
                                                @if (!empty($bed->transaksi->pasien))
                                                    <img class="img-avatar full-only"
                                                        src="{{ asset('') }}/{{ $bed->transaksi->pasien->photo_thumb }}">
                                                @endif
                                            </div>
                                            <div class="col-md-3 h-100 d-flex align-self-center">
                                                <h4 class="mb-0 ">
                                                    @if (!empty($bed->transaksi->pasien))
                                                        <span class="nama"> {{ $bed->transaksi->pasien->name }}</span>
                                                        <br>
                                                        <small class="font-w400">

                                                            @if ($bed->transaksi->pasien->gender == 1)
                                                                Laki laki
                                                            @else
                                                                Perempuan
                                                            @endif
                                                            , {{ $bed->transaksi->pasien->age }}

                                                            <br>
                                                            No RM : <span class="no_rm">
                                                                {{ $bed->transaksi->pasien->no_rm }}</span>
                                                            <br>
                                                            @php
                                                                $tgl_daftar = '-';
                                                                $tgl_datang = '-';
                                                                if (!empty($bed->transaksi)) {
                                                                    if (!empty($bed->transaksi->waktu_masuk)) {
                                                                        $tgl_daftar = date(
                                                                            'd M Y, H:i',
                                                                            strtotime($bed->transaksi->waktu_masuk),
                                                                        );
                                                                    }

                                                                    if (!empty($bed->transaksi->kedatangan_at)) {
                                                                        $tgl_datang = date(
                                                                            'd M Y, H:i',
                                                                            strtotime($bed->transaksi->kedatangan_at),
                                                                        );
                                                                    }
                                                                }
                                                            @endphp
                                                            Daftar : {{ $tgl_daftar }}
                                                            <br>
                                                            Datang : {{ $tgl_datang }}
                                                            <br>
                                                            <span class="dpjp"> DPJP :
                                                                {{ $bed->transaksi->kasus->admin->user->name ?? '-' }}
                                                            </span>
                                                            @php
                                                                $los = $bed->transaksi->kasus->ranap_los ?? 0;
                                                                $now = date('Y-m-d');
                                                                $tgl1 = new DateTime($now);
                                                                $tgl2 = new DateTime($bed->transaksi->waktu_masuk);
                                                                $d = $los ?? $tgl2->diff($tgl1)->days + 1;
                                                            @endphp
                                                            <br>
                                                            Masa Rawat inap :
                                                            @if ($d < 3)
                                                                <span class="badge badge-info">{{ $d }}
                                                                    Hari</span>
                                                            @else
                                                                <span class="badge badge-danger">{{ $d }}
                                                                    Hari</span>
                                                            @endif
                                                        </small>
                                                    @endif
                                                </h4>
                                            </div>
                                            <div class="col-md-3 h-100 d-flex align-self-center">
                                                @if (!empty($bed->transaksi))
                                                    @if ($bed->transaksi->kasus_id != 0)
                                                        <h5 class="mb-0"><small class="font-w400">Judul Kasus</small><br>
                                                            <span class="judul_kasus">
                                                                {{ $bed->transaksi->kasus->judul_kasus }}</span>
                                                        @else
                                                            -
                                                    @endif
                                                @endif
                                                </h5>
                                            </div>
                                            <div class="col-md-3 h-100 d-flex align-self-center mt-10">
                                                @if (!empty($bed->transaksi))
                                                    @if (is_null($bed->transaksi->kedatangan_at))
                                                        <form
                                                            action="{{ url('rawatinap/transaksi/konfirmasi') }}/{{ $bed->transaksi['id'] }}"
                                                            method="POST" style="width: 100%;">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-success btn-block btn-click-animate"
                                                                type="submit">Konfirmasi</button>
                                                        </form>
                                                    @elseif($bed->transaksi->kasus_id != 0)
                                                        <a href="{{ url('kasus') }}/{{ $bed->transaksi->kasus->nomor_kasus }}"
                                                            class="btn btn-primary btn-block">Kunjungi</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if (!empty($bed->transaksi))
                                        @include('rawatinap.bangsal.components-transaksi-file', [
                                            'transaksi' => $bed->transaksi,
                                        ])
                                    @endif

                                    @if (!empty($bed->booking_id))
                                        <hr>
                                        <div
                                            class="block-content pb-20 @if (empty($bed->transaksi->pasien)) bg-secondary-lighter @endif ">
                                            <div class="row p-0 m-0">
                                                <div class="col-md-2 text-center h-100 d-flex align-self-center">
                                                </div>
                                                <div class="col-md-1 p-0 text-center flex-center-vertically">
                                                    @if (!empty($bed->booking->pasien))
                                                        <img class="img-avatar full-only"
                                                            src="{{ asset('') }}/{{ $bed->booking->pasien->photo_thumb }}">
                                                    @endif
                                                </div>
                                                <div class="col-md-3 h-100 d-flex align-self-center">
                                                    <h4 class="mb-0">
                                                        @if (!empty($bed->booking->pasien))
                                                            {{ $bed->booking->pasien->name }}
                                                            <br>
                                                            <small class="font-w400">
                                                                @if (!empty($bed->booking->pasien))
                                                                    @if ($bed->booking->pasien->gender == 1)
                                                                        Laki laki
                                                                    @else
                                                                        Perempuan
                                                                    @endif
                                                                    , {{ $bed->booking->pasien->age }}
                                                                @endif

                                                                <br>
                                                                No RM : <span class="no_rm">
                                                                    {{ $bed->booking->pasien->no_rm }}</span>
                                                                <br>
                                                                @php
                                                                    $tgl_daftar = '-';
                                                                    $tgl_datang = '-';
                                                                    if (!empty($bed->booking)) {
                                                                        if (!empty($bed->booking->waktu_masuk)) {
                                                                            $tgl_daftar = date(
                                                                                'd M Y, H:i',
                                                                                strtotime($bed->booking->waktu_masuk),
                                                                            );
                                                                        }

                                                                        if (!empty($bed->booking->kedatangan_at)) {
                                                                            $tgl_datang = date(
                                                                                'd M Y, H:i',
                                                                                strtotime($bed->booking->kedatangan_at),
                                                                            );
                                                                        }
                                                                    }
                                                                @endphp
                                                                Daftar : {{ $tgl_daftar }}
                                                                <br>
                                                                Datang : {{ $tgl_datang }}
                                                                <br>
                                                                <span class="dpjp"> DPJP :
                                                                    {{ $bed->booking->kasus->admin->user->name ?? '-' }}
                                                                </span>
                                                            </small>
                                                        @endif
                                                    </h4>
                                                </div>

                                                <div class="col-md-4 h-100 d-flex align-self-center">
                                                    @if (!empty($bed->booking))
                                                        @if ($bed->booking->kasus_id != 0)
                                                            <h5 class="mb-0"><small class="font-w400">Judul
                                                                    Kasus</small><br>
                                                                {{ $bed->booking->kasus->judul_kasus }}
                                                            @else
                                                                -
                                                        @endif
                                                    @endif
                                                    </h5>
                                                </div>
                                                <div class="col-md-2 h-100 d-flex align-self-center">
                                                    @if (!empty($bed->booking))
                                                        @if (is_null($bed->booking->kedatangan_at))
                                                            <form
                                                                action="{{ url('rawatinap/transaksi/konfirmasi') }}/{{ $bed->booking['id'] }}"
                                                                method="POST" style="width: 100%;">
                                                                {{ csrf_field() }}
                                                                <button class="btn btn-success btn-block btn-click-animate"
                                                                    type="submit">Konfirmasi</button>
                                                            </form>
                                                        @elseif($bed->booking->kasus_id != 0)
                                                            <a href="{{ url('kasus') }}/{{ $bed->booking->kasus->nomor_kasus }}"
                                                                class="btn btn-primary btn-block">Kunjungi</a>
                                                        @endif
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                        @if (!empty($bed->booking))
                                            @include('rawatinap.bangsal.components-transaksi-file', [
                                                'transaksi' => $bed->booking,
                                            ])
                                        @endif
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </main>

@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/listjs/list.min.js') }}"></script>
    <script type="text/javascript">
        var options = {
            valueNames: ['nama', 'no_rm', 'judul_kasus', 'dpjp']
        };

        var rawatInapList = new List('kasus-rawatinap', options);

        $(".fuzzy-search").keyup(function() {
            rawatInapList.search($(this).val());
        });

        function permintaan_gizi(kasus_id) {
            window.open(
                "{{ url('gizi') }}/pemesanan/baru?kasus_id=" + kasus_id, "popUpWindow",
                "height=800,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes"
                );
        }
    </script>
@endsection
