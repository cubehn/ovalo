<?php
if(!isset($_SESSION)) session_start();



$return='';
$chls='null';
$returnchls='';
$target = $_POST['exe'];
$temp=$_POST['temp'];

if(isset($_SESSION['ov_gsectionInfo'][$target]['code']))
{
	if($_SESSION['ov_gsectionInfo'][$target]['type']=='script')
	{
		$return = $_SESSION['ov_gsectionInfo'][$target]['code'];
	}
	if($_SESSION['ov_gsectionInfo'][$target]['type']=='file')
	{
		$r='none';
		$rt='../../develop/files/'.$_SESSION['ov_gsectionInfo'][$target]['code'];
		if(file_exists($rt))$r=file_get_contents($rt);
		$return = $r;
	}
	if($_SESSION['ov_gsectionInfo'][$target]['type']=='spot')
	{
		//FALTA POR TRABAJAR
	}

	$_SESSION['ov_gsectionInfo'][$target]['code']='';

	if(isset($_SESSION['ov_gsectionInfo'][$target]['chls']))
	{
		$chls = $_SESSION['ov_gsectionInfo'][$target]['chls'];
		for($i=0;$i<count($chls);$i++)
		{
			$returnchls = $returnchls.$chls[$i].',';
		}
	}	
}






echo $target.'¬'.$returnchls.'¬'.$return;

?>