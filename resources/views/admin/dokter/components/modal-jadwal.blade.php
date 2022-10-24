<div class="modal fade" id="modal_jadwal_praktek" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-5 mb-0">
                        Jadwal Praktek
                    </h4>
                    <form method="POST" id="jadwal_praktek_form" class="col-md-12" action="#">
                        <input type="hidden" name="form_row" value="0">
                        <input type="hidden" name="form_jadwal_id" value="0">
                        <h6 class="font-size-s font-w400 mt-5 mb-0"><span class="modal-jadwal-text">Tambahkan</span> jadwal praktek dokter</h6>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group row mb-0">
                                    <label class="col-12">Poliklinik</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group row mb-0">
                                    <label class="col-12">Hari</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group row mb-0">
                                    <label class="col-12">Jam Mulai</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group row mb-0">
                                    <label class="col-12">Jam Selesai</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group row mb-0">
                                    <label class="col-12">Telekonsultasi</label>
                                </div>
                            </div>
                        </div>
                        <div id="jadwal_praktek_form_content">
                            <div class="row template_element">
                                <div class="col-3">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="hidden" name="form_poli_txt[]">
                                            <select class="js-select2 form-control jadwal_praktek_form_poli" style="width: 100%" name="form_poliklinik[]">
                                                <option value="" selected>Tidak Ada</option>
                                                @foreach($poliklinik as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>  
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <select class="js-select2 form-control" style="width: 100%" name="form_hari[]">
                                                <option value="" selected>Pilih Hari</option>
                                                <option value="1|Senin">Senin</option>
                                                <option value="2|Selasa">Selasa</option>
                                                <option value="3|Rabu">Rabu</option>
                                                <option value="4|Kamis">Kamis</option>
                                                <option value="5|Jumat">Jumat</option>
                                                <option value="6|Sabtu">Sabtu</option>
                                                <option value="0|Minggu">Minggu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="text" class="js-masked-time form-control js-masked-enabled" name="form_time_start[]" style="width: 100%" value="" placeholder="Jam Mulai" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="text" class="js-masked-time form-control js-masked-enabled" name="form_time_end[]" style="width: 100%" value="" placeholder="Jam Selesai" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group mb-5">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" value="1" class="css-control-input" name="is_video[]">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="form-group row">
                                        <div class="col-12 pt-5">
                                            <a href="javascript:void(0);" class="jadwal_remove_button"><span class="fa fa-2x fa-trash" style="color: red;"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="jadwal_praktek_form_add_row" class="btn btn-xs btn-info float-left mt-5">
                            <i class="fa fa-plus-circle"></i> Tambah Input
                        </button>
                        <button type="button" id="jadwal_praktek_form_add" class="btn btn-xs btn-primary float-right mt-5 modal-jadwal-text">
                            Tambahkan
                        </button>
                        <button type="button" class="btn btn-xs btn-default float-right mr-5 mt-5" data-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>