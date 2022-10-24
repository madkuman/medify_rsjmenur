<div class="modal fade" id="modal-create-mata" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Pemeriksaan baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/pemeriksaan-spesialis/mata/create" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="kasus_id" placeholder="" value="{{$kasus->nomor_kasus}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">OD</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="od" rows="3" placeholder=""></input>
                              <!-- <div class="custom-control custom-radio custom-control-inline mb-5 normal">
                                  <input class="custom-control-input" type="radio" name="od" id="od" value="1" checked="" >
                                  <label class="custom-control-label" for="od">Normal</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline mb-5 tidak-normal">
                                  <input class="custom-control-input" type="radio" name="od" id="od2" value="0" >
                                  <label class="custom-control-label" for="od2">Tidak Normal</label>
                              </div>
                              <div class="ket">
                                <label for="">Keterangan jika tidak normal</label>
                                <textarea class="form-control" name="ket_od"></textarea> 
                              </div> -->
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">OS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="os" rows="3" placeholder=""></input>  
                              <!-- <div class="custom-control custom-radio custom-control-inline mb-5 normal">
                                  <input class="custom-control-input" type="radio" name="os" id="os" value="1" checked="" >
                                  <label class="custom-control-label" for="os">Normal</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline mb-5 tidak-normal">
                                  <input class="custom-control-input" type="radio" name="os" id="os2" value="0" >
                                  <label class="custom-control-label" for="os2">Tidak Normal</label>
                              </div>
                              <div class="ket">
                                <label for="">Keterangan jika tidak normal</label>
                                <textarea class="form-control" name="ket_os"></textarea> 
                              </div> -->
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Visus OD</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="visus_od" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Visus OS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="visus_os" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Visus ODS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="visus_ods" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Bentuk Pupil</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="bentuk_pupil" rows="3" placeholder=""></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2" for="">Koreksi Sampai OD</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="koreksi_od" rows="3" placeholder=""></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2" for="">Koreksi Sampai OS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="koreksi_os" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Add</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="add" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Membedakan Warna</label>
                            <div class="col-10">
                              <select name="membedakan_warna" class="form-control">
                                <option value="Normal" checked />Normal
                                <option value="Buta Warna Parsial" />Buta Warna Parsial
                                <option value="Total" />Total
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Pemeriksaan Perimetris</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="pemeriksaan_perimetris" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Tekanan Intraokulair</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="tekanan_intraokulair" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
