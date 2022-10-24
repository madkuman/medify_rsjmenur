<div class="modal fade" id="modal-create" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-absensi" enctype="multipart/form-data">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="title-modal"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="col-12">
                                <label>Tanggal Awal</label>
                                <input type="text" class="js-datepicker form-control" id="tanggal_awal" onkeydown="return false" required data-today-highlight="true"
                                       value="{{date('m/d/Y')}}" name="tanggal_awal" placeholder="Masukkan Tanggal Awal"
                                       autocomplete="off">
                            </div>
                            <div class="col-12">
                                <label>Tanggal Akhir</label>
                                <input type="text" class="js-datepicker form-control" id="tanggal_akhir" onkeydown="return false" required data-today-highlight="true"
                                       value="{{date('m/d/Y')}}" name="tanggal_akhir" placeholder="Masukkan Tanggal Akhir"
                                       autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit btn-click-animate" type="submit" id="btnSubmit"> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>