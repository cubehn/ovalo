<?php
//--------------------------------------------------------------
//Clases
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\kernel\iclass\form;
use core\master\color;
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

$c1=color::rgba(124);
$c2=color::hexa('FFDDFF');
$c3=color::name('red');

/*
$sec1->properties->alert='mensaje de alerta';
$sec1->properties->error='mensaje de error';
$sec1->properties->warning='mensaje de warning';*/

//$sec1->style->justify_header();
//$sec1->style->line_header(2,color::name('red'),'dotted');
//$sec1->style->bg_color_header(color::hexa('FFDDFF'));
//$sec1->style->font_title('Arial');
//$sec1->style->font_header('Arial');
//$sec1->style->font_size_title(20);
//$sec1->style->font_size_header(20);
//$sec1->style->align_title('center');
//$sec1->style->decoration_title('overline',color::name('blue'),'wavy');
//$sec1->style->decoration_subtitle('overline underline');
//$sec1->style->decoration_header('underline');
//$sec1->style->align_subtitle('right');
//$sec1->style->bg_color_subtitle(color::name('silver'));
//$sec1->style->bg_color_title(color::name('gray'));
//$sec1->style->bold_title(1);
//$sec1->style->bold_subtitle(1);
//$sec1->style->bold_header(1);
//$sec1->style->shadow_title(5);
//$sec1->style->shadow_subtitle(7);
//$sec1->style->shadow_header(3,$c1);
//$sec1->style->font_subtitle('Calibri');
//$sec1->style->font_size_subtitle(18);
//$sec1->style->font_color_subtitle(color::hexa('FFE189'));
//$sec1->style->font_color_title(color::hexa('FFFFFF'));
//$sec1->style->font_color_header($c3);
//$sec1->style->bg_color(color::name('silver'));
//$sec1->style->border(2,color::name('red'));
//$sec1->style->shadow(color::rgba(200,100,100));
//$sec1->style->bg_image('f15.jpg','cover');
//$sec1->style->underground_color(color::name('silver'));
//$sec1->style->border_radius(4);

//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addAction($act1);


$shade->addSection($sec1);



?>



