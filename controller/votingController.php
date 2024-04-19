<?php
class votingController extends Controller{
	public function voting(){

		if(!isset($_SESSION['judge'])){
				//Call index template
			$this->path(TEMPLATE_PATH.'voting.tpl');
			//set default title
			$this->assign('DEFAULT_TITLE','Judge Authentication');
			//set css
			$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
	            "matrix-login.css",
	            "jquery.gritter.css"
			)));
			
			//set js
			$this->assign('DEFAULT_SCRIPT',$this->view->Html_Objects('js',array(
				"script-jlogin.js",
				"jquery.gritter.min.js"
			)));

	        // $data = $this->helper->defaults();
			$data = $this->view->Html_Objects('page','login/index.php');
			$this->assign('DEFAULT_BODY',$data);
	        $this->assign('DEFAULT_PATH',DEFAULT_URL);
			$this->show();
		}else{
			$this->locate("voting/dashboard");
		}
			
		
		
	}

	public function dashboard(){
		if(isset($_SESSION['judge'])){
			//Call index template
			$this->path(TEMPLATE_PATH.'judge.tpl');
			//set default title
			$this->assign('DEFAULT_TITLE','Voting System');
			//set css
			$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
	            "green.css",
				"custom.min.css",
				"style-event.css",
				"daterangepicker.css",
				"jquery.gritter.css",
				"style-voting.css",
				"slick.css"
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
				"custom.min.js",
				"daterangepicker.js",
				"jquery.gritter.min.js",
				"slick.min.js"
			)));

	        // $data = $this->helper->defaults();
			$data = $this->view->Html_Objects('page','voting/index.php');
			$this->assign('DEFAULT_BODY',$data);
	        $this->assign('DEFAULT_PATH',DEFAULT_URL);
	        $this->getEventInfo();
	        $this->getSponsor();
			$this->show();
		}else{
			$this->locate("voting");
		}
		
	}

	public function proper(){
		if(isset($_SESSION['judge'])){
			//Call index template
			$this->path(TEMPLATE_PATH.'judge.tpl');
			//set default title
			$this->assign('DEFAULT_TITLE','Voting System');
			//set css
			$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
	            "green.css",
				"custom.min.css",
				"style-event.css",
				"daterangepicker.css",
				"jquery.gritter.css",
				"style-voting.css",
				"slick.css"
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
				"custom.min.js",
				"daterangepicker.js",
				"jquery.gritter.min.js",
				"script-voting.js",
				"slick.min.js"
			)));

	        // $data = $this->helper->defaults();
			$data = $this->view->Html_Objects('page','voting/proper.php');
			$this->assign('DEFAULT_BODY',$data);

	        $this->assign('DEFAULT_PATH',DEFAULT_URL);
	        $this->getEventInfo();
	        $this->getSponsor();
			$this->show();
		}else{
			$this->locate("voting");
		}
	}

	private function getSponsor(){
		$stmt = $this->helper->select(array('sponsors',array('event_id'=>$_SESSION['current_event_id'])));
		$html = "";

		for($x=0;$x<count($stmt);$x++){
			$html.='

			<div class="com-md-3">
              <img src="'.DEFAULT_URL.'public/images/sponsors/'.$stmt[$x]['logo'].'">
            </div>

            ';
		}

		$this->assign("DEFAULT_SPONSOR",$html);
	}

	private function getEventInfo(){
		$stmt = $this->helper->select(array('events',array(
			'id'=>$_SESSION['current_event_id']
		)));
		$judge  = $this->helper->select(array('judges',array(
			'id'=>$_SESSION['judge-id']
		)));
		$this->assign('EVENT_NAME',$stmt[0]['event_name']);
		$this->assign('USER_NAME',$judge[0]['name']);
	}


	public function getVoting(){
		$stmt = $this->helper->select(array('levels',array(
			'event_id'=>$_SESSION['current_event_id'],
			'status'=>"on going"
		)));
		$_SESSION['active_level'] = $stmt[0]['id'];

		$stmtRare = $this->helper->select(array('categories',array(
			'level_id'=>$_SESSION['active_level'],
			'status'=>"on going"
		)));

		if(count($stmtRare) != 0){
			$_SESSION['active_cat'] = $stmtRare[0]['id'];
		}

		

		$titles = $stmt[0]['level_name'];
		$count = $stmt[0]['no_contestants'];

		$id = $stmt[0]['id'];

		$event = $this->helper->select(array('categories',array(
			'level_id'=>$id
		)));
		// print_r($event);
		$links = "";
		$counter = 0;
		$rechecker = 0;
		$con = "";
		for($x=0;$x<count($event);$x++){

			$counter++;
			$class = "";

			if($event[$x]['status'] == "pending"){
				$class = "disabled";
			}elseif($event[$x]['status'] == "on going"){
				$class = "selected";
			}elseif($event[$x]['status'] == "done"){
				$class = "done";
			}

			$subs = $this->helper->select(array('sub_categories',array(
				'category_id'=>$event[$x]['id']
			)));
			$subcat = "";

			for($z=0;$z<count($subs);$z++){
				$subcat .=$subs[$z]['sub_name'].' / ';
			}

			$links.='
				<li>
                  <a href="#step-'.$x.'"  class="'.$class.'">
                    <span class="step_no">'.$counter.'</span>
                    <span class="step_descr">
                    	'.$event[$x]['category'].'
                      <br />
                      <small>'.$subcat.'</small>
                  </span>
                  </a>
                </li>
			';
			
				
	                      		if($stmt[0]['can_source'] == 0){
	                      			$con.='
						<div id="step-'.$x.'" class="step-con">
	                      <hr>
	                      <h3 class="bg-primary" style="padding:10pt;">'.$event[$x]['category'].'</h3>
	                      <hr>
	                      	<div class="col-md-6">
	                      		<p class="bg-primary">Section 1</p>
	                      		<nav>';
	                      				if($event[$x]['status'] == "on going"){
											$boys = $this->helper->select(array('candidates',array(
				                      			'gender'=>'Male',
				                      			'event_id'=>$_SESSION['current_event_id']
			                      			)));

			                      			
			                      		for($a=0;$a<count($boys);$a++){
			                      			$checker = $this->helper->select(array('scores',array(
			                      				'cat_id'=>$_SESSION['active_cat'],
			                      				'event_id'=>$_SESSION['current_event_id'],
			                      				'candidate_id'=>$boys[$a]['id'],
			                      				'judge_id'=>$_SESSION['judge-id']
		                      				)));
			                      			// echo count($checker);
		                      				if(count($checker) == 0){
			                      				$con.='<a href="#" class="bg-warning vote-box" data-record="'.$boys[$a]['id'].'"><span>'.$boys[$a]['candidate_number'].'</span> '.$boys[$a]['name'].' / '.$boys[$a]['tag'].' / '.$boys[$a]['institution'].'</a>';
			                      				$rechecker++;
		                      				}else{
		                      					$edit = "<table class='table'><tbody>";
		                      					for($b=0;$b<count($checker);$b++){
		                      						$sub_cat = $this->helper->select(array('sub_categories',array(
		                      							'id'=>$checker[$b]['sub_cat_id']
	                      							)));
	                      							$edit.= '<tr><td>'.$sub_cat[0]['sub_name'].'</td><td>';
		                      						$edit .= $checker[$b]['raw_score'];
		                      						$edit.='</td><td><button class="btn btn-primary btn-xs edit-score pull-right" data-max="'.$sub_cat[0]['max_score'].'" data-min="'.$sub_cat[0]['min_score'].'" data-record="'.$checker[$b]['id'].'" data-score="'.$checker[$b]['raw_score'].'"><i class="fa fa-edit"></i></button><td></tr>';
		                      					}
		                      					$edit.='<tbody></table>';
		                      					$con.='<p href="#" class="bg-warning" data-record="'.$boys[$a]['id'].'"><span>'.$boys[$a]['candidate_number'].'</span> '.$boys[$a]['name'].' / '.$boys[$a]['tag'].' / '.$boys[$a]['institution'].'<span class="pull-right">'.$edit.'<span></p>';
			                      				$rechecker++;
		                      				}
			                      		}
								}
		                      			
		       				 $con.='</nav>

		       				 
                   		</div>
							<div class="col-md-6">
								<p class="bg-primary">Section 2</p>
								<nav>';

									$girls = $this->helper->select(array('candidates',array(
				                      			'gender'=>'Female',
				                      			'event_id'=>$_SESSION['current_event_id']
			                      			)));

			                      		for($a=0;$a<count($girls);$a++){
			                      			$checker = $this->helper->select(array('scores',array(
			                      				'cat_id'=>$_SESSION['active_cat'],
			                      				'event_id'=>$_SESSION['current_event_id'],
			                      				'candidate_id'=>$girls[$a]['id'],
			                      				'judge_id'=>$_SESSION['judge-id']
		                      				)));
			                      			// echo count($checker);
		                      				if(count($checker) == 0){
			                      				$con.='<a href="#" class="bg-warning vote-box" data-record="'.$girls[$a]['id'].'"><span>'.$girls[$a]['candidate_number'].'</span> '.$girls[$a]['name'].' / '.$girls[$a]['tag'].' / '.$girls[$a]['institution'].'</a>';
			                      				$rechecker++;
		                      				}else{
		                      					$edit = "<table class='table'><tbody>";
		                      					for($b=0;$b<count($checker);$b++){
		                      						$sub_cat = $this->helper->select(array('sub_categories',array(
		                      							'id'=>$checker[$b]['sub_cat_id']
	                      							)));
	                      							$edit.= '<tr><td>'.$sub_cat[0]['sub_name'].'</td><td>';
		                      						$edit .= $checker[$b]['raw_score'];
		                      						$edit.='</td><td><button class="btn btn-primary btn-xs edit-score pull-right" data-max="'.$sub_cat[0]['max_score'].'" data-min="'.$sub_cat[0]['min_score'].'" data-record="'.$checker[$b]['id'].'" data-score="'.$checker[$b]['raw_score'].'"><i class="fa fa-edit"></i></button><td></tr>';
		                      					}
		                      					$edit.='<tbody></table>';
		                      					$con.='<p href="#" class="bg-warning" data-record="'.$girls[$a]['id'].'"><span>'.$girls[$a]['candidate_number'].'</span> '.$girls[$a]['name'].' / '.$girls[$a]['tag'].' / '.$girls[$a]['institution'].'<span class="pull-right">'.$edit.'<span></p>';
			                      				$rechecker++;
		                      				}
			                      		}
						$con.='		</nav>
							</div>


                   		</div>';
	                      		//Based on Candidate Source
	                      		}else{
	                      			$con.='
						<div id="step-'.$x.'" class="step-con">
	                      <hr>
	                      <h3 class="bg-primary" style="padding:10pt;">'.$event[$x]['category'].'</h3>
	                      <hr>
	                      	<div class="col-md-6">
	                      		<p class="bg-primary">Section 1</p>
	                      		<nav>';
	                      			$getCurrent_level = $this->helper->select(array('levels',array(
	                      				'id'=>$stmt[0]['can_source']
                      				)));
	                      			if($event[$x]['status'] == "on going"){
	                      				$c = $getCurrent_level[0]['no_winner'];

	                      				$source = $this->helper->query(array('SELECT * FROM level_result WHERE level_id=:param1 ORDER BY percentage DESC',array(
	                      					$stmt[0]['can_source']
	                   					)));

	                      				$candidate_list = array();
	                      				
	                      				foreach ($source as $key => $value) {
	                      					$can = $this->helper->select(array('candidates',array(
	                   							'id'=>$value['candidate_id'],
	                   							'gender'=>'Male'
	                							)));
	                      						if(isset($can[0]["id"])){
	                      							$candidate_list[$can[0]['id']] = array('id'=>$can[0]['id'],'name'=>$can[0]['name'],'candidate_number'=>$can[0]['candidate_number'],'tag'=>$can[0]['tag'],'institution'=>$can[0]['institution']);
	                      						}
	                      				}
	                   					
	                   					$counter = 0;
	                   						foreach ($candidate_list as $key => $value) {
	                   							
	                   							$counter++;
	                   							if($counter <= $c){
	                   								$checker = $this->helper->select(array('scores',array(
					                      				'cat_id'=>$_SESSION['active_cat'],
					                      				'event_id'=>$_SESSION['current_event_id'],
					                      				'candidate_id'=>$value['id'],
					                      				'judge_id'=>$_SESSION['judge-id']
				                      				)));

				                      				if(count($checker) == 0){
				                      					$con.='<a href="#" class="bg-warning vote-box" data-record="'.$value['id'].'"><span>'.$value['candidate_number'].'</span> '.$value['name'].' / '.$value['tag'].' / '.$value['institution'].'</a>';
				                      					$rechecker++;
				                      				}else{
				                      					$edit = "<table class='table'><tbody>";
				                      					for($b=0;$b<count($checker);$b++){
				                      						$sub_cat = $this->helper->select(array('sub_categories',array(
				                      							'id'=>$checker[$b]['sub_cat_id']
			                      							)));

			                      							$edit.= '<tr><td>'.$sub_cat[0]['sub_name'].'</td><td>';
				                      						$edit .= $checker[$b]['raw_score'];
				                      						$edit.='</td><td><button class="btn btn-primary btn-xs edit-score pull-right" data-max="'.$sub_cat[0]['max_score'].'" data-min="'.$sub_cat[0]['min_score'].'" data-record="'.$checker[$b]['id'].'" data-score="'.$checker[$b]['raw_score'].'"><i class="fa fa-edit"></i></button><td></tr>';
				                      					}
				                      					$edit.='<tbody></table>';
				                      					$con.='<p href="#" class="bg-warning" data-record="'.$value['id'].'"><span>'.$value['candidate_number'].'</span> '.$value['name'].' / '.$value['tag'].' / '.$value['institution'].'<span class="pull-right">'.$edit.'<span></p>';
					                      				$rechecker++;
				                      				}
	                   							}
	                   							
	                   						}

	                   						 $con.='</nav>

		       				 
					                   		</div>
												<div class="col-md-6">
													<p class="bg-primary">Section 2</p>
													<nav>';

														$candidate_list = array();
	                      				
	                      				foreach ($source as $key => $value) {
	                      					$can = $this->helper->select(array('candidates',array(
	                   							'id'=>$value['candidate_id'],
	                   							'gender'=>'Female'
	                							)));
	                      						if(isset($can[0]["id"])){
	                      							$candidate_list[$can[0]['id']] = array('id'=>$can[0]['id'],'name'=>$can[0]['name'],'candidate_number'=>$can[0]['candidate_number'],'tag'=>$can[0]['tag'],'institution'=>$can[0]['institution']);
	                      						}
	                      				}
	                   					
	                   					$counter = 0;
	                   						foreach ($candidate_list as $key => $value) {
	                   							
	                   							$counter++;
	                   							if($counter <= $c){
	                   								$checker = $this->helper->select(array('scores',array(
					                      				'cat_id'=>$_SESSION['active_cat'],
					                      				'event_id'=>$_SESSION['current_event_id'],
					                      				'candidate_id'=>$value['id'],
					                      				'judge_id'=>$_SESSION['judge-id']
				                      				)));

				                      				if(count($checker) == 0){
				                      					$con.='<a href="#" class="bg-warning vote-box" data-record="'.$value['id'].'"><span>'.$value['candidate_number'].'</span> '.$value['name'].' / '.$value['tag'].' / '.$value['institution'].'</a>';
				                      					$rechecker++;
				                      				}else{
				                      					$edit = "<table class='table'><tbody>";
				                      					for($b=0;$b<count($checker);$b++){
				                      						$sub_cat = $this->helper->select(array('sub_categories',array(
				                      							'id'=>$checker[$b]['sub_cat_id']
			                      							)));

			                      							$edit.= '<tr><td>'.$sub_cat[0]['sub_name'].'</td><td>';
				                      						$edit .= $checker[$b]['raw_score'];
				                      						$edit.='</td><td><button class="btn btn-primary btn-xs edit-score pull-right" data-max="'.$sub_cat[0]['max_score'].'" data-min="'.$sub_cat[0]['min_score'].'" data-record="'.$checker[$b]['id'].'" data-score="'.$checker[$b]['raw_score'].'"><i class="fa fa-edit"></i></button><td></tr>';
				                      					}
				                      					$edit.='<tbody></table>';
				                      					$con.='<p href="#" class="bg-warning" data-record="'.$value['id'].'"><span>'.$value['candidate_number'].'</span> '.$value['name'].' / '.$value['tag'].' / '.$value['institution'].'<span class="pull-right">'.$edit.'<span></p>';
					                      				$rechecker++;
				                      				}
	                   							}
	                   							
	                   						}

													$con.='		</nav>
												</div>


					                   		</div>';
	                      			}

                      			}
	
		}
		if($rechecker == 0){
			$con = '<h1 class="text-center">Waiting for Candidates to Load...</h1>';
		}
		echo json_encode(array("steps"=>$links,"container"=>$con,"count"=>$count,"titles"=>$titles));
	}


	public function getInfo($id = 0){
		$stmt = $this->helper->select(array('candidates',array(
			'event_id'=>$_SESSION['current_event_id'],'id'=>$id
		)));

		$html = '
			<div class="col-md-3">
	        	<span>'.$stmt[0]['candidate_number'].'</span>
	        	<img class="img-rounded img-responsive" src="'.DEFAULT_URL.'public/images/contestants/'.$stmt[0]['image'].'" width="100%" alt="Image">
	        </div>

	        <div class="col-md-9">
	        	<h4>Name: '.$stmt[0]['name'].' </h4>
	        	<h4>Tag : '.$stmt[0]['tag'].'</h4>
	        	<h4>Institution: '.$stmt[0]['institution'].'</h4>
	        </div>

	        <div style="clear:both"></div>
	        <form class="vote-form">
	        <div class="col-md-12">
	        <table class="table table-bordered">
	        	<thead>
	        		<tr>
	        		<th>Category</th>
	        		<th>Score</th>
	        		</tr>
	        	</thead>
	        	<tbody>';
	        	$getCat = $this->helper->select(array('categories',array(
	        		'level_id'=>$_SESSION['active_level'],
	        		'status'=>'on going'
        		)));

        		$getSub = $this->helper->select(array('sub_categories',array(
        			'category_id'=>$getCat[0]['id']
    			)));

    			for($x=0;$x<count($getSub);$x++){
    				$html.='<tr>
			        			<td>'.$getSub[$x]['sub_name'].' - '.$getSub[$x]['percentage'].'%</td>
			        			<td><input type="number" class="form-control" placeholder="Score Range '.$getSub[$x]['min_score'].'-'.$getSub[$x]['max_score'].'" min="'.$getSub[$x]['min_score'].'" max="'.$getSub[$x]['max_score'].'" name="'.$getSub[$x]['id'].'"></td>
			        		</tr>';
    			}	
	    $html.='</tbody>
	        </table>
	        	
	        </div>
		';

		echo $html;
	}

	public function submitVote($id = 0){
		if(isset($_SESSION['judge'])){
			if($id !=0){
				$len = strlen($_POST['data']) - 1;
				$sub = substr($_POST['data'],0,$len);

				$ex = explode(';',$sub);
				for($x=0;$x<count($ex);$x++){
					$ex2 = explode('|',$ex[$x]);
					// print_r($ex2);

					$check = $this->helper->select(array('scores',array(
						'event_id'=>$_SESSION['current_event_id'],
						'cat_id'=>$_SESSION['active_cat'],
						'sub_cat_id'=>$ex2[0],
						'judge_id'=>$_SESSION['judge-id'],
						'candidate_id'=>$id,
						'raw_score'=>$ex2[1]
					)));

					if(count($check) == 0){
						$this->helper->add(array('scores',array(
							'event_id'=>$_SESSION['current_event_id'],
							'cat_id'=>$_SESSION['active_cat'],
							'sub_cat_id'=>$ex2[0],
							'judge_id'=>$_SESSION['judge-id'],
							'candidate_id'=>$id,
							'raw_score'=>$ex2[1]
						)));
					}
					
				}
				// echo $_SESSION['active_cat'];
				// echo 1;
			}else{
				$this->locate('voting');
			}
		}else{	
			$this->locate('voting');
		}
	}

	public function getResult($id){
		$male = $this->helper->select(array('candidates',array(
			'event_id'=>$_SESSION['current_event_id'],
			'gender'=>'Male'
		)));
		$female = $this->helper->select(array('candidates',array(
			'event_id'=>$_SESSION['current_event_id'],
			'gender'=>'Female'
		)));

		$current_cat = $this->helper->select(array('categories',array(
			'level_id'=>$_SESSION['active_level'],
			'status'=>'on going'
		)));

		$html = '
			 <h2 class="text-center">Result for '.$current_cat[0]['category'].'</h2>
        <hr>

        <h4>Section 1</h4>
        <table class="table table-bordered">
        	<thead>
        		<tr><th>Candidate #</th>
        			<th>Name</th>
        			<th>Score</th>
        		</tr>
        	</thead>
        	<tbody>';
        	for($x=0;$x<count($male);$x++){
        		$score = $this->helper->select(array('scores',array(
        			'candidate_id'=>$male[$x]['id'],
        			'cat_id'=>$_SESSION['active_cat'],
        			'judge_id'=>$_SESSION['judge-id']
				)));

        		$td = "";

        		for($y=0;$y<count($score);$y++){
        			$subcat = $this->helper->select(array('sub_categories',array(
        				'id'=>$score[$y]['sub_cat_id']
    				)));
        			for($a=0;$a<count($subcat);$a++){
        				$td .= $subcat[$a]['sub_name'].'-'.$score[$y]['raw_score'].'
<button class="btn btn-primary btn-xs edit-score pull-right" data-max="'.$subcat[$a]['max_score'].'" data-min="'.$subcat[$a]['min_score'].'" data-record="'.$score[$y]['id'].'" data-score="'.$score[$y]['raw_score'].'"><i class="fa fa-edit"></i></button>
        				<br>';
        			}
        		}


        		$html.='<tr>
        					<td>'.$male[$x]['candidate_number'].'</td>	
        					<td>'.$male[$x]['name'].'</td>	
        					<td>'.$td.'</td>
    					</tr>';
        	}
        $html.='</tbody>
        </table>
        <h4>Section 2</h4>
        <table class="table table-bordered">
        	<thead>
        		<tr><th>Candidate #</th>
        			<th>Name</th>
        			<th>Score</th>
        		</tr>
        	</thead>
        	<tbody>';
        	for($x=0;$x<count($female);$x++){
        		$score = $this->helper->select(array('scores',array(
        			'candidate_id'=>$female[$x]['id'],
        			'cat_id'=>$_SESSION['active_cat'],
        			'judge_id'=>$_SESSION['judge-id']
				)));

        		$td = "";

        		for($y=0;$y<count($score);$y++){
        			$subcat = $this->helper->select(array('sub_categories',array(
        				'id'=>$score[$y]['sub_cat_id']
    				)));
        			for($a=0;$a<count($subcat);$a++){
        				$td .= $subcat[$a]['sub_name'].'-'.$score[$y]['raw_score'].'<br>';
        			}
        		}
        		$html.='<tr>
        					<td>'.$female[$x]['candidate_number'].'</td>	
        					<td>'.$female[$x]['name'].'</td>	
        					<td>'.$td.'</td>
    					</tr>';
        	}
        $html.='</tbody>
        </table>

		';

		echo $html;
	}

	public function editVote($id = 0){
		$this->helper->update(array('scores',array(
			'raw_score'=>$_POST['edited_score'],
			'id'=>$id
		)));

		echo 1;
	}
}
