<div class="pt-80 pb-10 px-5 text-center">
    <h2 class=" font-w700 my-10 text-light">Antrian Pendaftaran Poli Rawat Jalan</h2>
	<h2 class=" font-w700 my-10 text-light">RS Jiwa Menur Surabaya</h2>
</div>
<div class="row row-deck justify-content-center px-5">
    <div class="col-8">
        <div class="block block-themed text-center no-border">
            <div class="block-content block-content-full block-content-sm bg-primary">
                <div class="font-w600 text-white mb-5 font-25 profil_nama">Pasien Baru</div>
            </div>
            <div class="block-content text-center">
                <div class="form-group">
                    <h4 class="profil_confirm">Tekan Cetak untuk mendapatkan nomor antrian</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center px-5">
    <div class="col-sm-8 col-md-6 col-xl-5">
        <div class="form-group mt-20">
            <button class="btn btn-block btn-hero btn-noborder big-button btn-success" id="btn-cetak-pasien-baru">
                <i class="fa fa-paper-plane mr-10"></i> Cetak Tiket Antrian
            </button>
            {{--<a href="javascript:void(0)" type="button" class="btn btn-block btn-hero btn-noborder big-button btn-primary" id="btn-cetak-pasien-baru">
                <i class="fa fa-paper-plane mr-10"></i> Cetak
            </a>--}}
            <a href="{{url('')}}/pasien/antrian-pasien" type="btn" class="btn btn-block btn-hero btn-noborder big-button btn-secondary">
                <i class="si si-action-undo mr-10"></i> Kembali
            </a>
        </div>
    </div>
</div>
<input type="hidden" name="check_in_rujuk_id" id="check_in_rujuk_id">
