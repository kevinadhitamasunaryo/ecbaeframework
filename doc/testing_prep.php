<?php
require_once 'config.php';
require_once 'prep.php';

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ABS_PATH . "lib/moonlib/src")) as $file){
	$arr = explode('.',$file);
	if(end($arr) === 'php'){
		require_once($file);
	}
}

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ABS_PATH . "test")) as $file){
	$arr = explode('.',$file);
	if(end($arr) === 'php'){
		require_once($file);
	}
}

// include class launcher
foreach(glob(ABS_PATH . "launcher/class/*.php") as $class){
	require_once $class;
}

// include program launcher
foreach(glob(ABS_PATH . "launcher/program/*.php") as $program){
	require_once $program;
}

foreach(glob(ABS_PATH . "system/class/*.php") as $class){
	require_once $class;
}

foreach(glob(ABS_PATH . "system/program/*") as $folder){
	foreach(glob($folder . "/*.php") as $program){
		require_once $program;
	}
}

require_once 'testing.php';