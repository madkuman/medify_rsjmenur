<div class="block-content">
        <div class="row">
                <div class="col-md-12">
                    <h5>INFORMASI DASAR</h5>
                    <hr>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-uppercase">jenis rencana asuhan keperawatan</label>
                        <select class="form-control select2" name="jenis_id" >
                            @foreach($jenis as $item)
                            <option value="{{$item->id}}"  {{ $item->id == $item->id ? 'selected' : '' }}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
            
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-uppercase">Nomor Form DRM</label>
                    <input type="text" name="form_drm" class="form-control" value="{{$asuhan->form_drm}}">
                    </div>
            
                </div>
            </div>
</div>