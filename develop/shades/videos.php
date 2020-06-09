<?php
//--------------------------------------------------------------
//Clases
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\kernel\iclass\form;
use core\master\color;
use core\master\resources;
use core\master\icon;
use core\master\video;



//--------------------------------------------------------------
//DECLARACIONES
$sec1 = new section('sec1');
$sec2 = new section('sec2');
$sec3 = new section('sec3');
$sec4 = new section('sec4');
$act1 = new action('act1');
$act2 = new action('act2');
$act3 = new action('act3');

//--------------------------------------------------------------
//CUERPO

$shade->properties->title='Documentación';
$shade->activateHeightUse();

$act1->properties->type=NORMAL;
$act1->properties->caption='Aceptar';
$act1->event->click('cambiarTitulo');


$act2->event->click('cambiarTitulo');


$act3->properties->type=NORMAL;
$act3->properties->caption='Cancelar';

$sec1->properties->type=NORMAL;
//$sec1->properties->video='https://mdbootstrap.com/img/video/animation.mp4';
$sec1->properties->video='https://mdbootstrap.com/img/video/Lines.mp4';

$sec1->properties->header='Header';
$sec1->properties->title=icon::get('id-card').' Titulo';
$sec1->properties->subtitle='SubTitulo.';
$sec1->embed()->script('No hay ninguna propiedad específica para alinear elementos de bloque en CSS2. Se han venido usando diversas técnicas como la del valor auto para los márgenes horizontales que nos permite alinear en esa dirección. Otra forma es dar al elemento de bloque hijo el valor inline-block en su propiedad display. Así podemos dimensionarlo y obedecerá la alineación de elementos Inline que vimos en temas anteriores. Usando text-align para el bloque padre y vertical-align para el bloque hijo conseguimos, con ciertas limitaciones, alinear en ambas direcciones.'
);
$sec1->style->font_color_header(color::name('white'));
$sec1->style->font_color_title(color::name('white'));
$sec1->style->font_color_subtitle(color::name('white'));
$sec1->style->font_color(color::name('white'));
$sec1->style->bg_color(color::name('transparent'));
$sec1->properties->alert='SubTitulo.';
$sec1->width(12);
$sec1->height(12);
/*
'TEST: '.icon::get('file-text').
video::vimeo('137857207')*/

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
//$sec1->style->narrow();
//$sec1->style->font('Times New Roman');
//$sec1->style->font_size(22);
//$sec1->style->font_color(color::name('lime'));
//$sec1->style->justify_footer();
//$sec1->style->narrow_footer();
//$sec1->style->bg_color_footer(color::name('green'));
//$sec1->style->line_footer(3,color::name('brown'));

//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addAction($act1);
$sec1->addAction($act3);


$shade->addSection($sec1);



?>



