<?php
//Clases
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\kernel\iclass\form;
//use core\kernel\iclass\blackbox;
use core\master\repeat;
use core\master\resources;
use core\master\icon;


//trabajar en el height del shade

//DECLARACIONES
$sec1 = new section('sec1');
$sec2 = new section('sec2');

$act1 = new action('act1');
$act2 = new action('act2');
$act3 = new action('act3');

//CUERPO
$act1->properties->type=NORMAL;
$act1->properties->caption='Tamaño';
$act1->event->click('cambiaTitulo');

$act2->properties->type=NORMAL;
$act2->properties->caption='Estilo Minimalista';
$act2->event->click('cambiaTitulo2');

$act3->properties->type=NORMAL;
$act3->properties->caption='Ancho';
$act3->event->click('ancho');

$sec2->properties->title='';
$sec2->properties->subtitle='';

$sec2->event->click('cambiaTitulo2');

//ESTRUCTURA, ASOCIACIONES

$sec1->addActions([$act1,$act2,$act3]);

$shade->addSections([$sec1,$sec2]);



?>

