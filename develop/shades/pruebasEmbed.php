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


$sec2->properties->title='Ejemplo1';
$sec2->width(4);
$sec2->height(12);

$sec3->properties->header='Borrar una rama';
$sec3->width(12);
$sec3->height(12);
$sec3->embed()->script('En ocasione puede ser necesario eliminar una rama del repositorio, por ejemplo porque nos hayamos equivocado en el nombre al crearla. Aquí la operativa puede ser diferente, dependiendo de si hemos subido ya esa rama a remoto o si todavía solamente está en local.');

$sec4->properties->header='Conclusión';
$sec4->embed()->script('Espero que estas notas te hayan ayudado a entender las ramas de Git y puedas experimentar por tu cuenta para hacer algunos ejemplos e ir cogiendo soltura. Realmente trabajar con ramas te dará la posibilidad de sacar mucho partido a Git y organizar mejor tus prepositorios, facilitando también el trabajo en grupo. ');

//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addActions([$act1,$act2]);

$sec2->addSections([$sec3,$sec4]);
$sec2->addActions([$act3]);

$shade->addSections([$sec1,$sec2]);



?>

