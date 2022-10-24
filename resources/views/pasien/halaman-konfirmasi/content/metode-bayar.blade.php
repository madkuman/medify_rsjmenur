<div class="row">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Metode Pembayaran</label>
                    <select name="metode" class="form-control js-select2" data-size="5" id="selectPembayaran" style="width: 100%;">
                        @foreach($metode as $item)
                        @if(!empty($item->kelas_id))
                        @if(empty($item->perusahaan))
                        <option value="{{$item->id}}" data-bpjs="no" data-tunai='yes'>Umum</option>
                        @else
                        @if($item->perusahaan->type == 1) <option value="{{$item->id}}" data-bpjs="yes" data-tunai='no'>BPJS - {{$item->perusahaan->nama}}</option>
                        @elseif ($item->perusahaan->type == 2) <option value="{{$item->id}}" data-bpjs="no" data-tunai='no'>Perusahaan - {{$item->perusahaan->nama}}</option>
                        @elseif($item->perusahaan->type == 3) <option value="{{$item->id}}" data-bpjs="no" data-tunai='no'>Asuransi - {{$item->perusahaan->nama}}</option>
                        @elseif($item->perusahaan->type == 4)<option value="{{$item->id}}" data-bpjs="no" data-tunai='yes'>Umum - {{$item->perusahaan->nama}}</option>
                        @endif
                        @endif
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="block block-bordered">
                        <div class="block-content">
                            <div id="InfoPembayaran" class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(config('app.bpjs_enable', false))
            @include('pasien.pendaftaran.content.bpjs_sep_form')
            @endif
            <div class="col-md-12">
                <div class="block block-bordered" id="infoSEP" style="display: none">
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="mb-5 text-muted text-uppercase">Sisa Plafon</h6> 
                                <h3 id="sisaPlafon"></h3>                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12 urikkes-hide">
                <div class="form-group">
                    <label class="control-label">Asal Rujukan</label>
                    <select name="rujukan" class="form-control js-select2" data-size="5" id="selectRujukan" style="width: 100%;">
                        <option value="0">Tidak Ada Rujukan</option>
                        @foreach($rujukan as $item)
                        <option value="{{$item->id}}" data-self="{{$item->self}}" data-kode="{{$item->kode}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col-md-12 pilih-poli">
                <div class="form-group">
                    <label class="control-label">Kelas</label>
                    <select name="metode" class="form-control js-select2" data-size="5" id="selectKelasPoli" disabled="disabled" style="width: 100%;">
                        <option value="1" selected="selected">URJ</option>
                    </select>
                    <span class="font-size-sm">* Anda dapat mengubah kelas pelayanan walau tidak sama dengan asuransi</span>
                </div>
            </div>
            <div class="col-md-12 pilih-igd">
                <div class="form-group">
                    <label class="control-label">Kelas</label>
                    <select name="metode" class="form-control js-select2" data-size="5" id="selectKelasIGD" disabled="disabled" style="width: 100%;">
                        <option value="2" selected="selected">IGD</option>
                    </select>
                    <span class="font-size-sm">* Anda dapat mengubah kelas pelayanan walau tidak sama dengan asuransi</span>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">                                                
                    <input class="form-control" type="hidden" name="pasien_id" id="pasien_id" value="{{$pasien->id}}" />
                </div>
            </div>
        </div>
    </div>                             
</div>