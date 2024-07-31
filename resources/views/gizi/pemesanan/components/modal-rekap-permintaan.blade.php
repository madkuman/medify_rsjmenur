<div class="modal fade" id="modal-rekap-permintaan" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-print" method="POST" action="{{url('gizi/pemesanan/rekap-permintaan/baru')}}">
                <div class="block rounded block-transparent mb-0">
                    <div class="block-header">
                        <h4 class="font-w400 mb-0">Buat Rekap Permintaan</h4>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 ">
                                <input type="hidden" name="tanggal" value="@if(!empty($tanggal)){{$tanggal}}@else{{date('d-m-Y')}}@endif">
                                <div class="form-group">
                                    <label class="form-label">
                                        Bangsal
                                    </label>
                                    <div class="row">
                                        <div class="col-md-12" style="bottom: 5px">
                                            <select name="bangsal_id" id="bangsal_id" class="form-control js-select2" style="width: 100%">
                                                <option value="">Semua</option>
                                                @foreach($bangsal as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label class="form-label">
                                        Waktu Makan
                                    </label>
                                    <div class="row">
                                        <div class="col-md-12" style="bottom: 5px">
                                            @if($fitur_pemilihan_data_makan_gizi)
                                                <select name="waktu_makan_id[]" id="waktu_makan_id"
                                                        class="form-control js-select2" multiple="multiple"
                                                        style="width: 100%" required>
                                            @else
                                                <select name="waktu_makan_id" id="waktu_makan_id"
                                                        class="form-control js-select2" style="width: 100%" required>
                                            @endif
                                                @foreach($option_waktu_makan as $item)
                                                    <option value="{{$item->id}}">{{$item->nama.' ('.$item->time.')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-bullseye"></i> Buat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>