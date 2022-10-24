 <div class="modal fade" id="modal-mutu-gizi" style="display: none;">
        <div class="modal-dialog" role="document">
            <form action="{{url('gizi/pemesanan/set-mutu-gizi')}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="block-title text-light">Mutu Gizi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-light" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body" id="modal-content">
                        <div class="d-none text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="col-md-12">
                            {{csrf_field()}}
                            <input type="hidden" id="pemesananid" name="pemesananid" value="">
                            <div class="form-group row mx-0 mb-20">
                                <label class="col-12 px-0">Diet</label>
                                <select class="form-control col-12" name="diet" required="" style="width: 100%">
                                    <option value="" disabled="" hidden="" selected="">Pilih Diet</option>
                                    <option value="Tepat" @if($kasus->gizi_diet == 'Sesuai' || $kasus->gizi_diet == 'Tepat') selected @endif >Tepat</option>
                                    <option value="Tidak Tepat" @if($kasus->gizi_diet == 'Tidak Sesuai' || $kasus->gizi_diet == 'Tidak Tepat') selected @endif >Tidak Tepat</option>
                                </select>
                            </div>
                            <div class="form-group row mx-0 mb-20">
                                <label class="col-12 px-0">Makanan Tersisa</label>
                                <select class="form-control col-12" name="sisa" required="" style="width: 100%">
                                    <option value="" disabled="" hidden="" selected="">Makanan Tersisa</option>
                                    <option value="Tidak Terpenuhi" @if($kasus->gizi_sisa == 'Banyak' || $kasus->gizi_sisa == 'Tidak Terpenuhi') selected @endif>Tidak Terpenuhi</option>
                                    <option value="Terpenuhi" @if($kasus->gizi_sisa == 'Sedikit' || $kasus->gizi_sisa == 'Tidak Tersisa' || $kasus->gizi_sisa == 'Terpenuhi') selected @endif>Terpenuhi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-square">
                            <i class="fa fa-paper-plane"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>