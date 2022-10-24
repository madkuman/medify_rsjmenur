function addForm(){
    var totalLayanan = $(".layananBaru").length;
    var codeToAdd = `<div class="row form-group layananBaru" id="layanan_`+totalLayanan+`" data-index="`+totalLayanan+`">
                <div class="col-md-6">
                    <select class="form-control new-layanan js-select2" id="layanan`+totalLayanan+`" name="" style="width: 100%;" >
                            <option value="0" selected="">Pilih layanan tambahan</option>
                        ${layananOptions}        
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control js-select2 select-form-layanan" style="width: 100%;" name="formDetailBaru" data-id="Baru">
                        <option value="0" selected="">Pilih Form yang dibutuhkan</option>
                        <option value="papsmear">Pap Smear</option>
                        <option value="sitologi">Sitologi / FNA-B</option>
                        <option value="hispatologi">Hispatologi</option>
                        <option value="vriescoupe">Vries Coupe</option>
                        <option value="histopatologi">Histopatologi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="removeForm(`+totalLayanan+`)">
                        <i class="fa fa-times mr-5"></i>
                        Hapus
                    </button>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <p class="h6 my-0 mb-10">Jumlah Slide</p>              
                    <input type="text" placeholder="Masukkan Jumlah Slide disini" class="form-control new-slide">
                </div>
                <div class="col-sm-12 col-lg-4">
                    <p class="h6 my-0 mb-10">Lokasi</p>                                
                    <input type="text" class="form-control new-lokasi" placeholder="Masukkan Lokasi Disini">
                </div>
                <div class="col-sm-12 col-lg-4">
                    <p class="h6 my-0 mb-10">Kode Sediaan</p>
                    <input type="text" class="form-control new-kode-sediaan" placeholder="Masukkan Kode Pasien Disini">
                </div>
                <div class="col-md-12 mb-10 mt-10 form-layanan-baru">
    
                </div>
                <hr/>
            </div>`;
    $(".form-layanan").append(codeToAdd);
    let selectForm = $(`#layanan_${totalLayanan}`).find('.select-form-layanan');
    let formDiv = $(`#layanan_${totalLayanan}`).find('.form-layanan-baru');
    selectForm[0].name = `${selectForm[0].name}[${totalLayanan}]`;
    selectForm[0].dataset.id = `${selectForm[0].dataset.id}${totalLayanan}`;
    formDiv[0].id = `formLayananDivBaru${totalLayanan}`;
    Codebase.helpers(['select2']);
    $('.select-form-layanan').on("select2:select", function(e) { 
        let target = e.params.data.id;
        let formId = $(this).data('id');
        let formDiv = $(`#formLayananDiv${formId}`);
        let makroskopis, mikroskopis, kesimpulan;
        switch(target) {
            case 'papsmear':
                formDiv.html(formPapsmear);
                let formList = formDiv.find('.custom-control-input');
                let labelList = formDiv.find('.custom-control-label');
                formList.each(function(item, form){
                    let target = form.id;
                    form.id = `${target}_${formId}`;
                    form.name = `${form.name}[${formId}][]`;
                    labelList[item].setAttribute('for', `${target}_${formId}`);
                });
                break;
            case 'sitologi':
                formDiv.html(formSitologi);
                makroskopis = formDiv.find('.makroskopis');
                makroskopis[0].name = `makroskopis[${formId}]`;
                mikroskopis = formDiv.find('.mikroskopis');
                mikroskopis[0].name = `mikroskopis[${formId}]`;
                kesimpulan = formDiv.find('.kesimpulan');
                kesimpulan[0].name = `kesimpulan[${formId}]`;
                break;
            case 'hispatologi':
                formDiv.html(formHispatologi);
                makroskopis = formDiv.find('.makroskopis');
                makroskopis[0].name = `makroskopis[${formId}]`;
                mikroskopis = formDiv.find('.mikroskopis');
                mikroskopis[0].name = `mikroskopis[${formId}]`;
                kesimpulan = formDiv.find('.kesimpulan');
                kesimpulan[0].name = `kesimpulan[${formId}]`;             
                break;
            case 'vriescoupe':
                formDiv.html(formVriescoupe);             
                makroskopis = formDiv.find('.makroskopis');
                makroskopis[0].name = `makroskopis[${formId}]`;
                kesimpulan = formDiv.find('.kesimpulan');
                kesimpulan[0].name = `kesimpulan[${formId}]`;
                break;
            case 'histopatologi':
                formDiv.html(formHistopatologi);
                makroskopis = formDiv.find('.makroskopis');
                makroskopis[0].name = `makroskopis[${formId}]`;
                mikroskopis = formDiv.find('.mikroskopis');
                mikroskopis[0].name = `mikroskopis[${formId}]`;
                kesimpulan = formDiv.find('.kesimpulan');
                kesimpulan[0].name = `kesimpulan[${formId}]`;
                break;
        }
    });
}   
function removeForm(id) {
    $("#layanan_"+id).remove();
}