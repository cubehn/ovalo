<?php
    
    use core\kernel\ovalo;

    $encabezado = ovalo::section('encabez');
    //$sec1 = ovalo::section('sec1');

	$encabezado->style->underground_color_HEX('EEEEEE');  
	$encabezado->style->bg_color_HEX('EEEEEE');
	$encabezado->style->border(0);
	$encabezado->style->header_bg_color_HEX('EEEEEE');  
	$encabezado->style->footer_background_color_HEX('EEEEEE');  
	$encabezado->style->border_radius(0);
	$encabezado->style->footer_line(0);
	$encabezado->style->header_line(0);
$encabezado->style->font_color_title_RGBA(0,0,0);
$encabezado->style->font_color_RGBA(0,0,0);
$encabezado->style->header_bg_color_RGBA(255,255,255,0.5);
	/*
	$sec1->style->underground_color_HEX('FFFFEE');  
	$sec1->style->bg_color_HEX('FFFFEE');
	$sec1->style->border(0);
	$sec1->style->header_bg_color_HEX('FFFFEE');  
	$sec1->style->footer_background_color_HEX('FFFFEE');  
	$sec1->style->border_radius(0);
	$sec1->style->footer_line(0);
	$sec1->style->header_line(0);
	*/
?>