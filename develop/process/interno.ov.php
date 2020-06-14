<?php
    
    use core\kernel\ovalo;
	use core\kernel\color;

	$sec2 = ovalo::section('sec2');
	$sec3 = ovalo::section('sec3');
    $sec4 = ovalo::section('sec4');


	//$sec2->properties->video='https://mdbootstrap.com/img/video/animation-intro.mp4';
	//$sec4->properties->video='https://mdbootstrap.com/img/video/animation-intro.mp4';
	//$sec3->hide();

	$sec4->switchSections('sec3');
	$sec3->hide();

?>