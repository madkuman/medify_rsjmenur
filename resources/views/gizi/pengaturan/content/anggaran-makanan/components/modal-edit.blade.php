<div class="modal fade" id="modal-edit" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('gizi/pengaturan/anggaran-makanan/'.$anggaran_makanan->id.'/edit')}}" action="" id="form-edit-anggaran-makanan">
                {{ csrf_field() }}
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Ubah Data Anggaran Makanan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content" id="block-edit-content">
                        <div class="d-none text-center" id="loading">
                            <i class="fa fa-2x fa-spinner fa-spin text-info"></i>
                        </div>
                        <div class="row" id="edit-content">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Anggaran Makanan" name="nama" value="{{$anggaran_makanan->nama}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" placeholder="Nama Satuan" name="satuan" value="{{$anggaran_makanan->satuan}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Jenis Makanan</label>
                                    <select class="js-select2 form-control" name="jenis_makanan_ids[]" data-placeholder="Jenis Makanan" style="width: 100%;" multiple required>
                                        @foreach($jenis_makanan as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id,json_decode($anggaran_makanan->jenis_makanan_ids))) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="js-select2 form-control" name="kelas_ids[]" data-placeholder="Pilih Kelas" style="width: 100%;" multiple required>
                                        @foreach($kelas as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id,json_decode($anggaran_makanan->kelas_ids))) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Bangsal</label>
                                    <select class="js-select2 form-control" name="bangsal_ids[]" data-placeholder="Pilih Bangsal" style="width: 100%;" multiple required>
                                        @foreach($bangsal as $item)
                                            <option value="{{ $item->id }}" @if(in_array($item->id,json_decode($anggaran_makanan->bangsal_ids))) selected @endif>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125 btn-click-animate btn-edit" id="btn-edit">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>