<?php
    
    use core\kernel\ovalo;


    $sec2 = ovalo::section('sec2');

 
	$sec2->properties->title='OTRO TITULO';
	$sec2->properties->subtitle='Subtitulo de prueba en cambio dinamico';

	
	if($sec2->getHide()==1)
		$sec2->hide(0);
	else
		$sec2->hide(1);
?>