<?php

/**********************************************************
 	O V A L O
 	PHP Framework For CUBEHN
 
 	wwww.cubehn.com
 	22/03/2020
 ***********************************************************/

use core\sentinel\sentinel;
use core\config\filesystem\filesystem;
use core\config\globals\config as internalConfig;
use core\kernel\ovalo;
use core\master\Shade;
use ovalo\config\config;
use core\kernel\Components;

require __DIR__.'/../core/config/filesystem.php';


/*----------------------------------------------------------
	Internal Configutation
----------------------------------------------------------*/
FileSystem::initConfig();


/*----------------------------------------------------------
	Init Core
----------------------------------------------------------*/
FileSystem::initCore();



/**********************************************************
	Begin Initial Shade
**********************************************************/

$shade = new Shade();
require OVALO_CDIR.Components::$routes['ROV6600214'];
require OVALO_CDIR.Components::$routes['ROV5515503'];

if(isset($_GET['ovs']))
{
  $page = $_GET['ovs'];
}
else
{
  $page = config::$parameters['InitialShade'];
}
$begin = ovalo::OVinit($page);
include $begin;


$shade->begin();	




if(config::$parameters['DebugMode'])
{
	echo sentinel::showDebug();	
}

			


?>