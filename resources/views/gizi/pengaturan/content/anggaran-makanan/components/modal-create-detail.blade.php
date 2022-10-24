<div class="modal fade" id="modal-create-detail" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('gizi/pengaturan/anggaran-makanan-detail/create')}}" id="form-add-anggaran-makanan-detail">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Tambah Data Anggaran Makanan Detail</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="hidden" name="anggaran_makanan_id" value="{{$anggaran_makanan->id}}">
                                    <input type="text" class="form-control js-datepicker-year" onkeydown="return false" name="tahun" value="{{date('Y')}}" data-date-autoclose="true" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate btn-simpan" id="btn-simpan">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>