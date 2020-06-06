<?php
/*****************************************************************************

	iclass version 1.0
	by CUBEHN

*****************************************************************************/
namespace core\kernel\iclass;

use core\config\filesystem\Directory;
use core\config\keys\keys;
use ovalo\config\config;
use core\kernel\ovalo;
use core\master\control;
use core\sentinel\sentinel;
sentinel::add(__FILE__);


class includes{
	private $info;
	function file($f){
		$this->info['type']='file';
		$this->info['code']=$f;
	}
	function script($c){
		$this->info['type']='script';
		$this->info['code']=$c;
	}
	function spot($sp,$m){
		$this->info['type']='spot';
		$this->info['code']=$sp;
		$this->info['mode']=$m;
	}
	function getInfo(){
		return $this->info;
	}
}

/*******************************************************************************************************************
*	ACTIONS |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*	--------
*	
*	
*	
*	
*	
********************************************************************************************************************/

class action_properties
{
	public $type;
	public $caption;
	public $description;
	public $tooltip;
	public $icon;
	public $title;
	public $subtitle;
}
class action_events{
	//public $xcode;
	private $events2;
	function click($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'click','code'=>$bb,'obj'=>'action','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Action Event[click] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mouseover($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mouseover','code'=>$bb,'obj'=>'action','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Action Event[mouseover] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mouseout($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mouseout','code'=>$bb,'obj'=>'action','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Action Event[mouseout] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function doubleclick($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'dblclick','code'=>$bb,'obj'=>'action','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Action Event[doubleclick] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mouseup($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mouseup','code'=>$bb,'obj'=>'action','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Action Event[mouseup] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mousedown($bb,$subItem=''){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mousedown','code'=>$bb,'obj'=>'action','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Action Event[mousedown] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function get2(){
		if(isset($this->events2))$r=$this->events2;
		else $r='';
		return $r;
	}
}
class action{
	public $i_name;
	private $i_parentType;
	private $i_parentId;
	private $i_width;
	private $i_actions;
	private $i_border_radius;
	private $i_background_color;
	public $properties;
	public $event;
	public $MySection;
	public $style;
	function __construct($name){
		if($name=='')$name='a'.Control::getNextIdAction();
		$this->i_name=$name;
		$this->properties = new action_properties;
		$this->properties->type=NORMAL;
		$this->event = new action_events;
		$this->style = new style('action');
	}
	/*
	function getClone($name)
	{
		$c = clone $this;
		$c->i_name=$name;
		$c->event = $this->event;
		return $c;
	}*/
	function getCSS()
	{
		$ib = '';
		$b = $this->style->getCSS();
		$b = ovalo::OVreepNDDJ('id', $this->i_name, $b);
		if(isset($this->i_actions))
		{
			foreach ($this->i_actions as $ia) {
				$ib = $ib.$ia->style->getCSS();
				$ib = ovalo::OVreepNDDJ('id', $ia->g_name(), $ib);
			}
		}
		$b = $b.$ib;
		return $b;
	}
	function getEventsObjects(){
		$r = '';
		if($this->event->get2()<>''){
			$r = $this->event->get2();
		}
		return $r;
	}
	function g_name(){
		return $this->i_name;
	}
	function getStyle(){
		return  clone $this->style;
	}
	function width($width){
		if($this->validate($width,'width')){
			$this->i_width=$width;
		}else{
			sentinel::registerER('Action ['.$this->i_name.']',config::$parameters['Language'],2);
		}
	}
	function addAction($action){
		$action->MySection=$this->MySection;
		$this->private_internal['actions'][$action->g_name()]=$action;
	}
	function addActions($ss){
		for($i=0;$i<count($ss);$i++)
		$this->addAction($ss[$i]);
	}
	function isValid(){
		$er=0;
		if(!in_array($this->properties->type, keys::$actionsCommands['types'])){
			sentinel::registerER('Action ['.$this->i_name.']',config::$parameters['Language'],1);
			$er=1;
		}
		return $er;
	}
	function paint(){
		return $this->getHTML();
	}
	function getHTML(){
		$r='';
		if($this->isValid()==0){
			$parent_id=$this->i_name;
			$type=$this->properties->type;
			$internal='';
			if(isset($this->i_parentType)){ 
				$type=$this->i_parentType;
				$parent_id=$this->i_parentId;
				$internal='.internal';
			}

			$act = Directory::get()['action'].'/'.$type.'/'.$type.$internal.'.action.php';

			$r=ovalo::OVextractNDDJ_SH($act,$type.$internal.'.action.php');


			$r=$this->processPropoerties($r,$type,$this);
			$r=$this->processStyles($r,$type);

			if(count($this->i_actions)>0){
				$in='';
				foreach ($this->i_actions as $a) {
					if(in_array($type, keys::$useEI['action'])){

						$a->i_parentType=$type;
						$a->i_parentId=$this->i_name;
					}
					$in=$in.$a->getHtml();
				}
				$r=ovalo::OVreepNDDJ("construction",$in,$r);
			}

		}
		return $r;
	}
	private function processStyles($r,$type){
		if(!isset($this->visualization)){
			$this->visualization="ACTION_".strtoupper($type);
		}
		$w=visualization::get($this->visualization,'Action: '.$this->i_name);
		foreach (keys::$actionsCommands['styles'] as $t) {
			if(isset($w[$t]))
			$r=ovalo::OVreepNDDJ($t, $w[$t], $r);
		}
		return $r;
	}
	private function processPropoerties($r,$type,$act){
		//--- propiedades
		foreach (keys::$actionsCommands['properties'] as $p) {
			$ip='';
			if(isset($act->properties->$p)){
				//complementos html de las propiedades

				$ip=ovalo::OVextractNDDJ_SH(Directory::get()['action'].'/'.$type.'/'.$type.'.'.$p.'.action.php',$type.'.'.$p.'.action.php');
				$ip=ovalo::OVreepNDDJ("property", $act->properties->$p, $ip);

			}
			$r=ovalo::OVreepNDDJ($p,$ip,$r);
		}
		//-----
		$r=ovalo::OVreepNDDJ("id",$act->i_name,$r);
		$r=ovalo::OVreepNDDJ("parent_id",$act->i_parentId,$r);
		$r=ovalo::OVreepNDDJ("sec",$act->MySection,$r);

		foreach (keys::$sectionsCommands['methods'] as $m) {
			$w='';
			if(isset($act->style->get()[$m[0]])) $w=$act->style->get()[$m[0]];
			$r=ovalo::OVreepNDDJ($m[0],$w,$r);	
		}
		$w='';
		if(isset($act->i_width)) $w=$act->i_width;
		$r=ovalo::OVreepNDDJ("width",'col-'.$w,$r);
		
		

		return $r;
	}
	private function validate($type,$key){
		return in_array($type,keys::$sectionsCommands[$key]);
	}
}

/*******************************************************************************************************************
*	SECTIONS |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*	--------
*	
*	30/03/2020	CUBEHN
*	
*	
*	
********************************************************************************************************************/

// +++++++++++++++++++++++++++++
// USER METHOD
// Almacena los valores de las propiedades de los sections, el usuario accede a esta clase a traves de la variable "properties"
// desntro de la clase "Section"
// +++++++++++++++++++++++++++++
class section_properties{
	public $type;
	public $title;
	public $subtitle;
	public $header;
	public $bg;
	public $debug;
}

class property_fixed{
	private $fixed;
	private $pos;
	function cod($cod){
		$this->fixed=$cod;
	}
	function position($x,$y,$invert1=0,$invert2=0,$zi=0){
		$p1='top';
		$p2='left';
		if($invert1==1)$p1='bottom';
		if($invert2==1)$p2='right';
		$this->pos=$p1.': '.$y.'px;'.$p2.': '.$x.'px;z-index: '.$zi.';';
	}
	function ready(){
		return isset($this->fixed);
	}
	function get(){
		return $this->fixed.' '.$this->pos;
	}
}

class c_events{
	private $events;
	private $events2;
	function click($bb,$subItem='b'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'click','code'=>$bb,'obj'=>'section','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Section Event[click] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mouseover($bb,$subItem='b'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mouseover','code'=>$bb,'obj'=>'section','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Section Event[mouseover] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mouseout($bb,$subItem='b'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mouseout','code'=>$bb,'obj'=>'section','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Section Event[mouseout] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function doubleclick($bb,$subItem='b'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'dblclick','code'=>$bb,'obj'=>'section','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Section Event[doubleclick] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mouseup($bb,$subItem='b'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mouseup','code'=>$bb,'obj'=>'section','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Section Event[mouseup] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}
	function mousedown($bb,$subItem='b'){
		if(file_exists("../develop/process/$bb.ov.php"))
		{
			$bb='exec_process2:'.$bb.'|';
			$co = count($this->events2);
			$this->events2[$co]=['useFile'=>'0','name'=>'mousedown','code'=>$bb,'obj'=>'section','subItem'=>$subItem];
		}
		else
		{
			sentinel::registerER('Section Event[mousedown] '."../develop/process/$bb.ov.php",config::$parameters['Language'],21);
		}
	}

	function visible($bb){
		$this->events['visible']=['useFile'=>'1','name'=>'visible','code'=>$bb];
	}
	function noVisible($bb){
		$this->events['noVisible']=['useFile'=>'1','name'=>'noVisible','code'=>$bb];
	}
	function narrower($bb,$w){
		$this->events['sizeMinor']=['useFile'=>'1','name'=>'sizeMinor','code'=>$bb,'width'=>$w];
	}
	function wider($bb,$w){
		$this->events['sizeHigher']=['useFile'=>'1','name'=>'sizeHigher','code'=>$bb,'width'=>$w];
	}
	
	function get2(){
		if(isset($this->events2))$r=$this->events2;
		else $r='';
		return $r;
	}
	function get(){
		if(isset($this->events))$r=$this->events;
		else $r='';
		return $r;
	}
}

class style
{
	private $i_methods;
	private $i_obj;

	function __construct($typeObj)
	{
		// Valores Iniciales / Por defecto

		$this->i_methods['btn_color']='light';

		$this->i_methods['spacing']=1;

		if($typeObj == 'section')
		{
			$this->obj = keys::$sectionsCommands['methods'];
		}
		if($typeObj == 'action')
		{
			$this->obj = keys::$actionsCommands['methods'];
		}

	}

	// ------------------------------------------------------------------------------
	// --> ESTILOS GENERALES --------------------------------------------------------
	// --> agrega imagen de fondo al section
	function bg_image($img,$type='') //cover, contain,30%,200px 100px 
	{
		$rt = Directory::get()['image'].$img;
		if(file_exists($rt))
		{
			$t = '';
			if($type!='')
			{
				$t = 'background-size: '.$type.';';
			}
			$this->i_methods['bg_image']="background-image: url('$rt');".$t;		
		}
		else
		{
			sentinel::registerER('bg_image ['.$rt.']: '.$img,config::$parameters['Language'],4);
		}
	}

	// --> agrega borde al section
	function border($a,$c='black',$t='solid')
	{
		if(!in_array($t,keys::$sectionsCommands['borderStyles']))
		{
			sentinel::registerER('border ['."$t".']',config::$parameters['Language'],17);
			return '';
		}
		$this->i_methods['border']='border:'.$a.'px '.$t.' '.$c.';';
	}

	// --> agrega sombra al section
	function shadow()
	{
		$this->i_methods['shadow']='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);';
	}

	// --> agrega color al fondo que rodea al section
	function underground_color_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'header_bg_color_RGBA');
		if($color!='')
		{
			$this->underground_color($color);
		}
	}
	// --> agrega color al fondo que rodea al section
	function underground_color_HEX($r,$g,$b,$a=1)
	{
		$color = $this->validateColorHEX($c,'font_color_HEX');
		if($color!='')
		{
			$this->underground_color($color);
		}
	}

	// --> quita los espacios
	function narrow()
	{
		$this->i_methods['narrow']='padding:0;';
	}

	// --> agrega color de fondo al section (RGBA)
	function bg_color_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'bg_color_RGBA');
		if($color!='')
		{
			$this->bg_color($color);
		}
	}

