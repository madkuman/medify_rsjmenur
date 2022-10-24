@include('labpa.transaksi.content.form-template-js')
<script type="text/javascript">
    var konfirmasi_modal = $('#modal-top');
    var list_harga = $('.list-harga');
    var batalModal = $('#delete-pemeriksaan');

    $(document).on('click', '.cancel-periksa', function(){
        var target = $(this).data('target');
        var id = $(this).data('id');
        $('#batal-pemeriksaan-name').text(target);
        batalModal.find('#konfirmasi-batal').data('id', id);
        batalModal.modal('show');
    });
    $(document).on('click', '#konfirmasi-batal', function(){
        var target = $(this).data('id');
        var btn = $(`#cancel-${target}`);
        var state = btn.data('state');
        var parent = btn.parent().parent().parent();
        parent.addClass('disabled-div');
        btn.data('state', 'disabled');
        batalModal.modal('hide');
    });

	function initSelect2Form(){
	    Codebase.helpers(['select2']);
		$('.select-form-layanan').on("select2:select", function(e) { 
	        let target = e.params.data.id;
	        let formId = $(this).data('id');
	        let formDiv = $(`#formLayananDiv${formId}`);
	        var judul = $(this).find(':selected').html();
	        let makroskopis, mikroskopis, kesimpulan;
	        switch(target) {
	            case 'papsmear':
	                formDiv.html(formPapsmear);
	                let formList = formDiv.find('.custom-control-input');
	                let labelList = formDiv.find('.custom-control-label');
        	        formDiv.find('.judul-form').html(judul);
	                formList.each(function(item, form){
	                    let target = form.id;
	                    form.id = `${target}_${formId}`;
	                    form.name = `${form.name}[${formId}][]`;
	                    labelList[item].setAttribute('for', `${target}_${formId}`);
	                });
	                kesimpulan = formDiv.find('.kesimpulan');
	                kesimpulan[0].name = `kesimpulan[${formId}]`;
	                break;
	            default:
	                formDiv.html(formBasic);
        	        formDiv.find('.judul-form').html(judul);
	                makroskopis = formDiv.find('.makroskopis');
	                makroskopis[0].name = `makroskopis[${formId}]`;
	                mikroskopis = formDiv.find('.mikroskopis');
	                mikroskopis[0].name = `mikroskopis[${formId}]`;
	                kesimpulan = formDiv.find('.kesimpulan');
	                kesimpulan[0].name = `kesimpulan[${formId}]`;
	                break;
	        }
	        tinymce.init({
		        selector:'.tinymce',
                forced_root_block: ""
		    });
    	});
	}
	function addForm(){
    var totalLayanan = $(".layananBaru").length;
    var codeToAdd = `<div class="row form-group layananBaru" id="layanan_`+totalLayanan+`" data-index="`+totalLayanan+`">
                <div class="col-md-6 mb-10">
                    <select class="form-control new-layanan js-select2" id="layanan`+totalLayanan+`" name="" style="width: 100%;" >
                            <option value="0" selected="">Pilih layanan tambahan</option>
                        ${layananOptions}        
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control js-select2 select-form-layanan new-form-detail" style="width: 100%;" data-id="Baru">
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
    initSelect2Form();
}
function removeForm(id) {
    $("#layanan_"+id).remove();
}
</script>
@include('layouts.components2.lab.dropzone-lab')
<script type="text/javascript"> 
    const layananOptions = `@foreach($layanan as $row)
    <option value="{{$row->id}}">{{$row->deskripsi}}</option>
    @endforeach`;
    initSelect2Form();
    tinymce.init({
	    selector:'.tinymce',
        forced_root_block: "" 
	});
    function proceed(){
        if($('.final-form'))
            $('.final-form').remove()
        $(".layananBaru").each(function (i, el) {                
            $("<input>").attr({
                type: 'hidden',
                name: 'new_layanan[]',
                value: $(el).find('.new-layanan').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_lokasi[]',
                value: $(el).find('.new-lokasi').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_slide[]',
                value: $(el).find('.new-slide').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'new_kode_sediaan[]',
                value: $(el).find('.new-kode-sediaan').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
            $("<input>").attr({
                type: 'hidden',
                name: 'formDetailBaru[]',
                value: $(el).find('.new-form-detail').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".judul-input").each(function (i, el) {
            $("<input>").attr({
                type: 'hidden',
                name: 'judul[]',
                value: $(el).val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".caption-input").each(function (i, el) {
            $("<input>").attr({
                type: 'hidden',
                name: 'caption[]',
                value: $(el).val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $(".cancel-periksa").each(function (i, el){
            if($(el).data('state') == 'enabled')
                return;
            $("<input>").attr({
                type: 'hidden',
                name: 'batal_layanan[]',
                value: $(el).parent().parent().parent().find('input[type=checkbox]').val(),
                class: 'final-form',
            }).appendTo("#periksaForm");
        });
        $("#periksaForm").submit();
    }
    $(document).on('click', '#submit-all', function(){
        var tarif_ditagih = $('.akan-ditagih:checked');
        var $el, deskripsi, qty, total, content;
        if(tarif_ditagih.length > 0){
            $('.ditagih').show();
            list_harga.empty();
            tarif_ditagih.each(function(i, el){
                $el = $(el);
                deskripsi = $el.siblings().text();
                harga = $el.data('harga');
                qty = $el.parent().parent().find('.jumlah-periksa').val();
                total = harga*qty;
                content = `<tr>
                            <td>${deskripsi}</td>
                            <td>${parseFloat(harga).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'})}</td>
                            <td>${qty}x</td>
                            <td class="link-effect text-warning text-center font-w700">${parseFloat(total).toLocaleString('id-ID', {currency: 'IDR', style: 'currency'})}</td>
                        </tr>`;
                list_harga.append(content);
            });
        } else {
            $('.ditagih').hide();
        }
        konfirmasi_modal.modal('show');
    })
</script>