<div class="modal fade" id="uploadPenunjang" role="dialog" aria-labelledby="modal-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="uploadForm" method="POST" action="{{url()->current()}}/upload" enctype="multipart/form-data" >
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header ">
                    <h3 class="block-title">Upload Penunjang</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content row">
                    {{csrf_field()}}
                    <input type="hidden" name="kasus_id" value="{{$kasus->id}}">
                    <div class="form-group text-center col-md-12 input-penunjang" id="penunjangGambar">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="avatar" name="gambar" required="" />
                                <label for="avatar"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('assets/img/placeholder.jpg');">
                                </div>
                                <video width="180" height="180" controls style="display: none;" id="videoPreview">
                                  <source src="" id="videoSource">
                                    Your browser does not support HTML5 video.
                                </video>
                            </div>
                        </div>
                        <small class="text-danger" id="errorEmptyGambar" style="display: none">File Tidak Valid</small>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Jenis</label>
                        <select class="form-control requireForm" id="tipeLayanan" name="tipe_penunjang" style="width: 100%;" data-placeholder="Choose one.." onchange="changeFileType(this)">
                            <option value="media">Gambar / Video</option>
                            <option value="pdf">PDF</option>
                            <option value="link">Link / URL</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 input-penunjang" style="display: none;" id="penunjangLink">
                        <label>Link / URL</label>
                        <input type="text" id="linkPenunjang" class="form-control form-control-lg" autocomplete="off" name="link" placeholder="Isi Link yang dituju disini..." >
                    </div>
                    <div class="form-group col-md-12 input-penunjang" id="penunjangPDF" style="display: none;">
                        <label for="">Upload PDF</label>
                        <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Judul</label>
                        <input type="text" id="judulPenunjang" class="form-control form-control-lg" autocomplete="off" required="" name="judul" placeholder="Isi judul penunjang">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Caption</label>
                        <textarea id="captionPenunjang" class="form-control form-control-lg"  name="caption"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-alt-primary" id="buatPenunjangSubmit">
                        Simpan
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>