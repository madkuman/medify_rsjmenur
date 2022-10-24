<style type="text/css">
	.bg-image {display: block;}
	/*#boarding_pass {display: none;}*/
	#lembar_sep {display: none;}
	#lembar_sep_copy {display: none;}
	#boarding_pass_antrian {
		width: 100% !important;
	}
	input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
	body {
		background-color: white;
	}
	input[type="number"] {
		-moz-appearance: textfield;
	}

	body {
		overflow: auto;
	}
	.part{
		height: 57px;
		vertical-align: top;
		padding-top: 5px;
		width: 100%;
	}

	@media print {
		@page{
			size: 300mm 300mm;
			margin: 0px;
			padding: 0px;
		}
		html, body {
			background-color: white;
			margin: 0px;
			padding: 0px;
		}
	}
	.blue{
		background-color: #000066;
	}
	.page-content { 
		position: relative; 
		top: 50px;
		left: -330px;
		background-color: white;
		color: black;
		/* width: 1150px;
		height: 400px; */
	}
	.rumkital{
		position: absolute;
		left: 0;
		top: 0;
		z-index: 2;
		color: #204E5D;
		font-size: 32px;
		font-weight: 700;
		text-align: center;
	}
	.barcode{
		position: absolute;
		vertical-align: bottom;
		left: 70px;
		top: 1000px;
		z-index: 2;
	}
	.barcode img{
		width: 300px;
	}
	/* .barcode{
		position: absolute;
		height: 1000px;
		left: 50px;
		top: 302px;
		z-index: 1;
	} */
	table{
		border-collapse: collapse;
		font-size: 14px;
		line-height: 175%;
		/* white-space: nowrap; */
	}
	.grey{
		background-color: #e6e6e6;
	}
	.logobpjspanjang{
		position: absolute;
		top: 200px;
		left:1000px;
		z-index: 100;
	}
	.label{
		font-size: 16px;
		margin-top: 10px;
	}
	.big{
		font-size: 28px;
		font-weight: bold;
		margin-bottom: 0px;
		padding-top: 0px;
	}
	.semibig{
		font-size: 30px;
	}
	.gap{
		padding-top: 40px;
		font-size: 30px;
	}
	.p-33 {
		padding: 33px;
	}
	#copy_sep{
		font-size: 250px;
		opacity: 0.5;
		text-align: center;
	}
	.pt-80{
		padding-top: 80px;
	}
	.mt-40 {
		margin-top: 40px;
	}
	.flat-transparent{
		background-color: rgba(17, 63, 76, 0.85) !important;
	}
	.big-button{
		min-height: 70px;
		font-size: 1.5rem !important;
		padding-top: 22px !important;
	}
	.no-border{
		border: none !important;
	}
	.font-25{
		font-size: 25px;
	}
	.font-20{
		font-size: 20px;
	}
	.font-21{
		font-size: 21px;
	}
	.font-35{
		font-size: 35px;
	}
	.labl {
		display : block;
		width: 100%;
	}
	.labl > input{ /* HIDE RADIO */
		visibility: hidden; /* Makes input not-clickable */
		position: absolute; /* Remove input from document flow */
	}
	.labl > input + div{ /* DIV STYLES */
		cursor:pointer;
		border:2px solid transparent;
	}
	.labl > input:disabled + div { /* (RADIO CHECKED) DIV STYLES */
		border-color: #d5d5d5;
		background-color: #d5d5d5;
		cursor: default;
	}
	.labl > input:checked + div { /* (RADIO CHECKED) DIV STYLES */
		background-color: #42a5f5;
	}
	.labl > input:checked + div h5.title, .labl > input:checked + div, .labl > input:checked + div .h3 {
		color: #fff !important;
	}
	.labl > input:checked + div {
		color: #fff !important;
	}
	.boarding-pass-title {
		font-size: 37px;
		font-family: 'Times New Roman', Times, serif;
	}
	.labl p
	{
		font-size: 12px;
	}
	.slick-slider .slick-prev {
		left: -65px;
	}
	.slick-slider .slick-next {
		right: -65px;
	}
	.slick-slider .slick-next, .slick-slider .slick-prev {
		background-color: #f5f6f7;
		border-color: #d3d7dc;
	}
	.slick-slider .slick-next:hover, .slick-slider .slick-prev:hover {
		background-color: #d3d7dc;
		border-color: #b7bec5;
	}

	.setup-content .col-4 .block .block-content {
		padding: 10px 20px;
		min-height: 80px;
	}
	.setup-content .col-4 .block .block-content h5 {
		margin: auto !important;
		line-height: 50px;
	}

	.btn-primary {
		background-color: #204E5D;
		border-color: #204E5D;
	}

	.btn-primary:hover, .btn-primary:visited, .btn-primary:focus, .btn-primary:active {
		background-color: #2f748b !important;
		border-color: #2f748b !important;
	}

	.text-light {
		color: #0a2e47 !important;
	}
</style>