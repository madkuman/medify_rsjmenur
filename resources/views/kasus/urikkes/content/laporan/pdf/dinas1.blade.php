<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kegiatan Kesehatan - Pasien Dinas</title>
	<style type="text/css">
	body{
		font-size: 13px;
		font-family: sans-serif;
	}
	@page { margin: 0px; }
	.container {
		width: 100%;
		height: 98%;
		/*background: red;*/
		margin: auto;
		padding: 10px;
	}
	.one,.two
	{
		width: 50%;
		padding-left: 2%;
		height: 48.2%;
	}
	.one {
		/*background: aqua;*/
		float: left;
	}
	.two {
		margin-left: 50%;
		/*background: yellow;*/
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
		padding-top: 2px;
		padding-left: 5px;
		padding-right: 5px;
		padding-bottom: 5px;
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
</style>
</head>
<body>
	<section class="container">
		<div class="one blue">
			<div class="page-content">
				@include('kasus.urikkes.content.laporan.pdf.component-dinas.section-1')
			</div>
		</div>
		<div class="two orange">
			<div class="page-content">
				@include('kasus.urikkes.content.laporan.pdf.component-dinas.section-2')
			</div>
		</div>
		<div class="one blue">
			<div class="page-content">
				@include('kasus.urikkes.content.laporan.pdf.component-dinas.section-3')
			</div>
		</div>
		<div class="two orange">
			<div class="page-content">
				@include('kasus.urikkes.content.laporan.pdf.component-dinas.section-4')
			</div>
		</div>
	</section>
</body>
</html>