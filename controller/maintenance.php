<?php
/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 * Class maintenance
 * Holds the function that will load maintenance page on the class that is defined on the Settings Library
 * $this->html calls the maintenance template
 * $this->html->assign assigns value for variable DEFAULT_PATH
 */
class maintenance extends Controller{
	public function maintenance_page(){
		$this->path(TEMPLATE_PATH.'maintenance.tpl');
		$this->assign('DEFAULT_PATH',DEFAULT_URL);
		$this->show();
	}
}
	