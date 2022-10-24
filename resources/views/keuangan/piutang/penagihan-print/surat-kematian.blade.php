<!doctype html>
<html>
<head>
    <meta charset="utf-8">
        <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    p {
        margin: 0px;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        padding-bottom: 10px;
    }

    tr.border_bottom td {
        border-bottom:5pt solid black;
        padding-bottom: 10px;
    }

    .invoice-box table td {
        padding: 0px;
        /*vertical-align: top;*/
        padding-bottom: 10px;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: left;
        padding-bottom: 10px;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 0px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: inherit;
        color: #333;
        padding-bottom: 10px;
    }

    .information {
        padding-bottom: 10px;
    }

    .informations {
        padding-bottom: 0px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        padding-bottom: 0px;
    }

    .invoice-box table tr.details td {
        padding-bottom: 10px;
    }

    .invoice-box table tr.detailsafterheading td {
        padding-bottom: 10px;
        padding-top: 8px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    </style>
</head>
<body>
    @include('keuangan.piutang.penagihan-print.component.surat-kematian')
</body>
</html>
