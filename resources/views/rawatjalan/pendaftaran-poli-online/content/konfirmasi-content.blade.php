<div class="pt-80 pb-10 px-5 text-center">
    <h2 class=" font-w700 my-10 text-light">Konfirmasi Pendaftaran Poliklinik</h2>
</div>
<div class="row row-deck justify-content-center px-5">
    <div class="col-3">
        <div class="block block-themed text-center no-border">
            <div class="block-content block-content-full block-content-sm bg-flat-dark">
                <span class="font-w600 text-white font-20">Pasien</span>
            </div>
            <div class="block-content block-content-full block-content-sm bg-primary">
                <div class="font-w600 text-white mb-5 font-25 profil_nama">Hari Febriansyah</div>
            </div>
            <div class="block-content text-left">
                <div class="form-group">
                    <label class="font-w400">No RM</label><br>
                    <h4 class="profil_rm_confirm">#123456</h4>
                </div>
                <div class="form-group">
                    <label class="font-w400">Jenis Kelamin, Usia</label><br>
                    <h4 class="profil_usia">Laki-laki, 20 Tahun</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="block block-themed text-center no-border">
            <div class="block-content block-content-full block-content-sm bg-flat-dark">
                <span class="font-w600 text-white font-20">Poliklinik</span>
            </div>
            <div class="block-content block-content-full block-content-sm bg-info">
                <div class="font-w600 text-white mb-5 font-25" id="konfirmasi_poli_nama">Akupuntur</div>
            </div>
            <div class="block-content text-left">
                <div class="form-group">
                    <label class="font-w400">Antrian saat ini</label><br>
                    <h4 class="poli_antrian_now">7</h4>
                </div>
                <div class="form-group">
                    <label class="font-w400">Total Antrian</label><br>
                    <h4 class="poli_antrian_all">10</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center px-5">
    <div class="col-sm-8 col-md-6 col-xl-5">
        <div class="form-group mt-20">
            <a href="javascript:void(0)" type="btn" class="btn btn-block btn-hero btn-noborder big-button btn-primary" id="btn-cetak">
                <i class="fa fa-paper-plane mr-10"></i> Konfirmasi
            </a>
            <a href="{{url('')}}/rawatjalan/pendaftaran-poli-online" type="btn" class="btn btn-block btn-hero btn-noborder big-button btn-secondary" id="btn-konfirmasi-kembali">
                <i class="si si-action-undo mr-10"></i> Kembali
            </a>
        </div>
    </div>
</div>
<input type="hidden" name="check_in_rujuk_id" id="check_in_rujuk_id">