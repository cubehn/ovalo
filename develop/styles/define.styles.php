<?php
use core\kernel\iclass\Visualization;
use core\sentinel\sentinel;
sentinel::add(__FILE__);

Visualization::define(SECTION_NORMAL,[
	's_head'=>'card',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted',
	's_actions' => 'card-footer'
]);

Visualization::define(SECTION_CAROUSEL,[
	's_head'=>'card',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted',
	's_actions' => 'card-footer'
]);

Visualization::define(SECTION_MODAL,[
	's_head'=>'modal-content',
	's_body'=>'modal-body',
	's_header'=>'modal-header',
	's_title'=>'modal-title',
	's_footer'=>'modal-footer',
	's_subtitle'=>'card-subtitle mb-2 text-muted'
]);

Visualization::define(SECTION_PARALLAX,[
	's_head'=>'parallax-head',
	's_head_box'=>'card',
	's_title'=>'modal-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted',
	's_img'=>'parallax-img'
]);

Visualization::define(SECTION_PILLS,[
	's_head'=>'card',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_bar'=>'nav nav-pills card-header-pills',
	's_tab'=>'tab-pane fade',
	's_button'=>'nav-item',
	's_style_button'=>'nav-link',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle text-muted'
]);

Visualization::define(SECTION_TAB,[
	's_head'=>'card',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_bar'=>'nav nav-tabs card-header-tabs',
	's_tab'=>'tab-pane fade',
	's_button'=>'nav-item',
	's_style_button'=>'nav-link',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle text-muted'
]);

Visualization::define(SECTION_COLLAPSE,[
	's_head'=>'card',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_button'=>'btn btn-link',
	's_style_button'=>'',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle text-muted'
]);

Visualization::define(SECTION_BUTTON,[
	's_head'=>'card',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted',
	's_button'=>'btn btn-light'
]);


Visualization::define(INITIAL,[
	's_head'=>'card text-center border-0 flex-parent text-info',
	's_body'=>'card-body flex-child',
	's_header'=>'card-header bg-transparent',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted'
]);

Visualization::define(ACTION_NORMAL,[
	's_button'=>'',
	's_container_button'=>'',
	's_description'=>'text-mute'
]);

Visualization::define(ACTION_PANEL,[
	's_button'=>'btn hoverbtn',
	's_container_button'=>'btn-group mr-2',
	's_description'=>'text-mute'
]);

Visualization::define(ACTION_DROPDOWN,[
	's_button'=>'',
	's_container_button'=>'btn-group mr-2',
	's_description'=>'text-mute'
]);

Visualization::define(ACTION_GROUP,[
	's_button'=>'',
	's_container_button'=>'btn-group mr-2',
	's_description'=>'text-mute'
]);

Visualization::define(ACTION_SPLIT,[
	's_button'=>'',
	's_container_button'=>'btn-group mr-2',
	's_description'=>'text-mute'
]);

Visualization::define(ACTION_FLAT,[
	's_button'=>'btn btn-light',
	's_container_button'=>'btn-group-vertical',
	's_description'=>'text-mute'
]);

/*

Se pueden hacer Visualizaciones personalizadas, ademas se pueden agregar nuevas clases a las partes de los componentes html

*/

Visualization::define(BLANK,[
	's_head'=>'card text-center border-0 flex-parent',
	's_body'=>'card-body flex-child',
	's_header'=>'card-header bg-transparent',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle text-muted',
	's_bar'=>'nav nav-pills card-header-pills',
	's_tab'=>'tab-pane fade',
	's_button'=>'nav-item',
	's_style_button'=>'nav-link'
]);

Visualization::define('ACTION_LINK',[
	's_button'=>'btn btn-link',
	's_container_button'=>'btn-group mr-2',
	's_description'=>'text-mute'
]);


Visualization::define('CUSTOME1',[
	's_head'=>'card personalize',
	's_body'=>'card-body text-danger',
	's_header'=>'card-header',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted'
]);

Visualization::define('NORMAL_FIJO',[
	's_head'=>'card-flow',
	's_body'=>'card-body',
	's_header'=>'card-header',
	's_title'=>'card-title',
	's_subtitle'=>'card-subtitle mb-2 text-muted'
]);


?>