<div class="form-group row">
    <div class="col-8">
        <label>Pengesahan</label><br>
        <select class="form-control form-control-lg js-select2 dokter_laporan" data-size="5" id="dokter_laporan" name="dokter" style="width: 72%;" placeholder="Dokter Pemeriksa" required="">
            <option></option>
            @foreach($dokter as $doc)
            <option value="{{json_encode($doc)}}" data-keterangan="{{$doc->keterangan}}"  data-sebagai="{{$doc->sebagai}}" >{{$doc->nama}}</option>
            @endforeach
        </select>
    </div>
</div>