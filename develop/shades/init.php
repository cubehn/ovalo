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
$act1 = new action('act1');
$act2 = new action('act2');
$act3 = new action('act3');

//--------------------------------------------------------------
//CUERPO
$shade->activateHeightUse();
$shade->properties->title='Prueba de Diseño';

$act1->properties->type=NORMAL;
$act1->properties->caption='Formato 1';
$act1->event->click('cambiarEmbed');

$act2->properties->type=NORMAL;
$act2->properties->caption='Formato 2';
$act2->event->click('cambiarEmbed2');

$act3->properties->type=NORMAL;
$act3->properties->caption='Formato 3';
$act3->event->click('cambiarEmbed3');


$sec1->properties->title='¿Qué es el diseño web?';
$sec1->properties->subtitle='El diseño web implica trabajo relacionado con el layout y diseño de páginas online, así como la producción de contenido, aunque generalmente se aplica a la creación de sitios web.';

$sec1->style->font_size_title(20);
$sec1->style->shadow_title(8);
$sec1->width(8);
$sec1->height(12);
$sec1->embed()->file('initial.html');


//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addActions([$act1,$act2,$act3]);

$shade->addSections([$sec1]);



?>

