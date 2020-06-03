<?php
namespace core\config\filesystem;
if(!isset($_SESSION)) session_start();
$_SESSION['ov_gsectionInfo']='';
/*---------------------------------------------------
	Constantes Iniciales
---------------------------------------------------*/
use core\sentinel\sentinel;
use core\kernel\Components;


require __DIR__.'/../sentinel.php';
sentinel::add(__FILE__);
require __DIR__.'/../kernel/vov2.php';


class FileSystem{
	static function initProcess(){
		require OVALO_CDIR.Components::$routes['ROV2619283']; //ovalo
	}
	static function initCore(){
		require OVALO_CDIR.Components::$routes['ROV2619283']; //ovalo
		require OVALO_CDIR.Components::$routes['ROV8090200']; //Keys
		require OVALO_CDIR.Components::$routes['ROV3001820']; //iclass
		require OVALO_CDIR.Components::$routes['ROV8127591']; //master - shade class
	}
	static function initConfig(){
		require __DIR__.'/../../'.Components::$routes['INT0036123']; //root
		require $_SERVER['DOCUMENT_ROOT'].$GLOBALS['Directory'].Components::$routes['ROV8739812'];
		require $_SERVER['DOCUMENT_ROOT'].$GLOBALS['Directory'].Components::$routes['ROV6392210'];
		require OVALO_CDIR.Components::$routes['RPV1377321'];
	}
	static function initEnvShades(){
		require OVALO_CDIR.Components::$routes['ROV6600214'];
		require OVALO_CDIR.Components::$routes['ROV5515503'];
	}
	
}

class Directory{
	static function get(){
		return [
			'comp'=>OVALO_CDIR.Components::$routes['VOV2211100'],
			'section'=>OVALO_CDIR.Components::$routes['VOV9027767'],
			'modes'=>OVALO_CDIR.Components::$routes['VOV1238172'],
			'debug'=>OVALO_CDIR.Components::$routes['VOV8827163'],
			'stShade'=>OVALO_CDIR.Components::$routes['VOV2001209'],
			'system'=>OVALO_CDIR.Components::$routes['VOV0026700'],
			'event'=>OVALO_CDIR.Components::$routes['VOV3338921'],
			'kernel'=>OVALO_CDIR.Components::$routes['ROV0000261'],
			'action'=>OVALO_CDIR.Components::$routes['VOV1067253'],
			'images'=>OVALO_CDIR.Components::$routes['VOV1001288'],
			'resources'=>OVALO_CDIR.Components::$routes['VOV0002819'],
			'icon'=>Components::$routes['REL0045112'],
			'image'=>Components::$routes['REL0006571']
		];
	}
}

?>