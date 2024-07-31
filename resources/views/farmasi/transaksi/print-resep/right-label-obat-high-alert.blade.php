<br>
<table width="50%">
   <tr>
      <td>
         @if ($show_label_high_alert)
         <table width="50%" style="text-align: center; font-size: 5pt !important; border: 1px solid black;">
            <tr>
               <td style="color: red; padding-top: 4px;"><b>Waspada Obat High Alert</b></td>
            </tr>
            <tr>
               <td style="color: red; padding-bottom: 4px"><b>"DOUBLE CHECK"</b></td>
            </tr>
         </table>
         @endif
      </td>
      <td width="50%">
         @if (!empty($transaksi->final_detail->resep_iter))
         <table width="100%" style="text-align: center; font-size: 5pt !important; border: 1px solid black;">
            <tr>
               <td style="padding-top: 9px; padding-bottom: 9px"><b>{{ $transaksi->final_detail->resep_iter ?? '-' }}</b></td>
            </tr>
         </table>
         @endif
      </td>
   </tr>
</table>