<div class="modal fade" id="unit-tindakan-modal" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header pb-0">
                    <div>
                        <h3 class="block-title">Daftarkan Pasien Ke Unit Tindakan</h3>
                        Berikan keterangan untuk mendaftarkan pasien ke unit tindakan.
                    </div>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content px-0 row">
                    <div class="form-group col-md-12">
                        <label>Tindakan</label>
                        <select class="form-control js-select2" style="width: 100%;" name="unit_tindakan" id="unit-tindakan">
                            <option value="" selected="">Pilih layanan tambahan</option>
                            @foreach($tindakan as $row)
                            <option value="{{$row->id}}">{{$row->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="unit-tindakan-keterangan"></textarea>
                    </div>
                </div>
            @if(!empty($kasus->pasien_pembayaran_id))
                <div class="text-center py-10" id="inapButtons">
                    <button type="button" class="unit-tindakan-button btn-alt btn-grass min-width-100 float-right" id="unit-tindakan-submit">
                        <i class="fa fa-check"></i> Daftarkan
                    </button>
                    <button type="button" data-dismiss="modal" class="btn-alt btn-hero btn-regular unit-tindakan-button min-width-100 float-right">Batal</button>
                </div>
                <div class="text-center py-10">
                    <span class="fa fa-4x fa-asterisk fa-spin text-primary text-center loader" id="loading-unit-tindakan" style="display: none;"></span>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>