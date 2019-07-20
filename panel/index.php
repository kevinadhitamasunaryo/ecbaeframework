<?php
/**
 * 1) Load default configuration
 * 2) Load preparation for loading website
 * 3) Load website
 */
require_once 'config.php';
require_once 'prep.php';
$regex = '/' . str_replace(array('/','.'),array('\/','\.'),$uri) . '(.*?)$/';
preg_match($regex,SITE,$tes);
if(isset($tes[1]) && $tes[1] === ''){
	require_once 'ht.php';
}
$website = new ef();
$website->launch();

