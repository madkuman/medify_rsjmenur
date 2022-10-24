<!DOCTYPE html>
<html>
<head>
    <title>Distribusi Permintaan</title>
    <style type="text/css">
    table {
        border-collapse: collapse;
        font-size: 13px;
    }
    .bordered {
        border: 1px solid black;
    }
    .dummy{
        color: white;
    }

</style>
</head>
<body>
    @php $i=1; $page=1; @endphp
    @while(isset($barang[$i]))
    <div id="loop">
        <table style="width: 100vw; font-weight: bold;">
            <tr>
                <td style="text-align: center;  font-size: 21px;">DAFTAR PERMINTAAN MATKES</td>
            </tr>
            <tr>
                <td style="text-align: center;  font-size: 18px;">Gudang Farmasi</td>
            </tr>
        </table>
        <br>
        <div style="width: 49%; position: absolute; left: 0;">
            <table style="width: 100vw">
                <tr>
                    <td class="bordered" style="text-align: center; width: 7%">NO</td>
                    <td class="bordered" style="text-align: center; width: 50%">NAMA BARANG</td>
                    <td class="bordered" style="text-align: center; width: 13%">SAT</td>
                    <td class="bordered" style="text-align: center; width: 15%">MINTA</td>
                    <td class="bordered" style="text-align: center; width: 15%">DIKASIH</td>
                </tr>
                @for ($item = 1; $item <= 40; $item++)
                @if(isset($barang[$i]))
                <tr>
                    <td class="bordered" style="text-align: center;">{{$i}}</td>
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['nama']}}</td>
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['satuan']}}</td>   
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['minta']}}</td>
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['dikasih']}}</td>
                </tr>
                @else    
                <tr>
                    <td class="bordered dummy">.</td>
                    <td class="bordered dummy">.</td>
                    <td class="bordered dummy">.</td>   
                    <td class="bordered dummy">.</td>
                    <td class="bordered dummy">.</td>
                </tr>
                @endif
                @php $i++ @endphp
                @endfor
            </table>
        </div>
        <div style="width: 49%; position: absolute; right: 0;">
            <table style="width: 100vw">
                <tr>
                    <td class="bordered" style="text-align: center; width: 7%">NO</td>
                    <td class="bordered" style="text-align: center; width: 50%">NAMA BARANG</td>
                    <td class="bordered" style="text-align: center; width: 13%">SAT</td>
                    <td class="bordered" style="text-align: center; width: 15%">MINTA</td>
                    <td class="bordered" style="text-align: center; width: 15%">DIKASIH</td>
                </tr>
                @for ($item = 1; $item <= 40; $item++)
                @if(isset($barang[$i]))
                <tr>
                    <td class="bordered" style="text-align: center;">{{$i}}</td>
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['nama']}}</td>
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['satuan']}}</td>   
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['minta']}}</td>
                    <td class="bordered" style="text-align: center;">{{$barang[$i]['dikasih']}}</td>
                </tr>
                @else    
                <tr>
                    <td class="bordered dummy">.</td>
                    <td class="bordered dummy">.</td>
                    <td class="bordered dummy">.</td>   
                    <td class="bordered dummy">.</td>
                    <td class="bordered dummy">.</td>
                </tr>
                @endif
                @php $i++ @endphp
                @endfor
            </table>
        </div>
    </div>
    @if(isset($barang[$i]))
    <div style="page-break-after: always;"></div>
    @php $page++; @endphp
    @else
    <table style="width: 100vw; position: absolute; bottom: 90; font-size: 16px">
        <tr>
            <td style="text-align: center; width: 50%"></td>
            <td style="text-align: center; width: 50%">Surabaya, ................................................ 2018</td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50%"></td>
            <td style="text-align: center; width: 50%">Mengetahui</td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50%"></td>
            <td style="text-align: center; width: 50%">Kasie Gudang Farmasi</td>
        </tr>
        <tr>
            <td colspan="2" class="dummy" style="font-size: 35px;">.</td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50%"></td>
            <td style="text-align: center; width: 50%">................................................</td>
        </tr>
    </table>
    @endif
    @endwhile
</body>
</html>