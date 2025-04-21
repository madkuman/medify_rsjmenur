<div class="col-12">
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-riwayat">Lihat Riwayat
        Asesmen</button>
    <h4>Asesmen Lanjutan</h4>
</div>
<div class="col-12 my-10">
    <input type="text" class="form-control fuzzy-search-asesmen" placeholder="Cari Asesmen">
</div>
<div class="" id="asesmen-list">
    <ul class="list row row-deck">
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/pasien-covid">
                <div class="block-header">
                    <h3 class="block-title">Ceklis Skrining Pasien Covid-19</h3>
                </div>
                <div class="block-content ribbon ribbon-bookmark ribbon-success ribbon-left">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Ceklis Skrining Pasien Covid-19</h5>
                    <p class="desc">Ceklis Skrining Pasien Covid-19</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/monitoring-transfusi-darah">
                <div class="block-header">
                    <h3 class="block-title">Monitoring Transfusi Darah</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Monitoring Transfusi Darah</h5>
                    <p class="desc">Monitoring Transfusi Darah</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/pengkajian-ulang-pasien-terminal">
                <div class="block-header">
                    <h3 class="block-title">Pengkajian Ulang Pasien Terminal</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Ulang Pasien Terminal</h5>
                    <p class="desc">Pengkajian Ulang Pasien Terminal</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/triage">
                <div class="block-header">
                    <h3 class="block-title">Triage</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Triage</h5>
                    <p class="desc">Alat bantu untuk mengevakuasi pasien gawat darurat sesuai dengan kondisinya.</p>
                </div>
            </a>
        </li>


        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/norton">
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
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/edukasi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Edukasi Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Edukasi Pasien</h5>
                    <p class="desc">
                        Alat bantu untuk mengevaluasi kebutuhan edukasi pasien.
                    </p>
                </div>
            </a>
        </li>


        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/miksi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Eliminasi Miksi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Eliminasi Miksi</h5>
                    <p class="desc">Alat bantu untuk mengevaluasi eliminasi miksi pasien.</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/defekasi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Eliminasi Defikasi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Eliminasi Defikasi</h5>
                    <p class="desc">Alat bantu untuk mengevaluasi eliminasi Defikasi pasien.</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pulang">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Perencanaan Pulang</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Perencanaan Pulang</h5>
                    <p class="desc">Alat bantu untuk perencanaan pulang pasien.</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/nyeri">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Skrinning Nyeri</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Skrinning Nyeri</h5>
                    <p class="desc">Alat bantu untuk skrining nyeri pada pasien.</p>
                </div>
            </a>
        </li>


        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/gastro">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Gastrointestinal</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    <h5 class="mb-5 title">Gastrointestinal</h5>
                    <p class="desc">Alat bantu untuk penilaian pemeriksaan gastrointestinal pasien.</p>
                    </p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/edukasi-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Kebutuhan Edukasi Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    <h5 class="mb-5 title">Form Edukasi Pasien</h5>
                    <p class="desc">Rencana edukasi kebutuhan pembelajaran pasien.</p>
                    </p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/persalinan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Persalinan</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Persalinan</h5>
                    <p class="desc">Untuk menilai tingkat kesuksesan persalinan ibu dan anaknya</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/perinatal">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Perinatal</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Perinatal</h5>
                    <p class="desc">Data Maternal dan Perinatal Dasar, UKK Perinatologi Idai</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center d-none">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengkajian-igd">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian IGD</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian IGD</h5>
                    <p class="desc">Asesmen form pengkajian IGD</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/riwayat-kehamilan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Riwayat Kehamilan</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Riwayat Kehamilan</h5>
                    <p class="desc">Asesmen Tabel Riwayat Kehamilan, Persalinan, dan Nifas yang pernah dialami</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengkajian-awal-kebidanan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian Awal Kebidanan</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Awal Kebidanan</h5>
                    <p class="desc">Asesmen pengkajian awal kebidanan dan kandungan</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengkajian-ranap-neonatus">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian Awal Keperawatan Ranap - Neonatus Anak</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Awal Ranap Neonatus Anak</h5>
                    <p class="desc">Asesmen pengkajian awal keperawatan rawat inap untuk neonatus dan anak</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengkajian-ranap-medikal">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian Awal Keperawatan Ranap - Medikal Bedah</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Awal Ranap Medikal Bedah</h5>
                    <p class="desc">Asesmen pengkajian awal keperawatan rawat inap untuk Medikal dan Bedah</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/patograf">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Patograf</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Patograf</h5>
                    <p class="desc"> PAtograf sebagai alat pemantauan persalinan normal dan juga sebagai alat
                        pengambilan keputusan klinis</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/fungsional">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian Umum Fungsional</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Umum Fungsional</h5>
                    <p class="desc">Pengkajian Umum Fungsional</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/kemoterapi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Kemoterapi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Kemoterapi</h5>
                    <p class="desc">Asesmen Kemoterapi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengkajian-kemoterapi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian Keperawatan Kemoterapi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Keperawatan Kemoterapi</h5>
                    <p class="desc">Asesmen Pengkajian Keperawatan Kemoterapi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/lembar-observasi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Lembar Observasi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Lembar Observasi</h5>
                    <p class="desc">Asesmen Lembar Observasi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengobatan-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Catatan Pengobatan Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Catatan Pengobatan Pasien</h5>
                    <p class="desc">Catatan Pengobatan Pasien</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/resume-pulang">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Resume Pasien Pulang Ranap</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Resume Pasien Pulang Ranap</h5>
                    <p class="desc">Resume Pasien Pulang Ranap</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/keperawatan-jiwa">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian Keperawatan Jiwa</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian Keperawatan Jiwa</h5>
                    <p class="desc">Pengkajian Keperawatan Jiwa</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/klinik-rehab-medik">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Klinik Rehab Medik</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Klinik Rehab Medik</h5>
                    <p class="desc">Alat Bantu Klinik Rehab Medik</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/hemodialisa">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Hemodialisis</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Hemodialisa</h5>
                    <p class="desc">Alat Bantu untuk Unit Hemodialisis</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/mata">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Klinik Mata</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Mata</h5>
                    <p class="desc">Alat Bantu untuk Unit Mata</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pra-bedah">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pra Bedah</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Pra Bedah</h5>
                    <p class="desc">Alat Bantu untuk Unit Pra Bedah</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center" style="display: none">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/pengkajian-anestesi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengkajian dan Pemantauan Sedasi Anestesi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengkajian dan Pemantauan Sedasi Anestesi</h5>
                    <p class="desc">Alat Bantu untuk Pengkajian dan Pemantauan Sedasi Anestesi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/managemen-dan-asesmen-ulang-nyeri">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Managemen dan Asesmen Ulang Nyeri</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Managemen dan Asesmen Ulang Nyeri</h5>
                    <p class="desc">Alat Bantu untuk Managemen dan Asesmen Ulang Nyeri</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/asesmen-risiko-jatuh-psikiatri">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Risiko Jatuh Psikiatri</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Risiko Jatuh Psikiatri</h5>
                    <p class="desc">Alat Bantu untuk Asesmen Risiko Jatuh Psikiatri</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/surat-keterangan-pemeriksaan-kematian">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Keterangan Pemeriksaan Kematian</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Keterangan Pemeriksaan Kematian</h5>
                    <p class="desc">Alat Bantu untuk Surat Keterangan Pemeriksaan Kematian</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/penilaian-kualitas-hidup-lansia">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Penilaian Kualitas Hidup Lansia</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Penilaian Kualitas Hidup Lansia</h5>
                    <p class="desc">Penilaian Kualitas Hidup Lansia</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/asesmen-bebas-narkoba">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Bebas Narkoba</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Bebas Narkoba</h5>
                    <p class="desc">Asesmen Bebas Narkoba</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/surat-persetujuan-dirawat">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Persetujuan Dirawat</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Persetujuan Dirawat</h5>
                    <p class="desc">Surat Persetujuan Dirawat</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/geriatric-depression-scale">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Geriatric Depression Scale</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Geriatric Depression Scale</h5>
                    <p class="desc">Geriatric Depression Scale</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/surat-permintaan-masuk-rumah-sakit">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Surat Permintaan Masuk Rumah Sakit</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Surat Permintaan Masuk Rumah Sakit</h5>
                    <p class="desc">Surat Permintaan Masuk Rumah Sakit</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/pengantar-pengiriman-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pengantar Pengiriman Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pengantar Pengiriman Pasien</h5>
                    <p class="desc">Formulir Pengantar Pengiriman Pasien (Rujukan Dalam)</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-pendidikan-pasien-dan-keluarga">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Pendidikan Pasien dan Keluarga</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Pendidikan Pasien dan Keluarga</h5>
                    <p class="desc">Formulir Asesmen Pendidikan dan Edukasi Pasien dan Keluarga</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center" style="display: none">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Lembar Komunikasi Informasi Edukasi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Lembar Komunikasi Informasi Edukasi</h5>
                    <p class="desc">Lembar Komunikasi - Informasi & Edukasi Pasien dan Keluarga</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/skoring-derajat-gejala-psikotik">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Skoring Derajat Gejala Psikotik</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Skoring Derajat Gejala Psikotik</h5>
                    <p class="desc">Formulir Penilaian Gejala Psikotik</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/whodas">
                <div class="block-header bg-primary">
                    <h3 class="block-title">WHODAS 2.0</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">WHODAS 2.0</h5>
                    <p class="desc">Lembar Penilaian WHODAS 2.0</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/asesmen-napza">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Napza</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Napza</h5>
                    <p class="desc">Asesmen Napza</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/asesmen-napza-rawat-jalan-non-ipwl">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Napza Rawat Jalan (Non IPWL)</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Napza Rawat Jalan (Non IPWL)</h5>
                    <p class="desc">Asesmen Napza Rawat Jalan (Non IPWL)</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed" href="{{ url()->current() }}/mini-mental-state-examination">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Mini Mental State Examination</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Mini Mental State Examination</h5>
                    <p class="desc">Mini Mental State Examination</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url()->current() }}/instrumen-activity-daily-living">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Instrumen Activity Daily Living</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Instrumen Activity Daily Living</h5>
                    <p class="desc">Instrumen Activity Daily Living</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/skoring-panss-ec">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Skoring Panss EC</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Skoring Panss EC</h5>
                    <p class="desc">Skoring Panss EC</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/general-consent">
                <div class="block-header bg-primary">
                    <h3 class="block-title">General Consent</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">General Consent</h5>
                    <p class="desc">General Consent</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/general-consent-for-treatment">
                <div class="block-header bg-primary">
                    <h3 class="block-title">General Consent For Treatment</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">General Consent For Treatment</h5>
                    <p class="desc">General Consent For Treatment</p>
                </div>
            </a>
        </li>

        {{-- Asesmen Permohonan dan Jawaban Konsultasi --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-permohonan-dan-jawaban-konsultasi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Permohonan dan Jawaban Konsultasi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Permohonan dan Jawaban Konsultasi</h5>
                    <p class="desc">Asesmen Permohonan dan Jawaban Konsultasi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/formulir-permintaan-ect">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Formulir Permintaan Electro Convulsive Therapy (ECT)</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Formulir Permintaan Electro Convulsive Therapy (ECT)</h5>
                    <p class="desc">Formulir Permintaan Electro Convulsive Therapy (ECT)</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/form-skrining-manajer-pelayanan-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Form Skrining Manajer Pelayanan Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Form Skrining Manajer Pelayanan Pasien</h5>
                    <p class="desc">Form Skrining Manajer Pelayanan Pasien</p>
                </div>
            </a>
        </li>

        {{-- Checklist Keselamatan Pasien di Poli Gigi dan Mulut --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Checklist Keselamatan Pasien di Poli Gigi dan Mulut</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Checklist Keselamatan Pasien di Poli Gigi dan Mulut</h5>
                    <p class="desc">Checklist Keselamatan Pasien di Poli Gigi dan Mulut</p>
                </div>
            </a>
        </li>

        {{-- Checklist Orientasi Pasien Baru --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/checklist-orientasi-pasien-baru">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Checklist Orientasi Pasien Baru</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Checklist Orientasi Pasien Baru</h5>
                    <p class="desc">Checklist Orientasi Pasien Baru</p>
                </div>
            </a>
        </li>

        {{-- Pemberian Informasi Asuhan dan Tindakan --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/pemberian-informasi-asuhan-dan-tindakan">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Pemberian Informasi Asuhan Medis dan Tindakan Kepada Pasien dan Keluarga
                    </h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Pemberian Informasi Asuhan Medis dan Tindakan Kepada Pasien dan Keluarga
                    </h5>
                    <p class="desc">Pemberian Informasi Asuhan Medis dan Tindakan Kepada Pasien dan Keluarga</p>
                </div>
            </a>
        </li>

        {{-- Permintaan Pelayanan Rohani --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/permintaan-pelayanan-rohani">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Formulir Permintaan Pelayanan Rohani
                    </h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Formulir Permintaan Pelayanan Rohani
                    </h5>
                    <p class="desc">Formulir Permintaan Pelayanan Rohani</p>
                </div>
            </a>
        </li>

        {{-- Asesmen Wajib Lapor dan Rehabilitasi Medis IPWL --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Wajib Lapor dan Rehabilitasi Medis IPWL</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Wajib Lapor dan Rehabilitasi Medis IPWL</h5>
                    <p class="desc">Asesmen Wajib Lapor dan Rehabilitasi Medis IPWL</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/resiko-melarikan-diri">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Ulang Resiko Melarikan Diri</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Ulang Resiko Melarikan Diri</h5>
                    <p class="desc">Asesmen Ulang Resiko Melarikan Diri</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/resiko-bunuh-diri">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Ulang Resiko Bunuh Diri</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Ulang Resiko Bunuh Diri</h5>
                    <p class="desc">Asesmen Ulang Resiko Bunuh Diri</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/resiko-kekerasan-fisik">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Ulang Resiko Kekerasan Fisik</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Ulang Resiko Kekerasan Fisik</h5>
                    <p class="desc">Asesmen Ulang Resiko Kekerasan Fisik</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/evaluasi-awal-manajer-pelayanan-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Evaluasi Awal Manajer Pelayanan Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Evaluasi Awal Manajer Pelayanan Pasien</h5>
                    <p class="desc">Evaluasi Awal Manajer Pelayanan Pasien</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/implementasi-manajer-pelayanan-pasien">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Implementasi Manajer Pelayanan Pasien</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Implementasi Manajer Pelayanan Pasien</h5>
                    <p class="desc">Implementasi Manajer Pelayanan Pasien</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/panss-remisi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Panss Remisi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Panss Remisi</h5>
                    <p class="desc">Panss Remisi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/observasi-tindakan-ect">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Observasi Tindakan ECT</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Observasi Tindakan ECT</h5>
                    <p class="desc">Observasi Tindakan ECT</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-kesehatan-gigi-dan-mulut">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Kesehatan Gigi dan Mulut</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Kesehatan Gigi dan Mulut</h5>
                    <p class="desc">Asesmen Kesehatan Gigi dan Mulut</p>
                </div>
            </a>
        </li>
        {{-- Asesmen Awal medis neonatologi --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-awal-medis-neonatologi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Awal Medis Neonatologi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Awal Medis Neonatologi</h5>
                    <p class="desc">Asesmen Awal Medis Neonatologi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/observasi-transfusi-darah">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Observasi Transfusi Darah</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Observasi Transfusi Darah</h5>
                    <p class="desc">Observasi Transfusi Darah</p>
                </div>
            </a>
        </li>


        {{-- Asesmen Inform Consent Cabut gigi --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-inform-consent-cabut-gigi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Inform Consent Cabut Gigi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Inform Consent Cabut Gigi</h5>
                </div>
            </a>
        </li>

        {{-- Asesmen Awal Keperawatan medis neonatologi --}}
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/asesmen-awal-keperawatan-medis-neonatologi">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Asesmen Awal Keperawatan Medis Neonatologi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Asesmen Awal Keperawatan Medis Neonatologi</h5>
                    <p class="desc">Asesmen Awal Medis Keperawatan Neonatologi</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus/' . $kasus->nomor_kasus . '/asesmen/asesmen-identitikasi-bayi') }}">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Form Identifikasi Bayi</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Form Identifikasi Bayi</h5>
                    <p class="desc">Form Identifikasi Bayi.</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus/' . $kasus->nomor_kasus . '/asesmen/resume-mcu-haji') }}">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Resume MCU Haji</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Resume MCU Haji</h5>
                    <p class="desc">Resume MCU Haji.</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/abbreviated-mental-test">
                <div class="block-header bg-primary">
                    <h3 class="block-title">The Abbreviated Mental Test (AMT)</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Abbreviated Mental Test (AMT)</h5>
                    <p class="desc">Abbreviated Mental Test (AMT)</p>
                </div>
            </a>

        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/barthel-index">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Barthel Index</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">Barthel Index</h5>
                    <p class="desc">Barthel Index</p>
                </div>
            </a>
        </li>

        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/checklist-autisme-toddler">
                <div class="block-header bg-primary">
                    <h3 class="block-title">CHAT (Checklist for Autisme in Toddler)</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">CHAT (Checklist for Autisme in Toddler)</h5>
                    <p class="desc">CHAT (Checklist for Autisme in Toddler)</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/childhood-autism-rating-scale">
                <div class="block-header bg-primary">
                    <h3 class="block-title">CARS (Childhood Autism Rating Scale)</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">CARS (Childhood Autism Rating Scale)</h5>
                    <p class="desc">CARS (Childhood Autism Rating Scale)</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/self-harm-inventory">
                <div class="block-header bg-primary">
                    <h3 class="block-title">SHI (Self Harm Inventory)</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">SHI (Self Harm Inventory)</h5>
                    <p class="desc">SHI (Self Harm Inventory)</p>
                </div>
            </a>
        </li>
        <li class="col-md-4 text-center">
            <a class="block block-link-pop block-themed"
                href="{{ url('kasus') }}/{{ $kasus->nomor_kasus }}/asesmen/ucla-3">
                <div class="block-header bg-primary">
                    <h3 class="block-title">UCLA-3</h3>
                </div>
                <div class="block-content">
                    <p class="mt-5 mb-10">
                        <i class="fa fa-calculator fa-4x "></i>
                    </p>
                    <h5 class="mb-5 title">UCLA-3</h5>
                    <p class="desc">UCLA-3</p>
                </div>
            </a>
            
        </li>

    </ul>
</div>