	function font($c)
	{
		$this->i_methods['font'] = 'font-family: '.$c.';';
	}

	function font_size($c)
	{
		$this->i_methods['font_size'] = 'font-size: '.$c.'pt;';	
	}

	// --> agrega color de fondo al section (HEX)
	function bg_color_HEX($c)
	{
		$color = $this->validateColorHEX($c,'bg_color_HEX');
		if($color!='')
		{
			$this->bg_color($color);
		}
	}

	function font_color_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'font_color_RGBA');
		if($color!='')
		{
			$this->font_color($color);
		}
	}

	function font_color_HEX($c)
	{
		$color = $this->validateColorHEX($c,'font_color_HEX');
		if($color!='')
		{
			$this->font_color($color);
		}
	}

	function font_color_title_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'font_color_title_RGBA');
		if($color!='')
		{
			$this->font_color_title($color);
		}
	}

	function font_header($c)
	{
		$this->i_methods['font_header'] = 'font-family: '.$c.';';
	}

	function font_size_header($c)
	{
		$this->i_methods['font_size_header'] = 'font-size: '.$c.'pt;';	
	}

	// --> agrega sombra al texto del header
	function shadow_header($ins)
	{
		if($ins>10)$ins=10;
		$ins = $ins/10;
		$rt = '1px 1px 1px rgba(0, 0, 0, '.$ins.');';
		$this->i_methods['shadow_header']='text-shadow: '.$rt;	
	}

	function decoration_header($a,$c='black',$s='solid')
	{
		$this->i_methods['decoration_header'] = 'text-decoration: '.$a.';';
		$this->i_methods['decoration_header_color'] = 'text-decoration-color: '.$c.';';
		$this->i_methods['decoration_header_style'] = 'text-decoration-style: '.$s.';';
	}

	function bold_header($c)
	{
		if($c==1) $b='bold';
		else $b='normal';
		$this->i_methods['bold_header'] = 'font-weight: '.$b.';';
	}

	function font_title($c)
	{
		$this->i_methods['font_title'] = 'font-family: '.$c.';';
	}

	function font_size_title($c)
	{
		$this->i_methods['font_size_title'] = 'font-size: '.$c.'pt;';	
	}

	function align_title($a)
	{
		$this->i_methods['align_title'] = 'text-align: '.$a.';';
	}

	// --> agrega sombra al titulo
	function shadow_title($ins)
	{
		if($ins>10)$ins=10;
		$ins = $ins/10;
		$rt = '1px 1px 1px rgba(0, 0, 0, '.$ins.');';
		$this->i_methods['shadow_title']='text-shadow: '.$rt;	
	}

	function decoration_title($a,$c='black',$s='solid')
	{
		$this->i_methods['decoration_title'] = 'text-decoration: '.$a.';';
		$this->i_methods['decoration_title_color'] = 'text-decoration-color: '.$c.';';
		$this->i_methods['decoration_title_style'] = 'text-decoration-style: '.$s.';';
	}

	function bg_color_title($c)
	{
		$this->i_methods['bg_color_title'] = 'background-color: '.$c.';';
	}

	function bold_title($c)
	{
		if($c==1) $b='bold';
		else $b='normal';
		$this->i_methods['bold_title'] = 'font-weight: '.$b.';';
	}

	function font_color_subtitle_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'font_color_subtitle_RGBA');
		if($color!='')
		{
			$this->font_color_subtitle($color);
		}
	}

	function font_color_title_HEX($c)
	{
		$color = $this->validateColorHEX($c,'font_color_title_HEX');
		if($color!='')
		{
			$this->font_color_title($color);
		}
	}

	function font_color_subtitle_HEX($c)
	{
		$color = $this->validateColorHEX($c,'font_color_subtitle_HEC');
		if($color!='')
		{
			$this->font_color_subtitle($color);
		}
	}

	function font_subtitle($c)
	{
		$this->i_methods['font_subtitle'] = 'font-family: '.$c.';';
	}

	function font_size_subtitle($c)
	{
		$this->i_methods['font_size_subtitle'] = 'font-size: '.$c.'pt;';	
	}

	function align_subtitle($a)
	{
		$this->i_methods['align_subtitle'] = 'text-align: '.$a.';';
	}

	// --> agrega sombra al titulo
	function shadow_subtitle($ins)
	{
		if($ins>10)$ins=10;
		$ins = $ins/10;
		$rt = '1px 1px 1px rgba(0, 0, 0, '.$ins.');';
		$this->i_methods['shadow_subtitle']='text-shadow: '.$rt;	
	}

	function decoration_subtitle($a,$c='black',$s='solid')
	{
		$this->i_methods['decoration_subtitle'] = 'text-decoration: '.$a.';';
		$this->i_methods['decoration_subtitle_color'] = 'text-decoration-color: '.$c.';';
		$this->i_methods['decoration_subtitle_style'] = 'text-decoration-style: '.$s.';';
	}

	function bg_color_subtitle($c)
	{
		$this->i_methods['bg_color_subtitle'] = 'background-color: '.$c.';';
	}

	function bold_subtitle($c)
	{
		if($c==1) $b='bold';
		else $b='normal';
		$this->i_methods['bold_subtitle'] = 'font-weight: '.$b.';';
	}

	// --> funcion establece los bordes redondeados del section
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
		$this->i_methods['border_radius']='border-radius:'.$rf.';';

		$rf='';
		if($ib==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($db==1)$rf=$rf.$r;
		else $rf=$rf.'0rem';
		$this->i_methods['border_radius_footer']='border-radius: 0rem 0rem '.$rf.';';

		$rf='';
		if($ia==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		if($da==1)$rf=$rf.$r.' ';
		else $rf=$rf.'0rem ';
		$this->i_methods['border_radius_header']='border-radius: '.$rf.' 0rem 0rem;';
	}


	// ------------------------------------------------------------------------------
	// --> ESTILOS HEADER -----------------------------------------------------------
	// --> dispone los elementos que esten en el encabezado de forma justificada
	function header_justify()
	{
		$this->i_methods['header_justify']='display: flex;justify-content: space-between;';
	}

	// --> establece el estilo de la linea que divide el header del cuerpo
	function header_line($w,$c='black',$t='solid')
	{
		if(!in_array($t,keys::$sectionsCommands['borderStyles']))
		{
			sentinel::registerER('header_line ['."$t".']',config::$parameters['Language'],17);
			return '';
		}
		$this->i_methods['header_line']='border-bottom:'.$w.'px '.$t.' '.$c.';';	
	}

	// --> establece un color de fondo al header
	function header_bg_color_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'header_bg_color_RGBA');
		if($color!='')
		{
			$this->header_bg_color($color);
		}
	}

	// --> establece un color de fondo al header (HEX)
	function header_bg_color_HEX($c)
	{
		$color = $this->validateColorHEX($c,'header_bg_color_HEX');
		if($color!='')
		{
			$this->header_bg_color($color);
		}
	}

	// ------------------------------------------------------------------------------
	// --> ESTILOS FOOTER -----------------------------------------------------------
	// --> quita los espacios circundantes del pie del section
	function narrow_footer()
	{
		$this->i_methods['narrow_footer']='padding:0;';
	}

	function footer_background_color_RGBA($r,$g,$b,$a=1)
	{
		$color = $this->validateColorRGBA($r,$g,$b,$a,'footer_background_color_RGBA');
		if($color!='')
		{
			$this->footer_background_color($color);
		}
	}

	// --> establece un color de fondo al header (HEX)
	function footer_background_color_HEX($c)
	{
		$color = $this->validateColorHEX($c,'footer_background_color_HEX');
		if($color!='')
		{
			$this->footer_background_color($color);
		}
	}

	function footer_line($w,$c='black',$t='solid')
	{
		if(!in_array($t,keys::$sectionsCommands['borderStyles']))
		{
			sentinel::registerER('footer_line ['."$t".']',config::$parameters['Language'],17);
			return '';
		}
		$this->i_methods['footer_line']='border-top:'.$w.'px '.$t.' '.$c.';';	
	}

	function footer_justify()
	{
		$this->i_methods['footer_justify']='display: flex;justify-content: space-between;';
	}

	// ------------------------------------------------------------------------------
	// --> FUNCIONES PRIVADAS -------------------------------------------------------
	// --> valida el color HEX
	private function validateColorHEX($c,$func)
	{
		if(!ctype_xdigit($c))
		{
			sentinel::registerER($func.' ['."$c".']',config::$parameters['Language'],18);
			return '';	
		}
		return "#$c";
	}
	// --> valida el color RGBA
	private function validateColorRGBA($r,$g,$b,$a,$func)
	{
		if(($r<0 or $r>255) or ($g<0 or $g>255) or ($b<0 or $b>255))
		{
			sentinel::registerER($func.' ['."$r,$g,$b,$a".']',config::$parameters['Language'],15);
			return '';
		}
		if($a<0 or $a>1)
		{
			sentinel::registerER($func.' ['."$r,$g,$b,$a".']',config::$parameters['Language'],16);
			return '';
		}
		return "rgba($r,$g,$b,$a)";
	}

	// --> funcion interna para el color del area de fondo 
	private function underground_color($c)
	{
		$this->i_methods['underground_color']='background-color: '.$c.';';
	}

	// --> funcion interna para el color de fondo del encabezado de la section
	private function header_bg_color($c)
	{
		$this->i_methods['header_bg_color']='background-color: '.$c.';';
	}

	// --> funcion interna para el color de fondo del section
	private function bg_color($c)
	{
		$this->i_methods['bg_color']='background-color: '.$c.';';
	}

	// --> funcion interna para el color de fondo del pie del section
	private function footer_background_color($c)
	{
		$this->i_methods['footer_background_color']='background-color: '.$c.';';
	}

	// --> funcion interna asigna el color del texto
	private function font_color($c)
	{
		$this->i_methods['font_color']='color: '.$c.';';
	}

	// --> funcion interna asigna el color del texto del titulo
	private function font_color_title($c)
	{
		$this->i_methods['font_color_title']='color: '.$c.';';
	}

	// --> funcion interna asigna el color del texto del subtitulo
	private function font_color_subtitle($c)
	{
		$this->i_methods['font_color_subtitle']='color: '.$c.';';
	}



	function align($c){ // solo actions, y los titulos de los section NORMAL
		$this->i_methods['align']='text-align: '.$c.';';
	}
	function padding($c1='5',$c2='5',$c3='5',$c4='5'){
		$this->i_methods['padding']='padding: '.$c1.'px '.$c2.'px '.$c3.'px '.$c4.'px;';
	}
	function spacing($c){
		$this->i_methods['spacing']=$c;
	}


	function btn_color_Bootstrap($c,$t=0){
		$r='';
		if(!in_array($c, keys::$actionsCommands['bootstrapColor']))
		{
			sentinel::registerER('btn_color_Bootstrap ['."$c".']',config::$parameters['Language'],20);
			return '';
		}
		if($t==1) $r='outline-';
		$this->i_methods['btn_color']=$r.$c;
		switch ($c) {
			case 'primary':$text='text-white';break;
			case 'secondary':$text='text-white';break;
			case 'success':$text='text-white';break;
			case 'danger':$text='text-white';break;
			case 'info':$text='text-white';break;
			case 'dark':$text='text-white';break;
			default:
				$text='text-dark';break;
		}

		$this->i_methods['btn_text_color']=$text;
	}


	// --> devuelve el array con la informacion del estilo del section
	function get()
	{
		return $this->i_methods;
	}

	// --> devuelve el CSS del section
	function getCSS()
	{
		$r = Array();

		foreach ($this->obj as $m) 
		{
			if(isset($this->i_methods[$m[0]]))
			{
				$name = $m[0];
				$target = $m[1];
				if($target!='complement')
				{
					$value = $this->i_methods[$name];
					if(isset($r[$target]))
					{
						$c=count($r[$target])+1;
					}
					else
					{
						$c=0;
					}
					$r[$target][$c]['name']=$name;
					$r[$target][$c]['value']=$value;
					$r[$target][$c]['target']=$target;
				}
			}
		}
		$items = '';
		foreach ($r as $rt) 
		{
			$items=$items.'#'.$rt[0]['target'].'[[id]] {';
			for($i=0;$i<=count($rt);$i++)
			{
				if(isset($rt[$i]['value']))
				$items=$items.$rt[$i]['value'];
			}
			$items = $items.'} ';
		}
		return $items;
	}
}
class c_of{
	public $of;
	function overflow($of){
		$this->of=' overflow-'.$of.' ';
	}
}

