<div class="modal fade" id="bayi_modal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header pb-0">
                    <div>
                        <h3 class="block-title">Daftarkan Bayi Baru Dilahirkan</h3>
                        Harap isi data bayi yang baru dilahirkan.
                    </div>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="nomor_kasus" value="{{ $kasus->nomor_kasus }}">
                <div class="block-content px-0 row">
                    <div class="form-group col-md-12">
                        <label>Jenis Kelamin Bayi</label>
                        <select name="jenis_kelamin" id="selectJenisKelamin" class="form-control js-select2"
                            style="width: 100%;" data-size="2" data-placeholder="Jenis Kelamin">
                            <option></option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                        <span id="errorBayiSelectJenisKelamin" class="text-danger" style="display: none">Input Tidak
                            Boleh Kosong</span>
                    </div>
                    <!-- <div class="form-group col-md-12">
                        <div class="custom-control custom-checkbox mb-5 col-6">
                          <input class="custom-control-input" type="checkbox" name="is_intensif" id="is_intensif" value="1">
                          <label class="custom-control-label" for="is_intensif">Masukan perawatan intensif</label>
                        </div>
                    </div> -->
                    <div class="form-group col-md-12">
                        <label>Pilih Ruangan Bayi <i id="loadingRuangBayi" class="fa fa-asterisk fa-spin text-info"
                                style="display: none;"></i></label>
                        <select name="ruangan_bayi" id="selectRuanganBayi" class="form-control js-select2"
                            style="width: 100%;" data-size="2" data-placeholder="Pilih Ruangan Bayi">
                            <option></option>
                        </select>
                        <span id="errorBayiSelectRuanganBayi" class="text-danger" style="display: none">Input Tidak
                            Boleh Kosong</span>
                    </div>
                </div>
                @if (!empty($kasus->pasien_pembayaran_id))
                    <div class="text-center py-10" id="bayiButtons">
                        <button type="submit" class="btn-alt btn-grass min-width-100 float-right" id="submitBayi">
                            <i class="fa fa-check"></i> Daftarkan
                        </button>
                        <button type="button" data-dismiss="modal"
                            class="btn-alt btn-hero btn-regular min-width-100 float-right">
                            Batal
                        </button>
                    </div>
                    <div class="text-center py-10">
                        <span class="fa fa-2x fa-asterisk fa-spin text-primary text-center loader" id="loadingBayi"
                            style="display: none;"></span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
