<div class="content pt-0">

    <div class="row">
        <div class="col-lg-12 mb-5">
            @if (session('my_invitation_' . $kasus->nomor_kasus) &&
                    session('my_invitation_' . $kasus->nomor_kasus)->user->profesi == 1)
                <div class="dropdown float-right">
                    <button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right asesmenEdit"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-item="{jenis:baru}">
                        <i class="fa fa-angle-down"></i> Tambah Asesmen Awal
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                            data-target="#modal-dokter-gawat-darurat">
                            <i class="si si-note mr-5"></i> Gawat Darurat
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                            data-target="#modal-dokter-rawat-jalan">
                            <i class="si si-note mr-5"></i> Rawat Jalan
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                            data-target="#modal-dokter-rawat-inap">
                            <i class="si si-note mr-5"></i> Rawat Inap
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                            data-target="#modal-dokter-gawat-darurat-non-jiwa">
                            <i class="si si-note mr-5"></i> Gawat Darurat - Non Jiwa
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                            data-target="#modal-dokter-rawat-jalan-non-jiwa">
                            <i class="si si-note mr-5"></i> Rawat Jalan - Non Jiwa
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                            data-target="#modal-dokter-rawat-inap-non-jiwa">
                            <i class="si si-note mr-5"></i> Rawat Inap - Non Jiwa
                        </a>
                    </div>
                </div>
                <div class="dropdown float-right">
                    <button type="button" class="btn-alt btn-rounded btn-primary min-width-125 float-right"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="asesmenlain">
                        <i class="fa fa-angle-down"></i> Asesmen Lainnya
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="asesmenlain">
                        <a class="dropdown-item"
                            href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/pengkajian-awal-pasien-terminal"
                            target="_blank">
                            <i class="si si-note mr-5"></i> Pengkajian Awal Pasien Terminal
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-12 mb-5 pt-20">
            @php $count2 = 0 @endphp
            @foreach ($asesmen as $item)
                @if ($item['creator']['profesi'] == '1')
                    @if ($item['created_by'] == Auth::user()->id)
                        <button class="btn btn-sm btn-circle btn-outline-danger mr-5 mb-5 pull-right deleteAsesmenBtn"
                            data-id="{{ $item['id'] }}">
                            <i class="fa fa-trash"></i>
                        </button>

                        <button class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right asesmenEdit"
                            data-id="{{ $item['id'] }}" data-item="{{ json_encode($item) }}"
                            id="edit-button-{{ $item['id'] }}">
                            <i class="fa fa-pencil"></i>
                        </button>


                        <button class="btn btn-sm btn-circle btn-outline-primary mr-5 mb-5 pull-right"
                            id="edit-loading-{{ $item['id'] }}" style="display: none;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </button>
                    @endif


                    <button class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right" data-toggle="modal"
                        data-target="#modal-hasil-{{ $item['id'] }}">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="{{ url()->current() }}/print/{{ $item['jenis'] }}/{{ $item['id'] }}" target="_blank"
                        type="btn" class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right">
                        <i class="fa fa-print"></i>
                    </a>

                    @php $need_verifikasi_dokter = 0 @endphp
                    @php $slug_specialty_creator = $item['creator']['specialty_detail']['slug'] ?? '-' @endphp
                    @php $slug_specialty_user = Auth::user()->specialty_detail->slug ?? '-' @endphp

                    @if ($slug_specialty_creator == 'perawat-vokasi')
                        @if (!empty($item['verified_ners_at']) && empty($item['verified_dokter_at']) && $my_role_admin == 1)
                            @php $need_verifikasi_dokter = 1 @endphp
                        @endif
                    @else
                        @if (empty($item['verified_dokter_at']) && $my_role_admin == 1)
                            @php $need_verifikasi_dokter = 1 @endphp
                        @endif
                    @endif

                    @if ($need_verifikasi_dokter)
                        <a href="{{ url()->current() }}/verifikasi-dokter/{{ $item['id'] }}"
                            class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right"
                            data-toggle="tooltip" data-placement="top" title="Verifikasi">
                            <i class="fa fa-check"></i>
                        </a>
                    @endif

                    @if (
                        $slug_specialty_creator == 'perawat-vokasi' &&
                            empty($item['verified_ners_at']) &&
                            $slug_specialty_user == 'perawat-ners')
                        <a href="{{ url()->current() }}/verifikasi-ners/{{ $item['id'] }}"
                            class="btn btn-sm btn-circle btn-outline-secondary mr-5 mb-5 pull-right"
                            data-toggle="tooltip" data-placement="top" title="Verifikasi">
                            <i class="fa fa-check"></i>
                        </a>
                    @endif

                    @include('kasus.datamedis.content.asesmenawal.modal-hasil')
                    <h5 class="mb-0">
                        #Asesmen Awal
                        @if ($item['jenis'] == 'Gawat Darurat' || $item['jenis'] == 'Gawat Darurat Dokter')
                            Gawat Darurat
                        @elseif($item['jenis'] == 'Rawat Jalan' || $item['jenis'] == 'Rawat Jalan Dokter')
                            Rawat Jalan
                        @elseif($item['jenis'] == 'Rawat Inap' || $item['jenis'] == 'Rawat Inap Dokter')
                            Rawat Inap
                        @else
                            Asesmen Lain lain
                        @endif
                    </h5>
                    <h6>({{ indonesian_date(date('d F y, H:i', strtotime($item['created_at'])), 'd F y, H:i') }})</h6>
                    <div class="row" id="fungsional-{{ $item['id'] }}">
                        <!-- //disini ngeshow data-->
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="creator">
                                <h6 class="pt-10">
                                    <small class="text-muted">Dibuat Oleh</small><br>
                                    {{ $item['creator']['name'] }}
                                </h6>
                            </div>
                        </div>
                        @if (!empty($item['verified_dokter_by']))
                            <div class="col-4">
                                <div class="creator">
                                    <h6 class="pt-10">
                                        <small class="text-muted">Verifikasi Dokter Oleh</small><br>
                                        {{ $item['verifikator_dokter']['name'] ?? '-' }}<br>
                                        {{ indonesian_date(date('d F y, H:i', strtotime($item['created_at']))) }}
                                    </h6>
                                </div>
                            </div>
                        @endif
                        @if (!empty($item['verified_ners_by']))
                            <div class="col-4">
                                <div class="creator">
                                    <h6 class="pt-10">
                                        <small class="text-muted">Verifikasi NERS Oleh</small><br>
                                        {{ $item['verifikator_ners']['name'] ?? '-' }}<br>
                                        {{ indonesian_date(date('d F y, H:i', strtotime($item['created_at']))) }}
                                    </h6>
                                </div>
                            </div>
                        @endif
                    </div>

                    <hr class="my-20">
                    @php $count2++; @endphp
                @endif
            @endforeach

            <!-- START Asesmen Non Jiwa -->
            @foreach ($asesmen_non_jiwa as $item)
                @php $count2++; @endphp
            @endforeach
            @include('kasus.datamedis.content.asesmenawal.non-jiwa.tab-dokter')
            <!-- END Asesmen Non Jiwa -->

            @if ($count2 == 0)
                <div class="col-12 text-center py-50">
                    <h4 class="font-w400 mb-5">Belum ada data Asesmen Awal</h4><br>
                    <p class="pb-20">Klik tombol <b>Tambah Asesmen Awal</b> untuk melakukan pengisian data asesmen
                        awal</p>
                </div>
            @endif
        </div>
    </div>
</div>



<form method="POST" action="{{ url('') }}/kasus/{{ $kasus->nomor_kasus }}/datamedis/cppt/delete"
    id="formDeleteRapt">
    {{ csrf_field() }}
    <input name="id" type="hidden" id="deleteRaptId">

</form>
