<?php
/**
 * 1) Check if this website using multisite configuration
 * 2) Get relative paths
 * 3) Set relative paths
 * 4) Include launcher
 */

/** 0 **/
function CE_sanitizeUrl($url){
	$new_url = trim(preg_replace('/(\?.*?)$/sm','',preg_replace('/(index\.php)$/i','',str_replace('\\','/',$_SERVER[$url]))));
	return $new_url;
}
define('SCRIPT_FILENAME'	, CE_sanitizeUrl('SCRIPT_FILENAME'));
define('HTTP_HOST'			, CE_sanitizeUrl('HTTP_HOST'));
define('REQUEST_URI'		, CE_sanitizeUrl('REQUEST_URI'));
define('PHP_SELF'			, CE_sanitizeUrl('PHP_SELF'));
define('DOCUMENT_ROOT'		, CE_sanitizeUrl('DOCUMENT_ROOT'));
define('QUERY_STRING'		, CE_sanitizeUrl('QUERY_STRING'));
if(isset($_SERVER['HTTP_REFERER'])){
	define('HTTP_REFERER'	, CE_sanitizeUrl('HTTP_REFERER'));
}
else{
	define('HTTP_REFERER'	, 'self');
}

/** 1 **/
is_dir('site') ? define('MULTISITE', "0") : define('MULTISITE', "1");

/** 2 **/
if(QUERY_STRING != '' && is_numeric(strpos(QUERY_STRING,'path='))){
	$relpath = trim(preg_replace('/^path\=/sm','',preg_replace('/^path\=(.*?)\&.*/sm','${1}',QUERY_STRING)),'/');
}
else{
	$relpath = '';
}


switch(MULTISITE){
	case 1:
		$abspath = trim(str_replace('\\','/',realpath(__DIR__ . '/../../') . '/'));
		$preg = preg_replace('/^(.*?)(\/site\/)/i','',SCRIPT_FILENAME);
		$array = explode('/', trim($preg, '/'));
		$sitedir = $abspath . 'site/' . $array[0] . '/';
		$sitename = $array[0];
		break;
	case 0:
		$script = trim(SCRIPT_FILENAME,'/');
		$array = explode('/',$script);
		
		$abspath =  __DIR__ . '/';
		$sitedir = $abspath;
		$sitename = end($array);
		break;
}
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$http_url = $http . '://';
$absurl = str_replace(DOCUMENT_ROOT, $http_url . HTTP_HOST, $abspath);
$sitedir = str_replace('\\','/',$sitedir);
$explode = explode('/',$relpath);

$pagename = ($explode[0] == '') ? DEFAULT_HOME : $explode[0];


$possible_page_1 = $sitedir . 'page/' . $pagename . '/' . DEFAULT_INDEX;
$possible_page_2 = $sitedir . 'page/' . $pagename;
$possible_page_3 = $sitedir . 'page/' . DEFAULT_HOME . '/' . $pagename;

if(file_exists($possible_page_1)){
	$pagedir = $possible_page_1;
}
else if(file_exists($possible_page_2)){
	$pagedir = $possible_page_2;
}
else{
	$pagedir = $possible_page_3;
}

$pagedir = $pagedir . '/';
$pagedir = preg_replace('/\/\/$/','/',$pagedir);
$urladdr = trim($http . "://" . HTTP_HOST . REQUEST_URI,'/');

$possible_urldir_1 = str_replace($sitedir, $sitedir . 'page/', DOCUMENT_ROOT . REQUEST_URI . '/index/');
$possible_urldir_2 = str_replace($sitedir, $sitedir . 'page/', DOCUMENT_ROOT . REQUEST_URI . '/');
$possible_urldir_3 = str_replace($sitedir, $sitedir . 'page/home/', DOCUMENT_ROOT . REQUEST_URI . '/index/');
$possible_urldir_4 = str_replace($sitedir, $sitedir . 'page/home/', DOCUMENT_ROOT . REQUEST_URI . '/');

if(file_exists($possible_urldir_1)){
	$urldir = $possible_urldir_1;
}
else if(file_exists($possible_urldir_2)){
	$urldir = $possible_urldir_2;
}
else if(file_exists($possible_urldir_3)){
	$urldir = $possible_urldir_3;
}
else{
	$urldir = $possible_urldir_4;
}
if(is_numeric(strpos($urldir,'/page//'))){
	$urldir = $pagedir;
}
$urldir = preg_replace('/\/\/$/','/',$urldir);

$urldir2 = DOCUMENT_ROOT . REQUEST_URI;

$urldir2 = str_replace($sitedir, $sitedir . 'page/', $urldir2);

$urldir2 = $urldir2 . '/';
$urldir2 = preg_replace('/\/\/$/','/',$urldir2);
$urldir3 = urlencode($urldir);

$urlend = trim(trim(str_replace($pagedir, '', $urldir2),'/'));
$urlend = ($urlend === '' || $urlend === $urldir) ? DEFAULT_INDEX : $urlend;
$urlend = $urlend . '/';

$relpath2 = str_replace('/','\/',$relpath);
$site = preg_replace('/\/\/$/','/',preg_replace('/'.$relpath2.'$/','',$urladdr));
$page = str_replace($sitedir,$site,$pagedir);
$page = str_replace('/home','',$page);
$page = str_replace('/index','',$page);
/** 3 **/
$site = rtrim($site,'/');
$page = rtrim($page,'/');
$uri = trim(REQUEST_URI,'/');
/** **/
define('HTTP'			, $http);
define('HTTP_URL'		, $http_url);
define('REL_PATH'		, $relpath);
define('ABS_PATH'		, $abspath);
define('ABS_URL'		, $absurl);

define('SITE_DIR'		, $sitedir);
define('SITE'			, $site);
define('SITE_ADDR'		, $site);
define('SITE_PAGE'		, $sitedir . 'page/');
define('PAGE_DIR'		, $pagedir);
define('PAGE'			, $page);
define('PAGE_ADDR'		, $page);
define('SITE_NAME'		, $sitename);
define('PAGE_NAME'		, $pagename);

define('URL_ADDR'		, $urladdr);
define('URL_DIR'		, $urldir);
define('URL_END'		, $urlend);


/** 4 **/
require_once ABS_PATH . 'launcher/program/_init_.php';