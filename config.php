<?php
/*---------------------------------------------------
	Parameters
---------------------------------------------------*/
namespace ovalo\config;

use core\sentinel\sentinel;
sentinel::add(__FILE__);

class config
{
	static $parameters = 
	[
		'InitialShade' => 'init',
		'GlobalTitle' => 'Ovalo',
		'GlobalIcon' => 'indigovision_site-icon',
		'DebugMode' => true,
		'Language' => 'espanol',
	];
}




?>