<div class="modal fade" id="modal-create-pertanyaan" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fadein modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="modal-form" method="POST" action="">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0"><span id="modal-title">Tambah</span> Pertanyaan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="d-none text-center" id="loading">
                            <i class="fa fa-spin fa-spinner fa-7x"></i>
                        </div>
                        <div class="row" id="form-content">
                            <div class="col-md-12 ">
                                <input type="hidden" name="kuisionerid" value="{{$kuisioner->id}}">
                                <input type="hidden" name="pertanyaanid" value="">
                                <div class="form-group row" id="pertanyaan_create_layout">
                                    <label class="col-12 control-label">Pertanyaan</label><br>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="pertanyaan" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="control-label">Jenis Pertanyaan</label><br>
                                        <select class="form-control" name="jenis_pertanyaan" id="jenis_pertanyaan" onchange="showLayout()" required>
                                            <option value="" disabled selected>-- Pilih Jenis Pertanyaan --</option>
                                            <option value="puas">Puas/Tidak Puas</option>
                                            <option value="sesuai">Sesuai/Tidak Sesuai</option>
                                            <option value="pilgan">Pilihan Ganda</option>
                                            <option value="skala">Skala</option>
                                            <option value="textbox">Isian Singkat</option>
                                            <option value="textarea">Isian Uraian</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label class="control-label">Bagian Pertanyaan</label><br>
                                        <select class="form-control js-select2" style="width: 100%;text-transform:uppercase" name="bagian" id="bagian" data-tags="true" required>
                                            <option value="" disabled selected>-- Pilih Bagian --</option>
                                            @foreach ($bagian as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="jenis_penilaian" class="col-4 d-none">
                                        <label class="control-label">Jenis Penilaian</label><br>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="bobot" value="1" checked="">
                                            <span class="css-control-indicator"></span> Positif
                                        </label>
                                        <label class="css-control css-control-primary css-radio">
                                            <input type="radio" class="css-control-input" name="bobot" value="-1">
                                            <span class="css-control-indicator"></span> Negatif
                                        </label>
                                    </div>
                                </div>
                                <div id="isian-content"></div>
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