<?php
function findStartEnd($date){
$date=explode('-',$date); 
$start=date("Y/m/d",strtotime($date[0]));
$end=date("Y/m/d",strtotime($date[1]));
$arr['start'] = $start;
$arr['end'] = $end;
return $arr;
}