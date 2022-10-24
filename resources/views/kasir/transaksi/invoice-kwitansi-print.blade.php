<html>
<head>
    <style type="text/css">
    @page {
     margin: 0px;
 }
 body{
    font-style: "Tahoma";
    font-size: 14px;
    text-transform: uppercase;
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
table.table,.table th,.table td {;
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
</style>
</head>
<body>
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
        Dr. Faiq Aminullaha
    </div>
    <div class="titik">
        (..............................)
    </div>
</body>
</html>