<div class="modal" id="modalFormObat" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url()->current() }}/post" method="POST">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header ">
                        <h3 class="block-title">Catatan Pengobatan Pasien</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content row">
                        {{ csrf_field() }}
                        <input type="hidden" class="input-id" name="id">
                        <div class="col-12">
                            <div class="form-group row mb-5">
                                <label class="col-12">Nama Obat <i id=""
                                        class="obatLoading fa fa-asterisk fa-spin text-info"></i></label>
                                <div class="col-12">
                                    <input type="text" class="form-control obat-autocomplete input-nama"
                                        name="nama_obat">
                                </div>
                                <input class="input-obat-id" name="obat_id" type="hidden">
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-12">Aturan Pemakaian</label>
                                <div class="col-12">
                                    <input type="text" class="form-control input-aturan" name="aturan_pemakaian">
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-12">Rute</label>
                                <div class="col-12">
                                    <select class="js-select2 form-control input-rute" name="rute"
                                        style="width: 100%;" data-placeholder="Pilih Rute">
                                        <option value="IV Bolus" selected>IV Bolus</option>
                                        <option value="IV Drip">IV Drip</option>
                                        <option value="Intramuskular">Intramuskular</option>
                                        <option value="Subcutan">Subcutan</option>
                                        <option value="Continuous Infusion">Continuous Infusion</option>
                                        <option value="Per Oral">Per Oral</option>
                                        <option value="Topical">Topical</option>
                                        <option value="Tempel">Tempel</option>
                                        <option value="Supposutoria">Supposutoria</option>
                                        <option value="Tetes Mata">Tetes Mata</option>
                                        <option value="Tetes Hidung">Tetes Hidung</option>
                                        <option value="Tetes Telinga">Tetes Telinga</option>
                                        <option value="Enema">Enema</option>
                                        <option value="Per Anal">Per Anal</option>
                                    </select>
                                    <!-- <input type="text" class="form-control input-rute" name="rute"> -->
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-12">Keterangan</label>
                                <div class="col-12">
                                    <input type="text" class="form-control input-keterangan" name="keterangan">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-5">
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-segera" name="cb_segera_diberikan">
                                        <span class="css-control-indicator"></span> <small>Segera Diberikan</small>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-lambat"
                                            name="cb_terlambat_diberikan">
                                        <span class="css-control-indicator"></span> <small>Terlambat Diberikan </small>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-bebas" name="cb_pemberian_bebas">
                                        <span class="css-control-indicator"></span> <small>Pemberian Bebas </small>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-5">
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-segera" name="aturan_per_jam_1">
                                        <span class="css-control-indicator"></span> <small>07:00</small>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-segera" name="aturan_per_jam_2">
                                        <span class="css-control-indicator"></span> <small>13:00</small>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-segera" name="aturan_per_jam_3">
                                        <span class="css-control-indicator"></span> <small>19:00</small>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-segera" name="aturan_per_jam_4">
                                        <span class="css-control-indicator"></span> <small>24:00</small>
                                    </label>
                                </div>
                                <div class="col-5">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" value="1"
                                            class="css-control-input input-pemberian-segera" name="aturan_per_jam_5">
                                        <span class="css-control-indicator"></span> <small>22:00</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-click-animate btn-primary btn-simple">Submit</button>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
</div>
