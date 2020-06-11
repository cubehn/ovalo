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

$act2->properties->caption='boton2';
$act2->event->click('cambiarTitulo');


$act3->properties->type=NORMAL;
$act3->properties->caption='Cancelar';
$act3->event->click('pruebaClickHeader');

$sec1->properties->type=NORMAL;
$sec1->properties->header='Header';
$sec1->properties->title=icon::get('id-card').' Titulo';
$sec1->properties->subtitle='SubTitulo.';
$sec1->embed()->script('No hay ninguna propiedad específica para alinear elementos de bloque en CSS2. Se han venido usando diversas técnicas como la del valor auto para los márgenes horizontales que nos permite alinear en esa dirección. Otra forma es dar al elemento de bloque hijo el valor inline-block en su propiedad display. Así podemos dimensionarlo y obedecerá la alineación de elementos Inline que vimos en temas anteriores. Usando text-align para el bloque padre y vertical-align para el bloque hijo conseguimos, con ciertas limitaciones, alinear en ambas direcciones.'
.'<br>'.resources::getImage('f1.jpg','200px')
.resources::getImage('f2.jpg','200px','rounded') // rounded, bordered, vacio
.resources::getImage('f3.jpg','200px','bordered')
.resources::getImage('f4.jpg','200px')
.resources::getImage('f5.jpg','600px')
);
$sec1->properties->alert='SubTitulo.';
$sec1->width(12);
$sec1->height(12);

$sec1->event->doubleclick('pruebaClickHeader',HEADER);

/*
'TEST: '.icon::get('file-text').
video::vimeo('137857207')*/

$c1=color::rgba(124);
$c2=color::hexa('FFDDFF');
$c3=color::name('red');


//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addAction($act1);
$sec1->addAction($act2);
$sec1->addAction($act3);


$shade->addSection($sec1);



?>



