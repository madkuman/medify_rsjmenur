<script src="{{url('')}}/assets/js/plugins/jquery-masked-inputs/jquery.mask.min.js"></script>
<script type="text/javascript"> 
    var konfirmasi_modal = $('#modal-top');
    var list_harga = $('.list-harga');
    var delete_transfusi = null;
    var target_id = null;
    var layananSearchUrl = "{{url('keuangan/tarif_master/get_lab')}}";
    var departemen = '{{$departemen}}';
    var tipe = {{$transaksi->tarif_tipe_id}};
    var kelas = {{$transaksi->class}};

    $(document).ready(function(){
        $('.time').mask('00:00');
    });

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

    function proceed(){
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
        $("#periksaForm").submit();
    }
        function deleteConfirmation(id) {
        $("#deleteBtn").data("delete", id);
        $("#modal-popout").modal("show");
    }
    function deleteImg(){
        var target = $("#deleteBtn").data("delete");
        $("#photo"+target).remove();
        $("#modal-popout").modal("hide");
        $("#deleteDiv").append(`<input type="hidden" name="deletedPhoto[]" value="`+target+`">`);
    }

    $(document).on('click', '#tambah_bukti', function(){
        var trans_length = $('.transfusi-row').length;
        $('#transfusi_tbody').append(`<tr class="transfusi-row" id="transfusi_row_${trans_length}">
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" name="tanggal[]" class="js-datepicker form-control" value="">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" class="form-control time" name="jam[]" id="time_${trans_length}">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" class="form-control" name="no_kantong[]" value="">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" class="form-control" name="no_slang[]" value="">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" class="form-control" name="jenis_darah[]" value="">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 px-0">
                                <select class="form-control" name="golongan_darah[]">
                                    @foreach($goldar as $g)
                                        <option value="{{$g}}">{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="rhesus[]">
                                    @foreach($rhesus as $g)
                                        <option value="{{$g}}">{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="col-12 px-0">
                                <select class="form-control" name="hasil_cross[]">
                                    @foreach($hasil_cross as $g)
                                        <option value="{{$g}}">{{$g}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" class="form-control" name="pemberi[]" value="">
                        </div>
                    </td>
                    <td>
                        <div class="col-12 px-0">
                            <input type="text" class="form-control" name="penerima[]" value="">
                        </div>
                    </td>
                    <td class="px-0">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-lg btn-circle btn-outline-danger cancel-bukti" data-id="${trans_length}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`);
        $(`#time_${trans_length}`).mask('00:00');
        $('.js-datepicker').datepicker();
    });

    $(document).on('click', '.cancel-bukti', function(){
        target_id = $(this).data('id');
        var row = $(`#transfusi_row_${target_id}`);
        if(row.find(`#transfusi_id_${target_id}`).length){
            delete_transfusi = row.find(`#transfusi_id_${target_id}`).val();
            $('#modal_delete_transfusi').modal('show');
        } else {
            row.remove();
        }
    });

    function deleteTransfusi(){
        if(delete_transfusi === null || target_id === null)
            return;
        $("<input>").attr({
            type: 'hidden',
            name: 'delete_transfusi[]',
            value: delete_transfusi,
            class: 'final-form',
        }).appendTo("#periksaForm");
        $(`#transfusi_row_${target_id}`).remove()
        $('#modal_delete_transfusi').modal('hide');
    }

    $(document).on('click', '#submit-tambah-pemeriksaan', function(){
        if($("#tambah-pemeriksaan").val().length > 0){
            $("#tambahPemeriksaanForm").submit();
        }else{
            callSwal('error','Gagal Tambah Pemeriksaan','Terdapat Masukan yang Kosong',0);
        }
    });
</script> 