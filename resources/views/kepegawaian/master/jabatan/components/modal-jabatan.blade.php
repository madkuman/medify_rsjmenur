<div class="modal fade" id="modal-jabatan" role="dialog" aria-labelledby="modal-fromtop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url()->current()}}" id="form-jabatan">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0"><span id="modal-option">Tambah</span> Jabatan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="jabatanid" id="form-jabatanid" value="0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Jabatan</label>
                                    <input type="text" name="nama" id="form-nama" placeholder="Masukkan nama jabatan" class="form-control" 
                                    required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Indek</label>
                                    <input type="number" step="any" class="form-control" placeholder="Jumlah Indek" name="index" id="form-index" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Jenis Jabatan</label>
                                    <select name="jenis_jabatan" id="form-jenis-jabatan" class="form-control js-select2" style="width: 100%" required>
                                        <option value="" selected> -- Pilih Jenis Jabatan -- </option>
                                        @foreach ($jenis as $key)
                                        <option value="{{$key->id}}">{{ $key->nama}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Departement</label>
                                    <select name="departemen" id="form-departemen" class="form-control js-select2" style="width: 100%">
                                        <option value="" selected> -- Pilih Departement -- </option>
                                        @foreach ($departemen as $key)
                                        <option value="{{$key->id}}">{{ $key->nama}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Gaji</label>
                                    <input type="text" name="gaji" id="form-gaji" placeholder="Masukkan Gaji Jabatan" class="form-control js-masked form-gaji js-masked-enable" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Urutan</label>
                                    <input type="number" name="urutan" id="form-urutan" placeholder="Masukkan Urutan" class="form-control" 
                                    required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Jabatan Pimpinan</label>
                                    <select name="parent_id" id="form-jabatan-pimpinan" class="form-control js-select2" style="width: 100%">
                                        <option value="" selected> -- Pilih Jabatan Pimpinan -- </option>
                                        @foreach ($jabatan as $key)
                                            <option value="{{$key->id}}">{{ $key->nama}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary btn-hero pull-right btn-click-animate" type="submit" id="buttonSubmit"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>