<?php


use core\kernel\ovalo;


require __DIR__.'/../config/filesystem.php';
require __DIR__.'/../../root.php';
require __DIR__.'/../config/constants.php';
require __DIR__.'/../config/keys.php';
require __DIR__.'/../kernel/ovalo.php';


$process_name=$_POST['n'];
$process_params=$_POST['p'];

$ovReturnSTYLE='';
$others='';

//======================================================================
include __DIR__.'/../../develop/process/'.$process_name.'.ov.php';
//======================================================================
$ovReturnSTYLE = ovalo::getProcessReturns();

echo $ovReturnSTYLE;

?>