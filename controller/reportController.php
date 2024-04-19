<?php

class reportController extends Controller{
	public function report(){
		$this->error();
	}

	public function category($level = 0,$category = 0){
		$judges = $this->helper->select(array('judges',array(
			'event_id'=>$_SESSION['current_event_id']
		)));

		$sub_category = $this->helper->select(array('sub_categories',array(
			'category_id'=>$category
		)));
		// $sub_cat = $this->helper->select(array('

		// '));

		$cats = $this->helper->select(array('categories',array(
			'id'=>$category
		)));

		$event = $this->helper->select(array('events',array(
			'id'=>$_SESSION['current_event_id']
		)));

		$html = '<html>
				<head>
					<title></title>
					<link rel="stylesheet" href="'.DEFAULT_URL.'public/css/bootstrap.min.css" media="print, screen">
					<script src="'.DEFAULT_URL.'public/default/default_js/jquery.min.js"></script>

					<style>

					body{
						-webkit-print-color-adjust:exact;!important;
						margin:0pt;
					}
					table{
						margin-top:10pt;
					}
					table tr:nth-child(1){
						text-align:center;
					}

					table tr th{
						text-align:center;
						font-size:10px;
					}
					table tr td{
						text-align:center;
						font-size:10px;
					}
					table tr td:nth-child(1){
						text-align:left;
					}
					small{
						font-size:8px;
						color:red;
					}

					h1{
						text-align:center;
						font-size:25pt;
						margin:10pt 0pt 0pt 0pt;
					}
					.event_title{
						text-align:center;
						font-size:30pt;
						margin:0;
						color:green;
					}

					.event_date{
						text-align:center;
					}

					.table .highest{
						background-color:yellow;!important
					}

					@media print(){
						.table .highest{
							background-color:yellow;!important
						}
					}

					/*.right{
						width:300px;
						position:absolute;
						top:-20;
						right:-30;
					}
					.left{
						width:150px;
						position:absolute;
						top:-10;
						left:0;
					}
					.right2{
						width:300px;
						position:absolute;
						top:60;
						right:-30;
					}
					.left2{
						width:150px;
						position:absolute;
						top:70;
						left:0;
					}*/

					.banner{
						width:100%;
					}
					</style>
				</head>

				<body>
				<div class="col-md-12">
					<div class="col-md-12">
					<img src="'.DEFAULT_URL.'public/images/events/categories/'.$cats[0]['image'].'" class="banner">
						
					</div>

					<div class="col-md-12">
					<table class="table table-bordered myTable" id="myTable1">
						<thead>
							<tr>
							<th rowspan="2">Candidate #</th>
							<!--<th rowspan="2">Gender</th>-->
								<th rowspan="2">Candidate</th>';
		for($x=0;$x<count($sub_category);$x++){
			$html.='<th colspan="'.count($judges).'">'.$sub_category[$x]['sub_name'].' <span class="text-danger">'.$sub_category[$x]['percentage'].'%</span></th><th rowspan="2">Total<br><small>(By Category Percentage)</small></th>';
		}
		$html.='<th rowspan="2">Final Score</th>
								';


		$html.='</tr>
				<tr>
						 ';
						 
						 for($y=0;$y<count($sub_category);$y++){
						 	$counter = 0;
for($x=0;$x<count($judges);$x++){
							$counter++;
							$html.='<th>Judge '.$counter.'</th>';
						}
						 }
						
		$html.='</tr>

						</thead>
						<tbody>';
						 
		$candidates = $this->helper->select(array('candidates',array(
			'event_id'=>$_SESSION['current_event_id'],'gender'=>'Male'
		)));
		for($x=0;$x<count($candidates);$x++){
			$html.='<tr>
			<td>'.$candidates[$x]['candidate_number'].'</td>
			<!--<td>'.$candidates[$x]['gender'].'</td>-->
						<td>'.$candidates[$x]['name'].'</td>';
			$perc = 0;
			$stotal = 0;

			for($i=0;$i<count($sub_category);$i++){
				$rscore = 0;
				$max = 0;
				for($j=0;$j<count($judges);$j++){
					$max += $sub_category[$i]['max_score'];
					$scores = $this->helper->select(array('scores',array(
						'cat_id'=>$category,
						'sub_cat_id'=>$sub_category[$i]['id'],
						'judge_id'=>$judges[$j]['id'],
						'candidate_id'=>$candidates[$x]['id'],
						'event_id'=>$_SESSION['current_event_id']
					)));
					if(count($scores) != 0){
					$rscore = $rscore + $scores[0]['raw_score'];
						$html.='<td>'.$scores[0]['raw_score'].'</td>';
					}else{
						$html.='<td></td>';
					}
				}
				// echo $sub_category[$i]['percentage'].'<br>';
				$stotal = $stotal + $sub_category[$i]['percentage'] * ($rscore / $max);
				$rtotal = $sub_category[$i]['percentage'] * ($rscore / $max);
				$html.='<td>'.number_format($rtotal,2).'%</td>';
				$perc = $perc + $sub_category[$i]['percentage'];
			}
			$avescore = ($stotal / $perc) * 100;
			$stmt = $this->helper->select(array('results',array(
						'category_id'=>$category,
						'level_id'=>$level,
						'candidate_id'=>$candidates[$x]['id']
					)));

			// print_r($stmt);
			// 	for($l=0;$l<count($stmt);$l++){

					$html.='<td class="sss">'.number_format($avescore,2).'%</td>';
				// }
			$html.='</tr>';
		}

		

		$html.='</tbody>
					</table>';
			for($x=0;$x<count($judges);$x++){
				$html.='<div class="col-md-3 col-xs-3" style="margin-top:2%;">
						<p style="border-top:1px solid black;text-align:center">
						'.$judges[$x]['name'].'<p>
						</div>';
			}
		$html.='</div>';

		$html.='

<div class="col-md-12" style="position:relative;page-break-before: always">
						<div style="clear:both"></div>
						
					
					
						<img src="'.DEFAULT_URL.'public/images/events/categories/'.$cats[0]['image'].'" class="banner"><!--
						<h1>EPCST Tabulation</h1><br>
						<p class="event_title">'.$event[0]['event_name'].'</p>
 
						<p class="event_date">'.date('F d, Y').'</p>

						<img src="'.DEFAULT_URL.'public/images/EPCST.png" class="left2">
						<img src="'.DEFAULT_URL.'public/images/logo_east.png" class="right2">-->
					</div>

					<div class="col-md-12">
		<table class="table table-bordered myTable" id="myTable2">
						<thead>
							<tr>
							<th rowspan="2">Candidate #</th>
							<!--<th rowspan="2">Gender</th>-->
								<th rowspan="2">Candidate</th>';
								for($x=0;$x<count($sub_category);$x++){
									$html.='<th colspan="'.count($judges).'">'.$sub_category[$x]['sub_name'].' <span class="text-danger">'.$sub_category[$x]['percentage'].'%</span></th><th rowspan="2">Total<br><small>(By Category Percentage)</small></th>';
								}
								$html.='<th rowspan="2">Final Score</th>
														';
						
						
								$html.='</tr>
										<tr>
												 ';
												 
												 for($y=0;$y<count($sub_category);$y++){
													 $counter = 0;
						for($x=0;$x<count($judges);$x++){
													$counter++;
													$html.='<th>Judge '.$counter.'</th>';
												}
												 }
												
								$html.='</tr>
						
												</thead>
												<tbody>';
												 
								$candidates = $this->helper->select(array('candidates',array(
									'event_id'=>$_SESSION['current_event_id'],'gender'=>'Female'
								)));
								for($x=0;$x<count($candidates);$x++){
									$html.='<tr>
									<td>'.$candidates[$x]['candidate_number'].'</td>
									<!--<td>'.$candidates[$x]['gender'].'</td>-->
												<td>'.$candidates[$x]['name'].'</td>';
									$perc = 0;
									$stotal = 0;
						
									for($i=0;$i<count($sub_category);$i++){
										$rscore = 0;
										$max = 0;
										for($j=0;$j<count($judges);$j++){
											$max += $sub_category[$i]['max_score'];
											$scores = $this->helper->select(array('scores',array(
												'cat_id'=>$category,
												'sub_cat_id'=>$sub_category[$i]['id'],
												'judge_id'=>$judges[$j]['id'],
												'candidate_id'=>$candidates[$x]['id'],
												'event_id'=>$_SESSION['current_event_id']
											)));
											if(count($scores) != 0){
											$rscore = $rscore + $scores[0]['raw_score'];
												$html.='<td>'.$scores[0]['raw_score'].'</td>';
											}else{
												$html.='<td></td>';
											}
										}
										// echo $sub_category[$i]['percentage'].'<br>';
										$stotal = $stotal + $sub_category[$i]['percentage'] * ($rscore / $max);
										$rtotal = $sub_category[$i]['percentage'] * ($rscore / $max);
										$html.='<td>'.number_format($rtotal,2).'%</td>';
										$perc = $perc + $sub_category[$i]['percentage'];
									}
									$avescore = ($stotal / $perc) * 100;
									$stmt = $this->helper->select(array('results',array(
												'category_id'=>$category,
												'level_id'=>$level,
												'candidate_id'=>$candidates[$x]['id']
											)));
						
									// print_r($stmt);
									// 	for($l=0;$l<count($stmt);$l++){
						
											$html.='<td class="sss">'.number_format($avescore,2).'%</td>';
										// }
									$html.='</tr>';
								}
						
								
						
								$html.='</tbody>
											</table>';
									for($x=0;$x<count($judges);$x++){
										$html.='<div class="col-md-3 col-xs-3" style="margin-top:2%;">
												<p style="border-top:1px solid black;text-align:center">
												'.$judges[$x]['name'].'<p>
												</div>';
									}
								$html.='</div>';
		$html.='</div>
				</div>';

		$html.='</body>
				<script>
					$("table tbody tr").each(function(){
						if($(this).find(".sss").html() == "0.00%"){
							$(this).remove();
						}
					});

					var max = 0;
					$("#myTable1 tbody tr .sss").each(function()
					{

					   $this = parseInt( $(this).text() );

					   if ($this > max) max = $this;

					});
					
					$("#myTable1 tbody tr .sss").each(function()
					{
						if(parseInt($(this).html()) == max){
							$(this).parent().addClass("highest");
						}

					});

					var max = 0;
					$("#myTable2 tbody tr .sss").each(function()
					{

					   $this = parseInt( $(this).text() );

					   if ($this > max) max = $this;

					});
					
					$("#myTable2 tbody tr .sss").each(function()
					{
						if(parseInt($(this).html()) == max){
							$(this).parent().addClass("highest");
						}

					});

    
				</script>
				</html>';
				echo $html;
		// $this->helper->pdf($html,"report","portrait","letter");
	}

