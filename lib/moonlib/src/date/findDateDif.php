<?php
function findDateDif($date1,$date2){
$diff = abs(strtotime($date2) - strtotime($date1));

$arr = array();
$arr['y'] = floor($diff / (365*60*60*24));
$arr['m'] = floor(($diff - $arr['y'] * 365*60*60*24) / (30*60*60*24));
$arr['d'] = floor(($diff - $arr['y'] * 365*60*60*24 - $arr['m']*30*60*60*24)/ (60*60*24));
return $arr;
}