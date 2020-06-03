<?php
use core\kernel\iclass\section;
use core\kernel\iclass\action;
use core\master\resources;
use core\master\icon;

$sectionPrincipal = new section('sprin');
$encabezado = new section('encabezado');
$prueba1 = new section('prueba1');
$prueba2 = new section('prueba2');
$prueba3 = new section('prueba3');
$parrafo = new section('pa');
$sec1 = new section('sec1');
$sec2 = new section('sec2');
$sec3 = new section('sec3');

$act1 = new action();
$act2 = new action();

$act1->properties->type=NORMAL;
$act1->properties->caption='Aceptar';
$act1->style->btn_color_Bootstrap('warning',1);

$act2->properties->type=NORMAL;
$act2->properties->caption='Cancelar';


$encabezado->properties->type=NORMAL;
$encabezado->width(12);
$encabezado->properties->header='Encabezado';
$encabezado->properties->title='PHP orientado a objetos';
$encabezado->properties->subtitle='Concepto';
//$encabezado->fixed()->position(0,0,0,0,1);
$encabezado->embed()->script('Realizar un centrado horizontal de un elemento es relativamente sencillo y, dependiendo del tipo de elemento, existen varias técnicas que permiten hacerlo. Por ejemplo, si es un elemento en línea bastaría con aplicarle al elemento la propiedad CSS de text-align: center; mientras que si es un elemento en bloque solo sería necesario definir un ancho o width para el elemento y margin: auto;');
//$encabezado->style->footer_background_color_RGBA(200,140,210);
$encabezado->style->footer_background_color_HEX('CD5C5C');
$encabezado->style->border_radius(3,1,1,0,0);
$encabezado->style->footer_line(4,'#FA8072','ridge');
$encabezado->style->footer_justify();


$prueba1->width(6);
$prueba1->properties->header='Encabezado gereral del Section<br>Doble linea en el header'.resources::getIcon('actions\build.png',3);
$prueba1->properties->title='Prueba de titulo de un Section';
$prueba1->properties->subtitle='Lugar para el subtitulo del section, revisando la paraciendia y la <br>funcionalidad en varias lineas.';
$prueba1->properties->debug=0;
$prueba1->style->bg_image('f8.jpg');
$prueba1->style->underground_color_RGBA(220,203,182,0.3);
$prueba1->style->border_radius(4,0); // ESTE ESTA FALLANDO
$prueba1->style->border(5,'gray','ridge');
$prueba1->style->shadow();
$prueba1->style->font_color_HEX('A0C5E3');
$prueba1->style->font_color_title_HEX('A0C5E3');
$prueba1->style->font_color_subtitle_HEX('A0C5E3'); //la clase text_mute impide que cambie el color
//$prueba1->style->narrow();
$prueba1->style->header_justify();
$prueba1->style->header_bg_color_RGBA(220,203,182,0.5);
$prueba1->style->header_line(3,'#A0C5E3','groove');
//actions
$prueba1->style->spacing(2);
//$prueba1->Fixed()->position(10,10,0,0,1);
$estilo = $prueba1->getStyle();


$prueba2->properties->header='Ejemplo';
$prueba2->width(6);
//$prueba2->addStyle($estilo);
$prueba2->style->bg_color_HEX('A3A4A2');


$prueba3->addStyle($estilo);


$parrafo->properties->type=NORMAL;
$parrafo->width(12);
$parrafo->properties->title='Administración y configuración';
$parrafo->embed()->script('Sin embargo, cuando hablamos de centrado vertical la historia es otra, ya que no resulta tan obvia la forma de conseguirlo. Anteriormente, era necesario posicionar de forma absoluta un elemento respecto a su contenedor y esto muchas veces genera problemas con el responsive design; pero desde la aparición de Flex en CSS este tipo de problemas se volvió cosa del pasado.');

$sec1->properties->type=NORMAL;
$sec1->width(6);
$sec1->style->font_color_title_HEX('AA5619');
$sec1->style->bg_color_HEX('DDD');
$sec1->properties->header='Opción';
$sec1->properties->title='Uso de los espacios de nombres: lo básico';
$sec1->properties->subtitle='Definición:';
$sec1->embed()->script('(PHP 5 >= 5.3.0, PHP 7)

Antes de hablar del uso de los espacios de nombres es importante entender cómo sabe PHP qué elemento del código del espacio de nombres se requiere. Se puede hacer una simple analogía entre los espacios de nombres de PHP y el sistema de ficheros. Existen tres maneras de acceder a un fichero en el sistema de ficheros:');
$sec1->style->border_radius(0);
$sec1->style->shadow();
//$sec1->style->border(0);

$sec2->properties->type=NORMAL;
$sec2->width(6);
$sec2->properties->header=resources::getIcon('apps/aim.png',4);
$sec2->properties->title='Menu';
$sec2->properties->subtitle='Lista de Opciones '.icon::get('car');
$sec2->embed()->script('Es un array asociativo que contiene las referencias a todas la variables que están definidas en el ámbito global del script. Los nombres de las variables son las claves del array.');
$sec2->style->border_radius(0);
//$sec2->style->border(0);

$sec3->properties->type=NORMAL;
$sec3->width(2);
$sec3->properties->header=resources::getIcon('apps/access.png',4);
$sec3->properties->title='Menu2';
$sec3->properties->subtitle=icon::get('book');
$sec3->embed()->script('En el proceso de crear un diseño web es muy común requerir cierto tipo de posicionamiento de los elementos en zonas específicas. Uno de los más requerido es el centrado absoluto de un elemento tanto horizontal como verticalmente.');
$sec3->style->border_radius(0);

$sectionPrincipal->properties->type=NORMAL;
$sectionPrincipal->width(6);
$sectionPrincipal->properties->title='Login';
$sectionPrincipal->properties->subtitle='Ingrese sus credenciales';
$sectionPrincipal->style->border_radius(0);
$sectionPrincipal->style->shadow();
$sectionPrincipal->style->bg_color_HEX('FFF');
//$sectionPrincipal->style->font_color('gray');
$sectionPrincipal->embed()->script('hola');
//$sectionPrincipal->style->border(0);


$encabezado->addActions([$act1,$act2]);
$encabezado->addSections([$sec1,$prueba2]);



$sectionPrincipal->addSections([$sec2,$sec3]);


$shade->addSections([$encabezado]);
$shade->addSections([
	$prueba1,
	$prueba3
]);




$shade->addSection($sectionPrincipal);


?>
