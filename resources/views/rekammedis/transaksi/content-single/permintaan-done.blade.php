<small>Telah Dikirim oleh</small><br><strong>
{{$transaksi->sender->name}}<br>
{{date('d F Y, H:i', strtotime($transaksi->sender_confirmed_at))}}

@if(!empty($transaksi->holder_sender))
<br>
{{$transaksi->holder_sender}}
@endif

</strong>
<br><br>

@if($transaksi->status == 2)
<small>Telah Diterima oleh</small><strong>
@else
<small class="text-danger">Telah <strong>Ditolak</strong> oleh</small><strong class="text-danger">
@endif
<br>
{{$transaksi->holder_confirmer->name}}<br>
{{date('d F Y, H:i', strtotime($transaksi->holder_confirmed_at))}}
</strong>

@if(!empty($transaksi->holder_keterangan))
<br>
{{$transaksi->holder_keterangan}}
@endif