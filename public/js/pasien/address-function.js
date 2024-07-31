function getKota()
{
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kota/get',
        dataType: 'json',
        success:function(data){
            console.log(data);
            data.forEach(function(item) {
                var newOption = new Option(item.name, item.id, false, false);
                $("#kotaSelect2").append(newOption).trigger('change');
            });
            setKecamatan(1)
        },
        error:function(data){
            if(getKotaErrorCounter<3) getKota();
            else swalError()
                getKotaErrorCounter++;
        }
    });
}

function setKecamatan(id)
{
    $('#kecamatanLoading').show();
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kecamatan/get/'+id,
        dataType: 'json',
        success:function(data){
            console.log(data);
            $('#kecamatanSelect2').html('').select2({data: [{id: '', text: ''}]});
            data.forEach(function(item) {
                var newOption = new Option(item.name, item.id, false, false);
                $("#kecamatanSelect2").append(newOption).trigger('change');
            });
            $('#kecamatanLoading').fadeOut();
        },
        error:function(data){
            console.log(data);
        }
    });
}

function setKelurahan(id)
{
    $('#kelurahanLoading').show();
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kelurahan/get/'+id,
        dataType: 'json',
        success:function(data){
            console.log(data);
            $('#kelurahanSelect2').html('').select2({data: [{id: '', text: ''}]});
            data.forEach(function(item) {
                var newOption = new Option(item.nama, item.id, false, false);
                $("#kelurahanSelect2").append(newOption).trigger('change');
            });
            $('#kelurahanLoading').fadeOut();
        },
        error:function(data){
            console.log(data);
        }
    });
}

function getKotaKerabat()
{
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kota/get',
        dataType: 'json',
        success:function(data){
            console.log(data);
            data.forEach(function(item) {
                var newOption = new Option(item.name, item.id, false, false);
                $("#kotaSelect2Kerabat").append(newOption).trigger('change');
            });
            setKecamatanKerabat(1)
        },
        error:function(data){
            if(getKotaErrorCounter<3) getKotaKerabat();
            else swalError()
                getKotaErrorCounter++;
        }
    });
}

function setKecamatanKerabat(idKerabat)
{
    $('#kecamatanLoadingKerabat').show();
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kecamatan/get/'+idKerabat,
        dataType: 'json',
        success:function(data){
            console.log(data);
            $('#kecamatanSelect2Kerabat').html('').select2({data: [{id: '', text: ''}]});
            data.forEach(function(item) {
                var newOptionKerabat = new Option(item.name, item.id, false, false);
                $("#kecamatanSelect2Kerabat").append(newOptionKerabat).trigger('change');
            });
            $('#kecamatanLoadingKerabat').fadeOut();
        },
        error:function(data){
            //console.log(data);
        }
    });
}

function setKelurahanKerabat(id)
{
    $('#kelurahanLoadingKerabat').show();
    $.ajax({
        type:'GET',
        url:API_URL + '/pasien/alamat/kelurahan/get/'+id,
        dataType: 'json',
        success:function(data){
            console.log(data);
            $('#kelurahanSelect2Kerabat').html('').select2({data: [{id: '', text: ''}]});
            data.forEach(function(item) {
                var newOption = new Option(item.nama, item.id, false, false);
                $("#kelurahanSelect2Kerabat").append(newOption).trigger('change');
            });
            $('#kelurahanLoadingKerabat').fadeOut();
        },
        error:function(data){
            console.log(data);
        }
    });
}