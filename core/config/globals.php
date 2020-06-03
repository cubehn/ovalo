<?php
/*---------------------------------------------------
	Globals Configurations

---------------------------------------------------*/
namespace core\config\globals;

use core\sentinel\sentinel;
sentinel::add(__FILE__);

class config{
	static $InternalParameters = [
		'version'=>'beta2 01.20200322',
		'root'=>''
	];
}

$c = new config;
return $c;

?>