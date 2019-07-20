<?php
function urlRedirect($redirect,$cond = true,$redirect_false = null){
	if($cond !== false && $cond !== 0 && $cond !== '0' && trim($cond) !== ''){
		header('Location: ' . $redirect);
		exit;
	}
	else if($redirect_false !== null){
		header('Location: ' . $redirect_false);
		exit;
	}
}
