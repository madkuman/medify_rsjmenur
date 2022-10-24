<html>
    <table>
        <tr>
            <td colspan="20">LAPORAN BULANAN ISPA</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>Periode : {{ $date_start->format('d-m-Y') }} - {{ $date_end->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td rowspan="4">No</td>
            <td rowspan="4">FASYANKES</td>
            <td colspan="31">Realisasi Penemuan</td>
            <td rowspan="4">Jumlah yang dihitung napas atau ada TDDK</td>
            <td colspan="10" rowspan="2">Kematian pada Balita karena Pneumonia</td>
            <td colspan="6">I S P A  &#62; 5 td</td>
        </tr>
        <tr>
            <td colspan="6">PNEUMONIA</td>
            <td colspan="6">PNEUMONIA BERAT</td>
            <td colspan="10">Jumlah PNEUMONIA &#38; PNEUMONIA BERAT</td>
            <td colspan="9">Penderita batuk bukan Pneumonia</td>
            <td colspan="3" rowspan="2">Bukan Pneunomia</td>
            <td colspan="3" rowspan="2">Pneunomia</td>
        </tr>
        <tr>
            <td colspan="3"> &#60; 1 </td>
            <td colspan="3"> 1 - &#60; 5 </td>
            <td colspan="3"> &#60; 1 </td>
            <td colspan="3"> 1 - &#60; 5 </td>
            <td colspan="3"> &#60; 1 </td>
            <td colspan="3"> 1 - &#60; 5 </td>
            <td colspan="3">Kum</td>
            <td rowspan="2">%</td>
            <td colspan="3"> &#60; 1 </td>
            <td colspan="3"> 1 - &#60; 5 </td>
            <td colspan="3">Kum</td>
            <td colspan="3"> &#60; 1 </td>
            <td colspan="3"> 1 - &#60; 5 </td>
            <td colspan="3">Kum</td>
            <td rowspan="2">CFR</td>
        </tr>
        <tr>
            @for ($i = 1; $i <= 15; $i++)
             <td>L</td>
             <td>P</td>
             <td>&#931;</td>
            @endfor
        </tr>
        <tr>
            @for ($i = 1; $i <= 55; $i++)
                @php
                    if($i==3) $i+=5
                @endphp
                <td>{{ $i }}</td>
            @endfor
        </tr>
    </table>
</html>