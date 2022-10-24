<script type="text/javascript">    
//VITAL SIGN
function vitalDeleteModal(id)
{
    $('#vitalDeleteModal #vital-id').val(id)
    $('#vitalDeleteModal').modal('show');
}

function vitalEditModal(id)
{
    $('#loading-top').fadeIn();
    $.ajax({
        url: API_URL + '/kasus/{{$kasus->nomor_kasus}}/datamedis/vital/'+id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#modal-edit-vital #vital_id').val(data.id)
            $('#modal-edit-vital #edit-sistol').val(data.sistol)
            $('#modal-edit-vital #edit-diastol').val(data.diastol)
            $('#modal-edit-vital #edit-nadi').val(data.nadi)
            $('#modal-edit-vital #edit-pernafasan').val(data.pernapasan)
            $('#modal-edit-vital #edit-temp').val(data.temperatur)
            $('#modal-edit-vital #edit-maternal').val(data.maternal)
            $('#modal-edit-vital #edit-avpu').val(data.avpu)
            $('#modal-edit-vital #edit-o2').val(data.o2)
            $('#modal-edit-vital #skala_nyeri').val(data.skala_nyeri)
            $('#modal-edit-vital #edit-spo2').val(data.spo2)
            $('#modal-edit-vital #penilaian_nyeri').val(data.penilaian_nyeri)
            $('#modal-edit-vital #provokatif').val(data.provokatif)
            $('#modal-edit-vital #quality').val(data.quality)
            $('#modal-edit-vital #region').val(data.region)
            $('#modal-edit-vital #scala').val(data.scala)
            $('#modal-edit-vital #time').val(data.time)
            $('#modal-edit-vital #nyeri_hilang').val(data.nyeri_hilang)
            $('#modal-edit-vital #porsi_makan').val(data.porsi_makan)
            $('#modal-edit-vital #gcs').val(data.gcs)
            $('#modal-edit-vital #cairan_infus').val(data.cairan_infus)
            $('#modal-edit-vital #cairan_per_os').val(data.cairan_per_os)
            $('#modal-edit-vital #cairan_lain').val(data.cairan_lain)
            $('#modal-edit-vital #produksi_urine').val(data.produksi_urine)
            $('#modal-edit-vital #rencana_tindakan').val(data.rencana_tindakan)
            $('#modal-edit-vital #gula_darah_sewaktu').val(data.gula_darah_sewaktu)
            $('#modal-edit-vital #berat_badan').val(data.berat_badan)
            $('#modal-edit-vital').modal('show');
            $('#loading-top').hide();
            hitungAsesmen('edit');
        },
        error: function() {
            alert('error');
        },
    });
}

function hitungAsesmen(type) {
    var param = new Object();
    param.type = type;
    param.pernafasan = $('#'+type+'-pernafasan').val();
    param.sistol = $('#'+type+'-sistol').val();
    param.diastol = $('#'+type+'-diastol').val();
    param.nadi = $('#'+type+'-nadi').val();
    param.temp = $('#'+type+'-temp').val();
    param.spo2 = $('#'+type+'-spo2').val();
    param.avpu = $('#'+type+'-avpu').val();
    param.o2 = $('#'+type+'-o2').val();


    @if($kasus->identitas->age_year > 13)
        hitungMews(param);
        @if($kasus->identitas->jenis_kelamin == 'P')
            param.maternal = $('#'+type+'-maternal').val();
            hitungImews(param);
        @endif
    @endif
}

