<html>
<head>
    <style type="text/css">
    @page {
        margin-top: 25px;
    }
    body{
        font-style: "Tahoma";
        font-size: 14px;
        text-transform: uppercase;
        font-weight: bold;
    }
    .text-center
    {
        text-align: center
    }
    .text-right
    {
        text-align: right;
    }
    .table
    {
        width: 100%;
    }
    table.table,.table th,.table td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 8px;
        font-style: "Tahoma";
        font-size: 7px;
        text-transform: uppercase;
    }
    .date td{
        text-align: center;
    }
    .underline{
        text-decoration: underline;
    }

    .terima-dari
    {
        position: fixed;
        left:34%;
        top:4%;
    }
    .banyaknya_uang{
        position: fixed;
        left: 38%;
        top: 7%;
    }
    .pasien{
        position: fixed;
        left: 48%;
        top: 12%;
    }
    .terbilang{
        position: fixed;
        left: 32%;
        top: 20%;
    }
    .ttd{
        position: fixed;
        left: 58%;
        top: 21%;
        width: 300px;
        text-align: center;
    }
    .titik{
        position: fixed;
        left: 58%;
        top: 25%;
        width: 300px;
        text-align: center;
    }
    .rm
    {
        position: fixed;
        right:4%;
        top:4%;
    }
</style>
</head>
<body>
    <div class="rm">
        {{$no_rm}}
    </div>
    <div class="terima-dari">
        {{$terima_dari}}
    </div>
    <div class="banyaknya_uang">
        {{$banyaknya_uang}} RUPIAH
    </div>
    <div class="pasien">
        {{$pasien}}
    </div>
    <div class="terbilang">
        Rp {{number_format($terbilang,0)}}
    </div>

    <div class="ttd">
        Surabaya, {{indonesian_date(time())}}<br>
        {{$nama_kasir}}
    </div>
    <div class="titik">
        (..............................)
    </div>
</body>
</html>