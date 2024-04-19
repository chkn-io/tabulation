<?php
class eventsController extends Controller{
	public function events(){
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth-type'] == "admin"){
				//Call index template
				$this->path(TEMPLATE_PATH.'index.tpl');
				//set default title
				$this->assign('DEFAULT_TITLE','Tabulation System - Events');
				//set css
				$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
					"green.css",
					"custom.min.css",
					"style-event.css",
					"daterangepicker.css",
					"jquery.gritter.css"
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
					"script-events.js"
				)));
			
		        // $data = $this->helper->defaults();
				$data = $this->view->Html_Objects('page','events/index.php');
				$this->assign('DEFAULT_BODY',$data);
		        $this->assign('DEFAULT_PATH',DEFAULT_URL);
		        $this->setup();
				$this->show();
			}else{
				$this->locate("voting");
			}
		}else{
			$this->locate("voting");
		}
		
	}

	public function info($id = 0){
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth-type'] == "admin"){
				$check = $this->helper->select(array('events',array('id'=>$id)));
				if(count($check) == 0){
					$this->chknError();
				}else{
					//Call index template
					$this->path(TEMPLATE_PATH.'index.tpl');
					//set default title
					$this->assign('DEFAULT_TITLE','Tabulation System - Events ('.$check[0]['event_name'].')');
					//set css
					$this->assign('DEFAULT_STYLE',$this->view->Html_Objects('css',array(
						"green.css",
						"custom.min.css",
						"style-event.css",
						"daterangepicker.css",
						"jquery.gritter.css"
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
						"script-info.js"
					)));
				
			        // $data = $this->helper->defaults();
					$data = $this->view->Html_Objects('page','events/info.php');
					$this->assign('DEFAULT_BODY',$data);
					$this->assign('CURRENT_EVENT',$check[0]['event_name']);
					$_SESSION['current_event_id'] = $check[0]['id'];
					$this->assign('EVENT_HEADER',DEFAULT_URL.'public/images/events/banner/'.$check[0]['header_image']); 
 			        $this->assign('EVENT_NAME',$check[0]['event_name']);
 			        $this->assign('EVENT_DATE',$check[0]['date']);
 			        $this->assign('EVENT_ABOUT',$check[0]['about']);
 			        $this->assign('EVENT_ORGANIZER',$check[0]['organizer']);
 			        $this->assign('EVENT_HOST',$check[0]['host']);
 			        $this->assign('EVENT_LOCATION',$check[0]['location']);
 			        $this->assign('DEFAULT_PATH',DEFAULT_URL);
 			        $this->setup();
					$this->show();
				}
			}else{
				$this->locate("voting");
			}
		}else{
			$this->locate("voting");
		}
		
	}
	public function newEvent(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['name'])){
				$str = "abcdefghijklmnopqrstuvwxyz";
				$r1 = substr(str_shuffle($str),0,6);
				$r2 = substr(str_shuffle($str),0,6);
				$r3 = substr(str_shuffle($str),0,6);
				$filename = $r1.'-'.$r2.'-'.$r3.'.jpg';
				move_uploaded_file($_FILES["header"]['tmp_name'],'./public/images/events/banner/'.$filename);
				move_uploaded_file($_FILES["advertisement"]['tmp_name'],'./public/images/events/advertisement/'.$filename);
				$this->helper->add(array('events',array(
					'account_id'=>$_SESSION['auth-id'],
					'event_name'=>$_POST['name'],
					'date'=>$_POST['date'],
					'about'=>$_POST['about'],
					'organizer'=>$_POST['organizer'],
					'host'=>$_POST['host'],
					'location'=>$_POST['location'],
					'header_image'=>$filename,
					'advertisement_image'=>$filename
				)));

				echo 1;
			}else{
				$this->locate("voting");
			}
		}else{
			$this->locate("voting");
		}
	}

	function getEvents(){
		if(isset($_SESSION['auth'])){
			$stmt = $this->helper->order_list(array('events',array('timestamp','DESC')));

			// $html = '';
			for($x=0;$x<count($stmt);$x++){
				$stmt[$x]['date'] = date("F d, Y",strtotime($stmt[$x]['date']));
				$stmt[$x]['host'] = str_replace(',', ' and ', $stmt[$x]['host']);
			}

			// echo $html;
			echo json_encode($stmt);

		}else{
			$this->locate("voting");
		}
	}


	public function newLevel(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['name'])){
				$str = "abcdefghijklmnopqrstuvwxyz";
				$r1 = substr(str_shuffle($str),0,6);
				$r2 = substr(str_shuffle($str),0,6);
				$r3 = substr(str_shuffle($str),0,6);
				$filename = $r1.'-'.$r2.'-'.$r3.'.jpg';
					
				
				move_uploaded_file($_FILES["result_banner"]['tmp_name'],'./public/images/events/levels/'.$filename);
				$this->helper->add(array('levels',array(
					'level_name'=>$_POST['name'],
					'no_contestants'=>$_POST['contestant_number'],
					'no_winner'=>$_POST['number_winner'],
					'can_source'=>$_POST['source'],
					'mode'=>$_POST['mode'],
					'event_id'=>$_SESSION['current_event_id'],
					'image'=>$filename
				)));

				echo 1;
			}else{
				$this->locate("voting");
			}
		}else{
			$this->locate("voting");
		}
	}


	public function getLevels(){

		if(isset($_SESSION['auth'])){
			$stmt = $this->helper->select(array('levels',array(
				'event_id'=>$_SESSION['current_event_id']
			)));

			$table = '';

			for($x=0;$x<count($stmt);$x++){
				$y = $x + 1;
				if($stmt[$x]['status'] == "pending"){
					$check = $this->helper->select(array('levels',array(
						'event_id'=>$_SESSION['current_event_id'],'status'=>"on going"
					)));

					if(count($check) == 0){
						$button= '<button class="btn btn-default activate" data-record="'.$stmt[$x]['id'].'">Activate</button>';
					}else{
						$button = "";
					}
					
				}elseif($stmt[$x]['status'] == "on going"){
						$button='<button class="btn btn-danger deactivate" data-record="'.$stmt[$x]['id'].'">Deactivate</button> ';
						$button.='<button class="btn btn-success done" data-record="'.$stmt[$x]['id'].'">Done</button>';
					
				}else{
					$button='done <a href="'.DEFAULT_URL.'report/levels/'.$stmt[$x]['id'].'" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Print</a>';
				}

				$source= $this->helper->select(array('levels',array(
					'id'=>$stmt[$x]['can_source']
				)));

				if($stmt[$x]['can_source'] == 0){
					$s = "All";
				}else{
					$s = $source[0]['level_name'];
				}
				$table.='<tr>
							<td>'.$y.'</td>
							<td>'.$stmt[$x]['level_name'].'</td>
							<td>'.$stmt[$x]['no_contestants'].'</td>
							<td>'.$stmt[$x]['no_winner'].'</td>
							<td>'.$s.'</td>
							<td>'.$stmt[$x]['mode'].'</td>
							<td>'.$button.'</td>
						</tr>';
			}

			echo $table;
		}else{
			$this->locate("voting");
		}
	}

	public function getCatLevels(){
		if(isset($_SESSION['auth'])){
			$stmt = $this->helper->select(array('levels',array(
				'event_id'=>$_SESSION['current_event_id']
			)));
			$table = '';
			for($x=0;$x<count($stmt);$x++){
				$table.='<option value="'.$stmt[$x]['id'].'">'.$stmt[$x]['level_name'].'</option>';
			}

			echo $table;

		}else{	
			$this->locate("voting");
		}
	}


	public function newCategory(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['name'])){
				$str = "abcdefghijklmnopqrstuvwxyz";
				$r1 = substr(str_shuffle($str),0,6);
				$r2 = substr(str_shuffle($str),0,6);
				$r3 = substr(str_shuffle($str),0,6);
				$filename = $r1.'-'.$r2.'-'.$r3.'.jpg';
				$stmt = $this->helper->add(array('categories',array(
					'level_id'=>$_POST['cat_level'],
					'category'=>$_POST['name'],
					'image'=>$filename
				)));

				$check_id = $this->helper->query(array('SELECT * FROM categories WHERE level_id=:param1 ORDER BY id DESC LIMIT 1',array(
					$_POST['cat_level']
				)));

				
				move_uploaded_file($_FILES["result_banner"]['tmp_name'],'./public/images/events/categories/'.$filename);
				for($x=0;$x<count($_POST['sub_cat_name']);$x++){
					$this->helper->add(array('sub_categories',array(
						'category_id'=>$check_id[0]['id'],
						'sub_name'=>$_POST['sub_cat_name'][$x],
						'min_score'=>$_POST['sub_cat_min'][$x],
						'max_score'=>$_POST['sub_cat_max'][$x],
						'percentage'=>$_POST['sub_cat_per'][$x]
					)));
				}

				echo 1;
			}else{
				$this->locate("voting");
			}
		}else{
			$this->locate("voting");
		}
	}

	public function getCategory(){

		if(isset($_SESSION['auth'])){
			$stmt = $this->helper->select(array('levels',array(
				'event_id'=>$_SESSION['current_event_id']
			)));

			$table = '';
			for($x=0;$x<count($stmt);$x++){

				$table.='
					<li>
                    <div class="block">
                      <div class="tags">
                        <a href="" class="tag">
                          <span>'.$stmt[$x]['level_name'].'</span>
                        </a>
                      </div>
                      <div class="block_content">';
                      $cat = $this->helper->select(array('categories',array(
                      	'level_id'=>$stmt[$x]['id']
                  		)));

                      for($y=0;$y<count($cat);$y++){
                      	$checkLevels = $this->helper->select(array('levels',array('id'=>$stmt[$x]['id'],'status'=>"on going")));
$button="";
                      	if(count($checkLevels) == 0){
                      		$button='<a href="'.DEFAULT_URL.'report/category/'.$stmt[$x]['id'].'/'.$cat[$y]['id'].'" class="btn btn-default pull-right btn-xs printCategory" data-record="'.$cat[$y]['id'].'">Print</a>';
							
                      	}else{
                      		if($cat[$y]['status'] == "pending"){
								$check = $this->helper->select(array('categories',array(
									'level_id'=>$cat[$y]['level_id'],'status'=>"on going"
								)));

								if(count($check) == 0){
									$button= '<button class="btn btn-default pull-right btn-xs categoryActivate" data-record="'.$cat[$y]['id'].'">Activate</button>';
								}else{
									$button = "";
									// $button='<a href="'.DEFAULT_URL.'report/category/'.$checkLevels[0]['id'].'/'.$cat[$y]['id'].'" class="btn btn-default pull-right btn-xs printCategory" data-record="'.$cat[$y]['id'].'">Print</a>';
								}
							}elseif($cat[$y]['status'] == "on going"){
								$button.='<button class="btn btn-danger pull-right btn-xs categoryDeactivate" data-record="'.$cat[$y]['id'].'">Deactivate</button> ';
								$button.='<button class="btn btn-success pull-right btn-xs categoryDone" data-record="'.$cat[$y]['id'].'">Done</button>';
							}elseif($cat[$y]['status'] == "done"){
								$button="DONE";
								$button.='<a href="'.DEFAULT_URL.'report/category/'.$checkLevels[0]['id'].'/'.$cat[$y]['id'].'" class="btn btn-default pull-right btn-xs printCategory" data-record="'.$cat[$y]['id'].'">Print</a>';
							}
                      	}
			                  
                      	$table.='
                        <h2 class="title">
                            <a>'.$cat[$y]['category'].'   '.$button.'</a>
                        </h2>
                        
                        <p class="excerpt">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Sub Category Name</th>
                                <th>Min Score</th>
                                <th>Max Score</th>
                                <th>Percentage</th>
                              </tr>
                            </thead>
                            <tbody>';
                            $sub_cat = $this->helper->select(array('sub_categories',array(
                      	'category_id'=>$cat[$y]['id'])));

				

                      	for($z=0;$z<count($sub_cat);$z++){
                      		    		$table.='<tr>
                      					<td>'.$sub_cat[$z]['sub_name'].' <button class="btn btn-primary btn-xs apply-manual" data-sub="'.$sub_cat[$z]['id'].'">Apply Manually</button></td> 
                      					<td>'.$sub_cat[$z]['min_score'].'</td>
                      					<td>'.$sub_cat[$z]['max_score'].'</td>
                      					<td>'.$sub_cat[$z]['percentage'].'</td>
                      				</tr>';
                      	}
                  		
                        $table.='</tbody>
                          </table>
                        </p>';
                      }
                      
                       
                      $table.='</div>
                    </div>
                  </li>

				';
			}

			echo $table;
		}else{
			$this->locate("voting");
		}
	}


	//category
	public function getCategoryStatus($id = "",$type = ""){
		echo $id;
		if($type == "act"){
			$activate = $this->helper->update(array('levels',array(
				'status'=>"on going",
				'id'=>$id
				)));
		}elseif($type == "deact"){
			$deactivate = $this->helper->update(array('levels',array(
				'status'=>"pending",
				'id'=>$id
				)));
		}else{
			$done = $this->helper->update(array('levels',array(
				'status'=>"done",
				'id'=>$id
				)));
		}

	}




	public function newCandidate(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['can_num'])){
				for($x=0;$x<count($_POST['can_num']);$x++){
					$str = "abcdefghijklmnopqrstuvwxyz1234567890";
					$r1 = substr(str_shuffle($str),0,6);
					$r2 = substr(str_shuffle($str),0,6);
					$r3 = substr(str_shuffle($str),0,6);
					$filename = $r1.'-'.$r2.'-'.$r3.'.jpg';
					// print_r($_POST['can_gen']);
					move_uploaded_file($_FILES['can_img']['tmp_name'][$x],'./public/images/contestants/'.$filename);
					
					$this->helper->add(array('candidates',array(
						'event_id'=>$_SESSION['current_event_id'],
						'candidate_number'=>$_POST['can_num'][$x],
						'name'=>$_POST['can_nam'][$x],
						'image'=>$filename,
						'tag'=>$_POST['can_tag'][$x],
						'institution'=>$_POST['can_ins'][$x],
						'gender'=>$_POST['can_gen'][$x]
					)));

				}
				echo 1;
			}			
		}
	}

	public function newJudge(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['jud_nam'])){
				for($x=0;$x<count($_POST['jud_nam']);$x++){
					$str = "abcdefghijklmnopqrstuvwxyz1234567890";
					$r1 = substr(str_shuffle($str),0,4);
					$r2 = substr(str_shuffle($str),0,4);
					$judge_code = $r1.'-'.$r2;
					// print_r($_POST['can_gen']);
					
					$this->helper->add(array('judges',array(
						'event_id'=>$_SESSION['current_event_id'],
						'name'=>$_POST['jud_nam'][$x],
						'others'=>$_POST['jud_inf'][$x],
						'judge_code'=>$judge_code
					)));
				}
					echo 1;

			}			
		}
	}


	public function getCandidate($type = ""){
		if(isset($_SESSION['auth'])){
			$table = '';
			$stmt = $this->helper->select(array('candidates',array(
				'event_id'=>$_SESSION['current_event_id'],'gender'=>$type
			)));

			// print_r($stmt);
			for($x=0;$x<count($stmt);$x++){
				$table.='<tr>
							<td><img src="'.DEFAULT_URL.'public/images/contestants/'.$stmt[$x]['image'].'" class="img-rounded" width="70"></td>
							<td>'.$stmt[$x]['candidate_number'].'</td>
							<td>'.$stmt[$x]['name'].'</td>
							<td>'.$stmt[$x]['tag'].'</td>
							<td>'.$stmt[$x]['institution'].'</td>
							<td><button class="btn btn-default editCandidate" data-record="'.$stmt[$x]['id'].'"><i class="fa fa-edit"></i> Edit</button></td>
						</tr>';
			}
			echo $table;
		}
	}

	public function getSponsor(){
		if(isset($_SESSION['auth'])){
			$table = '';
			$stmt = $this->helper->select(array('sponsors',array(
				'event_id'=>$_SESSION['current_event_id']
			)));

			// print_r($stmt);
			for($x=0;$x<count($stmt);$x++){
				$table.='<tr>
							<td><img src="'.DEFAULT_URL.'public/images/sponsors/'.$stmt[$x]['logo'].'" class="img-rounded" width="70"></td>
							<td>'.$stmt[$x]['name'].'</td>
							<td><button class="btn btn-default editSponsor" data-record="'.$stmt[$x]['id'].'"><i class="fa fa-edit"></i> Edit</button>
							<button class="btn btn-danger deleteSponsor" data-record="'.$stmt[$x]['id'].'"><i class="fa fa-trash"></i> Delete</button></td>
						</tr>';
			}
			echo $table;
		}
	}

	public function getJudge(){
		if(isset($_SESSION['auth'])){
			$table = '';
			$stmt = $this->helper->select(array('judges',array(
				'event_id'=>$_SESSION['current_event_id']
			)));
			$counter = 0;
			// print_r($stmt);
			for($x=0;$x<count($stmt);$x++){
				$counter++;
				$table.='<tr>
							<td>'.$counter.'</td>
							<td>'.$stmt[$x]['name'].'</td>
							<td>'.$stmt[$x]['others'].'</td>
							<td style="text-transform:uppercase">'.$stmt[$x]['judge_code'].'</td>
							<td><button class="btn btn-default editJudge" data-record="'.$stmt[$x]['id'].'"><i class="fa fa-edit"></i> Edit</button>
							<button class="btn btn-danger viewVotes" data-record="'.$stmt[$x]['id'].'"><i class="fa fa-edit"></i> View Votes</button></td>
						</tr>';
			}
			echo $table;
		}else{
			$this->locate('voting');
		}
	}
	// public function getSample(){
	// 	$stmt = $this->helper->select(array('levels',array(
	// 		'id'=>$_POST['sample']
	// 	)));

	// 	// print_r($stmt);
	// }

	public function updateCategory($id = "",$type = ""){
		if($type == "catActiv"){
			$activate = $this->helper->update(array('categories',array(
				'status'=>"on going",
				'id'=>$id
			)));
		}else if($type == "catDeactiv"){
			$deactive = $this->helper->update(array('categories',array(
				'status'=>"pending",
				'id'=>$id
			)));
		}else{

			$can = $this->helper->select(array('candidates',array(
				'event_id'=>$_SESSION['current_event_id']
			)));
			$cat = $this->helper->select(array('categories',array(
				'id'=>$id
			)));

			for($x=0;$x<count($can);$x++){
				// echo $can[$x]['name'];
				$sub_category = $this->helper->select(array('sub_categories',array(
					'category_id'=>$id
				)));
				$all = 0;
				$max = $sub_category[0]['max_score'];

				for($y=0;$y<count($sub_category);$y++){
					$scores = $this->helper->select(array('scores',array(
						'sub_cat_id'=>$sub_category[$y]['id'],
						'candidate_id'=>$can[$x]['id']
					)));

					$s = 0;
					// echo "<br><br>"
					for($a=0;$a<count($scores);$a++){
						$per = $sub_category[$y]['percentage'] *.01;
						$raw = $scores[$a]['raw_score'] ;

						$sam = ($raw / $max) * 100; 
						$s = $s + ($per * $sam);
						// echo $s;
					}

					$judge = $this->helper->select(array('judges',array(
						'event_id'=>$_SESSION['current_event_id']
					)));

					$all = $all + ($s/count($judge));

					echo $all;
				}
				

				$this->helper->add(array('results',array(
					'category_id'=>$id,
					'score'=>$all,
					'candidate_id'=>$can[$x]['id'],
					'level_id'=>$cat[0]['level_id']
				)));
			}
			$done = $this->helper->update(array('categories',array(
				'status'=>"done",
				'id'=>$id
			)));
		}
		
	}

	public function getEditJudge($id = 0){
		if($id != 0){
			$stmt = $this->helper->select(array('judges',array(
				'id'=>$id
			)));

			$table = '

				<div class="form-group">
					<label class="control-label col-md-3">Name</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['name'].'" name="judgeName" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Judge Information</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['others'].'" name="judgeInfo" class="form-control">
					</div>
				</div>

				<div style="clear:both"></div>

			';
			echo $table;
		}else{
			$this->chknError();
		}
	}

	public function updateEditJudge($id = ""){
		$stmt = $this->helper->update(array('judges',array(
			'name'=>$_POST['judgeName'],
			'others'=>$_POST['judgeInfo'],
			'id'=>$id
		)));
	}

	public function getEditCandidate($id = 0){
		if($id != 0){
			$stmt = $this->helper->select(array('candidates',array(
				'id'=>$id
			)));

			$table='
				<div class="form-group">
					<label class="control-label col-md-3">Candidate Number</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['candidate_number'].'" name="candidateNumber" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Candidate Name</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['name'].'" name="candidateName" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">Tag</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['tag'].'" name="tag" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Institution</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['institution'].'" name="institution" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Gender</label>
					<div class="col-md-12">
						<select name="gender" class="form-control">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>

				<div style="clear:both"></div>
			';

			echo $table;
		}else{
			$this->chknError();
		}
	}

	public function updateEditCandidate($id = ""){
		$stmt = $this->helper->update(array('candidates',array(
			'candidate_number'=>$_POST['candidateNumber'],
			'name'=>$_POST['candidateName'],
			'tag'=>$_POST['tag'],
			'institution'=>$_POST['institution'],
			'gender'=>$_POST['gender'],
			'id'=>$id
		)));
	}

	public function getEditEvent($id = 0){
		$stmt = $this->helper->select(array('events',array(
			'event_id'=>$_SESSION['current_event_id']
		)));

		print_r($stmt);
	}

	public function getLevelSource(){
		$stmt = $this->helper->select(array('levels',array(
			'event_id'=>$_SESSION['current_event_id']
		)));

		$html = '<option value="0">All</option>';
		for($x=0;$x<count($stmt);$x++){
			$html .='<option value="'.$stmt[$x]['id'].'">'.$stmt[$x]['level_name'].'</option>';
		}

		echo $html;
	}
	

	public function newSponsor(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['name'])){
				for($x=0;$x<count($_POST['name']);$x++){
					$str = "abcdefghijklmnopqrstuvwxyz1234567890";
					$r1 = substr(str_shuffle($str),0,6);
					$r2 = substr(str_shuffle($str),0,6);
					$r3 = substr(str_shuffle($str),0,6);
					$filename = $r1.'-'.$r2.'-'.$r3.'.jpg';
					// print_r($_POST['can_gen']);
					move_uploaded_file($_FILES['spo_img']['tmp_name'][$x],'public/images/sponsors/'.$filename);
					
					$this->helper->add(array('sponsors',array(
						'event_id'=>$_SESSION['current_event_id'],
						'name'=>$_POST['name'][$x],
						'logo'=>$filename
					)));
				}
					echo 1;

			}			
		}
	}


	public function getEditSponsor($id = 0){
		if($id != 0){
			$stmt = $this->helper->select(array('sponsors',array(
				'id'=>$id
			)));

			$table = '

				<div class="form-group">
					<label class="control-label col-md-3">Name</label>
					<div class="col-md-12">
						<input type="text" value="'.$stmt[0]['name'].'" name="sponsorName" class="form-control">
					</div>
				</div>

				<div style="clear:both"></div>

			';
			echo $table;
		}else{
			$this->chknError();
		}
	}

	public function updateEditSponsor($id = ""){
		$stmt = $this->helper->update(array('sponsors',array(
			'name'=>$_POST['sponsorName'],
			'id'=>$id
		)));
	}

	public function deleteSponsor($id = ""){
		$stmt = $this->helper->delete(array('sponsors',array('id'=>$id)));
	}

	public function getPopularity($sub_cat = ""){
		$judges = $this->helper->select(array('judges',array('event_id'=>$_SESSION['current_event_id'])));
		$html = '<table class="table table-bordered manual-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Candidate</th>
					';
				for($x=0;$x<count($judges);$x++){
					$html.='<th>'.$judges[$x]['name'].'</th>';
				}
		$html.='
				<th>Action</th>
			</tr>
			</thead>';
		$html.='<tbody>';
		$stmt = $this->helper->select(array('candidates',array(
			'event_id'=>$_SESSION['current_event_id'],'gender'=>'Male'
		)));
		for($x=0;$x<count($stmt);$x++){
			$html.='<tr>
						<td class="cn_number">'.$stmt[$x]['candidate_number'].'</td>
						<td class="cn_name">'.$stmt[$x]['name'].'</td>';
			for($z=0;$z<count($judges);$z++){
				$html.='<td class="cn_score"><input class="form-control set'.$x.'" type="number"  name="scores[]" data-category="'.$sub_cat.'" data-candidate="'.$stmt[$x]['id'].'" data-judge="'.$judges[$z]['id'].'"></td>';
			}
			$html.='<td><button type="button" class="btn btn-warning btn-md apply-all" data-sub="'.$sub_cat.'" data-owned="set'.$x.'">Apply to All</button></td></tr>';
		}

		$stmt = $this->helper->select(array('candidates',array(
			'event_id'=>$_SESSION['current_event_id'],'gender'=>'Female'
		)));
		for($x=0;$x<count($stmt);$x++){
			$html.='<tr>
						<td class="cn_number">'.$stmt[$x]['candidate_number'].'</td>
						<td class="cn_name">'.$stmt[$x]['name'].'</td>';
			for($z=0;$z<count($judges);$z++){
				$html.='<td class="cn_score"><input class="form-control set'.$x.'" type="number"  name="scores[]" data-category="'.$sub_cat.'" data-candidate="'.$stmt[$x]['id'].'" data-judge="'.$judges[$z]['id'].'"></td>';
			}
			$html.='<td><button type="button" class="btn btn-warning btn-md apply-all" data-sub="'.$sub_cat.'" data-owned="set'.$x.'">Apply to All</button></td></tr>';
		}
		$html.='</tbody>';
		$html.='</table>';

		echo $html;
	}

	public function popularity(){
		if(isset($_SESSION['auth'])){
			if(isset($_POST['manual'])){
				$len = strlen($_POST['manual']) - 1;
				$manual = substr($_POST['manual'], 0,$len);
				$ex = explode(",",$manual);
				
				for($x=0;$x<count($ex);$x++){
					$ex2 = explode("-",$ex[$x]);

					$category_id = $this->helper->select(array('sub_categories',array('id'=>$ex2[0])));
					$id = $category_id[0]['category_id'];
					$this->helper->add(array('scores',array(
						'event_id'=>$_SESSION['current_event_id'],
						'cat_id'=>$id,
						'sub_cat_id'=>$ex2[0],
						'judge_id'=>$ex2[2],
						'candidate_id'=>$ex2[1],
						'raw_score'=>$ex2[3]
					)));
				}
				// for($x=0;$x<count($judge);$x++){
				// 	for($y=0;$y<count($_POST['scores']);$y++){
				
				// 	}
					
				// }

			}else{
				$this->chknError();
			}
		}else{
			$this->chknError();
		}
	}

	public function resetResult(){
		if(isset($_SESSION['current_event_id'])){
			$this->helper->query(array('UPDATE levels SET status=:param1 WHERE event_id=:param2',array(
				'pending',$_SESSION['current_event_id']
			)));


			$levels = $this->helper->select(array('levels',array(
				'event_id'=>$_SESSION['current_event_id']
			)));

			for($x=0;$x<count($levels);$x++){
				$this->helper->query(array('UPDATE categories SET status=:param1 WHERE level_id=:param2',array(
					'pending',$levels[$x]['id']
				)));

				$this->helper->delete(array('results',array(
					'level_id'=>$levels[$x]['id']
				)));

				$this->helper->delete(array('level_result',array(
					'level_id'=>$levels[$x]['id']
				)));
			}

			$this->locate('events/info/'.$_SESSION['current_event_id']);
		}
	}


	public function getJudgeScores($id = 0){
		$stmt = $this->helper->select(array('categories'));
		$table = "";
		for($x=0;$x<count($stmt);$x++){
			$table.='<h3 class="bg-primary text-center">'.$stmt[$x]['category'].'</h3><hr>';
			$sub_category = $this->helper->select(array('sub_categories',array(
				'category_id'=>$stmt[$x]['id']
			)));
			for($y=0;$y<count($sub_category);$y++){
				$table.='<h4>'.$sub_category[$y]['sub_name'].'</h4>';
				$table.='<table class="table table-bordered">';
				$table.='<thead>';
				$table.='<tr>
								<th>Candidate Name</th>
								<th>Score</th>
							</tr>';
				$table.='</thead>';
				$table.='<tbody>';
				$candidates = $this->helper->select(array('candidates',array(
					'event_id'=>$_SESSION['current_event_id']
				)));
				for($a=0;$a<count($candidates);$a++){
					$score = $this->helper->select(array('scores',array(
						'sub_cat_id'=>$sub_category[$y]['id'],
						'judge_id'=>$id,
						'candidate_id'=>$candidates[$a]['id']
					)));
					$table.='<tr>
						<td>'.$candidates[$a]['name'].'</td>
						<td>';
						for($s=0;$s<count($score);$s++){
							$table.='<span style="background-color:#d9534f;padding:15pt;margin:3pt;border-radius:5px;color:#fff">'.$score[$s]['raw_score'].' <button class="btn btn-danger remove-judge-votes" data-record="'.$score[$s]['id'].'"><i class="fa fa-remove"></i></button><span>';
						}
					$table.='</td>
					</tr>';
				}
				$table.='</tbody>';
				$table.='</table>';
			}
		}
		echo $table;
	}


	public function deleteScore($id){
		$this->helper->delete(array('scores',array(
			'id'=>$id
		)));
	}
}
