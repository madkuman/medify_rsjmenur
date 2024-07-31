<div class="modal" id="modal-large" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/jenis-antrian')}}/save" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Jenis Antrian</h3>
                    </div>
                    <div class="block-content">
                        <input type="hidden" class="form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="penyedia">Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Kode</label>
                                    <input type="text" class="form-control" name="kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Perusahaan Tipe</label>
                                    <select class="form-control js-select2" name="perusahaan_tipe" id="perusahaan_tipe" aria-placeholder="Pilih Perusahaan Tipe" style="width: 100%" required>
                                        <option value="">Pilih Perusahaan Tipe</option>
                                        <option value="0">Semua Perusahaan Tipe</option>
                                        @foreach ($perusahaan_tipe as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Jenis Resep Antrian</label>
                                    <select class="form-control js-select2" name="jenis_resep_antrian" style="width: 100%" required>
                                        <option value="0">Semua</option>
                                        <option value="1">Racikan</option>
                                        <option value="2">Non Racikan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penyedia">Lokasi Departemen</label>
                                    <select class="form-control js-select2" name="lokasi_departemen_id" style="width: 100%" required>
                                        <option value="0">Semua</option>
                                        @foreach ($lokasi_departemen_khusus as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>File Sound</label>
                                    <input type="file" accept=".mp3" name="sound" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-square" id="close" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-click-animate btn-primary btn-simple">
                         <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>