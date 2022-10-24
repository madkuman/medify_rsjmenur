<div class="modal fade" id="modal-edit-tindakan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Tindakan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-content">
                            <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/tindakan/edit" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="tarif_id" id="tarif_id_edit">
                                <input type="hidden" name="tarif_tipe_id" id="tarif_tipe_id_edit">
                                <input type="hidden" name="tarif_kelas" id="tarif_kelas_edit">
                                <input type="hidden" name="departemen_id" id="departemen_id_edit">
                                <input type="hidden" name="icd_9" id="icd_9">

                                <div class="form-group row perawat-class">
                                    <label class="col-12" for="">Tindakan Keperawatan</label>
                                    <div class="col-12">
                                        <input type="text" class="tindakan-autocomplete form-control form-control-lg" id="input-desc" name="desc" placeholder="Deskripsi Tindakan" value="" onchange="emptyDaftarHargaID()">
                                    </div>
                                </div>

                                <div class="form-group row icd9-class">
                                    <label class="col-12" for="">Tindakan ICD9</label>
                                    <div class="col-12">
                                    <input type="text" class="tindakan-icd9-autocomplete form-control form-control-lg" id="input-icd9-desc" name="desc" placeholder="Deskripsi Tindakan" value="">
                                    </div>
                                </div>

                                <div class="form-group row perawat-class">
                                    <label class="col-12" for="">Biaya <i id="tarifLoading2" class="fa fa-asterisk fa-spin text-info"></i></label>
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-lg" id="input-price" name="price" placeholder="Biaya tindakan dalam rupiah" value="" readonly>
                                        <small>*Mengubah data tindakan akan mengubah tindakan yang ada pada tagihan</small>
                                    </div>
                                </div>
                                <div class="form-group row perawat-class">
                                    <div class="col-12">
                                        <input type="hidden" class="form-control form-control-lg" id="input-id" name="id" placeholder="Biaya tindakan dalam rupiah" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12 text-center">
                                        <button type="submit" id="submit-edit-tindakan" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 float-right">
                                            <i class="fa fa-send mr-5"></i> Ubah Tindakan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>