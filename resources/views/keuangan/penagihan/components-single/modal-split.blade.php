<div id="splitPiutang" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/split" id="formSplit">
                {{csrf_field()}}
                <div class="block">
                    <div class="block-header">
                        <h5 class="block-title">Split Piutang</h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row mb-20 ">
                            <div class="col-2" >
                                <label>Piutang ID</label>
                                <input type="text" readonly class="form-control" value="{{$piutang->id}}">
                            </div>
                            <div class="col-4" >
                                <label>Pasien</label>
                                <input type="text" readonly class="form-control" value="{{$piutang->pasien->name ?? ''}}">
                                <small>Untuk mengganti pasien silahkan gunakan menu edit</small>
                            </div>
                            <div class="col-2" >
                                <label>Total Piutang</label>
                                <input type="text" readonly class="form-control" value="{{number_format($piutang->total - $piutang->total_paid)}}">
                            </div>
                        </div>
                        @include('keuangan.piutang.components-single.split-content')
                        <div id="split-tambahan-container">
                        </div>
                        <div class="row">
                            @if(!empty($piutang->pasien_id))
                            <div class="col-12 text-center">
                                @else
                                <div class="col-9 text-center">
                                    @endif
                                    <button class="btn btn-circle btn-outline-primary split-add-button" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row mt-20 text-center">
                                <div class="col-12">
                                    <span id="split-piutang-bayar-tunai-notif" class="alert alert-primary" style="display: none">Pembayaran akan ditagihkan kepada pasien</span>
                                </div>
                            </div>
                            <div class="row mt-20 text-center">
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissable split-error" style="display: none"></div>
                                </div>
                            </div>

                            <br>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class=" col-md-12 text-center font-w700" style="width:50%; margin-bottom:2rem;">
                            <button class="btn btn-primary btn-hero" type="button" id="submitSplit"><i class="fa fa-check"></i> Split Piutang</button>
                            <button class="btn btn-alt-primary btn-hero" disabled style="display: none; width:100%" id="splitLoading">
                                <i class="fa fa-asterisk fa-spin"></i> Loading
                            </button>
                        </div>
                    </div>
                </div>
            </form>
    </div>        
</div>