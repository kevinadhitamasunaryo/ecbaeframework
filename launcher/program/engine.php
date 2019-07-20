<?php
class engine extends ef{
	public $before = array();
	public $replace = array();
	public $after = array();
		
	public function __construct(){
		global $ef;
		// include class
		foreach(glob(ABS_PATH . "system/class/*.php") as $class){
			require_once $class;
		}
		
		// include path
		require ABS_PATH . 'launcher/program/_path_.php';
		
		// modify system
		$this->modify_sys();
		
		// run system		
		foreach($systems as $system){
			foreach($$system as $sys){
				$sys_arr = array($sys);
				require_once ABS_PATH . "system/program/$system/$sys.php";
				
				// exec before current
				if(isset($this->before[$sys])){ parent::run_sys($this->before[$sys]); }
				
				// exec replacement for current
				if(isset($this->replace[$sys])){ parent::run_sys($this->replace[$sys]); return; }
				
				// exec current
				parent::run_sys($sys_arr);
				print_r($ef);
				// exec after current
				if(isset($this->after[$sys])){ parent::run_sys($this->after[$sys]); }
			}
		}
	}
	
	public function modify_sys(){
		foreach(glob(ABS_PATH . 'plugin/' . '*' . '/_init_.php') as $filename){
			$file = file_get_contents($filename);
			if(preg_match('/before/',$file)){
				if(!isset($before_sys)){
					$before_sys = array();
				}
				array_push($before_sys,$class);
			}
			if(preg_match('/replace/',$file)){
				if(!isset($replace_sys)){
					$replace_sys = array();
				}
				array_push($replace_sys,$class);
			}
			if(preg_match('/after/',$file)){
				if(!isset($after_sys)){
					$after_sys = array();
				}
				array_push($after_sys,$class);
			}
		}
	}
}