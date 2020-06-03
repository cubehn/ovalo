<?php
    
    use core\kernel\ovalo;

    $encabezado = ovalo::section('encabez');
	$shade = ovalo::shade('init');
    
    //llamados a procesos... mejorar esto seria que utilice el blackbox para hacer llamados no solo de procesos
	$shade->event->time('process7',5,'seg');

    $encabezado->style->shadow_title(2);

    if($encabezado->getVar('contador')==''){
    	$encabezado->setVar('contador',1);
    }else{
    	if($encabezado->getVar('contador')>=10){
    		$encabezado->setVar('contador',1);	
    	}else{
    		$encabezado->setVar('contador',$encabezado->getVar('contador')+1);
    	}
    }

    $encabezado->properties->subtitle='Concepto '.$encabezado->getVar('contador');
	$encabezado->properties->title=$encabezado->get('font_color_title'); // trabajar esta parte pensar una mejor forma de como obtener los valores del estivo del section

    if($encabezado->getHeight()==12){
    	$encabezado->width(6);	
    	$encabezado->height(6);	
    }else{
    	$encabezado->width(12);	
    	$encabezado->height(12);
    }

	

	//$encabezado->properties->title=$shade->event->get();
//hacer que se puedan asignar eventos desde aqui, por lo menos del shade para poder usar un timer

?>