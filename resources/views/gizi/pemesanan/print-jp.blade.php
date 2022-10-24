<!DOCTYPE html>
<html>
<head>
<style>
table,td, th {
    border: 1px solid black;
    border-collapse: collapse;
    font-size:10pt;
}
th, td {
    padding: 12px;
}
</style>
</head>
<body>
    <table>
                <tbody>
                    <tr>
                        <th rowspan="2" style="width: 13%;">DIET</th>
                        @foreach($jenis as $jp)
                        <th colspan="6" >{{$jp->jenis}}</th>
                        @endforeach
                        <th rowspan="2">JML</th>
                    </tr>
                    <tr>
                        @foreach($kelas as $kelas_item)
                        <th>{{$kelas_item->nama}}</th>
                        @endforeach
                        <th>JML</th>
                        @foreach($kelas as $kelas_item)
                        <th>{{$kelas_item->nama}}</th>
                        @endforeach
                        <th>JML</th>
                        @foreach($kelas as $kelas_item)
                        <th>{{$kelas_item->nama}}</th>
                        @endforeach
                        <th>JML</th>
                        @foreach($kelas as $kelas_item)
                        <th>{{$kelas_item->nama}}</th>
                        @endforeach
                        <th>JML</th>
                        @foreach($kelas as $kelas_item)
                        <th>{{$kelas_item->nama}}</th>
                        @endforeach
                        <th>JML</th>
                    </tr>
                    <tr></tr>
                    @foreach($diet as $diet_item)
                    <tr class="border-top-bold">
                        <td>{{$diet_item->nama}}</td>
                        @for($i=1;$i<=5;$i++)
                        @foreach($kelas as $kelas_item)
                        <td>{{$data[$diet_item->nama][$i][$kelas_item->nama]['normal']}}</td>
                        @endforeach
                        <td>{{$jumlah[$diet_item->nama][$i]['normal']}}</td>
                        @endfor
                        <td>{{$jumlah[$diet_item->nama]['normal']}}</td>    
                    </tr>
                    <tr class="border-bottom-bold">
                        <td><i>Tambahan {{$diet_item->nama}}</i></td>
                        @for($i=1;$i<=5;$i++)
                        @foreach($kelas as $kelas_item)
                        <td>{{$data[$diet_item->nama][$i][$kelas_item->nama]['tambahan']}}</td>
                        @endforeach
                        <td>{{$jumlah[$diet_item->nama][$i]['tambahan']}}</td>
                        @endfor
                        <td>{{$jumlah[$diet_item->nama]['tambahan']}}</td>  
                    </tr>
                    @endforeach
                    
                </tr>

            </tbody>
        </table>

<script type="text/javascript">
window.print();
</script>

</body>
</html>
