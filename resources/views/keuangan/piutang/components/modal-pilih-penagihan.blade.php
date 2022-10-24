<!-- modal bayar -->
<div id="modal_penagihan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('keuangan/penagihan/add')}}" method="POST">
            <div class="block block-themed">
                <div class="block-header bg-primary">
                    <h5 class="block-title">Pilih Paket Penagihan</h5>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                    {{csrf_field()}}
                    <div class="block-content">
                        <div class="row mb-20">
                            <div class="col-md-5">
                                <h5 style="margin-bottom:0">Akun Rekening</h5>
                            </div>
                            @foreach($piutang as $p)
                                <input type="hidden" name="piutang_id[]" value="{{$p->id}}">
                            @endforeach
                            <div class="col-md-7">
                                <select class="js-select2 form-control" name="penagihan_id" style="width: 100%;" data-placeholder="Pilih Akun Rekening">
                                    @foreach($penagihan as $p)
                                        <option value="{{$p->id}}">{{$p->judul}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="origin" value="{{$origin}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary btn-hero" data-dismiss="modal">Close</button>
                @if(count($penagihan) > 0)
                    <button class="btn btn-warning btn-hero"><i class="fa fa-check"></i> Tambahkan</button>
                @else
                    <button class="btn btn-warning btn-hero" disabled=""><i class="fa fa-check"></i> Tidak ada Penagihan</button>
                @endif                    
            </div>
            </form>
        </div>
    </div>
</div>