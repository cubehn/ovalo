<?php
namespace core\master;

use core\config\filesystem\Directory;
use ovalo\config\config;
use core\kernel\ovalo;
use core\sentinel\sentinel;
sentinel::add(__FILE__);


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
class Control{
	private static $idShades;
	private static $idSections;
	private static $idActions;
	static function getNextIdShade(){
		if(!isset(self::$idShades)) self::$idShades=1;
		else self::$idShades+=1;
		return self::$idShades;
	}
	static function getNextIdSection(){
		if(!isset(self::$idSections)) self::$idSections=1;
		else self::$idSections+=1;
		return self::$idSections;
	}
	static function getNextIdAction(){
		if(!isset(self::$idActions)) self::$idActions=1;
		else self::$idActions+=1;
		return self::$idActions;
	}
}

class shade_properties{
	public $title;
	public $icon;
}
class s_events{
	private $events;
	function load($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'load','code'=>$bb,'obj'=>'shade','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Shade Event[load] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function unload($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'unload','code'=>$bb,'obj'=>'shade','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Shade Event[unload] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function resize($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'resize','code'=>$bb,'obj'=>'shade','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Shade Event[resize] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function keypress($bb,$key='ALL'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'keypress','code'=>$bb,'obj'=>'shade','subItem'=>'','key'=>$key];
		}
		else
		{
			sentinel::registerER('Shade Event[keypress] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function keydown($bb,$key='ALL'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'keydown','code'=>$bb,'obj'=>'shade','subItem'=>'','key'=>$key];
		}
		else
		{
			sentinel::registerER('Shade Event[keydown] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function keyup($bb,$key='ALL'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'keyup','code'=>$bb,'obj'=>'shade','subItem'=>'','key'=>$key];
		}
		else
		{
			sentinel::registerER('Shade Event[keyup] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function time($bb,$time,$lap='seg'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events);
			$this->events[$co]=['useFile'=>'0','name'=>'time','code'=>$bb,'obj'=>'shade','subItem'=>'','lap'=>$lap,'time'=>$time];
		}
		else
		{
			sentinel::registerER('Shade Event[time] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	
	function get(){
		if(isset($this->events))$r=$this->events;
		else $r='';
		return $r;
	}
}
class Shade{
	private $i_name;
	private $i_sections;
	private $i_height;
	private $i_scope;
	public $ev;
	public $text;
	public $title;
	public $properties;
	public $event;
	function __construct(){
		sentinel::InitER();
		$name='s'.Control::getNextIdShade();
		$this->i_name=$name;
		$this->properties = new shade_properties;
		$this->i_height='';
		$this->event=new s_events;
		$this->i_height=0;
	}
	function s_name($name){
		$this->i_name=$name;
	}
	function g_name(){
		return $this->i_name;
	}
	private function getText(){
		$r='';
		if(isset($this->text)){
			$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/text.sys.php','text.sys.php');
			$i=ovalo::OVreepNDDJ('text',$this->text,$i);
			$r=$i;
		}
		return $r;
	}
	private function getTitle(){
		$r='';
		if(isset($this->properties->title))
			if($this->properties->title!='')
			$r='<title>'.$this->properties->title.'</title>';
		return $r;
	}
	private function getIcon(){
		$r='';
		/*
		if(isset($this->properties->icon))
			if($this->properties->icon!=''){
				$ir='../develop/resources/icons/'.$this->properties->icon.'/ficon.sys.php';
				$i=ovalo::OVextractNDDJ_SH($ir,'ficon.sys.php');
				$i=ovalo::OVreepNDDJ('ficon',$ir,$i);
				$r=$i;
			}
			*/
		return $r;
	}
	function scope($v){
		$this->i_scope=$v;
	}
	function addSections($ss){
		for($i=0;$i<count($ss);$i++)
		$this->addSection($ss[$i]);
	}
	function addSection($section){
		if(!isset($_SESSION['ov_gsectionInfo'][$section->g_name()]))
		{
			$this->i_sections[$section->g_name()]=$section;
			$_SESSION['ov_gsections']=$this->i_sections;
			if(isset($section->i_include)){
				$_SESSION['ov_gsectionInfo'][$section->g_name()]['code']=$section->i_include->getInfo()['code'];
				$_SESSION['ov_gsectionInfo'][$section->g_name()]['type']=$section->i_include->getInfo()['type'];
			}
		}
		else
		{
			sentinel::registerER('Section ['.$section->g_name().']',config::$parameters['Language'],10);
		}
	}
	function activateHeightUse(){
		$this->i_height=1;
	}
	function useStructure($st){
		$this->i_structure=$st;
	}
	function getEventsObjects(){
		$r = '';
		if($this->event->get()<>''){
			$r = $this->event->get();
		}
		return $r;
	}
	function eventsPrepare($eo,$name,$isShade=0,$init_secs=''){
		//eventos especiales
		$INIT = '';
		$KEY = '';
		if($eo['name']=='load')$INIT='INIT("'.$init_secs.'");';
		if($eo['name']=='keydown')$KEY='event';


		//estructura de ejecucion
		if($isShade==0)
			$ev = 'document.getElementById("[[sec]]").addEventListener("[[event]]",function(){bbprocess("[[process]]","eventObjs","[[sec]]");}, true);';
		else
			if($eo['name']=='time')
				$ev = 'setTimeout(function(){bbprocess("[[process]]","eventObjs","[[sec]]");},[[TIME]]);';
			else
				$ev = 'window.addEventListener("[[event]]",function('.$KEY.'){'.$INIT.'[[key]]bbprocess("[[process]]","eventObjs","[[sec]]");[[ckey]]}, true);';

		//valores
		$ev_sec = $eo['subItem'].$name;
		$ev_event = $eo['name'];
		$ev_process = $eo['code'];
		$ev_obj = $eo['obj'];

		sentinel::registerTest($ev_obj.' '.$ev_sec,$ev_event.': '.substr($ev_process, 14,strlen($ev_process)-15));

		//excepcion si es time
		if($eo['name']=='time')
		{
			switch($eo['lap']){
				case 'seg':
					$n = 1000;
					break;
				case 'min':
					$n = 60000;
					break;
			}

			$t = $eo['time']*$n;	
			$ev = ovalo::OVreepNDDJ('TIME',$t,$ev);
		}
		//cuando tiene filtro de ejecucion
		if(isset($eo['key'])){
			$ev_key = $eo['key'];
			if($ev_key=='ALL'){$k=''; $ck='';}
			else{$k='if(event.key=="'.$ev_key.'"){'; $ck='}';}
			$ev = ovalo::OVreepNDDJ('key',$k,$ev);
			$ev = ovalo::OVreepNDDJ('ckey',$ck,$ev);
		}

		$ev = ovalo::OVreepNDDJ('sec',$ev_sec,$ev);
		$ev = ovalo::OVreepNDDJ('event',$ev_event,$ev);
		$ev = ovalo::OVreepNDDJ('process',$ev_process,$ev);

	sentinel::registerTest($ev_event,$ev);

		return $ev;
	}
	function begin($devSpot=0){
		$init_secs='';
		$style='';
		$this->ev['visible']='';
		$this->ev['noVisible']='';
		$this->ev['load']='';
		$this->ev['sizeMinor']='';
		$this->ev['sizeHigher']='';

		$ev = '';

		if(isset($this->i_sections)){
			foreach ($this->i_sections as $s){
				$style = $style.$s->getCSS();
				$init_secs=$init_secs.$s->gEmptySections();//.'&'.$s->g_Name();
				$s->eventProcess();
				if($s->getEventScript()<>''){
					if(isset($s->getEventScript()['visible']))$this->ev['visible']=$this->ev['visible'].' '.$s->getEventScript()['visible'];
					if(isset($s->getEventScript()['noVisible']))$this->ev['noVisible']=$this->ev['noVisible'].' '.$s->getEventScript()['noVisible'];
					if(isset($s->getEventScript()['sizeMinor']))$this->ev['sizeMinor']=$this->ev['sizeMinor'].' '.$s->getEventScript()['sizeMinor'];
					if(isset($s->getEventScript()['sizeHigher']))$this->ev['sizeHigher']=$this->ev['sizeHigher'].' '.$s->getEventScript()['sizeHigher'];
					if(isset($s->getEventScript()['load']))$this->ev['load']=$this->ev['load'].' '.$s->getEventScript()['load'];
				}
				//eventos de sections y actions
				if($s->getEventsObjects()<>''){
					foreach ($s->getEventsObjects() as $eo) { // por cada section dentro del shade
						$ev = $ev.$this->eventsPrepare($eo,$s->g_name());
						foreach ($s->getActions() as $eo2) { // por cada action dentro del section
							foreach ($eo2->getEventsObjects() as $eo3) { //por cada event de cada action
								$ev = $ev.$this->eventsPrepare($eo3,$eo2->g_name());
							}
						}
					}
				}else{
					foreach ($s->getActions() as $eo2) { // por cada action dentro del section
						if($eo2->getEventsObjects()<>''){
							foreach ($eo2->getEventsObjects() as $eo3) { //por cada event de cada action
								$ev = $ev.$this->eventsPrepare($eo3,$eo2->g_name());
							}
						}
					}
				}
			}
			$init_secs=substr($init_secs,1);		
		}
		//eventos de shade
		$evLoad=0;
		if($this->getEventsObjects()<>''){
			foreach ($this->getEventsObjects() as $eo) {
				if($eo['name']=='load')$evLoad=1;
				$ev = $ev.$this->eventsPrepare($eo,$this->g_name(),1,$init_secs);
			}
		}
		//eventos obligatorios del sistema
		if($evLoad==0){
			$systemOv='window.addEventListener("load",function(){ INIT("'.$init_secs.'")},true);';
			//este evento debe ser activado mediante metodo en el shade...... pendiente de hacer!. es para que las propiedades height funcionen
			if($this->i_height==1){
				$systemOv=$systemOv.'document.getElementById("xmain").style.height=$(window).height()+"px";
				window.addEventListener("resize", function() {
					document.getElementById("xmain").style.height=$(window).height()+"px";
				});';
			}
			$systemOv=$systemOv.'//';
			$ev = $ev.$systemOv;	
		}
		
		


		$eventsbb="<script>$(document).ready(function(){";
			//load
			$eventsbb=$eventsbb.$this->ev['load'];
			$eventsbb=$eventsbb.$this->ev['sizeMinor'];
			$eventsbb=$eventsbb.$this->ev['sizeHigher'];

		if($this->ev['sizeMinor']<>'' or $this->ev['sizeHigher']<>''){ //resize
			$eventsbb=$eventsbb."window.addEventListener('resize', function() {";
			$eventsbb=$eventsbb.$this->ev['sizeMinor'];
			$eventsbb=$eventsbb.$this->ev['sizeHigher'];
			$eventsbb=$eventsbb."});";
		}
		if($this->ev['visible']<>'' or $this->ev['noVisible']<>''){ //scroll
			$eventsbb=$eventsbb."document.addEventListener('scroll', function() {";
			$eventsbb=$eventsbb.$this->ev['visible'];
			$eventsbb=$eventsbb.$this->ev['noVisible'];
			$eventsbb=$eventsbb."});";
		}
		$eventsbb=$eventsbb."});</script>";

		$eventsbb=$eventsbb.'<script>'.$ev.'</script>';
		
		$blackbox = ovalo::OVextractNDDJ_SH(Directory::get()['kernel'].'/blackbox.php','blackbox.php');
		
		$blackbox = ovalo::OVreepNDDJ("eventsbb",$eventsbb,$blackbox);
		

		$head = ovalo::OVextractNDDJ_SH(Directory::get()['comp'].'/header.php','header.php');
		$head = $head.$this->getIcon().$this->getTitle();
		$scripts = ovalo::OVextractNDDJ_SH(Directory::get()['comp'].'/scripts.php','scripts.php');

		$sh=ovalo::OVextractNDDJ_SH(Directory::get()['stShade'].'/'.$this->i_structure.'.shade.php',sentinel::alert(1,$this->i_structure));

		$sh=ovalo::OVreepNDDJ('SHADE',$this->g_name(),$sh);
		$sh=ovalo::OVreepNDDJ('HEADER',$head,$sh);
		$sh=ovalo::OVreepNDDJ('STYLE',$style,$sh);
		$sh=ovalo::OVreepNDDJ('HEIGHT',$this->i_height,$sh);
		$sh=ovalo::OVreepNDDJ('SCRIPTS',$scripts,$sh);
		$sh=ovalo::OVreepNDDJ('BB',$blackbox,$sh);
		if(sentinel::hasErrors()==0)
		{
			$sh=ovalo::OVreepNDDJ('CONSTRUCT',$this->getText().$this->process($devSpot),$sh);
		}
		else{
			$sh=ovalo::OVreepNDDJ('CONSTRUCT','Existen Errores.',$sh);	
		}

		//$sh=ovalo::OVreepNDDJ('INIT_SECS',$init_secs,$sh);
		
		echo $sh;
	}
	function process($devSpot){
		$r='';
		if(isset($this->i_sections)){
			foreach ($this->i_sections as $s) {
				$r=$r.$s->getHtml();
			}
		}else{
			if($devSpot==0)
			echo sentinel::readMessage(config::$parameters['Language'],5);
		}
		return $r;
	}
	function createComponent($ishade,$idats){
		$rx='';
		$r='';
		for($i=0;$i<count($idats);$i++){
			$shade = new Shade();
			//include '../dev/config.php';
			//include '../dev/globals.php';
			$in='../dev/shades/'.$ishade.'.php';
			$file=ovalo::OVdepNDDJ($in);
			if($file!='')include $file;
			$r=$shade->process(0);
			 

			 $r=ovalo::OVreepNDDJ('ID',$i,$r,'{{','}}');
			 foreach ($idats[$i] as $f) {
			 	$r=ovalo::OVreepNDDJ($f['name'],$f['val'],$r,'{{','}}');
			 }
			 

			$rx=$rx.$r;
		}
		$rx='<div class="row">'.$rx.'</div>';
		return $rx;
	}
}

class icon{
	static function get($n){
		$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/icon-fa.sys.php','icon-fa.sys.php');
		$i=ovalo::OVreepNDDJ('icon',$n,$i);
		return $i;
	}
}
class video{
	static function youtube($n,$a='21by9'){
		$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/video.sys.php','video.sys.php');
		$i=ovalo::OVreepNDDJ('url','https://www.youtube.com/embed/'.$n,$i);
		$i=ovalo::OVreepNDDJ('aspect',$a,$i);
		return $i;	
	}
	static function get($n){
		$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/video.sys.php','video.sys.php');
		$i=ovalo::OVreepNDDJ('url',$n,$i);
		return $i;	
	}
}
class resources{
	static function getVideo($n){
		$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/video.sys.php','video.sys.php');
		$i=ovalo::OVreepNDDJ('url',Directory::get()['resources'].'videos/'.$n,$i);
		return $i;
	}
	static function getImage($n,$width){
		$n='../develop/resources/images/'.$n;
		$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/img.sys.php','img.sys.php');
		$i=ovalo::OVreepNDDJ('img',$n,$i);
		$i=ovalo::OVreepNDDJ('width','width="'.$width.'"',$i);
		
		return $i;
	}
	static function getIcon($n,$t=1){
		$r=0;
		switch($t){
			case 1:{$r=22;break;}
			case 2:{$r=32;break;}
			case 3:{$r=48;break;}
			case 4:{$r=64;break;}
			case 5:{$r=128;break;}
			default:{$r=22;break;}
		}
		$rt=Directory::get()['icon'].$n;
		$i = '';
		if(file_exists($rt))
		{
			$i=ovalo::OVextractNDDJ_SH(Directory::get()['system'].'/icon.sys.php','icon.sys.php');
			$i=ovalo::OVreepNDDJ('icon',$rt,$i);
			$i=ovalo::OVreepNDDJ('size',$r,$i);
		}
		else
		{
			sentinel::registerER('Resources [getIcon]: '.$n,config::$parameters['Language'],14);
		}
		
		return $i;	
	}
}




class debug{
	static function getModal(){
		$modal='';
		$er=sentinel::getER();
		if(count($er)>0){
			if(!isset($er['m'])){
				$list = file_get_contents(Directory::get()['debug'].'/list.debug.php');
				
				$item2='';
				foreach ($er as $e) {
					$item = file_get_contents(Directory::get()['debug'].'/item.debug.php');
					$item2=$item2.$item=str_replace("[[item]]",$e['obj'].'<br>'.$e['msg'],$item);
				}
				$list=str_replace("[[list]]",$item2,$list);

				$modal = file_get_contents(Directory::get()['debug'].'/modal.debug.php');
				$modal=str_replace("[[title]]",sentinel::readMessage(config::$parameters['Language'],6),$modal);
				$modal=str_replace("[[close]]",sentinel::readMessage(config::$parameters['Language'],7),$modal);
				$modal=str_replace("[[body]]",$list,$modal);
			}
		}
		echo $modal;
	}
}


class repeat
{
	static function times($obj,$v)
	{
		$r = '';
		for($i=0;$i<$v;$i++)
		{
			$iobj = $obj;
			$iobj=str_replace("{{t}}",$i,$iobj);
			$r=$r.$iobj;
		}
		return $r;
	}
	static function spot($sp,$d)
	{
		$r = '';
		$fields = Array();
		$base = file_get_contents('../develop/spots/'.$sp.'.spot.html');
		foreach ($d as $n) 
		{
			if(count($fields)==0)
			{
				$fields=$n;	
			}
			else
			{
				$ibase = $base;
				for($i=0;$i<count($fields);$i++)
				{
					$ibase=str_replace("{{".$fields[$i]."}}",$n[$fields[$i]],$ibase);
				}
				
				$r = $r.$ibase;
			}
		}
		return $r;
	}
}

?>