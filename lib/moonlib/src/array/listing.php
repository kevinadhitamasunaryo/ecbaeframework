<?php
/**
 * Database, user, password, table, columns, condition
 */
function listing($arr_name,$arr,$old_data){
	$new_data = '';
	if(isset($arr[0])&&is_array($arr[0])){
		foreach($arr as $key_arr => $val_arr){
			$data = $old_data;
			foreach($val_arr as $key => $val){
				$before = '/'.$arr_name."\['".$key."'\]".'/sm';
				
				$after = $val_arr[$key];
				
				$data = preg_replace($before,$after,$data);	
				$before1 = '/'.$arr_name."\[".$key."\]".'/sm';
				$data = preg_replace($before1,$after,$data);	
				
			}
			$new_data .= $data;
		}
		
		return $new_data;
	}
	else{
		$new_data = show($arr_name,$arr,$old_data);
			return $new_data;
	}
	
	
	
}
