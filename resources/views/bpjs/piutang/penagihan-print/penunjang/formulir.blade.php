<head>
	<title>Hasil Pemeriksaan {{$departemen}}</title>
</head>

<style type="text/css">
.small-col {
	width: 17%;
}
.big-col {
	width: 43%;
}
.med-col {
	width: 23%;
}
td {
	vertical-align: top;
}
.title {
	text-align: center; 
	font-weight: bold;
}
.left-hr{
	width: 50%; 
	margin-left: 0px;
}
.mb-5{
	margin-bottom: 5px;
}
body {
	margin-top: -30px;
	margin-bottom: -30px;    
}
.centered{
	text-align: center;
}
.bot{
	border-bottom: 2px solid black
}
.va-mid{
	vertical-align: middle;
}
.logo{
	position: absolute;
	z-index: 100;
}
.head{
	font-size: 42px;
}
@page{
	margin : 50px 25px;
}
table{
	border-collapse: collapse;
	width: 100%;
	font-family: sans-serif;
	font-size: 10px;
}
.centered{
	text-align: center;
}
.underline{
	text-decoration: underline;
}
.bordered, .bordered td{
	border: 1px solid black;
}
.bordered td{
	padding-left: 10px;
}
.bold{
	font-weight: bold;
}
.big{
	font-size: 12px;
}
.m-20{
	margin: 20px;
}
td{
	vertical-align: top;
}
.stretched{
	-webkit-transform:scale(1,1.5);
}
.fill{
	color: white;
	font-size: 80px;
}
.ttd{
	color: white;
	font-size: 30px;	
}
.bot-border{
	border-bottom: 1px solid black;
}
.mx-20{
	margin-left: 20px;
	margin-right: 20px;
}
.parent{
	border: 5px solid black;
	font-family: courier !important;
	text-align: center;
	vertical-align: middle;
	font-weight: bold;
	font-size: 17px;
}
</style>
<body>
@include('keuangan.piutang.penagihan-print.component.print-formulir-penunjang')
</body>