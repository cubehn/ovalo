<?php
	/*
		CENTINEL
	*/
	namespace core\sentinel;

	class sentinel
	{
		private static $info;
		public static $number;
		public static $messages;

		static function add($step)
		{
			self::$info[count(self::$info)]=$step;
		}
		static function getTokenItem($key)
		{
			$nk = $key.OVALO_TIC;
			return md5($nk);
		}
		static function showLoadedFiles()
		{
			$in = '';
			$count_files = count(self::$info);
			for($i=0;$i<$count_files;$i++) 
			{
				$in = $in.'<div class="text-white w-auto">'.self::$info[$i].'</div>';
			}
			$html = $in;


			return $html;
		}
		static function readMessage($language,$line){
			$m='';	
			$d=OVALO_CDIR."/core/config/Languages/$language.ovlg";
			file_exists($d) or die ("Error: El archivo no existe.");			
			$file = fopen($d, "r");
		 
			$line=$line+17;
			for($i=0;$i<=$line;$i++)
			{
				if(!feof($file)) fgets($file);
			} 

			$m = fgets($file);

		    fclose($file); 

		    return $m;
		}
		static function alert($id,$ms){
			switch($id){
				case 1:
					$m='Archivo estructura del Shade ['.$ms.']';
					break;
				case 2:
					$m='Conexion Satisfactoria ['.$ms.']';
					break;
				case 3:
					$m='No hay conexion con base de datos';
					break;
			}
			return $m;
		}

		static function InitER()
		{
			unset($_SESSION['ov_messages']);
			unset($_SESSION['ov_test']);
		}
		/*
			Registra un error
		*/
		static function registerER($obj,$lg,$numMsg)
		{
			$m = self::readMessage($lg,$numMsg);
			if(isset($_SESSION['ov_messages'][$obj][$numMsg]))
			{
				$count_msg = $_SESSION['ov_messages'][$obj][$numMsg]['count']++;
			}
			else
			{
				$count_msg = 1;
				$_SESSION['ov_messages'][$obj][$numMsg]=['obj'=>$obj,'msg'=>$m, 'count'=>$count_msg];
			}
		}
		static function registerTest($key,$msg)
		{
			if(!isset($_SESSION['ov_test'])) 
			{
				$_SESSION['ov_test'] = Array();
			}
			$count_t = count($_SESSION['ov_test']);
			$_SESSION['ov_test'][$count_t]['msg'] = $msg;
			$_SESSION['ov_test'][$count_t]['key'] = '['.$key.']: ';
		}
		static function hasErrors()
		{
			$r = 0;
			if(isset($_SESSION['ov_messages'])) 
			{
				$r = count($_SESSION['ov_messages']);
			}

			return $r;
		}
		static function showTest()
		{
			$html = '';
			if(isset($_SESSION['ov_test']))
			{
				$in = '';
				$count_test = count($_SESSION['ov_test']);
				for($i=0;$i<$count_test;$i++) 
				{
					$in = $in.'<div class="text-white w-auto">'.$_SESSION['ov_test'][$i]['key'].'<div class="alert alert-secondary" role="alert">'.$_SESSION['ov_test'][$i]['msg'].'</div></div>';
				}
				$html = $in;
			}

			return $html;
		}
		static function showErrors()
		{
			if(!isset($_SESSION['ov_messages'])) 
			{
				$in='correcto.';
			}
			else
			{
				$in = '';
				$msg = $_SESSION['ov_messages'];
				foreach ($msg as $m) 
				{
					foreach ($m as $im) {
						$in = $in.'<div class="border border-white bg-danger w-auto my-1 p-1 text-white"><span class="badge badge-light">'.$im['count'].'</span> '.$im['msg'].'<br><span class="badge badge-warning">'.$im['obj'].'</span></div>';
					}
				} 
			}
			/*$html='<div class="card text-white bg-dark col-sm-6">
					  <div class="card-header">Errores</div>
					  <div class="card-body">
					    '.$in.'
					  </div>
					</div>';*/
			$html=$in;

			return $html;
		}

		static function showDebug()
		{
			$html='<div class="container-fluid">
				<div class="row border-white bg-dark">
				  <div class="col-3 ">
				    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				      <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Errors</a>
				      <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Files System</a>
				      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Constants</a>
				      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
				      <a class="nav-link" id="v-pills-test-tab" data-toggle="pill" href="#v-pills-test" role="tab" aria-controls="v-pills-test" aria-selected="false">Test</a>
				    </div>
				  </div>
				  <div class="col-9">
				    <div class="tab-content" id="v-pills-tabContent">
				      <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">'.self::showErrors().'</div>
				      <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">'.self::showLoadedFiles().'</div>
				      <div class="tab-pane fade text-white" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">TIME: '.OVALO_INIT.'<br>DIR: '.OVALO_CDIR.'</div>
				      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
				      <div class="tab-pane fade" id="v-pills-test" role="tabpanel" aria-labelledby="v-pills-test-tab">'.self::showTest().'</div>
				    </div>
				  </div>
				</div>
				</div>';


			return $html;
		}
	}



?>