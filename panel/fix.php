<?php
$uri = ltrim(preg_replace('/(.*?)\/fix\.php$/','${1}', $_SERVER['REQUEST_URI']),'/');
include 'ht.php';
$redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/$uri";
$redirect = str_replace('create.php','',$redirect);
$redirect = trim('/',$redirect);
if($redirect==''){
	$redirect = 'index.php';
}

file_put_contents('.htaccess',$data);

echo "
Redirecting...<br>
<script>
function redirect(){
window.location='$redirect';
}
setTimeout(function(){ redirect(); }, 2000);
</script>
";
exit;