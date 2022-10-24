<p>Hasil Pemeriksaan {{{ucfirst($hasil->jenis_form)}}}</p>
<div style=" margin-bottom: 5px;">
    <table style="width: 100vw;">
        <tr>
            <td style="width: 20%; font-weight: bold;">Makroskopis</td>
            <td style="width: 80%; font-weight: bold;">:</td>
        </tr>
    </table>
    <?php echo htmlspecialchars_decode(stripslashes($hasil->makroskopis ? $hasil->makroskopis : '-')) ?>
</div>
<div style=" margin-bottom: 5px;">
    <table style="width: 100vw;">
        <tr>
            <td style="width: 20%; font-weight: bold;">Mikroskopis</td>
            <td style="width: 80%; font-weight: bold;">:</td>
        </tr>
    </table>
<?php echo htmlspecialchars_decode(stripslashes($hasil->mikroskopis ? $hasil->mikroskopis : '-')) ?>    </div>
<div style=" margin-bottom: 5px;">
    <table style="width: 100vw;">
        <tr>
            <td style="width: 20%; font-weight: bold;">Kesimpulan</td>
            <td style="width: 80%; font-weight: bold;">:</td>
        </tr>
    </table>
<?php echo htmlspecialchars_decode(stripslashes($hasil->kesimpulan ? $hasil->kesimpulan : '-')) ?>
</div>