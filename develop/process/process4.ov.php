<?php
    
    use core\kernel\ovalo;

    $encabezado = ovalo::section('encabez');
    $sec1 = ovalo::section('sec1');


    $encabezado->properties->header='Encabezado2'.'<a href="#">link</a>';
	$encabezado->properties->title='Encabezado2';
	$encabezado->properties->subtitle='JAJAJA';
	$encabezado->style->footer_background_color_HEX('CCC');
	$encabezado->style->bg_image('f8.jpg');
	$encabezado->style->border(5,'gray');
	$encabezado->style->shadow();
	$encabezado->style->narrow(); //revisar no funciona igual que en shade
	$encabezado->style->shadow_title(3);
	$encabezado->style->underground_color_RGBA(100,100,100);
	$encabezado->style->font('Times new Roman');
	$encabezado->style->font_size(15);
	$encabezado->style->font_title('Arial');
	$encabezado->style->font_size_title(9);
	$encabezado->style->font_subtitle('Arial');
	$encabezado->style->font_size_subtitle(9);
	$encabezado->style->header_justify();
	$encabezado->style->header_line(2);
	$encabezado->style->narrow_footer();
	$encabezado->style->footer_justify();
	$encabezado->style->footer_line(5,'gray');
	$encabezado->style->border_radius(3);
	$encabezado->style->font_color_RGBA(230,123,200); //ver si es el mismo efecto desde el shade
	$encabezado->style->font_color_title_HEX('B5B9FF');
	$encabezado->style->font_color_subtitle_HEX('FFF5BA'); //no se si funciona porque el subtitulo tiene asociado una clase de bootstrap
	$encabezado->style->header_bg_color_HEX('BDFFD6');
	$encabezado->width(4);


	$sec1->properties->title='Cambio dinamicamente desde un action de otro section';
	
?>