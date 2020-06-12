<?php
namespace core\kernel;

use core\config\filesystem\Directory;
use core\config\keys;
use ovalo\config\config;
use core\sentinel\sentinel;
sentinel::add(__FILE__);

class color{
	static function rgba($r=255,$g=255,$b=255,$a=1){
		$color = ['type'=>'rgba','cr'=>$r,'cg'=>$g,'cb'=>$b,'ca'=>$a,'ch'=>'','cn'=>''];
		return $color;
	}
	static function hexa($h='FFFFFF'){
		$color = ['type'=>'hexa','cr'=>'','cg'=>'','cb'=>'','ca'=>'','ch'=>$h,'cn'=>''];
		return $color;
	}
	static function name($n='white'){
		$color = ['type'=>'name','cr'=>'','cg'=>'','cb'=>'','ca'=>'','ch'=>'','cn'=>$n];
		return $color;
	}
	static function get($c){
		$color='';
		if(is_array($c))
		{
			if(isset($c['type']))
			{
				$type = $c['type'];	
				switch($type)
				{
					case 'rgba':
						$cr=$c['cr'];
						$cg=$c['cg'];
						$cb=$c['cb'];
						$ca=$c['ca'];
						$color="rgba($cr,$cg,$cb,$ca)";
						break;
					case 'name':
						$cn=$c['cn'];
						$color=$cn;
						break;
					case 'hexa':
						$ch=$c['ch'];
						$color="#$ch";
						break;
				}
			}
			else
			{
				//error, no es un color valido		
			}
		}
		else
		{
			//error, no es un color valido
		}
		return $color;
	}
}

class s_events{
	private $events;

	function time($bb,$time,$lap='seg'){
		$n=1;
		switch($lap){
			case 'seg':
				$n = 1000;
				break;
			case 'min':
				$n = 60000;
				break;
		}
		$time=$time*$n;
		//$w="setTimeout(function(){bbprocess('$bb','eventObjs','');},'$time');";

		$this->events = $this->events.$bb.';SEV001;'.$time.'|';
	}
	
	function get(){
		if(isset($this->events))$r=$this->events;
		else $r='';
		return $r;
	}
}
class i_shade{
	public $event;
	function __construct($name){
		$this->event = new s_events;
	}
	function getEvents(){
		return $this->event->get();
	}
}
class ovalo{
	static $html;
	static $htmls;
	static $ovFields;
	static $ovBDD;
	static $page;
	static $otherPages;
	static $iFile;
	static $internalFile;
	static $internalBDD;
	static $EventsObj;
	static public $ovAlert;
	static public $internalError;

