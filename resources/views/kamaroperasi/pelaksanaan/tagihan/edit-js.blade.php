<script type="text/javascript">

    function updateEditSubTotal()
    {
        var unit_price = $('#tagihanEditUnitPrice').val();
        var qty = $('#tagihanEditQty').val();
        var subtotal = unit_price * qty;
        subtotal = numberWithCommas(subtotal);
        $('#tagihanEditSubTotalMask').val(subtotal);
    }


    function showModalEdit(id)
    {
        $('#editTagihan').modal('show');
        $.ajax({
            url: API_URL+"/kasus/{{$trans_info->kasus->nomor_kasus}}/tagihan/detail/"+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#tagihanEditID').val(response.id);
                $('#tagihanEditDesc').val(response.desc);
                $('#tagihanEditUnitPrice').val(response.unit_price);
                $('#tagihanEditQty').val(response.qty);
                $('#tagihanEditSubTotalMask').val(response.subtotal);
                $('#tagihanEditTarifID').val(response.tarif_id);
                $('#tagihanEditDepartemenID').val(response.departemen_id);
                $('#tagihanEditTarifTipeID').val(response.tarif_tipe_id);
                $('#tagihanEditTarifKelas').val(response.tarif_kelas_id);
            },
            error: function() {
                alert('error');
            },
        });

    }
    $('#tarifEditLoading').hide();
    var editTagihanLastDesc = '';

    function emptyEditDaftarHargaID()
    {
        var edit_current_desc = $(".tagihan-autocomplete-edit").val();

        if(edit_current_desc !== editTagihanLastDesc)
        {
            $("#tagihanCreateDaftarHargaID").val('');
        }
    }


    function showModalDelete(id)
    {
        $('#tagihanDeleteID').val(id)
        $('#tagihanModalDelete').modal('show');
    }

    function showModalCheckout(id)
    {
        $('#tagihanCheckoutID').val(id)
        $('#checkoutTagihan').modal('show');
    }

function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
setInputFilter(document.getElementById("tagihanEditUnitPrice"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("tagihanEditQty"), function(value) {
  return /^-?\d*$/.test(value); });

</script>