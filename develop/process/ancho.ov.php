<?php
    
    use core\kernel\ovalo;


    $sec1 = ovalo::section('sec1');

    if($sec1->getWidth()==6)
		$sec1->width(12);
	else
		$sec1->width(6);
?>