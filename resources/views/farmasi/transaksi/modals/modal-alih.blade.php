<div class="modal" id="modal-alih" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug.'/transaksi/alih')}}">
            {{csrf_field()}}
                <input type="hidden" name="id" value="{{$transaksi->id}}">
                <input type="hidden" name="farmasi_now" value="{{session('farmasi')->slug}}">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3>Alihkan Resep</h3>
                    </div>
                    <div class="block-content">
                        <div class="col-12">
                            <label>Pilih Farmasi Tujuan</label>
                            <select id="select-farmasi" class="form-control js-select2" style="width: 100%;" 
                                data-size="5" name="farmasi" required="true">   
                                @foreach($allFarm as $af)
                                <option value="{{$af->id}}" selected>{{$af->nama}}</option>
                                @endforeach
                                <option value="" selected disabled>Pilih Farmasi</option>
                            </select>
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