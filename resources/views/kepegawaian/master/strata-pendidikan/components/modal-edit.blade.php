<div class="modal fade" id="modal-edit-strata" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/strata-pendidikan/edit')}}" id="form-strata">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Edit Strata Pendidikan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}

                        {{-- <div class="text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div> --}}
                        <div class="row " id="edit-content">
                            <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" name="strataid" id="form-strataid">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Strata Pendidikan</label>
                                        <input type="text" name="nama" placeholder="Masukkan strata pendidikan" class="form-control" 
                                        required autocomplete="off" id="form-nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Jenis Pendidikan</label>
                                        <select name="jenis_pendidikan" id="form-jenis" class="form-control">
                                            <option value=""> -- Jenis Pendidikan -- </option>
                                            @foreach ($jenis as $key)
                                            <option value="{{$key->id}}">{{ $key->nama}} </option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="nama" placeholder="Masukkan nama master jabatan" class="form-control" 
                                        required autocomplete="off"> --}}
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-default btn-hero pull-right btn-close" data-dismiss="modal">
                            Tutup
                        </button>
                        <button class="btn btn-primary btn-hero pull-right btn-submit-edit" type="submit" id="buttonSubmitEdit"><i class="fa fa-check"></i> Simpan</button>
                        <button class="btn btn-alt-primary btn-hero pull-right" style="display: none" type="button"  id="buttonLoadingEdit" disabled>
                            <i class="fa fa-asterisk fa-spin"></i> Loading
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>