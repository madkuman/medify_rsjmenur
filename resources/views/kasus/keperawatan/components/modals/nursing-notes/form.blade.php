<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Form Nursing Notes</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form  action="{{url('')}}/kasus/{{$kasus->nomor_kasus}}/keperawatan/nursing-notes/post" method="post">
                        {{csrf_field()}}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg input-id"  name="id" placeholder="" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12" for="">Jam</label>
                            <div class="col-12">
                                <input class="form-control time input-jam" required="" name="jam">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Diagnosis Keperawatan</label>
                            <div class="col-12">
                                <select class="js-select2 form-control input-diagnosis" name="" style="width: 100%" required="" multiple="">
                                    @foreach($kasus_asuhan as $item)
                                    <option value="{{$item->asuhan->id}}">{{$item->asuhan->diagnosa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Implementasi</label>
                            <div class="col-12">
                                <select class="js-select2 form-control input-implementasi" name="implementasi_id[]" multiple="" style="width: 100%" required="">
                                </select>

                                <input class="input-implementasi-text" name="implementasi_text" type="hidden">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Evaluasi</label>
                            <div class="col-12">
                                <textarea class="form-control form-control-lg input-evaluasi" name="evaluasi" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-click-animate btn-hero btn-primary min-width-175 float-right">
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