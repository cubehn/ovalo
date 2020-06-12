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

$shade->properties->title='Diseño1';


$act1->properties->type=NORMAL;
$act1->properties->caption='Mover';
$act1->event->click('mover');


$sec1->properties->type=NORMAL;
$sec1->properties->header='Header';
$sec1->properties->debug=0;
$sec1->properties->title=icon::get('id-card').' Titulo';
$sec1->properties->subtitle='SubTitulo.';
$sec1->embed()->script('No hay ninguna propiedad específica para alinear elementos de bloque en CSS2. Se han venido usando diversas técnicas como la del valor auto para los márgenes horizontales que nos permite alinear en esa dirección. Otra forma es dar al elemento de bloque hijo el valor inline-block en su propiedad display. Así podemos dimensionarlo y obedecerá la alineación de elementos Inline que vimos en temas anteriores. Usando text-align para el bloque padre y vertical-align para el bloque hijo conseguimos, con ciertas limitaciones, alinear en ambas direcciones.'
);

$sec2->properties->title='sec2';
$sec2->properties->debug=0;
$sec2->embed()->script('El comando git fetch comunica con un repositorio remoto y obtiene toda la información que se encuentra en ese repositorio que no está en el tuyo actual y la almacena en tu base de datos local.

En primer lugar, observamos este comando en Traer y Combinar Remotos y seguimos viendo ejemplos de su uso en Ramas Remotas.');
$sec3->properties->title='sec3';
$sec3->properties->debug=0;
$sec3->embed()->script('El comando git pull es básicamente una combinación de los comandos git fetch y git merge, donde Git descargará desde el repositorio remoto especificado y a continuación, de forma inmediata intentará combinarlo en la rama en la que te encuentres.');
$sec4->properties->title='sec4';
$sec4->properties->debug=0;
$sec4->embed()->script('Por último, mencionamos muy rápidamente que se puede utilizar la opción --verify-signatures con el fin de verificar qué commits que estás descargando han sido firmados con GPG en Firmando Commits.');

//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addAction($act1);



$shade->addSection($sec1);
$shade->addSection($sec2);
$shade->addSection($sec3);
$shade->addSection($sec4);



?>



