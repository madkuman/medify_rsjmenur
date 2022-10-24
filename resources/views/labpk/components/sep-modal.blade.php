<div class="modal fade" id="modalConfirmationSEP" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-content">
                    <form action="{{url('labpk/transaksi/sep/edit/'.$transaksi->slug)}}" method="POST">
                        <h3>Ubah Nomor SEP</h3>
                        {{csrf_field()}}
                        <p>Masukkan Nomor SEP yang baru</p>
                        {{ Form::label('tanggal_periksa', 'Nomor SEP baru')}}
                        <input type="number" name="sep_number" class="form-control" placeholder="Masukkan Nomor SEP baru di sini">
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>