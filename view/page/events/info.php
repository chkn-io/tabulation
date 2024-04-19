  <div id="content-header">
    <div id="breadcrumb"> <a href="{DEFAULT_PATH}events" title="Go to Home" class="tip-bottom"><i class="fa fa-calendar"></i> Events</a>/{CURRENT_EVENT}/</div>
  </div>
 <div id="sample-container"></div>

 <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Event Settings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{EVENT_HEADER}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><span class="text-success">{EVENT_NAME}</span></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-calendar user-profile-icon"></i> Date : <span class="text-danger">{EVENT_DATE}</span>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> About : <span class="text-danger">{EVENT_ABOUT}</span>
                        </li>

                        
                        <li>
                          <i class="fa fa-users user-profile-icon"></i> Organizer : <span class="text-danger">{EVENT_ORGANIZER}</span>
                        </li>
                        <li>
                          <i class="fa fa-user user-profile-icon"></i> Host : <span class="text-danger">{EVENT_HOST}</span>
                        </li>
                        <li>
                          <i class="fa fa-map-marker user-profile-icon"></i> Location : <span class="text-danger">{EVENT_LOCATION}</span>
                        </li>
                      </ul>

                      <!-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Event</a> -->
                      <button class="btn btn-success editEvent"><i class="fa fa-edit m-right-xs"></i> Edit Event</button>
                      <a href="{DEFAULT_PATH}events/resetResult" class="btn btn-danger" onclick='if(confirm("Reset the event result?")){}else{return false;}'>Reset Results</a>

                      <br />

                      <!-- start skills -->
                      
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12 pull-right">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Levels</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Categories</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Candidates</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Judge</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Sponsors</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <!-- start recent activity -->
                            <h3>Competition Levels<button class="btn btn-primary btn-xs pull-right new-level"><i class="fa fa-plus"></i> New Level</button></h3>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Order #</th>
                                  <th>Level Name</th>
                                  <th>Number of Contestants</th>
                                  <th>Number of Winner</th>
                                  <th>Candidate Source</th>
                                  <th>Mode</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="level-container"></tbody>
                            </table>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <h3>Competition Categories  <button class="btn btn-primary btn-xs pull-right new-category"><i class="fa fa-plus"></i> New Category</button>
                            <!-- <button class="btn btn-warning btn-xs pull-right apply-manual"><i class="fa fa-plus"></i> Apply Popularity</button> -->
                            </h3>
                              

                            <ul class="list-unstyled category-container timeline">
                            </ul>
                            <!-- end user projects -->
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                             <h3>Candidates <button class="btn btn-primary btn-xs pull-right new-candidate"><i class="fa fa-plus"></i> New Candidate</button></h3>
                          
                              <table class="table">
                              <h3>Section 1</h3>
                              <thead>
                                <tr>
                                  <th>Image</th>
                                  <th>Candidate Number</th>
                                  <th>Name</th>
                                  <th>Tag</th>
                                  <th>Institution</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="candidateM-container"></tbody>
                            </table>
                            

                            <h3>Section 2</h3>
                            <table class="table">
                            <thead>
                                <tr>
                                  <th>Image</th>
                                  <th>Candidate Number</th>
                                  <th>Name</th>
                                  <th>Tag</th>
                                  <th>Institution</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="candidateF-container"></tbody>
                            </table>
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                            <!-- start user projects -->
                            <h3>Competition Judge <button class="btn btn-primary btn-xs pull-right new-judge"><i class="fa fa-plus"></i> New Judge</button></h3>
                           <table class="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Judge Info</th>
                                  <th>Judge Code</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="judge-container"></tbody>
                            </table>
                            <!-- end user projects -->
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                            <!-- start user projects -->
                            <h3>Competition Sponsors <button class="btn btn-primary btn-xs pull-right new-sponsor"><i class="fa fa-plus"></i> New Sponsor</button></h3>
                           <table class="table">
                              <thead>
                                <tr>
                                  <th>Logo</th>
                                  <th>Sponsor</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="sponsor-container"></tbody>
                            </table>
                            <!-- end user projects -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Level Dialog Box -->
<div id="newLevel" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Level for {CURRENT_EVENT}</h4>
      </div>
      <div class="modal-body">
        <form class="level">
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Level Name</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control required" placeholder="Enter the Level Name" name="name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Contestant Number</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="number" class="form-control required" placeholder="Enter the Contestant Number" name="contestant_number">
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">No of Winner for this Round</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="number" class="form-control required" placeholder="Enter No of Winner for this Round" name="number_winner">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Candidate Source</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <select class="form-control" name="source" id="source"> 
                
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Scoring Mode</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <select class="form-control" name="mode">
                <option value="Back to Zero">Back to Zero</option>
                <option value="Retain Score">Retain Score</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Result Banner</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="file" class="form-control required" name="result_banner">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-level" data-form="level">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>

  </div>
