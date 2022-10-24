function printContent(id){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(id).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}

$(document).on('click', '.remove', function(){
    var id = $(this).data("pk")
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: "POST",
                    url: API_URL + "/keuangan/piutang/delete",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id : id,
                        redirect_url : redirect_url
                    },
                    success: function (data) {
                        callSwal(data.type,data.title,data.text,data.url);
                    },
                    error: function () {
                        callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                    }
                })
            });
        }
    })
});

$('#submit').click(function() {
    $('#confirmPayment').modal('toggle');

    $.ajax({
        type: "GET",
        url: API_URL + "/keuangan/akun/get",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            var option = [];
            option.push({
                id: '',
                text: '',
            });
            console.log(data)
            // alert(data[0].tipe.name);
            auto_select = -1;
            for (i in data) {
                if(data[i].nama == 'Tunai'){
                    auto_select = data[i].id;
                }
                option.push({
                    id: data[i].id,
                    text: data[i].no_rekening+' - '+data[i].nama,
                });
            }

            $('#akun').select2({
                data: option
            });
            if(auto_select != -1){
                $('#akun').val(auto_select).trigger('change');
            }
        }
    });
})

$('#buttonSubmit').click(function() {
    var id = $('#id_piutang').val();
    var bill = $('#bill').val();
    var pembayaran = $('#input-paid').val();
    var deposit = $('#input-deposit').val();
    var akun_id = $('#akun').val();
    var rugi_rs = $('#rugi-rs').is(':checked');
    var untung_rs = $('#untung-rs').is(':checked');
    var is_kembali = 0;


    if(pembayaran == '') pembayaran = 0
    if(deposit == '') deposit = 0

    if(!untung_rs){
        is_kembali = 1;
        bill = parseInt(bill)
        deposit = parseInt(deposit)
        pembayaran = parseInt(pembayaran)
        kembalian = deposit + pembayaran - bill;
        kembalian = numeral(kembalian).format('0,0')


    }

    if(akun_id == '')
        callSwal('warning','Transaksi Gagal','Akun Rekening Tidak Boleh Kosong',0);
    else{

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var today = new Date();
        $('#buttonSubmit').hide();
        $('#buttonLoading').show();

        $.ajax({
            type: "POST",
            url: API_URL + "/keuangan/piutang/pay",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id : id,
                pembayaran : pembayaran,
                deposit : deposit,
                akun_id : akun_id,
                rugi_rs : rugi_rs,
                untung_rs : untung_rs,
                redir_url : 'keuangan/piutang'
            },
            success: function (data) {
                if (current_id!=0) {
                    window.open(BASE_URL+'keuangan/pemasukan/'+current_id+'/print-nota',
                            'newwindow', 
                            `width=500,height=500`);
                }
                if(is_kembali) callSwal(data.type,data.title,"Kembalian : Rp "+kembalian,data.url);
                else callSwal(data.type,data.title,data.text,data.url);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
                $('#confirmPayment').modal('toggle');
            },
            error: function () {
                callSwal('error','Transaksi Gagal','Silahkan Coba Lagi',0);
                $('#buttonSubmit').show();
                $('#buttonLoading').hide();
            }
        });
    }
});

$(document).ready(function() {
    $('#confirmPayment').on('shown.bs.modal', function () {
        $('#input-paid').focus()
    })
    var inputPayment = document.getElementById('input-paid');
    var inputDeposit = document.getElementById('input-deposit');
    inputPayment.onkeyup = function(event){
        checkTotalPayment()
    }
    inputDeposit.onkeyup = function(event){
        checkTotalPayment()
    }
});

checkTotalPayment()

function checkTotalPayment()
{
    var bill = $('#bill').val();
    var deposit = $('#input-deposit').val();
    var pembayaran = $('#input-paid').val();
    var kembalian = 0
    var max_deposit = $('#input-deposit').data('max')


    if(pembayaran == '') pembayaran = 0
    if(deposit == '') deposit = 0
    if(deposit > max_deposit) $('#input-deposit').val(max_deposit)

    bill = parseInt(bill)
    deposit = parseInt(deposit)
    pembayaran = parseInt(pembayaran)

    //jika belum input
    if((pembayaran=='' && deposit == '') || (pembayaran==0 && deposit == 0) || (pembayaran=='' && deposit == 0) || (pembayaran==0 && deposit == '')){
        document.getElementById("buttonSubmit").disabled = true;
        $('#rugi-rs-field').hide();
        $('#untung-rs-field').hide();
    }
    else{
        kembalian = deposit + pembayaran - bill;
        console.log(kembalian)
        document.getElementById("buttonSubmit").disabled = false;
        var bill = $('#bill').val();
        if(kembalian < 0){
            $('#rugi-rs-field').show();
            $('#untung-rs-field').hide();
            $("#untung-rs").prop("checked", false);
        }
        else if(kembalian == 0){
            $('#rugi-rs-field').hide();
            $('#untung-rs-field').hide();
            $("#untung-rs").prop("checked", false);
            $("#rugi-rs").prop("checked", false);
        }
        else if(kembalian > 0) {
            $('#rugi-rs-field').hide();
            $('#untung-rs-field').show();
            $("#rugi-rs").prop("checked", false);
        }
    }
}