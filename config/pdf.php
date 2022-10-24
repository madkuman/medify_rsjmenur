<?php

/*MPDF*/

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Medify PDF',
	'display_mode'          => 'fullpage',
	'tempDir'               => public_path('temp/'),
	'font_path' => public_path('assets/fonts/'),
	'font_data' => [
		'arial' => [
			'R'  => 'arial.ttf',    // regular font
			'B'  => 'arialbd.ttf',       // optional: bold font
			'I'  => 'ariali.ttf',     // optional: italic font
			'BI' => 'arialbi.ttf' // optional: bold-italic font
		]
	]
];
