<div class="modal fade" id="pengaturan-urikkes" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{url()->current()}}/setting-urikkes" method="POST">
                {{csrf_field()}}
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Terms &amp; Conditions</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="urikkes-div">
                            @forelse($hasil_urikkes as $key => $u)
                            <div class="form-group row">
                                <input type="text" class="form-control col-4 mr-10 ml-10" placeholder="Nama Tabel" name="tabel[$key]" value="{{$u['tabel']}}" >
                                <input type="text" class="form-control col-4 mr-10" placeholder="Nama Kolom" name="kolom[$key]" value="{{$u['kolom']}}">                            
                                <div class="col-2">                            
                                    <button type="button" class="btn btn-alt-danger h-100" onclick="removeUrikesItem(this);">
                                        <i class="fa fa-close"></i> Hapus
                                    </button>
                                </div>
                                @empty
                                <div class="form-group row">
                                    <input type="text" class="form-control col-4 mr-10 ml-10" placeholder="Nama Tabel" name="tabel[]">
                                    <input type="text" class="form-control col-4 mr-10" placeholder="Nama Kolom" name="kolom[]">
                                    <div class="col-2">                            
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            <div class="form-group row">
                                <div class="col-10"></div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-alt-primary"  onclick="addUrikkesItem();">
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-alt-success" >
                            <i class="fa fa-check"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>