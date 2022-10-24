function addForm(){
    var totalLayanan = $(".layananBaru").length;
    var codeToAdd = `<div class="row form-group layananBaru" id="layanan_`+totalLayanan+`" data-index="`+totalLayanan+`">
                        <div class="col-lg-4">
                            <div class="col-md-12" style="margin-bottom: 6px;">
                                <label for="">Jumlah</label>
                            </div>
                            <div class="col-md-12 pb-10">
                                <select class="form-control new-layanan js-select2" id="layanan`+totalLayanan+`" style="width: 100%;" >
                                    <option value="0" selected="" >Pilih layanan tambahan</option>
                                    ${layananOptions}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-12" style="margin-bottom: 6px;">
                                <label for="">Jumlah</label>
                            </div>
                            <div class="col-md-12 pb-10">
                                <input type="number" class="form-control new-jumlah-periksa" value="1" min="1">                                        
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="col-md-12" style="margin-bottom: 6px;">
                                <label for="">Film Dipakai</label>
                            </div>
                            <div class="col-md-12 pb-10">
                                <input type="text" value="0" class="form-control new-film-dipakai" placeholder="Masukkan Jumlah Film yang Dipakai">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="col-md-12" style="margin-bottom: 6px;">
                                <label for="">Film Di-reject</label>
                            </div>
                            <div class="col-md-12 pb-10">
                                <input type="text" value="0" class="form-control new-film-direject" placeholder="Masukkan Jumlah Film yang Di-reject">
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <div class="col-md-12" style="margin-bottom: 6px;">
                                <label>Ukuran Film</label>
                            </div>
                            <div class="col-md-12 pb-10">
                                <select class="form-control new-ukuran-film" style="width: 100%;" >
                                    <option value="" selected="">Tanpa Ukuran</option>
                                    <option value="20x25cm">20x25cm</option>
                                    <option value="28x35cm">28x35cm</option>
                                    <option value="35x43cm">35x43cm</option>
                                    <option value="35x35cm">35x35cm</option>
                                </select>
                            </div>
                            <div class="col-md-12 pb-10">
                                <button type="button" class="btn btn-danger btn-rounded btn-noborder" onclick="removeForm(`+totalLayanan+`)"
                                style="width: 100%;">
                                    <i class="fa fa-times mr-5"></i>
                                    Hapus
                                </button>
                            </div>
                        </div>
            </div>`;
    $(".form-layanan").append(codeToAdd);
    Codebase.helpers(['select2']);
}   
function removeForm(id) {
    $("#layanan_"+id).remove();
}