<script type="text/javascript">
    const layananOptions = `@foreach($layanan as $row)
    <option value="{{$row->id}}">{{$row->deskripsi}}</option>
    @endforeach`;
    var templates = [];
    @foreach($template as $t)
        templates[{{$t->id}}] = `{!! $t->konten !!}`;
            @endforeach
    var batalModal = $('#delete-pemeriksaan');
    var konfirmasi_modal = $('#modal-top');
    var list_harga = $('.list-harga');
    var quills = [];
    var new_quills = [];
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean', 'image']                                         // remove formatting button
    ];
    var options = {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Tulis Hasil baca disini...',
        theme: 'snow'
    };
    $(document).on('select2:select', '.template-select', function(e) {
        var template = templates[this.value];
        var target = $(this).data('quill');
        console.log(target)
        console.log(quills)
        quills[target].setContents([]);
        quills[target].clipboard.dangerouslyPasteHTML(0,template);
    });
    var options = {
      placeholder: 'Tulis Hasil baca disini...',
      theme: 'snow'
    };
    $(document).ready(function() { 
        Codebase.helpers(['select2']);
                $("#lightgallery").lightGallery({
            pager: true,
            zoom: true,
            actualSize: true,
            fullscreen: true,
            selector: '.photo-preview'
        });
        @foreach($transaksi->detail as $d)
            quills[{{$d->id}}] = new Quill('#quill_editor_{{$d->id}}', options);
        @endforeach
            quills['new_0'] = new Quill('#quill_editor_new_0', options);
    });
    
    function deleteConfirmation(id) {
        $("#deleteBtn").data("delete", id);
        $("#modal-popout").modal("show");
    }
    function deleteImg(){
        var target = $("#deleteBtn").data("delete");
        // var photoDiv = $("#photo"+target);
        $("#photo"+target).remove();
        // photoDiv.html(`<img src="{{URL::asset('assets/img/deleted.jpg')}}" class="four-col">`);
        $("#modal-popout").modal("hide");
        $("#deleteDiv").append(`<input type="hidden" name="deletedPhoto[]" value="`+target+`">`);
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
                qty = $el.parent().parent().parent().parent().find('.jumlah-periksa').val();
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
        $(`#tabel_layanan_${target}`).addClass('disabled-div');
        btn.data('state', 'disabled');
        batalModal.modal('hide');
    });

    function addForm(){
    var totalLayanan = $(".layananBaru").length;
    var codeToAdd = `<div class="form-group single-layanan  layananBaru" id="layanan_${totalLayanan}" data-index="${totalLayanan}">
            <table class="table table-bordered table-vcenter">
                <tr>
                    <th style="width: 180px">Layanan Tambahan</th>
                    <th>Jumlah Pemeriksaan</th>
                    <th>Film Dipakai</th>
                    <th>Film Direject</th>
                    <th style="width: 145px">Alasan Film Direject</th>
                    <th style="width: 110px">Ukuran Film</th>
                    <th>Foto Ulang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th style="width: 125px">Alasan Foto Ulang</th>
                    <th>Kontras Dipakai</th>
                    <th>Kontras Dikembalikan</th>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <select class="form-control new-layanan js-select2" id="layanan${totalLayanan}" style="width: 200px;" >
                                <option value="0" selected="">Pilih layanan</option>
                                @foreach($layanan as $row)
                                <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <input type="number" class="form-control new-jumlah-periksa" value="1" min="1">
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <input type="text" value="0" min="0" class="form-control new-film-dipakai" placeholder="Masukkan Jumlah Film yang Dipakai">
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <input type="text" value="0" min="0" class="form-control new-film-direject" placeholder="Masukkan Jumlah Film yang Di-reject">
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <select class="form-control new-alasan-film-direject" style="width: 100%;" >
                                <option value="" selected="">-</option>
                                @foreach($alasan_direject as $ad)
                                <option value="{{$ad}}">{{$ad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-md-12 pb-10 px-0">
                            <select class="form-control new-ukuran-film" style="width: 100%;" >
                                <option value="" selected="">-</option>
                                @foreach($ukuran as $u)
                                <option value="{{$u}}">{{$u}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <input type="number" value="0" min="0" class="form-control new-foto-ulang">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <select class="form-control new-alasan-foto-ulang" style="width: 100%;">
                                <option value="" selected="">-</option>
                                @foreach($alasan_ulang as $au)
                                <option value="{{$au}}">{{$au}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <input type="number" value="0" min="0" class="form-control new-kontras-dipakai">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 pb-10 px-0">
                            <input type="number" value="0" min="0" class="form-control new-kontras-dikembalikan">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="text-right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-lg btn-circle btn-outline-danger mr-5 mb-5" onclick="removeForm(${totalLayanan})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="10"><button class="btn btn-hero btn-primary btn-hasil-baca" type="button" data-toggle="modal" data-target="#hasil_baca_new_${totalLayanan}_modal">Hasil Baca</button></th>
                </tr>
            </table>
        </div>`;
    $(".form-layanan").append(codeToAdd);
    $('body').append(`<div class="modal" id="hasil_baca_new_${totalLayanan}_modal" tabindex="-1" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Hasil Baca</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        {{ Form::label('template_select', 'Pilih Template')}}
                        <select class="form-control js-select2 template-select" name="template_select" style="width: 100%;" data-quill="new_${totalLayanan}">
                            <option>Gunakan Template yang anda inginkan</option>
                            @foreach($template as $t)
                                <option value="{{$t->id}}">{{$t->tarif->deskripsi}} - {{$t->title}} - {{$t->creator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('konten', 'Konten')}}
                        <div class="hasil-baca-container" id="quill_editor_new_${totalLayanan}" style="height: 700px;">
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>`);
        quills[`new_${totalLayanan}`] = new Quill(`#quill_editor_new_${totalLayanan}`, options);
    Codebase.helpers(['select2']);
}   
function removeForm(id) {
    $("#layanan_"+id).remove();
    console.log(id);
}
</script>