<div class="modal fade" id="modal-order-edit" style="display: none;">
    <div class="modal-dialog" role="document">
        <form action="{{url('gizi/pemesanan/edit')}}" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="block-title text-light">Ubah Pemesanan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option text-light" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body" id="modal-content-edit">
                    <div class="col-md-12" id="content-edit-order">
                        {{csrf_field()}}
                        <input type="hidden" id="pemesanan_detail_id" name="pemesanan_detail_id" value="">
                        <div class="form-group">
                            <label>Jenis Makanan</label>
                            <select name="jenis_makanan_id" class="form-control js-select2" id="select-jenismakanan" style="width: 100%;">
                                @foreach($jenis_makanan_utama as $jenis_makanan)
                                    <option value="{{$jenis_makanan->id}}">{{$jenis_makanan->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Diet</label>
                            <select name="diet_id" id="select-diet" class="form-control js-select2" id="select-diet" style="width: 100%;" required>
                                <option value="" selected disabled>Pilih Diet</option>
                                @foreach($diet as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Makanan Tambahan</label>
                            <select name="makanan_tambahan_ids[]" class="form-control js-select2" id="select-makanantambahan" style="width: 100%;" data-placeholder="Pilih Makanan Tambahan" multiple>
                                @foreach($jenis_makanan_tambahan as $jenis_makanan)
                                    <option value="{{$jenis_makanan->id}}">{{$jenis_makanan->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="catatan">
                            <label>Catatan</label>
                            <textarea class="form-control" placeholder="Catatan" name="catatan" id="catatan-input"></textarea>
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