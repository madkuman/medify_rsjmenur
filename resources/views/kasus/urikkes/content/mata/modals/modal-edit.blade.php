@foreach ($mata as $key => $value)
<div class="modal fade" id="modal-edit-mata{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Edit Pemeriksaan {{$key+1}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/pemeriksaan-spesialis/mata/edit" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="id" placeholder="" value="{{$value->id}}">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-2" for="">OD</label>
                            <div class="col-10">
                              <input type="text" class="form-control form-control-lg" id="" name="od" rows="3" placeholder="" value="{{$value->od}}"></input>
                              <!-- <div class="custom-control custom-radio custom-control-inline mb-5 normal">
                                  <input class="custom-control-input" type="radio" name="od" id="od1-{{$value->id}}" value="1" @if($value->od == 1) checked="" @endif >
                                  <label class="custom-control-label" for="od1-{{$value->id}}">Normal</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline mb-5 tidak-normal">
                                  <input class="custom-control-input" type="radio" name="od" id="od2-{{$value->id}}" value="0" @if($value->od == 0) checked="" @endif >
                                  <label class="custom-control-label" for="od2-{{$value->id}}">Tidak Normal</label>
                              </div>
                              <div class="ket">
                                <label for="">Keterangan jika tidak normal</label>
                                <textarea class="form-control" name="ket_od">{{$value->ket_od}}</textarea> 
                              </div> -->
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">OS</label>
                            <div class="col-10">
                              <input type="text" class="form-control form-control-lg" id="" name="os" rows="3" placeholder="" value="{{$value->os}}"></input>
                              <!-- <div class="custom-control custom-radio custom-control-inline mb-5 normal">
                                  <input class="custom-control-input" type="radio" name="os" id="os1-{{$value->id}}" value="1" @if($value->os == 1) checked="" @endif >
                                  <label class="custom-control-label" for="os1-{{$value->id}}">Normal</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline mb-5 tidak-normal">
                                  <input class="custom-control-input" type="radio" name="os" id="os2-{{$value->id}}" value="0" @if($value->os == 0) checked="" @endif >
                                  <label class="custom-control-label" for="os2-{{$value->id}}">Tidak Normal</label>
                              </div>
                              <div class="ket">
                                <label for="">Keterangan jika tidak normal</label>
                                <textarea class="form-control" name="ket_os">{{$value->ket_od}}</textarea> 
                              </div> -->
                          </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Visus OD</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="visus_od" rows="3" placeholder="" value="{{$value->visus_od}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Visus OS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="visus_os" rows="3" placeholder="" value="{{$value->visus_os}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Visus ODS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="visus_ods" rows="3" placeholder="" value="{{$value->visus_ods}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Bentuk Pupil</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="bentuk_pupil" rows="3" placeholder="" value="{{$value->bentuk_pupil}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Koreksi Sampai OD</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="koreksi_od" rows="3" placeholder="" value="{{$value->koreksi_od}}"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2" for="">Koreksi Sampai OS</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="koreksi_os" rows="3" placeholder="" value="{{$value->koreksi_os}}"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Add</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="add" rows="3" placeholder="" value="{{$value->add}}"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Membedakan Warna</label>
                            <div class="col-10">
                              <select name="membedakan_warna" class="form-control">
                                <option value="Normal"
                                @if($value->membedakan_warna == 'Normal')
                                  selected
                                @endif
                                />Normal
                                <option value="Buta Warna Parsial"
                                @if($value->membedakan_warna == 'Buta Warna Parsial')
                                  selected
                                @endif
                                />Buta Warna Parsial
                                <option value="Total"
                                @if($value->membedakan_warna == 'Total')
                                  selected
                                @endif
                                 />Total
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Pemeriksaan Perimetris</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="pemeriksaan_perimetris" rows="3" placeholder="" value="{{$value->pemeriksaan_perimetris}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2" for="">Tekanan Intraokulair</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-lg" id="" name="tekanan_intraokulair" rows="3" placeholder="" value="{{$value->tekanan_intraokulair}}">
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
@endforeach
