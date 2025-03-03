<!DOCTYPE html>
<html>

<head>
    <title>Print Gelang - {{ $pasien->name }}</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            font-size: 10px;
        }

        body {
            margin: 0px;
            margin-top: 20px;
            margin-left: 625px;
        }

        @page {
            size: 215mm 30mm portrait;
            margin: 0px;
        }

        .centered {
            text-align: left;
        }

        .dummy {
            color: white;
        }

        td {
            margin: 0px;
            padding: 0px;
        }

        .norm {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <table style="width: 100vw"">
        {{-- <tr>
            <td rowspan="3" style="width:45% "></td>
            <td rowspan="3" style="width:7% ">{!! $barcode !!}</td>
            <td class="centered" style="width: 18%">#{{ $pasien->no_rm_formatted }}</td>
            <td class="dummy" style="width: 30%">.</td>
        </tr> --}}
        {{-- <tr>
            <td class="dummy" style="width: 40%">.</td>
        </tr> --}}
        <tr class="norm">
            <td style="width:30% " class="centered">#{{ $pasien->no_rm_formatted }}</td>
        </tr>
        <tr>
            <td style="width:60%" class="centered"><b>{{ $pasien->name }}</b></td>
            <td></td>
        </tr>
        <tr>
            <td style="width:70% " class="centered">{{ date('d-m-Y', strtotime($pasien->date_of_birth)) }} /
                {{ $pasien->age }} Thn /
                {{ $pasien->jk->nama }}</td>
            <td></td>
        </tr>
    </table>
</body>

</html>
