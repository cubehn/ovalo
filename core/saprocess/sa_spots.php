<?php
if(!isset($_SESSION)) session_start();

include $_SERVER['DOCUMENT_ROOT'].'test/Core/Kernel/config.php';
include $_SERVER['DOCUMENT_ROOT'].'test/dev/config.php';
include $_SERVER['DOCUMENT_ROOT'].'test/Core/Kernel/master.php';
include $_SERVER['DOCUMENT_ROOT'].'test/dev/sources/connections.php';



$psec=$_POST['exe'];
$pspot=$_POST['exe2'];
$pmode=$_POST['exe3'];

include $_SERVER['DOCUMENT_ROOT'].'test/dev/spots/'.$pspot.'.spot.php';


$spot->get($pmode,$psec);

$_SESSION['ov_gspots'][$pspot]=$spot->items;
?>