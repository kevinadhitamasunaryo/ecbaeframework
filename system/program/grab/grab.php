<?php
class grab extends ef{
	public function init($ef){
		$this->ce = $ef;

		$this->ef['grab']['regex']['build']['content'] = '/#content\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['build']['widget'] = '/#widget\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['build']['cmpt'] = '/#cmpt\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['build']['inc'] = '/#inc\{(.*?)\}#/sm';

		$this->ef['grab']['regex']['var'] = '/#var\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['constant'] = '/#const\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['function'] = '/#func\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['class'] = '/#class\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['eval'] = '/#eval\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['fileloc'] = '/#fileloc\{\}#/sm';
		$this->ef['grab']['regex']['uniqid'] = '/#uniqid\{\}#/sm';
		$this->ef['grab']['regex']['rp'] = '/#rp\{(.*?)\}#/sm';
		
		$this->ef['grab']['regex']['vendor'] = '/#vendor\{\}#/sm';
		$this->ef['grab']['regex']['listing'] = '/#(\w+)\(*([\w\d\s\=\>\<\[\]\"\'\)\(\&\|\*\+\/\$\.\!]*)\)*{((?:(?R)|.)*?)}#/sm';
		$this->ef['grab']['regex']['listing1'] = '/#listing\(*([\w\d\s\=\>\<\[\]\"\'\)\(\&\|\*\+\/\$\.\!]*)\)*{((?:(?R)|.)*?)}#/sm';
		$this->ef['grab']['regex']['show'] = '/#show\((.*?)\)\{(.*?)\}#/sm';
		$this->ef['grab']['regex']['uniqid'] = '/#uniqid\{\}#/sm';
		
		$this->ef['grab']['regex']['rule'] = '/#rule\((.*?)\)\{(.*?)\}#/sm';
		
		$this->ef['grab']['output']['search']['urlAddr'] = '/#urlAddr#/sm';
		$this->ef['grab']['output']['replace']['urlAddr'] = URL_ADDR;
		$this->ef['grab']['output']['search']['tpl'] = '/#tpl#/sm';
		$this->ef['grab']['output']['replace']['tpl'] = SITE_ADDR . '/tpl';
		$this->ef['grab']['output']['search']['site'] = '/#site#/sm';
		$this->ef['grab']['output']['replace']['site'] = SITE_ADDR;
		$this->ef['grab']['output']['search']['page'] = '/#page#/sm';
		$this->ef['grab']['output']['replace']['page'] = PAGE_ADDR;


		$this->ef['grab']['form']['from'][0] = 'form';
		$this->ef['grab']['form']['to'][0] = 'form method="post" enctype="multipart/form-data"';
		
		$this->ef['grab']['form']['add'][0]['in'] = 'form';
		$this->ef['grab']['form']['add'][0]['method'] = 'after';
		$this->ef['grab']['form']['add'][0]['this'][0] = '<input type="hidden" name="f" value ="#fileloc{}#">';
		
		return $this->ef['grab'];
	}
}