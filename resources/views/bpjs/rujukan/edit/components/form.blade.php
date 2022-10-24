<form id="form-edit" method="POST" action="{{url('bpjs/rujukan')}}/{{$no_rujukan}}/edit">
    {{csrf_field()}}
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>No Rujukan</label>
                <input type="text" class="form-control" value="{{$no_rujukan}}" readonly>
            </div>
            <div class="form-group">
                <label>Tanggal Rujukan</label>
                <input class="form-control" name="tanggal_rujukan" value="{{$tanggal_rujuk}}" readonly>
            </div>
            <div class="form-group">
                <label>Pelayanan</label>
                <select class="form-control" name="jenis_rujuk">
                    <option value="1" @if($result->jenis_rujuk == 1) selected @endif>Rawat Inap</option>
                    <option value="2" @if($result->jenis_rujuk == 2) selected @endif>Rawat Jalan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tipe</label>
                <select class="form-control" name="tipe_rujuk">
                    <option value="0" @if($result->tipe_rujuk == 0) selected @endif>Penuh</option>
                    <option value="1" @if($result->tipe_rujuk == 1) selected @endif>Partial</option>
                    <option value="2" @if($result->tipe_rujuk == 2) selected @endif>Rujuk Balik (Non PRB)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Diagnosis</label>
                <select class="js-select2 form-control" id="select_diagnosis" name="diagnosis">
                    <option value="{{$result->diagnosa}}" selected="selected">{{$result->diagnosa}} | {{$diagnosa}}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tujuan Faskes</label>
                <select class="js-select2 form-control" id="select_faskes" name="faskes">
                    <option value="{{$faskes}}" selected="selected">{{$result->ppk_faskes}} | {{$result->faskes}}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tujuan Poli</label>
                <select class="js-select2 form-control" id="select_poli" name="poli">
                    <option value="{{$poli}}" selected="selected">{{$result->poli_rujuk}} | {{$result->nama_poli_rujukan}}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <input type="text" class="form-control" name="catatan" value="{{$result->catatan}}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>