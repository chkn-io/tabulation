<?php
class index extends Controller{
	public function index_page(){
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth-type'] == "admin"){
				//Call index template
				$this->path(TEMPLATE_PATH.'index.tpl');
				//set default title
				$this->assign('DEFAULT_TITLE','Tabulation System - Administrator');
				//set css
				$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
					"green.css",
					"custom.min.css",
					"bootstrap-progressbar-3.3.4.min.css"
				)));
				
				//set js
				$this->assign('DEFAULT_SCRIPT',$this->view->Html_Objects('js',array(
					"fastclick.js",
					"bootstrap-progressbar.min.js",
					"nprogress.js",
					"icheck.min.js",
					"moment.min.js",
					"gauge.min.js",
					"skycons.js",
					"custom.min.js"
				)));
		        // $data = $this->helper->defaults();
				$data = $this->view->Html_Objects('page','homepage/index.php');
				$this->assign('DEFAULT_BODY',$data);
		        $this->assign('DEFAULT_PATH',DEFAULT_URL);
		         $this->setup();
				$this->show();
			}
		}else{
			$this->locate("voting");
		}
		
	}
}
