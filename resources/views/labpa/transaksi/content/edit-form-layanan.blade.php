<div class="block block-mode-hidden">
	
<?php 
	$result = json_decode($detail->result);
?>
@if($result->jenis_form == 'papsmear')
	<div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form Pap Smear</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
        </div>
    </div>        <?php 
            $resultClass = (array)$result->sitologi_class;
            $resultGeneral = (array)$result->sitologi_general;
            $resultReactive = (array)$result->sitologi_reactive;
            $resultSpecimen = (array)$result->sitologi_specimen;
            $resultInfection = (array)$result->sitologi_infection;
         ?>
<div class="block-content">
    <p class="h5 my-0 mb-10">CLASS</p>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearClass[{{$detail->id}}]" id="sel ganas negatif" value="sel ganas negatif" type="checkbox" @if(in_array('sel ganas negatif', $resultClass)) 
        checked @endif>
        <label class="custom-control-label" for="sel ganas negatif">I Sel ganas negatif</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearClass[{{$detail->id}}]" id="sel abnormal" value="sel abnormal" type="checkbox" @if(in_array('sel abnormal', $resultClass)) 
        checked @endif>
        <label class="custom-control-label" for="sel abnormal">II Sel abnormal, sel ganas negatif</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearClass[{{$detail->id}}]" id="sel atipik" value="sel atipik" type="checkbox" @if(in_array('sel atipik', $resultClass)) 
        checked @endif>
        <label class="custom-control-label" for="sel atipik">III Sel atipik, meragukan keganasan</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearClass[{{$detail->id}}]" id="sel mencurigakan" value="sel mencurigakan" type="checkbox" @if(in_array('sel mencurigakan', $resultClass)) 
        checked @endif>
        <label class="custom-control-label" for="sel mencurigakan">IV Sel mencurigakan keganasan</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearClass[{{$detail->id}}]" id="sel ganas positif" value="sel ganas positif" type="checkbox" @if(in_array('sel ganas positif', $resultClass)) 
        checked @endif>
        <label class="custom-control-label" for="sel ganas positif">V Sel ganas positif</label>
    </div>
</div>
<div class="block-content">
    <p class="h5 my-0 mb-10">INFECTION</p>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Trichomonas" value="Trichomonas" type="checkbox" @if(in_array('Trichomonas', $resultInfection)) 
        checked @endif>
        <label class="custom-control-label" for="Trichomonas">Trichomonas vaginalis</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Candida" value="Candida" type="checkbox" @if(in_array('Candida', $resultInfection)) 
        checked @endif>
        <label class="custom-control-label" for="Candida">Candida/ Fungal/ Jamur</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Haemophylus" value="Haemophylus" type="checkbox" @if(in_array('Haemophylus', $resultInfection)) 
        checked @endif>
        <label class="custom-control-label" for="Haemophylus">Haemophylus vaginalis</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Coco" value="Coco" type="checkbox" @if(in_array('Coco', $resultInfection)) 
        checked @endif>
        <label class="custom-control-label" for="Coco">Coco bacilus</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Herpes" value="Herpes" type="checkbox" @if(in_array('Herpes', $resultInfection)) 
        checked @endif>
        <label class="custom-control-label" for="Herpes">Herpes simplex</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Human', $resultInfection)) 
        checked @endif class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Human" value="Human" type="checkbox">
        <label class="custom-control-label" for="Human">Human Papiloma Virus (HPV)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Lain', $resultInfection)) 
        checked @endif class="custom-control-input" name="papsmearInfection[{{$detail->id}}]" id="Lain" value="Lain" type="checkbox">
        <label class="custom-control-label" for="Lain">Lain-lain</label>
    </div>
