<div class="modal fade" id="modal-create-pemeriksaan" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Pemeriksaan Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{$kasus->nomor_kasus}}/pemeriksaan-awal/pemeriksaan-umum/create" method="post">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="">
                                <input type="hidden" class="form-control form-control-lg" id="" name="identitas_id" placeholder="" value="{{$kasus->pasien_id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Anamnesa</label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg" id="" name="anamnesa" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="">Tujuan Pemeriksaan</label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg" id="" name="tujuan_pemeriksaan" rows="3" placeholder=""></input>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-12" for="">Keluhan Utama</label>
                            <div class="col-12">
                                <input class="form-control form-control-lg" id="" name="keluhan_utama" rows="3" placeholder=""></input>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Buat pemeriksaan baru
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
