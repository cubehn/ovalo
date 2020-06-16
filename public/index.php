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
// Make the DIV element draggable:
dragElement(document.getElementById("mainsec2"));


function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById("h"+elmnt.id.substr(4))) {
    // if present, the header is where you move the DIV from:
    document.getElementById("h"+elmnt.id.substr(4)).onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>