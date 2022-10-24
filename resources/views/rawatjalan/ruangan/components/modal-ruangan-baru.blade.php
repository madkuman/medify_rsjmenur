<div class="modal fade" id="modal-ruangan-baru" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form id="form-ruangan" class="" method="POST" action="{{url('rawatjalan/ruangan/baru')}}">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0" id="modal-title">Tambah Ruangan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_ruangan" id="id_ruangan" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nama Ruangan</label>
                                    <input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" placeholder="Isikan Nama Ruangan" value="{{$last_nama}}" autocomplete="off" required>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-12">Pilih Poliklinik </label>
                                    <div class="col-12">
                                        <select class="form-control js-select2" name="poli" id="poli" style="width: 100%">
                                            <option value="" selected disabled>Pilih Poliklinik</option>
                                            @foreach($poliklinik as $poli)
                                                <option value="{{$poli->id}}">{{$poli->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 mb-5">Nama Dokter</label>
                                    <div class="col-12">
                                        <select name="dokter" id="dokter" class="form-control js-select2" style="width: 100%;" required>  
                                            <option value="" selected disabled>Pilih Dokter</option>
                                            <option value="0">Tidak Ada</option>
                                            @foreach($dokter as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn-alt btn-hero btn-secondary min-width-125 mr-5" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn-alt btn-hero btn-primary min-width-125" id="btn-save">
                            <i class="fa fa-send mr-5"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>