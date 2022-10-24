const formPapsmear = `<div class="block block-mode-hidden">
    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Pap Smear</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
        </div>
    </div>
    <div class="block-content">
        <p class="h5 my-0 mb-10">CLASS</p>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearClass" id="sel ganas negatif" value="sel ganas negatif" type="checkbox">
            <label class="custom-control-label" for="sel ganas negatif">I Sel ganas negatif</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearClass" id="sel abnormal" value="sel abnormal" type="checkbox">
            <label class="custom-control-label" for="sel abnormal">II Sel abnormal, sel ganas negatif</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearClass" id="sel atipik" value="sel atipik" type="checkbox">
            <label class="custom-control-label" for="sel atipik">III Sel atipik, meragukan keganasan</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearClass" id="sel mencurigakan" value="sel mencurigakan" type="checkbox">
            <label class="custom-control-label" for="sel mencurigakan">IV Sel mencurigakan keganasan</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearClass" id="sel ganas positif" value="sel ganas positif" type="checkbox">
            <label class="custom-control-label" for="sel ganas positif">V Sel ganas positif</label>
        </div>
    </div>
    <div class="block-content">
        <p class="h5 my-0 mb-10">INFECTION</p>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Trichomonas" value="Trichomonas" type="checkbox">
            <label class="custom-control-label" for="Trichomonas">Trichomonas vaginalis</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Candida" value="Candida" type="checkbox">
            <label class="custom-control-label" for="Candida">Candida/ Fungal/ Jamur</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Haemophylus" value="Haemophylus" type="checkbox">
            <label class="custom-control-label" for="Haemophylus">Haemophylus vaginalis</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Coco" value="Coco" type="checkbox">
            <label class="custom-control-label" for="Coco">Coco bacilus</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Herpes" value="Herpes" type="checkbox">
            <label class="custom-control-label" for="Herpes">Herpes simplex</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Human" value="Human" type="checkbox">
            <label class="custom-control-label" for="Human">Human Papiloma Virus (HPV)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearInfection" id="Lain" value="Lain" type="checkbox">
            <label class="custom-control-label" for="Lain">Lain-lain</label>
        </div>
    </div>
    <div class="block-content">
        <p class="h5 my-0 mb-10">BETHESDA SYSTEM</p>
        <p class="h6 my-0 mb-10">SPECIMEN ADEQUACY</p>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearSpecimen" id="Satisfactory" value="Satisfactory" type="checkbox">
            <label class="custom-control-label" for="Satisfactory">Satisfactory</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearSpecimen" id="Unsatisfactory" value="Unsatisfactory" type="checkbox">
            <label class="custom-control-label" for="Unsatisfactory">Unsatisfactory</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearSpecimen" id="Noendocervical" value="Noendocervical" type="checkbox">
            <label class="custom-control-label" for="Noendocervical">No endocervical epithel</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearSpecimen" id="Epithel" value="Epithel" type="checkbox">
            <label class="custom-control-label" for="Epithel">Epithel squamous
                < 10% </label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearSpecimen" id="Manyblood" value="Manyblood" type="checkbox">
            <label class="custom-control-label" for="Manyblood">Many blood / inflamatory cells</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearSpecimen" id="Poorly" value="Poorly" type="checkbox">
            <label class="custom-control-label" for="Poorly">Poorly fixation</label>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">REACTIVE CELLULAR CHANGES</p>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearReactive" id="Inflammation" value="Inflammation" type="checkbox">
            <label class="custom-control-label" for="Inflammation">Inflammation</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearReactive" id="Radiation" value="Radiation" type="checkbox">
            <label class="custom-control-label" for="Radiation">Radiation</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearReactive" id="IUD" value="IUD" type="checkbox">
            <label class="custom-control-label" for="IUD">IUD</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearReactive" id="Atrophy" value="Atrophy" type="checkbox">
            <label class="custom-control-label" for="Atrophy">Atrophy with inflammation</label>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">GENERAL CATEGORIZATION</p>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearGeneral" id="Negative" value="Negative" type="checkbox">
            <label class="custom-control-label" for="Negative">Negative for intraepithelial lesion</label>
        </div>
        <div class="custom-control custom-checkbox mb-5">
            <input class="custom-control-input" name="papsmearGeneral" id="Epithelial" value="Epithelial" type="checkbox">
            <label class="custom-control-label" for="Epithelial">Epithelial cell abnormalities</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearGeneral" id="Squamous" value="Squamous" type="checkbox">
            <label class="custom-control-label" for="Squamous">Squamous Cell</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Atypical" value="Atypical" type="checkbox">
            <label class="custom-control-label" for="Atypical">Atypical Squamous Cell (ASC)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="ofundetermined" value="ofundetermined" type="checkbox">
            <label class="custom-control-label" for="ofundetermined">of undetermined significants (ASC-US)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="cannot" value="cannot" type="checkbox">
            <label class="custom-control-label" for="cannot">cannot exclude HSIL (ASC-H)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Squamousintra" value="Squamousintra" type="checkbox">
            <label class="custom-control-label" for="Squamousintra">Squamous intraepithelial lesion (SIL)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Low" value="Low" type="checkbox">
            <label class="custom-control-label" for="Low">Low grade squamous intraepithelial lesion (LSIL)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="High" value="High" type="checkbox">
            <label class="custom-control-label" for="High">High grade squamous intraepithelial lesion (HSIL)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Squamouscarcinoma" value="Squamouscarcinoma" type="checkbox">
            <label class="custom-control-label" for="Squamouscarcinoma">Squamous cell carcinoma</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearGeneral" id="Glandular" value="Glandular" type="checkbox">
            <label class="custom-control-label" for="Glandular">Glandular cell</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Atypical1" value="Atypical1" type="checkbox">
            <label class="custom-control-label" for="Atypical1">Atypical</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Endocervical" value="Endocervical" type="checkbox">
            <label class="custom-control-label" for="Endocervical">Endocervical cells (NOS or specify in comments)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Endometrial" value="Endometrial" type="checkbox">
            <label class="custom-control-label" for="Endometrial">Endometrial cells (NOS or specify in comments)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Glandularcells" value="Glandularcells" type="checkbox">
            <label class="custom-control-label" for="Glandularcells">Glandular cells (NOS or specify in comments)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Atypical2" value="Atypical2" type="checkbox">
            <label class="custom-control-label" for="Atypical2">Atypical</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Endocervicalfavor" value="Endocervicalfavor" type="checkbox">
            <label class="custom-control-label" for="Endocervicalfavor">Endocervical cells favor neoplastic</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Glandularcellsfavor" value="Glandularcellsfavor" type="checkbox">
            <label class="custom-control-label" for="Glandularcellsfavor">Glandular cells favor neoplastic</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Endocervicaladenocarcinoma" value="Endocervicaladenocarcinoma" type="checkbox">
            <label class="custom-control-label" for="Endocervicaladenocarcinoma">Endocervical adenocarcinoma in situ</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-60">
            <input class="custom-control-input" name="papsmearGeneral" id="Adenocarcinoma" value="Adenocarcinoma" type="checkbox">
            <label class="custom-control-label" for="Adenocarcinoma">Adenocarcinoma</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Endocervical1" value="Endocervical1" type="checkbox">
            <label class="custom-control-label" for="Endocervical1">Endocervical</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Endometrial1" value="Endometrial1" type="checkbox">
            <label class="custom-control-label" for="Endometrial1">Endometrial</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Extrauterine" value="Extrauterine" type="checkbox">
            <label class="custom-control-label" for="Extrauterine">Extrauterine</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-90">
            <input class="custom-control-input" name="papsmearGeneral" id="Nototherwise" value="Nototherwise" type="checkbox">
            <label class="custom-control-label" for="Nototherwise">Not Otherwise Specified (NOS)</label>
        </div>
        <div class="custom-control custom-checkbox mb-5 ml-30">
            <input class="custom-control-input" name="papsmearGeneral" id="Othermalignant" value="Othermalignant" type="checkbox">
            <label class="custom-control-label" for="Othermalignant">Other Malignant Neoplasms</label>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan"></textarea>
            </div>
        </div>
    </div>
</div>`;
const formSitologi = `<div class="block block-mode-hidden">
    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Sitologi/FNA-B</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control makroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Makroskopis Di Sini" name="makroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Mikroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control mikroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Mikroskopis Di Sini" name="mikroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan"></textarea>
            </div>
        </div>
    </div>
</div>`;
const formAspirasi = `<div class="block block-mode-hidden">
    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Sitologi/Aspirasi</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control makroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Makroskopis Di Sini" name="makroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Mikroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control mikroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Mikroskopis Di Sini" name="mikroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan"></textarea>
            </div>
        </div>
    </div>
</div>`;
const formHispatologi = `<div class="block block-mode-hidden">
    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Hispatologi</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle">
                <i class="si si-arrow-down"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control makroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Makroskopis Di Sini" name="makroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Mikroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control mikroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Mikroskopis Di Sini" name="mikroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan"></textarea>
            </div>
        </div>
    </div>
</div>`;
const formVriescoupe = `<div class="block block-mode-hidden">
    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Vries Coupe</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle">
                <i class="si si-arrow-down"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control makroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Makroskopis Di Sini" name="makroskopis"></textarea>
            </div>
        </div>
    </div>
        <div class="block-content">
        <p class="h6 my-0 mb-10">Mikroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control mikroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Mikroskopis Di Sini" name="mikroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan"></textarea>
            </div>
        </div>
    </div>
</div>`;
const formHistopatologi = `<div class="block block-mode-hidden">
    <div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Histopatologi</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle">
                <i class="si si-arrow-down"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control makroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Makroskopis Di Sini" name="makroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Mikroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control mikroskopis" rows="4" cols="50" placeholder="Tambahkan Hasil Pemeriksaan Mikroskopis Di Sini" name="mikroskopis"></textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan"></textarea>
            </div>
        </div>
    </div>
</div>`;

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
            kesimpulan = formDiv.find('.kesimpulan');
            kesimpulan[0].name = `kesimpulan[${formId}]`;
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
        case 'aspirasi':
            formDiv.html(formAspirasi);
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
            mikroskopis = formDiv.find('.mikroskopis');
            mikroskopis[0].name = `mikroskopis[${formId}]`;
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
        default:
            formDiv.html("");
    }
});