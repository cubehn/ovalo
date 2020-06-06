<?php
//--------------------------------------------------------------
//Clases
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\kernel\iclass\form;
use core\master\repeat;
use core\master\resources;
use core\master\icon;



//--------------------------------------------------------------
//DECLARACIONES
$sec1 = new section('sec1');
$sec2 = new section('sec2');
$sec3 = new section('sec3');
$sec4 = new section('sec4');
$act1 = new action('act1');
$act2 = new action('act2');

//--------------------------------------------------------------
//CUERPO

$shade->properties->title='Documentación';

$act1->properties->type=NORMAL;
$act1->properties->caption='Aceptar';
$act1->event->click('cambiarTitulo');


$act2->event->click('cambiarTitulo');

$sec1->properties->type=NORMAL;
$sec1->properties->header='Header'.$act2->paint();
$sec1->properties->title='Titulo';
$sec1->properties->subtitle='SubTitulo.';
$sec1->style->header_justify();
$sec1->style->header_line(2,'red','dotted');
//$sec1->style->header_bg_color_RGBA(200,159,240,0.5);
$sec1->style->header_bg_color_HEX('FFDDDD');
$sec1->style->font_title('Arial');
$sec1->style->font_header('Arial');
$sec1->style->font_size_title(20);
$sec1->style->font_size_header(20);
$sec1->style->align_title('center');
$sec1->style->decoration_title('overline','red','wavy');
$sec1->style->decoration_subtitle('overline underline');
$sec1->style->decoration_header('underline');
$sec1->style->align_subtitle('right');
$sec1->style->bg_color_subtitle('silver');
$sec1->style->bg_color_title('gray');
$sec1->style->bold_title(1);
$sec1->style->bold_subtitle(1);
$sec1->style->bold_header(1);
$sec1->style->shadow_title(5);
$sec1->style->shadow_subtitle(7);
$sec1->style->shadow_header(3);
$sec1->style->font_subtitle('Calibri');
$sec1->style->font_size_subtitle(18);
//$sec1->style->font_color_subtitle_RGBA(20,190,210,0.8);
$sec1->style->font_color_subtitle_HEX('FFE189');

/*
	//nuevo manejo de colores:

	color::rgba(255,255,255,0.5);
	color::hexa('FFFFDD');
	color::name('red');
*/

//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addAction($act1);


$shade->addSection($sec1);



?>



