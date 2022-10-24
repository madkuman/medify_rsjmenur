<!DOCTYPE html>
<html lang="en" ng-app="medifyApp">
<head>
  @include('layouts.components2.header')
  <title>@yield('title')</title>
  <style type="text/css">
    @yield('css')
    page {
      background: white;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {  
      width: 21cm;
      height: 29.7cm; 
    }
    page[size="A4"][layout="portrait"] {
      width: 29.7cm;
      height: 21cm;  
    }

    @media print {
      body, page {
        margin: 0;
        box-shadow: 0;
      }
      .header {
        border-bottom: 1px solid black;
        font-size: 13px;
      }
      .header-lands {
        border-bottom: 1px solid black;
        font-size: 13px;
      }
      .header-left {
        float: left; 
        width: 35%;
      }
      .header-left-lands {
        float: left; 
        width: 25%;
      }
      .header-right {
        float: right; 
        width: 20%;
      }
      p {
        margin: 0;
        padding: 0;
      }
      h4 {
        font-size: 18px;
        margin: 0;
        padding: 0;
      }
      .text-bold {
        font-weight: bold;
      }
      .text-center {
        text-align: center;
      }
      .text-right {
        text-align: right;
      }
      .judul {
        padding-top: 20px;
        margin-top: 15px;
        padding-bottom: 15px;
      }
      .subjudul {
        margin-top: 20px;
      }
      .table-custom {
        border: 0.5px solid black;
        border-collapse: collapse;
      }
      td {
        padding: 5px 0 5px 0;
        vertical-align: top;
      }
      th {
        padding: 10px 5px 10px 5px;
      }
      .pad-left {
        padding-left: 5px;
        padding-right: 5px;
      }
      .pad-right {
        padding-right: 10px;
      }
      table {
        /* page-break-inside: avoid;
        page-break-before: always; */
      }
      .tanda-tangan {
        padding-top: 50px;
        /* page-break-inside: avoid;
        page-break-before: always; */
      }
    }
   
  </style>
</head>
<body>
@yield('main-content')
</body>
</html>