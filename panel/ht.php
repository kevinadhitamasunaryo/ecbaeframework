<?php
$data =
<<<EOT
RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^/$uri/testing$
RewriteCond %{REQUEST_URI} !^/$uri/testing.php$
RewriteCond %{REQUEST_URI} !^/$uri/index.php$
RewriteCond %{REQUEST_URI} !^/$uri/tpl/.*$
RewriteCond %{REQUEST_URI} !.*/install.php$
RewriteCond %{REQUEST_URI} !.*/create.php$
RewriteCond %{REQUEST_URI} !.*/fix.php$
RewriteCond %{REQUEST_URI} !(\.png|\.jpg|\.gif|\.jpeg|\.bmp|\.svg)$

RewriteRule ^(.*)$ /$uri/index.php?path=$1 [NC,L,QSA]

RewriteCond %{REQUEST_URI} ^/$uri/testing$
RewriteRule ^(.*)$ /$uri/testing_prep.php

RewriteCond %{REQUEST_URI} ^/$uri/tpl/.*$
RewriteRule ^(.*)$ /$uri/tpl.php
EOT;
$ht_file = file_get_contents('.htaccess');
if($ht_file != $data){
	file_put_contents('.htaccess',$data);
	header("Refresh:0");
	exit;
}
