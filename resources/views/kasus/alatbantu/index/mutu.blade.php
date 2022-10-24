
<div class="col-12">
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-riwayat">Lihat Riwayat Asesmen</button>
    <h4>Mutu</h4>
</div>
<div class="col-12 my-10">
    <input type="text" class="form-control fuzzy-search-mutu" placeholder="Cari Asesmen">
</div>
<div class="" id="mutu-list">
    <ul class="list row row-deck">
        @php $url = url('kasus').'/'.$kasus->nomor_kasus.'/alat-bantu' @endphp
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{$url}}/norton">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Norton Dekubitus</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Norton Dekubitus</h5>
                    <p class="desc">Alat bantu hitung untuk menghitung nilai potensi dekubitus.</p>
                </div>
            </a>
        </li>


        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{$url}}/identifikasi-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Identifikasi Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Identifikasi Pasien</h5>
                    <p class="desc">Cheklist Audit Pelaksanaan Identifikasi dan Verifikasi Identitas Pasien</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{$url}}/kejadian-jatuh">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Kejadian Jatuh</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Form Kejadian Jatuh</h5>
                    <p class="desc">Formulir pengkajian kejadian jatuh pasien</p>
                </div>
            </a>
        </li>


        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{$url}}/humpty-dumpty">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Humpty Dumpty</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                        <h5 class="mb-5 title">Humpty Dumpty</h5>
                        <p class="desc">Alat bantu untuk penilaian risiko jatuh pada anak.</p>
                    </div>
                </a>
            </li>

            <li class="col-md-4 text-center">
                <a class="block block-link-pop block-themed" href="{{$url}}/morse">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Morse Fall Score</h3>
                    </div>
                    <div class="block-content">
                        <p class="mt-5 mb-10">
                            <i class="fa fa-calculator fa-4x "></i>
                        </p>
                        <h5 class="mb-5 title">Morse Fall Score</h5>
                        <p class="desc">Morse Fall Score - Asesmen Jatuh Dewasa</p>
                    </div>
                </a>
            </li>

        </ul>
    </div>