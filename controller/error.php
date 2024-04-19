<?php

/**
 *
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 * Class Error
 * Holds the function that will load error page when there is no class or function found
 * $this->html calls the maintenance template
 * $this->html->assign assigns value for variable DEFAULT_PATH
 */
class chknError{
	public function error_page(){
      $template = file_get_contents(DEFAULT_URL.'view/template/error.tpl');
      $template = str_replace('{DEFAULT_PATH}',DEFAULT_URL,$template);
      echo $template;
	}
}