class section
{
	private $private_internal;

	public $properties;
	public $style;
	public $i_parentId;
	public $i_container;
	public $visualization;
	public $event;

	// .............................
	// SYSTEM METHOD
	// COnstructor de la clase section
	// .............................
	function __construct($xid=''){
		//se construye el identificador del section
		
		$xid=substr($xid,0,7);

		if($xid=='')
		{
			$name='se'.Control::getNextIdSection();
		}
		else 
		{
			$name=$xid;
		}

		$_SESSION['ovsec'][$xid]['ini']=1;
		//Se inicializan las variables privadas

		$this->private_internal=[
			'name'=>$name,
			'height'=>'',
			'width'=>12,
			'sections'=>array(),
			'sections_name'=>array(),
			'actions'=>array(),
			'parentType'=>'',
			'c_of'=> new c_of,
			'fixed'=> new property_fixed,
			'event_script'=>'',
			'active'=>'',
			'center'=>'',
			'include'=>''
		];

		// Instanciamiento de clases

		$this->properties = new section_properties;
		$this->event = new c_events;
		$this->style = new style('section');

		//valores por defecto para las propiedades
		
		$this->properties->type=NORMAL;
		if(config::$parameters['DebugMode'])
		{
			$this->properties->debug='1';	
		}
		
	}
	function getActions()
	{
		return $this->private_internal['actions'];
	}
	function getEventsObjects(){
		$r = '';
		if($this->event->get2()<>''){
			$r = $this->event->get2();
		}
		return $r;
	}
	function eventProcess(){
		if($this->event->get()<>'')
		foreach($this->event->get() as $e){
			if($e['useFile']=='1')
			{
				$this->i_event_script[$e['name']]=ovalo::OVextractNDDJ_SH(Directory::get()['event'].'/'.$e['name'].'.event.php',$e['name'].'.event.php');
				$this->i_event_script[$e['name']]=ovalo::OVreepNDDJ('sec','cont'.$this->g_name(),$this->i_event_script[$e['name']]);
				$this->i_event_script[$e['name']]=ovalo::OVreepNDDJ('bb_code',$e['code'],$this->i_event_script[$e['name']]);
				if(isset($e['width']))$this->i_event_script[$e['name']]=ovalo::OVreepNDDJ('width',$e['width'],$this->i_event_script[$e['name']]);
			}
		}
	}
	function getCSS()
	{
		$ib = '';
		$b = $this->style->getCSS('section');
		$b = ovalo::OVreepNDDJ('id', $this->private_internal['name'], $b);

		foreach ($this->private_internal['actions'] as $ia) {
			$b = $b.$ia->getCSS();	
		}
		
		foreach ($this->private_internal['sections'] as $is) {
			$ib = $ib.$is->getCSS();
			$ib = ovalo::OVreepNDDJ('id', $is->g_name(), $ib);
		}
		$b = $b.$ib;
		return $b;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Devuelve el estilo del section para que pueda ser asignado a otros
	// +++++++++++++++++++++++++++++
	function getStyle()
	{
		return $this->style;
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve 1/0 dependiendo si el section tiene sections internos
	// .............................
	function isContainer()
	{
		$r=0;
		if(isset($this->private_internal['sections'])) $r=1;
		return $r;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Sirve para acceder a los metodos de la clase includes
	// +++++++++++++++++++++++++++++
	function embed()
	{
		if(!isset($this->i_include)) $this->i_include = new includes;
		return $this->i_include;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Asigna el nombre al section
	// +++++++++++++++++++++++++++++
	function s_name($name)
	{
		$this->private_internal['name']=$name;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Obtene el nombre del section
	// +++++++++++++++++++++++++++++
	function g_name()
	{
		return $this->private_internal['name'];
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Obtene el tipo del section
	// +++++++++++++++++++++++++++++
	function g_type()
	{
		return $this->properties->type;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Agrega multiples sections mediante un array de sections
	// +++++++++++++++++++++++++++++
	function addSections($ss)
	{
		$count_ss = count($ss);
		for($i=0;$i<$count_ss;$i++)
		{
			$this->addSection($ss[$i]);
		}
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Agrega una instancia de la clase sections
	// +++++++++++++++++++++++++++++
	function addSection($section){
		if($section == '')
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],11);
			return '';
		}

		if(get_class($section)!='core\kernel\iclass\section')
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],11);
			return '';
		}
	
		if(isset($_SESSION['ov_gsectionInfo'][$section->g_name()]))
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],10);
			return '';
		}
		
