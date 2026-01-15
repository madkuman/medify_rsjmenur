<div class="col-12">
    <h4>Form Lainnya</h4>
</div>
<div class="col-12 my-10">
    <input type="text" class="form-control fuzzy-search-lainnya" placeholder="Cari Asesmen">
</div>
<div class="" id="lainnya-list">
    <ul class="list row row-deck">

        {{-- <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{url()->current()}}/ket-kelahiran">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Keterangan Kelahiran</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Keterangan Kelahiran</h5>
                    <p class="desc">Keterangan Kelahiran Pasien {{config('app.name')}}</p>
                </div>
            </a>
        </li> --}}

        <li class="col-md-4 text-center" style="display: none;">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/sk-dirawat" target="_blank">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Dirawat</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Dirawat</h5>
                    <p class="desc">Surat Keterangan Dirawat</p>
                </div>
            </a>
        </li>

        {{-- <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" data-toggle="modal" data-target="#modal-sk-terbang"
                href="javascript:void(0)">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Izin Terbang</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Izin Terbang</h5>
                    <p class="desc">Surat Keterangan Izin Terbang</p>
                </div>
            </a>
        </li> --}}

        <li class="col-md-4 text-center">

            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Istirahat / Dirawat / Sakit</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Istirahat / Dirawat / Sakit</h5>
                    <p class="desc">Surat Keterangan Istirahat / Dirawat / Sakit</p>
                </div>
            </a>
        </li>

        {{-- <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{url()->current()}}/permintaan-ultrasonografi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Permintaan Pemeriksaan USG</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Permintaan Permintaan Ultrasonografi</h5>
                    <p class="desc">Form permintaan pemeriksaan ultrasonografi</p>
                </div>
            </a>
        </li> --}}

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-pasien-pulang-rumah-sakit">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Pasien Pulang / Keluar Rumah Sakit</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Pasien Pulang / Keluar Rumah Sakit</h5>
                    <p class="desc">Surat Pasien Pulang / Keluar Rumah Sakit</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/surat-nasehat-pulang">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Nasehat Pulang</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Nasehat Pulang</h5>
                    <p class="desc">Surat untuk pasien yang akan pulang</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan-dalam-perawatan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Dalam Perawatan</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Dalam Perawatan</h5>
                    <p class="desc">Surat Keterangan Dalam Perawatan</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/surat-pernyataan-kesanggupan-pembiayaan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Pernyataan Kesanggupan Pembiayaan</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Pernyataan Kesanggupan Pembiayaan</h5>
                    <p class="desc">Surat Pernyataan Kesanggupan Pembiayaan</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan-fisik">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Sehat Fisik</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Sehat Fisik</h5>
                    <p class="desc">Surat Keterangan Sehat Fisik</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan-jiwa">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Sehat Jiwa</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Sehat Jiwa</h5>
                    <p class="desc">Surat Keterangan Sehat Jiwa</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan-napza">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Pemeriksaan Napza</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Pemeriksaan Napza</h5>
                    <p class="desc">Surat Keterangan Pemeriksaan Napza</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan-hiv">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Bebas HIV</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Bebas HIV</h5>
                    <p class="desc">Surat Keterangan Bebas HIV</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-keterangan-pemeriksaan-ekg">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Pemeriksaan EKG</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Pemeriksaan EKG</h5>
                    <p class="desc">Surat Keterangan Pemeriksaan EKG</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/surat-pernyataan-menjemput-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Pernyataan Menjemput Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Pernyataan Menjemput Pasien</h5>
                    <p class="desc">Surat Pernyataan Menjemput Pasien</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/hasil-pengujian-kesehatan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Hasil Pengujian Kesehatan</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Hasil Pengujian Kesehatan</h5>
                    <p class="desc">Hasil Pengujian Kesehatan</p>
                </div>
            </a>
        </li>

    </ul>
</div>