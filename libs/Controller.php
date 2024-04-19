<?php

/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 *
 * Class Controller
 * This class holds a function that will replace all the variable with {} inside a template and a page
 * This class also direct the system who will be showed to the browser
 */
class Controller{
	var $assignedValues = array();
	var $tpl;
    public $helper;
    public $view;
    public $error;

    /**
     * @param string $_path
     * A function that get the requested template
     */

    function __construct(){
        $this->helper = new global_helper;
        $this->view = new View;
        $this->error = new chknError;
    }
	function path($_path = ''){
		if(!empty($_path)){
			if(file_exists($_path)){
				$this->tpl = file_get_contents($_path);	
			}else{
				$this->chknError();
			}
		}
	}

    /**
     * @param $_searchString
     * @param $_replacedString
     * This function is responsible for replacing variables with {} to its defined values
     */
	function assign($_searchString, $_replacedString){
		if(!empty($_searchString)){
			$this->assignedValues[strtoupper($_searchString)] = $_replacedString;
		}
	}

    /**
     *This function executes the requested page(template,page,css,js,etc.)
     */
	function show(){
		if(count($this->assignedValues) > 0){
			foreach($this->assignedValues as $key => $value){
				$this->tpl = str_replace('{'.$key.'}',$value,$this->tpl);
			}
			echo $this->tpl;
		}
	}

    function locate($url){
        header('location:'.DEFAULT_URL.$url);
    }

    function chknError(){
        $this->error->error_page();
    }

    public function setup(){
        $id = $_SESSION['auth-id'];
        $stmt = $this->helper->select(array('accounts',array('id'=>$id)));
        $this->assign("PRO_IMAGE",$stmt[0]['image']);
        $this->assign("USER_NAME",$stmt[0]['name']);
    }

}