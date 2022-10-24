<div class="modal fade" id="modal-form" role="dialog" aria-labelledby="modal-fromtop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromtop modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url()->current()}}" id="main-form">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0"><span id="modal-option">Tambah</span> Master Cuti</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option btn-close" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="input-id" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Master Cuti</label>
                                    <input type="text" name="nama" id="input-nama" placeholder="Masukkan Nama Master Cuti" class="form-control" required autocomplete="off">
                                    <small>Contoh : Cuti Tahunan, Cuti Bulanan</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Jenis Cuti</label>
                                    <select class="form-control" name="jenis_cuti" id="input-jenis-cuti" required>
                                        <option value="bulanan">Bulanan</option>
                                        <option value="tahunan">Tahunan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Jumlah Cuti Per Periode</label>
                                    <input type="number" name="jumlah_cuti" id="input-jumlah-cuti" placeholder="Masukkan Jumlah Cuti" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary btn-hero pull-right btn-submit" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-hero pull-right" style="display: none" type="button"  id="buttonLoading" disabled>
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>