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
define("SECTION_WINDOW","SECTION_WINDOW");
define("BLANK","BLANK");
define("INITIAL","INITIAL");

define("ACTION_NORMAL","ACTION_NORMAL");
define("ACTION_DROPDOWN","ACTION_DROPDOWN");
define("ACTION_GROUP","ACTION_GROUP");
define("ACTION_SPLIT","ACTION_SPLIT");
define("ACTION_FLAT","ACTION_FLAT");
define("ACTION_PANEL","ACTION_PANEL");

//Para los eventos del section, con esto se especifica el objeto destino 
define("FOOTER",'f');
define("HEADER",'h');
define("BODY",'b');

define("max",-1); // se usa en la funcion position de ovalo por ejemplo

define("PUBLIC_SHADE",0);
define("PRIVATE_SHADE",1);

/* SECTIONS */
define("NORMAL", "normal");
define("NML", "normal");
define("TAB", "tab");
define("MODAL", "modal");
define("MDL", "modal");
define("PILLS", "pills");
define("PLS", "pills");
define("CLP", "collapse");
define("COLLAPSE", "collapse");
define("PARALLAX", "parallax");
define("PRX", "parallax");
define("CAROUSEL","carousel");
define("CRL","carousel");
define("WINDOW","window");
define("WIN","window");

/* ACTIONS */
define("GROUP", "group");
define("GRP", "group");
define("DROPDOWN", "dropdown");
define("DPW", "dropdown");
define("SPLIT", "split");
define("SLT", "split");
define("FLAT", "flat");
define("FLT", "flat");
define("BUTTON", "button");
define("BTN", "button");
define("PANEL", "panel");
define("PNL", "panel");
/* OVERFLOW */
define("of_auto","auto");
define("of_hide","hidden");

/*---------------------------------------------------
	Globals Configurations
---------------------------------------------------*/



?>