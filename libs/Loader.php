<?php

/**
 * CHKN Framework PHP
 * Copyright 2015 Powered by Percian Joseph C. Borja
 * Created May 12, 2015
 *
 *
 * Class Loader
 * This class controls the url set by the user
 * It will divide the url into 4 parts (host/class_name/function_name/parameter)
 * It will load all the Libraries needed on a specific class
 * This class also holds the maintenance class that will be loaded once a class who wish to execute is defined as maintenance(lib/Settings.php)
 * This class also holds the error class that will be loaded once an error on loading class,method and pages occur.
 *
 * Note: This class must be left off-hand. This class is the core class of this framework. Any changes on this class will cause fatal error.
 */

class Loader{
	protected $controller;
	protected $_url;
	//error handler function
	

	public function Url_Controller(){
		session_start();
        $url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);
		$this->controller =  $this->_url[0].'Controller';
		$this->load_model($this->_url[0]);
		$this->load_library();
		$this->load_page_controller($this->controller);
		$this->load_default();
		$this->load_helper();
        $this->load_mailer();
		$maintenance = (explode(',',MAINTENANCE));
		$_SESSION['controller'] = $this->_url[0];
		if(class_exists($this->controller)){
			for($x=0;$x<count($maintenance);$x++){if($this->controller == $maintenance[$x]){$this->maintenance();exit;}}
			$page = new $this->controller;
			$url_count = count($this->_url);
				if(method_exists($this->controller,$this->_url[0])){
					switch($url_count){
                        /**
                         * 1 Parameter found on the URL
                         * Load the class and its default function
                         */
						case '1':
							$page_url = $this->_url[0];
							$page->$page_url();
						break;
                        /**
                         * 2 Parameter found on the URL
                         * Load the class and the second parameter which is the function
                         * Load Error when no function or class found
                         */
						case '2':	
							$page_url = $this->_url[1];
							if(method_exists($this->controller,$this->_url[1])){$page->$page_url();}else{$this->chknError();}
						break;
                        /**
                         * 3 Parameter found on the URL
                         * Load the class, the second parameter which is the function and the third parameter. It's either an ID or any value that the function must be catched.
                         * Load Error when no function or class found
                         */
						case '3':
							$page_url = $this->_url[1];
							$page_data = $this->_url[2];
							if(method_exists($this->controller,$this->_url[1])){$page->$page_url($page_data);}else{$this->chknError();}
						break;
                        /**
                         * 4 Parameter found on the URL
                         * Load the class, the second parameter which is the function and the third parameter and fourth parameter. It's either an ID or any value that the function must be catched.
                         * Load Error when no function or class found
                         */
						case '4':
							$page_url = $this->_url[1];
							$page_data = $this->_url[2];
							$page_data2 = $this->_url[3];
							if(method_exists($this->controller,$this->_url[1])){$page->$page_url($page_data,$page_data2);}else{$this->chknError();}	
						break;
					}
				}else{
					$default = new index;
					$default->index_page();
				}
		}else{
            /**
             * Load error if no class found
             */
			$this->chknError();	
		}
    }
    /**
     * @param $url
     * Loads the Model Library
     * Loads the process_model class that holds all the function that access the database
     */
	protected function load_model($url){
		if(file_exists('libs/Model.php')){
			include('libs/Model.php');
		}
		if(file_exists('model/process_model.php')){
			include('model/process_model.php');
		}
		if(file_exists('model/'.$url.'_model.php')){
			include('model/'.$url.'_model.php');
		}
	}
    /**
     * Loads all the library
     * DOMPDF - Generates and Converts HTML into PDF Document
     * PHPExcel - Generates an Excel File
     * ReCaptcha - Creates a picture captcha for form security
     */
	protected function load_library(){
		foreach (glob("libs/*.php") as $filename){
			if($filename != 'libs/Loader.php' && $filename != 'libs/Model.php'){
				include $filename;
			}
        }
        if(file_exists('libs/PDF/dompdf_config.inc.php')){
            include('libs/PDF/dompdf_config.inc.php');
        }
        if(file_exists('libs/PHPExcel/IOFactory.php')){
           include('libs/PHPExcel/IOFactory.php');
        }
        if(file_exists('libs/ReCaptcha/src/autoload.php')){
            include('libs/ReCaptcha/src/autoload.php');
            $siteKey = DEFAULT_SITE_KEY;
            $secret = DEFAULT_SECRET_KEY;
        }
    }
    /**
     * Load the global_helper class
     */
	protected function load_helper(){
        foreach(glob("process/*.php") as $filename){
            include $filename;
        }
	}
    /**
     * @param $controller
     * Loads a controller which name is base on the value passed by this function
     */
	protected function load_page_controller($controller){
		if(file_exists('controller/'.$controller.'.php')){
			require_once('controller/'.$controller.'.php');
		}
	}
    /**
     * Loads all the default pages of the Framework
     * index - Load the default class that has the highest priority
     * error - Load the error class that notify the user that there is problem accessing a specific class or method or page
     * maintenance - Load the maintenance class that notify the user that the accessed page is under construction or maintenance
     */
	protected function load_default(){
		if(file_exists('controller/index.php')){
			require_once('controller/index.php');
		}
		if(file_exists('controller/error.php')){
			require_once('controller/error.php');
		}
		if(file_exists('controller/maintenance.php')){
			require_once('controller/maintenance.php');
		}
	}

    public function load_mailer(){
        if(file_exists('libs/Mailer/class.phpmailer.php')){
            require_once('libs/Mailer/class.phpmailer.php');
        }

        if(file_exists('libs/Mailer/class.smtp.php')){
            require_once('libs/Mailer/class.smtp.php');
        }
    }

	protected function chknError(){
		$error = new chknError;
		$error->error_page();
	}
	protected function maintenance(){
		$maintenance = new maintenance;
		$maintenance->maintenance_page();
	}
}