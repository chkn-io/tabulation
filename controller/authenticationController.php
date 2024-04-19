<?php
class authenticationController extends Controller{
	public function authentication(){
		//Call index template
		$this->path(TEMPLATE_PATH.'login.tpl');
		//set default title
		$this->assign('DEFAULT_TITLE','User Authentication');
		//set css
		$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
            "matrix-login.css",
            "jquery.gritter.css"
		)));
		
		//set js
		$this->assign('DEFAULT_SCRIPT',$this->view->Html_Objects('js',array(
			"matrix.login.js",
			"jquery.gritter.min.js"
		)));

        // $data = $this->helper->defaults();
		$data = $this->view->Html_Objects('page','login/index.php');
		$this->assign('DEFAULT_BODY',$data);
        $this->assign('DEFAULT_PATH',DEFAULT_URL);
		$this->show();
	}


	public function adminAuth(){
		// echo $this->helper->encrypt('admin');
		if(isset($_POST['username'])){
			$username = $_POST['username'];
			$password = $this->helper->encrypt($_POST['password']);
			$stmt = $this->helper->select(array('accounts',array('username'=>$username,'password'=>$password)));
			if(count($stmt) == 0){
				echo 0;
			}else{
				$_SESSION['auth'] = 'authenticated';
				$_SESSION['auth-type'] = $stmt[0]['type'];
				$_SESSION['auth-id'] = $stmt[0]['id'];
				echo 1;
			}
		}else{
			$this->error();
		}
	}

	public function judgeAuth(){
		if(isset($_POST['judge-code'])){
			$code = $_POST['judge-code'];
			$stmt = $this->helper->select(array('judges',array('judge_code'=>$code)));
			if(count($stmt) == 0){
				echo 0;
			}else{
				$_SESSION['judge'] = 'authenticated';
				$_SESSION['judge-id'] = $stmt[0]['id'];
				$_SESSION['current_event_id'] = $stmt[0]['event_id'];
				echo 1;
			}
		}else{
			$this->error();
		}
	}

	public function logout(){
		unset($_SESSION['auth']);
		unset($_SESSION['auth-type']);
		unset($_SESSION['auth-id']);
		$this->locate('voting');
	}

	public function judgeOut(){
		unset($_SESSION['judge']);
		unset($_SESSION['judge-id']);
		unset($_SESSION['current_event_id']);
		$this->locate('voting');
	}
}
