<div class="modal fade" id="modal-edit-gelar" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="" method="POST" action="{{url('kepegawaian/master/gelar-pendidikan/edit')}}" id="form-gelar">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Edit Gelar Pendidikan</h4>
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
                                <input type="hidden" name="gelarid" id="form-gelarid">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Gelar Pendidikan</label>
                                        <input type="text" name="nama" placeholder="Masukkan gelar pendidikan" class="form-control" 
                                        required autocomplete="off" id="form-nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Strata Pendidikan</label>
                                        <select name="strata_pendidikan" id="form-strata" class="form-control">
                                            <option value=""> -- Pilih Strata Pendidikan-- </option>
                                            @foreach ($strata as $key)
                                            <option value="{{$key->id}}">{{$key->nama}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="nama" placeholder="Masukkan nama master jabatan" class="form-control" 
                                        required autocomplete="off"> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Indek</label>
                                        <input type="number" step="any" class="form-control" placeholder="Jumlah Indek" name="index" id="index-gelar" required>
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