</div>
<div class="block-content">
    <p class="h5 my-0 mb-10">BETHESDA SYSTEM</p>
    <p class="h6 my-0 mb-10">SPECIMEN ADEQUACY</p>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Satisfactory', $resultSpecimen)) 
        checked @endif class="custom-control-input" name="papsmearSpecimen[{{$detail->id}}]" id="Satisfactory" value="Satisfactory" type="checkbox">
        <label class="custom-control-label" for="Satisfactory">Satisfactory</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Unsatisfactory', $resultSpecimen)) 
        checked @endif class="custom-control-input" name="papsmearSpecimen[{{$detail->id}}]" id="Unsatisfactory" value="Unsatisfactory" type="checkbox">
        <label class="custom-control-label" for="Unsatisfactory">Unsatisfactory</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input @if(in_array('Noendocervical', $resultSpecimen)) 
        checked @endif class="custom-control-input" name="papsmearSpecimen[{{$detail->id}}]" id="Noendocervical" value="Noendocervical" type="checkbox">
        <label class="custom-control-label" for="Noendocervical">No endocervical epithel</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input @if(in_array('Epithel', $resultSpecimen)) 
        checked @endif class="custom-control-input" name="papsmearSpecimen[{{$detail->id}}]" id="Epithel" value="Epithel" type="checkbox">
        <label class="custom-control-label" for="Epithel">Epithel squamous < 10% </label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input @if(in_array('Manyblood', $resultSpecimen)) 
        checked @endif class="custom-control-input" name="papsmearSpecimen[{{$detail->id}}]" id="Manyblood" value="Manyblood" type="checkbox">
        <label class="custom-control-label" for="Manyblood">Many blood / inflamatory cells</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input @if(in_array('Poorly', $resultSpecimen)) 
        checked @endif class="custom-control-input" name="papsmearSpecimen[{{$detail->id}}]" id="Poorly" value="Poorly" type="checkbox">
        <label class="custom-control-label" for="Poorly">Poorly fixation</label>
    </div>
</div>
<div class="block-content">
    <p class="h6 my-0 mb-10">REACTIVE CELLULAR CHANGES</p>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Inflammation', $resultReactive)) 
        checked @endif class="custom-control-input" name="papsmearReactive[{{$detail->id}}]" id="Inflammation" value="Inflammation" type="checkbox">
        <label class="custom-control-label" for="Inflammation">Inflammation</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Radiation', $resultReactive)) 
        checked @endif class="custom-control-input" name="papsmearReactive[{{$detail->id}}]" id="Radiation" value="Radiation" type="checkbox">
        <label class="custom-control-label" for="Radiation">Radiation</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('IUD', $resultReactive)) 
        checked @endif class="custom-control-input" name="papsmearReactive[{{$detail->id}}]" id="IUD" value="IUD" type="checkbox">
        <label class="custom-control-label" for="IUD">IUD</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Athropy', $resultReactive)) 
        checked @endif class="custom-control-input" name="papsmearReactive[{{$detail->id}}]" id="Atrophy" value="Atrophy" type="checkbox">
        <label class="custom-control-label" for="Atrophy">Atrophy with inflammation</label>
    </div>
