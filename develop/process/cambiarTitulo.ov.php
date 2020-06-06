<?php
    
    use core\kernel\ovalo;
    use core\kernel\color;


    $sec1 = ovalo::section('sec1');


	$sec1->properties->title='Nuevo titulo';
	$sec1->style->justify_header();
	$sec1->style->line_header(2,color::name('red'),'dotted');
	$sec1->style->bg_color_header(color::hexa('FFDDFF'));
	$sec1->style->font_title('Times New Roman');
	$sec1->style->font_size_title(20);
	$sec1->style->font_size_header(20);
	$sec1->style->align_title('center');
	$sec1->style->decoration_title('overline',color::name('blue'),'wavy');
	$sec1->style->decoration_subtitle('overline underline');
	$sec1->style->decoration_header('underline');
	$sec1->style->align_subtitle('right');
	$sec1->style->bg_color_subtitle(color::name('white'));
	$sec1->style->bg_color_title(color::name('gray'));
	$sec1->style->bold_title(1);
	$sec1->style->bold_subtitle(1);
	$sec1->style->bold_header(1);
	$sec1->style->shadow_title(5);
	$sec1->style->shadow_subtitle(7);
	$c1=color::rgba(124);
	$sec1->style->shadow_header(3,$c1);
	$sec1->style->font_subtitle('Calibri');
	$sec1->style->font_size_subtitle(18);
	$sec1->style->font_color_subtitle(color::hexa('FFE189'));
	$sec1->style->font_color_title(color::hexa('FFFFFF'));
	$c3=color::name('red');
	$sec1->style->font_color_header($c3);
	$sec1->style->bg_color(color::name('silver'));

?>
