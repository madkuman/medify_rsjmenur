<div class="row pilih-igd">
    <div class="col-12">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="py-10 text-center font-w600 bg-warning text-white mb-20 align-middle"
                     id="warning-wrapper-readmisi" style="display: @if($readmisi) block @else none @endif;">
                    <i class="fa fa-exclamation-circle mr-5"></i>
                    <span>Pasien Readmisi</span>
                </div>
            </div>
            <div class="col-md-12 ">
                <div class="form-group">
                    <label class="control-label">Ruang IGD</label>
                    <select name="igd" class="form-control js-select2" data-size="5" id="selectIGD" style="width: 100%;">
                        @foreach($igd as $item)
                        @if($item->name=='P3')
                        <option value="{{$item->id}}" selected="selected">{{$item->name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <label class="control-label">
                    Pilih Jenis Pelayanan SIRS
                </label>
                @if (count($sirs_pelayanan) > 0)
                    <select name="sirs_pelayanan_khusus_id" id="sirs_pelayanan_khusus_id" class="form-control js-select2" style="width: 100%;">
                        <option value="0"> Tidak Dikoneksikan </option>
                        @foreach ($sirs_pelayanan as $item)
                            <option value="{{ $item->id }}"> {{ $item->nama }} </option>
                        @endforeach
                    </select>
                @else
                    <small>Silahkan Buat Jenis Pelayanan SIRS </small>
                @endif
            </div>
        </div>
    </div>                             
</div>