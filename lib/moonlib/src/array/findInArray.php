<?php
/**
 * Database, user, password, table, columns, condition
 */
function findInArray($a,$b){
$arr = array();
foreach($a as $x){
    foreach($x as $y=> $z){
        if($y===$b){
            array_push($arr,$z);
        }
    }
}
$res = implode(',',$arr);
return($res);
}