<?php
class statusController extends Controller{
	public function status(){
		$this->error();	
	}
	public function updateLevelsStatus($id = "",$type = ""){

		if($type == "act"){
			$activate = $this->helper->update(array('levels',array(
				'status'=>"on going",
				'id'=>$id
			)));
		}else if ($type == "deact") {
			$deactivate = $this->helper->update(array('levels',array(
				'status'=>"pending",
				'id'=>$id
			)));
		}else{

			$cat = $this->helper->select(array('categories',array(
				'level_id'=>$id
			)));
			$can = $this->helper->select(array('candidates',array(
				'event_id'=>$_SESSION['current_event_id']
			)));

			
			for($s=0;$s<count($can);$s++){
				$score = 0;
				for($x=0;$x<count($cat);$x++){
					$result = $this->helper->select(array('results',array(
						'category_id'=>$cat[$x]['id'],
						'candidate_id'=>$can[$s]['id']
					)));
					$score = $score + $result[0]['score'];
				}

				$this->helper->add(array('level_result',array(
					'candidate_id'=>$can[$s]['id'],
					'level_id'=>$id,
					'percentage'=>$score,
				)));
			}
			
			
			$done = $this->helper->update(array('levels',array(
				'status'=>"done",
				'id'=>$id
			)));
		}
		
	
	}
	// Edit Event

	public function getEditEvent(){
		$event = $this->helper->select(array('events',array('id'=>$_SESSION['current_event_id'])));

		if(count($event) != 0){
			$table = '
			
				<div class="form-group">
					<label class="control-label col-md-3">Event Name</label>
					<div class="col-md-12">
						<input type="text" value="'.$event[0]['event_name'].'" name="eventName" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Date</label>
					<div class="col-md-12">
						<input type="text" value="'.$event[0]['date'].'" name="eventDate" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">About</label>
					<div class="col-md-12">
						<input type="text" value="'.$event[0]['about'].'" name="eventAbout" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Organizer</label>
					<div class="col-md-12">
						<input type="text" value="'.$event[0]['organizer'].'" name="eventOrganizer" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Host</label>
					<div class="col-md-12">
						<input type="text" value="'.$event[0]['host'].'" name="eventHost" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-4">Location</label>
					<div class="col-md-12">
						<input type="text" value="'.$event[0]['location'].'" name="eventLocation" class="form-control">
					</div>
				</div>
				

				<div style="clear:both"></div>
			
		';

		echo $table;

		}else{
			$this->error();
		}
		
	}

	public function updateEditEvent(){
		$updateEvent = $this->helper->update(array('events',array(
			'event_name'=>$_POST['eventName'],
			'date'=>$_POST['eventDate'],
			'about'=>$_POST['eventAbout'],
			'organizer'=>$_POST['eventOrganizer'],
			'host'=>$_POST['eventHost'],
			'location'=>$_POST['eventLocation'],
			'id'=>$_SESSION['current_event_id']
		)));

		$this->locate('events/info/'.$_SESSION['current_event_id']);
	}

}