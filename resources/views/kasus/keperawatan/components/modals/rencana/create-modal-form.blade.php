<div class="modal fade" id="modal-create-rencana-asuhan-form" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block rounded block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Buat Rencana Asuhan Keperawatan Baru</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{url('kasus')}}/{{ $kasus->nomor_kasus }}/keperawatan" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_name">
                    <input type="hidden" value="{{$kasus->id}}" name="kasus_id">
                    <div id="form-container" style="height: 400px;overflow-y: scroll;padding:20px;">
                    </div>
                    <div class="col-12 form-group text-right">
                        <button id="submit" type="submit" class="btn btn-primary" style="margin-top: 15px">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>