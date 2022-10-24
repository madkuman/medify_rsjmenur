<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kegiatan Kesehatan - Pasien Umum</title>
    <style type="text/css">
    body{
        font-size: 15px;
        font-family: sans-serif;
    }
    @page { margin: 0px; }
    .container {
        width: 100%;
        height: 95%;
        background: red;
        margin: auto;
    }
    .one{
        left: 8.3%;
    }
    .two
    {
        right: 0;
    }
    .one,.two
    {
        position: absolute;
        top: 0;
        width: 45.8%;
        height: 95.54%;
        overflow: hidden;
    }
    .one {
        /*background: aqua;*/
    }
    .two {
        margin-left: 50%;
        /*background: yellow;*/
        padding-right: 1%;
    }
    .page-break {
        page-break-after: always;
    }
    .blue
    {
        /*background-color: blue !important;*/
    }
    .orange
    {
        /*background-color: orange !important;*/
    }
    .page-content
    {
        padding: 60px;
        padding-top: 50px;
        
    }
    .text-center
    {
        text-align: center;
        margin-bottom: 5px;
    }
    .table-border{
        border-collapse: collapse;
    }
    .table-border td,
    .table-border th
    {
        border: solid 1px #000;
    }
    table.lab, .lab td, .lab tr, .lab th{
        /*border: solid 1px #000;
        border-collapse: collapse;*/
        padding: 0px;

    }
    hr
    {
        border: none;
        height: 1px;
        /* Set the hr color */
        color: #333; /* old IE */
        background-color: #333; /* Modern Browsers */
    }
    /*STYLE LAMA*/
    table{
        border-collapse: collapse;
    }
    tr.noBorder td {
        border-top: : 0;
        border-bottom: 0;
    }
    tr.borderTop td{
        border-bottom: 0;
    }

    tr.borderBot td{
        border-top: 0;
    }
    td {
        vertical-align: top;
        padding-bottom: 0px;
        padding-top: 0px;
    }
    .page_num{
        width:100%;
        text-align:center;
        /*background: green;*/
    }
    .dummy{
        color: white;
        font-size: 20px;
    }
    .table-header{
        font-size: 16px;
        padding-top: 3px;
        padding-bottom: 3px;
        text-align: center; 
        width: 50%;
        vertical-align: center;
    }
    .page2-title{
        text-align: center; 
        padding-top: 0px; 
        margin-top: 5px;
        padding-bottom: 0px;
        margin-bottom: 8px;
    }
    .sm-text{
        font-size: 13px;
    }


</style>
</head>
<body>
    <div class="one blue">
        <div class="page-content">
            @include('kasus.urikkes.content.laporan.pdf.component-umum.section-5')
        </div>
    </div>
    <div class="two orange">
        <div class="page-content">
            @include('kasus.urikkes.content.laporan.pdf.component-umum.section-6')
        </div>
    </div>
    <div class="page-break"></div>
    <div class="one blue">
        <div class="page-content">
            @include('kasus.urikkes.content.laporan.pdf.component-umum.section-7')
        </div>
    </div>
    <div class="two orange">
        <div class="page-content">
            @include('kasus.urikkes.content.laporan.pdf.component-umum.section-8')
        </div>
    </div>
</body>
</html>