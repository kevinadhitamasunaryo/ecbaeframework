<?php
class page extends ef{
	public function init($ef){
		$this->ef = $ef;
		$this->ef['page'] = parent::grabPart(PAGE_DIR);
		return $this->ef['page'];
	}

}