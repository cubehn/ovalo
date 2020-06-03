<?php
    
    use core\kernel\ovalo;

    $encabezado = ovalo::section('encabez');
    $sec1 = ovalo::section('sec1');


	$encabezado->width(6);
	$encabezado->properties->header='Encabezado';
	$encabezado->properties->title='PHP orientado a objetos';
	$encabezado->properties->subtitle='Concepto';
	$encabezado->style->font_subtitle('"Lucida Console"');
	$encabezado->style->footer_background_color_HEX('CD5C5C');
	$encabezado->style->border_radius(3,1,1,0,0);
	$encabezado->style->footer_line(4,'#FA8072','ridge');
	$encabezado->style->font_size_subtitle(40);
	$encabezado->style->border(1,'silver');
	$encabezado->style->header_bg_color_HEX('EEEEEE');
	$encabezado->style->underground_color_RGBA(100,100,100,0.5);
	$encabezado->style->bg_image('');
	
	$sec1->properties->title='titulo del section';
?>