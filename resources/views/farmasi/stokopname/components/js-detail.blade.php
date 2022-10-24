<script type="text/javascript">
    var detail_changes = [];

    $('#new').on('click', function(){
        $('#modal-large').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large').modal('hide');
    });

    var counter = 1;
    $('#btnAddItems').on('click', function(){
        counter++;
        str = 
        `<div class="row justify-content-center item-baru">
        <div class="col-md-4">
        <div class="form-group">
        <div>
        <select class="js-select2 barang-select2 form-control" id="barang-select2-`+counter+`" name="barang[]" style="width: 100%;" data-placeholder="Pilih Barang">
        <option></option>
        </select>
        </div>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <div>
        <input type="text" class="js-datepicker form-control" id="tanggal-datepicker-`+counter+`" name="kadaluarsa[]" placeholder="Masukkan Tanggal Kadaluarsa" autocomplete="off" required>
        </div>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
        <div>
        <input type="number" class="form-control" id="jumlah-`+counter+`" name="jumlah[]" placeholder="Jumlah">
        </div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
        <div>
        <input type="text" class="form-control" id="ket-`+counter+`" name="keterangan[]" placeholder="Keterangan">
        </div>
        </div>
        </div>
        <div class="col-md-1">
        <div class="form-group">
        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
        <i class="fa fa-trash"></i>
        </button>
        </div>
        </div>
        </div>`;
        $('#newItem').append(str);
        $('#barang-select2-'+counter).select2({
            ajax: {
                url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
                dataType: 'json',
                delay: 250,
                data: function (params) 
                {
                    return {
                        keyword: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 3,
            placeholder: "Cari Barang",
            templateResult: formatBarang,
            templateSelection: formatBarangSelection
        });
        removeItem();
        $('#tanggal-datepicker-'+counter).datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy', 
        });
    });

    $('#barang-select2-1').select2({
        ajax: {
            url: API_URL+"/farmasi/{{session('farmasi')->slug}}/item/get",
            dataType: 'json',
            delay: 250,
            data: function (params) 
            {
                return {
                    keyword: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 3,
        placeholder: "Cari Barang",
        templateResult: formatBarang,
        templateSelection: formatBarangSelection
    });
    removeItem();
    $('#tanggal-datepicker-1').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy', 
    });

    function formatBarang (item) {
        if (item.loading) {
            return item.text;
        }

        var markup = item.item_detail.nama + " ("+item.item_detail.satuan+")";

        return markup;
    }

    function formatBarangSelection (item) {
        if(item.item_detail) return item.item_detail.nama + " ("+item.item_detail.satuan+")";
        else return item.text;
    }

    function removeItem() {
        $('.btnRemove').on('click', function(){
            var wrapper = $(this).parents('.item-baru');
            wrapper.remove();
        });
    }

    function filterBarang(e)
    {
        if(e.value.length < 2) {
            $('.opname-wrapper').css('display', '');
            return;
        }

        let filter, container, rows, i, textValue;
        filter = e.value.toLowerCase();

        container = document.getElementById('itemsDiv');
        rows = container.getElementsByClassName('opname-wrapper');

        for(i = 0; i < rows.length; i++)
        {
            textValue = rows[i].getElementsByClassName('nama-item')[0].innerText.toLowerCase();
            if(textValue.indexOf(filter) > -1 ) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    $('.btnRemoveDetail').on('click', function(){
        var current_id = $(this).data('id');
        detail_changes = detail_changes.filter(function(element) {
            return element.id != current_id;
        });
        var obj = {"id": current_id, "type": -1};
        detail_changes.push(obj);
        var wrapper = $(this).parents('.opname-detail-wrapper');
        wrapper.remove();
    });

    $(".change-detail").on('change', function(){
        var current_id = $(this).data('id');
        detail_changes = detail_changes.filter(function(element) {
            return element.id != current_id;
        });

        var jumlah = $('#sub-jumlah-'+current_id).val();
        var ket = $('#sub-ket-'+current_id).val();
        var obj = {"id": current_id, "type": 1, "keterangan":ket, "jumlah":jumlah};
        detail_changes.push(obj);
    })

    function reviewStokOpname(slug) {
        console.log(slug);
        var url = "{{ url('/farmasi/'.session('farmasi')->slug.'/stokopname/review-print') }}/"+slug;
        popupwindow(url,'Review Stok Opname',620,1000);
    }

    function printStokOpname(slug) {
        console.log(slug);
        var url = "{{ url('/farmasi/'.session('farmasi')->slug.'/stokopname/print') }}/"+slug;
        popupwindow(url,'Print Stok Opname',620,1000);
    }

    function downloadStokOpname(slug) {
        // console.log(slug);
        var url = "{{ url('/farmasi/'.session('farmasi')->slug.'/stokopname/download') }}/"+slug;
        popupwindow(url,'Print Stok Opname',620,1000);
    }

    $('.confirm').on('click', function(){
        var confirmSupp = $(this).parent().find('#form-confirm');
        swal({
            title: 'Apa anda yakin?',
            text: 'Mohon dicek kembali data yang ada, bila sudah dikonfirmasi penghapusan dan distribusi barang akan dilakukan dan tidak bisa dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Konfirmasi',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                confirmSupp.submit();
            //swal('Berhasil', 'Data berhasil dihapus.', 'success');
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
        } else if (result.dismiss === 'cancel') {
            swal('Batal', 'Konfirmasi dibatalkan.', 'error');
        }
    });
    });

    $('.confirm-del').on('click', function(){
        var deleteSupp = $(this).parent().find('#form-delete');
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Konfirmasi',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                deleteSupp.submit();
            //swal('Berhasil', 'Data berhasil dihapus.', 'success');
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
        } else if (result.dismiss === 'cancel') {
            swal('Batal', 'Hapus dibatalkan.', 'error');
        }
    });
    });

    $('#saveEdit').on('click', function(){
        if($(this).attr('disable'))
            return;
        $('#saveEdit').attr('disable', true);
        $('#saveEdit').find('i').remove();
        $('#saveEdit').prepend('<i class="fa fa-spin fa-spinner"></i>');
        var formdata =  new FormData();
        formdata.append('changes', JSON.stringify(detail_changes));
        formdata.append('id', {{$stokopname->id}});
        swal({
            title: 'Simpan perubahan?',
            text: 'Anda yakin ingin menyimpan perbahan ini?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'simpan',
            html: false,
        }).then(function(result){
            if (result.value) {
                $.ajax({
                    type: "POST",
                    data: formdata,
                    url: API_URL + "/farmasi/{{session('farmasi')->slug}}/stokopname/save-changes",
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        callSwal('success', 'Berhasil!', 'perubahan berhasil disimpan.', 'farmasi/{{session('farmasi')->slug}}/stokopname/{{$stokopname->slug}}/{{$flag}}');
                    },
                    error: function (error) {
                        console.log(error);
                        swal('Gagal', 'perubahan gagal disimpan.', 'error');

                        $('#saveEdit').attr('disable', false);
                        $('#saveEdit').find('i').remove();
                        $('#saveEdit').prepend('<i class="fa fa-save"></i>');
                        return;
                    }
                });
            } else if (result.dismiss === 'cancel') {
                $('#saveEdit').attr('disable', false);
                swal('Batal', 'simpan dibatalkan.', 'error');
            }
        });
    });

</script>