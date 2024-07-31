<div class="form-group">
   <label for="tindak-lanjut">Tindak Lanjut</label>
   <textarea class="form-control" id="tindak-lanjut" rows="4">{{ $transaksi->tindak_lanjut ?? '' }}</textarea>
   <button type="button" id="btn-submit-tindak-lanjut" class="btn btn-primary mt-2" style="float: right; text-color: white">Simpan</button>
</div>