	public function levels($level){
		$getCurrent_level = $this->helper->select(array('levels',array(
			'id'=>$level
		)));
		$cat = $this->helper->select(array('categories',array(
			'level_id'=>$level
		)));

		$judges = $this->helper->select(array('judges',array(
			'event_id'=>$_SESSION['current_event_id']
		)));

		$c = $getCurrent_level[0]['no_winner'];

		$event = $this->helper->select(array('events',array(
			'id'=>$_SESSION['current_event_id']
		)));
		$html = '<html>
				<head>
					<title></title>
					<link rel="stylesheet" href="'.DEFAULT_URL.'/public/css/bootstrap.min.css">

					<style>
					table tr:nth-child(1){
						text-align:center;
					}


					
					table tr td{
						text-align:center;

					}
					table tr td:nth-child(1){
						text-align:left;
					}

					table th{
						text-align:center;
					}

h1{
						text-align:center;
						font-size:25pt;
						margin:10pt 0pt 0pt 0pt;
					}
					.event_title{
						text-align:center;
						font-size:30pt;
						margin:0;
						color:green;
					}

					.event_date{
						text-align:center;
					}

					.table .highest{
						background-color:yellow;!important
					}

					@media print(){
						.table .highest{
							background-color:yellow;!important
						}

						
					}
						table tr td{
							color:black;
							
						}
					/*.right{
						width:300px;
						position:absolute;
						top:-20;
						right:-30;
					}
					.left{
						width:150px;
						position:absolute;
						top:-10;
						left:0;
					}
					.right2{
						width:300px;
						position:absolute;
						top:180;
						right:-30;
					}
					.left2{
						width:10px;
						position:absolute;
						top:180;
						left:0;
					}*/

					.banner{
						width:100%;
					}
					</style>
				</head>

				<body>
				<div class="col-md-12">
					<div class="col-md-12">

					<img src="'.DEFAULT_URL.'public/images/events/levels/'.$getCurrent_level[0]['image'].'" class="banner">
						<!--<h1>EPCST Tabulation</h1><br>
 
						<p class="event_title">'.$event[0]['event_name'].'</p>
						<p class="event_date">'.date('F d, Y').'</p>

						<img src="'.DEFAULT_URL.'public/images/EPCST.png" class="left">
						<img src="'.DEFAULT_URL.'public/images/logo_east.png" class="right">-->
					</div>

					

					<div class="col-md-12">
					<h4>Section 1</h4>
						<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">Candidate</th>
								<th colspan="'.count($cat).'">'.$getCurrent_level[0]['level_name'].'</th>
								<th>Total</th>
							</tr>
							<tr>
								<th>Rank</th>
								<th>Number</th>
								<th>Name</th>';

								for($x=0;$x<count($cat);$x++){
									$html.='<th>'.$cat[$x]['category'].'</th>';
								}
								
			$html.='<th>Percentage</th>
			<th>Remarks</th>
							</tr>
						</thead>
						<tbody>';
									

	                      			$boyArray = array();
	                      			$getCandidate = $this->helper->select(array('candidates',array(
	                      				'event_id'=>$_SESSION['current_event_id'],'gender'=>'Male'
                      				)));

	                      			
	                      			
	                      			$b = 0;
	                      			$scores = 0;
                      				for($o=0;$o<count($getCandidate);$o++){
                      					$getSource = $this->helper->select(array('categories',array(
		                      				'level_id'=>$level
	                      				)));
		                      			for($p=0;$p<count($getSource);$p++){
		                      				$getSourceResult = $this->helper->select(array('results',array(
		                      					'candidate_id'=>$getCandidate[$o]['id'],
		                      					'level_id'=>$level
	                      					)));
	                      					$sc = 0;

	                      					$scraw = "";

	                      					for($h=0;$h<count($getSourceResult);$h++){
	                      						$sc = $sc + $getSourceResult[$h]['score'];
	                      						$scraw.=$getSourceResult[$h]['score'].';';
	                      					}

	                      					$boyArray[$o] = array('"'.$sc.'"',$getCandidate[$o]['id'],$scraw);
		                      			}
                      				}




                      				arsort($boyArray);


                      				

                      				// print_r($boyArray);
                      				arsort($boyArray);
                      				$counter = 0;
                      				$newB = array();
                      				foreach ($boyArray as $key => $value) {
                      					$newB[$counter] = array($value[0],$value[1],$value[2]);
                      					$counter++;
                      				}

                      				for($x=0;$x<count($newB);$x++){
                      					if($x < $c){
                      						$info = $this->helper->select(array('candidates',array(
	                      						'id'=>$newB[$x][1]
	                  						)));

	                  						$len = strlen($newB[$x][2]) - 1;
                      						$v = substr($newB[$x][2],0,$len);
	                  						$ex = explode(';',$v);
	                  						$r = $x + 1;

	                  						if($r == 1){
	                  							$class = "bg-primary";
	                  						}elseif($r == 2){
	                  							$class = "bg-success";
	                  						}elseif($r == 3){
	                  							$class = "bg-warning";
	                  						}elseif($r == 4){
	                  							$class = "bg-danger";
	                  						}elseif($r == 5){
	                  							$class = "bg-default";
	                  						}
	                  						$html.='<tr class="'.$class.'">
	                      								<td>'.$r.'</td>
	                      								<td>'.$info[0]['candidate_number'].'</td>
	                      								<td>'.$info[0]['name'].'</td>';
	                      					$total = 0;
	                      					for($u=0;$u<count($ex);$u++){
	                      						$html.='<td>'.number_format((double)$ex[$u],2).'</td>';
	                      						$total = $total + $ex[$u];
	                      					}


              								
                      						$html.='<td>'.number_format($total,2).'</td><td></td></tr>';
                      					}
                      				}


				$html.='</tbody>
						</table>';
				for($x=0;$x<count($judges);$x++){
				$html.='<div class="col-md-4 col-xs-4" style="margin-top:2%;">
						<p style="border-top:1px solid black;text-align:center">
						'.$judges[$x]['name'].'<p>
						</div>';
					}
				$html.='</div>
						<div class="col-md-12" style="position:relative;page-break-before: always" >
					<img src="'.DEFAULT_URL.'public/images/events/levels/'.$getCurrent_level[0]['image'].'" class="banner">
						<!--<h1 style="margin-top:20;padding-top:5pt;">EPCST Tabulation</h1><br>
 
						<p class="event_title">'.$event[0]['event_name'].'</p>
						<p class="event_date">'.date('F d, Y').'</p>

						<img src="'.DEFAULT_URL.'public/images/EPCST.png" class="left" style="margin-top:15pt">
						<img src="'.DEFAULT_URL.'public/images/logo_east.png" class="right">-->
					</div>';

					

					$html.='<div class="col-md-12" >
					
						
				<h4>Women</h4>
						<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">Candidate</th>
								<th colspan="'.count($cat).'">'.$getCurrent_level[0]['level_name'].'</th>
								<th>Total</th>
							</tr>
							<tr>
								<th>Rank</th>
								<th>Number</th>
								<th>Name</th>';

								for($x=0;$x<count($cat);$x++){
									$html.='<th>'.$cat[$x]['category'].'</th>';
								}
								
			$html.='<th>Percentage</th>
			<th rowspan="2">Remarks</th>
							</tr>
						</thead>
						
						<tbody>';
							$boyArray = array();
	                      			$getCandidate = $this->helper->select(array('candidates',array(
	                      				'event_id'=>$_SESSION['current_event_id'],'gender'=>'Female'
                      				)));

	                      			

	                      			
	                      			$b = 0;
	                      			$scores = 0;
                      				for($o=0;$o<count($getCandidate);$o++){
                      					$getSource = $this->helper->select(array('categories',array(
		                      				'level_id'=>$level
	                      				)));
		                      			for($p=0;$p<count($getSource);$p++){
		                      				$getSourceResult = $this->helper->select(array('results',array(
		                      					'candidate_id'=>$getCandidate[$o]['id'],
		                      					'level_id'=>$level
	                      					)));
	                      					$sc = 0;

	                      					$scraw = "";

	                      					for($h=0;$h<count($getSourceResult);$h++){
	                      						$sc = $sc + $getSourceResult[$h]['score'];
	                      						$scraw.=$getSourceResult[$h]['score'].';';
	                      					}
	                      					$boyArray[$o] = array('"'.$sc.'"',$getCandidate[$o]['id'],$scraw);
		                      			}
                      				}




                      				arsort($boyArray);
                      				$counter = 0;
                      				$newB = array();
                      				foreach ($boyArray as $key => $value) {
                      					$newB[$counter] = array($value[0],$value[1],$value[2]);
                      					$counter++;
                      				}

                      				for($x=0;$x<count($newB);$x++){
                      					if($x < $c){
                      						$info = $this->helper->select(array('candidates',array(
	                      						'id'=>$newB[$x][1]
	                  						)));

	                  						$len = strlen($newB[$x][2]) - 1;
                      						$v = substr($newB[$x][2],0,$len);
	                  						$ex = explode(';',$v);
	                  						$r = $x + 1;
	                  						if($r == 1){
	                  							$class = "bg-primary";
	                  						}elseif($r == 2){
	                  							$class = "bg-success";
	                  						}elseif($r == 3){
	                  							$class = "bg-warning";
	                  						}elseif($r == 4){
	                  							$class = "bg-danger";
	                  						}elseif($r == 5){
	                  							$class = "bg-default";
	                  						}
	                  						$html.='<tr class="'.$class.'">
	                      								<td>'.$r.'</td>
	                      								<td>'.$info[0]['candidate_number'].'</td>
	                      								<td>'.$info[0]['name'].'</td>';
	                      					$total = 0;
	                      					for($u=0;$u<count($ex);$u++){
	                      						$html.='<td>'.number_format((double)$ex[$u],2).'</td>';
	                      						$total = $total + $ex[$u];
	                      					}


              								
                      						$html.='<td>'.number_format($total,2).'</td><td></td></tr>';
                      					}
                      				}

				$html.='</tbody></table>';


				for($x=0;$x<count($judges);$x++){
				$html.='<div class="col-md-4 col-xs-4" style="margin-top:2%;">
						<p style="border-top:1px solid black;text-align:center">
						'.$judges[$x]['name'].'<p>
						</div>';
					}
				$html.='</div>
				</div>
				</body>
				</html>';
				echo $html;
	}
}
	