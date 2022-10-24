<div class="modal fade" id="modal-screen-baru" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form id="form_ruangan" method="POST" action="{{url('rawatjalan/screen-tv/baru')}}">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0 form-screen-title">Tambah Screen TV</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nama Screen</label>
                                    <input type="text" class="form-control" name="nama_scr" id="nama_scr" placeholder="Isikan Nama Screen TV" autocomplete="off" required>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-12">Pilih Kelas Antrian</label>
                                    <div class="col-8">
                                        <select name="level[]" id="level_all" class="js-example-basic-multiple form-control" placeholder="Pilih Kelas" multiple="multiple" style="width: 100%">
                                            @foreach($level as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="css-control css-control-md css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="level_all" id="level_all_check"> <span class="css-control-indicator"></span> Pilih semua
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-12">Pilih Ruangan <small>(Maksimal 12 Ruangan)</small></label>
                                    <div class="col-12">
                                        <select class="form-control multiple-max" name="ruangan[]" id="ruangan_all" placeholder="Pilih Poli" multiple="multiple" style="width: 100%">
                                            @foreach($ruangan as $ruangan)
                                                <option value="{{$ruangan->id}}">{{$ruangan->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-4">
                                        <label class="css-control css-control-md css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input" name="poli_all" id="poli_all_check"> <span class="css-control-indicator"></span> Pilih semua
                                        </label>
                                    </div> --}}
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