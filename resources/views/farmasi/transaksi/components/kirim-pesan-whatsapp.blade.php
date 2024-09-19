@if ($transaksi->pasien_detail->phone)
    <div class="form-group">
        <form>
            <input type="hidden" id="target" name="target" value="{{ $transaksi->pasien_detail->phone ?? '' }}">
            <input type="hidden" id="nama_pasien" name="nama_pasien"
                value="{{ $transaksi->pasien_detail ? $transaksi->pasien_detail->name : $transaksi->nama_pasien }}">
            <button type="button" class="btn btn-success mt-2" style="float: left; text-color: white"
                onclick="send()"><i class="fa fa-whatsapp"></i>&nbsp;&nbsp;Kirim
                Notif WA</button>
        </form>
    </div>
@endif
<script>
    function send() {
        var target = $('#target').val();
        var nama_pasien = $('#nama_pasien').val();

        $.ajax({
            url: "{{ route('whatsapp') }}",
            type: 'GET',
            data: {
                target: target,
                nama_pasien: nama_pasien
            },
            success: function(response) {
                let data = JSON.parse(response);
                if (data.status == true) {
                    swal('Info', data.detail, 'info');
                }
            }
        });
    }
</script>
