

<div class="modal fade" id="modal-edit-item" tabindex="-1" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Ubah SEP #<span id="editHeaderNoSEP"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form class="js-validation-be-contact" action="{{url('kasus')}}/{{ $kasus->nomor_kasus }}/bpjs/edit" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control form-control-lg" id="editID" name="id" placeholder="NO BPJS" value="{{$kasus->identitas->no_asuransi}}" readonly="">
                        <div class="form-group ">
                            <label>No BPJS</label>
                            <input type="text" class="form-control form-control-lg" id="" name="no_bpjs" placeholder="NO BPJS" value="{{$kasus->identitas->no_asuransi}}" readonly="">
                        </div>
                        <div class="form-group ">
                            <label>No SEP</label>
                            <input type="text" class="form-control form-control-lg" id="editSEP" name="no_sep" placeholder="No SEP Pasien" readonly>
                        </div>
                        <div class="form-group ">
                            <label>Plafon SEP</label>
                            <input type="text" class="form-control form-control-lg" id="editPlafon" name="plafon" placeholder="Jumlah Plafon misal : 1200000" >
                        </div>
                        
                        <div class="form-group ">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn-alt btn-hero btn-primary min-width-175 float-right">
                                    <i class="fa fa-send mr-5"></i> Ubah SEP
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>