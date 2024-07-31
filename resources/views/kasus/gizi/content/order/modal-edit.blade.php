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
                            <label>Bentuk Makanan</label>
                            <select name="bentuk_makanan" class="form-control js-select2" id="select-bentukmakanan" style="width: 100%;" data-size="5">
                                @foreach($bentuk as $item)
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

<div class="modal fade" id="modal-permintaan-edit" style="display: none;">
    <div class="modal-dialog" role="document">
        <form action="{{ url('kasus/'.$kasus->nomor_kasus.'/gizi/order/edit') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="block-title text-light">Ubah Permintaan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option text-light" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body" id="modal-content-edit">
                    <div class="text-center" id="loading-edit-order" style="display: none">
                        <i class="fa fa-spin fa-spinner text-primary fa-4x"></i>
                    </div>
                    <div class="col-md-12">
                        {{csrf_field()}}

                        <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                        <input type="hidden" name="permintaan_id" value="">

                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="lokasi_id" class="form-control js-select2" style="width: 100%;" required>
                                @foreach($lokasi_ruangan as $item)
                                <option value="{{$item->lokasi_id}}">{{$item->lokasi->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Diet</label>
                            <select name="diet" class="form-control js-select2" style="width: 100%;" required>
                                @foreach($diet as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bentuk Makanan</label>
                            <select name="bentuk_makanan" class="form-control js-select2" style="width: 100%;" data-size="5">
                                @foreach($bentuk as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>WAKTU MAKAN</label>
                            <div class="row">
                            @forelse ($waktu_makan as $item)
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="radio" name="waktu_makan_id" id="radio-waktu-makan-{{ $item->id }}" value="{{ $item->id }}">
                                            <label class="custom-control-label" for="radio-waktu-makan-{{ $item->id }}">{{$item->nama}}</label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <span class="badge badge-danger">Jadwal waktu makan belum ada, silahkan tambahkan terlebih dahulu di pengaturan gizi</span>
                                </div>
                            @endforelse
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" placeholder="Catatan" name="catatan"></textarea>
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