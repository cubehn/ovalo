<?php
    
    use core\kernel\ovalo;

    $sec1 = ovalo::section('sec1');

    

    if($sec1->getVar('contador')==''){
    	$sec1->setVar('contador',1);
    }else{
    	if($sec1->getVar('contador')>=4){
    		$sec1->setVar('contador',1);	
    	}else{
    		$sec1->setVar('contador',$sec1->getVar('contador')+1);
    	}
    }
    
    $n=$sec1->getVar('contador');
    if($n==4) $n2=1;
    else $n2=$n+1;

    $sec1->properties->subtitle='Contando de 1 a 4: ['.$n.']';

    $sec1->switchSections('sec'.$n2,'sec'.$n);
    
?>