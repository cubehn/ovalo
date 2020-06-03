<?php
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\kernel\iclass\form;
use core\kernel\iclass\blackbox;
use core\master\repeat;
use core\master\resources;
use core\master\icon;


$encabezado = new section('encabezado');
$prueba1 = new section('prueba1');
$sec1 = new section('sec1');
$s1 = new section('s1');


$act1 = new action('act1');
$act2 = new action('act2');
$act3 = new action('act3');

$act1->properties->type=NORMAL;
$act1->properties->caption='Aceptar';
$act1->style->btn_color_Bootstrap('warning',1);
$act1->style->spacing(0);
//$act1->style->Padding(10,10,10,10);
$act1->width(6);
$act1->style->align('right');

$act2->properties->type=NORMAL;
$act2->properties->caption='Cancelar';
$act2->properties->icon='book';
$act2->properties->description='Prueba de descipcion de un action';
$act2->width(6);
$act2->style->spacing(0);

$act3->properties->type=NORMAL;
$act3->properties->caption='Siguiente';
$act3->properties->icon='book';
$act3->properties->description='Prueba de descipcion de un action';
$act3->width(6);

$act3->event->click(blackbox::test($prueba1));


$s1->properties->type=NORMAL;
$s1->properties->title='javier';

$encabezado->properties->type=NORMAL;
$encabezado->width(12);
$encabezado->properties->header='Encabezado';
$encabezado->properties->title='PHP orientado a objetos';
$encabezado->properties->subtitle='Concepto';
//$encabezado->fixed()->position(0,0,0,0,1);
$encabezado->embed()->script('Realizar un centrado horizontal de un elemento es relativamente sencillo y, dependiendo del tipo de elemento, existen varias técnicas que permiten hacerlo. Por ejemplo, si es un elemento en línea bastaría con aplicarle al elemento la propiedad CSS de text-align: center; mientras que si es un elemento en bloque solo sería necesario definir un ancho o width para el elemento y margin: auto;');
$encabezado->style->font_subtitle('"Lucida Console"');
$encabezado->style->footer_background_color_HEX('CD5C5C');
$encabezado->style->border_radius(3,1,1,0,0);
$encabezado->style->footer_line(4,'#FA8072','ridge');
$encabezado->style->font_size_subtitle('40px');


$prueba1->width(6);
$prueba1->properties->header='Encabezado gereral del Section<br>Doble linea en el header'.resources::getIcon('actions\build.png',3);
$prueba1->properties->title='Prueba de titulo de un Section';
$prueba1->properties->subtitle='Lugar para el subtitulo del section, revisando la paraciendia y la <br>funcionalidad en varias lineas.';
//$prueba1->properties->debug=0;

//repeat::times('<h2>hola {{t}}</h2>',5)
/*
$prueba1->embed()->script(
	repeat::spot('test',[
		['name','lastname','color'],
		['name'=>'nombre1','lastname'=>'apellido1','color'=>'info'],
		['name'=>'nombre2','lastname'=>'apellido2','color'=>'danger'],
		['name'=>'nombre3','lastname'=>'apellido3','color'=>'primary'],
		['name'=>'nombre4','lastname'=>'apellido4','color'=>'success']
	])
);*/
/*
$prueba1->embed()->script(
	repeat::spot('formulario',[
		['name','lastname','color'],
		['name'=>'nombre1','lastname'=>'apellido1','color'=>'info']
	])
);*/

$prueba1->embed()->script(
	form::create($prueba1->g_name(),'input',[
		[
			'type'=>'text',
			'id'=>'n1',
			'caption'=>'ejemplo',
			'description'=>'prueba de form',
			'change'=>'process1',
			'actions'=>[]
		],
		[
			'type'=>'text',
			'id'=>'n2',
			'caption'=>'ejemplo2',
			'description'=>'prueba de form2'
		]
	])
);

/*
CODIGO BB

n2.val=n1.val
prueba1.show
ó
Asociar process y dentro del process usar codigo php para la logica

*/

$prueba1->style->bg_image('f8.jpg');
$prueba1->style->border_radius(4,0); // ESTE ESTA FALLANDO
$prueba1->style->border(5,'gray');
$prueba1->style->shadow();
$prueba1->style->font_color_HEX('A0C5E3');
$prueba1->style->font_color_title_HEX('A0C5E3');
$prueba1->style->font_color_subtitle_HEX('A0C5E3'); //la clase text_mute impide que cambie el color
$prueba1->style->header_justify();
$prueba1->style->header_bg_color_RGBA(220,203,182,0.5);
$prueba1->style->header_line(3,'#A0C5E3','groove');





$sec1->properties->type=NORMAL;
//$sec1->width(6);
$sec1->style->font_color_title_HEX('AA5619');
$sec1->style->bg_color_HEX('DDD');
$sec1->properties->header='Opción';
$sec1->properties->title='Uso de los espacios de nombres: lo básico';
$sec1->properties->subtitle='Definición:';
$sec1->embed()->script('(PHP 5 >= 5.3.0, PHP 7)

Antes de hablar del uso de los espacios de nombres es importante entender cómo sabe PHP qué elemento del código del espacio de nombres se requiere. Se puede hacer una simple analogía entre los espacios de nombres de PHP y el sistema de ficheros. Existen tres maneras de acceder a un fichero en el sistema de ficheros:');
$sec1->style->border_radius(0);



$prueba1->addActions([$act1,$act2,$act3]);

$sec1->addSection($prueba1);
$encabezado->addSections([$sec1]);





$shade->addSections([$encabezado]);




?>

