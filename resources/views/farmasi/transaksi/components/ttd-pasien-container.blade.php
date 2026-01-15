<div style="padding-top: 100px">
   <table width="100%" style="text-align: center">
      <tr>
         <td>TTD Pasien/Keluarga</td>
      </tr>
      <tr>
         <td>
            @if (!empty($transaksi->img_ttd))
            <img src="{{asset($transaksi->img_ttd)}}" alt="ttd-pasien" style="width: 90px; max-width: 90px">
            @endif
         </td>
      </tr>
      <tr>
         <td style="word-wrap: break-word">({{$transaksi->nama_ttd ?? ''}})</td>
      </tr>
   </table>
</div>