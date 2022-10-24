<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="{{url('farmasi/'.session('farmasi')->slug.'/item')}}/edit">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$item->id}}">
            <input type="hidden" name="farmasi" value="{{session('farmasi')->slug}}">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Ubah Barang</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="{{$item->item_detail->nama}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Harga Pasar Barang</label>
                                    <input type="text" class="form-control" name="harga" placeholder="Harga Pasar Barang" value="{{$item->harga}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" placeholder="Satuan Barang" value="{{$item->item_detail->satuan}}" disabled>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="penyedia">Kategori Barang</label>
                                    <input type="text" class="form-control js-tags-input" name="kategori" placeholder="Kategori Barang" value="@foreach($item->item_detail->items_category as $gori) {{$gori->nama}}, @endforeach" disabled>
                                </div> --}}

                                @if(session('farmasi')->consis)
                                <div class="form-group">
                                    <label class="css-control css-control-lg css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" name="consis" id="consis" @if($item->consis) checked @endif> <span class="css-control-indicator"></span> Consis
                                    </label>
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="penyedia">Batasan Low Stock <small>(Opsional)</small></label>
                                    <input type="text" class="form-control" name="batasan_stok" placeholder="Isi Batasan Low Stock" value="{{$item->min_stok}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Batasan Expired <small>(Opsional)</small></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control mr-sm-2" name="batasan_kadaluarsa" placeholder="Isikan Angka" value="{{$item->min_kadaluarsa/$waktu}}">
                                        <select class="form-control mr-sm-2" id="expired-select2" name="satuan_waktu" data-placeholder="Bulan">
                                            <option value="1" @if($waktu == 1) selected @endif)>Hari</option>
                                            <option value="30" @if($waktu == 30) selected @endif>Bulan</option>
                                            <option value="365" @if($waktu == 365) selected @endif>Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="penyedia">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan Lebih Lanjut" value="{{$item->deskripsi}}">
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary btn-square">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>