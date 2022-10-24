<div class="modal fade" id="modal-create-gizi" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Permintaan Menu Makanan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/datamedis/gizi/create" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="identitas-id" placeholder="" value="{{ $identitas->id }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="nomor-kasus" placeholder="" value="{{ $nomor_kasus }}">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="hidden-diet" name="hidden-diet" placeholder="" value="">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="hidden-diet-detail" name="hidden-diet-detail" placeholder="" value="">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="hidden-sumber-energi" name="hidden-sumber-energi" placeholder="" value="">
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="hidden-keterangan" name="hidden-keterangan" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="select-diet">Jenis Diet</label>
                            <div class="col-md-12">
                                <select class="form-control" id="select-diet" name="select-diet">
                                    @foreach ($diets as $diet)

                                        <option value="{{ $diet->id_diet }}"> {{ $diet->diet_name }}</option>

                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;" id="div-diet-detail">
                            <label class="col-12" for="select-diet" id="label-diet-detail">Diet Detail</label>
                            <div class="col-md-12">
                                <select class="form-control" id="select-diet-detail" onchange="DietDetail()" name="select-diet-detail">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;" id="div-sumber-energi">
                            <label class="col-12" for="select-diet" id="label-sumber-energi">Sumber Energi</label>
                            <div class="col-md-12">
                                <select class="form-control" id="select-sumber-energi" onchange="SumberEnergi()" name="select-sumber-energi">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none;" id="div-keterangan">
                            <label class="col-12" for="select-diet" id="label-keterangan">Keterangan</label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg" id="input-keterangan" name="input-keterangan" placeholder="" value="">
                            </div>
                        </div>
<!--                        <div class="form-group row">-->
<!--                            <label class="col-12">Pilih Waktu</label>-->
<!--                            <div class="col-12">-->
<!--                                <div class="custom-control custom-checkbox mb-12">-->
<!--                                    <input class="custom-control-input" type="checkbox" name="checkbox-pagi" id="example-checkbox1" value="1">-->
<!--                                    <label class="custom-control-label" for="example-checkbox1">Pagi</label>-->
<!--                                </div>-->
<!--                                <div class="custom-control custom-checkbox mb-12">-->
<!--                                    <input class="custom-control-input" type="checkbox" name="checkbox-siang" id="example-checkbox2" value="1">-->
<!--                                    <label class="custom-control-label" for="example-checkbox2">Siang</label>-->
<!--                                </div>-->
<!--                                <div class="custom-control custom-checkbox mb-12">-->
<!--                                    <input class="custom-control-input" type="checkbox" name="checkbox-malam" id="example-checkbox3" value="1">-->
<!--                                    <label class="custom-control-label" for="example-checkbox3">Malam</label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-group row">
                            <label class="col-12" for="example-datepicker1">Untuk Tanggal</label>
                            <div class="col-lg-12">
                                <input type="text" class="js-datepicker form-control" id="example-datepicker1" name="date-target" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-hero btn-alt-primary min-width-175">
                                    <i class="fa fa-send mr-5"></i> Buat Permintaan Menu Makanan Baru
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>