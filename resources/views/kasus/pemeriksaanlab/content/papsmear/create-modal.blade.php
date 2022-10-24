<div class="modal fade" id="modal-create-smear" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-fromright modal-dialog" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pemeriksaan Immunologi</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $nomor_kasus }}/pemeriksaanlab/smear/create" method="post">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block-content">
                                <h5>PAP SMEAR</h5>
                                <div class="form-group row">
                                   <div class="col-12">
                                       <label>PAP SMEAR</label>
                                       <div class="row">
                                            <div class="col-9" style="padding-right:0px;">
                                                <textarea type="text" class="form-control" name="pap_smear" autocomplete="off"></textarea>
                                            </div>
                                       </div>
                                   </div>
                                </div>   
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                        <i class="fa fa-send mr-5"></i> Simpan
                                    </button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>