	static function addEvent($ev,$sec,$obj,$script){
		$type='';
		if(strpos($script,'process:') === false){
			if(strpos($script,'javascript:') === false){
				$script='';
			}else{
				$script=str_replace('javascript:','',$script);
				$type='javascript';
			}
		}else{
			$script=str_replace('process:','',$script);
			$s=explode(',',$script);
			$type='process';
			$script='bbprocess("exec_process:'.$sec.'°'.$s[0].'°'.self::getFile($sec).'°'.$s[1].'#","event");';
		}
		//
		$ic=count(self::$EventsObj);
		self::$EventsObj[$ic]['sec']=$sec;
		self::$EventsObj[$ic]['obj']=$obj;
		self::$EventsObj[$ic]['ev']=$ev;
		self::$EventsObj[$ic]['script']=$script;
	}
	static function component($sec,$name,$dats){
		$e=self::OVextractNDDJ_SH($_SERVER['DOCUMENT_ROOT'].'test/dev/components/'.$name.'.ecom.html',$name.'ecom.php');
		
		$ii='';
		foreach($dats['data'] as $d){
			$i=self::OVextractNDDJ_SH($_SERVER['DOCUMENT_ROOT'].'test/dev/components/'.$name.'.icom.html',$name.'icom.php');
			foreach($dats['columns'] as $col){
				$i=ovalo::OVreepNDDJ($col,$d[$col],$i);
			}
			$ii=$ii.$i;
		}
		$e=ovalo::OVreepNDDJ('INTERNAL',$ii,$e);

		$fragment = self::html($sec)->createDocumentFragment();
		$fragment->appendXML($e);
		return $fragment;
	}
	static function getFile($name){
		return $_SESSION['ov_gsectionInfo'][$name]['file'];
	}
	static function BDD($name){
		if(sources::get($name)==''){
			self::$internalError='ERROR: [BDD] No se encuentra la configuración de base de datos ['.$name.']';
		}else{
			self::$ovBDD->define(sources::get($name)->getTYPE(),sources::get($name)->getCS())->credential(sources::get($name)->getUSER(),sources::get($name)->getPASS());
			self::$ovBDD->prepare();
		}
		return self::$ovBDD;
	}
	static function message($title,$msg,$position=1,$color='warning'){
		self::$ovAlert->message($title,$msg,$position,$color);
	}
	static function html($sec=''){
		$ret='';
		if($sec!=''){
			//si no existe lo crea
			$anx='';
			for($w=0;$w<count(self::$htmls);$w++){
				if(self::$htmls[$w]['sec']==$sec){
					$anx=self::$htmls[$w];
					$w=count(self::$htmls);
				}
			}

			$h=count(self::$htmls);
			if($anx==''){
				self::$htmls[$h]['doc'] = new DOMDocument();
				self::$htmls[$h]['sec'] = $sec;
				self::$htmls[$h]['file'] = self::getFile($sec);
				$url=$_SERVER['DOCUMENT_ROOT'].'test/dev/files/'.self::getFile($sec);
				self::$htmls[$h]['doc']->loadHTMLFile($url,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
				$ret=self::$htmls[$h]['doc'];
			}else{
				$ret=$anx['doc']; //aqui debe dar error porque no existe el section que se esta indicando
			}
		}else{
			$ret=self::$html;
		}
		return $ret;
	}
	static function viewFields($key){
		return self::$ovFields[$key]; //id, val o vals
	}
	static function OV_INIT_PROCESS($file,$ovDataSet){
		if($file!=''){self::$internalFile=1;self::$iFile=$file;}else{self::$internalFile=0;}
		self::$otherPages='';
		self::$ovFields = self::OVextractFields($ovDataSet->fields);
		self::$ovFields['fields']=$ovDataSet->fields;
		self::$ovBDD = new connections();
    	self::$ovAlert = new ovAlertClass();
		
		self::$html = new DOMDocument();
        $url=$_SERVER['DOCUMENT_ROOT'].'test/dev/files/'.$file;
		self::$html->loadHTMLFile($url);
		foreach(self::$ovFields['fields'] as $f){
            self::$html->getElementById($f->id)->setAttribute('value',$f->val);
        }
	}
	static function OV_END_PROCESS(){
		//asigna los eventos creados por el usuario
		if(isset(self::$EventsObj)){
			//$htmlEvents = new DOMDocument();
			//$url=$_SERVER['DOCUMENT_ROOT'].'test/dev/files/'.$file;
			//$htmlEvents->loadHTMLFile($url);
			for($ei=0;$ei<count(self::$EventsObj);$ei++){
				$se=self::$EventsObj[$ei]['sec'];
				$ob=self::$EventsObj[$ei]['obj'];
				$ev=self::$EventsObj[$ei]['ev'];
				$sc=self::$EventsObj[$ei]['script'];
				ovalo::html($se)->getElementById($ob)->setAttribute($ev,$sc);		
				//$htmlEvents->getElementById($ob)->setAttribute($ev,$sc);
			}
			//$htmlEvents->saveHTMLFILE($url);
		}


		//guarda los cambios html
		if(self::$internalFile==1)
		self::$page = self::$html->saveHTML();

		for($i=0;$i<count(self::$htmls);$i++){
			$url=$_SERVER['DOCUMENT_ROOT'].'test/Core/temp/'.self::$htmls[$i]['file'];
			self::$htmls[$i]['doc']->saveHTMLFile($url);
			self::$otherPages=self::$otherPages.'|'.self::$htmls[$i]['sec'];
		}
		
	}
	static function getHTML(){
		$ret='';
		if(self::$internalFile==1) $ret=self::$page;
		return $ret;
	}
	static function getOtherHTML(){
		$ret=self::$otherPages;
		return $ret;
	}
	static function isReadyFile(){
		return self::$internalFile;
	}
	static function OVinit($rShade)
	{
		$ret = 0;
		$in=OVALO_CDIR.Components::$routes['ROV7725102'].$rShade.'.php';
		$file=ovalo::OVdepNDDJ($in);
		return $file;
	}
	static function OVextractNDDJ_SH($rt,$m){
		$r='';
		if(file_exists($rt))$r=file_get_contents($rt);
		else sentinel::registerER($m,config::$parameters['Language'],9);
		return $r;
	}
	static function OVdepNDDJ($rt){
		$r='';
		if(file_exists($rt))$r=$rt;
		else sentinel::registerER($rt,config::$parameters['Language'],9);
		return $r;
	}
	static function OVreepNDDJ($key,$val,$c,$x1='[[',$x2=']]'){
		if (count($val)>1){
			var_dump($val);
		}else{
			$w=str_replace("$x1$key$x2",$val,$c);
			return $w;
		}
	}
	static function OVextractFields($fields){
		$return['vals']='';
		$return['val']='';
		$return['id']='';
		$one=0;
	
		foreach($fields as $f){
			if($one==1){
				$return['vals']=$return['vals'].',';
				$return['val']=$return['val'].',';
				$return['id']=$return['id'].',';
			}
			$one=1;
			if(isset($f->id) && isset($f->val))$return['vals']=$return['vals'].$f->id.'="'.$f->val.'"';
			if(isset($f->val)) $return['val']=$return['val'].'"'.$f->val.'"';
			if(isset($f->id)) $return['id']=$return['id'].$f->id;
		}
		
		return $return;
	}

	//NEW!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	static private $ProcessReturns;
	static private $ProcessObjects;

	static function getProcessReturns()
	{
		self::$ProcessReturns = '';
		if(count(self::$ProcessObjects)>0)
		{
			foreach (self::$ProcessObjects as $obj) {
				if($obj['type']=='shade')
				{
					self::$ProcessReturns = self::$ProcessReturns.$obj['obj']->getEvents().'¬';
				}
				if($obj['type']=='section')
				{
					self::$ProcessReturns = self::$ProcessReturns.$obj['obj']->getStyle().'¬';
					self::$ProcessReturns = self::$ProcessReturns.$obj['obj']->getProperties().'¬';
				}
			}
		}

		return self::$ProcessReturns;
	}

	static function section($name)
	{
		$cs = count(self::$ProcessObjects);
		self::$ProcessObjects[$cs]['name']=$name;
		self::$ProcessObjects[$cs]['type']='section';
		$obj = new isec($name);
		self::$ProcessObjects[$cs]['obj']=$obj;
		return $obj;
	}
	static function shade($name){
		$cs = count(self::$ProcessObjects);
		self::$ProcessObjects[$cs]['name']=$name;
		self::$ProcessObjects[$cs]['type']='shade';
		$obj = new i_shade($name);
		self::$ProcessObjects[$cs]['obj']=$obj;
		return $obj;
	}


	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
}

class isec
{
	public $style;
	public $section_name;
	public $properties;
	function __construct($xid)
	{
		$this->section_name = $xid;
		$this->style = new istyle;
		$this->properties = new isection_properties;
		$this->hide='';
		$this->flow='';
	}
	function switchSections($newSec,$withme='')
	{
		if($withme=='')
		{
			if($this->section_name!=$newSec)
			{
				$this->i_newsec=$newSec;
				$this->i_withme=$withme;		
			}
		}
		else{
			if($withme!=$newSec)
			{
				$this->i_newsec=$newSec;
				$this->i_withme=$withme;
			}
		}
		
	}
	function getProperties(){
		$ps = '';

		if(isset($this->properties->title))
		$ps = $ps.$this->section_name.';IPR001;'.$this->properties->title.'|';

		if(isset($this->properties->header))
		$ps = $ps.$this->section_name.';IPR002;'.$this->properties->header.'|';
		
		if(isset($this->properties->subtitle))
		$ps = $ps.$this->section_name.';IPR003;'.$this->properties->subtitle.'|';

		if(isset($this->properties->video))
		$ps = $ps.$this->section_name.';IPR006;'.$this->properties->video.'|';

		if(isset($this->properties->alert))
		$ps = $ps.$this->section_name.';IPR007;'.$this->properties->alert.'|';

		if(isset($this->properties->warning))
		$ps = $ps.$this->section_name.';IPR008;'.$this->properties->warning.'|';

		if(isset($this->properties->error))
		$ps = $ps.$this->section_name.';IPR009;'.$this->properties->error.'|';

		if(isset($this->width))
		$ps = $ps.$this->section_name.';IPR004;'.$this->width.'|';
		if(isset($this->height))
		$ps = $ps.$this->section_name.';IPR005;'.$this->height.'|';
		if($this->hide<>'')
		$ps = $ps.$this->hide.';SEV003;'.$this->section_name.'|';
		if($this->flow<>'')
		$ps = $ps.$this->flow.';SEV003;'.$this->section_name.'|';
		if(isset($this->i_include))
		$ps = $ps.$this->section_name.';SEV004;'.$this->section_name.'|';
		if(isset($this->i_newsec))
		{
			if($this->i_withme=='')
			{
				$ps = $ps.$this->section_name.';SEV005;'.$this->i_newsec.'|';
			}
			else
			{
				$ps = $ps.$this->i_withme.';SEV005;'.$this->i_newsec.'|';
			}
		}

		return $ps;
	}
	function setVar($var,$val){
		$_SESSION['ovsec'][$this->section_name]['vars'][$var]=$val;
	}
	function getVar($var){
		if(!isset($_SESSION['ovsec'][$this->section_name]['vars'][$var]))
			$ret='';
		else
			$ret=$_SESSION['ovsec'][$this->section_name]['vars'][$var];
		return $ret;
	}
	function embed()
	{
		if(!isset($this->i_include)) $this->i_include = new includes($this->section_name);
		return $this->i_include;
		//$_SESSION['ovsec'][$this->section_name]['body']=$html;
		//$this->body=$html; ////AQUI ME QUEDE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	}
	function width($w){
		$_SESSION['ovsec'][$this->section_name]['width']=$w;
		$this->width=$w;
	}
	function height($h){
		$_SESSION['ovsec'][$this->section_name]['height']=$h;
		$n=(100/12)*$h;
		$this->height=$n.'%';
	}
	function hide($active){
		$_SESSION['ovsec'][$this->section_name]['hide']=$active;
		if($active==1)
		{
			$this->flow = 'hideSection:'.$this->section_name;	
		}
		else
		{
			$this->flow = 'showSection:'.$this->section_name;
		}
	}
	function flow($active){
		$_SESSION['ovsec'][$this->section_name]['flow']=$active;
		if($active==1)
		{
			$this->flow = 'flowSection:'.$this->section_name;	
		}
		else
		{
			$this->flow = 'freezeSection:'.$this->section_name;
		}
	}
	function getHide(){
		if(isset($_SESSION['ovsec'][$this->section_name]['hide']))
			$f=$_SESSION['ovsec'][$this->section_name]['hide'];
		else
			$f=0;
		return $f;
	}
	function getFlow(){
		if(isset($_SESSION['ovsec'][$this->section_name]['flow']))
			$f=$_SESSION['ovsec'][$this->section_name]['flow'];
		else
			$f=0;
		return $f;
	}
	function getHeight(){
		return $_SESSION['ovsec'][$this->section_name]['height'];
	}
	function getWidth(){
		return $_SESSION['ovsec'][$this->section_name]['width'];
	}
	function get($t){
		return $_SESSION['ovsec'][$this->section_name]['style'][$t];
	}
	function getStyle(){
		$ss = '';

		$items = $this->style->get();
		if(count($items)>0)
		{
			foreach ($items as $it) {
				$ss = $ss.$this->section_name.';'.$it['id'].';'.$it['value'].'|';
			}
		}

		return $ss;
	}
}

class includes{
	private $info;
	private $section_name;
	function __construct($sec){
		$this->section_name=$sec;
	}
	function file($f){
		$_SESSION['ov_gsectionInfo'][$this->section_name]['type']='file';
		$_SESSION['ov_gsectionInfo'][$this->section_name]['code']=$f;
	}
	function script($c){
		$_SESSION['ov_gsectionInfo'][$this->section_name]['type']='script';
		$_SESSION['ov_gsectionInfo'][$this->section_name]['code']=$c;
	}
	function spot($sp,$m){
		$_SESSION['ov_gsectionInfo'][$this->section_name]['type']='spot';
		$_SESSION['ov_gsectionInfo'][$this->section_name]['code']=$sp;
		$_SESSION['ov_gsectionInfo'][$this->section_name]['mode']=$m;
	}
	function getInfo(){
		return $this->info;
	}
}

class isection_properties{
	public $type;
	public $title;
	public $subtitle;
	public $header;
	public $video;
	public $debug;
	public $alert;
	public $warning;
	public $error;
}

class istyle
{
	private $i_methods;

