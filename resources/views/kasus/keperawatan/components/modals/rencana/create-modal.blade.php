<div class="modal fade" id="modal-create-rencana-asuhan" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Rencana Asuhan Keperawatan Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                        <div class="form-group">
                            <label>Jenis Asuhan Keperawatan</label>
                            <select class="js-select2 form-control" id="selectJenisAsuhan" data-width="100%" data-placeholder="Pilih Jenis">
                                <option></option>
                                @foreach ($jenis_asuhan as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label> <i class="fa fa-spinner fa-spin text-primary" id="loadingSelectRencanaAsuhan"></i>
                            <select class="js-select2 form-control" id="selectRencanaAsuhan" data-width="100%">
                            </select>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn-alt btn-hero btn-primary min-width-175 pull-right" disabled id="buttonSubmitSelectRencanaAsuhan">
                                    <i class="fa fa-send mr-5"></i>Isi Form Keperawatan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>