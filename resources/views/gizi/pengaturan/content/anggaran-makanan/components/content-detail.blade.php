<div class="content">
    <div class="block p-10">
        <div class="block">
            <div class="block-header bordered">
                <h3 class="block-title">
                    <small>Nama</small>
                    <br>
                    {{$anggaran_makanan->nama}}
                </h3>
                <h3 class="block-title">
                    <small>Satuan</small>
                    <br>
                    {{$anggaran_makanan->satuan}}
                </h3>
                <div class="block-options">
                    <form method="POST"
                          action="{{url('gizi/pengaturan/anggaran-makanan/'.$anggaran_makanan->id.'/delete')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$anggaran_makanan->id}}">
                    </form>
                    <button type="submit" class="confirm-del btn btn-danger btn-square">
                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                    </button>
                    <button type="button" class="btn btn-warning btn-square" data-toggle="modal"
                            data-target="#modal-edit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                    </button>
                </div>
                <hr class="my-5">
            </div>
            <div class="block-content">
                <div class="block block-transparent">
                    <div class="row">
                        <div class="col-12">
                            <label>Jenis Makanan</label>
                            <h5>
                                @foreach(json_decode($anggaran_makanan->jenis_makanan_nama) as $value)
                                    <span class="badge badge-success">{{$value}}</span>
                                @endforeach
                            </h5>
                        </div>
                        <div class="col-12">
                            <label>Kelas</label>
                            <h5>
                                @foreach(json_decode($anggaran_makanan->kelas_nama) as $value)
                                    <span class="badge badge-success">{{$value}}</span>
                                @endforeach
                            </h5>
                        </div>
                        <div class="col-12">
                            <label>Bangsal</label>
                            <h5>
                                @foreach(json_decode($anggaran_makanan->bangsal_nama) as $value)
                                    <span class="badge badge-success">{{$value}}</span>
                                @endforeach
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <div class="block block-transparent">
                    <div class="row">
                        <div class="col">
                            <label>DIBUAT OLEH</label>
                            <h5>{{$anggaran_makanan->creator->name}}</h5>
                        </div>
                        <div class="col">
                            <label>TANGGAL DIBUAT</label>
                            <h5>{{ date('d F Y', strtotime($anggaran_makanan->created_at)) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>