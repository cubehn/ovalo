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

$shade->properties->title='Sections Internos';


$act1->properties->type=NORMAL;
$act1->properties->caption='Externo';
$act1->event->click('externo');

$act2->properties->type=NORMAL;
$act2->properties->caption='Interno';
$act2->event->click('interno');

$act3->properties->type=NORMAL;
$act3->properties->caption='Cerrar';
$act3->event->click('cerrar');

$sec1->properties->type=NORMAL;
$sec1->properties->header='Principal sec1';
$sec1->properties->debug=0;
$sec1->properties->title=icon::get('id-card').' Titulo';
$sec1->properties->subtitle='SubTitulo.';

$sec2->properties->type=WINDOW;
$sec2->properties->header='Inicio';
$sec2->properties->title='sec2';
$sec2->properties->subtitle='probando 1 2 3';
$sec2->properties->debug=0;
$sec2->style->bg_color(color::name('white'));
$sec2->embed()->script('El comando git fetch comunica con un repositorio remoto y obtiene toda la información que se encuentra en ese repositorio que no está en el tuyo actual y la almacena en tu base de datos local.
En primer lugar, observamos este comando en Traer y Combinar Remotos y seguimos viendo ejemplos de su uso en Ramas Remotas.');
$sec2->width(6);
//$sec2->style->shadow();
//$sec2->style->border_radius(0);
//$sec2->style->line_header(0);
//$sec2->style->bg_color_header(color::hexa('EEEEEE'));
$sec2->event->click('cerrar','close'); // max, min y close-> estos son los botones del modo window
$sec2->event->click('maximizar','max');

$sec3->properties->type=WIN;
$sec3->properties->header='Section Windows';
$sec3->properties->title='sec3';
$sec3->properties->debug=0;
$sec3->style->bg_color(color::name('silver'));
$sec3->embed()->script('El comando git pull es básicamente una combinación de los comandos git fetch y git merge, donde Git descargará desde el repositorio remoto especificado y a continuación, de forma inmediata intentará combinarlo en la rama en la que te encuentres.');
$sec3->style->justify_footer();
$sec3->style->line_header(1,color::name('gray'));
$sec3->width(6);

$sec4->properties->type=WIN;
$sec4->properties->header='Prueba con Multiples Ventanas';
$sec4->properties->title='sec4';
$sec4->properties->debug=0;
$sec4->embed()->script('Por último, mencionamos muy rápidamente que se puede utilizar la opción --verify-signatures con el fin de verificar qué commits que estás descargando han sido firmados con GPG en Firmando Commits.');
$sec4->width(6);
$sec4->style->bg_color(color::rgba(200,135,29));

//--------------------------------------------------------------
//ESTRUCTURA, ASOCIACIONES

$sec1->addAction($act1);
$sec2->addAction($act3);


$shade->addSection($sec2);
$shade->addSection($sec3);
$shade->addSection($sec4);

$shade->addSection($sec1);




?>



