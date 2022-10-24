<div class="modal fade" id="modal-edit-jabatan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/jabatan/edit')}}" id="form-add">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Edit Jabatan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}

                        <div class="text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="row d-none" id="edit-content">
                            <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" name="jabatanid" id="jabatanid">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Nama Jabatan</label>
                                        <input type="text" name="nama" placeholder="Masukkan nama master jabatan" class="form-control" 
                                        required autocomplete="off" id="nama">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Jenis Jabatan</label>
                                        <select name="jenis_jabatan" id="jenis_jabatan" class="form-control" required>
                                            <option value=""> -- Pilih Jenis Jabatan -- </option>
                                            @foreach ($jenis as $key)
                                            <option value="{{$key->id}}">{{ $key->nama}} </option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="nama" placeholder="Masukkan nama master jabatan" class="form-control" 
                                        required autocomplete="off"> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Departement</label>
                                        <select name="departemen" id="departemen" class="form-control">
                                            <option value=""> -- Pilih Departement -- </option>
                                            @foreach ($departemen as $key)
                                            <option value="{{$key->id}}">{{ $key->nama}} </option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="nama" placeholder="Masukkan nama master jabatan" class="form-control" 
                                        required autocomplete="off"> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Gaji</label>
                                        <input type="text" name="gaji" placeholder="Masukkan Gaji Jabatan" class="form-control gaji" 
                                        required autocomplete="off" id="gaji">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Urutan</label>
                                        <input type="number" name="urutan" placeholder="Masukkan Urutan" class="form-control" 
                                        required autocomplete="off" id="urutan">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">SP Number</label>
                                        <input type="number" name="sp_number" placeholder="Masukkan Nomer SP" class="form-control" 
                                        required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">SP Date</label>
                                        <input type="date" name="sp_date" placeholder="Masukkan Tanggal SP" class="form-control" 
                                        required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Supervisor</label>
                                        <input type="number" name="supervisor" placeholder="Masukkan Supervisor" class="form-control" 
                                        required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Order</label>
                                        <input type="number" name="order" placeholder="Masukkan Order" class="form-control" 
                                        required autocomplete="off">
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate" id="btn-save">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>