		$this->private_internal['sections'][$section->g_name()] = $section;
		$this->private_internal['sections_name'][count($this->private_internal['sections_name'])] = $section->g_name();
		$_SESSION['ov_gsections'] = $this->private_internal['sections'];
		if(isset($section->i_include))
		{
			$_SESSION['ov_gsectionInfo'][$section->g_name()]['chls'] = $this->private_internal['sections_name'];
			$_SESSION['ov_gsectionInfo'][$section->g_name()]['code'] = $section->i_include->getInfo()['code'];
			$_SESSION['ov_gsectionInfo'][$section->g_name()]['type'] = $section->i_include->getInfo()['type'];
		}
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Agrega multiples actions mediante un array de action
	// +++++++++++++++++++++++++++++
	function addActions($ss)
	{
		$count_ss = count($ss);
		for($i=0;$i<$count_ss;$i++)
		{
			$this->addAction($ss[$i]);	
		}
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Agrega una instancia de la clase actions
	// +++++++++++++++++++++++++++++
	function addAction($action)
	{
		if($action == '')
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],19);
			return '';
		}

		if(get_class($action)!='core\kernel\iclass\action')
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],19);
			return '';
		}

		$action->MySection = $this->private_internal['name'];
		$this->private_internal['actions'][$action->g_name()] = $action;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Asignar estilo externo
	// +++++++++++++++++++++++++++++
	function addStyle($s){
		$this->style = clone $s;
	}
	// +++++++++++++++++++++++++++++
	// USER METHOD
	// Asignar ancho del section (1 a 12)
	// +++++++++++++++++++++++++++++
	function width($width)
	{
		if($this->validate($width,'width'))
		{
			$this->i_width=$width;
			$_SESSION['ovsec'][$this->private_internal['name']]['width']=$width;
		}
		else
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],2);
		}
	}

	// .............................
	// SYSTEM METHOD
	// Devuelve el html del Section
	// .............................
	private function gHtmlSection($sname)
	{
		$r='';
		if($this->private_internal['name']==$sname)
		{
			$r=$this->i_include;
		}
		else
		{
			if(isset($this->private_internal['sections']))
			{
				foreach ($this->private_internal['sections'] as $s) 
				{
					$r=$s->gHtmlSection($sname);
					if($r<>'')break;
				}
			}
		}
		return $r;
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve los nombres de los sections internos
	// .............................
	function gEmptySections()
	{
		$r='';
		if(isset($this->private_internal['sections']) and count($this->private_internal['sections'])>0)
		{
			foreach ($this->private_internal['sections'] as $s) 
			{
				$r=$r.$s->gEmptySections();
			}
		}
		else
		{
			$r=$r.','.$this->private_internal['name'];
		}
		return $r;
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve 1/0 si el tipo de asociado al secion es correcto
	// .............................
	private function isValid()
	{
		$er=0;
		if(!in_array($this->properties->type, keys::$sectionsCommands['types']))
		{
			sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],1);
			$er=1;
		}
		return $er;
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve true/false si el tipo de section usa el modo Externo/Interno
	// .............................
	private function useEIMode()
	{
		return in_array($this->properties->type, keys::$useEI['section']);
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve true/false si el tipo de section usa Complemento
	// .............................
	private function useComplementMode()
	{
		return in_array($this->properties->type, keys::$useComplement['section']);
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve true/false si el section tiene sections internos
	// .............................
	private function hasInternalSections()
	{
		$ret = false;
		$count_sec = $this->countInternalArray('sections');
		if($count_sec > 0)
		{
			$ret = true;
		}
		return $ret;
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve la cantidad de elementos en el array
	// .............................
	private function countInternalArray($obj)
	{
		$count = count($this->private_internal[$obj]);
		return $count;
	}
	// .............................
	// SYSTEM METHOD
	// Devuelve true/false si el section tiene actions
	// .............................
	private function hasInternalActions()
	{
		$ret = false;
		$count_act = $this->countInternalArray('actions');
		if($count_act > 0)
		{
			$ret = true;
		}
		return $ret;
	}


			function activateHeightUse($h){
				$this->i_height=$h.'px; ';
			}
			function active(){
				$this->i_active='active';
			}
			function center(){
				$this->i_center='justify-content-sm-center';
			}
			function height($h){
				if($this->validate($h,'height')){
					//$this->i_height=$h*8.333;
					//$this->i_height=$this->i_height.'%';
					$_SESSION['ovsec'][$this->private_internal['name']]['height']=$h;
					$n=(100/12)*$h;
					$this->i_height=$n.'%';
				}else{
					sentinel::registerER('Section ['.$this->private_internal['name'].']',config::$parameters['Language'],8);
				}
				//return '';//$this->private_internal['c_of']; //investigar para que era esto
			}
			function g_width(){
				return $this->i_width;
			}
			function fixed(){
				$this->private_internal['fixed']->cod('position: fixed;');
				return $this->private_internal['fixed'];
			}
	function getEventScript(){
		if(isset($this->i_event_script)) $r=$this->i_event_script;
		else $r='';
		return $r;
	}


	// .............................
	// SYSTEM METHOD
	// Devuelve el html del section
	// .............................
	function getHtml(){
		$r='';
		if($this->isValid()==1)
		{
			return '';
		}

		$parent_id = $this->private_internal['name'];
		$type = $this->properties->type;
		$internal = '';

		if(isset($this->i_parentType))
		{ 
			$type=$this->i_parentType;
			$parent_id=$this->i_parentId;
			$internal='.internal';
		}

		$sec = Directory::get()['section'].'/'.$type.'/'.$type.$internal.OVALO_FILETYPE_SECTION;

		$r = ovalo::OVextractNDDJ_SH($sec,$type.$internal.OVALO_FILETYPE_SECTION);
		$r = $this->processPropoerties($r,$type,$this);
		$r = $this->processStyles($r,$type);
		

		if($this->hasInternalSections())
		{
			$in = '';
			$compl = '';
			foreach ($this->private_internal['sections'] as $s) 
			{
				if($this->useEIMode())
				{
					$s->i_parentType=$type;
					$s->i_parentId=$this->private_internal['name'];
				}
				$s->i_container = $this->private_internal['name'];
				
				if($this->useComplementMode())
				{
					$compl = $compl.ovalo::OVextractNDDJ_SH(Directory::get()['section'].'/'.$type.'/'.$type.OVALO_FILETYPE_COMPL,$type.OVALO_FILETYPE_COMPL);
					$compl = $this->processPropoerties($compl,$type,$s);
					$compl = $this->processStyles($compl,$type);
				}

				$in = $in.$s->getHtml();
			}
			if(strtoupper($type) == 'NORMAL') $in = '<div class="row '.$this->private_internal['center'].'">'.$in.'</div>'; // esto debe estar en otra clase, esto es para que los sections internos se coloquen a la par
			$r = ovalo::OVreepNDDJ("construction",$in,$r);
			$r = ovalo::OVreepNDDJ("complement",$compl,$r);
		}

		//si no se agrego ningun a section interna se coloca el nombre de la section para facilitar al developer identificar el section
		$r=ovalo::OVreepNDDJ("construction",'section: '.$this->private_internal['name'],$r);

		$acts = '';
		if($this->hasInternalActions())
		{
			foreach ($this->private_internal['actions'] as $a) 
			{
				$acts=$acts.$a->getHTML();
			}
		}
		$r = ovalo::OVreepNDDJ("actions",$acts,$r);
		
		return $r;
	}

	// .............................
	// SYSTEM METHOD
	// Procesa el estilo de un section y devuelve el html
	// .............................
	private function processStyles($r,$type)
	{
		if(!isset($this->visualization))
		{
			$this->visualization="SECTION_".strtoupper($type);
		}

		$vlist = visualization::get($this->visualization,'Section: '.$this->private_internal['name']);

		foreach (keys::$sectionsCommands['styles'] as $t) 
		{
			if(isset($vlist[$t]))
			{
				//Si no tiene actions asociados no se establece estilo para el footer
				if($t=='s_actions' and !$this->hasInternalActions())
				{
					$val = '';
				} 
				else 
				{
					$val = $vlist[$t];
				}

				$r = ovalo::OVreepNDDJ($t, $val, $r);
			}
		}
		$_SESSION['ovsec'][$this->private_internal['name']]['style']=$this->style->get();
		return $r;
	}

	private function processPropoerties($r,$type,$sec)
	{
		//---------------------------------------------------------------
		//--- AGREGAR PROPERTIES, son agregados por el usuario
		//---------------------------------------------------------------
		foreach (keys::$sectionsCommands['properties'] as $p) 
		{
			if(!is_array($p))
			{
				sentinel::registerER('Section ['.$sec->g_name().']',config::$parameters['Language'],12);	
				return '';
			}

			if(!isset($p[1]))
			{
				sentinel::registerER('Section ['.$sec->g_name().']',config::$parameters['Language'],13);	
				return '';
			}

			$ip = '';
			$property = $p[0];
			$pValue = $sec->properties->$property;
			$pType = $p[1];


			if(isset($pValue))
			{
				switch ($pType)
				{
					case 'file':
						if(file_exists(Directory::get()['images'].'/'.$pValue))
						{
							$ip=ovalo::OVextractNDDJ_SH(Directory::get()['section'].'/'.$type.'/'.$type.'.'.$property.OVALO_FILETYPE_SECTION,$type.'.'.$property.OVALO_FILETYPE_SECTION);
							$ip=ovalo::OVreepNDDJ("property", $pValue, $ip);
						}
						else
						{
							sentinel::registerER('Section ['.$this->private_internal['name'].'] bg:'.$pValue,config::$parameters['Language'],4);
						}
						break;
					case 'text':
						$ip=ovalo::OVextractNDDJ_SH(Directory::get()['section'].'/'.$type.'/'.$type.'.'.$property.OVALO_FILETYPE_SECTION,$type.'.'.$property.OVALO_FILETYPE_SECTION);
						$ip=ovalo::OVreepNDDJ("property", $pValue, $ip);
						break;
					case 'system':
						//Las propiedades de sistema se pueden desactivar por cada section enviando 0 como valor
						if($pValue=='1')
						{
							$ip=ovalo::OVextractNDDJ_SH(Directory::get()['section'].'/'.$type.'/'.$type.'.'.$property.OVALO_FILETYPE_SECTION,$type.'.'.$property.OVALO_FILETYPE_SECTION);
							$ip=ovalo::OVreepNDDJ("property", $pValue, $ip);
						}
						break;
					default:
						sentinel::registerER('Section ['.$sec->g_name().']',config::$parameters['Language'],12);
				}

			}
			$r = ovalo::OVreepNDDJ($property,$ip,$r);
		}

		//---------------------------------------------------------------
		//--- AGREGAR SPECIAL VALUES, son agregados por el sistema, incluidos Ids o elementos para el debug
		//---------------------------------------------------------------
		// debug
		$r = ovalo::OVreepNDDJ("id",$sec->g_name(),$r);
		$r = ovalo::OVreepNDDJ("type",$sec->g_type(),$r);
		$r = ovalo::OVreepNDDJ("secAsoc",$sec->countInternalArray('sections'),$r);
		$r = ovalo::OVreepNDDJ("actAsoc",$sec->countInternalArray('actions'),$r);
		$r = ovalo::OVreepNDDJ("parent_id",$sec->i_container,$r);

		//---------------------------------------------------------------
		//--- AGREGAR METODOS de la clase STYLE
		//---------------------------------------------------------------
		foreach (keys::$methods as $m) {
			$w = '';
			if(isset($sec->style->get()[$m[0]]))
			{
				$w = $sec->style->get()[$m[0]];
			}
			$r = ovalo::OVreepNDDJ($m[0],$w,$r);	
		}

		$wi='';
		if(isset($sec->i_width)) $wi='col-md-'.$sec->i_width;
		else $wi='col-md';
		$r=ovalo::OVreepNDDJ("width",$wi,$r);
		//$w='';
		//if(isset($sec->private_internal['c_of']->of)) $w=$sec->private_internal['c_of']->of;
		//$r=ovalo::OVreepNDDJ("overflow",$w,$r);
		$w='';
		if(isset($sec->i_height)) $w='height:'.$sec->i_height.';';
		$r=ovalo::OVreepNDDJ("height",$w,$r);
		$w='';
		if(isset($sec->i_active)) $w=$sec->i_active;
		$r=ovalo::OVreepNDDJ("active",$w,$r);
		$w='';
		if(isset($sec->i_center)) $w=$sec->i_center;
		$r=ovalo::OVreepNDDJ("center",$w,$r);

		$w='';
		if($sec->private_internal['fixed']->ready()){ 
			$w=$sec->private_internal['fixed']->get();
			$r=ovalo::OVreepNDDJ("fixed",$w,$r); //si es fixed se aplica el width
		}


		return $r;
	}

	private function validate($type,$key){
		return in_array($type,keys::$sectionsCommands[$key]);
	}
}


class visualization{
	static $classes;
	static function define($name,$structure){
		self::$classes[$name]=$structure;
	}
	static function get($name,$obj){
		$r='';
		if(isset(self::$classes[$name])){
			$r=self::$classes[$name];
		}else{
			sentinel::registerER('Visualization ['.$obj.']',config::$parameters['Language'],3);	
		}
		return $r;
	}
}


class blackbox{
		static function capsule($bbs){
			$r='';
			foreach($bbs as $c){
				if($r!='')$r=$r.'#';
				$r=$r.$c;
			}
			return $r;
		}
		static function hideSection($section){
			if(is_a($section,'core\kernel\iclass\section'))
				$name = $section->g_name();
			else
				$name = $section;
			return 'hideSection:'.$name;	
		}
		static function showSection($section){
			if(is_a($section,'core\kernel\iclass\section'))
				$name = $section->g_name();
			else
				$name = $section;
			return 'showSection:'.$name;
		}
		static function switchSection($sec1,$sec2){ // al usar esta opcion se pierden los eventos de los sections
			if(is_a($sec1,'core\kernel\iclass\section'))
				$name1 = $sec1->g_name();
			else
				$name1 = $sec1;
			if(is_a($sec2,'core\kernel\iclass\section'))
				$name2 = $sec2->g_name();
			else
				$name2 = $sec2;
			return 'switchSection:'.$name1.'|'.$name2;
		}
		static function process2($name,$param=''){
			return 'exec_process2:'.$name.'|'.$param;
		}
		static function flowSection($section){
			if(is_a($section,'core\kernel\iclass\section'))
				$name = $section->g_name();
			else
				$name = $section;
			return 'flowSection:'.$name;
		}
		static function freezeSection($section){
			if(is_a($section,'core\kernel\iclass\section'))
				$name = $section->g_name();
			else
				$name = $section;
			return 'freezeSection:'.$name;
		}


		static function morphSpot($shade,$spot,$mode){
			return 'morphSpot:'.$shade->g_name().'|'.$spot.'|'.$mode;
		}
		static function test($section){
			return 'test:'.$section->g_name();	
		}
		static function loadShade($shade){
			return 'BB875277123:'.$shade;
		}
		static function process($section,$name,$param=''){
			$file='';
			if(isset($section->i_include)){
				if($section->i_include->getInfo()['type']=='file')
					$file=$section->i_include->getInfo()['code'];
			}
			return 'exec_process:'.$section->g_name().'|'.$name.'|'.$file.'|'.$param;
		}
		/*
		static function getValueElementById($section,$element){
			return 'getValueElementById:'.$section->g_name().'|'.$element;
		}
		*/
		static function refreshSection($section){
			return 'call:'.$section->g_name();
		}
		/*
		static function interact2Section($section,$com,$val){
			return 'interact2:'.$section->g_name().'|'.$com.'|'.$val;
		}
		static function interactSection($section,$com,$val='',$ia=1,$da=1,$ib=1,$db=1){
			switch ($com){
				case 'fixed':
					$com='position';
					$val='fixed';
					break;
				case 'border_radius':
					$com='borderRadius';
					switch($val){
						case 0:
							$val='0rem';break;
						case 1:
							$val='.25rem';break;
						case 2:
							$val='.50rem';break;
						case 3:
							$val='1rem';break;
						case 4:
							$val='2rem';break;
						case 5:
							$val='3rem';break;
						default:
							$val='.25rem';break;
					}
					$r=$val;
					$rf='';
					if($ia==1)$rf=$rf.$r.' ';
					else $rf=$rf.'0rem ';
					if($da==1)$rf=$rf.$r.' ';
					else $rf=$rf.'0rem ';
					if($ib==1)$rf=$rf.$r.' ';
					else $rf=$rf.'0rem ';
					if($db==1)$rf=$rf.$r;
					else $rf=$rf.'0rem';
					$val=$rf;
					break;
			}
			return 'interact:'.$section->g_name().'|'.$com.'|'.$val;
		}*/
}




class Spot{
	static $i_name;
	static $i_columns;
	static $i_tables;
	static $i_elements;
	static $i_config;
	static $i_tablesSpot;
	static $vTbl;
	static $vTblinks;

	static function load($ns){

		include $_SERVER['DOCUMENT_ROOT'].'test/dev/sources/spots/'.$ns.'.spot.php';
		self::$i_tables=$tables;
		self::$i_config=$config;
		self::$i_elements=$elements;
		//carga la metadata de las tablas que utiliza el spot
		self::$vTbl=array();
		self::$vTblinks=array();
		foreach (self::$i_tables as $tb) {
			include $_SERVER['DOCUMENT_ROOT'].'test/dev/sources/tables/'.$tb.'.table.php';
			self::$i_tablesSpot[$tb]=$table;
			if(isset(self::$i_tablesSpot[$tb]['links'])){
				foreach (self::$i_tablesSpot[$tb]['links'] as $vt){
				 	if (!in_array($vt['table'],self::$vTbl)){
						array_push(self::$vTbl, $vt['table']);
						array_push(self::$vTblinks, $vt);
					}
				}	
			}
		}
		
		var_dump(self::$vTbl);
		var_dump(self::$vTblinks);

		return self::getHtml($elements);
	}
	private static function getHtml($elements){

		$ex=ovalo::OVextractNDDJ_SH($_SERVER['DOCUMENT_ROOT'].'test/Core/html/modes/'.self::$i_config['type'].'/'.self::$i_config['type'].'.mod.php',self::$i_config['type'].'.mod.php');

		foreach (keys::$sectionsCommands['methodsSpots'] as $m) {
			$dw='';
			if(isset(self::$i_config[$m])) $dw=self::$i_config[$m];
			$ex=ovalo::OVreepNDDJ($m,$dw,$ex);	
		}


		$in='';
		$iin='';		
		if(isset($elements)){
			for ($w=0;$w<count($elements);$w++) {
				$is_spot=0;
				if(isset($elements[$w]['spot'])){
					$is_spot=1;
				}

				if($is_spot==1){
					$dw='';
					$in=ovalo::OVextractNDDJ_SH($_SERVER['DOCUMENT_ROOT'].'test/Core/html/modes/special/spot.mod.php','spot.mod.php');
					foreach (keys::$sectionsCommands['methodsSpots'] as $m) {
						if(isset($elements[$w][$m])) $dw=$elements[$w][$m];
						$in=ovalo::OVreepNDDJ($m,$dw,$in);
					}
					$dw=Spot::load($elements[$w]['spot']);
					$in=ovalo::OVreepNDDJ('SPOT',$dw,$in);
				}else{

					$in='';

						$is_ref=0;
						if(in_array($elements[$w]['table'],self::$vTbl)) $is_ref=1;

						echo '<br>'.$elements[$w]['table'].' - '.$is_ref.'<br>';
						//aqui me quedé, ya tengo identificado cuando es una ref


							if(!isset($elements[$w]['type'])){ 
								if(isset(self::$i_type))
									$t=self::$i_type;
								else{
									$t=self::$i_config['type'];
								}
							}else{
								$t=$elements[$w]['type'];	
							} 
						


						$tbd=$elements[$w]['table'];
						$camp=$elements[$w]['name'];

						$onlyREF='';
						if($is_ref==1){
							foreach (self::$vTblinks as $lk) {
								if($lk['table']==$tbd){
									$tt=$lk['type'];
									break;
								}
							}
							$onlyREF='.'.$t;
							$t=self::$i_config['type'];
						}else{
							$tt=self::$i_tablesSpot[$tbd]['columns'][$camp]['type'];
						}
						echo $t;
						/*
						$tt -> este viene de la tabla, es el tipo de dato que se define en la tabla
						$t -> es el tipo que se define en el spot
						*/
						
						echo $t.'/'.$t.$onlyREF.'.'.$tt.'.mod.php<br>';
						$in=ovalo::OVextractNDDJ_SH($_SERVER['DOCUMENT_ROOT'].'test/Core/html/modes/'.$t.'/'.$t.$onlyREF.'.'.$tt.'.mod.php',$t.$onlyREF.'.'.$tt.'.mod.php');

						//agregar todas las configuraciones que puede hacer el susuario
						foreach (keys::$sectionsCommands['methodsSpots'] as $m) {
							$dw='';
							switch($m){
								case 'size';
									if(isset($elements[$w][$m])) $dw=$elements[$w][$m];
									$fc='';
									$cf='';
									$ip='';
									switch($dw){
										case 1: $dw='sm'; break;
										case 2: $dw=''; break;
										case 3: $dw='lg'; break;
									}
									if($dw!=''){
										$fc='form-control-'.$dw;
										$cf='col-form-label-'.$dw;
										$ip='input-group-'.$dw;
									}
									$in=ovalo::OVreepNDDJ('size-input',$fc,$in);
									$in=ovalo::OVreepNDDJ('size-label',$cf,$in);
									$in=ovalo::OVreepNDDJ('size-ip',$ip,$in);
									break;
								case 'placeholder':
									if(isset($elements[$w][$m])) $dw=$elements[$w][$m];
									$dw=$m.'="'.$dw.'"';
									$in=ovalo::OVreepNDDJ($m,$dw,$in);
									break;
								case 'readonly':
									if(isset($elements[$w][$m])) $dw=$elements[$w][$m];
									if($dw=="1")$dw=$m;
									$in=ovalo::OVreepNDDJ($m,$dw,$in);
									break;
								case 'disabled':
									if(isset($elements[$w][$m])) $dw=$elements[$w][$m];
									if($dw=="1")$dw=$m;
									$in=ovalo::OVreepNDDJ($m,$dw,$in);
									break;
								case 'header':
									if(isset($elements[$w][$m])){
										$dw=$elements[$w][$m];
										$dw='<div class="input-group-prepend"><div class="input-group-text">'.$dw.'</div></div>';
									}
									$in=ovalo::OVreepNDDJ($m,$dw,$in);
									break;
								default:
									if(isset($elements[$w][$m])) $dw=$elements[$w][$m];
									$in=ovalo::OVreepNDDJ($m,$dw,$in);
							}
						}

				}
				$iin=$iin.$in;
			}

			

		}
		$ex=ovalo::OVreepNDDJ('FIELDS',$iin,$ex);

		return $ex;
	}
}


class form
{
	static function create($secname,$type,$items)
	{
		$r = '';
		foreach ($items as $t) {
			$base = file_get_contents('../core/html/form/'.$type.'/'.$t['type'].'.html');
			foreach (keys::$formItems as $fi) {
				if(isset($t[$fi]))
				{
					$base=str_replace("[[$fi]]",$t[$fi],$base);
				}
			}
			$base=str_replace("[[change]]",'onchange="alert('."'"."hola"."'".');"',$base);
			$base=str_replace("[[sec]]",$secname,$base);
			$base=str_replace("[[xtype]]",$t['type'],$base);
			$base=str_replace("[[xform]]",$type,$base);
			$base=str_replace("[[xval]]",sentinel::getTokenItem($type.$t['type'].$t['id']),$base);
			$r=$r.$base;
		}
		return $r;
	}
}
?>