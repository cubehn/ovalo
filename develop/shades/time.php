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
$act1->properties->caption='Aceptar';
$act1->event->mouseout(blackbox::process2('process4'));

$act2->properties->type=NORMAL;
$act2->properties->caption='Color 2';
$act2->event->mouseout(blackbox::process2('process5'));



$encabezado->properties->type=NORMAL;
$encabezado->width(6);
$encabezado->properties->header='Encabezado';
$encabezado->properties->title='PHP orientado a objetos';
$encabezado->properties->subtitle='Concepto';
$encabezado->embed()->script('Realizar un centrado horizontal de un elemento es relativamente sencillo y, dependiendo del tipo de elemento, existen varias técnicas que permiten hacerlo. Por ejemplo, si es un elemento en línea bastaría con aplicarle al elemento la propiedad CSS de text-align: center; mientras que si es un elemento en bloque solo sería necesario definir un ancho o width para el elemento y margin: auto;');
$encabezado->style->font_subtitle('"Lucida Console"');
$encabezado->style->footer_background_color_HEX('CD5C5C');
$encabezado->style->border_radius(3,1,1,0,0);
$encabezado->style->footer_line(4,'#FA8072','ridge');
$encabezado->style->font_size_subtitle('40px');

$encabezado->event->click(
	blackbox::capsule([
		blackbox::switchSection($encabezado,$sec1),
		blackbox::hideSection($sec2), //ahora acepta tanto el objeto section como el nombre section en string
		blackbox::process2('process4')
	]),BODY
);



$sec1->properties->type=NORMAL;
$sec1->width(8);
$sec1->properties->header='Prueba de varios sections';
$sec1->properties->title='titulo del section';
$sec1->properties->subtitle='Probando123';

$sec2->properties->type=NORMAL;
$sec2->properties->title='';
$sec2->width(8);
$sec2->embed()->script('¿Qué son los estilos CSS de las páginas web?
El estilo de las páginas web, es decir la forma en que el navegador representa los elementos que la componen.
Se define mediante CSS, Cascading Style Sheets (en español Hojas de Estilo en Cascada). 
No es imprescindible el uso de CSS ya que si el navegador no lo encuentra utilizará el estilo predeterminado, pero la gran mayoría de las páginas en internet lo emplean.
No son más que instrucciones que pueden estar impregnados en el código fuente (HTML) o en un archivo externo al que la página hace referencia.
La gran limitación de CSS, es que después que se cargue la página el usuario no tendrá ningún tipo de control sobre el estilo empleado en esta.
Javascript ofrece la posibilidad, gracias a ser un lenguaje interactivo, de permitir realizar cualquier tipo de modificación en el estilo original de una página y además sin que sea necesario en lo absoluto volver a cargar la página del servidor.
Es posible modificar el tamaño, el estilo, el tipo de fuente y todos los demás atributos del texto, además el color del fondo, estructura de tablas, listas, en fin el estilo de todos los elementos que componen la página.
Para que el usuario pueda realizar estas modificaciones puede utilizarse cualquier evento, desde un clic del ratón, botones, vínculos y cualquier otro método con que se pueda trasmitir una instrucción.');

//los eventos que usan el teclaso se puede especificar la tebla que hara la accion
$shade->event->time(blackbox::process2('process4'),0.5,'min');
$shade->event->time(blackbox::process2('process5'),1,'min');
//$shade->event->time(blackbox::hideSection('encabez'),9,'seg');



$encabezado->addActions([$act1,$act2]);

$shade->addSections([$encabezado,$sec1,$sec2]);




?>

