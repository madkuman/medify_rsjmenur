<div class="content pt-0">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="font-w400">Pengaturan Tim Penindak Operasi</h3>
            @if($tim->isEmpty())
            <form id="mytim" method="POST" action="{{url('/kamaroperasi/pelaksanaan/rencana/tim')}}">
                {{csrf_field()}}
                <input type="hidden" name="operasi_id" value="{{$transaksi->id}}">
                <label class="col-12">Pilih Anggota<star class="star">*</star></label>
                <div id="tim-operasi">
                    <div class="form-group row tims">
                        <div class="col-lg-6">
                            <select class="js-select2-item-tim" name="namatim[]" style="width: 100%">
                                <option></option>
                                @foreach($user as $users)
                                    <option value="{{$users->id}}">{{$users->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="js-select2-tim-role" name="peran[]" style="width: 100%">
                                <option></option>
                                @foreach($role as $roles)
                                    <option value="{{$roles->id}}">{{$roles->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="submit">
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
            </form>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-2 offset-md-4">
                    <button type="button" class="btn btn-primary btn-wd" id="btnTimAdd">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Anggota Tim
                    </button>
                </div>
            </div>
            @else
            @foreach($tim as $tims) 
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="font-w400"><small>Nama Anggota Tim</small><br> {{$tims->detail->name}}</h5>
                </div>
                <div class="col-lg-3">
                    <h5 class="font-w400"><small>Peran</small><br> {{ $tims->role->nama}}</h5>
                </div>
                <div class="col-lg-2">
                    <h5 class="font-w400"><small>Aksi</small><br> 
                        <button type="button" class="btn btn-danger btn-fill hapus-tim" data-tim = "{{$tims->id}}">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                        </button>
                    </h5>
                </div>
            </div>
            @endforeach
            <form id="mytim" method="POST" action="{{url('/kamaroperasi/pelaksanaan/rencana/tim')}}">
                {{csrf_field()}}
                <input type="hidden" name="operasi_id" value="{{$transaksi->id}}">
                <div id="tim-operasi"></div>
            </form>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-2 offset-md-4">
                    <button type="button" class="btn btn-primary btn-wd" id="btnNewTimAdd">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Anggota Tim
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>