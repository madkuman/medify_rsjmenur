@include('kasus.layouts.kolaborator-extra.index')
@php
$header = $kasus->header;
@endphp

<div class="bg-image" style="background-image: url('{{ asset('assets/img/bg8.jpg') }}');">
    <div class="bg-black-op-75">
        <div class="content content-full">
            <div class="row gutters-tiny py-20">
                <div class="col-1">
                    <div class="full-only">
                        <img class="img-avatar img-avatar-thumb" src="{{ asset($kasus->identitas->avatar_thumb) }}"
                            alt="">
                    </div>
                </div>
                <div class="col-10">
                    <div class="pull-right">
                        @if (!empty($kasus->krs_at))
                        <p class="bg-danger text-white px-10">
                            Pasien Telah KRS pada {{ date('d F Y H:i', strtotime($kasus->krs_at)) }}
                        </p>
                        @endif
                        @if (!empty($kasus->end_at))
                        <p class="bg-danger text-white px-10">
                            Kasus Telah Ditutup pada {{ date('d F Y H:i', strtotime($kasus->end_at)) }}
                            <br>oleh {{ $kasus->end_by_creator->name }}
                        </p>
                        @endif
                    </div>
                    <h1 class="h3 font-w500 text-white mb-5">{{ $header->kasus_judul_kasus }}</h1>
                    <h2 class="h5 font-w500 text-white-op mb-0">{{ $header->identitas_nama }}
                        {{ '#' . $kasus->pasien->no_rm_formatted ?? '' }}</h2>
                    <h2 class="h6 font-w400 text-white-op mb-0">
                        @if ($header->identitas_jenis_kelamin == 'L')
                        Laki laki
                        @else
                        Perempuan
                        @endif
                        ,
                        @if (!empty($kasus->pasien->detail_long_age))
                        {{ $kasus->pasien->detail_long_age }}
                        @else
                        {{ $kasus->identitas->age }}
                        @endif
                    </h2>
                    <h2 class="h6 font-w400 text-white-op mb-0">{{ $header->lokasi_departemen_nama }} -
                        {{ $header->lokasi_nama }} - Kelas {{ $header->kelas_nama }}
                    </h2>
                    @if (!empty($kasus->mrs_at))
                    <h2 class="h6 font-w400 text-white-op mb-5">Tanggal MRS:
                        {{ date('d F Y, H:i', strtotime($kasus->mrs_at)) }}
                    </h2>
                    @else
                    <h2 class="h6 font-w400 text-white-op mb-5">Tanggal MRS:
                        {{ date('d F Y, H:i', strtotime($kasus->created_at)) }}
                    </h2>
                    @endif

                    @if ($kasus->pembayaran->perusahaan->type != 2)
                    @php

                    $total_pemakaian = $header->sep_total_pemakaian ?? ($kasus->tagihan_header ?? 0);
                    $total_plafon = $header->sep_total_plafon ?? $kasus->plafon;
                    $sisaPlafon = $total_plafon - $total_pemakaian;
                    @endphp
                    @if ($sisaPlafon <= 0) <h6 class="text-danger mb-0">
                        @elseif($sisaPlafon < 100000) <h6 class="text-warning mb-0">
                            @else
                            <h6 class="text-white mb-0">
                                @endif
                                SISA PLAFON : Rp {{ number_format($sisaPlafon) }}
                                @if ($sisaPlafon < 100000) <i class="fa fa-exclamation-triangle"></i>
                                    @endif
                            </h6>
                            <h6 class="text-white mb-0">
                                TOTAL PLAFON : Rp
                                {{ number_format($total_plafon) }}
                            </h6>
                            @endif
                            @if (Auth::user()->dokter->bpjs_kode_dpjp == $kasus->sep->dpjp)
                            <form>
                                <input type="hidden" id="param" name="param"
                                    value="{{ $kasus->pembayaran->no_asuransi ?? $kasus->pasien->no_identitas }}">
                                <input type="hidden" id="kodedokter" name="kodedokter"
                                    value="{{ $kasus->admin->user->dokter->bpjs_kode_dpjp ?? ''}}">
                                {{-- value="{{ $kasus->sep->dpjp ?? ''}}"> --}}
                                <button class="btn btn-primary" type="button" onclick="getIcare()">ICare BPJS</button>
                            </form>
                            @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('kasus.home.components.punya-anak')
@include('kasus.home.components.punya-ibuk')

@push('js')
<script>
    function getIcare() {
        var param = $('#param').val();
        var kodedokter = $('#kodedokter').val();

        $.ajax({
            url: "{{ route('icare') }}",
            type: 'POST',
            data: {
                param: param,
                kodedokter: kodedokter
            },
            success: function(data) {
                window.open(data.url, 'miniWindow', 'width=600,height=400');
            }
        });
    }
</script>

@endpush