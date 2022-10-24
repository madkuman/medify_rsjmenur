<div class="modal fade" id="modal-legalitas-atasan" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url()->current()}}/legalitas-atasan" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header">
                        <h3 class="block-title" id="title-modal">Legalitas Atasan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content" style="padding-left: 25px; padding-right: 25px;">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Legalitas Atasan</label>
                                    <div class="custom-file">
                                        <input class="custom-file-input" type="file" id="usulan-file"
                                               name="usulan_file[]"
                                               multiple="" accept=".pdf"/>
                                        <label class="custom-file-label">Pilih file..</label>
                                    </div>
                                    <small>*Dapat upload banyak gambar</small>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                @foreach($file_pendukung as $index => $item)
                                    <div class="col-sm-2 file" id="block-usulan-file-{{$index}}">
                                        <i class="far fa-file-alt"></i>
                                        <a href="javascript:void(0)"
                                           onclick="popupwindow('{{url('').'/'.$item->path}}')">{{$item->title.'.'.$item->type}}</a>
                                        <input type="hidden" name="usulan_file_exclude[{{$index}}]"
                                               id="input-usulan-file-{{$index}}" value="">
                                        <button type="button" class="btn btn-alt-danger"
                                                onclick="deleteUsulanFile({{$index}},{{$item->id}})">
                                            Hapus
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-submit btn-click-animate" type="submit" id="btnSubmit">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>