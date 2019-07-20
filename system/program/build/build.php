<?php
class build extends ef{
	public $ef;
	public function init($ef){
		$this->ef = $ef;
		$this->defines();
		$this->start();
		$this->supplyBuild();
		return $this->ef['build'];
	}
	public function defines(){
		define('BUILD', array('widget','cmpt','inc'));
		define('BUILD_PATH', array(ABS_PATH . 'build/this', SITE_DIR . 'this', PAGE_DIR . '_this_'));
		define('BUILD_TYPE', array('desg','func','version'));
		define('HTML_PART', array('top','middle','bottom'));
		define('BUILD_APPLICANT', array(SITE_PAGE . '_siteInfo_.txt', PAGE_DIR . '_pageInfo_.txt'));
	}
	public function start(){
		$locs = array(SITE_PAGE . '_start_/', PAGE_DIR . '_start_/');
		foreach($locs as $loc){
			file_exists($loc . '_onload_.php') ? include $loc . '_onload_.php' : null;
		}
	}
	public function supplyBuild(){
		$this->ef['build'] = array();
		foreach(BUILD as $build){
			foreach(BUILD_PATH as $loc){
				$loc = str_replace('this',$build,$loc);
				if(is_dir($loc)){
					foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($loc)) as $file){				
						$file = str_replace('\\','/',$file);
						$arr = explode('/',$file);
						if(end($arr) === '_config_.txt'){
							$dataloc = str_replace('_config_.txt','',$file);
							$info = file_get_contents($file);
							if($info != ''){
							preg_match('/desg_ns\s*=\s*(.*?)\s*$/sim',$info,$desg_ns);
							$desg_ns = $desg_ns[1];
							preg_match('/func_ns\s*=\s*(.*?)\s*$/sim',$info,$func_ns);
							$func_ns = $func_ns[1];
							preg_match('/version\s*=\s*(.*?)\s*$/sim',$info,$version);
							$version = $version[1];
							$this->ef['build'][$build][$desg_ns][$func_ns][$version] = $dataloc;
							}
						}
					}
				}
			}
		}
		define('WIDGET', $this->ef['build']['widget']);
	}
}