	function bg_image($img,$type='')
	{
		$rt = Directory::get()['image'].$img;
		//if(file_exists($rt))
		//{
			$t = 'auto';
			if($type!='')
			{
				$t = $type;
			}
			$this->i_methods['bg_image']['property']='bg_image';
			$this->i_methods['bg_image']['id']='IST002';
			$this->i_methods['bg_image']['value']=$rt;
			$this->i_methods['bg_image_size']['property']='bg_image_size';
			$this->i_methods['bg_image_size']['id']='IST005';
			$this->i_methods['bg_image_size']['value']=$t;

			//$this->i_methods['bg_image']="background-image: url('$rt');".$t;		
		//}
		//else
		//{
			//sentinel::registerER('bg_image ['.$rt.']: '.$img,config::$parameters['Language'],4);
		//}

	}
	function border($a,$c='',$t='solid')
	{
		if($c=='') $c=color::name('black');
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('decoration_title [color]',config::$parameters['Language'],22);
			return '';
		}
		$rt = $a.'px '.$t.' '.$color;
		$this->i_methods['border']['property']='border';
		$this->i_methods['border']['id']='IST003';
		$this->i_methods['border']['value']=$rt;
	}
	function shadow($c='')
	{
		if($c=='') $c=color::rgba(0,0,0,0.2);
		$c['ca']=0.2;
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('border [color]',config::$parameters['Language'],22);
			return '';
		}
		if($c['type']!='rgba')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],23);
			return '';	
		}
		$rt = '0 4px 8px 0 '.$color.', 0 6px 10px 0 '.$color.';';
		$this->i_methods['shadow']['property']='box-shadow';
		$this->i_methods['shadow']['id']='IST004';
		$this->i_methods['shadow']['value']=$rt;
	}
	function narrow()
	{
		$rt = '0';
		$this->i_methods['narrow']['property']='narrow';
		$this->i_methods['narrow']['id']='IST006';
		$this->i_methods['narrow']['value']=$rt;
	}
	function font($c)
	{
		$this->i_methods['font']['property']='font';
		$this->i_methods['font']['id']='IST008';
		$this->i_methods['font']['value']=$c;
		//$this->i_methods['font'] = 'font-family: '.$c.';';
	}
	function font_size($c)
	{
		$this->i_methods['font_size']['property']='font_size';
		$this->i_methods['font_size']['id']='IST009';
		$this->i_methods['font_size']['value']=$c.'pt';
		//$this->i_methods['font_size'] = 'font-size: '.$c.';';	
	}
	function font_title($c)
	{
		$this->i_methods['font_title']['property']='font_title';
		$this->i_methods['font_title']['id']='IST010';
		$this->i_methods['font_title']['value']=$c;
		//$this->i_methods['font_title'] = 'font-family: '.$c.';';
	}
	function align_title($a)
	{
		$this->i_methods['align_title']['property']='align_title';
		$this->i_methods['align_title']['id']='IST028';
		$this->i_methods['align_title']['value']=$a;
	}
	function align_subtitle($a)
	{
		$this->i_methods['align_subtitle']['property']='align_subtitle';
		$this->i_methods['align_subtitle']['id']='IST038';
		$this->i_methods['align_subtitle']['value']=$a;
	}
	function decoration_title($a,$c='',$s='solid')
	{
		if($c=='') $c=color::name('black');
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('decoration_title [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['decoration_title']['property']='decoration_title';
		$this->i_methods['decoration_title']['id']='IST029';
		$this->i_methods['decoration_title']['value']=$a;
		$this->i_methods['decoration_title_color']['property']='decoration_title_color';
		$this->i_methods['decoration_title_color']['id']='IST030';
		$this->i_methods['decoration_title_color']['value']=$color;
		$this->i_methods['decoration_title_style']['property']='decoration_title_style';
		$this->i_methods['decoration_title_style']['id']='IST031';
		$this->i_methods['decoration_title_style']['value']=$s;
	}
	function decoration_subtitle($a,$c='',$s='solid')
	{
		if($c=='') $c=color::name('black');
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('decoration_title [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['decoration_subtitle']['property']='decoration_subtitle';
		$this->i_methods['decoration_subtitle']['id']='IST032';
		$this->i_methods['decoration_subtitle']['value']=$a;
		$this->i_methods['decoration_subtitle_color']['property']='decoration_subtitle_color';
		$this->i_methods['decoration_subtitle_color']['id']='IST033';
		$this->i_methods['decoration_subtitle_color']['value']=$color;
		$this->i_methods['decoration_subtitle_style']['property']='decoration_subtitle_style';
		$this->i_methods['decoration_subtitle_style']['id']='IST034';
		$this->i_methods['decoration_subtitle_style']['value']=$s;
	}
	function decoration_header($a,$c='',$s='solid')
	{
		if($c=='') $c=color::name('black');
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('decoration_title [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['decoration_header']['property']='decoration_header';
		$this->i_methods['decoration_header']['id']='IST035';
		$this->i_methods['decoration_header']['value']=$a;
		$this->i_methods['decoration_header_color']['property']='decoration_subtitle_color';
		$this->i_methods['decoration_header_color']['id']='IST036';
		$this->i_methods['decoration_header_color']['value']=$color;
		$this->i_methods['decoration_header_style']['property']='decoration_subtitle_style';
		$this->i_methods['decoration_header_style']['id']='IST037';
		$this->i_methods['decoration_header_style']['value']=$s;
	}
	function font_size_title($c)
	{
		$this->i_methods['font_size_title']['property']='font_size_title';
		$this->i_methods['font_size_title']['id']='IST011';
		$this->i_methods['font_size_title']['value']=$c.'pt';
	}
	function font_subtitle($c)
	{
		$this->i_methods['font_subtitle']['property']='font_subtitle';
		$this->i_methods['font_subtitle']['id']='IST012';
		$this->i_methods['font_subtitle']['value']=$c;
	}

	function font_size_subtitle($c)
	{
		$this->i_methods['font_size_subtitle']['property']='font_size_subtitle';
		$this->i_methods['font_size_subtitle']['id']='IST013';
		$this->i_methods['font_size_subtitle']['value']=$c.'pt';
	}
	function font_size_header($c)
	{
		$this->i_methods['font_size_header']['property']='font_size_header';
		$this->i_methods['font_size_header']['id']='IST027';
		$this->i_methods['font_size_header']['value']=$c.'pt';
	}

	function justify_header()
	{
		$this->i_methods['justify_header']['property']='justify_header';
		$this->i_methods['justify_header']['id']='IST014';
		$this->i_methods['justify_header']['value']='';
	}
	function line_header($w,$c='',$t='solid')
	{
		if($c=='') $c=color::name('black');
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		//if(!in_array($t,keys::$sectionsCommands['borderStyles']))
		//{
			//sentinel::registerER('line_header ['."$t".']',config::$parameters['Language'],17);
			//return '';
		//}
		$rt = $w.'px '.$t.' '.$color;
		$this->i_methods['line_header']['property']='line_header';
		$this->i_methods['line_header']['id']='IST015';
		$this->i_methods['line_header']['value']=$rt;
	}
	function font_color_subtitle($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['font_color_subtitle']['property']='font_color_subtitle';
		$this->i_methods['font_color_subtitle']['id']='IST025';
		$this->i_methods['font_color_subtitle']['value']=$color;
	}
	function font_color_title($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['font_color_title']['property']='font_color_title';
		$this->i_methods['font_color_title']['id']='IST024';
		$this->i_methods['font_color_title']['value']=$color;
	}
	function font_color_header($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['font_color_header']['property']='font_color_header';
		$this->i_methods['font_color_header']['id']='IST047';
		$this->i_methods['font_color_header']['value']=$color;
	}
	function bg_color_header($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['bg_color_header']['property']='bg_color_header';
		$this->i_methods['bg_color_header']['id']='IST026';
		$this->i_methods['bg_color_header']['value']=$color;
	}
	function bg_color_title($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['bg_color_title']['property']='bg_color_title';
		$this->i_methods['bg_color_title']['id']='IST040';
		$this->i_methods['bg_color_title']['value']=$color;
	}
	function bg_color_subtitle($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['bg_color_subtitle']['property']='bg_color_subtitle';
		$this->i_methods['bg_color_subtitle']['id']='IST039';
		$this->i_methods['bg_color_subtitle']['value']=$color;
	}
	function bg_color($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['bg_color']['property']='bg_color';
		$this->i_methods['bg_color']['id']='IST022';
		$this->i_methods['bg_color']['value']=$color;
	}
	function bg_color_footer($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['bg_color_footer']['property']='bg_color_footer';
		$this->i_methods['bg_color_footer']['id']='IST001';
		$this->i_methods['bg_color_footer']['value']=$color;
	}
	function underground_color($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['underground_color']['property']='underground_color';
		$this->i_methods['underground_color']['id']='IST007';
		$this->i_methods['underground_color']['value']=$color;
	}
	function font_color($c)
	{
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$this->i_methods['font_color']['property']='font_color';
		$this->i_methods['font_color']['id']='IST023';
		$this->i_methods['font_color']['value']=$color;
	}
	function narrow_footer()
	{
		$this->i_methods['narrow_footer']['property']='narrow_footer';
		$this->i_methods['narrow_footer']['id']='IST016';
		$this->i_methods['narrow_footer']['value']='0';
	}
	function line_footer($w,$c='',$t='solid')
	{
		if($c=='') $c = color::name('black');
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('line_header [color]',config::$parameters['Language'],22);
			return '';
		}
		$rt = $w.'px '.$t.' '.$color;
		$this->i_methods['line_footer']['property']='line_footer';
		$this->i_methods['line_footer']['id']='IST017';
		$this->i_methods['line_footer']['value']=$rt;
	}
	function bold_title($c)
	{
		if($c==1) $b='bold';
		else $b='normal';
		$this->i_methods['bold_title']['property']='bold_title';
		$this->i_methods['bold_title']['id']='IST041';
		$this->i_methods['bold_title']['value']=$b;
	}
	function bold_subtitle($c)
	{
		if($c==1) $b='bold';
		else $b='normal';
		$this->i_methods['bold_subtitle']['property']='bold_subtitle';
		$this->i_methods['bold_subtitle']['id']='IST042';
		$this->i_methods['bold_subtitle']['value']=$b;
	}
	function bold_header($c)
	{
		if($c==1) $b='bold';
		else $b='normal';
		$this->i_methods['bold_header']['property']='bold_header';
		$this->i_methods['bold_header']['id']='IST043';
		$this->i_methods['bold_header']['value']=$b;
	}
	function justify_footer()
	{
		$this->i_methods['justify_footer']['property']='justify_footer';
		$this->i_methods['justify_footer']['id']='IST018';
		$this->i_methods['justify_footer']['value']='';
	}
	function shadow_title($ins,$c='')
	{
		if($ins>10)$ins=10;
		$ins = $ins/10;

		if($c=='') $c=color::rgba(0,0,0,$ins);
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],22);
			return '';
		}
		if($c['type']!='rgba')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],23);
			return '';	
		}
		$rt = '1px 1px 1px '.$color.';';
		$this->i_methods['shadow_title']['property']='shadow_title';
		$this->i_methods['shadow_title']['id']='IST044';
		$this->i_methods['shadow_title']['value']=$rt;
	}
	function shadow_subtitle($ins,$c='')
	{
		if($ins>10)$ins=10;
		$ins = $ins/10;

		if($c=='') $c=color::rgba(0,0,0,$ins);
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],22);
			return '';
		}
		if($c['type']!='rgba')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],23);
			return '';	
		}
		$rt = '1px 1px 1px '.$color.';';
		$this->i_methods['shadow_subtitle']['property']='shadow_subtitle';
		$this->i_methods['shadow_subtitle']['id']='IST045';
		$this->i_methods['shadow_subtitle']['value']=$rt;
	}
	function shadow_header($ins,$c='')
	{
		if($ins>10)$ins=10;
		$ins = $ins/10;

		if($c=='') $c=color::rgba(0,0,0,$ins);
		$color = color::get($c);
		if($color=='')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],22);
			return '';
		}
		if($c['type']!='rgba')
		{
			//sentinel::registerER('shadow_header [color]',config::$parameters['Language'],23);
			return '';	
		}
		$rt = '1px 1px 1px '.$color.';';
		$this->i_methods['shadow_header']['property']='shadow_header';
		$this->i_methods['shadow_header']['id']='IST046';
		$this->i_methods['shadow_header']['value']=$rt;
	}
	function border_radius($v,$ia=1,$da=1,$ib=1,$db=1)
	{
		$r='.25rem';
		switch($v)
		{
			case 0: $r='0rem'; break;
			case 1: $r='.25rem'; break;
			case 2: $r='.50rem'; break;
			case 3: $r='1rem'; break;
			case 4: $r='2rem'; break;
			case 5: $r='3rem'; break;
			default: $r='.25rem'; break;
		}
		$rf='';
		if($ia==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($da==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($ib==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($db==1)$rf=$rf.$r;
		else $rf=$rf.'0rem';
		$this->i_methods['border_radius']['property']='border_radius';
		$this->i_methods['border_radius']['id']='IST019';
		$this->i_methods['border_radius']['value']=$rf;

		//$this->i_methods['border_radius']='border-radius:'.$rf.';';

		$rf='';
		if($ib==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($db==1)$rf=$rf.$r;
		else $rf=$rf.'0rem';
		$this->i_methods['border_radius_footer']['property']='border_radius_footer';
		$this->i_methods['border_radius_footer']['id']='IST020';
		$this->i_methods['border_radius_footer']['value']='0rem 0rem '.$rf;

		//$this->i_methods['border_radius_footer']='border-radius: 0rem 0rem '.$rf.';';

		$rf='';
		if($ia==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($da==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		$this->i_methods['border_radius_header']['property']='border_radius_header';
		$this->i_methods['border_radius_header']['id']='IST021';
		$this->i_methods['border_radius_header']['value']=$rf.' 0rem 0rem;';
	}



	function get()
	{
		return $this->i_methods;
	}
}





class ovAlertClass{
	private $_hasAlert;
	private $_thisAlert;
	function hasAlert(){
		if(isset($this->_hasAlert)){$ha=$this->_hasAlert;}else{$ha=0;}
		return $ha;
	}
	function alert(){
		$ret='';
		if(isset($this->_thisAlert)) $ret=$this->_thisAlert;
		return $ret;
	}
	function message($title,$msg,$position=1,$color='warning'){
		$this->_hasAlert=$position;
		$ret='<div class="alert alert-'.$color.' alert-dismissible fade show" role="alert">
		<strong>'.$title.'</strong> '.$msg.'
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	  $this->_thisAlert=$ret;
	}
}



class Events{
	public $i_script;
	function onChange($script){
		$this->i_script=$script;
	}
}

define('MYSQL','#mysql#');
define('SQLSERVER','#sqls#');
define('ORACLE','#ora#');
class credentialconnections{
	private $item;
	public function credential($user,$pass){
		$this->item['user']=$user;
		$this->item['password']=$pass;
	}
	public function get(){
		return $this->item;			
	}
}
class connections{
	private $info;
	function __construct(){
		$this->cred = new credentialconnections();
	}
	function define($type,$dns){
		//validar
		$this->info['type']=$type;
		$this->info['dns']=$dns;
		$this->info['cred']=$this->cred;
		return $this->cred;
	}
	function prepare(){
		return $this->test();
	}
	private function test(){
		$dns=$this->info['dns'];
		$user=$this->info['cred']->get()['user'];
		$pass=$this->info['cred']->get()['password'];

		$db = new PDO($dns,$user,$pass);		
		$result=$db->prepare("select 1 test");
		$result->execute();
		foreach ($result as $row) {
            if($row['test']==1){
				$this->info['db']=$db;
				return 'Correctamente. ['.$this->info['dns'].']';
            	//return sentinel::alert(2,$this->info['dns']);
            }else{
				return '';
				//return sentinel::alert(3,'');
            }
			
		}

	}
	public function exec($query){
		$result='';
		if(isset($this->info['db'])){
        	//echo '<pre>'.$query.'</pre>';
    		$result=$this->info['db']->prepare($query);
    		$result->execute();
    	}
    }
	public function select($query){
		$result['data']='';
		$result['columns']='';
		if(isset($this->info['db'])){
        	$result['data']=$this->info['db']->prepare($query);
			$result['data']->execute();
			$result['columns'] = array_keys($result['data']->fetch(PDO::FETCH_ASSOC));
    	}
        return $result;
    }
}




?>