</div>
<div class="block-content">
    <p class="h6 my-0 mb-10">GENERAL CATEGORIZATION</p>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Negative', $resultGeneral)) 
        checked @endif class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" id="Negative" value="Negative" type="checkbox">
        <label class="custom-control-label" for="Negative">Negative for intraepithelial lesion</label>
    </div>
    <div class="custom-control custom-checkbox mb-5">
        <input @if(in_array('Epithelial', $resultGeneral)) 
        checked @endif class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" id="Epithelial" value="Epithelial" type="checkbox">
        <label class="custom-control-label" for="Epithelial">Epithelial cell abnormalities</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input class="custom-control-input" @if(in_array('Squamous', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Squamous" value="Squamous" type="checkbox">
        <label class="custom-control-label" for="Squamous">Squamous Cell</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Atypical', $resultGeneral)) 
        checked @endif id="Atypical" value="Atypical" type="checkbox">
        <label class="custom-control-label" for="Atypical">Atypical Squamous Cell (ASC)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" @if(in_array('ofundetermined', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="ofundetermined" value="ofundetermined" type="checkbox">
        <label class="custom-control-label" for="ofundetermined">of undetermined significants (ASC-US)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input @if(in_array('cannot', $resultGeneral)) 
        checked @endif class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" id="cannot" value="cannot" type="checkbox">
        <label class="custom-control-label" for="cannot">cannot exclude HSIL (ASC-H)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input @if(in_array('Squamousintra', $resultGeneral)) 
        checked @endif class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" id="Squamousintra" value="Squamousintra" type="checkbox">
        <label class="custom-control-label" for="Squamousintra">Squamous intraepithelial lesion (SIL)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" @if(in_array('Low', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Low" value="Low" type="checkbox">
        <label class="custom-control-label" for="Low">Low grade squamous intraepithelial lesion (LSIL)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('High', $resultGeneral)) 
        checked @endif id="High" value="High" type="checkbox">
        <label class="custom-control-label" for="High">High grade squamous intraepithelial lesion (HSIL)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input class="custom-control-input" @if(in_array('Squamouscarcinoma', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Squamouscarcinoma" value="Squamouscarcinoma" type="checkbox">
        <label class="custom-control-label" for="Squamouscarcinoma">Squamous cell carcinoma</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" id="Glandular" @if(in_array('Glandular', $resultGeneral)) 
        checked @endif value="Glandular" type="checkbox">
        <label class="custom-control-label" for="Glandular">Glandular cell</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Atypical1', $resultGeneral)) 
        checked @endif id="Atypical1" value="Atypical1" type="checkbox">
        <label class="custom-control-label" for="Atypical1">Atypical</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Endocervical', $resultGeneral)) 
        checked @endif id="Endocervical" value="Endocervical" type="checkbox">
        <label class="custom-control-label" for="Endocervical">Endocervical cells (NOS or specify in comments)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Endometrial', $resultGeneral)) 
        checked @endif id="Endometrial" value="Endometrial" type="checkbox">
        <label class="custom-control-label" for="Endometrial">Endometrial cells (NOS or specify in comments)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Glandularcells', $resultGeneral)) 
        checked @endif id="Glandularcells" value="Glandularcells" type="checkbox">
        <label class="custom-control-label" for="Glandularcells">Glandular cells (NOS or specify in comments)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Atypical2', $resultGeneral)) 
        checked @endif id="Atypical2" value="Atypical2" type="checkbox">
        <label class="custom-control-label" for="Atypical2">Atypical</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" @if(in_array('Endocervicalfavor', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Endocervicalfavor" value="Endocervicalfavor" type="checkbox">
        <label class="custom-control-label" for="Endocervicalfavor">Endocervical cells favor neoplastic</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" @if(in_array('Glandularcellsfavor', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Glandularcellsfavor" value="Glandularcellsfavor" type="checkbox">
        <label class="custom-control-label" for="Glandularcellsfavor">Glandular cells favor neoplastic</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input class="custom-control-input" @if(in_array('Endocervicaladenocarcinoma', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Endocervicaladenocarcinoma" value="Endocervicaladenocarcinoma" type="checkbox">
        <label class="custom-control-label" for="Endocervicaladenocarcinoma">Endocervical adenocarcinoma in situ</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-60">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Adenocarcinoma', $resultGeneral)) 
        checked @endif id="Adenocarcinoma" value="Adenocarcinoma" type="checkbox">
        <label class="custom-control-label" for="Adenocarcinoma">Adenocarcinoma</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Endocervical1', $resultGeneral)) 
        checked @endif id="Endocervical1" value="Endocervical1" type="checkbox">
        <label class="custom-control-label" for="Endocervical1">Endocervical</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" @if(in_array('Endometrial1', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Endometrial1" value="Endometrial1" type="checkbox">
        <label class="custom-control-label" for="Endometrial1">Endometrial</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" @if(in_array('Extrauterine', $resultGeneral)) 
        checked @endif name="papsmearGeneral[{{$detail->id}}]" id="Extrauterine" value="Extrauterine" type="checkbox">
        <label class="custom-control-label" for="Extrauterine">Extrauterine</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-90">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Nototherwise', $resultGeneral)) 
        checked @endif id="Nototherwise" value="Nototherwise" type="checkbox">
        <label class="custom-control-label" for="Nototherwise">Not Otherwise Specified (NOS)</label>
    </div>
    <div class="custom-control custom-checkbox mb-5 ml-30">
        <input class="custom-control-input" name="papsmearGeneral[{{$detail->id}}]" @if(in_array('Othermalignant', $resultGeneral)) 
        checked @endif id="Othermalignant" value="Othermalignant" type="checkbox">
        <label class="custom-control-label" for="Othermalignant">Other Malignant Neoplasms</label>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan tinymce" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan[{{$detail->id}}]">
                    {{$result->kesimpulan}}
                </textarea>
            </div>
        </div>
    </div>
</div>
@else
<div class="block-header block-header-default">
        <p class="h5 my-0 mb-10">Form {{$result->jenis_form}}</p>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Makroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control makroskopis tinymce" rows="4" cols="50" placeholder="Tambahkan Makroskopis Di Sini" name="makroskopis[{{$detail->id}}]">{{$result->makroskopis}}</textarea>
            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Mikroskopis</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control mikroskopis tinymce" rows="4" cols="50" placeholder="Tambahkan Mikroskopis Di Sini" name="mikroskopis[{{$detail->id}}]">{{$result->mikroskopis}}</textarea>            </div>
        </div>
    </div>
    <div class="block-content">
        <p class="h6 my-0 mb-10">Kesimpulan</p>
        <div class="form-group row">
            <div class="col-12">
                <textarea class="form-control kesimpulan tinymce" rows="4" cols="50" placeholder="Tambahkan Kesimpulan Di Sini" name="kesimpulan[{{$detail->id}}]">{{$result->kesimpulan}}</textarea>            </div>
        </div>
    </div>
@endif

</div>