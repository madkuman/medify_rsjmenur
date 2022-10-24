<div class="modal" id="modal-consis" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/consis/'.$transaksi->slug)}}">
            {{csrf_field()}}
                <input type="hidden" name="id" value="{{$transaksi->id}}">
                <input type="hidden" name="farmasi_now" value="{{session('farmasi')->slug}}">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title">Ambil di Consis</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12 row form-group mb-5">
                                <label class="col-6"> Nama Barang</label>
                                <label class="col-4 pl-0"> Jumlah</label>
                            </div>
                            @if($transaksi->status != 1)
                            @foreach($transaksi->final_detail->resep_detail as $detail)
                            @if($detail->obat_id && $detail->obat_detail->consis)
                            <div class="col-12 row form-group">
                                <input type="hidden" name="detail_id[]" value="{{$detail->obat_id}}">
                                <div class="col-6"><span class="align-middle lead font-w400">{{$detail->nama_obat}}</span></div>
                                @if($detail->hari7) 
                                <input type="text" name="jumlah_obat_detail[]" class="form-control col-2" value="{{$detail->hari7}}">
                                @else
                                <input type="text" name="jumlah_obat_detail[]" class="form-control col-2" value="{{$detail->jumlah}}">
                                @endif
                            </div>
                            @endif
                            @endforeach
                            @endif
                            <div class="form-group col-10">
                                <label>Pilih Loket Tujuan</label>
                                <select id="select-farmasi" class="form-control js-select2" name="loket_id" required="true" data-placeholder="Pilih Loket" style="width: 100%;">
                                    @foreach($loket as $lok)
                                    <option value="{{$lok->id}}" selected>{{$lok->nama}}</option>
                                    @endforeach
                                    <option value="" selected=""></option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <small class="text-primary">Tidak menemukan obat yang anda inginkan? <a class="link-effect" href="{{url('farmasi/'.session('farmasi')->slug.'/item')}}" target="_blank">Atur disini!</a></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary">
                        <i class="fa fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>