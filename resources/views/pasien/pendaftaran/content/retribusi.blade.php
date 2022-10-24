<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Retribusi</label>
                </div>
            </div>
           
            @foreach($tarif_admin as $index_kategori => $tarif_admin_kategori)
                @foreach($tarif_admin_kategori as $tarif)
                    <div class="col-12 {{$index_kategori}} retribusi-checkbox-container retribusi-checkbox-container-kelas-{{$tarif->kelas_id}}">
                        <div class="form-group">
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" name="retribusi" class="css-control-input retribusi-checkbox" data-harga="{{$tarif->harga}}"  value="{{$tarif->id}}" >
                                <span class="css-control-indicator"></span> 
                                {{$tarif->master->deskripsi}} - 

                                @if($tarif->kelas_id != 0)
                                    Kelas {{$tarif->kelas->nama ?? '-'}} 
                                @endif
                               
                                (Rp {{number_format($tarif->harga,0)}})
                            </label>
                        </div>
                    </div>
                @endforeach
            @endforeach
            <hr>
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Tarif Dokter</label>
                </div>
            </div>
           
            @foreach($tarif_admin as $index_kategori => $tarif_admin_kategori)
                @foreach($tarif_admin_kategori as $tarif)
                    <div class="col-12 {{$tarif->master->slug}} retribusi-checkbox-container retribusi-checkbox-container-kelas-{{$tarif->kelas_id}}">
                        <div class="form-group">
                            @if($tarif->harga != 0)
                            <label class="css-control css-control-primary css-checkbox">
                                <input type="checkbox" name="retribusi" class="css-control-input retribusi-checkbox" data-harga="{{$tarif->harga}}"  value="{{$tarif->id}}" >
                                <span class="css-control-indicator"></span> 
                                {{$tarif->master->deskripsi}} - 

                                @if($tarif->kelas_id != 0)
                                    Kelas {{$tarif->kelas->nama ?? '-'}} 
                                @endif
                                    (Rp {{number_format($tarif->harga,0)}})
                            </label>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endforeach
            <div class="col-md-12 ">
                <div class="form-group">
                    <span class="control-label font-w700">TOTAL TAGIHAN PEMBAYARAN : Rp </span><span id="total_bayar"></span>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">                                                
                    <input class="form-control" type="hidden" name="pasien_id" id="pasien_id" value="{{$identitas->id}}" />
                </div>
            </div>
        </div>
    </div>                             
</div>