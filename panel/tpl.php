<?php
require_once 'config.php';
require_once 'prep.php';

$tpl_path = trim(str_replace(SITE_DIR . 'page/', '', $urldir2),'/');

$tpl_url = ABS_URL . $tpl_path;
$tpl_path = ABS_PATH . $tpl_path;

$content_type = get_headers($tpl_url, 1);
$content_type = $content_type['Content-Type'];

if(is_array($content_type)){
	$content_type = $content_type[0];
}

header('Content-Type: ' . $content_type);

if(is_file($tpl_path)){
	readfile($tpl_path);
}
else{
	echo '';
}
