<script type="text/javascript">
    removeHarga();
    removeShift();

    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false
    });

    function formatMoney(money) {
        return 'Rp. '+money.toLocaleString();
    }

    function formatTime(date) {
        dates = new Date(date);
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = dates.getDate();
        var monthIndex = dates.getMonth();
        var year = dates.getFullYear();
        var hours = dates.getHours();
        var min = dates.getMinutes();

        return day + ' ' + monthNames[monthIndex] + ' ' + year + ', ' + hours + ':' + min;
    }

    function formatDate(date) {
        dates = new Date(date);
        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        var day = dates.getDate();
        var monthIndex = dates.getMonth();
        var year = dates.getFullYear();

        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }

    $('#pengaturan').on('click', function(){
        $('#modal-large-pengaturan').modal('show');
    });

    $('#close').on('click', function(){
        $('#modal-large-pengaturan').modal('hide');
    });

    $('#btnAddHarga').on('click', function(){
        str = 
        `<div class="row item-wrapper gutters-tiny">
            <input type="hidden" name="refer[]" value="0">
            <div class="col-3">
                <div class="form-group">
                    <div>
                        <select class="form-control js-select2" name="perusahaan_tipe_id[]"  style="width:100%"  data-placeholder="Jenis Pembayaran">
                            <option></option>
                            @foreach(session('perusahaan_tipe') as $tipe)
                            <option  value="{{$tipe->id}}" >
                                {{$tipe->nama}}
                            </option>
                            @endforeach
                            <option value="0"> Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" name="harga_min[]" placeholder="Harga Minimal">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" name="harga_max[]" placeholder="Harga Maksimal">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <div>
                        <input type="number" class="form-control" name="laba[]" placeholder="Laba">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveHarga">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        $('#newHarga').append(str);
        $('.js-select2').select2();
        removeHarga();
    });

    $('#btnAddShift').on('click', function(){
        str = 
        `<div class="row item-wrapper gutters-tiny">
            <input type="hidden" name="shift[]" value="0">
            <div class="col-md-3">
                <div class="form-group">
                    <div>
                        <input type="text" name="nama_shift[]" class="form-control" placeholder="Nama Shift" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div>
                        <input type="text" class="form-control" name="keterangan_shift[]" placeholder="Keterangan">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div>
                        <input type="text" name="waktu_mulai[]" class="form-control timepicker" placeholder="Waktu Mulai">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div>
                        <input type="text" class="form-control timepicker" name="waktu_selesai[]" placeholder="Waktu Selesai">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemoveShift">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>`;
        $('#newShift').append(str);
        removeShift();

        $('.timepicker').timepicker({
            showInputs: false,
            showMeridian: false
        });
    });

    function removeHarga() {
        $('.btnRemoveHarga').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }

    function removeShift() {
        $('.btnRemoveShift').on('click', function(){
            var wrapper = $(this).parents('.item-wrapper');
            wrapper.remove();
        });
    }
    // Pengaturan Farmasi - Embalase
    $(document).on('click', '.btn-remove-embalase', function () {
        let parent = $(this).parents('tr');
        parent.remove();
    });

    $(document).on('click', '.btn-add-embalase', function () {
        let button = $(this);
        let index = button.data('index');
        
        let html = `@include('farmasi.layouts.components.setting-aturan-embalase-row', ['index' => '\${index}', 'item' => null])`;
        let element = $(html).appendTo('#farmasi-pengaturan-embalase tbody');
        element.find('.js-select2').select2();
        index ++ ;
        button.data('index', index);
    });
</script>