function hitungImews(param) {
    var imews_obj = new Object();
    imews_obj.normal = [];
    imews_obj.yellow = [];
    imews_obj.pink = [];
    if(param.pernafasan == ""
        || param.sistol == ""
        || param.diastol == ""
        || param.temp == ""
        || param.spo2 == ""
        || param.maternal == ""){
        return;
    }else{
        if(param.avpu == "Alert"){
            imews_obj.normal.push("avpu");
        }else {
            imews_obj.pink.push("avpu");
        }

        if(param.pernafasan <= 10 || param.pernafasan > 24){
            imews_obj.pink.push("pernafasan");
        }else if(param.pernafasan <= 19){
            imews_obj.normal.push("pernafasan");
        }else{
            imews_obj.yellow.push("pernafasan");
        }

        if(param.maternal < 50 || param.maternal >= 120){
            imews_obj.pink.push("maternal");
        }else if(param.maternal < 60 || param.maternal >=100){
            imews_obj.yellow.push("maternal");
        }else{
            imews_obj.normal.push("maternal");
        }

        if(param.sistol < 90 || param.sistol >= 160){
            imews_obj.pink.push("sistol");
        }else if(param.sistol < 100 || param.sistol >= 140){
            imews_obj.yellow.push("sistol");
        }else{
            imews_obj.normal.push("sistol");
        }

        if(param.diastol < 40 || param.diastol >= 110){
            imews_obj.pink.push("diastol");
        }else if(param.diastol < 50 || param.diastol >= 90){
            imews_obj.yellow.push("diastol");
        }else{
            imews_obj.normal.push("diastol");
        }


        if(param.temp <= 35 || param.temp >= 38){
            imews_obj.pink.push("temp");
        }else if(param.temp < 36 || param.temp >= 37.5){
            imews_obj.yellow.push("temp");
        }else{
            imews_obj.normal.push("temp");
        }

        if(param.spo2 <= 95){
            imews_obj.pink.push("spo2");
        }else{
            imews_obj.normal.push("spo2");
        }
        var imews_string = "";
        if(imews_obj.normal.length == 7)
            imews_string = "Normal";
        else
            imews_string = `${imews_obj.yellow.length} Yellow, ${imews_obj.pink.length} Pink`;
        $('#'+param.type+'-imews').val(imews_string);

        for(var i = 0; i < imews_obj.yellow.length; i++) {
             $('#'+param.type+'-detail-imews-'+imews_obj.yellow[i]).removeClass('badge badge-warning');
            $('#'+param.type+'-detail-imews-'+imews_obj.yellow[i]).addClass('badge badge-warning');
        }

        for(var i = 0; i < imews_obj.pink.length; i++) {
             $('#'+param.type+'-detail-imews-'+imews_obj.pink[i]).removeClass('badge badge-danger');
            $('#'+param.type+'-detail-imews-'+imews_obj.pink[i]).addClass('badge badge-danger');
        }

        for(var i = 0; i < imews_obj.normal.length; i++) {
            $('#'+param.type+'-detail-imews-'+imews_obj.normal[i]).removeClass('badge badge-warning badge-danger');
        }
    }
}

function hitungMews(param) {   
    var mews_score = 0;

    if(param.pernafasan == ""
        || param.sistol == ""
        || param.nadi == ""
        || param.temp == ""
        || param.spo2 == ""){
        return;
    }else{
        if(param.o2 == '' || param.o2 == 0 || param.o2 == null || param.o2 == "-" || param.o2 == "spontan"){
            mews_score+=0;
        }else {
            mews_score+=2;
        }

        if(param.avpu == "Alert"){
            mews_score+=0;
        }else {
            mews_score+=3;
        }

        if(param.pernafasan <= 8 || param.pernafasan > 24){
            mews_score+=3;
        }else if(param.pernafasan <= 11){
            mews_score+=1;
        }else if(param.pernafasan <= 20){
            mews_score+=0;
        }else{
            mews_score+=2;
        }

        if(param.nadi <= 40 || param.nadi > 130){
            mews_score+=3;
        }else if(param.nadi > 110){
            mews_score+=2;
        }else if(param.nadi <= 50 || param.nadi >90){
            mews_score+=1;
        }else{
            mews_score+=0;
        }

        if(param.sistol <= 90 || param.sistol >= 220){
            mews_score+=3;
        }else if(param.sistol <= 100){
            mews_score+=2;
        }else if(param.sistol <= 110){
            mews_score+=1;
        }else{
            mews_score+=0;
        }

        if(param.temp <= 35){
            mews_score+=3;
        }else if(param.temp > 39){
            mews_score+=2;
        }else if(param.temp <= 36 || param.temp >38){
            mews_score+=1;
        }else{
            mews_score+=0;
        }

        if(param.spo2 <= 91){
            mews_score+=3;
        }else if(param.spo2 <= 93){
            mews_score+=2;
        }else if(param.spo2 <= 95){
            mews_score+=1;
        }else{
            mews_score+=0;
        } 
        $('#'+param.type+'-ews').val(mews_score);
    }
}

</script>
