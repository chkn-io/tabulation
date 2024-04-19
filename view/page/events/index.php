 <div id="content-header">
    <div id="breadcrumb"> <a href="{DEFAULT_PATH}events" title="Go to Events" class="tip-bottom"><i class="fa fa-calendar"></i> Events</a></div>
  </div>
 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Event List </h2>
      <a href="#" class="newEvent btn btn-primary pull-right"><i class="fa fa-plus"></i> New Event</a>
       
      <div class="clearfix"></div>
    </div>
    <div class="col-md-12">
      <ul class="list-unstyled timeline">
        
        
      </ul>

    </div>
  </div>
</div>


<!-- Modal -->
<div id="newEvent" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Event</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Name</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control" placeholder="Enter the Event Name" name="name">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Date</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="date" class="form-control date-picker" placeholder="mm/dd/yyyy" name="date">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">About the Event</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <textarea class="form-control" placeholder="Enter some information about the event" name="about"></textarea>
            </div>
          </div>
          <br><br><br><br>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Organizer</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control" placeholder="Enter the Event Organizer" name="organizer">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Host -  Separate w/ (,)</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control" placeholder="Enter the Event Host" name="host">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Location</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control" placeholder="Enter the Event Location" name="location">
            </div>
          </div>
          <br><br>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Header Image</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type="file" class="form-control" name="header">
            </div>
          </div>
          <br><br>

          <div class="form-group">
            <label class="control-label col-md-5 col-sm-5 col-xs-12">Event Print Header</label>
            <div class="col-md-7 col-sm-7 col-xs-12"> 
              <input type="file" class="form-control" name="advertisement">
            </div>
          </div>
          <br><br>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </form>
      </div>
    </div>

  </div>
</div>