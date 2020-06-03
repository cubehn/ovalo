<?php
    
    use core\kernel\ovalo;


    $sec2 = ovalo::section('sec2');

 
	$sec2->properties->title='titulo del section';
	$sec2->properties->subtitle='Subtitulo de prueba en cambio dinamico';

	
	if($sec2->getFlow()==1)
		$sec2->flow(0);
	else
		$sec2->flow(1);
?>