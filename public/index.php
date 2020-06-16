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



<script>
// todo section en modo window debe inicializar esta sentencia
dragElement(document.getElementById("mainsec2"));
dragElement(document.getElementById("mainsec3"));

function dragElement(elmnt){
  var p1=0,p2=0,p3=0,p4=0;
  if (document.getElementById("h"+elmnt.id.substr(4)))
    document.getElementById("h"+elmnt.id.substr(4)).onmousedown = dragMouseDown;
  else
    elmnt.onmousedown = dragMouseDown;

  function dragMouseDown(e){
    e = e || window.event;
    e.preventDefault();
    p3 = e.clientX;
    p4 = e.clientY;
    document.onmouseup = closeDragElement;
    document.onmousemove = elementDrag;
  }
  function elementDrag(e){
    e = e || window.event;
    e.preventDefault();
    p1 = p3 - e.clientX;
    p2 = p4 - e.clientY;
    p3 = e.clientX;
    p4 = e.clientY;
    elmnt.style.top = (elmnt.offsetTop - p2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - p1) + "px";
  }
  function closeDragElement(){
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>