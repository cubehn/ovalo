<?php
/*---------------------------------------------------
	Constantes Iniciales
---------------------------------------------------*/
use core\sentinel\sentinel;
sentinel::add(__FILE__);

define('OVALO_INIT', microtime(true));
define('OVALO_TIC',substr(OVALO_INIT,-4));
define('OVALO_PLACE', __DIR__);
define('OVALO_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('OVALO_DIR', $GLOBALS['Directory']);
define('OVALO_CDIR', $_SERVER['DOCUMENT_ROOT'].$GLOBALS['Directory']);
define('OVALO_FILETYPE_SECTION', '.section.php');
define('OVALO_FILETYPE_COMPL', '.complement.section.php');

define("SECTION_NORMAL","SECTION_NORMAL");
define("SECTION_PILLS","SECTION_PILLS");
define("SECTION_TAB","SECTION_TAB");
define("SECTION_MODAL","SECTION_MODAL");
define("SECTION_COLLAPSE","SECTION_COLLAPSE");
define("SECTION_BUTTON","SECTION_BUTTON");
define("SECTION_PARALLAX","SECTION_PARALLAX");
define("SECTION_CAROUSEL","SECTION_CAROUSEL");
define("BLANK","BLANK");
define("INITIAL","INITIAL");

define("ACTION_NORMAL","ACTION_NORMAL");
define("ACTION_DROPDOWN","ACTION_DROPDOWN");
define("ACTION_GROUP","ACTION_GROUP");
define("ACTION_SPLIT","ACTION_SPLIT");
define("ACTION_FLAT","ACTION_FLAT");
define("ACTION_PANEL","ACTION_PANEL");


define("FOOTER",'f');
define("HEADER",'h');
define("BODY",'b');
/*---------------------------------------------------
	Globals Configurations
---------------------------------------------------*/



?>