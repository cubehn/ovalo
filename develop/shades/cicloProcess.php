<?php
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\kernel\iclass\form;
use core\kernel\iclass\blackbox;
use core\master\repeat;
use core\master\resources;
use core\master\icon;


$encabezado = new section('encabezado');
$sec1 = new section('sec1');
$sec2 = new section('sec2');

$act1 = new action('act1');
$act2 = new action('act2');

$act1->properties->type=NORMAL;
$act1->properties->caption='Tamaño';
$act1->event->click(blackbox::process2('process7'));

$act2->properties->type=NORMAL;
$act2->properties->caption='Estilo Minimalista';
$act2->event->click(blackbox::process2('convertir'));



$encabezado->properties->type=NORMAL;
$encabezado->width(12);
$encabezado->height(12);
$encabezado->properties->header='Encabezado';
$encabezado->properties->title='PHP orientado a objetos';
$encabezado->properties->subtitle='Concepto';
$encabezado->style->bg_image('ramon-salinero-vEE00Hx5d0Q-unsplash.jpg','100%');
$encabezado->style->font_color_title_RGBA(255,255,255);
$encabezado->style->font_color_RGBA(255,255,255);
$encabezado->style->font_size(16);
$encabezado->style->header_bg_color_RGBA(255,255,255,0.5);
$encabezado->embed()->script('Realizar un centrado horizontal de un elemento es relativamente sencillo y,<br> dependiendo del tipo de elemento, existen varias técnicas que permiten hacerlo. Por ejemplo,<br> si es un elemento en línea bastaría con aplicarle al elemento la propiedad CSS de text-align: center;<br> mientras que si es un elemento en bloque solo sería necesario<br> definir un ancho o width para el elemento y margin: auto;');

//$shade->event->time(blackbox::process2('process4'),0.5,'min');
$encabezado->addActions([$act1,$act2]);

$shade->addSections([$encabezado]);




?>

