<!-- modal akun penagihan -->
<div id="modal_penagihan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Masukkan Akun Rekening</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">

                    <div class="row mb-20">
                        <div class="col-md-5">
                            <h5 style="margin-bottom:0">Akun Rekening</h5>
                        </div>
                        <div class="col-md-7">
                            <select class="js-select2 form-control" id="akun" name="akun" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                                @foreach($akun as $a)
                                    <option value="{{$a->id}}">{{$a->nama}} - {{$a->no_rekening}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class=" col-md-5 font-w700" style="width:50%; margin-bottom:2rem;">
                            <input type="text" class="d-none" id="id_piutang" value="">
                            <button class="btn btn-primary btn-hero" id="submit_penagihan"><i class="fa fa-check"></i> Kirim Penagihan</button>
                            <button class="btn btn-alt-primary btn-hero" style="display: none; width:100%" id="buttonLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>