</div>


            <!-- End of Level Dialog Box -->


            <!-- Category Dialog Box -->
            <div id="newCategory" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Category for {CURRENT_EVENT}</h4>
      </div>
      <div class="modal-body">
        <form class="category">
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Category Name</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control required" placeholder="Enter the Category Name" name="name">
            </div>
          </div>
         

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Select Category Level</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <select class="form-control" name="cat_level">
                
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Result Banner</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="file" class="form-control required" name="result_banner">
            </div>
          </div>
          <br><br>
          <h4 class="text-danger">Sub-categories (atleast 1)</h4>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Sub Category Name</th>
                <th>Min Score</th>
                <th>Max Score</th>
                <th>Percentage</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="new-field">
              <tr>
                <td><input type="text" class="form-control required" name="sub_cat_name[]"></td>
                <td><input type="number" class="form-control required" name="sub_cat_min[]"></td>
                <td><input type="number" class="form-control required" name="sub_cat_max[]"></td>
                <td><input type="number" class="form-control required" name="sub_cat_per[]"></td>
                <td></td>
              </tr>
            </tbody>

            <button type="button" class="btn btn-default field-button"><i class="fa fa-plus"></i> New Field</button>
          </table>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-category" data-form="category">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </form>
      </div>
    </div>

  </div>
</div>

            <!-- End of Category Dialog Box -->



            <!-- Candidates Dialog Box -->
            <div id="newCandidate" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Candidate for {CURRENT_EVENT}</h4>
      </div>
      <div class="modal-body">
        <form class="candidate">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Candidate #</th>
                <th>Name</th>
                <th>Tag</th>
                <th>Institution</th>
                <th>Section</th>
                <th>Image</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="can-new-field">
              <tr>
                <td><input type="number" class="form-control required" name="can_num[]"></td>
                <td><input type="text" class="form-control required" name="can_nam[]"></td>
                <td><input type="text" class="form-control" name="can_tag[]"></td>
                <td><input type="text" class="form-control required" name="can_ins[]"></td>
                <td>
                  <select class="form-control required" name="can_gen[]">
                    <option value="Male">Section 1</option>
                    <option value="Female">Section 2</option>
                  </select>
                </td>

                <td><input type="file" class="form-control required" name="can_img[]"></td>
                <td></td>
              </tr>
            </tbody>
            <button type="button" class="btn btn-default can-field-button"><i class="fa fa-plus"></i> New Field</button>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-candidate" data-form="candidate">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </form>
      </div>
    </div>

  </div>
</div><!-- End of Category Dialog Box -->


 <!-- Candidates Dialog Box -->
            <div id="newSponsor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Sponsor for {CURRENT_EVENT}</h4>
      </div>
      <div class="modal-body">
        <form class="sponsor">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Logo</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="spo-new-field">
              <tr>
                <td><input type="text" class="form-control required" name="name[]"></td>
                <td><input type="file" class="form-control required" name="spo_img[]"></td>
                <td></td>
              </tr>
            </tbody>
            <button type="button" class="btn btn-default spo-field-button"><i class="fa fa-plus"></i> New Field</button>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-sponsor" data-form="sponsor">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </form>
      </div>
    </div>

  </div>
</div><!-- End of Category Dialog Box -->

 <!-- Judge Dialog Box -->
            <div id="newJudge" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Judge for {CURRENT_EVENT}</h4>
      </div>
      <div class="modal-body">
        <form class="judge">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Judge Name</th>
                <th>JudgeInformation</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="jud-new-field">
              <tr>
                <td><br><input type="text" class="form-control required" name="jud_nam[]"></td>
                <td><textarea type="text" class="form-control required" name="jud_inf[]"></textarea></td>
              </tr>
            </tbody>
            <button type="button" class="btn btn-default jud-field-button"><i class="fa fa-plus"></i> New Field</button>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-judge" data-form="judge">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </form>
      </div>
    </div>

  </div>
</div>

<!-- Edit Judge -->
<div id="edit_judge" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Judge for {CURRENT_EVENT}</h4>
      </div>
      <form id="editJudge">
      <div class="modal-body edit-judge">
        
       </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-editJudge">Submit</button>
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end of Edit Judge -->

<!-- Edit Candidate -->
<div id="edit_candidate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Candidate for {CURRENT_EVENT}</h4>
      </div>
      <form id="editCandidate">
      <div class="modal-body edit-candidate">
        
       </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-editCandidate">Submit</button>
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- end of Edit Candidate -->


<!-- edit Event -->
<div id="edit_event" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit for the Event {CURRENT_EVENT}</h4>
      </div>
      <form id="editEvent" method="post" action="{DEFAULT_PATH}status/updateEditEvent">
      <div class="modal-body edit-event">
        
       </div>

       <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end of Edit Event -->

<!-- End of Judge -->

<!-- Edit Sponsor -->
<div id="edit_sponsor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Sponsor for {CURRENT_EVENT}</h4>
      </div>
      <form id="editSponsor">
      <div class="modal-body edit-sponsor">
        
       </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-editSponsor">Submit</button>
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End of Edit Sponsor -->



<!-- Apply Popularity -->
<div id="apply_popularity" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl" data-record="change-this">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Apply Manual Votes 
        <button class="btn btn-primary btn-xs smaller pull-right">Smaller</button>
        <button class="btn btn-primary btn-xs xlarge pull-right">Larger</button>
        </h4>
      </div>
      <form id="popularity">
      <div class="modal-body pop">
        
       </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-primary submit-manual">Submit</button>
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End of Edit Sponsor -->
<div style="clear:both"></div>
            


            <!-- Apply Popularity -->
<div id="viewVotes" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl" data-record="change-this">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Judge Scores
        </h4>
      </div>
      <div class="modal-body judge-votes">
          
      </div>

       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>