<?php
namespace core\config\keys;

use core\kernel\Components;
use core\sentinel\sentinel;
sentinel::add(__FILE__);

class keys{
	static public $sectionKeyTypes=[	
		'normal',
		'tab',
		'pills',
		'accordion',
		'list',
		'collapse',
		'modal',
		'button',
		'carousel',
		'parallax',
		'portlet'
	];
	static public $sectionKeyStyles=[	
		's_head',
		's_body',
		's_header',
		's_title',
		's_footer',
		's_subtitle',
		's_bar',
		's_tab',
		's_button',
		's_style_button',
		's_bg',
		's_actions',
		's_img',
		's_head_box'
	];
	static public $sectionKeyMethods=[
		'narrow',
		'narrow_footer',
		'shadow',
		'shadow_title',
		'border',
		'border_radius',
		'border_radius_footer',
		'border_radius_header',
		'header_background_color',
		'header_line',
		'underground_color',
		'footer_background_color',
		'footer_line',
		'background_color',
		'font_color',
		'font_color_title',
		'font_color_subtitle',
		'padding',
		'btn_color',
		'spacing',
		'align',
		'btn_text_color',
		'header_justify',
		'footer_justify'
	];

	static public $sectionsCommands=[
				'types'=>[
					'normal',
					'tab',
					'pills',
					'accordion',
					'list',
					'collapse',
					'modal',
					'button',
					'carousel',
					'parallax',
					'portlet'
				],
				// .............................
				// USER SETTINGS - DIRECTLY
				// Propiedades disponibles para el usuario, 
				// son los metodos de la clase section_propertie
				// .............................
				'properties'=>
				[
					['title','text'],
					['header','text'],
					['subtitle','text'],
					//['bg','file'],
					['debug','system']
				],

				// .............................
				// USER SETTINGS - FOR VISUALIZATION
				// Provienen de una configuracion de un Visualization
				// Cambian la forma de los div y elementos html
				// .............................
				'styles'=>
				[
					's_head',
					's_body',
					's_header',
					's_title',
					's_footer',
					's_subtitle',
					's_bar',
					's_tab',
					's_button',
					's_style_button',
					's_bg',
					's_actions',
					's_img',
					's_head_box'
				],

				// .............................
				// USER SETTINGS - DIRECTLY
				// Listado de metodos de la clase style
				// Cambian la apariencia de los div y elementos html
				// .............................
				'methods'=>
				[
					//GENERALES
					['shadow','cont'],
					['border','cont'],
					['bg_image','cont'],
					['bg_color','cont'],
					['border_radius','cont'],

					//HEADER
					['header_bg_color','h'],
					['header_line','h'],
					['header_justify','h'],
					['border_radius_header','h'],
					['header_font','t'],

					//UNDERGROUND
					['underground_color','main'],

					//FOOTER
					['border_radius_footer','f'],
					['narrow_footer','f'],
					['footer_background_color','f'],
					['footer_line','f'],
					['footer_justify','f'],

					//CONSTRUCT
					['font_color',''],
					['font',''],
					['font_size',''],
					
					//OTROS
					//['align','e'],
					['narrow','b'],

					//PROPIEDADES
					['shadow_title','t'],
					['font_color_title','t'],
					['font_title','t'],
					['font_size_title','t'],
					['align_title','t'],
					['decoration_title','t'],
					['decoration_title_color','t'],
					['decoration_title_style','t'],
					['font_color_subtitle','s'],
					['font_subtitle','s'],
					['font_size_subtitle','s'],
					['align_subtitle','s'],
					['decoration_subtitle','s'],
					['decoration_subtitle_color','s'],
					['decoration_subtitle_style','s'],

					//ACTIONS
					['padding','act'],
					['btn_color','complement'],
					['spacing','complement'],
					['btn_text_color','act']
				],
				'borderStyles'=>
				[
					'solid',
					'dotted',
					'double',
					'dashed',
					'groove',
					'ridge',
					'inset',
					'outset'
				],
				'events'=>['scroll'],
				'methodsSpots'=>['header','placeholder','group','checked','disabled','size','name','title','subtitle','caption','width','description','footer','type','readonly','max','min','hidden'],
				'optionSpots'=>['placeholder','value'],
				'width'=>['1','2','3','4','5','6','7','8','9','10','11','12'],
				'height'=>['1','2','3','4','5','6','7','8','9','10','11','12']
			];
	static public $actionsCommands=[
				'properties'=>['caption','description','icon','title','subtitle'],
				'types'=>['normal','group','dropdown','split','flat','panel'],
				'styles'=>['s_button','s_container_button','s_description'],
				/*
					Aqui solo dejar los metodos que va a utilizar actions
				*/
				'methods'=>
				[
					//GENERALES
					['shadow',''],
					['border',''],
					['bg_image','cont'],
					['bg_color','cont'],
					['border_radius',''],

					//FOOTER
					['border_radius_footer','f'],
					['narrow_footer','f'],
					['footer_background_color','f'],
					['footer_line','f'],
					['footer_justify','f'],

					//CONSTRUCT
					['font_color',''],
					
					//OTROS
					['align',''],
					['narrow','b'],

					//PROPIEDADES
					['font_color_title','t'],
					['font_color_subtitle','s'],

					//ACTIONS
					['padding',''],
					['btn_color','complement'],
					['spacing','complement'],
					['btn_text_color','complement']
				],
				'bootstrapColor'=>
				[
					'default',
					'primary',
					'success',
					'info',
					'warning',
					'danger',
					'link'
				]
			];
	/*
		Aqui se deben colocar todos los metodos no importando de que objeto sea
	*/
	static public $methods=[
		//GENERALES
		'shadow',
		'border',
		'bg_image',
		'bg_color',
		'border_radius',

		//HEADER
		'header_bg_color',
		'header_line',
		'header_justify',
		'border_radius_header',
		'header_font',

		//UNDERGROUND
		'underground_color',

		//FOOTER
		'border_radius_footer',
		'narrow_footer',
		'footer_background_color',
		'footer_line',
		'footer_justify',

		//CONSTRUCT
		'font_color',
		'font',
		'font_size',
		
		//OTROS
		'align',
		'narrow',

		//PROPIEDADES
		'font_color_title',
		'font_title',
		'font_size_title',
		'font_color_subtitle',
		'font_subtitle',
		'font-size_subtitle',

		//ACTIONS
		'padding',
		'btn_color',
		'spacing',
		'btn_text_color'
	];
	/*
		Establece si un section o action utilizad¿n el mode Externo/Interno
	*/
	static public $useEI=[
				'section'=>['tab','pills','accordion','list','collapse','parallax','carousel','portlet'],
				'action'=>['group','dropdown','split','flat','list','vertical']
			];
	static public $useComplement=[
				'section'=>['tab','pills']
			];
	static public $formItems=[
		'id',
		'type',
		'caption',
		'description'
	];
}


?>