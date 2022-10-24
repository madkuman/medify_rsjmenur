<div class="pt-80 pb-10 px-5 text-center">
    <h2 class=" font-w700 my-10 text-light">Pilih Jadwal Dokter</h2>
</div>
<div class="row row-deck justify-content-center px-5">
    <div class="col-12 col-md-6 row">
        <div class="col-12">
            <label class="labl">
                <input type="radio" name="jadwal" value="pagi">
                <div class="block block-bordered block-link-shadow text-center">
                    <div class="block-content">
                        <h5 class="title mb-5 font-25">Pagi</h5>
                    </div>
                </div>
            </label>
        </div>
        <div class="col-12">
            <label class="labl">
                <input type="radio" name="jadwal" value="sore">
                <div class="block block-bordered block-link-shadow text-center">
                    <div class="block-content">
                        <h5 class="title mb-5 font-25">Sore</h5>
                    </div>
                </div>
            </label>
        </div>
    </div>
</div>
<div class="row justify-content-center px-5">
    <div class="col-sm-8 col-md-6 col-xl-5">
        <div class="form-group mt-20">
            <button type="button" class="btn btn-block btn-hero btn-noborder big-button btn-primary button-next" data-next="dokter">
                <span class="button-action"><i class="fa fa-paper-plane mr-10"></i> Konfirmasi</span>
				<span class="button-loading hide"><i class="fa fa-spinner fa-spin fa-1x"></i> Silahkan Tunggu ...</span>
            </button>
            <button type="button" class="btn btn-block btn-hero btn-noborder big-button btn-secondary button-back" data-back="registrasi">
                <i class="si si-action-undo mr-10"></i> Kembali
            </button>
        </div>
    </div>
</div>
<input type="hidden" name="check_in_rujuk_id" id="check_in_rujuk_id">