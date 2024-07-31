<div class="modal fade" id="modal-order-create" style="display: none;">
    <div class="modal-dialog" role="document">
        <form action="{{ url('kasus/'.$kasus->nomor_kasus.'/gizi/order/create') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="block-title text-light">Buat Order Diet Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option text-light" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        {{csrf_field()}}
                        <input type="hidden" name="kasus_id" value="{{ $kasus->id }}">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="lokasi_id" class="form-control js-select2" style="width: 100%;" required>
                                @foreach($lokasi_ruangan as $item)
                                <option value="{{$item->lokasi_id}}" {{ $item->lokasi_id == $kasus->lokasi->lokasi_id ? 'selected' : '' }}>{{$item->lokasi->nama}}</option>
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
                            <label>Jenis Makanan</label>
                            <select name="jenis_makanan_id" class="form-control js-select2" style="width: 100%;">
                                @foreach($jenis_makanan_utama as $jenis_makanan)
                                    <option value="{{$jenis_makanan->id}}">{{$jenis_makanan->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Makanan Tambahan</label>
                            <select name="makanan_tambahan_ids[]" class="form-control js-select2" style="width: 100%;" data-placeholder="Pilih Makanan Tambahan" multiple>
                                @foreach($jenis_makanan_tambahan as $jenis_makanan)
                                    <option value="{{$jenis_makanan->id}}">{{$jenis_makanan->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jadwal Pengantaran</label>
                            <div class="input-daterange input-group" data-date-format="dd/mm/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input autocomplete="off" type="text" class="form-control" id="example-daterange1" name="daterange1" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}" required>
                                <div class="input-group-prepend input-group-append" id="config-jadwal-1" style="display: inline">
                                    <span class="input-group-text font-w600">to</span>
                                </div>
                                <input autocomplete="off" type="text" class="form-control" name="daterange2" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true" value="{{date('d/m/Y')}}" id="config-jadwal-2" style="display: inline" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>WAKTU MAKAN</label>
                            <div class="row">
                            @forelse ($waktu_makan as $item)
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="waktu_makan[{{ $item->id }}]" id="waktu-makan-{{ $item->id }}" value="1">
                                            <label class="custom-control-label" for="waktu-makan-{{ $item->id }}">{{$item->nama}}</label>
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