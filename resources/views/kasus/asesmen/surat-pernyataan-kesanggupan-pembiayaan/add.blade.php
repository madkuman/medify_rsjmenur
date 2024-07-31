<div class="modal" id="addModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ url()->current() }}/create" method="POST">
            {{ csrf_field() }}

            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">

                    <!-- header -->
                    <div class="block-header ">
                        <h3 class="block-title">Surat Pernyataan Kesanggupan Pembiayaan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <!-- yang bertanda tangan -->
                    <div class="block-content row">
                        <div class="col-md-12">
                            <h5>Yang bertanda tangan</h5>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="nama_penanda">Nama</label>
                                    <input type="text" class="form-control" name="nama_penanda" id="nama_penanda">
                                </div>                                
                                <div class="col-md-4">
                                    <label for="telp_penanda">Telp</label>
                                    <input class="form-control" type="text" name="telp_penanda" id="telp_penanda">
                                </div>
                                <div class="col-md-4">
                                    <label for="hubungan_dengan_pasien">Hubungan dengan Pasien</label>
                                    <select class="form-control" style="width: 100%" name="hubungan_dengan_pasien"
                                        id="hubungan_dengan_pasien">
                                        <option value="Diri Sendiri">Diri Sendiri</option>
                                        <option value="Suami">Suami</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                 <label for="alamat_penanda">Alamat</label>
                                 <textarea class="form-control" name="alamat_penanda"
                                     id="alamat_penanda" rows="5"></textarea>
                             </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pasien -->
                    <div class="block-content row">
                        <div class="col-md-12">
                            <h5>Pasien</h5>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="kelas_perawatan">Kelas Perawatan</label>
                                    <input type="text" class="form-control" name="kelas_perawatan"
                                        id="kelas_perawatan" value="{{ $kasus->kelas->nama ?? '' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="no_rm">No. RM</label>
                                    <input type="text" class="form-control" name="no_rm" id="no_rm"
                                        value="{{ $kasus->pasien->no_rm ?? '' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="nama_pasien">Nama</label>
                                    <input class="form-control" type="text" name="nama_pasien" id="nama_pasien"
                                        value="{{ $kasus->pasien->name ?? '' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="tgl_lahir">Tgl. Lahir</label>
                                    <input class="form-control" type="text" name="tgl_lahir" id="tgl_lahir"
                                        value="{{ $kasus->pasien->date_of_birth ?? '' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="umur">Umur</label>
                                    <input class="form-control" type="text" name="umur" id="umur"
                                        value="{{ $kasus->pasien->age ?? '' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="ruangan">Ruangan</label>
                                    <input class="form-control" type="text" name="ruangan" id="ruangan"
                                        value="{{ $kasus->lokasi->lokasi->nama ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="block-content row">
                     <div class="col-md-12">
                         <h5>Perawat dan Saksi</h5>
                         <div class="form-group row">
                             <div class="col-md-4">
                                 <label for="perawat_ruangan">Perawat Ruangan</label>
                                 <select class="js-select2 form-control" name="perawat_ruangan" id="perawat_ruangan" style="width: 100%">
                                    @foreach ($user as $item)
                                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                              </select>
                             </div>    
                             <div class="col-md-4">
                              <label for="nama_saksi">Nama Saksi</label>
                              <select class="js-select2 form-control" name="nama_saksi" id="nama_saksi" style="width: 100%">
                                 @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                           </select>
                          </div>                           
                         </div>
                     </div>
                 </div>                   

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->

        </form>
    </div><!-- /.modal -->
</div>
